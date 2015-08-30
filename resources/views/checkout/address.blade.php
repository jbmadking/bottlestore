@extends('layouts.default')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <div class="row">
                    <div class="col-md-12">
                        @if($addresses)
                            <h4>Select from saved Addresses</h4>

                            {!! Form::open([
                                'route' => 'checkout.payment',
                                'method' => 'POST',
                                'class' => 'form-horizontal'
                            ]) !!}

                            <div class="form-group">
                                {!! Form::label('billing', 'Billing Address:', ['class' => 'control-label']) !!}
                                {!! Form::select('billing', $addresses, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('shipping', 'Shipping Address:', ['class' => 'control-label']) !!}
                                {!! Form::select('shipping', $addresses, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Proceed to Payment', ['class' => 'btn btn-primary form-control col-md-2']) !!}
                            </div>
                            {!! Form::close() !!}
                            @else
                                    <h3 class="center-announcement">No Addresses saved Yet!!!</h3>
                            @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Or enter your address details below</h3>
                            @include('checkout.forms.addresses')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection