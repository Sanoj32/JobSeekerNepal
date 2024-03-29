<?php

use App\Jobs;

function changeSearchText($searchText)
{
    $searchText = strtolower($searchText);
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

    if ($searchText == "go") {
        $searchText = " go ";
    }
    if ($searchText == "express" || $searchText == "express js" || $searchText == "expressjs" || $searchText == "express.js") {
        $searchText = " express ";
    }
    if ($searchText == "angularjs" || $searchText == "angular.js" || $searchText == "angular js") {
        $searchText = "angular";
    }
    if ($searchText == "c") {
        $searchText = " c ";
    }
    if ($searchText == "vue.js" || $searchText == "vuejs" || $searchText == "vue js") {
        $searchText = "vue";
    }
    if ($searchText == "postgresql") {
        $searchText = "postgres";
    }
    // if ($searchText == "intern") {
    //     $searchText = "intern ";
    // }
    if (Str::contains($searchText, 'oracle')) {
        $searchText = "oracle";
    }
    if (Str::contains($searchText, 'mongo')) {
        $searchText = "mongo";
    }
    if (Str::contains($searchText, 'maria')) {
        $searchText = "maria";
    }
    if (Str::contains($searchText, 'microsoft sql') || Str::contains($searchText, 'microsoft sql server') || $searchText == "mssql" || $searchText == "ms-sql") {
        $searchText = "sql server";
    }
    return $searchText;
}

function searchJobs($searchText, $address)
{

    if ($searchText == "" && $address != "") {
        //if only the searchtext is empty show jobs with the selected address
        if ($address != 'other') {

            $jobs = Jobs::where('address', 'like', '%' . $address . '%')
                ->where('isExpired', '=', 'false')
                ->get();
        } else {

            $jobs = Jobs::where('address', 'not like', '%kathmandu%')
                ->where('address', 'not like', '%lalitpur%')
                ->where('isExpired', '=', 'false')
                ->get();
        }
    }

    if ($address != 'other' && $searchText != "") {
        //if the address isn't empty only get the jobs containing this address and searchtext isn't empty

        $jobs = Jobs::where('isExpired', '=', 'false')
            ->where('address', 'like', '%' . $address . '%')
            ->where(function ($query) use ($searchText) {
                $query->where('name', 'like', '%' . $searchText . '%')
                    ->orwhere('skills', 'like', '%' . $searchText . '%')
                    ->orwhere('skills1', 'like', '%' . $searchText . '%')
                    ->orwhere('desct', 'like', '%' . $searchText . '%');
            })
            ->get();
    }

    if ($searchText != "" && $address == 'other') {

        $jobs = Jobs::where('address', 'not like', '%kathmandu%')
            ->where('address', 'not like', '%lalitpur%')
            ->where('isExpired', '=', 'false')
            ->where(function ($query) use ($searchText) {
                $query->where('name', 'like', '%' . $searchText . '%')
                    ->orwhere('skills', 'like', '%' . $searchText . '%')
                    ->orwhere('skills1', 'like', '%' . $searchText . '%')
                    ->orwhere('desct', 'like', '%' . $searchText . '%');
            })
            ->get();
    }
    return $jobs;
}

function setRelevancy($jobs, $searchText)
{
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
    return $jobs;
}
