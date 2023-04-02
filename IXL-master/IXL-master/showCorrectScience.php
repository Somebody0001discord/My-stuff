<?php include 'server2.php';
	echo "<center><h1>"."Correct!"."</center></h1>";
	$ques_id = $_SESSION['ques_id'];
    $stud_id = $_SESSION['student_id'];
    $real_ans = $_SESSION['answer'];
    $stud_ans = $_SESSION['stud_ans'];
	$check = "SELECT student_id, question_id FROM SOLVE_HISTORY WHERE student_id = '$stud_id' 
    		 	  AND question_id = '$ques_id'";
    		$res = pg_query($db, $check);
    		if(pg_num_rows($res) == 0){
    			//insert
    			$inserting = "INSERT INTO SOLVE_HISTORY(student_id, question_id, verdict) 
    			VALUES('$stud_id', '$ques_id', 'AC')";
    			$insertQuery = pg_query($db, $inserting);
    		}else{
    			//update
    			$updating = "UPDATE SOLVE_HISTORY
							SET verdict = 'AC'
							WHERE student_id = '$stud_id' AND question_id = '$ques_id'";
				$updateQuery = pg_query($db, $updating);
    		}
            $insert_to_performance =  "INSERT INTO PERFORMANCE(student_id, question_id, students_ans, real_ans, verdict) 
                VALUES('$stud_id', '$ques_id', '$stud_ans', '$real_ans', 'AC')";
            $res_insert_to_performance = pg_query($db, $insert_to_performance); 
?>

<form action="showCorrectScience.php" method="POST">
	<div align = "center" class = "input-group">
        <button type="submit" class="btn"
        name = "nextscience">NEXT</button>
    </div>
</form>