@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <h1>Admin Dashboard</h1>
        </div>
    </div>
    <div class="row">

            @include('admin.partials.sidebar')

        <div class="col-md-10">
        </div>

    </div>
@stop