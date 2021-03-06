@extends('pages.site')

@section('site_content')
    <div class="row">
        <div class="col-lg-9">
            @include('pages.partials.category.menu')
        </div>
    </div>
    <div class="row">
        <h1>{{ $category->name }} Category</h1>

        <div class="col-md-12">

            @foreach (array_chunk($products, 4) as $productsRow)

                <div id="portfolio" class="row">

                    @foreach($productsRow as $product)

                        @include('pages.partials.product.grid_item')

                    @endforeach

                </div>

            @endforeach

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            {!! $paginate->render() !!}
        </div>
    </div>
@stop