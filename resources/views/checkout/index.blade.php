@extends('layouts.default')

@section('content')

    <div class="container">
        <div class="row" id="shopping-cart">
            <div class="col-md-8">
                <ul>
                    <li class="row">
                        <span class="quantity"></span>
                        <span class="quantity">QTY</span>
                        <span class="itemName">ITEM</span>
                        <span class="price">Price</span>
                    </li>

                    @if(!empty($cartItems))
                        @foreach($cartItems as $item)

                            <li class="row">
                                <span class="btn-sm quantity delete-from-cart" item-id="{{ $item['rowid'] }}">X</span>
                                <span class="quantity">{{ $item['qty'] }}</span>
                                <span class="itemName">{{ $item['name'] }}</span>
                                <span class="price">R {{ $item['price'] }}</span>
                            </li>

                        @endforeach
                    @else
                        <li class="row">Your Shopping Cart is Empty</li>
                    @endif

                    <li class="row totals">
                        <span class="itemName quantity">Total:</span>
                        <span class="price itemName">{{ $cartTotal }}</span>
                        <span class="order"><a class="text-center" href="{{ route('checkout.address') }}">Proceed to Checkout</a></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

<script>
    $(document).ready(
            $('.delete-from-cart').click(function () {

                var product = $(this);
                var id = product.attr('item-id');

                $.ajax({
                    url    : '/cart/destroy',
                    method : 'GET',
                    data   : {id: id},
                    success: function () {
                        updateCart();
                    },
                    error  : function () {

                    }

                });
            })
    );
</script>

@endsection