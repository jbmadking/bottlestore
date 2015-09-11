<div class="navbar navbar-default">
    <div class="collapse navbar-collapse  navbar-inverse">
        <ul class="nav navbar-nav">
            @foreach($rootCategories as $rootCategory)
                <li>
                    @if(count($rootCategory->children))
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle"
                                   data-toggle="dropdown"
                                   role="button"
                                   aria-expanded="false">
                                    {{ $rootCategory->name }}
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    @foreach($rootCategory->children as $child)
                                        <li>
                                            <a href="{{ url('/category', ['category' => $child->slug]) }}"
                                               class="@if(str_contains(Request::url(), $child->slug)) active @endif">
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    @else
                        <a href="{{ url('/category', ['category' => $rootCategory->slug]) }}"
                           class="@if(str_contains(Request::url(), $rootCategory->slug)) active @endif">
                            {{ $rootCategory->name }}
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>