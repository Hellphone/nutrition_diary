<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Nutrition Diary
                </div>

                <div class="links">
                    <a href="/products">Products</a>
                </div>

                <p><a href="/{{ $dates['yesterday'] }}"><- </a>Today is {{ $dates['today'] }}
                    @if($dates['tomorrow'])
                        <a href="/{{ $dates['tomorrow'] }}"> -></a>
                    @endif
                </p>
                <p>Total today's Kcal: <span class="important">{{ $todaysKcal }}</span></p>

                @if($records->count())
                <div class="links links-vertical">
                    @foreach($records as $record)
                        <a href="/records/{{ $record->id }}/edit">{{ $record->product->name }} : {{ $record->weight }} г || {{ $record->calculateKcal() }} кКал</a>
                    @endforeach
                </div>
                @else
                    <p>No records for today</p>
                @endif
                <a href="/records/create/?date={{ $dates['today'] }}">+</a>
            </div>
        </div>
    </body>
</html>
