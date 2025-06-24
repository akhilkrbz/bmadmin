@extends('layouts.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Update Expense Type</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Expense Type</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-10">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('expense-types.update', $expenseType) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label>Type</label>
                                        <select name="type" class="form-control" required>
                                            <option value="direct" {{ $expenseType->type == 'direct' ? 'selected' : '' }}>Direct
                                            </option>
                                            <option value="indirect" {{ $expenseType->type == 'indirect' ? 'selected' : '' }}>Indirect
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $expenseType->title }}" required>
                                    </div>
                                    <!-- <div class="mb-3"> -->
                                        <!-- <label>Status</label> -->
                                        <input type="hidden" name="status" class="form-control"
                                            value="{{ $expenseType->status }}" required>
                                    <!-- </div> -->
                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
