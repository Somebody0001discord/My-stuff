<?php 
	include 'server2.php';
	
	$query = "SELECT * FROM question WHERE subject = 'math'";
	$results = pg_query($db, $query);
	$i = $_SESSION['ques_no'];
	$_SESSION['ques_id'] = pg_result($results, $i, 'question_id');
	echo $_SESSION['question'] = pg_result($results, $i, 'question');
	echo $_SESSION['answer'] = pg_result($results, $i, 'answer');
	header('location: getAns.php');
	echo '<br>';
	
	/*while($query_row = pg_fetch_assoc($results)){
          $question = $query_row['question'];
          $answer = $query_row['answer'];
          $_SESSION['question'] = $question;
          $_SESSION['answer'] = $answer;
          //echo $question . '<br>';
          header('location : getAns.php');
    }*/
    //header('location : getAns.php');
	
?>