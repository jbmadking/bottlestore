<div class="form-group">

    {!! Form::label('name', 'Name:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">

    {!! Form::label('email', 'E-Mail Address:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">

    {!! Form::label('password', 'Password:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">

    {!! Form::label('password_confirmation', 'Confirm Password:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-inline">
    <div class="col-md-6 col-md-offset-4">
        {!!  Form::submit('Register', ['class' => 'btn btn-primary', 'name' => 'register_user']) !!}
        @if($checkout)
            <span class="col-md-offset-4">If you have an account?</span>
            <a class="btn btn-success" name="login_user" id="login_user" href="{{ route('checkout.login') }}">Log Me In</a>
        @endif
    </div>
</div>