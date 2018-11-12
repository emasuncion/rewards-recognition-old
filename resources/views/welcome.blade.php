<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rewards & Recognition</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .cup-logo {
              width: 500px;
              position: absolute;
              top: 30px;
              left: 5em;
            }

            @media (max-width: 576px) {
                .cup-logo {
                    width: 200px;
                    top: 70px;
                    left: 3.5em;
                }

                .title {
                    font-size: 35px;
                }
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ url('/admin')}}">Home</a>
                        @else
                            <a href="{{ url('/home') }}">Home</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <img class="cup-logo" src="{{ asset('images/logo.jpg') }}">
                <div class="is-pulled-right title m-b-md">
                    Global Education
                </div>
                <div class="title m-b-md">
                    Rewards & Recognition
                </div>
            </div>
        </div>
    </body>
</html>
