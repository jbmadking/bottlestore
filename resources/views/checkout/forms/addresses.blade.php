{!! Form::open(
    [
    'route' => 'checkout.addresses.save',
    'class' => 'form-horizontal',
    'method' => 'POST'
    ]) !!}

<div class="row">
    <div class="container">
        <div class="col-md-5">
            <h3>Billing Address</h3>
            @include(
            'checkout.forms.address',
            [
            'addressType' => 'billing',
            'submitButtonText' => 'Add Billing Address',
            ])
        </div>

        <div class="col-md-5 col-md-offset-1">
            <h3>Shipping Address</h3>
            @include(
            'checkout.forms.address',
            [
                'addressType' => 'shipping',
                'submitButtonText' => 'Add Shipping Address',
            ])
        </div>
    </div>
</div>
{!! Form::close() !!}