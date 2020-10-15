@extends('layouts.app')

@section('content')
<div class="container">
    <?php
    foreach ($jobs as $job) {
        echo $job->name . ' <br>  <br> ';
    }
    ?>

</div>

@endsection