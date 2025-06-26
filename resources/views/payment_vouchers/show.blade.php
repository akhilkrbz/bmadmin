@extends('layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Payment Voucher Details</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payment Voucher Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-warning card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Payment Voucher Details</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $payment_voucher->id }}</td>
                                </tr>
                                <tr>
                                    <th>Voucher Number</th>
                                    <td>{{ $payment_voucher->voucher_number }}</td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td>{{ $payment_voucher->voucher_date }}</td>
                                </tr>
                                <tr>
                                    <th>Type</th>
                                    <td>{{ ucfirst($payment_voucher->voucher_type) }}</td>
                                </tr>
                                <tr>
                                    <th>Type ID</th>
                                    <td>{{ $payment_voucher->voucher_type_id }}</td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>{{ $payment_voucher->amount }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Mode</th>
                                    <td>{{ ucfirst($payment_voucher->payment_mode) }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $payment_voucher->description }}</td>
                                </tr>
                                <tr>
                                    <th>Created By</th>
                                    <td>{{ $payment_voucher->creator?->name }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $payment_voucher->created_at }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('payment_vouchers.index') }}" class="btn btn-secondary">Back</a>
                            <a href="{{ route('payment_vouchers.edit', $payment_voucher) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('payment_vouchers.destroy', $payment_voucher) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
