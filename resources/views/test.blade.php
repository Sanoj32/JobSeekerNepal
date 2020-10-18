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
        echo $job->url . '<br>';
    }

    ?>


</body>

</html>