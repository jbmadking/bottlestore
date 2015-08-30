<div class="col-lg-4">

    <div class="thumbnail">
        <img src="/img/300x300.png">
        <div class="caption">
            <div class="row">
                <div class="col-sm-6">
                    <span class="media-heading">{{ $product['name'] }}</span>
                    <strong>R{{ $product['price'] }}</strong>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-block btn-info"
                       href="{{ url('') }}">
                        <i class="icon-eye-open"></i>
                        View
                    </a>
                    <a class="btn btn-block btn-info"
                       href="{{ url('') }}">
                        <i class="icon-info-sign"></i>
                        Buy
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>