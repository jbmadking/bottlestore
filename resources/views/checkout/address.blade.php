@extends('layouts.default')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <div class="row">
                    <div class="col-md-6">

                        <h3>Select from your saved Addresses</h3>

                        @if($addresses)
                            @include('checkout.forms.select',['addresses' => $addresses])
                        @else
                            <h3 class="center-announcement">No Addresses saved Yet!!!</h3>
                        @endif

                    </div>
                    <div class="col-lg-6">
                        <h3>Or enter your address details below</h3>
                        @include(
                        'checkout.forms.address',
                        [
                        'addressType' => 'billing',
                        'submitButtonText' => 'Add Address',
                        ])

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection