
<div class="form-group">
    {!! Form::label('name', 'Client Name:', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Client Email:', ['class' => 'control-label']) !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <div class="col-sm-3">
        {!! Form::submit('Update Client', ['class' => 'btn btn-primary form-control col-md-2']) !!}
    </div>
</div>