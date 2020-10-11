<?php

namespace App\Http\Controllers;

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
                $c = 0; // if c=0 It means the url is a unique url and filters duplicate jobs from same site
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
                    $jobs->save();
                }
            }
            return redirect('/');
        }
    }
}
