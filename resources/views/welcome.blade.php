@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />

<div class="container">
    <div class="row">
        <div class="col-lg-10 mx-auto mb-4">
            <div class="section-title text-center ">
                <h3 class="top-c-sep">Grow your career with us </h3>
                <p>IT and communication job from over 7 sites in a single website.</p>
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
                                    <option selected disabled value="">Select a location</option>
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
                    @if( !isset($searchText) && !isset($address))
                    <p class="mb-30 ff-montserrat"> Type a keyword the search bar to find the job you are searching for. Selecting a location is optional </p>
                    @endif

                    <p class="mb-30 ff-montserrat"> There are currently <span style="font-weight: bold;"><?php echo App\Jobs::where('isexpired', '=', 'false')->count(); ?></span> total active job openings

                    </p>


                    @if(!empty($jobs))
                    <p style="font-size: large;" class="mb-30 ff-montserrat"> There are <span style="font-weight: bold; color:green;">{{$count}}</span> active jobs that matched your search
                        @if(!empty($searchText))
                        for <span style="font:bolder"> {{$searchText}}</span>
                        @endif
                        @if(!empty($address))
                        in {{$address}}
                        @endif
                    </p>


                    <?php $sn = 1; $no = 0; ?>
                    <!--  Count for the status array -->
                    @foreach($jobs as $job)
                    @if($job->isExpired == false)
                    <div class="job-box d-md-flex align-items-center justify-content-between mb-30">
                        <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                            <div class="job-content">
                            <span class="d-lg-flex">   <h5  style="font-weight: bold; font-size:large; color:black" class=" pl-3 text-center text-md-left"> <?= $sn; ?>)
                                        <span class="pl-1"> {{ $job->name }} {{$job->relevancy}}
                                            @auth
                                            <viewed-button jobs-id="{{$job->id}}" viewedjobs="{{$viewed[$no]}}" >  </viewed-button> 
                                            @endauth
                                            @guest
                                           <a href="/login"> <button class="btn btn-primary ml-4"> Mark as opened</button> </a>
                                            @endguest
                                            <?php
                                            $no += 1;
                                            ; ?>
                                        </span>
                                        </h5>
                                    </span> 

                                <ul class="d-md-flex flex-wrap text-capitalize ff-open-sans">
                                    @if(!empty($job->address))
                                    <li class="mr-md-4 pt-3 pr-3">
                                        <i class="zmdi zmdi-pin mr-2 "></i> {{$job->address}}
                                    </li>
                                    @endif
                                    @if(!empty($job->level))
                                    <li class="mr-md-4 pt-3 pr-3">
                                        <i class="zmdi zmdi-star mr-2 "></i> {{$job->level}}
                                    </li>
                                    @endif
                                    @if(!empty($job->salary))
                                    <li class="mr-md-4 pt-3 pr-3">
                                        <i class="zmdi zmdi-money mr-2"></i> {{$job->salary}}
                                    </li>
                                    @endif
                                    @if(!empty($job->time))
                                    <li class="mr-md-4 pt-3 pr-3">
                                        <i class="zmdi zmdi-time mr-2"></i> {{$job->time}}
                                    </li>
                                    @endif
                                    @if(!empty($job->company))
                                    <li class="mr-md-4 pt-3 pr-3">
                                        <i class="zmdi zmdi-case-check mr-2"></i> {{$job->company}}
                                    </li>
                                    @endif
                                    @if(!empty($job->truedeadline))
                                    <li class="mr-md-4 pt-3 pr-3">
                                        <i class="zmdi zmdi-timer mr-2"></i> {{$job->truedeadline ?? $job->deadline}}
                                    </li>

                                    @endif
                                    <?php $sn += 1; ?>
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