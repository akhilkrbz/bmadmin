@extends('layouts.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Update Customer</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Customer</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-8">
                        @include('common.alerts')
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('customer.update', $customer) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label>Type</label>
                                        <select name="type" class="form-control" required>
                                            <option value="customer" {{ $customer->type == 'customer' ? 'selected' : '' }}>Customer</option>
                                            <option value="shop" {{ $customer->type == 'shop' ? 'selected' : '' }}>Shop</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ $customer->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Place</label>
                                        <input type="text" name="place" class="form-control" value="{{ $customer->place }}">
                                    </div>
                                    <div class="mb-3">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}">
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
