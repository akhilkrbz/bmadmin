@extends('layouts.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Update Ledger</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Ledger</li>
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
                                <form action="{{ route('ledgers.update', $ledger) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label>Type</label>
                                        <select name="type" class="form-control" required>
                                            <option value="direct" {{ $ledger->type == 'direct' ? 'selected' : '' }}>Direct
                                            </option>
                                            <option value="indirect" {{ $ledger->type == 'indirect' ? 'selected' : '' }}>Indirect
                                            </option>
                                            <option value="customer" {{ $ledger->type == 'customer' ? 'selected' : '' }}>Customer
                                            </option>
                                            <option value="shop" {{ $ledger->type == 'shop' ? 'selected' : '' }}>Shop
                                            </option>
                                            <option value="supplier" {{ $ledger->type == 'supplier' ? 'selected' : '' }}>Supplier
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $ledger->title }}" required>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" class="form-control" id="inputPassword3">{{ $ledger->description }}</textarea>
                                        </div>
                                    </div>
                                    <!-- <div class="mb-3"> -->
                                        <!-- <label>Status</label> -->
                                        <input type="hidden" name="status" class="form-control"
                                            value="{{ $ledger->status }}" required>
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
