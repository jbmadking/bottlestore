@extends('layouts.default')

@section('content')

    <div class="container">

        @include('errors.partials.errors')

        {!! Form::open(
        [
        'route' => 'checkout.register',
        'class' => 'form-horizontal',
        'method' => 'POST'
        ]) !!}

        @include('auth.forms.register', ['checkout' => true])

        {!! Form::close() !!}

    </div>

 @endsection