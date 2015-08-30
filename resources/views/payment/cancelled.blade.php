@extends('layouts.default')

@section('content')

    <h2 class="alert alert-danger">Payment Cancelled!!</h2>
    
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Date</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>

        @foreach($orders as $order)
            <tr>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->status }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection