{!! Form::open([
    'route' => 'checkout.payment',
    'method' => 'POST',
    'class' => 'form-horizontal'
]) !!}

<div class="form-group">
    {!! Form::label('billing', 'Billing Address:', ['class' => 'control-label']) !!}
    {!! Form::select('billing', $addresses, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('shipping', 'Shipping Address:', ['class' => 'control-label']) !!}
    {!! Form::select('shipping', $addresses, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit('Proceed to Payment', ['class' => 'btn btn-primary form-control col-md-2']) !!}
</div>

{!! Form::close() !!}
