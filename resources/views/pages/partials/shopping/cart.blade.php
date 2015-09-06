<div class="col-md-12">

    <div id="cart-notices"></div>

    <ul>
        <li class="row">
            <span class="quantity"></span>
            <span class="quantity">QTY</span>
            <span class="itemName">ITEM</span>
            <span class="price">Price</span>
        </li>

        @if(!empty($cartItems))
            @foreach($cartItems as $item)

                <li class="row" id="product-{{ $item['id'] }}">
                    <span class="btn-sm quantity delete-from-cart"
                          item-id="{{ $item['rowid'] }}">X</span>
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
            <span class="price itemName">R {{ $cartTotal }}</span>
            <span class="order">
                <a class="text-center" id="checkout" href="{{ route('checkout.index') }}">Checkout</a>
            </span>
        </li>
    </ul>
</div>
<script>
    $(document).ready(
            $('.delete-from-cart').click(function () {

                var product = $(this);
                var id = product.attr('item-id');
                var shoppingCart = $('#shopping-cart');

                $.ajax({
                    url    : '/cart/destroy',
                    method : 'GET',
                    data   : {id: id},
                    success: function (addResponse) {
                        shoppingCart.html(addResponse);
                    },
                    error  : function () {

                    }

                });
            })
    );
</script>
