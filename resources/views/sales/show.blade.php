@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Sale Details</h1>
    <table class="table table-bordered">
        
        <tr>
            <th>Date</th>
            <td>{{ date('d-m-Y', strtotime($sale->sale_date)) }}</td>
        </tr>
        <tr>
            <th>Invoice No</th>
            <td>{{ $sale->invoice_no }}</td>
        </tr>
        <tr>
            <th>Ledger</th>
            <td>{{ $sale->ledger->title ?? '' }}</td>
        </tr>
        <tr>
            <th>Payment Mode</th>
            <td>{{ ucfirst($sale->payment_mode) }}</td>
        </tr>
        <tr>
            <th>Total Amount</th>
            <td>{{ $sale->total_amount }} /-</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $sale->description }}</td>
        </tr>
        <tr>
            <th>Created By</th>
            <td>{{ $sale->creator?->name }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ date('d-m-Y', strtotime($sale->created_at)) }}</td>
        </tr>
    </table>
    <h4>Sale Items</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>MRP</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->items as $item)
            <tr>
                <td>{{ $item->product->product_name ?? '' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->mrp }}</td>
                <td>{{ $item->amount }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('sales.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('sales.edit', $sale) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('sales.destroy', $sale) }}" method="POST" style="display:inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
</div>
@endsection
