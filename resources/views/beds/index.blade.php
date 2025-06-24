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
                        <h3 class="mb-0">Beds List</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Beds List</li>
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
                                <h3 class="card-title">Beds List</h3>
                                <button type="button" class="btn btn-success position-relative float-end">
                                    {{ $total_beds }}
                                    
                                </button>
                                <button type="button" class="btn btn-default position-relative float-end me-2">
                                    <b>Total Beds: </b>
                                    
                                </button>
                                
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl.No.</th>
                                            <th>Date of Bed</th>
                                            <th>No of Beds</th>
                                            <th>Description</th>
                                            <!-- <th>Created By</th> -->
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_beds = $beds->sum('no_of_beds');
                                            $total_beds = $total_beds ? $total_beds : 0;
                                        @endphp
                                        @foreach($beds as $key => $bed)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ date('d-m-Y', strtotime($bed->date_of_bed)) }}</td>
                                                <td>{{ $bed->no_of_beds }}</td>
                                                <td>{{ $bed->description }}</td>
                                                <!-- <td>{{ $bed->created_by }}</td> -->
                                                <td>
                                                    <a href="{{ route('beds.edit', $bed) }}"><button type="button" class="btn btn-primary mb-2">Edit</button></a>
                                                    
                                                    <form action="{{ route('beds.destroy', $bed) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" disabled class="btn btn-danger mb-2"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th colspan="2" class="text-end">Total Beds:</th>
                                            <th>{{ $total_beds }}</th>
                                            <th colspan="2"></th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                            <!-- /.card-body -->
                            <!-- <div class="card-footer clearfix">
                                {{-- Laravel pagination links --}}
                                <div class="d-flex justify-content-end">
                                    {{ $beds->links() }}
                                </div>
                            </div> -->

                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    {{-- Previous Page Link --}}
                                    <li class="page-item {{ $beds->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $beds->previousPageUrl() ?? '#' }}" tabindex="-1">«</a>
                                    </li>

                                    {{-- Pagination Elements --}}
                                    @for ($page = 1; $page <= $beds->lastPage(); $page++)
                                        <li class="page-item {{ $beds->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $beds->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endfor

                                    {{-- Next Page Link --}}
                                    <li class="page-item {{ $beds->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $beds->nextPageUrl() ?? '#' }}">»</a>
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