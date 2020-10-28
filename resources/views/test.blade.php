<?php

use App\Jobs;
use Carbon\Carbon;

$jsondata = file_get_contents('merojob.json');
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
        $jobs['skills']      = $data['skills'] ?? "";
        $jobs['desc']        = $data['desc'] ?? "";
        $jobs['desc1']       = $data['desc1'] ?? "";
        $jobs['desc2']       = $data['desc2'] ?? "";
        $jobs['desc3']       = $data['desc3'] ?? "";
        $jobs['desc4']       = $data['desc4'] ?? "";
        $jobs['url']         = $data['Page_URL'] ?? "";
        $jobs['websitename'] = "";
        $jobs['isExpired']   = false;
        $jobs['isViewed']    = false;
        $jobs['relevancy']   = 10;
        $jobs->save();
    }
} // end code to insert data
//end of whole data collection from different websites
//code to assign websitename
$websitenames = array('np.linkedin.com', 'jobsnepal.com', 'merocareer.com', 'kumarijob.com', 'merojob.com');
foreach ($websitenames as $sitename) {
    $jobs = Jobs::where('url', 'ILIKE', '%' . $sitename . '%')->get();
    foreach ($jobs as $job) {
        $job->websitename = $sitename;
        $job->save();
    }
}
//end code to assign websitename

$jobs    = Jobs::where('url', 'not ILIKE', '%merojob%')->get(); //catagroize legitimate dates and calculate exact date
$datenow = Carbon::now('Asia/Kathmandu'); //the exact date of today
foreach ($jobs as $job) {
    echo $job->websitename . "<hr>";
    $deadline   = $job->deadline;
    $deadline   = strtotime($deadline);
    $deadline   = date('Y-m-d', $deadline); //formats the date into Y-m-d format
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
