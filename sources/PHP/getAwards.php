<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();


$awards_array = $database->selectFromAwards();
?>


<html>
<body>
<!-- Search result -->
<h2>Awards:</h2>
<table>
    <tr>
        <th>Award Name</th>
        <th>Description</th>
        <th>Required Points</th>
        <th>Required Solved Challenges</th>
    </tr>
    <?php foreach ($awards_array as $award) : ?>
        <tr>
            <td><?php echo $award['AWARD_NAME']; ?>  </td>
            <td><?php echo $award['AWARD_DESC']; ?>  </td>
            <td><?php echo $award['REQUIRED_POINTS']; ?>  </td>
            <td><?php echo $award['REQUIRED_SOLVED_CHALLENGES']; ?>  </td>
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