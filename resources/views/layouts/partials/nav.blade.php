<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Florida Liquor Depot</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ url('/') }}">Home<span class="sr-only">(current)</span></a></li>
                <li><a href="{{url('/about')}}">About</a></li>
                <li><a href="{{ url('/contact') }}">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (!Auth::user())
                    <div class="navbar-form navbar-right">
                        <div class="form-group">
                            <a href="{{url('register/user')}}" class="btn btn-primary">Register</a>
                        </div>
                    </div>
                @endif
                @if (Auth::user())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"
                           data-toggle="dropdown"
                           role="button"
                           aria-expanded="false">
                            {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @if(Auth::user()->is_admin)
                                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                {{--<li><a href="{{ url('admin/profile') }}">Admin Profile</a></li>--}}
                            @else
                                <li><a href="{{ url('user/dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ url('user/profile') }}">User Profile</a></li>
                            @endif

                            <li class="divider"></li>
                            <li><a href="{{ url('auth/logout') }}">Log Out</a></li>
                        </ul>
                    </li>
                @else
                    <div class="navbar-form navbar-left" role="search">
                        <a href="{{ url('auth/login') }}" class="btn btn-primary form-control">Login</a>
                    </div>
                @endif
            </ul>
        </div>
    </div>
</nav>