@extends('layouts.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Edit Sale</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Sale</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-md-12">
                        @include('common.alerts')
                        <div class="card card-warning card-outline mb-4">
                            <div class="card-header">
                                <div class="card-title">Edit Sale</div>
                            </div>
                            <form action="{{ route('sales.update', $sale->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Sale Date</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="sale_date" class="form-control datepicker" value="{{ old('sale_date', $sale->sale_date) }}" required>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Ledger</label>
                                        <div class="col-sm-4">
                                            <select name="ledger_id" class="form-control" required>
                                                <option value="">Select Ledger</option>
                                                @foreach($ledgers as $ledger)
                                                    <option value="{{ $ledger->id }}" {{ $sale->ledger_id == $ledger->id ? 'selected' : '' }}>{{ $ledger->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        
                                        <label class="col-sm-2 col-form-label">Payment Mode</label>
                                        <div class="col-sm-4">
                                            <select name="payment_mode" class="form-control" required>
                                                <option value="cash" {{ $sale->payment_mode == 'cash' ? 'selected' : '' }}>Cash</option>
                                                <option value="bank" {{ $sale->payment_mode == 'bank' ? 'selected' : '' }}>Bank</option>
                                                <option value="credit" {{ $sale->payment_mode == 'credit' ? 'selected' : '' }}>Credit</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Total Amount</label>
                                        <div class="col-sm-4">
                                            <input type="number" step="0.01" name="total_amount" class="form-control" value="{{ old('total_amount', $sale->total_amount) }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        
                                        <label class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-4">
                                            <textarea name="description" class="form-control">{{ old('description', $sale->description) }}</textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>Sale Items</h4>
                                    <div id="items-container">
                                        @foreach($sale->items as $i => $item)
                                        <div class="row mb-2 item-row">
                                            <div class="col">
                                                <select name="items[{{ $i }}][product_id]" class="form-control product-select" required onchange="setMRP(this)">
                                                    <option value="">Select Product</option>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->id }}" data-mrp="{{ $product->mrp }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input type="number" name="items[{{ $i }}][quantity]" class="form-control" value="{{ $item->quantity }}" min="1" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.01" name="items[{{ $i }}][mrp]" class="form-control mrp-input" value="{{ $item->mrp }}" readonly required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.01" name="items[{{ $i }}][amount]" class="form-control" value="{{ $item->amount }}" required>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-danger remove-item">Remove</button>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-secondary mb-3" id="add-item">Add Item</button>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning">Update</button>
                                    <a href="{{ route('sales.index') }}" class="btn float-end">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<script>
let itemIndex = Number('{!! count($sale->items) !!}');
document.getElementById('add-item').onclick = function() {
    const container = document.getElementById('items-container');
    const row = document.createElement('div');
    row.className = 'row mb-2 item-row';
    row.innerHTML = `
        <div class="col">
            <select name="items[${itemIndex}][product_id]" class="form-control product-select" required onchange="setMRP(this)">
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" data-mrp="{{ $product->mrp }}">{{ $product->product_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <input type="number" name="items[${itemIndex}][quantity]" class="form-control" placeholder="Quantity" min="1" required>
        </div>
        <div class="col">
            <input type="number" step="0.01" name="items[${itemIndex}][mrp]" class="form-control mrp-input" placeholder="MRP" readonly required>
        </div>
        <div class="col">
            <input type="number" step="0.01" name="items[${itemIndex}][amount]" class="form-control" placeholder="Amount" required>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-danger remove-item">Remove</button>
        </div>
    `;
    container.appendChild(row);
    itemIndex++;
};
function setMRP(select) {
    const mrp = select.options[select.selectedIndex].getAttribute('data-mrp');
    const row = select.closest('.item-row');
    if(row) {
        const mrpInput = row.querySelector('.mrp-input');
        if(mrpInput) mrpInput.value = mrp || '';
    }
}
document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('remove-item')) {
        e.target.closest('.item-row').remove();
    }
});
window.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.product-select').forEach(function(select) {
        select.addEventListener('change', function() { setMRP(this); });
        setMRP(select); // Set MRP on load for already selected products
    });
});
</script>
@endsection
