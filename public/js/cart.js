$(document).ready(function () {

    updateCart('');

    $('.add-to-cart').click(function () {

        var product = $(this);
        var id = product.attr('product-id');
        var name = product.attr('product-name');
        var quantity = product.attr('product-quantity');
        var price = product.attr('product-price');

        $.ajax({
            url    : '/cart/add',
            method : 'GET',
            data   : {
                id      : id,
                name    : name,
                quantity: quantity,
                price   : price,
            },
            success: function (addResponse) {

                updateCart(addResponse);
            },
            error  : function () {

            }

        });
    });

});

function updateCart (addResponse) {

    var shoppingCart = $('#shopping-cart');

    $.ajax({
        url    : '/cart/index',
        method : 'GET',
        success: function (indexResponse) {

            shoppingCart.html(indexResponse);

            $('#product-' + addResponse).css('background-color', '#265a66');
            $('#product-' + addResponse).css('color', '#ffffff');

        },
        error  : function () {

        }
    });

}

