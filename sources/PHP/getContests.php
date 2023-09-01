<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$username = '';
if(isset($_POST['username'])){
    $username = $_POST['username'];
}

$contest_array = $database->selectFromContest($username);
?>


<html>
<body>
<!-- Search result -->
<h2>Contests:</h2>
<table>
    <tr>
        <th>Contest ID</th>
        <th>Challenge ID</th>
        <th>Winner</th>
        <th>Number of Contestants</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>First Player</th>
        <th>Second Player</th>
        <th>Third Player</th>
        <th>Fourth Player</th>
    </tr>
    <?php foreach ($contest_array as $award) : ?>
        <tr>
            <td><?php echo $award['CONTEST_ID']; ?>  </td>
            <td><?php echo $award['CHALLENGE_ID']; ?>  </td>
            <td><?php echo $award['WINNER']; ?>  </td>
            <td><?php echo $award['NR_CONTESTANTS']; ?>  </td>
            <td><?php echo $award['START_TIME']; ?>  </td>
            <td><?php echo $award['END_TIME']; ?>  </td>
            <td><?php echo $award['FIRST_PLAYER']; ?>  </td>
            <td><?php echo $award['SECOND_PLAYER']; ?>  </td>
            <td><?php echo $award['THIRD_PLAYER']; ?>  </td>
            <td><?php echo $award['FOURTH_PLAYER']; ?>  </td>
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