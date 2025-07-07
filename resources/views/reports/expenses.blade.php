@extends('layouts.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Expense Report</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Expense Report</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-12">

                        @include('common.alerts')

                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('ledgers.store') }}" id="reportForm" method="POST">
                                    @csrf
                                    <div class="row mb-3">

                                        <label class="col-sm-2 col-form-label">From Date</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="from" class="form-control datepicker" required>
                                        </div>

                                        <label class="col-sm-2 col-form-label">To Date</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="to" class="form-control datepicker" required>
                                        </div>
                                        
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Ledger</label>
                                        <div class="col-sm-4">
                                            <select name="ledger_id" id="ledger_id" class="form-control select2" required>
                                                <option value="">All</option>
                                                @foreach($ledgers as $ledger)
                                                    <option data-ledger_type="{{ $ledger->type }}" value="{{ $ledger->id }}" {{ old('ledger_id') == $ledger->id ? 'selected' : '' }}>{{ $ledger->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <center><button type="button" class="btn btn-success searchBtn">Search</button></center>
                                </form>
                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-body search_html">
                                <center><p>No records found.</p></center>
                            </div>
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
        
        $('.searchBtn').on("click", function() {
            let formData = $("#reportForm").serialize();
            $.ajax({
                url: BASE_URL + 'reports/get_expenses',
                type: 'GET',
                data: formData,
                success: function(response) {
                    // Handle the response, e.g., update the page with the report data
                    // This could be a table or any other format you prefer
                    console.log(response);
                    $(".search_html").html(response.html);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching report:", error);
                }
            });
        });
        
    });
</script>
@endpush