<?php

namespace App\Http\Controllers;

use App\Jobs;
use App\Query;
use Carbon\Carbon;

class JobsController extends Controller
{
    public function store()
    {
        $websites = array('/linkedin.json', '/jobsnepal.json', '/globaljob.json', '/kumarijob.json', '/merojob.json', '/merorojgari.json', '/kathmandujob.json', '/kantipurjob.json');
        foreach ($websites as $website) {
            $jsondata = file_get_contents(public_path("jsondata") . $website);
            $jsondata = json_decode($jsondata, true);
            if (empty($jsondata)) {
                echo "Variable 'data' is empty.<br>";
            }
            foreach ($jsondata as $data) {
                $storedjobs = Jobs::all();
                $c          = 0; // if c=0 It means the url is a unique url from that site and filters duplicate jobs from same site
                foreach ($storedjobs as $storedjob) {
                    if ($data['Page_URL'] == $storedjob['url']) {
                        $c = 1;
                    }
                } //code to insert data in the database
                if ($c == 0) {
                    $jobs                = new Jobs();
                    $jobs['name']        = $data['name'] ?? "";
                    $jobs['company']     = $data['company'] ?? "";
                    $jobs['logo']        = $data['logo'] ?? ""; // company logo
                    $jobs['time']        = $data['time'] ?? ""; //full time or part time
                    $jobs['level']       = $data['level'] ?? ""; // Senior or junoir
                    $jobs['vacancy']     = $data['vacancy'] ?? "";
                    $jobs['address']     = $data['address'] ?? "";
                    $jobs['salary']      = $data['salary'] ?? "";
                    $jobs['deadline']    = $data['deadline'] ?? "";
                    $jobs['education']   = $data['education'] ?? "";
                    $jobs['experience']  = $data['experience'] ?? "";
                    $jobs['skills']      = $data['skills'] ?? "";
                    $jobs['skills1']     = $data['skills1'] ?? "";
                    $jobs['desct']       = $data['desct'] ?? "";
                    $jobs['url']         = $data['Page_URL'] ?? "";
                    $jobs['websitename'] = "";
                    $jobs['isExpired']   = false;
                    $jobs['isViewed']    = false;
                    $jobs['isSaved']     = false;
                    $jobs['relevancy']   = 10;
                    $jobs->save();
                }
            } // end code to insert data
        } //end of whole data collection from different websites
        //code to assign websitename
        $websitenames = array('np.linkedin.com', 'jobsnepal.com', 'globaljob.com', 'kumarijob.com', 'merojob.com', 'merorojgari.com', 'kathmandujobs.com', 'kantipurjob.com');
        foreach ($websitenames as $sitename) {
            $jobs = Jobs::where('url', 'ILIKE', '%' . $sitename . '%')->get();
            foreach ($jobs as $job) {
                $job->websitename = $sitename;
                $job->save();
            }
        }
        //end code to assign websitename

        $jobs = Jobs::where('url', 'NOT ILIKE', '%merojob%')
            ->where('url', 'NOT ILIKE', '%linkedin%')
            ->get(); //catagroize legitimate dates and calculate exact date
        $datenow = Carbon::now('Asia/Kathmandu'); //the exact date of today
        $datenow->format('Y-m-d');
        foreach ($jobs as $job) {
            $deadline   = $job->deadline;
            $deadline   = strtotime($deadline);
            $deadline   = date('Y-m-d', $deadline); //formats the date into Y-m-d format
            $comparison = date('1970-01-01');
            if (!($deadline == $comparison)) {
                $job->truedeadline = $deadline; //deadline is true deadline of the job
                if ($deadline < $datenow) {
                    $job->isExpired = true;
                }
                $job->save();
            }
        }
        //code to calculate the real date from string from merojob site
        $jobs = Jobs::where('url', 'ILIKE', '%merojob%')->get();
        foreach ($jobs as $job) {
            $deadline          = $job->deadline;
            $arr               = explode('(', $deadline);
            $date              = $arr[0];
            $actualdate        = strtotime($date);
            $realdate          = date('Y-m-d', $actualdate);
            $job->truedeadline = $realdate;
            if ($realdate < $datenow) {
                $job->isExpired = true;
            }
            $job->save();
        }

        $jobs = Jobs::where('url', 'ILIKE', '%linkedin%')->get();
        foreach ($jobs as $job) {
            $job->isExpired    = false;
            $deadline          = $job->deadline;
            $deadline          = date('Y-m-d', strtotime($deadline));
            $truedeadline      = date('Y-m-d', strtotime("+2 month", strtotime($deadline)));
            $job->truedeadline = $truedeadline;
            if ($job->truedeadline < $datenow) {
                $job->isExpired = true;
            }
            $job->save();
        }

        //Adding one month to the posted date of merorojgari
        $jobs = Jobs::where('url', 'ILIKE', '%merorojgari%')->get();
        foreach ($jobs as $job) {
            $job->isExpired    = false;
            $deadline          = $job->deadline;
            $truedeadline      = date('Y-m-d', strtotime("+1 month", strtotime($deadline)));
            $job->truedeadline = $truedeadline;
            if ($job->truedeadline < $datenow) {
                $job->isExpired = true;
            }
            $job->save();
        }

        $jsondata = file_get_contents(public_path("jsondata") . "/queries.json");
        $jsondata = json_decode($jsondata, true);

        foreach ($jsondata as $data) {

            $storedqueries = Query::all();
            $c             = 0;
            foreach ($storedqueries as $storedquery) {
                strtolower($storedquery['name']);
                if ($data['name'] == $storedquery['name']) {
                    $c = 1;
                }
            }
            if ($c == 0) {
                $query         = new Query();
                $query['name'] = $data['name'];
                $query['type'] = $data['type'];
                $query->save();
            }
        }
        $queries = Query::where('type', '!=', 'website')->get(); // Code to count the number if jobs each query has.
        foreach ($queries as $query) {
            $searchText = $query->name;
            $searchText = changeSearchText($searchText);
            $jobs       = Jobs::where('name', 'ILIKE', '%' . $searchText . '%')
                ->orwhere('skills', 'ILIKE', '%' . $searchText . '%')
                ->orwhere('skills1', 'ILIKE', '%' . $searchText . '%')
                ->orwhere('desct', 'ILIKE', '%' . $searchText . '%')
                ->get();
            $query->total_count   = $jobs->count();
            $query->active_count  = $jobs->where('isExpired', false)->count();
            $query->expired_count = $jobs->where('isExpired', true)->count();
            $query->save();

        }
        $queries = Query::where('type', 'website')->get(); // Code to count the number of jobs each sites have.
        foreach ($queries as $query) {
            $query->active_count  = Jobs::where('url', 'ilike', '%' . $query->name . '%')->where('isExpired', false)->count();
            $query->expired_count = Jobs::where('url', 'ilike', '%' . $query->name . '%')->where('isExpired', true)->count();
            $query->total_count   = Jobs::where('url', 'ilike', '%' . $query->name . '%')->count();
            $query->save();
        }

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

    // public function liveSearch(Request $request)
    // {
    //     ;
    //     $queries = Query::where('name', 'ILIKE', '%' . $request->get('searchText') . '%')->get();
    //     return json_encode($queries);
    // }

}
