@extends('layouts.admin')
  <!-- Begin Page Content -->
@section('main-content')

<h1 class="h3 mb-4 text-gray-800">{{ __('Daftar Produk') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
   

        <a class="btn btn-info" href="{{ route('products.create') }}" >Tambah Produk</a>

    </div>

    <div class="row">
    <select name="category" id="category" onchange="filterCategory()" class="form-control ml-4 col-md-3">
        <option value="all">Semua</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <button type="submit" onclick="exportExcel()" class="btn btn-success ml-3 col-md-2">Export Excel</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="table-meta" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th class="wd-5p">NO</th>
                    <th class="wd-20p">Image</th>
                    <th class="wd-20p">Nama Produk</th>
                    <th class="wd-20p">Kategori Produk</th>
                    <th class="wd-20p">Harga Beli (Rp)</th>
                    <th class="wd-20p">Harga Jual (Rp)</th>
                    <th class="wd-20p">Stok Produk</th>
                    <th class="wd-10p" width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection