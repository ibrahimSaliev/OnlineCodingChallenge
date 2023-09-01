<?php

class DatabaseHelper
{
    const username = 'a01146675'; 
    const password = 'DasSymbol992';
    const con_string = 'lab';

    protected $conn;

    public function __construct()
    {
        try {
            $this->conn = @oci_connect(
                DatabaseHelper::username,
                DatabaseHelper::password,
                DatabaseHelper::con_string
            );

            //check if the connection object is != null
            if (!$this->conn) {
                die("DB error: Connection can't be established!");
            }

        } catch (Exception $e) {
            die("DB error: {$e->getMessage()}");
        }
    }

    public function __destruct()
    {
        @oci_close($this->conn);
    }

    public function selectFromParticipator($username)
    {
        $sql = "SELECT * FROM participator WHERE username LIKE '%{$username}%'";

        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        return $res;
    }


    public function selectFromPoster($username)
    {
        $sql = "SELECT * FROM poster WHERE username LIKE '%{$username}%'";

        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        return $res;
    }


    public function selectFromSolvedChallenges()
    {
        $sql = "SELECT * FROM solved_challenges";

        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        return $res;
    }


    public function selectFromAwards()
    {
        $sql = "SELECT * FROM award";

        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        return $res;
    }


    public function getAllParticipators()
    {
        $sql = "SELECT * FROM participator";

        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        return $res;
    }


    public function getParticipatorsBetweenPoints($lower_limit, $upper_limit)
    {
        $sql = "SELECT username, points FROM participator  WHERE points >= '{$lower_limit}' AND points < '{$upper_limit}'";

        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        return $res;
    }


    public function getViewWonThreeTimes()
    {
        $sql = "SELECT * FROM Won_Contest_AtLeast3Times";

        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        return $res;
    }

    
    public function insertIntoSolution($challenge_id, $descript, $provided_by )
    {
        $sql = "INSERT INTO solution (challenge_id,descript,provided_by) VALUES ('{$challenge_id}','{$descript}', '{$provided_by}')";

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }


    public function insertIntoChallenge($title, $diff, $descript, $points, $poster )
    {
        $sql = "INSERT INTO challenge (title,difficulty,descript,points,posted_by) VALUES ('{$title}','{$diff}','{$descript}','{$points}', '{$poster}')";

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }


    public function insertIntoContest($challenge_id, $contestants, $first, $second, $third, $fourth )
    {

        if($contestants == 3){

        $sql = "INSERT INTO contest (challenge_id,nr_contestants,first_player,second_player,third_player) VALUES ('{$challenge_id}','{$contestants}','{$first}','{$second}', '{$third}')";
        }elseif($contestants == 2){

         $sql = "INSERT INTO contest (challenge_id,nr_contestants,first_player,second_player) VALUES ('{$challenge_id}','{$contestants}','{$first}','{$second}')";
         }else{
          $sql = "INSERT INTO contest (challenge_id,nr_contestants,first_player,second_player,third_player,fourth_player) VALUES ('{$challenge_id}','{$contestants}','{$first}','{$second}', '{$third}', '{$fourth}')";
         }

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }


    public function updateContest($winner, $id)
    {
        $sql = "UPDATE contest SET winner = '{$winner}', end_time = current_timestamp WHERE contest_id = '{$id}'";

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_commit($statement);
        @oci_free_statement($statement);
        return $success;
    }


    public function selectFromContest($first_player)
    {
        $sql = "SELECT * FROM contest where first_player LIKE '%{$first_player}%'";

        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        return $res;
    }


    Public function deleteParticipator($username){

        $sql = "DELETE FROM participator WHERE username LIKE '%{$username}%'";

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;   
      
   }
     

    public function getCloseToAward($award_name, $points)
    {
        $result = 0;

        $sql = 'BEGIN close_to_award(:award_name,:points, :result); END;';
        $statement = @oci_parse($this->conn, $sql);

        @oci_bind_by_name($statement, ':award_name', $award_name);
        @oci_bind_by_name($statement, ':points', $points);
        @oci_bind_by_name($statement, ':result', $result);

        @oci_execute($statement);

        @oci_free_statement($statement);

        return $result;
    }
}