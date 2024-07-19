
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Order Summary</h2></div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Quantity</th>
                                <th>Product Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->product->price }} RSD</td>
                                    <?php
                                        $itemTotal = $item->quantity * $item->product->price;
                                        $total += $itemTotal;
                                    ?>
                                    <td>{{ $itemTotal }} RSD</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h3 class="text-right">Total: {{ $total }} RSD</h3>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Shipping Information</h2></div>
                <div class="panel-body">
                    <form action="#" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="form-group">
                            <label for="postal_code">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit Shipping Info</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection