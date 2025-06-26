@extends('layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Payment Voucher</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Payment Voucher</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-md-10">
                    @include('common.alerts')
                    <div class="card card-warning card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Edit Payment Voucher</div>
                        </div>
                        <form action="{{ route('payment_vouchers.update', $payment_voucher) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <!-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Voucher Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="voucher_number" class="form-control" value="{{ old('voucher_number', $payment_voucher->voucher_number) }}">
                                    </div>
                                </div> -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Voucher Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="voucher_date" class="form-control" value="{{ old('voucher_date', $payment_voucher->voucher_date) }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Voucher Type</label>
                                    <div class="col-sm-4">
                                        <select name="voucher_type" class="form-control">
                                            <option value="ledger" {{ old('voucher_type', $payment_voucher->voucher_type) == 'ledger' ? 'selected' : '' }}>Ledger</option>
                                            <option value="purchase" {{ old('voucher_type', $payment_voucher->voucher_type) == 'purchase' ? 'selected' : '' }}>Purchase</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Voucher Type ID</label>
                                    <div class="col-sm-4">
                                        <select name="voucher_type_id" id="voucher_type_id" class="form-control select2">
                                            <!-- Options will be populated by JS -->
                                        </select>
                                        <div id="total-amount-info" class="mt-2 text-info"></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Amount</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $payment_voucher->amount) }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Payment Mode</label>
                                    <div class="col-sm-10">
                                        <select name="payment_mode" class="form-control">
                                            <option value="cash" {{ old('payment_mode', $payment_voucher->payment_mode) == 'cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="bank" {{ old('payment_mode', $payment_voucher->payment_mode) == 'bank' ? 'selected' : '' }}>Bank</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control">{{ old('description', $payment_voucher->description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Update</button>
                                <a href="{{ route('payment_vouchers.index') }}" class="btn float-end">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    const ledgers = @json($ledgers ?? []);
    const purchases = @json($purchases ?? []);
    function populateVoucherTypeId() {
        const type = document.querySelector('[name="voucher_type"]').value;
        const select = document.getElementById('voucher_type_id');
        select.innerHTML = '';
        let options = '';
        if(type === 'ledger') {
            options += '<option value="">Select Ledger</option>';
            ledgers.forEach(l => {
                options += `<option value="${l.id}" ${l.id == {{ old('voucher_type_id', $payment_voucher->voucher_type_id) }} ? 'selected' : ''}>${l.title}</option>`;
            });
        } else {
            options += '<option value="">Select Purchase</option>';
            purchases.forEach(p => {
                options += `<option value="${p.id}" ${p.id == {{ old('voucher_type_id', $payment_voucher->voucher_type_id) }} ? 'selected' : ''}>${p.supplier.title} - ${p.voucher_number || p.bill_no || ''}</option>`;
            });
        }
        select.innerHTML = options;
    }
    document.querySelector('[name="voucher_type"]').addEventListener('change', populateVoucherTypeId);
    document.addEventListener('DOMContentLoaded', populateVoucherTypeId);

    // AJAX to get total amount for selected voucher_type_id
    document.getElementById('voucher_type_id').addEventListener('change', function() {
        const voucherType = document.querySelector('[name="voucher_type"]').value;
        const voucherTypeId = this.value;
        if (!voucherTypeId) return;
        fetch(`/payment-vouchers/total-amount?voucher_type=${voucherType}&voucher_type_id=${voucherTypeId}`)
            .then(response => response.json())
            .then(data => {
                if (data && typeof data.total_amount !== 'undefined') {
                    document.getElementById('total-amount-info').innerText = 'Total payment voucher amount for this selection: ' + data.total_amount;
                    document.getElementById('total-amount-info').style.display = 'block';
                } else {
                    document.getElementById('total-amount-info').innerText = '';
                    document.getElementById('total-amount-info').style.display = 'none';
                }
            });
    });
</script>
@endsection
