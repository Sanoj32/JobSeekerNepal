
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>FAQs about the website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<div class="page-header">
    <h1>Website FAQ <small> Frequently Asked Questions</small></h1>
</div>

<!-- Bootstrap FAQ - START -->
<div class="container">
    <br />
    <br />


    <div class="panel-group" id="accordion">
        <div class="faqHeader">General questions</div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">How does this site work.</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                   First our <a href="https://github.com/Sanoj32/Python-Scripts-Minor-Project.git">Python Scripts </a> which use the Beautiful Soup library scrape data from various sites is stored as a json file. Then the data in those json
                   file is converted into a php array and further processing is done.
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTen">Why Register?</a>
                </h4>
            </div>
            <div id="collapseTen" class="panel-collapse collapse">
                <div class="panel-body">
                    Registration allows you to use features like the <button class="btn btn-light">Mark as opened</button> button. It is optional but encouraged.
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven">What is the <button class="btn btn-light">Mark as opened</button> button? </a>
                </h4>
            </div>
            <div id="collapseEleven" class="panel-collapse collapse">
                <div class="panel-body">
                    The  <button class="btn btn-light">Mark as opened</button> button can be used to mark already viewed / opened jobs. After a job is marked open it will appear at the bottom of your search results and the button will change to <button class="btn btn-primary">Opened</button>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsetwelve"> Which site's jobs are here? </a>
                </h4>
            </div>
            <div id="collapsetwelve" class="panel-collapse collapse">
                <div class="panel-body">
                    Please check the <a href="/references">References </a> page.
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsethirteen"> When are the jobs here updated? </a>
                </h4>
            </div>
            <div id="collapsethirteen" class="panel-collapse collapse">
                <div class="panel-body">
                 Jobs are updated daily at 10:00 am.
                </div>
            </div>
        </div>
</div>

</div>

<style>
    .faqHeader {
        font-size: 27px;
        margin: 20px;
    }

    .panel-heading [data-toggle="collapse"]:after {
        font-family: 'Glyphicons Halflings';
        content: "\e072"; /* "play" icon */
        float: right;
        color: #F58723;
        font-size: 18px;
        line-height: 22px;
        /* rotate "play" icon from > (right arrow) to down arrow */
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }

    .panel-heading [data-toggle="collapse"].collapsed:after {
        /* rotate "play" icon from > (right arrow) to ^ (up arrow) */
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
        color: #454444;
    }
</style>

<!-- Bootstrap FAQ - END -->

</div>

</body>
</html>
