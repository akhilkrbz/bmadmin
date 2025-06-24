@extends('layouts.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Update Product</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Product</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('products.update', $product) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label>Product Name</label>
                                        <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>MRP (₹)</label>
                                        <input type="number" name="mrp" class="form-control" value="{{ $product->mrp }}" step="0.01" required>
                                    </div>
                                    <!-- <div class="mb-3"> -->
                                        <!-- <label>Status</label> -->
                                        <input type="hidden" name="status" class="form-control" value="{{ $product->status }}" required>
                                    <!-- </div> -->
                                    <div class="mb-3">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
