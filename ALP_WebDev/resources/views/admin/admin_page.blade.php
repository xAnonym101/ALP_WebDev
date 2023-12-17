@extends('layouts.app')

@section('content1')
    <h1 class="d-flex">Products List</h1>
    <div class="form-inline d-flex align-items-center gap-2">
        <form action="/" method="GET" class="form-inline w-25 d-flex gap-2">
            <input class="form-control" type="search" name="search" placeholder="Search">
            <button type="submit" class="btn btn-outline-success">Search</button>
        </form>

        <form method="GET" action="{{ route('createCategory') }}">
            <button class="btn btn-primary btn-block" href="create.blade.php">Make Category</button>
        </form>
        <form method="GET" action="{{ route('createProduct') }}">
            <button class="btn btn-primary" href="create.blade.php">Add Product</button>
        </form>

    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Best Seller</th>
                <th scope="col">Price</th>
                <th scope="col">Discount</th>
                <th scope="col">Final Price</th>
                <th scope="col">Description</th>
                {{-- <th scope="col">Warning</th> --}}
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $data)
                <tr>
                    <td scope="col">{{ $data->product_id }}</td>
                    <td scope="col">{{ $data->product_name }}</td>
                    <td scope="col">
                        @if ($data->best_seller == '0')
                            No
                        @else
                            Yes
                        @endif
                    </td>
                    <td scope="col">Rp{{ $data->price }}</td>
                    <td scope="col">{{ $data->discount_percent }}%</td>
                    <td scope="col">Rp{{ $data->final_price }}</td>
                    <td scope="col">{{ $data->description }}</td>
                    {{-- <td colspan="8" style="color: red;" scope="col">
                        @if (!$image_count && !$variant_count)
                            Image & Variants Missing!
                            @elseif (!$image_count)
                            Image Missing!
                            @elseif (!$variant_count)
                            Variant Missing!
                            @else
                            -
                        @endif
                    </td> --}}
                    <td scope="col">
                        <a href={{route('updateProduct', $data->product_id)}} class="btn btn-primary">Update</a>
                        <a href=# class="btn btn-secondary">Add Variants</a>
                        <a href=# class="btn btn-secondary">Add Images</a>

                        <form action="{{route('deleteProduct', $data->product_id)}}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
