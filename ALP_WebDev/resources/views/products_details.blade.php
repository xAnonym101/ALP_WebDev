@extends('layouts.template')

@section('layout_content1')
    <div class="container">
        <div class="row pt-5">
            <div class="col mb-4">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach ($images as $key => $item)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }} pb-5">
                                <img src="{{ asset('storage/images/' . $item->image) }}" class="card-img-top mx-auto"
                                    style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $products->product_id }}">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col mb-4 pt-3">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $products->product_name }}</h5>
                    <p class="card-text">
                        <strong>Description:</strong> {{ $products->description }}<br>

                        @if ($products->discount_percent > 0)
                            <strong>Discount:</strong> {{ $products->discount_percent }}%<br>

                            @php
                                $discountedPrice = $products->price - $products->price * ($products->discount_percent / 100);
                            @endphp
                            <del>Rp{{ number_format($products->price, 2) }}</del>
                            Rp{{ number_format($discountedPrice, 2) }}
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $products->discount_percent }}% off
                        @else
                            Rp{{ number_format($products->price, 2) }}
                        @endif
                    </p>
                    <a href="{{ $products->link }}" class="btn btn-primary mt-auto text-white"
                        style="background-color: rgb(122, 49, 49)">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
@endsection
