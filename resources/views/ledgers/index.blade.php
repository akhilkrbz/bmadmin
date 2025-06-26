@extends('layouts.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Ledger List</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ledger List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('common.alerts')
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Ledger List</h3>
                                <a href="{{ route('ledgers.create') }}" class="btn btn-primary float-end">Add Ledger</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl.No.</th>
                                            <th>Type</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ledgers as $key => $ledger)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $ledger->type }}</td>
                                                <td>{{ $ledger->title }}</td>
                                                <td>{{ $ledger->description }}</td>
                                                <td>
                                                    <a href="{{ route('ledgers.edit', $ledger) }}" class="btn btn-primary btn-sm">Edit</a>
                                                    <form action="{{ route('ledgers.destroy', $ledger) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button disabled type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    {{-- Previous Page Link --}}
                                    <li class="page-item {{ $ledgers->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $ledgers->previousPageUrl() ?? '#' }}" tabindex="-1">«</a>
                                    </li>
                                    {{-- Pagination Elements --}}
                                    @for ($page = 1; $page <= $ledgers->lastPage(); $page++)
                                        <li class="page-item {{ $ledgers->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $ledgers->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endfor
                                    {{-- Next Page Link --}}
                                    <li class="page-item {{ $ledgers->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $ledgers->nextPageUrl() ?? '#' }}">»</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
