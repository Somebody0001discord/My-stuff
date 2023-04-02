<?php include 'server2.php';
	$query = "INSERT INTO teacher (firstname, lastname, username, address, email, password) 
                  VALUES('$firstname', '$lastname', '$username', '$address', '$email', '$password')";
          $results = pg_query($db, $query);
          //$_SESSION['queries'] = $query;
          //$_SESSION["con"] = $db;
          //echo "in server".'<br>';
          //header('location: nothing.php');
          while($query_row = pg_fetch_assoc($results)){
              $username = $query_row['username'];
              $email = $query_row['email'];
              echo $username .' '. $email.'<br>';
          }
?>