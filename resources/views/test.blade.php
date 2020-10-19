<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>

</head>

<body>
    <?php

    use Illuminate\Support\Collection;
    use App\Jobs;
    use Illuminate\Support\Facades\DB;

    $address = "";
    $jobs = Jobs::where('address', 'like', '%kathmandu%')->get();
    foreach ($jobs as $job) {
        echo $job->name . "<br>";
    }



    ?>


</body>

</html>