@extends('layouts.app')
@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Edit Purchase</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Purchase</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--begin::App Content-->
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-md-10">
                        @include('common.alerts')
                        <div class="card card-warning card-outline mb-4">
                            <div class="card-header">
                                <div class="card-title">Edit Purchase</div>
                            </div>
                            <form action="{{ route('purchases.update', $purchase) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Purchase Date</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="purchase_date" class="form-control datepicker" value="{{ old('purchase_date', $purchase->purchase_date) }}">
                                        </div>
                                        <label class="col-sm-2 col-form-label">Bill No</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="bill_no" class="form-control" value="{{ old('bill_no', $purchase->bill_no) }}">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Supplier</label>
                                        <div class="col-sm-4">
                                            <select name="supplier_id" class="form-control">
                                                <option value="">Select Supplier</option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $purchase->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ $supplier->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Payment Mode</label>
                                        <div class="col-sm-4">
                                            <select name="payment_mode" class="form-control">
                                                <option value="cash" {{ old('payment_mode', $purchase->payment_mode) == 'cash' ? 'selected' : '' }}>Cash</option>
                                                <option value="bank" {{ old('payment_mode', $purchase->payment_mode) == 'bank' ? 'selected' : '' }}>Bank</option>
                                                <option value="credit" {{ old('payment_mode', $purchase->payment_mode) == 'credit' ? 'selected' : '' }}>Credit</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Total Amount</label>
                                        <div class="col-sm-4">
                                            <input type="number" step="0.01" name="total_amount" class="form-control" value="{{ old('total_amount', $purchase->total_amount) }}">
                                        </div>
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-4">
                                            <textarea name="description" class="form-control" id="inputPassword3">{{ $purchase->description }}</textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>Items</h4>
                                    <div id="items-container">
                                        @foreach($purchase->items as $i => $item)
                                        <div class="row mb-2 item-row">
                                            <div class="col">
                                                <select name="items[{{ $i }}][item_id]" class="form-control" required>
                                                    <option value="">Select Item</option>
                                                    @foreach($items as $ledger)
                                                        <option value="{{ $ledger->id }}" {{ $item->item_id == $ledger->id ? 'selected' : '' }}>{{ $ledger->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input type="number" name="items[{{ $i }}][quantity]" class="form-control" value="{{ $item->quantity }}" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.01" name="items[{{ $i }}][rate]" class="form-control" value="{{ $item->rate }}" required>
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
                                    <a href="{{ route('purchases.index') }}" class="btn float-end">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<script>
let itemIndex = '{!! count($purchase->items) !!}';
document.getElementById('add-item').onclick = function() {
    const container = document.getElementById('items-container');
    const row = document.createElement('div');
    row.className = 'row mb-2 item-row';
    row.innerHTML = `
        <div class="col">
            <select name="items[${itemIndex}][item_id]" class="form-control" required>
                <option value="">Select Item</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <input type="number" name="items[${itemIndex}][quantity]" class="form-control" placeholder="Quantity" required>
        </div>
        <div class="col">
            <input type="number" step="0.01" name="items[${itemIndex}][rate]" class="form-control" placeholder="Rate" required>
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
document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('remove-item')) {
        e.target.closest('.item-row').remove();
    }
});
</script>
@endsection
