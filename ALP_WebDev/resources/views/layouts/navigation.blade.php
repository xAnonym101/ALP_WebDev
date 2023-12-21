<nav class="navbar navbar-expand-lg justify-content-center" style="background-color: rgb(122, 49, 49);">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto text-center">
                <li>
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('img/logo.png') }}" alt="logo" class="img-fluid" style="max-height: 40px;"">
                        Jent Collections
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </li>
            </ul>

        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg justify-content-center" style="background-color: rgb(122, 49, 49);">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto text-center">
                <li class="nav-item">
                    <a class="nav-link {{ $Home ?? '' }}" aria-current="page" href="/home">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ $all_products ?? '' }}" href="/all_products">all products</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ $new_arrival ?? '' }}" href="/new_arrival">new arrival</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $sale ?? '' }}" href="/sale">sale</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $best_seller ?? '' }}" href="/best_seller">best seller</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $about_us ?? '' }}" href="/about_us">About us</a>
                </li>

        </div>
    </div>
</nav>
