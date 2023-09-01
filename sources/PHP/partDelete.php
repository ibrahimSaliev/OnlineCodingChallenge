<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$username = '';
if(isset($_POST['username'])){
    $username = $_POST['username'];
}


$success = $database->deleteParticipator($username);

// Check result
if ($success){
    echo "Deletion of : '{$username}' successfull!'";
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