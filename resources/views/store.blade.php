
        if (isset($_GET['location'])) {
            $address = $_GET['location'];
        } else {
            $address = "";
        }
        dd($address);

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
        if ($searchText == "" && $address != "") {
            //if only the searchtext is empty show jobs with the selected address
            if ($address != 'other') {

                $jobs = Jobs::where('address', 'like', '%' . $address . '%')
                    ->where('isExpired', '=', 'false')
                    ->get();
                $count = $jobs->count();
                return view('welcome', compact('jobs', 'count', 'address'));
            } else {

                $jobs = Jobs::where('address', 'not like', '%kathmandu%')
                    ->where('address', 'not like', '%lalitpur%')
                    ->where('isExpired', '=', 'false')
                    ->get();
                $count = $jobs->count();
                return view('welcome', compact('jobs', 'count', 'address'));
            }
        }
        if ($searchText != "" && $address == "") {
            // when search text is not empty and address is  empty

            $jobs = Jobs::where('isExpired', '=', 'false')
                ->where(function ($query) use ($searchText) {
                    $query->where('name', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('skills', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('skills1', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('desc', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('desc1', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('desc2', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('desc3', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('desc4', 'LIKE', '%' . $searchText . '%');
                })
                ->get();
        }
        if ($address != "" && $address != 'other' && $searchText != "") {
            //if the address isn't empty only get the jobs containing this address

            $jobs = Jobs::where('isExpired', '=', 'false')
                ->where('address', 'like', '%' . $address . '%')
                ->where(function ($query) use ($searchText) {
                    $query->where('name', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('skills', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('skills1', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('desc', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('desc1', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('desc2', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('desc3', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('desc4', 'LIKE', '%' . $searchText . '%');
                })
                ->get();
        }

        if ($searchText != "" && $address == 'other') {

            $jobs = Jobs::where('address', 'not like', '%kathmandu%')
                ->where('address', 'not like', '%lalitpur%')
                ->where('isExpired', '=', 'false')
                ->where(function ($query) use ($searchText) {
                    $query->where('name', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('skills', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('skills1', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('desc', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('desc1', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('desc2', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('desc3', 'LIKE', '%' . $searchText . '%')
                        ->orwhere('desc4', 'LIKE', '%' . $searchText . '%');
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