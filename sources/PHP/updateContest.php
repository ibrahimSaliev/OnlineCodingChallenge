<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$username = '';
if(isset($_POST['username'])){
    $username = $_POST['username'];
}

$contest_id = '';
if(isset($_POST['contest_id'])){
    $contest_id = $_POST['contest_id'];
}


$success = $database->updateContest($username, $contest_id);

// Check result
if ($success){
    echo "Update of CONTEST : '{$contest_id}' successfull!'";
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