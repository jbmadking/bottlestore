@extends('layouts.default')

@section('content')

    <div class="container">

        @include('errors.partials.errors')

        {!! Form::open(
        [
        'route' => 'checkout.login',
        'class' => 'form-horizontal',
        'method' => 'POST'
        ]) !!}

        @include('auth.forms.login')

        {!! Form::close() !!}

    </div>

@endsection