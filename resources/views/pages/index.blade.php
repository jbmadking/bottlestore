@extends('pages.site')

@section('site_content')

    @foreach (array_chunk($products, 3) as $productsRow)

        <div id="portfolio" class="row">

            @foreach($productsRow as $product)

                @include('pages.partials.product.grid_item')

            @endforeach

        </div>

    @endforeach

    <div class="row">
        <div class="col-lg-12">
            {!! $paginate->render() !!}
        </div>
    </div>

@stop