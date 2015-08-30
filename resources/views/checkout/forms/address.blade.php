<div class="form-group">
    {!! Form::label(''. $name . '[street_number]', 'Street Number:', ['class' => 'control-label']) !!}
    {!! Form::text(''. $name . '[street_number]', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label(''. $name . '[street_name]', 'Street Name:', ['class' => 'control-label']) !!}
    {!! Form::text(''. $name . '[street_name]', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label(''. $name . '[suburb]', 'Suburb:', ['class' => 'control-label']) !!}
    {!! Form::text(''. $name . '[suburb]', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label(''. $name . '[city]', 'City:', ['class' => 'control-label']) !!}
    {!! Form::text(''. $name . '[city]', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label(''. $name . '[province]', 'Province:', ['class' => 'control-label']) !!}
    {!! Form::text(''. $name . '[province]', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label(''. $name . '[postal_code]', 'Postal Code:', ['class' => 'control-label']) !!}
    {!! Form::text(''. $name . '[postal_code]', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>