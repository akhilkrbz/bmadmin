@extends('layouts.app')
@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Update Harvest Details</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Harvest Details</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row g-4">
                    <!--begin::Col-->
                    <!-- <div class="col-12">
                        <div class="callout callout-info">
                            For detailed documentation of Form visit
                            <a href="https://getbootstrap.com/docs/5.3/forms/overview/" target="_blank"
                                rel="noopener noreferrer" class="callout-link">
                                Bootstrap Form
                            </a>
                        </div>
                    </div> -->

                    


                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-10">

                        @include('common.alerts')
                        
                        <!--begin::Horizontal Form-->
                        <div class="card card-warning card-outline mb-4">
                            <!--begin::Header-->
                            <div class="card-header">
                                <div class="card-title">Update Harvest Details</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <form action="{{ route('harvest.update', $harvest) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <!--begin::Body-->
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Date of Bed</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="harvest_date" required class="form-control datepicker" value="{{ date('d-m-Y', strtotime($harvest->harvest_date)) }}" id="harvest_date" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">No. of beds</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="total_harvest_quantity" required class="form-control" id="total_harvest_quantity" value="{{ $harvest->total_harvest_quantity }}"/>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Beds</label>
                                        <div class="col-sm-10">
                                            <select class="form-select select2" id="bed_ids" name="bed_ids[]" required="" multiple>
                                                <option selected="" disabled="" value="">Choose the dates of beds</option>
                                                @foreach($beds as $bed)
                                                    <option value="{{ $bed->id }}" {{ in_array($bed->id, $harvest->beds->pluck('bed_id')->toArray()) ? 'selected' : '' }}>{{ date('d-m-Y', strtotime($bed->date_of_bed)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" class="form-control" id="inputPassword3">{{ $harvest->description }}</textarea>
                                        </div>
                                    </div>
                                    
                                </div>
                                <!--end::Body-->
                                <!--begin::Footer-->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning">Update</button>
                                    <button type="button" class="btn float-end">Cancel</button>
                                </div>
                                <!--end::Footer-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Horizontal Form-->
                    </div>
                    <!--end::Col-->
                    
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
@endsection