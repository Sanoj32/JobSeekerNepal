@extends('layouts.app')

@section('content')


<?php
use App\Jobs;
use App\Query;

// code to assign dynamic value to the programming languages pie chart
$languages                = Query::where('type', 'ilike', '%Progaramming Language%')->get();
$popularLanguagesUnsorted = $languages->sortByDesc('active_count')->take(5);
$popularLanguages         = $popularLanguagesUnsorted->sortBy('name');
$unpopularLanguages       = $languages->sortBy('active_count')->take(3);
$languageNames            = [];
$languageCounts           = [];
foreach ($popularLanguages as $popularLanguage) {
    array_push($languageNames, $popularLanguage->name);
    array_push($languageCounts, $popularLanguage->active_count);
}
$unpopularLanguageCounts = 0;
foreach ($unpopularLanguages as $unpopularLanguage) {
    $unpopularLanguageCounts += $unpopularLanguage->active_count;
}
array_push($languageNames, 'Others');
array_push($languageCounts, $unpopularLanguageCounts);

//end code
//code to assign dynamic value to the frameworks pie chart

$frameworks = Query::where('type', 'ilike', '%framework%')
    ->orwhere('type', 'ilike', '%runtime%')
    ->orwhere('type', 'ilike', '%library%')
    ->get();

$frameworkNames            = [];
$frameworkCounts           = [];
$popularFrameworksUnSorted = $frameworks->sortByDesc('active_count')->take(6);
$popularFrameworks         = $popularFrameworksUnSorted->sortBy('name');
$unpopularFrameworks       = $frameworks->sortBy('active_count')->take(6);
foreach ($popularFrameworks as $popularFramework) {
    array_push($frameworkNames, $popularFramework->name);
    array_push($frameworkCounts, $popularFramework->active_count);
}

$unpopularFrameworkCounts = 0;
foreach ($unpopularFrameworks as $unpopularFramework) {
    $unpopularFrameworkCounts += $unpopularFramework->active_count;
}
array_push($frameworkNames, 'Others');
array_push($frameworkCounts, $unpopularFrameworkCounts);
//end code
//code to assign dynamic values to database pichart

$database = Query::where('type', 'ilike', '%database%')->get();

$databaseNames   = [];
$databaseCounts  = [];
$popularDatabase = $database->sortBy('name');
foreach ($popularDatabase as $popularDatabase) {
    array_push($databaseNames, $popularDatabase->name);
    array_push($databaseCounts, $popularDatabase->active_count);
}

//code to assign dynamic value to the jobsites pie chart
$jobsCount              = Jobs::all();
$websiteNames           = [];
$websiteNamesTemp       = ['np.linkedin.com', 'merojob.com', 'jobsnepal.com', 'globaljob.com', 'merorojgari.com', 'kathmandujobs.com', 'kumarijob.com', 'kantipurjob.com'];
$websiteCountsTemp      = [];
$websiteCounts          = [];
$unPopularWebsiteCounts = 0;
foreach ($websiteNamesTemp as $websiteNameTemp) {
    $websiteCount = $jobsCount->where('websitename', $websiteNameTemp)->where('isExpired', false)->count();
    array_push($websiteCountsTemp, $websiteCount);
}
$combinedSite = array_combine($websiteNamesTemp, $websiteCountsTemp);
arsort($combinedSite);
$arCount = 0;
foreach ($combinedSite as $key => $value) {
    if ($arCount < 6) {
        array_push($websiteNames, $key);
        array_push($websiteCounts, $value);
        $arCount++;
    } else {
        $unPopularWebsiteCounts += $value;
    }
}

array_push($websiteNames, 'others');
array_push($websiteCounts, $unPopularWebsiteCounts)

?>


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
                                <input type="text" class="form-control" @if(isset($searchText)) value="{{$searchText}}" @endif placeholder="Enter a Keyword. eg- Laravel" id="searchText" name="searchText">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 my-3">
                            <div class="select-container">
                                <select class="custom-select" style="color: black;" style="font-weight: bold;" name="location">
                                <option selected  value=""><h3>Select a location<h3></option>

                                <?php $options = array('kathmandu', 'lalitpur', 'other');?>
                                    <?php foreach ($options as $option): ?>
                                        <option value="<?php echo $option; ?>" <?php echo (isset($_GET['location']) && $_GET['location'] == $option) ? 'selected' : ''; ?>>
                                            <?php echo $option; ?>
                                        </option>
                                    <?php endforeach;?>
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
                    <p class="mb-3"> There are currently <span style="font-weight: bold;"><?php echo App\Jobs::where('isExpired', '=', 'false')->count(); ?></span> total active job openings.<a href="/all"> View all </a> </p>
                  <?php if (!isset($searchText) && !isset($address)) {?>
                    <p class="mb-3"> Type a keyword in the search bar to find the job you are searching for. Selecting a location is optional. </p>


                  <?php }?>


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
                    Like the website? Consider bookmarking us. Control + D on windows.
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
}
p.fontweight{
  font-weight: 100;
  opacity: 0.5

}
.popular{

}
</style>


<!-- links for the pie chart -->
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script> -->


<script type="text/javascript">
var languageNames = <?=json_encode($languageNames)?>;
var languageCounts = <?=json_encode($languageCounts)?>;
var frameworkNames = <?=json_encode($frameworkNames)?>;
var frameworkCounts = <?=json_encode($frameworkCounts)?>;
var databaseNames = <?=json_encode($databaseNames)?>;
var databaseCounts = <?=json_encode($databaseCounts)?>;
var websiteNames = <?=json_encode($websiteNames)?>;
var websiteCounts = <?=json_encode($websiteCounts)?>;

</script>
