<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pagetitle }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyUtYm62J/KZ/xW5g7SdFL2KxIMJoG6jB2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-Xd1pE7LEdFvCGRT7wPcGo1tPNUd8bXKhI7Rzo5TC1n2Rn7IDe5I4wBE5ByE02yl2" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyUtYm62J/KZ/xW5g7SdFL2KxIMJoG6jB2" crossorigin="anonymous"></script>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('img/logo-64x64.png') }}">

    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
</head>

<body class=""style=" ;">
    @include('layouts.navigation')

    <div class="container-fluid">
        @yield('layout_content1')
        @yield('layout_content2')
    </div>

    <div class=" overflow-hidden">
        @yield('gbr')
    </div>
    <script>
        $(document).ready(function () {
            $('#imageCarousel').carousel();
        });
    </script>
</body>

<footer class="p-5 mt-5 text-white" style="background-color: rgb(122, 49, 49);">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Links</h5>
                <p><a href="#" class="text-white">best seller</a></p>
                <p><a href="#" class="text-white">sale</a></p>
                <p><a href="#" class="text-white">all products</a></p>
                <p><a href="#" class="text-white">new arrivals</a></p>
                <p><a href="#" class="text-white">about us</a></p>
            </div>
            <div class="col-md-4">
                <h5>About us</h5>
                <p>
                Provided you best clothing and style since 2015! Not only style, jent.collections also provides you fashion with good quality.<br>
                Welcoming you to the family, #jentbabes!❤
                </p>
            </div>
            <div class="col-md-4">
                <h5>Follow Us</h5>
                <p>Stay connected on social media:</p>
                <ul class="list-inline">
                    @foreach ($socials as $social)
                        <li class="list-inline-item">
                            <a href="{{ \Illuminate\Support\Str::startsWith($social->socialmedia_link, ['http://', 'https://']) ? $social->socialmedia_link : 'https://' . $social->socialmedia_link }}" class="text-white">
                                <img src="{{ asset('storage/images/' . $social->socialmedia_icon) }}" alt="{{ $social->socialmedia_name }}" style="width: 30px; height: 30px;">
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <hr class="my-4">
        <div>
            <p class=text-center>
                &copy; 2023 Jent Collections. All rights reserved.
            </p>
        </div>
    </div>
</footer>
