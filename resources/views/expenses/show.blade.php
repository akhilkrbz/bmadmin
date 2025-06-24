@extends('layouts.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Expense Details</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Expense Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <p><strong>ID:</strong> {{ $expense->id }}</p>
                                <p><strong>Type:</strong> {{ optional($expense->expenseType)->title }}</p>
                                <p><strong>Date:</strong> {{ $expense->date }}</p>
                                <p><strong>Amount:</strong> {{ $expense->amount }}</p>
                                <p><strong>Description:</strong> {{ $expense->description }}</p>
                                <p><strong>Created By:</strong> {{ $expense->created_by }}</p>
                                <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Back to List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
