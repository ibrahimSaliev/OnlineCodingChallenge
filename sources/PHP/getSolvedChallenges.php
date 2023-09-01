<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();


$challenges_array = $database->selectFromSolvedChallenges();
?>


<html>
<body>
<!-- Search result -->
<h2>Solved Challenges Result:</h2>
<table>
    <tr>
        <th>Challenge ID</th>
        <th>Username</th>
    </tr>
    <?php foreach ($challenges_array as $challenge) : ?>
        <tr>
            <td><?php echo $challenge['CHALLENGE_ID']; ?>  </td>
            <td><?php echo $challenge['USERNAME']; ?>  </td>
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