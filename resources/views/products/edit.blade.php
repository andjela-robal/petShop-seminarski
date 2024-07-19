@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6"> <!-- Added container class -->
        <h1>Edit Product</h1>
        {!! Form::open(['route' => ['products.update', $product->slug], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'p-4 bg-white shadow-md']) !!}
        <div class="form-group">
                {{Form::label('category_id', 'Category')}}
                {{Form::select('category_id', $categories, $product->category_id, ['class' => 'form-control', 'placeholder' => 'Select Category'])}}
            </div>
            <div class="form-group">
                {{Form::label('name', 'Name')}}
                {{Form::text('name', $product->name, ['class' => 'form-control', 'placeholder' => 'Name'])}} <!-- Prefill with current name -->
            </div>
            <div class="form-group">
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', $product->description, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Description'])}} <!-- Prefill with current description -->
            </div>
            <div class="form-group">
                {{Form::label('price', 'Price')}}
                {{Form::text('price', $product->price, ['class' => 'form-control', 'placeholder' => 'Price'])}} <!-- Prefill with current price -->
            </div>
            <div class="form-group">
                {{Form::label('stock', 'Stock')}}
                {{Form::text('stock', $product->stock, ['class' => 'form-control', 'placeholder' => 'Stock'])}} <!-- Prefill with current stock -->
            </div>
            <div class="form-group">
                {{ Form::label('cover_image', 'Cover Image') }}
                {{ Form::file('cover_image') }}
                <small>or manually set the image name</small>
                {{ Form::text('cover_image', $product->cover_image, ['class' => 'form-control', 'placeholder' => 'Cover Image']) }} <!-- Prefill with current cover image name -->
            </div>
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection