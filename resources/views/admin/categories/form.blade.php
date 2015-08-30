<div class="form-group">
    {!! Form::label('parent_id', 'Parent Category:', ['class' => 'control-label']) !!}
    {!! Form::select('parent_id', $categories, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Category Name:', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <div class="col-sm-3">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control col-md-2']) !!}
    </div>
</div>