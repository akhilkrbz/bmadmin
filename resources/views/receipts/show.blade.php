@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Receipt Details</h1>
    <table class="table table-bordered">
        
        <tr>
            <th>Date</th>
            <td>{{ date('d-m-Y', strtotime($receipt->receipt_date)) }}</td>
        </tr>
        <tr>
            <th>Receipt No</th>
            <td>{{ $receipt->receipt_number }}</td>
        </tr>
        <tr>
            <th>Ledger</th>
            <td>{{ $receipt->ledger?->title }}</td>
        </tr>
        <tr>
            <th>Payment Mode</th>
            <td>{{ ucfirst($receipt->payment_mode) }}</td>
        </tr>
        <tr>
            <th>Amount</th>
            <td>{{ $receipt->amount }} /-</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $receipt->description }}</td>
        </tr>
        <tr>
            <th>Created By</th>
            <td>{{ $receipt->creator?->name }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ date('d-m-Y', strtotime($receipt->created_at)) }}</td>
        </tr>
    </table>
    <a href="{{ route('receipts.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('receipts.edit', $receipt) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('receipts.destroy', $receipt) }}" method="POST" style="display:inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
</div>
@endsection
