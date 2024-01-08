@extends('layouts.template')

@section('layout_content0')
    <div class="container text-center mb-4">
        <hr class="my-1">
        <h2 class="mb-1">Best Seller</h2>
        <hr class="my-1">
    </div>
    <div class="row flex-nowrap">
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
<div class="centered-button-container">
    <a href="{{ route('bestseller') }}" class="centered-button text-white">View all</a>
</div>
@endsection

@section('layout_content1')
@foreach ($events as $event)
    @if ($event->status != '0')
        <div class="red-background-container">
            <div class="container text-center mb-4">
                <hr class="my-1">
                <h2 class="mb-1 text-white">{{ $event->event_name }}</h2>
                <hr class="my-1">
            </div>
            <div class="row flex-nowrap">
                @foreach ($products as $data)
                    @if ($data->event_id == $event->event_id)
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('products_details', ['id' => $data->product_id]) }}" class="card-link">
                                <div class="card h-100">
                                    @foreach ($images as $image)
                                        @if ($image->product_id == $data->product_id)
                                            <img src="{{ asset('storage/images/' . $image->image) }}"
                                                class="card-img-top mx-auto"
                                                style="width: 100%; height: 100%; object-fit: cover;"
                                                alt="{{ $data->product_id }}">
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
        <div class="centered-button-container">
            <div class="centered-button-container">
                <a href="{{ route('event', ['id' => $event->event_id]) }}" class="centered-button text-white">View
                    all</a>
            </div>
        </div>
    </div>
@endif
<br>
@endforeach
@endsection


@section('layout_content2')
@if ($data->discount_percent >= 30)
<div class="container text-center mb-4">
    <hr class="my-1">
    <h2 class="mb-1">sale</h2>
    <hr class="my-1">
</div>
<div class="row flex-nowrap">
    @foreach ($products as $data)
        <div class="col-md-4 mb-4">
            <a href="{{ route('products_details', ['id' => $data->product_id]) }}" class="card-link">
                <div class="card h-100">
                    @foreach ($images as $image)
                        @if ($image->product_id == $data->product_id)
                            <img src="{{ asset('storage/images/' . $image->image) }}" class="card-img-top mx-auto"
                                style="width: 100%; height: 100%; object-fit: cover;"
                                alt="{{ $data->product_id }}">
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
@endforeach
</div>
<div class="centered-button-container">
<a href="{{ route('sale') }}" class="centered-button text-white">View all</a>
</div>
@endif
@endsection
