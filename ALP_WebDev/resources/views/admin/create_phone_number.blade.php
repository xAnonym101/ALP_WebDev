@extends('layouts.app')

@section('content1')
    <div class="container mt-5">
        <form action="{{ route('storePhone') }}" method="POST">
            {{-- <form action="#" method="POST"> --}}
            @csrf
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="phone_number" class="form-control" id="phone_number" name="phone_number"
                    placeholder="Phone Number" Required>
            </div>
            @error('phone_number')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
