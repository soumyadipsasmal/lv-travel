<header id="site-header" class="fixed-top" style="position: sticky">
    <div class="container">
        <nav class="navbar navbar-expand-lg stroke">
            <h1><a class="navbar-brand mr-lg-5" href="index.html">
                    Traversal
                </a></h1>
            <!-- if logo is image enable this
        <a class="navbar-brand" href="#index.html">
            <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
        </a> -->
            <button class="navbar-toggler  collapsed bg-gradient" type="button" data-toggle="collapse"
                data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
                <span class="navbar-toggler-icon fa icon-close fa-times"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.html">Destinations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                    {{--  <li class="">  --}}
                        @if (Route::has('login'))
                            {{--  <div class="hidden fixed top-0 right-0 px- py-3 sm:block">  --}}
                            @auth
                        <li class="nav-item"><a href="{{ route('user.dashboard') }}" class="nav-link">Dashboard</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                    class="nav-link">
                                    Log Out
                                </a>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"> <a href="{{ route('login') }}" class="nav-link">Log
                                in</a></li>
                        @if (Route::has('register'))
                            <li class="nav-item"> <a href="{{ route('register') }}" class="nav-link">Register</a></li>
                        @endif
                    @endauth
                    {{--  </div>  --}}
                    @endif
                    {{--  </li>  --}}
                </ul>
            </div>
            <div class="d-lg-block d-none">
                <a href="#" class="btn btn-style btn-secondary">
                    @if (isset(Auth::user()->id))
                        Welcome, {{ Auth::user()->name }}
                    @else
                        Get In Touch
                    @endif
                </a>
            </div>
            {{--  <!-- toggle switch for light and dark theme -->  --}}
            <div class="mobile-position">
                <nav class="navigation">
                    <div class="theme-switch-wrapper">
                        <label class="theme-switch" for="checkbox">
                            <input type="checkbox" id="checkbox">
                            <div class="mode-container">
                                <i class="gg-sun"></i>
                                <i class="gg-moon"></i>
                            </div>
                        </label>
                    </div>
                </nav>
            </div>
            <!-- //toggle switch for light and dark theme -->
        </nav>
    </div>
</header>
