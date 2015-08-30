@extends('pages.site')

@section('site_content')

    <div class="row">
        <h1>{{$product->name }}</h1>
        <div class="col-md-4">
            <div class="thumbnail">
                @if(!empty($product->image))
                    <img src="{{ url('/images/catalog/' . $product->image) }}">
                @else
                    <img src="/img/300x300.png">
                @endif
                <div class="caption">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="label label-danger">Price:R{{ $product->price }}</span>
                        </div>
                        <div class="col-md-6">
                            <span class="label label-info">Views: {{ $product->views }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h3>Product Description</h3>
            <p>
                {{ $product->description }}
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <a class="btn btn-success right" href="{{ route('checkout.index') }}">Checkout</a>

            <span class="btn btn-primary right add-to-cart"
                  product-id="{{ $product['id'] }}"
                  product-name="{{ $product['name'] }}"
                  product-price="{{ $product['price'] }}"
                  product-quantity="1" >Add to Cart</span>
        </div>
    </div>
@stop

