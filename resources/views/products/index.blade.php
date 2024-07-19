@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-1 py-6"> 
        <h1>Products</h1>
        <div class="row">
        @if(count($products) > 0)
        @foreach($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card">
                <img src="/storage/cover_images/{{ $product->cover_image }}" class="card-img-top p-2" alt="{{ $product->name }}">
                <div class="card-body px-2">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Category: {{ $product->category->name }}</p>
                    <p class="card-text">Price: {{ $product->price }} RSD</p>
                    <a href="{{ route('products.show', $product->slug) }}" style="text-decoration: underline; color: #17a2b8; font-size: 1.2em;">See more</a>
                    {{-- Form for adding to cart --}}
                    {{-- {!! Form::open(['url' => '/cart-add', 'method' => 'POST']) !!} --}}
                    <input type="hidden" name="productId" value="{{ $product->id }}">
                    <input type="hidden" name="qty" value="1">
                    <button type="submit" class="btn btn-success" style="float: right;">Add to Cart</button>
                    {{-- {!! Form::close() !!} --}}
                </div>
            </div>
        </div>
        @endforeach
        {{$products->links()}}
        @else
        <p>No products found</p>
        @endif
    </div>
@endsection