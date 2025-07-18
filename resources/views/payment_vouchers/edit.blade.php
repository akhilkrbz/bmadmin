@extends('layouts.app')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Voucher</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Voucher</li>
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
                            <div class="card-title">Edit Voucher</div>
                        </div>
                        <form action="{{ route('payment_vouchers.update', $payment_voucher) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Voucher Date</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="voucher_date" class="form-control datepicker" value="{{ old('voucher_date', date('d-m-Y', strtotime($payment_voucher->voucher_date))) }}">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Ledger</label>
                                    <div class="col-sm-4">
                                        <select name="ledger_id" id="ledger_id" class="form-control select2" required>
                                            <option value="">Select Ledger</option>
                                            @foreach($ledgers as $ledger)
                                                <option data-ledger_type="{{ $ledger->type }}" value="{{ $ledger->id }}" {{ $payment_voucher->ledger_id == $ledger->id ? 'selected' : '' }}>{{ $ledger->title }}</option>
                                            @endforeach
                                        </select>
                                        <div id="total-amount-info" class="mt-2 text-info"></div>
                                        <input type="hidden" id="total-amount-balance">
                                    </div>

                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Amount</label>
                                    <div class="col-sm-4">
                                        <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $payment_voucher->amount) }}">
                                    </div>

                                    <label class="col-sm-2 col-form-label">Payment Mode</label>
                                    <div class="col-sm-4">
                                        <select name="payment_mode" class="form-control">
                                            <option value="cash" {{ old('payment_mode', $payment_voucher->payment_mode) == 'cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="bank" {{ old('payment_mode', $payment_voucher->payment_mode) == 'bank' ? 'selected' : '' }}>Bank</option>
                                        </select>
                                    </div>

                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-4">
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

@endsection

@push('scripts')
<script>
    const BASE_URL = "http://localhost/bmadmin/public/";
    $(document).ready(function() {
        
        $('#ledger_id').on("change", function() {
            var ledger_id = $(this).val();
            var ledger_type = $(this).find('option:selected').data('ledger_type');

            $('#total-amount-info').text('');
            $('#total-amount-balance').val('');

            if (!ledger_id) {
                return;
            }

            if(ledger_type == 'supplier') {
                $.ajax({
                    url: BASE_URL + 'payment-vouchers/total-amount?ledger_id=' + ledger_id,
                    method: 'GET',
                    success: function(data) {
                        if (data && typeof data.total_amount !== 'undefined') {
                            $('#total-amount-info').text('Balance amount: ' + data.total_amount + ' /-');
                            $('#total-amount-balance').val(data.total_amount);
                        } else {
                            $('#total-amount-info').text('');
                            $('#total-amount-balance').val('');
                        }
                    },
                    error: function() {
                        $('#total-amount-info').text('Error fetching total amount');
                        $('#total-amount-balance').val('');
                    }
                });
            }
            
        });
        
    });
</script>
@endpush