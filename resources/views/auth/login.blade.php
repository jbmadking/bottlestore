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
    <div class="row">
        <ul>
            <li>
                <a href="{{ url('socialite/login/facebook') }}">Facebook</a>
            </li>
            <li>
                <a href="{{ url('socialite/login/google') }}">Google Plus</a>
            </li>
            <li>
                <a href="{{ url('socialite/login/twitter') }}">Twitter</a>
            </li>
            <li>
                <a href="{{ url('socialite/login/linkedin') }}">LinkedIn</a>
            </li>
        </ul>
    </div>
@endsection
