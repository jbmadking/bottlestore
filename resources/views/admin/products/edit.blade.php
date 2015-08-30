@extends('layouts.default')

@section('content')
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <h3 class="page-header">Edit Product</h3>
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
        @endif

        {!! Form::model(
            $product,
            [
                'method' => 'PATCH',
                'url' => [
                    '/admin/products',
                    $product->id
                ],
                'class' => 'form-horizontal',
                'enctype' => 'multipart/form-data'
            ]
            )
        !!}
            @include('admin.products.form', ['submitButtonText' => 'Update Product'])

        {!! Form::close() !!}

    </div>
</div>

@endsection