@extends('layouts.app')

@section('content1')
    <div class="mt-5">
        <div class="form-inline d-flex align-items-center gap-2">
            <form action="/" method="GET" class="form-inline flex-grow-1 w-25 d-flex gap-2">
                <input class="form-control" type="search" name="search" placeholder="Search">
                <button type="submit" class="btn btn-outline-success">Search</button>
            </form>

            <form method="GET" action="{{ route('createCategory') }}">
                <button class="btn btn-primary btn-block" href="create.blade.php">Make Category</button>
            </form>
            @if (isset($categories))
                <form method="GET" action="{{ route('createProduct') }}">
                    <button class="btn btn-primary" href="create.blade.php">Create Product</button>
                </form>
            @endif
            <form method="GET" action="{{ route('createEvent') }}">
                <button class="btn btn-primary" href="create.blade.php">Create Event</button>
            </form>
            <form method="GET" action="{{ route('createPhone') }}">
                <button class="btn btn-primary" href="create.blade.php">Add Phone Number</button>
            </form>
            <form method="GET" action="{{ route('createSocial') }}">
                <button class="btn btn-primary" href="create.blade.php">Add Social Media</button>
            </form>
        </div>

        <br>

        {{-- Warning!  --}}
        <div>
            <div>
                @if (count($categories) == 0)
                    <div class="alert alert-warning" role="alert">
                        <strong>Warning:</strong> Missing category. Create a category to access "Add Product".
                    </div>
                @endif
            </div>

            <div>
                @if (count($events) == 0)
                    <div class="alert alert-info" role="alert">
                        <strong>Info:</strong> No events found!
                    </div>
                @endif
            </div>
        </div>


        {{-- Empty Slot Filler  --}}
        @php
            // Calculate the number of items needed to fill a page
            $productsCount = 8;
            $productsEmpty = $productsCount - (count($products) % $productsCount);

            $categoriesCount = 3;
            $categoriesEmpty = $categoriesCount - (count($categories) % $categoriesCount);

            $eventsCount = 3;
            $eventsEmpty = $eventsCount - (count($events) % $eventsCount);

            $phonesCount = 3;
            $phonesEmpty = $phonesCount - (count($phones) % $phonesCount);

            $socialsCount = 3;
            $socialsEmpty = $socialsCount - (count($socials) % $socialsCount);

        @endphp

        {{-- Product List  --}}
        <div class="row">
            <div class="col-md-12">
                <p>Products List</p>
                <table class="table">
                    <thead>
                        <tr style="height: 50px;">
                            <th scope="col">ID</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Best Seller</th>
                            <th scope="col">Has Event</th>
                            <th scope="col">Price</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Final Price</th>
                            <th scope="col">Description</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $data)
                            <tr style="height: 50px;">
                                <td>{{ $data->product_id }}</td>
                                <td>{{ $data->product_name }}</td>
                                <td>
                                    @if ($data->best_seller == '0')
                                        No
                                    @else
                                        Yes
                                    @endif
                                </td>
                                <td>
                                    @foreach ($events as $name)
                                        @if ($data->event_id == $name->event_id)
                                            {{ $name->event_name }}
                                        @endif
                                    @endforeach
                                    @if ($data->event_id == 0)
                                        None
                                    @endif
                                </td>
                                <td>Rp{{ $data->price }}</td>
                                <td>{{ $data->discount_percent }}%</td>
                                <td>Rp{{ $data->final_price }}</td>
                                <td>{{ $data->description }}</td>
                                <td>
                                    <a href="{{ route('updateProduct', $data->product_id) }}" class="btn btn-primary">Update</a>

                                    <form action="{{ route('deleteProduct', $data->product_id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if ($productsEmpty < 8)
                            @for ($i = 0; $i < $productsEmpty; $i++)
                                <tr style="height: 50px;">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            @endfor
                        @elseif (count($products) == 0)
                            @for ($i = 0; $i < 8; $i++)
                                <tr style="height: 50px;">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            @endfor
                        @endif
                    </tbody>
                </table>
                <div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>

        <br>
        <br>

        {{-- Categories and Events List  --}}
        <div class="row">
            <div class="col-md-6">
                <p>Category List</p>
                <table class="table">
                    <thead>
                        <tr style="height: 50px;">
                            <th scope="col">ID</th>
                            <th scope="col">Category Name</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($categories))
                            @foreach ($categories as $data)
                                <tr style="height: 50px;">
                                    <td scope="col">{{ $data->category_id }}</td>
                                    <td scope="col">{{ $data->category_name }}</td>
                                    <td>
                                        <a href={{ route('updateCategory', $data->category_id) }}
                                            class="btn btn-primary">Update</a>
                                        <form action="{{ route('deleteCategory', $data->category_id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        @if ($categoriesEmpty < 3)
                            @for ($i = 0; $i < $categoriesEmpty; $i++)
                                <tr style="height: 50px;">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            @endfor
                        @elseif (count($categories) == 0)
                            @for ($i = 0; $i < 3; $i++)
                                <tr style="height: 50px;">
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            @endfor
                        @endif
                    </tbody>
                </table>
                <div>
                    {{ $categories->links() }}
                </div>
            </div>

            <div class="col-md-6">
                <p>Event List</p>
                <table class="table">
                    <thead>
                        <tr style="height: 50px;">
                            <th scope="col">ID</th>
                            <th scope="col">Event Name</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($events))
                            @foreach ($events as $data)
                                <tr style="height: 50px;">
                                    <td scope="col">{{ $data->event_id }}</td>
                                    <td scope="col">{{ $data->event_name }}</td>
                                    <td scope="col">
                                        @if ($data->status == '0')
                                            Suspended/Ended
                                        @else
                                            Ongoing
                                        @endif
                                    </td>
                                    <td>
                                        <a href={{ route('updateEvent', $data->event_id) }} class="btn btn-primary">Update</a>
                                        <form action="{{ route('deleteEvent', $data->event_id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($eventsEmpty < 3)
                                @for ($i = 0; $i < $eventsEmpty; $i++)
                                    <tr style="height: 50px;">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                @endfor
                            @elseif (count($events) == 0)
                                @for ($i = 0; $i < 3; $i++)
                                    <tr style="height: 50px;">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                @endfor
                            @endif
                        @endif
                    </tbody>
                </table>
                <div>
                    {{ $events->links() }}
                </div>
            </div>
        </div>

        <br>

        {{-- Phones and Socialmedia List  --}}
        <div class="row">
            <div class="col-md-6">
                <p>Phone Number</p>
                <table class="table">
                    <thead>
                        <tr style="height: 50px;">
                            <th scope="col">ID</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($phones))
                            @foreach ($phones as $data)
                                <tr style="height: 50px;">
                                    <td scope="col">{{ $data->phone_id }}</td>
                                    <td scope="col">{{ $data->phone_number }}</td>
                                    <td>
                                        <a href={{ route('updatePhone', $data->phone_id) }} class="btn btn-primary">Update</a>
                                        <form action="{{ route('deletePhone', $data->phone_id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($phonesEmpty < 3)
                                @for ($i = 0; $i < $phonesEmpty; $i++)
                                    <tr style="height: 50px;">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                @endfor
                            @elseif (count($phones) == 0)
                                @for ($i = 0; $i < 3; $i++)
                                    <tr style="height: 50px;">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                @endfor
                            @endif
                        @endif
                    </tbody>
                </table>
                <div>
                    {{ $phones->links() }}
                </div>
            </div>

            <div class="col-md-6">
                <p>Socialmedia List</p>
                <table class="table">
                    <thead>
                        <tr style="height: 50px;">
                            <th scope="col">ID</th>
                            <th scope="col">Social Media Name</th>
                            <th scope="col">Social Media Link</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($socials))
                            @foreach ($socials as $data)
                                <tr style="height: 50px;">
                                    <td scope="col">{{ $data->social_id }}</td>
                                    <td scope="col">{{ $data->socialmedia_name }}</td>
                                    <td scope="col">{{ $data->socialmedia_link }}</td>
                                    <td>
                                        <a href={{ route('updateSocial', $data->social_id) }}
                                            class="btn btn-primary">Update</a>
                                        <form action="{{ route('deleteSocial', $data->social_id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($socialsEmpty < 3)
                                @for ($i = 0; $i < $socialsEmpty; $i++)
                                    <tr style="height: 50px;">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                @endfor
                            @elseif (count($socials) == 0)
                                @for ($i = 0; $i < 3; $i++)
                                    <tr style="height: 50px;">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                @endfor
                            @endif
                        @endif
                    </tbody>
                </table>
                <div>
                    {{ $socials->links() }}
                </div>
            </div>
        </div>

        <br>

    </div>

@endsection
