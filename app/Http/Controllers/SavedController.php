<?php

namespace App\Http\Controllers;

use App\Jobs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SavedController extends Controller
{
    public function index($userId)
    {
        $jobsId = DB::table('saved_jobs')->where('user_id', '=', $userId)->pluck('jobs_id');
        $jobs   = Jobs::whereIn('id', $jobsId)->get();
        $count  = $jobs->count();
        //to provide the existing value of isViewed to the current user.
        foreach ($jobs as $job) {
            $jobstatus = (auth()->user()) ? auth()->user()->savedjobs->contains($job->id) : false;
            if ($jobstatus == true) {
                $job->isSaved = true;
            } else {
                $job->isSaved = false;
            };
        }
        return view('savedjobs', compact('jobs', 'count'));
    }
    public function store(Jobs $jobs)
    {
        return auth()->user()->savedjobs()->toggle($jobs);
    }
}
