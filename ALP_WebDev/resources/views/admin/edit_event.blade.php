@extends('layouts.app')

@section('content1')
    <div class="container mt-5">
        <form action="{{ route('saveEvent', $event->event_id) }}" method="POST">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="event_name" class="form-label">Event Name</label>
                <input type="event_name" class="form-control" id="event_name" name="event_name" value="{{$event->event_name}}"
                    placeholder="event Name" Required>
            </div>
            @error('event_name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
