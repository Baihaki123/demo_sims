<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function productsList(Request $request)
    {
        $limit = $request['length'];
        $offset = $request['start'];
        $order_by = 'id';
        $order_direction = 'desc';
        $keyword = $request['search']['value'];
        $query = Products::query()->with('category');
        $total = $query->count();

        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->orWhereRaw('CAST(id AS CHAR) LIKE ?', ["%{$keyword}%"])
                    ->orWhere('name', 'like', "%{$keyword}%")
                    ->orWhereHas('category', function ($subquery) use ($keyword) {
                        $subquery->where('name', 'like', "%{$keyword}%");
                    })
                    ->orWhere('purchase_price', 'like', "%{$keyword}%")
                    ->orWhere('sale_price', 'like', "%{$keyword}%")
                    ->orWhere('stock', 'like', "%{$keyword}%");
            });
        }   
        
        if ($request->category && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        $filter = (clone $query)->count();
        $result = $query->limit($limit)->offset($offset)->orderBy(
            $order_by,
            $order_direction
        )->get();
        $data = array();
        $no = 1;
        foreach ($result as $key => $value) {
            $data[$key] = [
                'no' => $no++,
                'id' => $value->id,
                'image' => 'storage/'.$value->image,
                'name' => $value->name,
                'category' => $value->category->name,
                // 'purchase_price' =>  number_format($value->purchase_price, 0, ',', '.'),
                // 'sale_price' =>  number_format($value->sale_price, 0, ',', '.'),
                'purchase_price' => $value->purchase_price,
                'sale_price' => $value->sale_price,
                'stock' => $value->stock,
                'edit_route' => route('products.edit', $value->id), 
                'delete_route' => route('products.delete', $value->id),     
            ];
        }

        $json_data = array(
            "draw"            => intval($request['draw']),
            "recordsTotal"    => intval($total),
            "recordsFiltered" => intval($filter),
            "limit"           => intval($limit),
            "offset"          => intval($offset),
            "data"            => $data
        );
        return $json_data;
    }
    public function index(){
        $data['categories'] = Categories::all();
        return view('products.index', $data);
    }

    public function create()
    {
        $data['categories'] = Categories::all();
        return view('products.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:products',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
            'image' => 'required|image|mimes:jpg,png|max:100',
        ]);

        $data = [
            'name' => $request->input('name'),
            'purchase_price' => $request->input('purchase_price'),
            'sale_price' => $request->input('sale_price'),
            'stock' => $request->input('stock'),
            'user_id' => auth()->user()->id,
            'category_id' => $request->input('category_id'),
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // simpan di storage/app/public/images
            $data['image'] = $imagePath;
        }

        $success = Products::create($data);

        if ($success) {
            return redirect()->route('products')->withSuccess('Product created successfully.');
        } else {
            return redirect()->back()->withError('Something went wrong.');
        }
        
    }

    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $categories = Categories::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required',
            'stock' => 'required',
            'image' => 'nullable|image|mimes:jpg,png|max:100',
        ]);

        $product = Products::findOrFail($id);

        $data = [
            'name' => $request->input('name'),
            'purchase_price' => $request->input('purchase_price'),
            'sale_price' => $request->input('sale_price'),
            'stock' => $request->input('stock'),
            'user_id' => auth()->user()->id,
            'category_id' => $request->input('category_id'),
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // simpan di storage/app/public/images
            $data['image'] = $imagePath;
        }

        $success = $product->update($data);

        if ($success) {
            return redirect()->route('products')->withSuccess('Product updated successfully.');
        } else {
            return redirect()->back()->withError('Something went wrong.');
        }
    }

    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();
        return redirect()->route('products')->withSuccess('Product deleted successfully.');
    }

    public function export(Request $request)
    {
        $data = Products::query();

        if ($request->category && $request->category != 'all') {
            $data->where('category_id', $request->category);
        }

        $data = $data->get();

        return Excel::download(collect($data), 'products.xlsx');
    }
}
