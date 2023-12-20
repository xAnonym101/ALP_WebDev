@extends('layouts.app')

@section('content1')
    <div class="container mt-5">
        <form action="{{ route('storeEvent') }}" method="POST">
            {{-- <form action="#" method="POST"> --}}
            @csrf
            <div class="mb-3">
                <label for="event_name" class="form-label">Event Name</label>
                <input type="event_name" class="form-control" id="event_name" name="event_name"
                    placeholder="Category Name" Required>
            </div>
            @error('event_name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
