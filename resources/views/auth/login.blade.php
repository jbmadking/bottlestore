@extends('layouts.default')

@section('content')

    <h1>Login</h1>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    @include('errors.partials.errors')
                    {!! Form::open(
                    [
                        'url' => '/auth/login',
                        'method' => 'POST',
                        'class' => 'form-horizontal',
                        'role' => 'form'
                        ]) !!}

                    @include('auth.forms.login')
                    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
