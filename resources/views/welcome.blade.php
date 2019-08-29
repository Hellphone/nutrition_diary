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

                @guest
                    <p><a href="/login">Login</a> to access your personal section.</p>
                    <p>New to this place? <a href="/register">Register</a>.</p>
                @else
                    <div class="links">
                        <a href="/products">Products</a>
                    </div>

                    <p>
                        <form action="/" method="GET">
                            <a href="/?date={{ $dates['yesterday'] }}"><-</a>

                                <a href="/?date={{ $dates['realToday'] }}">Today</a> is <input type="date" name="date" placeholder="Date" value="{{ $dates['today'] }}">
                                <input type="submit" value="Go">

                            @if($dates['tomorrow'])
                                <a href="/?date={{ $dates['tomorrow'] }}"> -></a>
                            @endif
                        </form>
                    </p>

                    <p>Total today's Kcal: <span class="important">{{ $todaysKcal }}</span></p>

                    @if($records->count())
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Protein</th>
                                <th scope="col">Fat</th>
                                <th scope="col">Carbohydrates</th>
                                <th scope="col">Weight</th>
                                <th scope="col">Calories</th>
                            </tr>
                            </thead>
                            @foreach($records as $record)
                                <tr>
                                    <a href="/records/{{ $record->id }}/edit">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $record->product->name }}</td>
                                        <td>{{ $record->product->proteins }}</td>
                                        <td>{{ $record->product->fats }}</td>
                                        <td>{{ $record->product->carbs }}</td>
                                        <td>{{ $record->weight }}</td>
                                        <td>{{ $record->calculateKcal() }}</td>
                                    </a>
                                </tr>
                            @endforeach
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Total:</th>
                                <th scope="col">{{ $todaysProteins }}</th>
                                <th scope="col">{{ $todaysFats }}</th>
                                <th scope="col">{{ $todaysCarbs }}</th>
                                <th scope="col">{{ $todaysWeight }}</th>
                                <th scope="col">{{ $todaysKcal }}</th>
                            </tr>
                        </table>
                    @else
                        <p>No records for today</p>
                    @endif

                    <a href="/records/create/?date={{ $dates['today'] }}">+</a>
                @endguest
            </div>
        </div>
    </body>
</html>
