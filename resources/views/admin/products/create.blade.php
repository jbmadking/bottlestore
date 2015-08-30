@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <h3 class="page-header">Add Product</h3>
        </div>
    </div>

<div class="row">

    @include('admin.partials.sidebar')

    <div class="col-md-10">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @else
            <p>&nbsp;</p>
        @endif

        {!! Form::open(['route' => 'admin.products.store', 'class' => 'form-horizontal']) !!}
            @include('admin.products.form', ['submitButtonText' => 'Create Product'])
        {!! Form::close() !!}

    </div>
</div>

@endsection