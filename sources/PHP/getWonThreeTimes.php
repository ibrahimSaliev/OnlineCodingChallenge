<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();


$contestants_array = $database->getViewWonThreeTimes();
?>


<html>
<body>
<!-- Search result -->
<h2>Users that won a contest at least 3 times:</h2>
<table>
    <tr>
        <th>Winner</th>
        <th>Number of Wins</th>
    </tr>
    <?php foreach ($contestants_array as $contest) : ?>
        <tr>
            <td><?php echo $contest['WINNER']; ?>  </td>
            <td><?php echo $contest['NUMBER_OF_TIMES_WON']; ?>  </td>
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