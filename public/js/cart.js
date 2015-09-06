$(document).ready(function () {

    var shoppingCart = $('#shopping-cart');

    $.ajax({
        url    : '/cart/index',
        method : 'GET',
        success: function (addResponse) {
            shoppingCart.html(addResponse);
        },
        error  : function () {
        }
    });

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
                shoppingCart.html(addResponse);
            },
            error  : function () {

            }
        });
    });
});