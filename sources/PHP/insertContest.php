<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$challenge_id = '';
if(isset($_POST['challenge_id'])){
    $challenge_id = $_POST['challenge_id'];
}

$contestants = '';
if(isset($_POST['contestants'])){
    $contestants = $_POST['contestants'];
}

$first = '';
if(isset($_POST['first'])){
    $first = $_POST['first'];
}

$second = '';
if(isset($_POST['second'])){
    $second = $_POST['second'];
}

$third = '';
if(isset($_POST['third'])){
    $third = $_POST['third'];
}

$fourth = '';
if(isset($_POST['fourth'])){
    $fourth = $_POST['fourth'];
}

// Insert method
$success = $database->insertIntoContest($challenge_id, $contestants, $first,$second,$third,$fourth);


// Check result
if ($success){
    echo "Contest for Challenge ID : '{$challenge_id}' successfully started!'";
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