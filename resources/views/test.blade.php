
<?php
use App\Query;

// code to assign dynamic value to the pic charts
$queries       = Query::where('type', 'like', '%Progaramming Language%')->get();
$populars      = $queries->sortByDesc('count')->take(5);
$unpopulars    = $queries->sortBy('count')->take(3);
$languageNames = [];
$languageCount = [];
foreach ($populars as $popular) {
    array_push($languageNames, $popular->name);
    array_push($languageCount, $popular->count);

}
$unpopularCount = 0;
foreach ($unpopulars as $unpopular) {
    $unpopularCount += $unpopular->count;
}
array_push($languageNames, 'Others');
array_push($languageCount, $unpopularCount);
//end code
?>



<script type="text/javascript">
console.log('hello')
let languageCount = <?php echo json_encode($languageCount); ?>;
let languageNames =  <?php echo json_encode($languageNames); ?>;
console.log(languageNames);

</script>