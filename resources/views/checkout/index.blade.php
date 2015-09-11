@extends('layouts.default')

@section('content')

    @include('pages.partials.shopping.cart', ['checkoutAction' => 'pickAddresses'] )

@endsection