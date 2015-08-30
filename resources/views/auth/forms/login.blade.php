<div class="form-group">

    {!! Form::label('email', 'E-Mail Address:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">

    {!! Form::label('password', 'Password:', ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::password('password',['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <div class="checkbox">
            <label>
                {!! Form::checkbox('remember') !!}
                Remember Me
            </label>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {!!  Form::submit('Login', ['class' => 'btn btn-primary', 'name' => 'login_user']) !!}
        <a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
    </div>
</div>
