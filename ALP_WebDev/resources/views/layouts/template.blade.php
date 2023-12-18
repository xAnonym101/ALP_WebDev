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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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

</body>
<footer class="p-5 mt-5" style="background-color: rgb(122, 49, 49);">
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
                <h5>Contact Information</h5>
                <p>Email: main_branch@example.com</p>
                <p>Phone: 333-444-5555</p>
                <p>Address: Main Street, City A</p>
            </div>
            <div class="col-md-4">
                <h5>Follow Us</h5>
                <p>Stay connected on social media:</p>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#" class="text-white">Facebook</a></li>
                    <li class="list-inline-item"><a href="#" class="text-white">Twitter</a></li>
                    <li class="list-inline-item"><a href="#" class="text-white">Instagram</a></li>
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
