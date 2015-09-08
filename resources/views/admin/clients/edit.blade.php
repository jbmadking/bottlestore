@extends('layouts.default')

@section('content')
    <div class="row">
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
            $client,
            [
                'method' => 'PATCH',
                'route' => ['admin.categories.update', $client->id],
                'class' => 'form-horizontal'
            ]
            )
        !!}

            @include('admin.clients.form', ['submitButtonText' => 'Update Client'])

        {!! Form::close() !!}

    </div>
</div>
<div class="row">

    <div class="col-md-offset-2">
        <h2>Client Orders</h2>
        @if($client->orders->count())
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Date Created</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($client->orders as $order)
                        <tr>
                            <td>{{ $order->invoice_no }}</td>
                            <td>
                                    <span class="label
                                     @if($order->status == 'unpaid')
                                            label-danger
                                     @else
                                            label-success
                                     @endif">{{ strtoupper($order->status) }}</span>
                            </td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->updated_at }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @else
            <h4>This client does not have any orders yet.</h4>
        @endif
    </div>
</div>
@endsection