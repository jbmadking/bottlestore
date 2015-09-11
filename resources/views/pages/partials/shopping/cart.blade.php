<div class="col-md-12">
    <div id="shopping-cart">

        <div id="cart-notices"></div>

        <table class="table table-bordered table-striped">
            <tr>
                <th></th>
                <th>#</th>
                <th>ITEM</th>
                <th width="25%">PRICE</th>
            </tr>

            @if(!empty($cartItems))

                @foreach($cartItems as $item)

                    <tr>
                        <td>
                            <span class="label label-danger delete-from-cart"
                                  item-id="{{ $item['rowid'] }}"
                                  id="product-{{ $item['id'] }}">X</span>
                            <br/>
                        </td>
                        <td>{{ $item['qty'] }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td align="right">R {{ $item['price'] }}</td>
                    </tr>

                @endforeach

            @else
                <tr>
                    <td colspan="4">Your Shopping Cart is Empty</td>
                </tr>
            @endif

            <tr align="right">
                <td colspan="2">
                    <a class="btn btn-success btn-sm" id="checkout"

                       @if($checkoutAction === 'pickAddresses')
                       href="{{ route('checkout.addresses') }}"
                       @else
                       href="{{ route('checkout.index') }}"
                            @endif
                            >
                        @if($checkoutAction === 'pickAddresses')
                            Proceed to Checkout
                        @else
                            Checkout
                        @endif
                    </a>
                </td>
                <td>Total:</td>
                <td>R {{ $cartTotal }}</td>
            </tr>
        </table>
    </div>
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
