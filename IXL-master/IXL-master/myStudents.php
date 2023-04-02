<?php include 'server2.php';
	$id = $_SESSION['id'];
      $query = "SELECT username, email FROM student WHERE teacher_id = '$id'";
      $results = pg_query($db, $query);
      //echo pg_num_rows($results);
      
      while($query_row = pg_fetch_assoc($results)){
          $name = $query_row['username'];
          $email = $query_row['email'];
          echo $name .' '. $email.'<br>';
      }
?>