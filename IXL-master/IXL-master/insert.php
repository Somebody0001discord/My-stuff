<?php include 'server2.php';
	/*$query_for_insertion = "INSERT INTO question_details (skill_name, category, grade, subject) 
                  VALUES('predict_heat_flow', 'heat', '2', 'science')";
    $res = pg_query($db, $query_for_insertion);*/

    $query_for_insertion = "INSERT INTO question (question_id, question, answer, skill_name, point, subject)
                  			VALUES('21', 'Right down the direction of heat flow : 590 degrees, 525 degrees', 'right', 'predict_heat_flow', '5',
                   			'science')";

    $res = pg_query($db, $query_for_insertion);
?>