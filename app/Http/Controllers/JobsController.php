<?php

namespace App\Http\Controllers;

use App\Jobs;
use Carbon\Carbon;
use Illuminate\Support\Str;

class JobsController extends Controller
{
    public function store()
    {
        $websites = array('/linkedin.json', '/jobsnepal.json', '/globaljob.json', '/kumarijob.json', '/merojob.json', '/merorojgari.json');
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
                    $jobs['relevancy']   = 10;
                    $jobs->save();
                }
            } // end code to insert data
        } //end of whole data collection from different websites
        //code to assign websitename
        $websitenames = array('np.linkedin.com', 'jobsnepal.com', 'globaljob.com', 'kumarijob.com', 'merojob.com', 'merorojgari.com');
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
            $truedeadline      = date('Y-m-d', strtotime("+1 month", strtotime($deadline)));
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

        return redirect('/');
    }
    public function search()
    {

        if (isset($_GET['location'])) {
            $address = $_GET['location'];
        } else {
            $address = "";
        }

        $searchText   = $_GET['searchText'];
        $ogsearchText = $searchText;
        $searchText   = strtolower($searchText);
        if ($searchText == 'dot net' || $searchText == 'dotnet') {
            $searchText = ".net";
        }
        if ($searchText == 'java') {
            $searchText = "java ";
        }

        if ($searchText == 'js') {
            $searchText = "javascript";
        }
        if (Str::contains($searchText, 'node')) {
            $searchText = 'node';
        }
        if (Str::contains($searchText, 'react')) {
            $searchText = 'react';
        }
        if ($searchText == "" && $address == "") {
            //if both search text and location select are empty just redirect the user to homepage
            return redirect('/');
        }
        if ($searchText == "go") {
            $searchText = " go ";
        }
        if ($searchText == "express" || $searchText == "express js" || $searchText == "expressjs" || $searchText == "express.js") {
            $searchText = " express ";
        }
        if ($searchText == "" && $address != "") {
            //if only the searchtext is empty show jobs with the selected address
            if ($address != 'other') {

                $jobs = Jobs::where('address', 'ILIKE', '%' . $address . '%')
                    ->where('isExpired', '=', 'false')
                    ->get();
                $count = $jobs->count();
                return view('welcome', compact('jobs', 'count', 'address'));
            } else {

                $jobs = Jobs::where('address', 'not ILIKE', '%kathmandu%')
                    ->where('address', 'not ILIKE', '%lalitpur%')
                    ->where('isExpired', '=', 'false')
                    ->get();
                $count = $jobs->count();
                return view('welcome', compact('jobs', 'count', 'address'));
            }
        }

        if ($address != 'other' && $searchText != "") {
            //if the address isn't empty only get the jobs containing this address and searchtext isn't empty

            $jobs = Jobs::where('isExpired', '=', 'false')
                ->where('address', 'ILIKE', '%' . $address . '%')
                ->where(function ($query) use ($searchText) {
                    $query->where('name', 'ILIKE', '%' . $searchText . '%')
                        ->orwhere('skills', 'ILIKE', '%' . $searchText . '%')
                        ->orwhere('skills1', 'ILIKE', '%' . $searchText . '%')
                        ->orwhere('desct', 'ILIKE', '%' . $searchText . '%');
                })
                ->get();
        }

        if ($searchText != "" && $address == 'other') {

            $jobs = Jobs::where('address', 'not ILIKE', '%kathmandu%')
                ->where('address', 'not ILIKE', '%lalitpur%')
                ->where('isExpired', '=', 'false')
                ->where(function ($query) use ($searchText) {
                    $query->where('name', 'ILIKE', '%' . $searchText . '%')
                        ->orwhere('skills', 'ILIKE', '%' . $searchText . '%')
                        ->orwhere('skills1', 'ILIKE', '%' . $searchText . '%')
                        ->orwhere('desct', 'ILIKE', '%' . $searchText . '%');
                })
                ->get();
        }
        foreach ($jobs as $job) {

            $job->relevacny = 0;
            $name           = Str::lower($job->name); //the job name in lowercase
            $search         = Str::lower($searchText); //the searchText in lower case
            if (Str::contains($name, $search)) {
                // check if a string contains a substring
                $job->relevancy += 200;
            }
            $skills = Str::lower($job->skills); // skills to lower case
            if (Str::contains($skills, $searchText)) {
                $job->relevancy += 40;
            }
            $skills1 = Str::lower($job->skills1); // skills to lower case
            if (Str::contains($skills1, $searchText)) {
                $job->relevancy += 40;
            }
            if ($job->isExpired == true) {
                $job->relevancy = 0;
            }
            $jobstatus = (auth()->user()) ? auth()->user()->viewedjobs->contains($job->id) : false;
            if ($jobstatus == true) {
                $job->relevancy = 0;
                $job->isViewed  = true;
            } else {
                $job->isViewed = false;
            };
        }
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
        $jobs = $jobs->sortByDesc('relevancy');
        return view('welcome', compact('jobs', 'count', 'searchText', 'address'));
    }
}
