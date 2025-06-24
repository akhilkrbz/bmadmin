@extends('layouts.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Customer List</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Customer List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('common.alerts')
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Customer List</h3>
                                <a href="{{ route('customer.create') }}" class="btn btn-primary float-end">Add Customer</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl.No.</th>
                                            <th>Type</th>
                                            <th>Name</th>
                                            <th>Place</th>
                                            <th>Phone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customers as $key => $customer)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $customer->type }}</td>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->place }}</td>
                                                <td>{{ $customer->phone }}</td>
                                                <td>
                                                    <a href="{{ route('customer.edit', $customer) }}" class="btn btn-primary btn-sm">Edit</a>
                                                    <form action="{{ route('customer.destroy', $customer) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" disabled onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    {{-- Previous Page Link --}}
                                    <li class="page-item {{ $customers->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $customers->previousPageUrl() ?? '#' }}" tabindex="-1">«</a>
                                    </li>
                                    {{-- Pagination Elements --}}
                                    @for ($page = 1; $page <= $customers->lastPage(); $page++)
                                        <li class="page-item {{ $customers->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $customers->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endfor
                                    {{-- Next Page Link --}}
                                    <li class="page-item {{ $customers->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $customers->nextPageUrl() ?? '#' }}">»</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
