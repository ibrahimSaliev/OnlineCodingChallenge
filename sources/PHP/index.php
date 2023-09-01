<html>
<head>
    <title>Online Database</title>
</head>

<body>
<br>
<h1>My Online Challenge Database</h1>

<!-- Insert Solution -->
<h2>Add a Solution: </h2>
<form method="post" action="insertSolution.php">

    <!-- Challenge ID textbox -->
    <div>
        <label for="ch_id">Challenge ID:</label>
        <input id="ch_id" name="challenge_id" type="number">
    </div>
    <br>

    <!-- Description textbox -->
    <div>
        <label for="description">Description:</label>
        <input id="description" name="descript" type="text" maxlength="100">
    </div>
    <br>

    <!-- Participator textbox -->
    <div>
        <label for="participator">Provided By:</label>
        <input id="participator" name="provided_by" type="text" maxlength="40">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
            Add Solution
        </button>
    </div>
</form>
<br>
<hr>

<!-- Search form -->
<h2>Get Solved Challenges:</h2>
<form method="get" action="getSolvedChallenges.php">

    <!-- Submit button -->
    <div>
        <button id='submit' type='submit'>
            Get!
        </button>
    </div>
</form>
<br>
<hr>


<!-- Search form -->
<h2>Get All Participators:</h2>
<form method="get" action="getAllPart.php">

    <!-- Submit button -->
    <div>
        <button id='submit' type='submit'>
            Get!
        </button>
    </div>
</form>
<br>
<hr>


<h2>Participator Search:</h2>
<form method="post" action="getParticipator.php">

    <!-- Username textbox:-->
    <div>
        <label for="usrn">Username:</label>
        <input id="usrn" name="username" type="text" maxlength="40">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button id='submit' type='submit'>
            Search!
        </button>
    </div>
</form>
<br>
<hr>


<h2>Delete a Participator:</h2>
<form method="post" action="partDelete.php">

    <!-- Username textbox:-->
    <div>
        <label for="usrn">Username:</label>
        <input id="usrn" name="username" type="text" maxlength="40">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button id='submit' type='submit'>
            Search!
        </button>
    </div>
</form>
<br>
<hr>


<!-- Search form -->
<h2> Close To Award :</h2>
<h3>Do you wish to see how many participators are close to winning a certain award? Just type the name of the award and a range of points for which you would like to check!</h3>
<form method="post" action="getCloseToAward.php">

    <div>
        <label for="aname">Award Name:</label>
        <input id="aname" name="award_name" type="text" maxlength="40">
    </div>
    <br>

    <div>
        <label for="points">Up to how many points?</label>
        <input id="points" name="points" type="number" >
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button id='submit' type='submit'>
            Search!
        </button>
    </div>
</form>
<br>
<hr>


<!-- Search form -->
<h2>Get Awards:</h2>
<form method="get" action="getAwards.php">

    <!-- Submit button -->
    <div>
        <button id='submit' type='submit'>
            Get!
        </button>
    </div>
</form>
<br>
<hr>


<!-- Search form -->
<h2> Participators between points :</h2>
<h3> Check how Many participators are between certain number of points!</h3>
<form method="post" action="getPartBetweenPoints.php">

    <div>
        <label for="lower">Lower Limit:</label>
        <input id="lower" name="lower_limit" type="number">
    </div>
    <br>

    <div>
        <label for="upper">Upper Limit</label>
        <input id="upper" name="upper_limit" type="number" >
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button id='submit' type='submit'>
            Search!
        </button>
    </div>
</form>
<br>
<hr>


<!-- Search form -->
<h3>Get All Participators that won a contest at least 3 times.</h3>
<form method="get" action="getWonThreeTimes.php">

    <!-- Submit button -->
    <div>
        <button id='submit' type='submit'>
            Get!
        </button>
    </div>
</form>
<br>
<hr>


<!-- Insert Contest -->
<h2>Start a Contest: </h2>
<form method="post" action="insertContest.php">

    <div>
        <label for="ch_id">Challenge ID:</label>
        <input id="ch_id" name="challenge_id" type="number">
    </div>
    <br>

    <div>
        <label for="cont">Number of Contestants:</label>
        <input id="cont" name="contestants" type="number">
    </div>
    <br>

    <div>
        <label for="first">First Contestant:</label>
        <input id="first" name="first" type="text" maxlength="40">
    </div>
    <br>

     <div>
        <label for="second">Second Contestant:</label>
        <input id="second" name="second" type="text" maxlength="40">
    </div>
    <br>
  
     <div>
        <label for="third">Third Contestant:</label>
        <input id="third" name="third" type="text" maxlength="40">
    </div>
    <br>

    <div>
        <label for="fourth">Fourth Contestant:</label>
        <input id="fourth" name="fourth" type="text" maxlength="40">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button type="submit">
            Start!
        </button>
    </div>
</form>
<br>
<hr>



<!-- Search form -->
<h2>Get Contests:</h2>
<form method="post" action="getContests.php">


    <div>
        <label for="username">First Contestant:</label>
        <input id="username" name="username" type="text" maxlength="40">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button id='submit' type='submit'>
            Get!
        </button>
    </div>
</form>
<br>
<hr>



<!-- Search form -->
<h2>Update a Contest:</h2>
<form method="post" action="updateContest.php">


    <div>
        <label for="username">Winner:</label>
        <input id="username" name="username" type="text" maxlength="40">
    </div>
    <br>

    <div>
        <label for="con_id">Contest ID:</label>
        <input id="con_id" name="contest_id" type="number">
    </div>
    <br>

    <!-- Submit button -->
    <div>
        <button id='submit' type='submit'>
            Get!
        </button>
    </div>
</form>
<br>
<hr>



</body>
</html>
