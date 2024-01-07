<nav class="navbar navbar-expand-lg justify-content-center" style="background-color: rgb(122, 49, 49);">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto text-center">
                <li>
                    <a class="navbar-brand text-white" href="/">
                        <img src="{{ asset('img/logo.png') }}" alt="logo" class="img-fluid" style="max-height: 40px;">
                        Jent Collections
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(122, 49, 49);">
    <div class="container-fluid d-flex justify-content-between">
        <button class="navbar-toggler mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto text-center">
                <li class="nav-item">
                    <a class="nav-link {{ $Home ?? '' }}" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li class="nav-item">
                            <a class="nav-link text-black {{ $all_products ?? '' }}" href="/all_products">All Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black {{ $new_arrival ?? '' }}" href="/new_arrival">New Arrival</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black {{ $sale ?? '' }}" href="/sale">Sale</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $best_seller ?? '' }}" href="/best_seller">Best Seller</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

