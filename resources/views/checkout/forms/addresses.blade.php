{!! Form::open(
    [
    'route' => 'checkout.addresses.save',
    'class' => 'form-horizontal',
    'method' => 'POST'
    ]) !!}

<div class="row">
    <div class="col-md-6">
        <h3>Billing Address</h3>
    </div>

    <div class="col-md-6">
        <h3>Shipping Address</h3>
    </div>
</div>

<div class="col-md-5">
    @include(
    'checkout.forms.address',
    [
    'addressType' => 'billing',
    'submitButtonText' => 'Add Billing Address',
    ])
</div>

<div class="col-md-5 col-md-offset-1">
    @include(
    'checkout.forms.address',
    [
        'addressType' => 'shipping',
        'submitButtonText' => 'Add Shipping Address',
    ])
</div>

{!! Form::close() !!}