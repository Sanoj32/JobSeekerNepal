<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;

use Illuminate\Support\Str;


use App\Jobs;

class JobsController extends Controller
{
    public function store()
    {
        $websites = array('\jobsnepal.json', '\merocareer.json', '\kumarijobs.json', '\merojob.json');
        foreach ($websites as $website) {
            $jsondata = file_get_contents(public_path("jsondata") . $website);
            $jsondata = json_decode($jsondata, true);
            if (empty($jsondata)) {
                echo "Variable 'data' is empty.<br>";
            }
            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
            foreach ($jsondata as $data) {
                $storedjobs = Jobs::all();
                $c = 0; // if c=0 It means the url is a unique url from that site and filters duplicate jobs from same site
                foreach ($storedjobs as $storedjob) {
                    if ($data['Page_URL'] == $storedjob['url']) {
                        $c = 1;
                    }
                }
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
                    $jobs['desc'] = $data['desc'] ?? "";
                    $jobs['desc1'] = $data['desc1'] ?? "";
                    $jobs['desc2'] = $data['desc2'] ?? "";
                    $jobs['desc3'] = $data['desc3'] ?? "";
                    $jobs['desc4'] = $data['desc4'] ?? "";
                    $jobs['url'] = $data['Page_URL'] ?? "";
                    $jobs['relevancy'] = 0;
                    $jobs->save();
                }
            }
        }
        return redirect('/');
    }
    public function search()
    {
        $searchText = $_GET['searchText'];
        $jobs = Jobs::where('name', 'LIKE', '%' . $searchText . '%')
            ->orwhere('skills', 'LIKE', '%' . $searchText . '%')
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
                // echo $job->name;
                // echo "this contains the search word on name";
                // echo "<br>";
                $job->relevancy += 100;
                // echo  $job->relevancy;
                // echo "<br>";
                // echo "<br>";
                // echo "<br>";
            }
            $skills = Str::lower($job->skills); // skills to lower case
            if (Str::contains($job->skills, $searchText)) {
                // echo $job->skills;
                // echo "this contains the search word on name";
                // echo "<br>";
                $job->relevancy += 50;
            }
        }
        return view('search', compact('jobs'));
    }
}
