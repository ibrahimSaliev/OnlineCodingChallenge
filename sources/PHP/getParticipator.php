<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();


$username = '';
if(isset($_POST['username'])){
    $username = $_POST['username'];
}


$participator_array = $database->selectFromParticipator($username);
?>


<html>
<body>
<!-- Search result -->
<h2>Participators Result:</h2>
<table>
    <tr>
        <th>Username</th>
        <th>Points</th>
        <th>Nr. Of Awards</th>
        <th>Nr. Solved Challenges</th>
    </tr>
    <?php foreach ($participator_array as $part) : ?>
        <tr>
            <td><?php echo $part['USERNAME']; ?>  </td>
            <td><?php echo $part['POINTS']; ?>  </td>
            <td><?php echo $part['NR_OF_AWARDS']; ?>  </td>
            <td><?php echo $part['NR_SOLVED_CHALLENGES']; ?>  </td>
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