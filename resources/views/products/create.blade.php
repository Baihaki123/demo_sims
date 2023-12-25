@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Products') }}</h1>

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

    <div class="row">

        <div class="col-lg-12 order-lg-1">

            <div class="card shadow mb-12">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Produk</h6>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('products.store') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="category">Kategori<span class="small text-danger">*</span></label>
                                        <select class="form-control" name="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Nama Barang</label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Nama Barang" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="purchase_price">Harga Beli</label>
                                        <input type="text" id="purchase_price" class="form-control" name="purchase_price" placeholder="Harga Beli">
                                        <span class="error-message"></span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="sale_price">Harga Jual</label>
                                        <input type="text" id="sale_price" class="form-control" name="sale_price" placeholder="Harga Jual">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="stock">Stok Barang</label>
                                        <input type="text" id="stock" class="form-control" name="stock" placeholder="Stok Barang">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Upload Image<span class="small text-danger">*</span></label>
                                        <input type="file" name="image" id="imagethumb" class="form-control"accept="image/*"  onchange="previewImage(event)">  
                                        <img id="preview" src="#" alt="Preview">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Batalkan</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
