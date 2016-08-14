<nav class="navbar navbar-full navbar-dark bg-inverse" style="background: #1D2127">
    <a class="navbar-brand" href="/">
        <img src="/img/logo.png" style="height: 27px;"/>
    </a>
    @if(Auth::check())
        <ul class="nav navbar-nav">
            <li class="nav-item m-l-2 @if(isset($nav_menu) && $nav_menu == 'notes') active @endif">
                <a class="nav-link" href="{{ action('NoteController@getIndex') }}">Notes</a>
            </li>
            <li class="nav-item m-l-2 @if(isset($nav_menu) && $nav_menu == 'deleted') active @endif">
                <a class="nav-link" href="{{ action('NoteController@getDeleted') }}">Trash</a>
            </li>
        </ul>
    @endif
    <ul class="nav navbar-nav pull-xs-right">
        @if(!Auth::check())
            <li class="nav-item dropdown">
                <a href="{{ action('Auth\AuthController@showRegistrationForm') }}" class="btn btn-success">Sign Up</a>
                <a href="{{ action('Auth\AuthController@showLoginForm') }}" class="btn btn-primary m-l-1">Login</a>
            </li>
        @else
            <li class="nav-item dropdown">
                <a href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="avatar avatar-online">
                        <img src="{{ Auth::user()->avatar()->url() }}" class="img-rounded" style="width: 35px;" />
                        <i></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <h6 class="dropdown-header">Home</h6>
                    <a class="dropdown-item" href="{{ action("NoteController@getIndex") }}">
                        <i class="fa fa-sticky-note-o"></i> Notes
                    </a>
                    <a class="dropdown-item" href="{{ action("NoteController@getDeleted") }}">
                        <i class="fa fa-trash"></i> Trash
                    </a>

                    <h6 class="dropdown-header">Settings</h6>
                    <a class="dropdown-item" href="{{ action("AccountController@getProfileSettings") }}">
                        <i class="fa fa-user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="{{ action("AccountController@getSecuritySettings") }}">
                        <i class="fa fa-lock"></i> Security
                    </a>
                    <a class="dropdown-item" href="{{ action("AccountController@getNoteSettings") }}">
                        <i class="fa fa-sticky-note"></i> Note
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ action('Auth\AuthController@logout') }}">
                        <i class="fa fa-sign-out"></i> Logout
                    </a>
                </div>
            </li>
        @endif
    </ul>
</nav>