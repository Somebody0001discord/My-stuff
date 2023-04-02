<?php include 'server2.php';
	echo "Wrong :(";
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
    			VALUES('$stud_id', '$ques_id', 'WA')";
    			$insertQuery = pg_query($db, $inserting);
    		}else{
    			//update
    			$updating = "UPDATE SOLVE_HISTORY
							SET verdict = 'WA'
							WHERE student_id = '$stud_id' AND question_id = '$ques_id'";
				$updateQuery = pg_query($db, $updating);
    		}

            $insert_to_performance =  "INSERT INTO PERFORMANCE(student_id, question_id, students_ans, real_ans, verdict) 
                VALUES('$stud_id', '$ques_id', '$stud_ans', '$real_ans', 'WA')";
            $res_insert_to_performance = pg_query($db, $insert_to_performance); 
?>

<form action="showWrong.php" method="POST">
	<div class = "input-group">
        <button type="submit" class="btn"
        name = "nextmath">NEXT</button>
    </div>
</form>