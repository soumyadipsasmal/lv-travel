{{--  <!-- Top Menu Items -->  --}}
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="mobile-only-brand pull-left">
        <div class="nav-header pull-left">
            <div class="logo-wrap">
                <a href="{{ route('admindashboard') }}">
                    <img class="brand-img" src="{{ asset('backend/dist/img/logo.png') }}" alt="brand" />
                    <span class="brand-text">Hound</span>
                </a>
            </div>
        </div>
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i
                class="zmdi zmdi-menu"></i></a>
    </div>
    <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
            <li class="dropdown auth-drp">
                <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">
                    <span style="padding-right: 5px; font-size:18px">{{ Auth::user()->name }}</span>
                    @if (Auth::user()->profile != '')
                        <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="user_auth"
                            class="user-auth-img img-circle" style="padding-left: 2px" /><span
                            class="user-online-status"></span>
                    @else
                        <img src="{{ url('backend/dist/img/user1.png') }}" alt="user_auth"
                            class="user-auth-img img-circle" style="padding-left: 2px" /><span
                            class="user-online-status"></span>
                </a>
                @endif
                <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <li>
                        <a href="{{ route('adminprofile') }}"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javscript:void(0);"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i
                                class="zmdi zmdi-power"></i><span>Log Out</span></a>
                        <form action="{{ route('logout') }}" id="logout-form" class="d-none" method="POST">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
{{--  <!-- /Top Menu Items -->  --}}
