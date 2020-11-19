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


                  <?php }?>


                    @if(!empty($jobs))
                    @if($count != 0)
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
                                           <saved-button  jobs-id="{{$job->id}}" savedjobs="{{$job->isSaved}}" >  </saved-button>
                                            @endauth
                                            @guest
                                           <a href="/login"> <button class="btn btn-light ml-4"> Mark as opened</button> </a>
                                           <a href="/login"> <button class="btn btn-light ml-3">Save</button> </a>
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
                    @else
                    <div class="align-content-center">

                            <img class="center" src="/images/emptyresult.png">
                            <h3 ><p class="text-center fontweight pt-2">No results found</p></h1>
                    </div>
                    @endif
                    @else


                        <div class="page-content page-container" id="page-content">
                            <div class="padding">
                                <div class="row">
                                    <div class="container-fluid d-flex justify-content-center">
                                        <div class="col-sm-8 col-md-6">
                                            <div class="card">
                                                <div class="card-header">Pie chart</div>
                                                <div class="card-body" style="height: 420px">
                                                    <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                        <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                        </div>
                                                        <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                        </div>
                                                    </div> <canvas id="chart-line" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 70%;
}
p.fontweight{
  font-weight: 100;
  opacity: 0.5

}
</style>



<script>

</script>