@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Purchase Details</h1>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $purchase->id }}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ date('d-m-Y', strtotime($purchase->purchase_date)) }}</td>
        </tr>
        <tr>
            <th>Bill No</th>
            <td>{{ $purchase->bill_no }}</td>
        </tr>
        <tr>
            <th>Supplier</th>
            <td>{{ $purchase->supplier?->title }}</td>
        </tr>
        <tr>
            <th>Payment Mode</th>
            <td>{{ ucfirst($purchase->payment_mode) }}</td>
        </tr>
        <tr>
            <th>Total Amount</th>
            <td>{{ $purchase->total_amount }} /-</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $purchase->description }}</td>
        </tr>
        <tr>
            <th>Created By</th>
            <td>{{ $purchase->creator?->name }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ date('d-m-Y', strtotime($purchase->created_at)) }}</td>
        </tr>
    </table>
    <h4>Items</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchase->items as $item)
            <tr>
                <td>{{ $item->item?->title }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->rate }}</td>
                <td>{{ $item->amount }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('purchases.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('purchases.edit', $purchase) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('purchases.destroy', $purchase) }}" method="POST" style="display:inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" disabled class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
</div>
@endsection
