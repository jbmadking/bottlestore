@extends('layouts.default')

@section('content')
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <h3 class="page-header">Edit Category</h3>
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
            $category,
            [
                'method' => 'PATCH',
                'route' => ['admin.categories.update', $category->id],
                'class' => 'form-horizontal'
            ]
            )
        !!}

            @include('admin.categories.form', ['submitButtonText' => 'Update Category'])

        {!! Form::close() !!}

    </div>
</div>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-10">
        <h2>Child Categories</h2>
        @if($category->children->count())
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category->children as $childCategory)
                        <tr>
                            <td>{{ $childCategory->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h4>This category does not have any Child Categories Associated with it</h4>
        @endif
    </div>
</div>
@endsection