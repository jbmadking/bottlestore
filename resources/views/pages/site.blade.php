@extends('layouts.default')

@section('content')

        <div class="row">

            <div class="col-lg-9">
                @yield('site_content')
            </div>

            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12" id="shopping-cart"></div>
                </div>
            </div>

        </div>

@endsection

@section('scripts')
    <script src="/js/cart.js"></script>
@endsection