<ul class="nav nav-pills nav-stacked">
    @foreach($categories as $category)
        <li>
            <a href="{{ url('/category', ['category' => $category['slug']]) }}"
               class="list-group-item
               @if(str_contains(Request::url(), $category['slug'])) active @endif">
                {{ $category['name'] }}
            </a>
        </li>
    @endforeach
</ul>
