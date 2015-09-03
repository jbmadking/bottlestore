@extends('layouts.default')

@section('content')

    <div class="container">

        <div class="col-md-offset-6">
            <div class="row">
                <div class="col-lg-6">
                    <address>
                        <strong>{{ $order->user->name }}</strong><br />
                        {{ $order->shippingAddress->street_number }} {{ $order->shippingAddress->street_name }}<br />
                        {{ $order->shippingAddress->suburb }}<br />
                        {{ $order->shippingAddress->city }}<br />
                        {{ $order->shippingAddress->province }}<br />
                        {{ $order->shippingAddress->postal_code }}<br />
                    </address>
                </div>
                <div class="col-md-6 well">
                    <table>
                        <tbody>
                        <tr>
                            <td class="pull-right"><strong>Customer</strong></td>
                            <td>{{ $order->user->name }}</td>
                        </tr>
                        <tr>
                            <td class="pull-right"><strong>Invoice #</strong></td>
                            <td>{{ $order->invoice_no }}</td>
                        </tr>
                        <tr>
                            <td class="pull-right"><strong>Date</strong></td>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 well">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Description</th>
                            <th width="15%">Quantity</th>
                            <th width="18%">Price</th>
                            <th width="18%">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($order->orderItems)
                            @foreach($order->orderItems as $orderItem)
                                <tr>
                                    <td>{{ $orderItem->product }}</td>
                                    <td>{{ $orderItem->quantity }}</td>
                                    <td align="right">R {{ $orderItem->price }}</td>
                                    <td align="right">R {{ $orderItem->subtotal }}</td>
                                </tr>
                            @endforeach
                        @endif
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><strong>Total</strong></td>
                            <td align="right"><strong>R {{ $order->total }}</strong></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            <span class="span3 pull-right">
                <form name="payment-form" class="form-horizontal" action="" method="get">
                    <!--https://www.payfast.co.za/eng/process-->
                    <input type="hidden" name="payfast_url" id="payfast_url" value="{{url('payment/notify')}}">
                    <input type="hidden" name="merchant_id" id="merchant_id" value="10000100">
                    <input type="hidden" name="merchant_key" id="merchant_key" value="46f0cd694581a">
                    <input type="hidden" name="return_url" id="return_url" value="{{url('payment/success')}}">
                    <input type="hidden" name="cancel_url" id="cancel_url" value="{{url('payment/cancelled')}}">
                    <input type="hidden" name="notify_url" id="notify_url" value="{{url('payment/notify')}}">
                    <input type="hidden" name="item_name" id="item_name" value="Test Item">
                    <input type="hidden" name="item_description" id="item_description" value="This is test text for the description">
                    <input type="hidden" name="email_confirmation" id="email_confirmation" value="1">
                    <input type="hidden" name="confirmation_address" id="confirmation_address" value="{{ $order->user->email }}">
                    <input type="hidden" name="payment_id" id="payment_id" value="{{ $order->invoice_no }}">
                    <input type="hidden" name="amount" id="amount" value="{{ $order->total }}">
                    <input type="hidden" name="name_first" id="name_first" value="{{ $order->user->name }}">
                    <input type="hidden" name="name_last" id="name_last" value="{{ $order->user->name }}">
                    <input type="hidden" name="email_address" id="email_address" value="{{ $order->user->email }}">
                    <img onclick="quickPostPaymentToPayFast(document.getElementById('payfast_url').value);"
                         src="https://www.payfast.co.za/images/buttons/paynow_basic_logo.gif"
                         align="bottom" vspace="3" width="95" height="57" alt="Pay Now"
                         title="Pay Now with PayFast"
                            />
                </form>
            </span>
            </div>
        </div>
    </div>

    <script src="/js/payfast.js"></script>
@endsection