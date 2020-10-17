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

    $jobs = Jobs::all();

    foreach ($jobs as $job) {
        $test = $job;
        $time = $test->deadline;
        $time = strtotime($time);
        $newformat = date('Y-m-d', $time);
        $comparison = date('1970-01-01');
        if ($newformat != $comparison) {
            $job->deadline = $newformat;
        }
    }
    // 2003-10-16
    ?>
</body>

</html>