@extends('layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Voucher List</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Voucher List</li>
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
                            <h3 class="card-title">Vouchers</h3>
                            <a href="{{ route('payment_vouchers.create') }}" class="btn btn-success position-relative float-end">Create Voucher</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl.No.</th>
                                        <th>Voucher Number</th>
                                        <th>Date</th>
                                        <th>Ledger</th>
                                        <th>Amount (₹)</th>
                                        <th>Payment Mode</th>
                                        <th>Created By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vouchers as $key => $voucher)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $voucher->voucher_number }}</td>
                                            <td>{{ date('d-m-Y', strtotime($voucher->voucher_date)) }}</td>
                                            <td>{{ ucfirst($voucher->ledger->title) }}</td>
                                            <td>{{ $voucher->amount }}</td>
                                            <td>{{ ucfirst($voucher->payment_mode) }}</td>
                                            <td>{{ $voucher->creator?->name }}</td>
                                            <td>
                                                <a href="{{ route('payment_vouchers.show', $voucher) }}" class="btn btn-info btn-sm mb-1">View</a>
                                                <a href="{{ route('payment_vouchers.edit', $voucher) }}" class="btn btn-primary btn-sm mb-1">Edit</a>
                                                <form action="{{ route('payment_vouchers.destroy', $voucher) }}" method="POST" style="display:inline;">
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
                                <li class="page-item {{ $vouchers->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $vouchers->previousPageUrl() ?? '#' }}" tabindex="-1">«</a>
                                </li>
                                @for ($page = 1; $page <= $vouchers->lastPage(); $page++)
                                    <li class="page-item {{ $vouchers->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $vouchers->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endfor
                                <li class="page-item {{ $vouchers->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $vouchers->nextPageUrl() ?? '#' }}">»</a>
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
