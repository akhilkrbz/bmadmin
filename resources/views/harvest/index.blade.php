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
                        <h3 class="mb-0">Harvest List</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Harvest List</li>
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
                <div class="row">

                    <div class="col-md-12">
                        @include('common.alerts')
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Harvest List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl.No.</th>
                                            <th>Date</th>
                                            <th>Total Quantity (In KG)</th>
                                            <th>Description</th>
                                            <!-- <th>Created By</th> -->
                                            <th>Beds From</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($harvests as $key => $harvest)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ date('d-m-Y', strtotime($harvest->harvest_date)) }}</td>
                                                <td>{{ $harvest->total_harvest_quantity }}</td>
                                                <td>{{ $harvest->description }}</td>
                                                <!-- <td>{{ optional($harvest->creator)->name }}</td> -->
                                                <td>
                                                    @foreach($harvest->beds as $bed)
                                                        {{ date('d-m-Y', strtotime(optional($bed->bed)->date_of_bed)) }}@if(!$loop->last), @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ route('harvest.edit', $harvest) }}"><button type="button"
                                                            class="btn btn-primary mb-2">Edit</button></a>
                                                    <form action="{{ route('harvest.destroy', $harvest) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mb-2"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    

                                </table>
                            </div>
                            <!-- /.card-body -->
                            <!-- <div class="card-footer clearfix">
                                        {{-- Laravel pagination links --}}
                                        <div class="d-flex justify-content-end">
                                            {{ $harvests->links() }}
                                        </div>
                                    </div> -->

                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    {{-- Previous Page Link --}}
                                    <li class="page-item {{ $harvests->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $harvests->previousPageUrl() ?? '#' }}"
                                            tabindex="-1">«</a>
                                    </li>

                                    {{-- Pagination Elements --}}
                                    @for ($page = 1; $page <= $harvests->lastPage(); $page++)
                                        <li class="page-item {{ $harvests->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $harvests->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endfor

                                    {{-- Next Page Link --}}
                                    <li class="page-item {{ $harvests->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $harvests->nextPageUrl() ?? '#' }}">»</a>
                                    </li>
                                </ul>
                            </div>


                        </div>

                    </div>

                    <!-- /.col -->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
@endsection