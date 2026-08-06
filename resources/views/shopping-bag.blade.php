
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shopping Bag</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


  <style>
    body {
      background: linear-gradient(to bottom, #050505, #0d0d0d);
      color: #d3d3d3;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 16px;
    }

    h2, h3, h4, h5 {
      color: #d6ae73;
      font-weight: bold;
      text-shadow: 0 0 8px rgba(214, 174, 115, 0.5);
    }

    .card {
      background: linear-gradient(145deg, #1f1f1f, #0d0d0d);
      border: 1px solid #c79a5b;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(199, 154, 91, 0.25);
      color: #f5f5f5;
    }

    .card h5 {
      color: #d6ae73;
      font-size: 1.3rem;
      font-weight: bold;
      text-shadow: 0 0 10px rgba(214, 174, 115, 0.8);
      letter-spacing: 1px;
    }

    .card p {
      color: #cfcfcf;
      font-size: 15px;
      font-weight: 500;
    }

    .btn-checkout {
      background-color: #c79a5b;
      color: #050505;
      border: none;
      font-weight: bold;
    }

    .btn-checkout:hover {
      background-color: #d6ae73;
      color: black;
    }

    .btn-add {
      background-color: #c79a5b;
      color: #050505;
      border: none;
      font-weight: bold;
    }

    .btn-add:hover {
      background-color: #d6ae73;
      color: black;
    }

    .qty-btn {
      background-color: #1f1f1f;
      color: #d6ae73;
      border: 1px solid #c79a5b;
      padding: 5px 12px;
      border-radius: 5px;
      font-weight: bold;
    }

    .qty-btn:hover {
      background-color: #c79a5b;
      color: black;
    }

    .list-group-item {
      background-color: #1f1f1f !important;
      color: #f5f5f5 !important;
      border: 1px solid #c79a5b !important;
      font-weight: 600;
    }

    #orderTotal,
    #tax,
    #grandTotal {
      color: #d6ae73 !important;
      font-weight: bold;
      text-shadow: 0 0 8px rgba(214, 174, 115, 0.5);
    }

    span[id^="qty-"] {
      color: #ffffff;
      font-weight: bold;
      font-size: 18px;
      margin: 0 10px;
    }

    :root{
      --gold:#c79a5b;
      --soft-gold:#d6ae73;
      --dark:#050505;
    }

    .navbar{
      background: rgba(0,0,0,0.6);
      backdrop-filter: blur(10px);
      padding: 20px 0;
      border-bottom: 1px solid rgba(199,154,91,0.3);
    }

    .navbar-brand{
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.8rem;
      letter-spacing: 3px;
      color: var(--soft-gold);
      font-weight: 600;
    }

    .navbar-brand:hover{
      color: var(--gold);
    }

    .nav-link{
      color: #d3d3d3;
      margin-left: 20px;
      transition: 0.3s;
      font-weight: 500;
    }

    .nav-link:hover{
      color: var(--soft-gold);
    }
  </style>
</head>

<body class="container py-5">

<nav class="navbar navbar-expand-lg mb-5">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            ESSENCE OF THE MIDDLE EAST
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ url('/') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ url('/catalog') }}">
                        Collection
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('cart.index') }}">
                        Shopping Bag
                    </a>
                </li>

            </ul>

        </div>

    </div>
</nav>

  <h2 class="text-center mb-5">
    Shopping Bag
</h2>
<div class="row">

@php
    $subtotal = 0;
@endphp

@forelse($cartItems as $item)

@php
    $lineTotal = $item->product->price * $item->quantity;
    $subtotal += $lineTotal;
@endphp

<div class="col-lg-12 mb-4">
    <div class="card p-3">
        <div class="row align-items-center">
            <div class="col-md-2">
                <img
                    src="{{ asset('images/'.$item->product->image) }}"
                    class="img-fluid rounded"
                    alt="{{ $item->product->name }}">
            </div>

            <div class="col-md-3">
                <h5>{{ $item->product->name }}</h5>

                <p>
                    {{ $item->product->category }}
                </p>
                <p>
                    {{ $item->product->longevity }}
                </p>
            </div>

            <div class="col-md-2">

                <strong>
                    R{{ number_format($item->product->price,2) }}
                </strong>

            </div>

            <div class="col-md-3">

                <div class="d-flex align-items-center">

                    <form action="{{ route('cart.decrease',$item) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <button type="submit" class="qty-btn">
                            -
                        </button>
                    </form>

                    <span class="mx-3 fw-bold">
                        {{ $item->quantity }}
                    </span>

                    <form action="{{ route('cart.increase',$item) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <button type="submit" class="qty-btn">
                            +
                        </button>
                    </form>

                </div>

            </div>

            <div class="col-md-2 text-end">

            <strong>
                R{{ number_format($lineTotal,2) }}
            </strong>

            <form
                action="{{ route('cart.remove',$item) }}"
                method="POST"
                class="mt-3">

                @csrf

                @method('DELETE')

                <button
                    type="submit"
                    class="btn btn-danger btn-sm">

                    Remove

                </button>

            </form>

         </div>
        </div>
    </div>
</div>

@empty

<div class="text-center py-5">

    <h3>Your shopping bag is empty.</h3>
    <a href="{{ url('/catalog') }}"
       class="btn btn-checkout mt-3">

        Continue Shopping
    </a>

</div>

@endforelse

</div>

 
  @php

$tax = $subtotal * 0.15;

$grandTotal = $subtotal + $tax;

@endphp

<div class="card p-4 mt-5">

    <h3>Order Summary</h3>

    <hr>

    <p>
        Subtotal
        <span class="float-end">
            R{{ number_format($subtotal,2) }}
        </span>
    </p>

    <p>
        VAT (15%)
        <span class="float-end">
            R{{ number_format($tax,2) }}
        </span>
    </p>

    <hr>

    <h4>
        Grand Total
        <span class="float-end">

            R{{ number_format($grandTotal,2) }}
        </span>
    </h4>

    <a
        href="#"
        class="btn btn-checkout w-100 mt-4">
        Proceed to Checkout
    </a>

</div>

</body>
</html>