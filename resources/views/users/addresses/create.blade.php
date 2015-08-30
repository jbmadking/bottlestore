@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <h3 class="page-header">Add Address</h3>
        </div>
    </div>

    <div class="row">

        @include('users.partials.sidebar')

        <div class="col-md-10">

          @include('errors.partials.errors')

            {!! Form::open(['url' => 'user/addresses/save', 'class' => 'form-horizontal']) !!}
                @include(
                'users.addresses.form',
                [
                    'submitButtonText' => 'Add Address',
                    'btnClass' => 'col-md-2',
                    'btnSize' => 'col-sm-3'
                ])

            {!! Form::close() !!}

        </div>
    </div>

@endsection