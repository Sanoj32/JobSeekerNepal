<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>

</head>

<body>
    <?php

    use Carbon\Carbon;
    use App\Jobs;

    $jobs = Jobs::where('url', 'like', '%jobsnepal%')->get();
    foreach ($jobs as $job) {
        echo $job->deadline, '<br>';
        $deadline = strtotime($job->deadline);
        $deadline = date('Y-m-d', $deadline);
        $comparison = date('1970-01-01');
        if (!($deadline == $comparison)) {
            echo "valid dates <br>";
            echo $deadline . "<br><hr>";
        } else {
            echo "invalid dates<br><hr>";
        }
    }

    ?>
</body>

</html>