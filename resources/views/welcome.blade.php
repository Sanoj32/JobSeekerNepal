@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />

<div class="container">
    <div class="row">
        <div class="col-lg-10 mx-auto mb-4">
            <div class="section-title text-center ">
                <h3 class="top-c-sep">Grow your career with us </h3>
                <p>IT and communication jobs from Nepal's most popular websites</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="career-search mb-60">

                <form action="/search" method="GET" class="career-form mb-60">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 my-3">
                            <div class="input-group position-relative">
                                <input type="text" class="form-control" @if(isset($searchText)) value="{{$searchText}}" @endif placeholder="Enter a single Keyword" id="searchText" name="searchText">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 my-3">
                            <div class="select-container">
                                <select class="custom-select" style="color: black;" style="font-weight: bold;" name="location">
                                    <option selected disabled value=""><h3>Select a location<h3></option>
                                    <option value="kathmandu">Kathmandu</option>
                                    <option value="lalitpur">Lalitpur</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 my-3">
                            <button type="submit" class="btn btn-lg btn-block btn-light btn-custom" id="contact-submit">
                                Search
                            </button>
                        </div>
                    </div>
                </form>

                <div class="filter-result">
                    <br>
                    <p class="mb-3"> There are currently <span style="font-weight: bold;"><?php echo App\Jobs::where('isExpired', '=', 'false')->count(); ?></span> total active job openings</p>

                  <?php if (!isset($searchText) && !isset($address)) {?>
                    <p class="mb-3"> Type a keyword in the search bar to find the job you are searching for. Selecting a location is optional </p>
                    
    <div class="norm">

        <ul class="tab-group">
                    
          <li class="tab">in demadn programming language
            </li>
          
        </ul>

        <div class="tab-content">
            <div id="weeklylb" class="leadboardcontent">

                <div class="leaderboard" id="leaderboard">

                    <ol>
                        <li>
                            <mark>Weekly LB</mark>
                            <small>315</small>
                        </li>
                        <li>
                            <mark>Brandon Barnes</mark>
                            <small>301</small>
                        </li>
                        <li>
                            <mark>Raymond Knight</mark>
                            <small>292</small>
                        </li>
                        <li>
                            <mark>Trevor McCormick</mark>
                            <small>245</small>
                        </li>
                        <li>
                            <mark>Andrew Fox</mark>
                            <small>203</small>
                        </li>
                       
                    </ol>
                </div>


    
            </div>
            <div id="overalllb" class="leadboardcontent" style="display:none">
                <div class="leaderboard">
<!-- 
                    <ol>
                        <li>
                            <mark> LB</mark>
                            <small>3115</small>
                        </li>
                        <li>
                            <mark>Brandon Barnes1</mark>
                            <small>3101</small>
                        </li>
                        <li>
                            <mark>Raymond Knight1</mark>
                            <small>2192</small>
                        </li>
                        <li>
                            <mark>Trevor McCormick1</mark>
                            <small>2145</small>
                        </li>
                        <li>
                            <mark>Andrew Fox1</mark>
                            <small>2103</small>
                        </li>
                      

                    </ol> -->
                </div>
            </div>
            <!-- ending tag of content -->
            
            </div>
        </div>
        <div class="norm">

<ul class="tab-group">
            
  <li class="tab">in demadn programming language
    </li>
  
</ul>

<div class="tab-content">
    <div id="weeklylb" class="leadboardcontent">

        <div class="leaderboard" id="leaderboard">

            <ol>
                <li>
                    <mark>Weekly LB</mark>
                    <small>315</small>
                </li>
                <li>
                    <mark>Brandon Barnes</mark>
                    <small>301</small>
                </li>
                <li>
                    <mark>Raymond Knight</mark>
                    <small>292</small>
                </li>
                <li>
                    <mark>Trevor McCormick</mark>
                    <small>245</small>
                </li>
                <li>
                    <mark>Andrew Fox</mark>
                    <small>203</small>
                </li>
               
            </ol>
        </div>



    </div>
    <div id="overalllb" class="leadboardcontent" style="display:none">
        <div class="leaderboard">
<!-- 
            <ol>
                <li>
                    <mark> LB</mark>
                    <small>3115</small>
                </li>
                <li>
                    <mark>Brandon Barnes1</mark>
                    <small>3101</small>
                </li>
                <li>
                    <mark>Raymond Knight1</mark>
                    <small>2192</small>
                </li>
                <li>
                    <mark>Trevor McCormick1</mark>
                    <small>2145</small>
                </li>
                <li>
                    <mark>Andrew Fox1</mark>
                    <small>2103</small>
                </li>
              

            </ol> -->
        </div>
    </div>
    <!-- ending tag of content -->
    
    </div>
</div>
<div class="norm">

<ul class="tab-group">
            
  <li class="tab">in demadn programming language
    </li>
  
</ul>

<div class="tab-content">
    <div id="weeklylb" class="leadboardcontent">

        <div class="leaderboard" id="leaderboard">

            <ol>
                <li>
                    <mark>Weekly LB</mark>
                    <small>315</small>
                </li>
                <li>
                    <mark>Brandon Barnes</mark>
                    <small>301</small>
                </li>
                <li>
                    <mark>Raymond Knight</mark>
                    <small>292</small>
                </li>
                <li>
                    <mark>Trevor McCormick</mark>
                    <small>245</small>
                </li>
                <li>
                    <mark>Andrew Fox</mark>
                    <small>203</small>
                </li>
               
            </ol>
        </div>



    </div>
    <div id="overalllb" class="leadboardcontent" style="display:none">
        <div class="leaderboard">
<!-- 
            <ol>
                <li>
                    <mark> LB</mark>
                    <small>3115</small>
                </li>
                <li>
                    <mark>Brandon Barnes1</mark>
                    <small>3101</small>
                </li>
                <li>
                    <mark>Raymond Knight1</mark>
                    <small>2192</small>
                </li>
                <li>
                    <mark>Trevor McCormick1</mark>
                    <small>2145</small>
                </li>
                <li>
                    <mark>Andrew Fox1</mark>
                    <small>2103</small>
                </li>
              

            </ol> -->
        </div>
    </div>
    <!-- ending tag of content -->
    
    </div>
</div>
<div class="norm">

<ul class="tab-group">
            
  <li class="tab">in demadn programming language
    </li>
  
</ul>

<div class="tab-content">
    <div id="weeklylb" class="leadboardcontent">

        <div class="leaderboard" id="leaderboard">

            <ol>
                <li>
                    <mark>Weekly LB</mark>
                    <small>315</small>
                </li>
                <li>
                    <mark>Brandon Barnes</mark>
                    <small>301</small>
                </li>
                <li>
                    <mark>Raymond Knight</mark>
                    <small>292</small>
                </li>
                <li>
                    <mark>Trevor McCormick</mark>
                    <small>245</small>
                </li>
                <li>
                    <mark>Andrew Fox</mark>
                    <small>203</small>
                </li>
               
            </ol>
        </div>



    </div>
    <div id="overalllb" class="leadboardcontent" style="display:none">
        <div class="leaderboard">
<!-- 
            <ol>
                <li>
                    <mark> LB</mark>
                    <small>3115</small>
                </li>
                <li>
                    <mark>Brandon Barnes1</mark>
                    <small>3101</small>
                </li>
                <li>
                    <mark>Raymond Knight1</mark>
                    <small>2192</small>
                </li>
                <li>
                    <mark>Trevor McCormick1</mark>
                    <small>2145</small>
                </li>
                <li>
                    <mark>Andrew Fox1</mark>
                    <small>2103</small>
                </li>
              

            </ol> -->
        </div>
    </div>
    <!-- ending tag of content -->
    
    </div>
</div>
        
                  <!-- PUT YOUR CODE above it  -->

                  <?php }?>


                    @if(!empty($jobs))
                    <p style="font-size: large;"> There are <span style="font-weight: bold; color:green;">{{$count}}</span> active jobs that matched your search
                        @if(!empty($searchText))
                        for <span style="font:bolder"> {{$searchText}}</span>
                        @if(!empty($address))
                        in {{$address}}
                        @endif
                         <p>( Jobs with your searched language or skill as a secondary requirement are also included. ) </p>
                        @endif
                    </p>
                    <?php $sn = 1;?>
                    @foreach($jobs as $job)
                    @if($job->isExpired == false)
                   <?php $id = $job->id;?>
                    <div class="job-box d-md-flex align-items-center justify-content-between mb-30">
                        <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                            <div class="job-content">
                            <span class="d-lg-flex">   <h5  style="font-weight: bold; font-size:large; color:black" class=" pl-3 text-center text-md-left"> <?=$sn;?>)
                                        <span class="pl-1"> {{ $job->name }}
                                            @auth
                                            <viewed-button  jobs-id="{{$job->id}}" viewedjobs="{{$job->isViewed}}" >  </viewed-button>
                                            @endauth
                                            @guest
                                           <a href="/login"> <button class="btn btn-light ml-4"> Mark as opened</button> </a>
                                            @endguest
                                        </span>
                                        </h5>
                                    </span>

                                <ul class="d-md-flex flex-wrap text-capitalize ff-open-sans">
                                    @if(!empty($job->address))
                                    <li class="mr-md-4 pt-3 pr-3" title="Address">
                                        <i class="zmdi zmdi-pin mr-2 "></i> {{$job->address}}
                                    </li>
                                    @endif
                                    @if(!empty($job->level))
                                    <li class="mr-md-4 pt-3 pr-3" title="Level">
                                        <i class="zmdi zmdi-star mr-2 "></i> {{$job->level}}
                                    </li>
                                    @endif
                                    @if(!empty($job->salary) && $job->salary != "Negotiable" && $job->salary != "As Per The Company's Policy" && $job->salary != "Negotiablemonth" && $job->salary != " Negotiable/Month")
                                    <li class="mr-md-4 pt-3 pr-3" title="Salary">
                                        <i class="zmdi zmdi-money mr-2"></i> {{$job->salary}}
                                    </li>
                                    @endif
                                    @if(!empty($job->time))
                                    <li class="mr-md-4 pt-3 pr-3" title="Employment type">
                                        <i class="zmdi zmdi-time mr-2"></i> {{$job->time}}
                                    </li>
                                    @endif
                                    @if(!empty($job->company))
                                    <li class="mr-md-4 pt-3 pr-3" title="Company name">
                                        <i class="zmdi zmdi-case-check mr-2"></i> {{$job->company}}
                                    </li>
                                    @endif
                                    @if(!empty($job->truedeadline))

                                    <li class="mr-md-4 pt-3 pr-3">

                                        @if($job->websitename == "merorojgari.com" || $job->websitename =="np.linkedin.com")
                                        <i class="zmdi zmdi-calendar-check mr-2 mb-2"></i> <span class="pr-2"> Posted Date: </span>{{$job->deadline}}

                                        @else
                                        <img style="width: 20px; height:20px" class="mr-2 mb-2" src="\images\deadline.svg">
                                        Deadline: {{$job->truedeadline ?? $job->deadline}}
                                        @endif

                                    </li>
                                    @endif
                                    <?php $sn += 1;?>
                                </ul>
                            </div>
                        </div>
                        <div class="job-right my-4 flex-shrink-0">
                            <a href="{{$job->url}}" class="btn btn-success mb-5 mt-0" target="_blank">Apply now</a>
                            <div class="font-italic">{{$job->websitename}}</div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif

                </div>
            </div>

            <!-- START Pagination -->
            <!-- <nav aria-label="Page navigation">
                <ul class="pagination pagination-reset justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                            <i class="zmdi zmdi-long-arrow-left"></i>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item d-none d-md-inline-block"><a class="page-link" href="#">2</a></li>
                    <li class="page-item d-none d-md-inline-block"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">8</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="zmdi zmdi-long-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </nav> -->
            <!-- END Pagination -->
        </div>
    </div>

</div>
@endsection
<style>
*,
*:before,
*:after {
    box-sizing: border-box;
}

 .tab {
    text-decoration: none;
    color: grey;
    -webkit-transition: .5s ease;
    transition: .5s ease;
}

 /* .norm {
     
   background: rgba(19, 35, 47, 0.9);
    padding: 10px;
    max-width: 305px;
    margin: 40px auto;
    border-radius: 20px;
    box-shadow: 0 4px 10px 4px rgba(19, 35, 47, 0.3);
    padding-bottom: 1px;
    
}  */
.tab-group {
    list-style: none;
    padding: 0px;
    margin: 0;
}
.tab-group:after {
    content: "";
    display: table;
    clear: both;
}
.tab-group .tab {
    display: inline-block;
    text-decoration: none;
    color: black;
    font-size: 20px;
    width: 100%;
    text-align: center;
    transition: .5s ease;
    padding: 5px 10px;
   
}
.tab-group , .tab{
    background: #ff8566;
    color: white;
    border-radius: 10px 10px 0 0;
}
.tab-group .active tab{
    background: #ff5c33;
    color: #ffffff;
}
.tab-content > div:last-child {
    display: none;
} */
/*--------------------
            Body
            --------------------*/
 
/* body {
    min-height: 650px;
    height: 100px;
    width: 100%;
     margin: 200px;
    background: -webkit-radial-gradient(ellipse farthest-corner at center top, #f39264 0%, #f2606f 100%);
    background: radial-gradient(ellipse farthest-corner at center top, #f39264 0%, #f2606f 100%);
    color: #fff;
    font-family: 'Open Sans', sans-serif;
    position: relative;
}  */
/*--------------------
            Leaderboard
            --------------------*/


 .leaderboard {
  -webkit-transform: translate(0%, 0%);
    transform: translate(0%, 0%);
    width: 100%;
    height: 50%;
    background: -webkit-linear-gradient(top, #3a404d, #181c26);
    background: linear-gradient(to bottom, #3a404d, #181c26);
    border-radius: 10px;
    box-shadow: 0 7px 30px rgba(62, 9, 11, 0.3);
    position:relative;
    margin-bottom: auto;
}

/* .leaderboard h1 {
    font-size: 18px;
    color: #e1e1e1;
    padding: 12px 13px 18px;
} */
.leaderboard h1  {
    width: 25px;
    height: 26px;
    position: relative;
    top: 3px;
    margin-right: 6px;
    vertical-align: baseline;
}
.leaderboard ol {
    counter-reset: leaderboard;
    padding: 0px !important;
}
.leaderboard ol li {
    position: relative;
    z-index: 1;
    font-size: 14px;
    counter-increment: leaderboard;
    padding: 18px 10px 18px 50px;
    cursor: pointer;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transform: translateZ(0) scale(1, 1);
    transform: translateZ(0) scale(1, 1);
    list-style: none;
}
.leaderboard ol li::before {
    content: counter(leaderboard);
    position: absolute;
    z-index: 2;
    top: 15px;
    left: 15px;
    width: 20px;
    height: 20px;
    line-height: 20px;
    color: #c24448;
    background: #fff;
    border-radius: 20px;
    text-align: center;
    
}
.leaderboard ol li mark {
    position: absolute;
    z-index: 2;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    padding: 18px 10px 18px 50px;
    margin: 0;
    background: none;
    color: #fff;
}
.leaderboard ol li mark::before,
.leaderboard ol li mark::after {
    content: '';
    position: absolute;
    z-index: 1;
    bottom: -11px;
    left: -9px;
    border-top: 10px solid #c24448;
    border-left: 10px solid transparent;
    -webkit-transition: all .1s ease-in-out;
    transition: all .1s ease-in-out;
    opacity: 0;
}
.leaderboard ol li mark::after {
    left: auto;
    right: -9px;
    border-left: none;
    border-right: 10px solid transparent;
}
.leaderboard ol li small {
    position: relative;
    z-index: 2;
    display: block;
    text-align: right;
    color: #fff;
}
.leaderboard ol li::after {
    content: '';
    position: absolute;
    z-index: 1;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #fa6855;
    box-shadow: 0 3px 0 rgba(0, 0, 0, 0.08);
    -webkit-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out;
    opacity: 0;
}
.leaderboard ol li:nth-child(1) {
    background: #fa6855;
    border-radius: 0px 0px;
}
.leaderboard ol li:nth-child(1)::after {
    background: #fa6855;
    border-radius:0px;
}
.leaderboard ol li:nth-child(2) {
    background: #e0574f;
}
.leaderboard ol li:nth-child(2)::after {
    background: #e0574f;
    box-shadow: 0 2px 0 rgba(0, 0, 0, 0.08);
}
.leaderboard ol li:nth-child(2) mark::before,
.leaderboard ol li:nth-child(2) mark::after {
    border-top: 6px solid #ba4741;
    bottom: -7px;
}
.leaderboard ol li:nth-child(3) {
    background: #d7514d;
}
.leaderboard ol li:nth-child(3)::after {
    background: #d7514d;
    box-shadow: 0 1px 0 rgba(0, 0, 0, 0.11);
}
.leaderboard ol li:nth-child(3) mark::before,
.leaderboard ol li:nth-child(3) mark::after {
    border-top: 2px solid #b0433f;
    bottom: -3px;
}
.leaderboard ol li:nth-child(4) {
    background: #cd4b4b;
}
.leaderboard ol li:nth-child(4)::after {
    background: #cd4b4b;
    box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.15);
}
.leaderboard ol li:nth-child(4) mark::before,
.leaderboard ol li:nth-child(4) mark::after {
    top: -7px;
    bottom: auto;
    border-top: none;
    border-bottom: 6px solid #a63d3d;
}
.leaderboard ol li:nth-child(5) {
    background: #cd4b4b;
}
.leaderboard ol li:nth-child(5)::after {
    background: #cd4b4b;
    box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.15);
}
.leaderboard ol li:nth-child(5) mark::before,
.leaderboard ol li:nth-child(4) mark::after {
    top: -7px;
    bottom: auto;
    border-top: none;
    border-bottom: 6px solid #a63d3d;
}
.leaderboard ol li:nth-child(6) {
    background: #cd4b4b;
}
.leaderboard ol li:nth-child(6)::after {
    background: #cd4b4b;
    box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.15);
}
.leaderboard ol li:nth-child(6) mark::before,
.leaderboard ol li:nth-child(4) mark::after {
    top: -7px;
    bottom: auto;
    border-top: none;
    border-bottom: 6px solid #a63d3d;
}
.leaderboard ol li:nth-child(7) {
    background: #cd4b4b;
}
.leaderboard ol li:nth-child(7)::after {
    background: #cd4b4b;
    box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.15);
}
.leaderboard ol li:nth-child(7) mark::before,
.leaderboard ol li:nth-child(4) mark::after {
    top: -7px;
    bottom: auto;
    border-top: none;
    border-bottom: 6px solid #a63d3d;
}
.leaderboard ol li:nth-child(5) {
    background: #c24448;
    border-radius: 0 0 10px 10px;
}
.leaderboard ol li:nth-child(5)::after {
    background: #c24448;
    box-shadow: 0 -2.5px 0 rgba(0, 0, 0, 0.12);
    border-radius: 0 0 10px 10px;
}
.leaderboard ol li:nth-child(5) mark::before,
.leaderboard ol li:nth-child(5) mark::after {
    top: -9px;
    bottom: auto;
    border-top: none;
    border-bottom: 8px solid #993639;
}
.leaderboard ol li:hover {
    z-index: 2;
    overflow: visible;
}
.leaderboard ol li:hover::after {
    opacity: 1;
    -webkit-transform: scaleX(1.06) scaleY(1.03);
    transform: scaleX(1.06) scaleY(1.03);
}
.leaderboard ol li:hover mark::before,
.leaderboard ol li:hover mark::after {
    opacity: 1;
    -webkit-transition: all .35s ease-in-out;
    transition: all .35s ease-in-out;
}
.profile span {
  font-style: normal;
}






kbd {
  display: inline-block;
  font-family: inherit;
  font-size: 0.875em;
  vertical-align: 0.125em;
  margin-right: 0.5em;
  color: slategray;
}

@media screen and (min-width: 30em) {
  .profile__image {
    display: inline-block;
    margin: 0 3em 0 2em;
  }
}

.profile__details {
  margin: 0 2em 0 0;
  text-align: center;
}
@media screen and (min-width: 30em) {
  .profile__details {
    display: inline-block;
    vertical-align: top;
    text-align: left;
  }
}


</style>