@extends('layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add Payment Voucher</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Payment Voucher</li>
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
                            <div class="card-title">Add Payment Voucher</div>
                        </div>
                        <form action="{{ route('payment_vouchers.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row mb-3">
                                    <!-- <label class="col-sm-2 col-form-label">Voucher Number</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="voucher_number" class="form-control" value="{{ old('voucher_number') }}">
                                    </div> -->
                                    <label class="col-sm-2 col-form-label">Voucher Date</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="voucher_date" class="form-control datepicker" value="{{ old('voucher_date') }}" required>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Voucher Type</label>
                                    <div class="col-sm-4">
                                        <select name="voucher_type" class="form-control" required>
                                            <option value="ledger" {{ old('voucher_type') == 'ledger' ? 'selected' : '' }}>Ledger</option>
                                            <option value="purchase" {{ old('voucher_type') == 'purchase' ? 'selected' : '' }}>Purchase</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Voucher Type ID</label>
                                    <div class="col-sm-4">
                                        <select name="voucher_type_id" id="voucher_type_id" class="form-control" required>
                                            <!-- Options will be populated by JS -->
                                        </select>
                                        <div id="total-amount-info" class="mt-2 text-info"></div>
                                        <input type="hidden" id="total-amount-balance">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Amount</label>
                                    <div class="col-sm-4">
                                        <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount') }}" required>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Payment Mode</label>
                                    <div class="col-sm-4">
                                        <select name="payment_mode" class="form-control" required>
                                            <option value="cash" {{ old('payment_mode') == 'cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="bank" {{ old('payment_mode') == 'bank' ? 'selected' : '' }}>Bank</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-4">
                                        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Save</button>
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
                options += `<option value="${l.id}">${l.title}</option>`;
            });
        } else {
            options += '<option value="">Select Purchase</option>';
            purchases.forEach(p => {
                options += `<option value="${p.id}">${p.supplier.title} - ${p.voucher_number || p.bill_no || ''}</option>`;
            });
        }
        select.innerHTML = options;
    }
    function addVoucherTypeIdListener() {
        const voucherTypeIdSelect = $('#voucher_type_id');
        if (!voucherTypeIdSelect.length) return;
        voucherTypeIdSelect.off('change').on('change', handleVoucherTypeIdChange);
    }
    function handleVoucherTypeIdChange() {
        const voucherType = document.querySelector('[name="voucher_type"]').value;
        const voucherTypeId = this.value;
        const amountInput = document.querySelector('input[name="amount"]');
        document.getElementById('total-amount-info').innerText = '';
        document.getElementById('total-amount-balance').value = '';
        if(voucherType == 'purchase') {
            if (!voucherTypeId) return;
            let baseUrl = 'http://localhost/bmadmin/public/';//document.querySelector('base') ? document.querySelector('base').href : window.location.origin;
            if (baseUrl.endsWith('/')) baseUrl = baseUrl.slice(0, -1);
            const apiUrl = `${baseUrl}/payment-vouchers/total-amount?voucher_type=${voucherType}&voucher_type_id=${voucherTypeId}`;
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    if (data && typeof data.total_amount !== 'undefined') {
                        document.getElementById('total-amount-info').innerText = 'Balance amount: ' + data.total_amount + ' /-';
                        document.getElementById('total-amount-balance').value = data.total_amount;
                        document.getElementById('total-amount-info').style.display = 'block';
                        if (amountInput) {
                            amountInput.setAttribute('max', data.total_amount);
                        }
                    } else {
                        document.getElementById('total-amount-info').innerText = '';
                        document.getElementById('total-amount-info').style.display = 'none';
                        document.getElementById('total-amount-balance').value = '';
                        if (amountInput) {
                            amountInput.removeAttribute('max');
                        }
                    }
                });
        } else {
            // Remove max if not purchase
            if (amountInput) {
                amountInput.removeAttribute('max');
            }
        }
    }
    document.querySelector('[name="voucher_type"]').addEventListener('change', function() {
        document.getElementById('total-amount-info').innerText = '';
        document.getElementById('total-amount-balance').value = '';
        populateVoucherTypeId();
        setTimeout(addVoucherTypeIdListener, 100); // Wait for select2 to re-init
    });
    document.addEventListener('DOMContentLoaded', function() {
        populateVoucherTypeId();
        setTimeout(addVoucherTypeIdListener, 100);
        // Set max attribute on load if purchase type is selected and balance exists
        const voucherType = document.querySelector('[name="voucher_type"]').value;
        const amountInput = document.querySelector('input[name="amount"]');
        const balance = document.getElementById('total-amount-balance').value;
        if (voucherType === 'purchase' && balance && amountInput) {
            amountInput.setAttribute('max', balance);
        } else if (amountInput) {
            amountInput.removeAttribute('max');
        }
    });
</script>
@endsection
