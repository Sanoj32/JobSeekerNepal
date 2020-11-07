
<?php
use App\Jobs;

$jobs = Jobs::where('url', 'ILIKE', '%linkedin%')->get();
foreach ($jobs as $job) {
    $job->isExpired    = false;
    $deadline          = $job->deadline;
    $deadline          = date('Y-m-d', strtotime($deadline));
    $truedeadline      = date('Y-m-d', strtotime("+1 month", strtotime($deadline)));
    $job->truedeadline = $truedeadline;
    $job->save();
}