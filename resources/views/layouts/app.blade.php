<?php

use Illuminate\Support\Facades\DB;
?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IT Job Seeker</title>
    <link rel="icon" href="images/jobs.png">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/searchbar.css') }}" rel="stylesheet">



</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Home
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"> <a class="nav-link" href="/references"> Refrences </a> </li>
                            <!-- <li class="nav-item">    <a class="nav-link" href="/test">Testing</a></li> -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>


                        @endguest

                        <!-- <li class="nav-item">
                            <a class="nav-link" href="/update">Update Database</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

<footer>
<hr>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-8 footer-about wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                    <h3>About us</h3>
                    <p>
                       This website was made as a minor project from a team of students at <a target="_blank" href="https://lec.edu.np/">Lalitpur Engineering College.</a> All job posts here belog to their respective websites.
                    </p>
                </div>
                <div class="col-md-4 footer-links wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="row">
                        <div class="col">
                            <h3>Links</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><a href="https://github.com/Sanoj32/Minor-Project.git">Github</a></p>
                            <p><a href="https://github.com/Sanoj32/Python-Scripts-Minor-Project.git">Python Scripts Github </a></p>
                        </div>
                        <div class="col-md-6">
                            <p><a href="https://lec.edu.np/">Our LEC College </a></p>
                            <p><a href="/faqs">Frequestly Asked Questions (FAQs) </a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col footer-social">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div> -->
</footer>

</html>
<style>

</style>
