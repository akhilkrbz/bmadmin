@extends('common.layout')
@section('content')
<div class="container">
    <h2>Sale Items</h2>
    <a href="{{ route('sales.index') }}" class="btn btn-secondary mb-3">Back to Sales</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sale ID</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>MRP</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->sale_id }}</td>
                <td>{{ $item->product->product_name ?? '' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->mrp }}</td>
                <td>{{ $item->amount }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $items->links() }}
</div>
@endsection
