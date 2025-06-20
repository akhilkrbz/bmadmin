@extends('layouts.app')
@section('content')
    <h1>Bed Details</h1>
    <p><strong>ID:</strong> {{ $bed->id }}</p>
    <p><strong>Date of Bed:</strong> {{ $bed->date_of_bed }}</p>
    <p><strong>No of Beds:</strong> {{ $bed->no_of_beds }}</p>
    <p><strong>Description:</strong> {{ $bed->description }}</p>
    <p><strong>Created By:</strong> {{ $bed->created_by }}</p>
    <a href="{{ route('beds.index') }}">Back to List</a>
@endsection
