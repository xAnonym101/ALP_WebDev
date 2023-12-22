@extends('layouts.template')

@section('layout_content1')
<div class="row">
        <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @foreach ($images as $image)
                        @if ($image->product_id == $products->product_id)
                            <img src="{{ asset('storage/images/' . $image->image) }}" class="card-img-top mx-auto"
                                style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $products->product_id }}">
                        @endif
                    @endforeach
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $products->product_name }}</h5>
                        <p class="card-text">
                            {{ $products->description }}<br>
                            @php
                                $discountedPrice = $products->price - $products->price * ($products->discount_percent / 100);
                            @endphp
                            Rp{{ number_format($discountedPrice, 2) }}
                            <del>Rp{{ number_format($products->price, 2) }}</del>
                        </p>
                    </div>
                </div>
        </div>
</div>
@endsection
