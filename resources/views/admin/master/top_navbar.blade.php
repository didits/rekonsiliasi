@if (session('key'))
<div class="{{ session('color') }}">{{ session('key') }}</div>
@endif
<nav class="navbar navbar-default navbar">
    <div class="container-fluid">
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-info btn-fill btn-round btn-icon">
                <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                <i class="fa fa-navicon visible-on-sidebar-mini"></i>
            </button>
        </div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown dropdown-with-icons">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    @if (Auth::guest())
                    Account
                    @else
                    {{ Auth::user()->nama_organisasi }}
                    @endif
                    <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>  <a href="{{ route('logout') }}">
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>