@extends('layouts.template')

@section('layout_content1')
    <div class="row">
        @foreach ($products->sortByDesc('created_at') as $data)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @foreach ($images as $image)
                        @if ($image->product_id == $data->product_id)
                            <img src="{{ asset('storage/images/' . $image->image) }}" class="card-img-top mx-auto"
                                style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $data->product_id }}">
                        @endif
                    @endforeach
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $data->product_name }}</h5>
                        <p class="card-text">
                            {{ $data->description }}<br>
                            @php
                                $discountedPrice = $data->price - $data->price * ($data->discount_percent / 100);
                            @endphp
                            Rp{{ number_format($discountedPrice, 2) }}
                            <del>Rp{{ number_format($data->price, 2) }}</del>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
