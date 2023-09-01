<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();


$part_array = $database->getAllParticipators();
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
    <?php foreach ($part_array as $part) : ?>
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