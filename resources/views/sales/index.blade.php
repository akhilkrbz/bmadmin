@extends('layouts.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Sales List</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sales List</li>
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
                                <h3 class="card-title">Sales List</h3>
                                <a href="{{ route('sales.create') }}" class="btn btn-primary float-end">Add Sale</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl.No.</th>
                                            <th>Invoice No</th>
                                            <th>Date</th>
                                            <th>Ledger</th>
                                            <th>Total Amount</th>
                                            <th>Payment Mode</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sales as $key => $sale)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $sale->invoice_no }}</td>
                                                <td>{{ date('d-m-Y', strtotime($sale->sale_date)) }}</td>
                                                <td>{{ $sale->ledger->title ?? '' }}</td>
                                                <td>{{ $sale->total_amount }}</td>
                                                <td>{{ ucfirst($sale->payment_mode) }}</td>
                                                <td>
                                                    <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-info btn-sm">View</a>
                                                    <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" style="display:inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this sale?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    <li class="page-item {{ $sales->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $sales->previousPageUrl() ?? '#' }}" tabindex="-1">«</a>
                                    </li>
                                    @for ($page = 1; $page <= $sales->lastPage(); $page++)
                                        <li class="page-item {{ $sales->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $sales->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item {{ $sales->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $sales->nextPageUrl() ?? '#' }}">»</a>
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
