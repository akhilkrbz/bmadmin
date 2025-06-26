@extends('layouts.app')

@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Purchases List</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Purchases List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--begin::App Content-->
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('common.alerts')
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Purchases List</h3>
                                <a href="{{ route('purchases.create') }}" class="btn btn-success position-relative float-end">Add Purchase</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl.No.</th>
                                            <th>Date</th>
                                            <th>Bill No</th>
                                            <th>Supplier</th>
                                            <th>Payment Mode</th>
                                            <th>Total Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($purchases as $key => $purchase)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ date('d-m-Y', strtotime($purchase->purchase_date)) }}</td>
                                                <td>{{ $purchase->bill_no }}</td>
                                                <td>{{ $purchase->supplier?->title }}</td>
                                                <td>{{ ucfirst($purchase->payment_mode) }}</td>
                                                <td>{{ $purchase->total_amount }}</td>
                                                <td>
                                                    <a href="{{ route('purchases.show', $purchase) }}" class="btn btn-info btn-sm mb-1">View</a>
                                                    <a href="{{ route('purchases.edit', $purchase) }}" class="btn btn-primary btn-sm mb-1">Edit</a>
                                                    <form action="{{ route('purchases.destroy', $purchase) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" disabled class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    <li class="page-item {{ $purchases->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $purchases->previousPageUrl() ?? '#' }}" tabindex="-1">«</a>
                                    </li>
                                    @for ($page = 1; $page <= $purchases->lastPage(); $page++)
                                        <li class="page-item {{ $purchases->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $purchases->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item {{ $purchases->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $purchases->nextPageUrl() ?? '#' }}">»</a>
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
