<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$challenge_id = '';
if(isset($_POST['challenge_id'])){
    $challenge_id = $_POST['challenge_id'];
}

$descript = '';
if(isset($_POST['descript'])){
    $descript = $_POST['descript'];
}

$provided_by = '';
if(isset($_POST['provided_by'])){
    $provided_by = $_POST['provided_by'];
}

// Insert method
$success = $database->insertIntoSolution($challenge_id, $descript, $provided_by);

// Check result
if ($success){
    echo "Solution for Challenge ID : '{$challenge_id}' successfully added!'";
}
else{
    echo "Error!";
}
?>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>