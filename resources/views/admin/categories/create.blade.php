@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <h3 class="page-header">Add Category</h3>
        </div>
    </div>

    <div class="row">

        @include('admin.partials.sidebar')

        <div class="col-md-10">

            @include('errors.partials.errors')

            {!! Form::open(['route' => 'admin.categories.store', 'class' => 'form-horizontal']) !!}
                @include('admin.categories.form', ['submitButtonText' => 'Create Category'])
            {!! Form::close() !!}

        </div>
    </div>

@endsection