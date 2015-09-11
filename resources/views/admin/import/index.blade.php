@extends('layouts.default')

@section('content')

{!! Form::open(['route' => 'admin.import.run', 'class' => 'form-horizontal']) !!}

<div class="form-group">
    {!! Form::label('categories', 'Categories:', ['class' => 'control-label']) !!}
    {!! Form::select('categories[]', $categories, null,
    [
    'class' => 'form-control',
    'id' => 'categories',
    'multiple'=>"multiple"
    ])
    !!}
</div>
<div class="form-group">
    {!! Form::label('slug', 'Page slug:', ['class' => 'control-label']) !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('url', 'Page url:', ['class' => 'control-label']) !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group">
    <div class="col-sm-3">
        {!! Form::submit('Import Products', ['class' => 'btn btn-primary form-control col-md-2']) !!}
    </div>
</div>
{!! Form::close() !!}

@endsection

@section('scripts')
    <link href="/css/select2.min.css" rel="stylesheet"/>
    <script src="{{ asset('/js/select2.min.js') }}"></script>
    <script>
        $('#categories').select2();
    </script>
@endsection