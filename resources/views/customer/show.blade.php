@extends('layouts.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Customer Details</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Customer Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <p><strong>ID:</strong> {{ $customer->id }}</p>
                                <p><strong>Type:</strong> {{ $customer->type }}</p>
                                <p><strong>Name:</strong> {{ $customer->name }}</p>
                                <p><strong>Place:</strong> {{ $customer->place }}</p>
                                <p><strong>Phone:</strong> {{ $customer->phone }}</p>
                                <a href="{{ route('customer.index') }}" class="btn btn-secondary">Back to List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
