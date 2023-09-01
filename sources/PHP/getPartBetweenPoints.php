<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();


$lower_limit = '';
if(isset($_POST['lower_limit'])){
    $lower_limit = $_POST['lower_limit'];
}

$upper_limit = '';
if(isset($_POST['upper_limit'])){
    $upper_limit = $_POST['upper_limit'];
}

$participator_array = $database->getParticipatorsBetweenPoints($lower_limit, $upper_limit);
?>


<html>
<body>
<!-- Search result -->
<h2>Result:</h2>
<table>
    <tr>
        <th>Username</th>
        <th>Points</th>
    </tr>
    <?php foreach ($participator_array as $part) : ?>
        <tr>
            <td><?php echo $part['USERNAME']; ?>  </td>
            <td><?php echo $part['POINTS']; ?>  </td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- link back to index page-->
<br>
<a href="index.php">
    go back
</a>

</body>
</html>