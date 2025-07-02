@extends('layouts.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Receipts List</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Receipts List</li>
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
                                <h3 class="card-title">Receipts List</h3>
                                <a href="{{ route('receipts.create') }}" class="btn btn-success position-relative float-end">Add Receipt</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl.No.</th>
                                            <th>Date</th>
                                            <th>Receipt No</th>
                                            <th>Ledger</th>
                                            <th>Payment Mode</th>
                                            <th>Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($receipts as $key => $receipt)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ date('d-m-Y', strtotime($receipt->receipt_date)) }}</td>
                                                <td>{{ $receipt->receipt_number }}</td>
                                                <td>{{ $receipt->ledger?->title }}</td>
                                                <td>{{ ucfirst($receipt->payment_mode) }}</td>
                                                <td>{{ $receipt->amount }}</td>
                                                <td>
                                                    <a href="{{ route('receipts.show', $receipt) }}" class="btn btn-info btn-sm mb-1">View</a>
                                                    <a href="{{ route('receipts.edit', $receipt) }}" class="btn btn-primary btn-sm mb-1">Edit</a>
                                                    <form action="{{ route('receipts.destroy', $receipt) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    <li class="page-item {{ $receipts->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $receipts->previousPageUrl() ?? '#' }}" tabindex="-1">«</a>
                                    </li>
                                    @for ($page = 1; $page <= $receipts->lastPage(); $page++)
                                        <li class="page-item {{ $receipts->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $receipts->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item {{ $receipts->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $receipts->nextPageUrl() ?? '#' }}">»</a>
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
