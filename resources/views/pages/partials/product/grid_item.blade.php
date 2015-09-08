<div class="col-md-4" id="grid-item">
    <div class="row">

        @if(empty($product->image))
            <img src="{{ url('/images/catalog/' . $product->image) }}">
        @else
            <img src="/img/300x300.png">
        @endif

    </div>
    <div class="row">

        <div class="col-md-12">
            <h4 class="">{{ $product['name'] }}</h4>
        </div>

        <div class="col-md-12">
            <h2>R{{ $product['price'] }}</h2>
        </div>

    </div>
    <div class="row">

        <div class="col-md-12 btn-group" role="group">

            <a class="btn btn-success view-product col-lg-6"
               href="{{ route('product_details',$product['name']) }}">
                View Details
            </a>

            <span class="btn btn-primary add-to-cart col-lg-6"
                  product-id="{{ $product['id'] }}"
                  product-name="{{ $product['name'] }}"
                  product-price="{{ $product['price'] }}"
                  product-quantity="1">Add To Cart
            </span>

        </div>

    </div>
</div>