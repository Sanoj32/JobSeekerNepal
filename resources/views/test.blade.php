
<?php
use App\Jobs;
use Carbon\Carbon;

$datenow = Carbon::now('Asia/Kathmandu'); //the exact date of today
$datenow->format('Y-m-d');

$jobs = Jobs::where('url', 'ILIKE', '%merorojgari%')->get();
foreach ($jobs as $job) {
    $job->isExpired = false;
    $deadline       = $job->deadline;
    echo $deadline;
    echo "<br>";
    $truedeadline      = date('Y-m-d', strtotime("+1 month", strtotime($deadline)));
    $job->truedeadline = $truedeadline;
    if ($job->truedeadline < $datenow) {
        $job->isExpired = true;
    }
    echo $job->truedeadline;
    echo "<hr>";
    $job->save();
}