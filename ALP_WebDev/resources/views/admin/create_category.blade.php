@extends('layouts.app')

@section('content1')
    <div class="container mt-5">
        <form action="{{ route('storeCategory') }}" method="POST">
            {{-- <form action="#" method="POST"> --}}
            @csrf
            <div class="mb-3">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="category_name" class="form-control" id="category_name" name="category_name"
                    placeholder="Category Name" Required>
            </div>
            @error('category_name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
