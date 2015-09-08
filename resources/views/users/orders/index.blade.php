@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <h1>User Orders</h1>
        </div>
    </div>
    <div class="row">

        @include('users.partials.sidebar')

        <div class="col-md-10">

            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Invoice #</th>
                    <th>Billing Address</th>
                    <th>Shipping Address</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                    @if($orders != null )

                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->invoice_no }}</td>
                                <td>
                                    {{ $order->billingAddress->street_number }}
                                    {{ $order->billingAddress->street_name }}
                                </td>
                                <td>
                                    {{ $order->shippingAddress->street_number }}
                                    {{ $order->shippingAddress->street_name }}
                                </td>
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
                                <td>
                                    @if($order->status == 'unpaid')
                                        <button class="btn btn-sm btn-warning">Pay Now</button>
                                    @else
                                        <button class="btn btn-sm btn-success">View Payment</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    @else

                        <tr>
                            <th colspan="8" class="center-announcement">No Orders created Yet!!!</th>
                        </tr>

                    @endif

                </tbody>
            </table>
        </div>
    </div>

@stop