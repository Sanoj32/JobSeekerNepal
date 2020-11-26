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
    <link rel="icon" href="/images/favicon.png">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/scrollup.js') }}" defer></script>




    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/searchbar.css') }}" rel="stylesheet">

    <link href="{{ asset('css/piechart.css') }}" rel="stylesheet">
    <script src="{{ asset('js/piechart.js') }}" defer></script>





</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
            <!-- Image and text -->
              <nav class="navbar">
                <a class="navbar-brand" href="/">
                  <img class="pb-1" src="/images/job-search.svg" width="30" height="30" class="d-inline-block align-top" alt="">
                  <img class="pl-2" wirdth="30" height="30" src="/images/jobseeker.png">
                </a>
              </nav>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <!-- <ul class="navbar-nav mr-auto">
                        <li class="nav-item"> <a class="nav-link" href="/references"> Refrences </a> </li>
                            <li class="nav-item">    <a class="nav-link" href="/test">Testing</a></li> -->
                    <!-- </ul> -->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto px-5">
                        <!-- Authentication Links -->
                        <li class="nav-item py-0"> <a class="nav-link" href="/references"> Refrences </a> </li>
                        @guest
                        <li class="nav-item py-0">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item py-0 pr-2">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        <li class="nav-item py-0 pr-2">
                          <div class="donate py-0" >
                                      <form action="https://www.paypal.com/donate" method="post" target="_top">
                                      <input type="hidden" name="cmd" value="_donations" />
                                      <input type="hidden" name="business" value="prabcrist@gmail.com" />
                                      <input type="hidden" name="item_name" value="Server cost and keeping site live" />
                                      <input type="hidden" name="currency_code" value="USD" />
                                      <input type="image" src="https://www.svgrepo.com/show/104997/donate.svg"  name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                                      <img alt=""  src="https://www.paypal.com/en_NP/i/scr/pixel.gif"/>
                                      </form>
                          </div>
                        </li>

                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <?php $UserId = Auth::user()->id?>
                                <form action="/savedjobs/<?=$UserId?>" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                My Saved Jobs
                                </button>
                                </form>
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
<!--
                        <li class="nav-item">
                            <a class="nav-link ml-5" href="/update">     update</a>
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
<!-- <button class="scrollToTopBtn">🔺</button> -->
<button onclick="topFunction()" id="myBtn" title="Go to top">🔺</button>
<hr class="downside">
    <div class="site-footer">
    <div class="container">
        <div class="row justify-content-between">
          <div class="col-sm-12 col-md-6">
            <h6>About Us</h6>
            <p class="text-justify"> This website was made as a minor project from a team of students at <a target="_blank" href="https://lec.edu.np/">    Lalitpur Engineering College.</a> All job posts here belog to their respective websites..</p>
          </div>

          <!-- <div class="col-xs-6 col-md-3">
            <h6>Created</h6>
            <ul class="footer-links">
              <li><a href="http://scanfcode.com/category/c-language/">Laravel</a></li>
              <li><a href="http://scanfcode.com/category/front-end-development/">UI Design</a></li>
              <li><a href="http://scanfcode.com/category/back-end-development/">Vue.js</a></li>
              <li><a href="http://scanfcode.com/category/templates/">Templates</a></li>
            </ul>
          </div> -->

          <div class="col-xs-6 col-md-3 ">
            <h6>Quick Links</h6>
            <ul class="footer-links">
              <li><a href="https://github.com/Sanoj32/Minor-Project.git">Github</a></li>
              <li><a href="https://github.com/Sanoj32/Python-Scripts-Minor-Project.git">Python Scripts</a></li>
              <li><a href="https://lec.edu.np/">Our LEC College </a></li>
              <li><a href="/faqs"> Frequently Asked Questions(FAQs)</a></li>
            </ul>
          </div>

        </div>
      </div>
        </div>
      </div>
</footer>
</html>
<style>
  html {
  position: relative;
  min-height: 100%;
}
body {
  margin: 0 0 100px; /* bottom = footer height */
}

  .site-footer, .downside{

  line-height: inherit;
    bottom: 0;
    height: 100px;
    left: 0;
    position: absolute;
    width: 100%;
    font-size: 1rem;
    color: grey;
  }
#app{
font-size:medium;
}

.nav-item{
  font-size: large;
}

.nav-item:hover{
  text-decoration: underline;
}

.donate{
position: absolute;
margin: auto;
height: 80px;
width:60px;
padding:auto 8px;
}


.site-footer hr.small
{
  margin:20px 0px;
}

.site-footer h6
{
  color: grey;
  font-size:16px;
  text-transform:uppercase;
  margin-top:0px;
  letter-spacing:2px;
}

.site-footer a:hover
{
  color:#3366cc;
  text-decoration:none;
}
.footer-links
{
  padding-left:0;
  list-style:none;
}
.footer-links li
{
  display:block;
}
.footer-links a
{
  color: grey;
}
.footer-links a:active,.footer-links a:focus,.footer-links a:hover
{
  color:#3366cc;
  text-decoration:none;
}
.footer-links.inline li
{
  display:inline-block
}
.site-footer .social-icons
{
  text-align:center;
}
.site-footer .social-icons a
{
  width:40px;
  height:40px;
  line-height:0px;
  margin-left:6px;
  margin-right:0;
  border-radius:100%;
}
#myBtn {
  display: none; /* Hidden by default */
  position: fixed; /* Fixed/sticky position */
  bottom: 20px; /* Place the button at the bottom of the page */
  right: 30px; /* Place the button 30px from the right */
  z-index: 99; /* Make sure it does not overlap */
  border: none; /* Remove borders */
  outline: none; /* Remove outline */
  background-color: black; /* Set a background color */
  color: white; /* Text color */
  cursor: pointer; /* Add a mouse pointer on hover */
  padding: 15px; /* Some padding */
  border-radius: 50%; /* Rounded corners */
  font-size: 18px; /* Increase font size */
  transition: all .5s ease;
}

#myBtn:hover {
  background-color: black; /* Add a dark-grey background on hover */
}

@media (max-width:991px)
{
  .site-footer [class^=col-]
  {
    margin-bottom:10px;

  }
}
@media (max-width:767px)
{
  .site-footer
  {
    padding-bottom:0px;

  }
  .site-footer ,.site-footer
  {
    text-align:center;

  }

}

</style>

