@extends('layouts.app')

@section('content')


<div class="container">

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="career-search mb-60">


                <div class="filter-result">


                    @if(!empty($jobs))
                    @if($count != 0)
                    <p style="font-size: large;"> There are <span style="font-weight: bold; color:green;">{{$count}}</span> active jobs
                        @if(!empty($searchText))
                        that matched your search for <span style="font:bolder"> {{$searchText}}</span>
                        @endif
                        @if(!empty($address))
                        in {{$address}}
                        @if(!empty($searchText))

                         <p>( Jobs with your searched language or skill as a secondary requirement are also included. ) </p>
                        @endif
                        @endif
                    </p>
                    <?php $sn = 1;?>
                    @foreach($jobs as $job)
                    @if($job->isExpired == false)
                   <?php $id = $job->id;?>
                    <div class="job-box d-md-flex align-items-center justify-content-between mb-30">
                        <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                            <div class="job-content">
                            <span class="d-lg-flex">   <h5  style="font-weight: bold; font-size:large; color:black" class=" pl-4 text-center text-md-left"> 
                                        <span class="pl-3"> {{ $job->name }}
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
                    <script type="application/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>
                    <script type="application/javascript" src="{{ asset('js/piechart.js') }}" defer></script>


                        <img class="img-resposive center" width="170" height="120"  src="images/mostp.png">
                        <div class="page-content page-container" id="page-content">
                            <div class="padding">
                                <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header text-center">Programming language</div>
                                                <div class="card-body" style="height: 400px">
                                                    <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                        <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                        </div>
                                                        <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                        </div>
                                                    </div>

                                                    <canvas id="chart-line" width="399" height="400" class="chartjs-render-monitor" style="display: block; width: 400px; height: 500px;"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header text-center">Framework/Libray/Runtime</div>
                                                <div class="card-body" style="height: 400px">
                                                    <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                        <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                        </div>
                                                        <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                        </div>
                                                    </div> <canvas id="chart-line2" width="399" height="400" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    <div class="lez">
                        <div class="page-content page-container" id="page-content">
                            <div class="padding" >
                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header text-center">Database</div>
                                                <div class="card-body" style="height: 400px">
                                                    <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                        <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                        </div>
                                                        <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                        </div>
                                                    </div>

                                                    <canvas id="chart-line3" width="399" height="400" class="chartjs-render-monitor" style="display: block; width: 400px; height: 500px;"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="card">
                                            <div class="card-header text-center">Job sites</div>
                                                <div class="card-body" style="height: 400px">
                                                    <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                        <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                        </div>
                                                        <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                        </div>
                                                    </div> <canvas id="chart-line4" width="399" height="400" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
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
            <div class="center">
            {{$jobs->links()}}
            </div>
        </div>
    </div>

</div>
 @endsection
 <style>
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
p.fontweight{
  font-weight: 100;
  opacity: 0.5

}
.popular{

}
</style>