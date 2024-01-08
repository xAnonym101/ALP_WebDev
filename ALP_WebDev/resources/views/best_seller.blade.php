@extends('layouts.template')

@section('layout_content1')

<div class="d-flex justify-content-center align-items-center py-3">
    <form action="/best_seller" method="GET" class="form-inline flex-grow-1 w-25 d-flex gap-2">
        <input class="form-control" type="search" name="search" placeholder="Search">
        <button type="submit" class="btn btn-outline-success">Search</button>
    </form>
</div>

    <div class="row">
        @foreach ($products as $data)
            @if ($data->best_seller)
                <div class="col-md-4 mb-4">
                    <a href="{{ route('products_details', ['id' => $data->product_id]) }}" class="card-link">
                        <div class="card h-100">
                            @foreach ($images as $image)
                                @if ($image->product_id == $data->product_id)
                                    <img src="{{ asset('storage/images/' . $image->image) }}" class="card-img-top mx-auto"
                                        style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $data->product_id }}">
                                @break
                            @endif
                        @endforeach
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $data->product_name }}</h5>
                            <p class="card-text">
                                {{ $data->description }}<br>

                                @if ($data->discount_percent > 0)
                                    @php
                                        $discountedPrice = $data->price - $data->price * ($data->discount_percent / 100);
                                    @endphp
                                    <del>Rp{{ number_format($data->price, 2) }}</del>
                                    Rp{{ number_format($discountedPrice, 2) }}
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $data->discount_percent }}% off
                                @else
                                    Rp{{ number_format($data->price, 2) }}
                                @endif
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endif
    @endforeach
</div>
@endsection
