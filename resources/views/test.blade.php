<?php
use App\Jobs;
$jobs = Jobs::where('isExpired', false);
$sn   = 1;
foreach ($jobs as $job) {
    $jobstatus = (auth()->user()) ? auth()->user()->viewedjobs->contains($job->id) : false;
    if ($jobstatus == true) {
        $job->relevancy = 0;
        $job->isViewed  = true;
    } else {
        $job->isViewed = false;
    }
    ;
}
foreach ($jobs as $job) {
    $jobstatus = (auth()->user()) ? auth()->user()->savedjobs->contains($job->id) : false;
    if ($jobstatus == true) {
        $job->isSaved = true;
    } else {
        $job->isSaved = false;
    }
    ;
}
?>
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