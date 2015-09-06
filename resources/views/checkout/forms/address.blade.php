<div class="form-group">
    {!! Form::label($addressType . '[street_number]', 'Street Number:', ['class' => 'control-label']) !!}
    {!! Form::text($addressType . '[street_number]', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label($addressType . '[street_name]', 'Street Name:', ['class' => 'control-label']) !!}
    {!! Form::text($addressType . '[street_name]', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label($addressType . '[suburb]', 'Suburb:', ['class' => 'control-label']) !!}
    {!! Form::text($addressType . '[suburb]', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label($addressType . '[city]', 'City:', ['class' => 'control-label']) !!}
    {!! Form::text($addressType . '[city]', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label($addressType . '[province]', 'Province:', ['class' => 'control-label']) !!}
    {!! Form::text($addressType . '[province]', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label($addressType . '[postal_code]', 'Postal Code:', ['class' => 'control-label']) !!}
    {!! Form::text($addressType . '[postal_code]', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>