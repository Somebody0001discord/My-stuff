<?php
	include 'server2.php';
	$stud_id = $_SESSION['student_id'];
	$hist_query = "SELECT * from performance where student_id = '$stud_id'";
	$res_hist_query = pg_query($db, $hist_query);

	$find_question = "SELECT q.question from question q, performance p where q.question_id = p.question_id";
	$res_find = pg_query($db, $find_question);

	while($query_row = pg_fetch_assoc($res_hist_query)){
			  $query_row_2 = pg_fetch_assoc($res_find);
			  $q_name = $query_row_2['question'];			
              $stud_ans = $query_row['students_ans'];
              $real_ans = $query_row['real_ans'];
              $verdict = $query_row['verdict'];
              echo $q_name .' '. $stud_ans. ' '. $real_ans. ' '.$verdict.'<br>';
          }
?>