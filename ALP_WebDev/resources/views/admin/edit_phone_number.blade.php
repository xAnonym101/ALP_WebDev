@extends('layouts.app')

@section('content1')
    <div class="container mt-5">
        <form action="{{ route('savePhone', $phone->phone_id) }}" method="POST">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{$phone->phone_number}}"
                    placeholder="Phone Number" Required>
            </div>
            @error('phone_id')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <input type="hidden" class="form-control" id="phone_id" name="phone_id" value="{{$phone->phone_id}}">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
