@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <h1>Address Management</h1>
        </div>
    </div>
    <div class="row">

        @include('users.partials.sidebar')

        <div class="col-md-10">

            <div class="row">

                <div class="col-md-6">
                    <div class="form-horizontal right">
                        <div class="form-group">
                            <a href="{{ url('user/addresses/add') }}"
                               class="btn btn-primary">Add Address</a>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th width="5%">
                        <input type="checkbox" name="select_all" />
                    </th>
                    <th>Street Number</th>
                    <th>Street Name</th>
                    <th>Suburb</th>
                    <th>City</th>
                    <th>Province</th>
                    <th>Postal Code</th>
                    <th width="30%">Actions</th>
                </tr>
                </thead>
                <tbody>

                    @if($addresses != null )

                        @foreach($addresses as $address)
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>{{ $address->street_number }}</td>
                                <td>{{ $address->street_name }}</td>
                                <td>{{ $address->suburb }}</td>
                                <td>{{ $address->city }}</td>
                                <td>{{ $address->province }}</td>
                                <td>{{ $address->postal_code }}</td>
                                <td></td>
                            </tr>
                        @endforeach

                    @else

                        <tr>
                            <th colspan="8" class="center-announcement">No Addresses saved Yet!!!</th>
                        </tr>

                    @endif

                </tbody>
            </table>
        </div>
    </div>

@stop