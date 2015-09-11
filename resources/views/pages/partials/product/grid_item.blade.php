<div class="col-md-3 grid-item">
    <div class="row grid-item-image">

        @if(!empty($product['image']))
            <img src="{{ url('/images/catalog/' . $product['image']) }}" class="img-responsive">
        @else
            <img src="/img/300x300.png" class="img-thumbnail">
        @endif

    </div>
    <div class="row grid-item-info">

        <div class="col-md-12">
            <strong class="">{{ $product['name'] }}</strong>
        </div>

        <div class="col-md-12">
            <h4>R{{ $product['price'] }}</h4>
        </div>

    </div>
    <div class="row">

        <div class="btn-group center-block" role="group">

            <a class="btn btn-success view-product col-lg-6"
               href="{{ route('product_details',$product['name']) }}">
                View
            </a>

            <span class="btn btn-primary add-to-cart col-lg-6"
                  product-id="{{ $product['id'] }}"
                  product-name="{{ $product['name'] }}"
                  product-price="{{ $product['price'] }}"
                  product-quantity="1">Add to Cart
            </span>

        </div>

    </div>
</div>