@extends('layouts.default')

@section('content')

    <h1>Register</h1>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">

                        @include('errors.partials.errors')

                        {!! Form::open(
                        [
                        'route' => 'user.register',
                        'class' => 'form-horizontal',
                        'method' => 'POST'
                        ]) !!}

                        @include('auth.forms.register', ['checkout' => false])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
