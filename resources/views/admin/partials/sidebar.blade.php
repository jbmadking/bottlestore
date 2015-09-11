<div class="col-md-2">
    <div class="list-group">
        <a href="#" class="list-group-item active">Admin Menu</a>
        <a href="{{ route('admin.products.index') }}" class="list-group-item">All Products</a>
        <a href="{{ route('admin.categories.index') }}" class="list-group-item">All Categories</a>
        <a href="{{ route('admin.administrators.index') }}" class="list-group-item">Users List</a>
        {{-- for dev only--}}
        <a href="{{ route('admin.import.index') }}" class="list-group-item">Product Import</a>
        {{-- end dev--}}
        <a href="{{ route('admin.clients.index') }}" class="list-group-item">Clients List</a>
        <a href="{{ url('auth/logout') }}" class="list-group-item">Logout</a>
    </div>
</div>