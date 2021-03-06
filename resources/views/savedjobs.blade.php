@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-10 mx-auto mb-4">
            <div class="section-title text-center ">
                <h3 class="top-c-sep">My saved Jobs </h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="career-search mb-60">

                <div class="filter-result">
                    <br>


                    @if(!empty($jobs))
                    @if($count != 0)
                    <p style="font-size: large;"> You have <span style="font-weight: bold; color:green;">{{$count}}</span> saved jobs.
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
                                           <saved-button  jobs-id="{{$job->id}}" savedjobs="{{$job->isSaved}}" >  </saved-button>
                                            @endauth

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

                    <img class="center" src="/images/empty.png">
                    <h3 ><p class="text-center fontweight">Nothing to see here- Yet</p></h1>
                    </div>
                    @endif
                    @endif

                </div>
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
  width: 50%;
}
p.fontweight{
  font-weight: 100;
  opacity: 0.5

}
</style>
