<div class="form-group">
    {!! Form::label('street_number', 'Street Number:', ['class' => 'control-label']) !!}
    {!! Form::text('street_number', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('street_name', 'Street Name:', ['class' => 'control-label']) !!}
    {!! Form::text('street_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('suburb', 'Suburb:', ['class' => 'control-label']) !!}
    {!! Form::text('suburb', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('city', 'City:', ['class' => 'control-label']) !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('province', 'Province:', ['class' => 'control-label']) !!}
    {!! Form::text('province', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('postal_code', 'Postal Code:', ['class' => 'control-label']) !!}
    {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <div class="{{ $btnSize }}">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control ' . $btnClass]) !!}
    </div>
</div>