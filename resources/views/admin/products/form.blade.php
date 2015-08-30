<input name="parent_id" type="hidden" value="0">

<div class="form-group">
    {!! Form::label('category', 'Category:', ['class' => 'control-label']) !!}
    {!! Form::select('category', $categories, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Product Name:', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('price', 'Product Price:', ['class' => 'control-label']) !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('quantity', 'Product Quantity:', ['class' => 'control-label']) !!}
    {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('status', 'Product status:', ['class' => 'control-label']) !!}
    {!! Form::select('status', ['0' => 'Disabled', '1' => 'Enabled'], null, ['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('image', 'Product image:', ['class' => 'control-label']) !!}
    {!! Form::file('image', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <div class="col-sm-3">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control col-md-2']) !!}
    </div>
</div>