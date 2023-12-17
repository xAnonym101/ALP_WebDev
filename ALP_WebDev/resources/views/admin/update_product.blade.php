@extends('layouts.app')

@section('content1')
    <div class="container mt-5">
        <form action="{{ route('saveUpdate', $toEdit->product_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="product_name" class="form-label">Product name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name"
                    value="{{ $toEdit->product_name }}" Required>
            </div>
            <div class="mb-3">
                <label for="best_seller" class="form-label">Best Seller</label>
                <select name="best_seller" id="best_seller" Required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="price"
                    value="{{ $toEdit->price }}"Required>
            </div>
            <div class="mb-3">
                <label for="discount_percent" class="form-label">Discount</label>
                <input type="text" class="form-control" id="discount_percent" name="discount_percent" placeholder="Discount Percent"
                    value="{{ $toEdit->discount_percent }}" Required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="description"
                    value="{{ $toEdit->description }}" Required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" Required>
                    @foreach ($categories as $option)
                        @if (old('category_id', $toEdit->category_id) === $option->category_id)
                            <option value="{{ $option->category_id }}" selected>{{ $option->category_name }}</option>
                        @else
                            <option value="{{ $option->category_id }}">{{ $option->category_name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
