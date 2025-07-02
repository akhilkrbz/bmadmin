@extends('layouts.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Edit Receipt</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Receipt</li>
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
                                <div class="card-title">Edit Receipt</div>
                            </div>
                            <form action="{{ route('receipts.update', $receipt->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Receipt Date</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="receipt_date" class="form-control datepicker" value="{{ old('receipt_date', date('d-m-Y', strtotime($receipt->receipt_date))) }}" required>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Ledger</label>
                                        <div class="col-sm-4">
                                            <select name="ledger_id" id="ledger_id" class="form-control select2" required>
                                                <option value="">Select Ledger</option>
                                                @foreach($ledgers as $ledger)
                                                    <option value="{{ $ledger->id }}" {{ $receipt->ledger_id == $ledger->id ? 'selected' : '' }}>{{ $ledger->title }}</option>
                                                @endforeach
                                            </select>
                                            <div id="total-amount-info" class="mt-2 text-info"></div>
                                            <input type="hidden" id="total-amount-balance">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        
                                        <label class="col-sm-2 col-form-label">Payment Mode</label>
                                        <div class="col-sm-4">
                                            <select name="payment_mode" class="form-control" required>
                                                <option value="cash" {{ $receipt->payment_mode == 'cash' ? 'selected' : '' }}>Cash</option>
                                                <option value="bank" {{ $receipt->payment_mode == 'bank' ? 'selected' : '' }}>Bank</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Amount</label>
                                        <div class="col-sm-4">
                                            <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $receipt->amount) }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        
                                        <label class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-4">
                                            <textarea name="description" class="form-control">{{ old('description', $receipt->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning">Update</button>
                                    <a href="{{ route('receipts.index') }}" class="btn float-end">Cancel</a>
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

            $('#total-amount-info').text('');
            $('#total-amount-balance').val('');

            if (!ledger_id) {
                return;
            }

            $.ajax({
                url: BASE_URL + 'receipt/total-amount?ledger_id=' + ledger_id,
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
            
        });
        
    });
</script>
@endpush