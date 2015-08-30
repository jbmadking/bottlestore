@extends('layouts.default')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-lg-2">
                @include('pages.partials.category.menu')
            </div>

            <div class="col-lg-7">
                @yield('site_content')
            </div>

            <div class="col-md-3">
                <div class="row" id="shopping-cart">
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="goggle-maps" style="width: 100%; height: 100%">
                            {{--@include('pages.partials.maps.location')--}}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/cart.js"></script>
@endsection