@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-2">
        </div>
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">
                    <h2>Dashboard</h2>
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                @if(Auth::user()->isAdmin())
                    <div style="text-align:center;">
                        <a href="/products/create" class="btn btn-info">Add New Product</a>
                        <a href="/products" class="btn btn-info">View all Products</a>
                    </div>
                    <div style="text-align: center; color:orangered;">
                        <h3>Welcome Administrator!!<h3>
                        <h2>Your Products</h2>
                    </div>
                    <div class="panel-body" style="height: 400px; overflow-y: scroll;">
                        @if(count($products) > 0)
                            <table class="table table-striped">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Edit Product</th>
                                    <th><p class="pull-right">Delete Product</p></th>
                                </tr>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td><a href="{{ route('products.edit', $product->slug) }}" class="btn btn-default">Edit</a></td>
                                        <td>
                                            {!! Form::open(['route' => ['products.destroy', $product->slug], 'method' => 'DELETE', 'class' => 'pull-right', 'onsubmit' => 'return confirm("Are you sure you want to delete this product?");']) !!}
                                            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                        {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p>You have no Products</p>
                        @endif
                    </div>
                @else
                    <center>You are logged in!
                    <a href="/order" class="btn btn-info">My Orders</a></center>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection