@extends('layouts.app')
@section('content')
    <h1>Harvest Details</h1>
    <p><strong>ID:</strong> {{ $harvest->id }}</p>
    <p><strong>Date:</strong> {{ $harvest->harvest_date }}</p>
    <p><strong>Total Quantity:</strong> {{ $harvest->total_harvest_quantity }}</p>
    <p><strong>Description:</strong> {{ $harvest->description }}</p>
    <p><strong>Created By:</strong> {{ optional($harvest->creator)->name }}</p>
    <p><strong>Beds:</strong>
        @foreach($harvest->beds as $bed)
            {{ optional($bed->bed)->id }}@if(!$loop->last), @endif
        @endforeach
    </p>
    <a href="{{ route('harvest.index') }}">Back to List</a>
@endsection
