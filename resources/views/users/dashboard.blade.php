@extends('layouts.default')

@section('content')

    <h1>User Dashboard</h1>
    <div class="row">
            @include('users.partials.sidebar')
        <div class="col-sm-10">

            <div class="col-sm-10"></div>

            <div class="col-md-2 grid-item right">
                <div class="row grid-item-image">
                        <img src="/img/300x300.png" class="img-thumbnail">
                </div>
                <div class="row grid-item-info">
                    <div class="col-md-12 grid-item-name">
                    </div>
                    <div class="col-md-12 grid-item-price">
                    </div>
                </div>
            </div>

        </div>

    </div>
@stop