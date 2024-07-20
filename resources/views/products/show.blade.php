@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    @if ($products)
    <a href="/products" class="btn btn-secondary mb-4">Go Back</a>
    <div class="product-details-container">
        <div class="product-image-container">
            <img class="product-image" src="/storage/cover_images/{{ $products->cover_image }}" alt="{{ $products->name }}">
        </div>
        <div class="product-info-container">
            <h1>{{ $products->name }}</h1>
            <p> Category: {{$products->category->name}} </p>
            <hr>
            <div>
               <p> {!! $products->description !!} </p>
            </div>
            <hr>
            <h3>Price: {{ $products->price }} RSD</h3>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <p>Stock: {{ $products->stock }}</p> <!-- Added stock information -->
@if(Auth::check())
    <form action="{{ route('cart.add') }}" method="post">
        @csrf
        <input type="hidden" name="product_id" value="{{ $products->id }}">
        <input type="number" name="quantity" value="1" min="1">
        <button type="submit" class="btn btn-success">Add to Cart</button>
    </form>
@else
    <a href="{{ route('login') }}" class="btn btn-success">Login to Add to Cart</a>
@endif
            </div>
            <hr>
            @if (Auth::check() && (Auth::user()->id == $products->user_id || Auth::user()->isAdmin()))
            <div class="mt-4">
                <a href="{{ route('products.edit', ['slug' => $products->slug]) }}" class="btn btn-secondary">Edit</a>
                {!! Form::open(['route' => ['products.destroy', $products->slug], 'method' => 'DELETE', 'class' => 'float-end']) !!}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                {!! Form::close() !!}
            </div>
            @endif
        </div>
    </div>
    <div class="mt-4">
        <a href="#" style="text-decoration: underline; font-size: 1.5em;">Browse reviews</a>
        <span> | </span>
        <a href="#" style="text-decoration: underline; font-size: 1.5em;">Write a review</a>
    </div>
    @else
    <p>No product found</p>
    @endif
</div>
@endsection
