<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Jobs;
use Carbon\Carbon;

class JobsController extends Controller
{
    public function store()
    {
        $websites = array('\linkedin.json', '\jobsnepal.json', '\merocareer.json', '\kumarijobs.json', '\merojobs.json');
        foreach ($websites as $website) {
            $jsondata = file_get_contents(public_path("jsondata") . $website);
            $jsondata = json_decode($jsondata, true);
            if (empty($jsondata)) {
                echo "Variable 'data' is empty.<br>";
            }
            foreach ($jsondata as $data) {
                $storedjobs = Jobs::all();
                $c = 0; // if c=0 It means the url is a unique url from that site and filters duplicate jobs from same site
                foreach ($storedjobs as $storedjob) {
                    if ($data['Page_URL'] == $storedjob['url']) {
                        $c = 1;
                    }
                } //code to insert data in the database
                if ($c == 0) {
                    $jobs = new Jobs();
                    $jobs['name'] = $data['name'] ?? "";
                    $jobs['company'] = $data['company'] ?? "";
                    $jobs['logo'] = $data['logo'] ?? ""; // company logo
                    $jobs['time'] = $data['time'] ?? ""; //full time or part time
                    $jobs['level'] = $data['level'] ?? ""; // Senior or junoir
                    $jobs['vacancy'] = $data['vacancy'] ?? "";
                    $jobs['address'] = $data['address'] ?? "";
                    $jobs['salary'] = $data['salary'] ?? "";
                    $jobs['deadline'] = $data['deadline'] ?? "";
                    $jobs['education'] = $data['education'] ?? "";
                    $jobs['experience'] = $data['experience'] ?? "";
                    $jobs['skills'] = $data['skills'] ?? "";
                    $jobs['skills'] = $data['skills'] ?? "";
                    $jobs['desc'] = $data['desc'] ?? "";
                    $jobs['desc1'] = $data['desc1'] ?? "";
                    $jobs['desc2'] = $data['desc2'] ?? "";
                    $jobs['desc3'] = $data['desc3'] ?? "";
                    $jobs['desc4'] = $data['desc4'] ?? "";
                    $jobs['url'] = $data['Page_URL'] ?? "";
                    $jobs['websitename'] = "";
                    $jobs['isExpired'] = false;
                    $jobs['relevancy'] = 10;
                    $jobs->save();
                }
            } // end code to insert data
        } //end of whole data collection from different websites 
        $websitenames = array('linkedin.com', 'jobsnepal.com', 'merocareer.com', 'kumarijobs.com', 'merojobs.com');
        $jobs = Jobs::where('url', 'not like', '%merojob%'); //catagroize legitimate dates and calculate exact date
        $datenow = Carbon::now('Asia/Kathmandu'); //the exact date of today
        foreach ($jobs as $job) {
            $deadline = $job->deadline;
            $deadline = strtotime($deadline);
            $deadline = date('Y-m-d', $deadline); //formats the date into Y-m-d format
            $comparison = date('1970-01-01');
            if (!($deadline == $comparison)) {
                $job->truedeadline = $deadline; //deadline is true deadline of the job
                $datenow->format('Y-m-d');
                if ($deadline < $datenow) {
                    $job->isExpired = true;
                }
                $job->save();
            }
        }
        //code to calculate the real date from string from merojob site
        $jobs = Jobs::where('url', 'like', '%merojob%')->get();
        foreach ($jobs as $job) {
            $deadline = $job->deadline;
            $arr = explode('(', $deadline);
            $date = $arr[0];
            $actualdate = strtotime($date);
            $realdate = date('Y-m-d', $actualdate);
            $job->truedeadline = $realdate;
            if ($realdate < $datenow) {
                $job->isExpired = true;
            }
            $job->save();
        }
        //end real date calculation code

        //code to assign websitename
        $websitenames = array('np.linkedin.com', 'jobsnepal.com', 'merocareer.com', 'kumarijob.com', 'merojob.com');
        foreach ($websitenames as $sitename) {
            $jobs = Jobs::where('url', 'like', '%' . $sitename . '%')->get();
            foreach ($jobs as $job) {
                $job->websitename = $sitename;
                $job->save();
            }
        }
        //end code to assign websitename

        return redirect('/');
    }
    public function search()
    {
        $searchText = $_GET['searchText'];
        $jobs = Jobs::where('name', 'LIKE', '%' . $searchText . '%')
            ->orwhere('skills', 'LIKE', '%' . $searchText . '%')
            ->orwhere('skills1', 'LIKE', '%' . $searchText . '%')
            ->orwhere('desc', 'LIKE', '%' . $searchText . '%')
            ->orwhere('desc1', 'LIKE', '%' . $searchText . '%')
            ->orwhere('desc2', 'LIKE', '%' . $searchText . '%')
            ->orwhere('desc3', 'LIKE', '%' . $searchText . '%')
            ->orwhere('desc4', 'LIKE', '%' . $searchText . '%')
            ->get();
        foreach ($jobs as $job) {
            $job->relevacny = 0;
            $name = Str::lower($job->name); //the job name in lowercase
            $search = Str::lower($searchText);  //the searchText in lower case
            if (Str::contains($name, $search)) {  // check if a string contains a substring

                $job->relevancy += 100;
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
        }
        $count = $jobs->where('isExpired', '=', 'false')->count();
        $jobs = $jobs->sortByDesc('relevancy');
        return view('welcome', compact('jobs', 'count', 'searchText'));
    }
    public function test()
    {
        return view('test');
    }
}
