<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>

</head>

<body>
    <?php

    use App\Jobs;
    //code to assign websitename
    $websitenames = array('np.linkedin.com', 'jobsnepal.com', 'merocareer.com', 'kumarijob.com', 'merojob.com');

    $jobs = Jobs::all();
    foreach ($websitenames as $sitename) {
        $jobs = Jobs::where('url', 'like', '%' . $sitename . '%')->get();
        foreach ($jobs as $job) {
            echo $sitename . "<br>";
            $job->websitename = $sitename;
            echo $job->websitename . "<br>";
        }
    }
    //end code to assign websitename

    ?>


</body>

</html>