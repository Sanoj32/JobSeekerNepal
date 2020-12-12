<?php

namespace App\Http\Controllers;

use App\Jobs;
use App\Jobs\UpdateJobs;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    public function store()
    {
        UpdateJobs::dispatch()
            ->delay(now()->addSeconds(5));

        return redirect('/');
    }
    public function search()
    {
        if (isset($_GET['searchText'])) {
            $searchText = $_GET['searchText'];
        } else {
            $searchText = "";
        }
        if (isset($_GET['location'])) {
            $address = $_GET['location'];
        } else {
            $address = "";
        }
        if ($searchText == "" && $address == "") {
            //if both search text and location select are empty just redirect the user to homepage
            return redirect('/');
        }

        $ogsearchText = $searchText;

        $searchText = changeSearchText($searchText); // Custom function autoloaded from composer.json in app/helpers.php

        $jobs = searchJobs($searchText, $address); // Custom function to get the jobs according to the query provided by the user.

        $jobs = setRelevancy($jobs, $searchText); //custom function to set the relevancy of the search results.

        $count      = $jobs->count();
        $searchText = $ogsearchText;
        foreach ($jobs as $job) {
            $jobstatus = (auth()->user()) ? auth()->user()->viewedjobs->contains($job->id) : false;
            if ($jobstatus == true) {
                $job->relevancy = 0;
                $job->isViewed  = true;
            } else {
                $job->isViewed = false;
            };
        }
        foreach ($jobs as $job) {
            $jobstatus = (auth()->user()) ? auth()->user()->savedjobs->contains($job->id) : false;
            if ($jobstatus == true) {
                $job->isSaved = true;
            } else {
                $job->isSaved = false;
            };
        }
        $jobs  = $jobs->sortByDesc('relevancy');
        $count = $jobs->count();

        return view('welcome', compact('jobs', 'count', 'searchText', 'address'));

    }

    public function index()
    {

        $jobs = DB::table('jobs')->orderByDesc('created_at')->where('isExpired', false)->paginate(50);

        $count = Jobs::where('isExpired', false)->count();
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
        }
        return view('allJobs', compact('jobs', 'count'));

    }

    // public function liveSearch(Request $request)
    // {
    //     ;
    //     $queries = Query::where('name', 'ILIKE', '%' . $request->get('searchText') . '%')->get();
    //     return json_encode($queries);
    // }

}
