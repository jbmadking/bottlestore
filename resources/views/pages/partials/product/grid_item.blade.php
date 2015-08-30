<div class="col-lg-3">

    <div class="thumbnail">
        @if(!empty($product->image))
            <img src="{{ url('/images/catalog/' . $product->image) }}">
        @else
            <img src="/img/300x300.png">
        @endif
        <div class="caption">
            <div class="row media-heading">

                <div class="col-md-12">
                    <span class="media-heading">{{ $product['name'] }}</span>
                </div>
                <div class="col-md-12">
                    <strong>R{{ $product['price'] }}</strong>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group-vertical" role="group">
                        <a class="btn btn-success btn-block view-product" href="{{ route('product_details',$product['name']) }}">
                            View Details
                        </a>

                        <span class="btn btn-primary  btn-block add-to-cart"
                              product-id="{{ $product['id'] }}"
                              product-name="{{ $product['name'] }}"
                              product-price="{{ $product['price'] }}"
                              product-quantity="1">Add To Cart
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>