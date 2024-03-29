<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img class="cup-shield" src="{{ asset('images/cupshield.jpg') }}">
            <label class="app-name">{{ config('app.name', 'Laravel') }}</label>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                     <li class="nav-item">
                        <a class="nav-link heading2" href="/admin">Home</a>
                    </li>
                    @php
                        $routes = ['results', 'vote', 'nominate', 'nominations'];
                    @endphp
                    @if(auth()->user()->isAdmin() && !auth()->user()->voted() && auth()->user()->nominationOpen() && (in_array(Route::current()->getName(), $routes)))
                        <li class="nav-item">
                            <a class="nav-link heading2" href="/nominate">Nominate</a>
                        </li>
                    @elseif(auth()->user()->isAdmin() && !auth()->user()->voted() && auth()->user()->votingOpen() && (in_array(Route::current()->getName(), $routes)))
                        <li class="nav-item">
                            <a class="nav-link heading2" href="/vote">Vote</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ auth()->user()->first_name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if(auth()->user()->isAdmin())
                            <a class="dropdown-item" href="{{ route('awardForward') }}">
                                {{ __('Award It Forward!') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('settings') }}">
                                {{ __('Settings') }}
                            </a>
                            @endif
                            <a class="dropdown-item" href="{{ route('changePassword') }}">
                                {{ __('Change Password') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
