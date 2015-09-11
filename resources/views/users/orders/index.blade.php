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

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Invoice #</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th width="20%">Date</th>
                    <th width="10%">Actions</th>
                </tr>
                </thead>
                <tbody>

                    @if($orders != null )

                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->invoice_no }}</td>
                                <td>{{ $order->billingAddress->street_number }}</td>
                                <td>
                                    <span class="label
                                     @if($order->status == 'unpaid')
                                            label-danger
                                     @elseif($order->status == 'new')
                                            label-success
                                    @elseif($order->status == 'paid')
                                            label-primary
                                     @endif">{{ strtoupper($order->status) }}</span>
                                </td>
                                <td>{{ $order->total }}</td>
                                <td>{{ date_format($order->updated_at, 'D m Y H:i:s') }}</td>
                                <td>
                                    @if($order->status == 'unpaid')
                                        <button class="btn btn-sm btn-danger">Pay Order</button>
                                    @elseif($order->status == 'new')
                                        <button class="btn btn-sm btn-success">View Order</button>
                                    @elseif($order->status == 'paid')
                                        <button class="btn btn-sm btn-primary">View Payment</button>
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