@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add New Product</div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'products.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                {{ Form::label('category_id', 'Category') }}
                                {{ Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Select Category']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('name', 'Name') }}
                                {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('description', 'Description') }}
                                {{ Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Description']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('price', 'Price') }}
                                {{ Form::text('price', '', ['class' => 'form-control', 'placeholder' => 'Price']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('stock', 'Stock') }}
                                {{ Form::text('stock', '', ['class' => 'form-control', 'placeholder' => 'Stock']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('cover_image', 'Cover Image') }}
                                {{ Form::file('cover_image', ['class' => 'form-control']) }}
                                <small>or manually set the image name</small>
                                {{ Form::text('cover_image', '', ['class' => 'form-control', 'placeholder' => 'Cover Image']) }}
                            </div>
                            {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection