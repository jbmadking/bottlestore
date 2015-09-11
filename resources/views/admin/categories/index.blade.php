@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <h1>Categories Administration</h1>
        </div>
    </div>
    <div class="row">

        @include('admin.partials.sidebar')

        <div class="col-md-10">

            <div class="row">

                <div class="col-md-6">
                    <div class="form-horizontal right">
                        <div class="form-group">
                            <a href="{{ route('admin.categories.create') }}"
                               class="btn btn-primary">Add Category</a>
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
                        <th>Name</th>
                        <th>Parent Category</th>
                        <th width="6%">Views</th>
                        <th width="6%">Status</th>
                        <th width="20%">Products</th>
                        <th width="20%">Modified</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($categories as $category)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <a href="{{ route(
                                'admin.categories.edit',
                                ['category' => $category->id]
                                ) }}" class="category_link">
                                    {{ $category->name }}
                                </a>
                            </td>
                            <td>
                                @if($category->parent_id)
                                    <a href="{{ route(
                                    'admin.categories.edit',
                                    ['category' => $category->parent_id]
                                    ) }}" class="category_link">
                                        {{ $category->parent->name }}
                                    </a>
                                @else
                                    Root Category
                                @endif
                            </td>
                            <td>{{ $category->status }}</td>
                            <td>{{ $category->views }}</td>
                            <td>{{ count($category->products) }}</td>
                            <td>{{ $category->updated_at }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection