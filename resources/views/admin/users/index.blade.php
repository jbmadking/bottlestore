@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-10">
        <h1>Admin Users Administration</h1>
    </div>
</div>
<div class="row">

    @include('admin.partials.sidebar')

    <div class="col-md-10">

        <div class="row">

            <div class="col-md-6">

                <div class="form-group right">
                    <a href="{{ url('admin/users/add') }}" class="btn btn-primary">Add Administrator</a>
                </div>

            </div>

        </div>


        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th width="5%"></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created Date</th>
                    <th>Last Updated Date</th>
                </tr>
            </thead>
            <tbody>

                @foreach($users as $user)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>
                            <a href="{{ url('/admin/edit/user', ['user' => $user->id]) }}">
                                {{ $user->name }}
                            </a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection