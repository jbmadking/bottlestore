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
                            <td width="50%"><strong>Customer</strong></td>
                            <td width="50%"><strong>{{ $order->user->name }}</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Invoice #</strong></td>
                            <td>{{ $order->invoice_no }}</td>
                        </tr>
                        <tr>
                            <td><strong>Date</strong></td>
                            <td>{{ date_format($order->created_at, 'D d M Y') }}<br />
                                <small><i>at {{ date_format($order->updated_at, 'H:i a O') }}</i></small>
                            </td>
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
            </div>
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ url('/home') }}" class="btn btn-warning">Continue Shopping</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('checkout/index') }}" class="btn btn-success">Back To Checkout</a>
                </div>
                <div class="col-md-3">
                    <form name="payment-form" class="form-horizontal" action="" method="post">
                        <!--https://www.payfast.co.za/eng/process-->
                        <!--https://sandbox.payfast.co.za/eng/process-->
                        <input type="hidden" name="invoice_no" id="invoice_no" value="{{ $order->invoice_no }}">
                        <input type="hidden" name="payfast_url" id="payfast_url" value="https://sandbox.payfast.co.za/eng/process">
                        <input type="hidden" name="merchant_id" id="merchant_id" value="10000100">
                        <input type="hidden" name="merchant_key" id="merchant_key" value="46f0cd694581a">
                        <input type="hidden" name="return_url" id="return_url" value="{{url('payment/success')}}">
                        <input type="hidden" name="cancel_url" id="cancel_url" value="{{url('payment/cancelled')}}">
                        <input type="hidden" name="notify_url" id="notify_url" value="{{url('payment/notify')}}">
                        <input type="hidden" name="item_name" id="item_name" value="Online liquor Order">
                        <input type="hidden" name="item_description" id="item_description"
                               value="Florida liquor Depot - Online liquor order">
                        <input type="hidden" name="email_confirmation" id="email_confirmation" value="1">
                        <input type="hidden" name="confirmation_address" id="confirmation_address"
                               value="{{ $order->user->email }}">
                        <input type="hidden" name="payment_id" id="payment_id" value="{{ $order->invoice_no }}">
                        <input type="hidden" name="amount" id="amount" value="{{ $order->total }}">
                        <input type="hidden" name="name_first" id="name_first" value="{{ $order->user->name }}">
                        <input type="hidden" name="name_last" id="name_last" value="{{ $order->user->name }}">
                        <input type="hidden" name="email_address" id="email_address" value="{{ $order->user->email }}">
                        <a  href="#" class="btn btn-block btn-primary"
                                onclick="quickPostPaymentToPayFast(document.getElementById('payfast_url').value);">
                            Pay Now
                        </a>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('/js/payfast.js') }}"></script>
@endsection