<?php

namespace App\Console\Commands;

use App\Jobs;
use App\Query;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:UpdateDatabase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $websites = array('/linkedin.json', '/jobsnepal.json', '/globaljob.json', '/kumarijob.json', '/merojob.json', '/merorojgari.json', '/kathmandujob.json', '/kantipurjob.json','/ramrojob.json');
        foreach ($websites as $website) {
            $jsondata = file_get_contents(public_path("jsondata") . $website);
            $jsondata = json_decode($jsondata, true);
            if (empty($jsondata)) {
                continue;
            }
            $storedjobs = Jobs::all();

            foreach ($jsondata as $data) {

                $c = 0; // if c=0 It means the url is a unique url from that site and filters duplicate jobs from same site
                foreach ($storedjobs as $storedjob) {
                    if ($data['Page_URL'] == $storedjob['url']) {
                        $c = 1;
                    }
                } //code to insert data in the database
                if ($c == 0) {
                    $jobs                 = new Jobs();
                    $jobs['name']         = $data['name'] ?? "";
                    $jobs['company']      = $data['company'] ?? "";
                    $jobs['logo']         = $data['logo'] ?? ""; // company logo
                    $jobs['time']         = $data['time'] ?? ""; //full time or part time
                    $jobs['level']        = $data['level'] ?? ""; // Senior or junoir
                    $jobs['vacancy']      = $data['vacancy'] ?? "";
                    $jobs['address']      = $data['address'] ?? "";
                    $jobs['salary']       = $data['salary'] ?? "";
                    $jobs['deadline']     = $data['deadline'] ?? "";
                    $jobs['truedeadline'] = null;
                    $jobs['education']    = $data['education'] ?? "";
                    $jobs['experience']   = $data['experience'] ?? "";
                    $jobs['skills']       = $data['skills'] ?? "";
                    $jobs['skills1']      = $data['skills1'] ?? "";
                    $jobs['desct']        = $data['desct'] ?? "";
                    $jobs['url']          = $data['Page_URL'] ?? "";
                    $jobs['websitename']  = $data['websitename'];
                    $jobs['isExpired']    = false;
                    $jobs['isViewed']     = false;
                    $jobs['isSaved']      = false;
                    $jobs['relevancy']    = 10;
                    $jobs->save();
                }
            } // end code to insert data
        } //end of whole data collection from different websites
        $datenow = Carbon::now('Asia/Kathmandu'); //the exact date of today
        $datenow->format('Y-m-d');
        $jobs = Jobs::where('url', 'NOT ILIKE', '%linkedin%')
            ->where('truedeadline', '=', null)
            ->get(); //catagroize legitimate dates and calculate exact date
        if ($jobs->count() > 0) {
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
        }

        $jobs = Jobs::where('url', 'ILIKE', '%linkedin%')
            ->where('truedeadline', '=', null)
            ->get();
        if ($jobs->count() > 0) {
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
        }

        //Adding one month to the posted date of merorojgari
        $jobs = Jobs::where('url', 'ILIKE', '%merorojgari%')
            ->where('truedeadline', '=', null)
            ->get();
        if ($jobs->count() > 0) {
            foreach ($jobs as $job) {
                $job->isExpired    = false;
                $deadline          = $job->deadline;
                $truedeadline      = date('Y-m-d', strtotime("+2 month", strtotime($deadline)));
                $job->truedeadline = $truedeadline;
                if ($job->truedeadline < $datenow) {
                    $job->isExpired = true;
                }
                $job->save();
            }
        }

        $jobs = Jobs::all();
        foreach ($jobs as $job) {
            if ($job->truedeadline < $datenow) {
                $job->isExpired = true;
                $job->save();
            }
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
    }
}
