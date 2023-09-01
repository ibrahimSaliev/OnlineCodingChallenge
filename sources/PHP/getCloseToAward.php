<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$award_name = '';
if(isset($_POST['award_name'])){
    $award_name = $_POST['award_name'];
}

$points = '';
if(isset($_POST['points'])){
    $points = $_POST['points'];
}


$numberOfUsers = $database->getCloseToAward($award_name, $points);

echo "There is a total number of : '{$numberOfUsers}' users that are close to winning '{$award_name}'!'";


?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>