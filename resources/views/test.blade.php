<?php
use App\Query;
$queries = Query::all();
foreach ($queries as $query) {
    $searchText   = $query->name;
    $searchText   = changeSearchText($searchText);
    $jobs         = searchJobs($searchText, "");
    $query->count = $jobs->count();
    $query->save();

}
