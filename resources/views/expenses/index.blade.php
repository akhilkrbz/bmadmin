@extends('layouts.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Expenses List</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Expenses List</li>
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
                                <h3 class="card-title">Expenses List</h3>
                                <a href="{{ route('expenses.create') }}" class="btn btn-primary float-end">Add Expense</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl.No.</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <!-- <th>Created By</th> -->
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($expenses as $key => $expense)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ optional($expense->expenseType)->title }}</td>
                                                <td>{{ date('d-m-Y', strtotime($expense->date)) }}</td>
                                                <td>{{ $expense->amount }}</td>
                                                <td>{{ $expense->description }}</td>
                                                <!-- <td>{{ $expense->created_by }}</td> -->
                                                <td>
                                                    <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-primary btn-sm">Edit</a>
                                                    <form action="{{ route('expenses.destroy', $expense) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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
                                    <li class="page-item {{ $expenses->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $expenses->previousPageUrl() ?? '#' }}" tabindex="-1">«</a>
                                    </li>
                                    {{-- Pagination Elements --}}
                                    @for ($page = 1; $page <= $expenses->lastPage(); $page++)
                                        <li class="page-item {{ $expenses->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $expenses->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endfor
                                    {{-- Next Page Link --}}
                                    <li class="page-item {{ $expenses->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $expenses->nextPageUrl() ?? '#' }}">»</a>
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
