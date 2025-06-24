@extends('layouts.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Create New Expense</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create New Expense</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-8">
                        @include('common.alerts')
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('expenses.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Type</label>
                                        <select name="type_id" class="form-control" required>
                                            @foreach($expenseTypes as $type)
                                                <option value="{{ $type->id }}">{{ $type->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Date</label>
                                        <input type="text" name="date" class="form-control datepicker" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Amount</label>
                                        <input type="number" name="amount" class="form-control" step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Create</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
