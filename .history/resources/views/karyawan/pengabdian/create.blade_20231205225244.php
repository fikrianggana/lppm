@extends('karyawan.layouts.layout')

<body>
    @section('konten')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="{{ route ('pengabdian.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">New Product</h5>
                                <hr />
                                @if ($errors -> any())
                                    <div class="alert alert-danger">
                                        <div class="alert-title"><h4>Whooppss</h4>
                                        There are some problems with your input.
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li> {{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success')}} </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error')}} </div>
                                @endif

                                <div class="col-12">
                                    <label class="form-label">SKU</label>
                                    <input type="text" class="form-control" name="sku" value="{{ old('sku')}}" placeholder="#SKU">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name')}}" placeholder="Name">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Brand</label>
                                    <select name="brand_id" class="form-control" >
                                        <option value="">-- Brand --</option>
                                        @foreach ($brands as $brandID => $name)
                                            <option value="{{ $brandID }}" @selected(old('brand_id') == $brandID)>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Category</label>
                                    @foreach ($categories as $categoryID => $categoryName)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="category_ids[]" value="{{ $categoryID }}">
                                            <label class="form-check-label">
                                                {{ $categoryName }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Price</label>
                                    <input type="text" class="form-control" name="price" value="{{ old('price')}}" placeholder="Price">
                                </div>
                                <br>
                                <div class="col-12">
                                    <label class="form-label">Stock</label>
                                    <input type="number" class="form-control" name="stock" value="{{ old('stock')}}" placeholder="Stock">
                                </div>
                                <br>
                                <div class="col-12">
                                <label for="image">Product Image</label>
                                    <input type="file" id="image" class="form-control" name="image" accept="image/*">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>
