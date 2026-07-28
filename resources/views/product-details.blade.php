<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $product->name }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

<header class="navbar">

    <div class="brand">
        Essence of the Middle East
    </div>

    <nav class="nav-links">

        <a href="{{ url('/')}}">
            Home
        </a>

        <a href="{{ url('/catalog') }}">
            Collection
        </a>

    </nav>

</header>

<section class="hero-section">

    <div class="overlay"></div>

    <div class="hero-content">

        <h3>PRODUCT DETAILS</h3>

        <p>
            Discover the elegance of
            <span>
                {{ $product->name }}
            </span>
        </p>

    </div>



<div class="container py-5">

    <div class="row align-items-center">

        <div class="col-lg-5">

            <img
                src="{{ asset('images/' . $product->image) }}"
                alt="{{ $product->name }}"
                class="img-fluid rounded shadow">

        </div>

        <div class="col-lg-7">

            <h1>
                {{ $product->name }}
            </h1>

            <h4 class="text-warning">
                R{{ number_format($product->price,2) }}
            </h4>

            <p>
                {{ $product->description }}
            </p>

            <hr>

            <p>
                <strong>Category:</strong>
                {{ $product->category }}
            </p>

            <p>
                <strong>Collection:</strong>
                {{ $product->collection }}
            </p>

            <p>
                <strong>Top Notes:</strong>
                {{ $product->top_notes }}
            </p>

            <p>
                <strong>Longevity:</strong>
                {{ $product->longevity }}
            </p>

            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button class="btn btn-dark">
                    Add to Cart
                </button>
            </form>

            <a href="{{ url('/catalog') }}"
               class="btn btn-outline-secondary mt-3">

                ← Back to Collection
            </a>

        </div>
    </div>
</div>

</section>
</body>

</html>