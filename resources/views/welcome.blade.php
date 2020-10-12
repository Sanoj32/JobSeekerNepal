<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>It job seeker</title>

    <script src="https://use.fontawesome.com/b0f225cc8a.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Css -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/searchbar.css') }}" />
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

</head>

<body>
    <div class="container">
        <div class="hero">
            <div class="flex-center position-ref full-height">
                @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/update') }}">Update data </a>
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
                    <div class="wrap">
                        <div class="search">
                            <form action="/search" method="GET" role="search">
                                {{ csrf_field() }}
                                <input type="text" class="searchTerm" name="searchText" placeholder="Search users">
                                <button type="submit" class="searchButton">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>