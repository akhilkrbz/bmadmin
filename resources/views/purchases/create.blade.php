@extends('layouts.app')
@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Add Purchase</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Purchase</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--begin::App Content-->
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-md-12">
                        @include('common.alerts')
                        <div class="card card-warning card-outline mb-4">
                            <div class="card-header">
                                <div class="card-title">Add Purchase</div>
                            </div>
                            <form action="{{ route('purchases.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Purchase Date</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="purchase_date" class="form-control datepicker" value="{{ old('purchase_date') }}">
                                        </div>

                                        <label class="col-sm-2 col-form-label">Bill No</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="bill_no" class="form-control" value="{{ old('bill_no') }}">
                                        </div>

                                    </div>
                                    
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Supplier</label>
                                        <div class="col-sm-4">
                                            <select name="supplier_id" class="form-control">
                                                <option value="">Select Supplier</option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }} selected>{{ $supplier->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <label class="col-sm-2 col-form-label">Payment Mode</label>
                                        <div class="col-sm-4">
                                            <select name="payment_mode" class="form-control">
                                                <option value="cash" {{ old('payment_mode') == 'cash' ? 'selected' : '' }}>Cash</option>
                                                <option value="bank" {{ old('payment_mode') == 'bank' ? 'selected' : '' }}>Bank</option>
                                                <option value="credit" {{ old('payment_mode') == 'credit' ? 'selected' : '' }}>Credit</option>
                                            </select>
                                        </div>

                                    </div>
                                    
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Total Amount</label>
                                        <div class="col-sm-4">
                                            <input type="number" step="0.01" name="total_amount" class="form-control" value="{{ old('total_amount') }}">
                                        </div>
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-4">
                                            <textarea name="description" class="form-control" id="inputPassword3"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>Items</h4>
                                    <div id="items-container">

                                        <div class="row mb-2 item-row">
                                            <div class="col">
                                                <select name="items[0][item_id]" class="form-control" required>
                                                    <option value="">Select Item</option>
                                                    @foreach($items as $item)
                                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input type="number" name="items[0][quantity]" class="form-control" placeholder="Quantity" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.01" name="items[0][rate]" class="form-control" placeholder="Rate" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.01" name="items[0][amount]" class="form-control" placeholder="Amount" required>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-danger remove-item">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary mb-3" id="add-item">Add Item</button>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning">Save</button>
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
let itemIndex = 1;
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
