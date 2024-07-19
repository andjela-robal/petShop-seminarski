@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Cart</h1></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Remove Product</th>
                                    <th>Sr No.</th>
                                    <th>Product Name</th>
                                    <th>Product Quantity</th>
                                    <th>Product Price</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 0;
                                    $subtotal = 0;
                                ?>
                                @foreach($cartItems as $cartItem)
                                    <tr>
                                        <td>
                                            <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </form>
                                        </td>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $cartItem->product->name }}</td>
                                        <td>
                                            <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input class="col-xs-4" type="number" value="{{ $cartItem->quantity }}" min="1" name="quantity">
                                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                            </form>
                                        </td>
                                        <td>{{ $cartItem->product->price }} RSD</td>
                                        <?php
                                            $total = $cartItem->product->price * $cartItem->quantity;
                                        ?>
                                        <td>{{ $total }} RSD</td>
                                    </tr>
                                    <?php
                                        $subtotal += $total;
                                    ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h3 class="text-right">Total: {{ $subtotal }} RSD</h3>
                    <a href="{{ route('cart.checkout') }}" class="btn btn-success">Proceed</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection