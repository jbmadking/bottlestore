@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-10">
        <h1>Products Administration</h1>
    </div>
</div>
<div class="row">

    @include('admin.partials.sidebar')

    <div class="col-md-10">

        <div class="row">

            <div class="col-md-6">

                <div class="form-group right">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
                </div>

            </div>

        </div>

        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th width="5%"></th>
                <th>Name</th>
                <th width="10%">Price</th>
                <th width="6%">Status</th>
                <th width="6%">Special</th>
                <th width="6%">Quantity</th>
                <th width="6%">Views</th>
                <th width="20%">Created</th>
                <th width="20%">Modified</th>
            </tr>
            </thead>
            <tbody>

            @foreach($products as $product)
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->on_special }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->views }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->updated_at }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection