<?php
session_start();

$username = "" ;
$firstname = "" ;
$lastname = "" ;
$address = "" ;
$email = "@gmail.com" ;
$medals = 0;
$errors = array() ;
$cnt = 0;
$password = "";

$host        = "host = 127.0.0.1";
$port        = "port = 5432";
$dbname      = "dbname = postgres";
$credentials = "user = postgres password=sql";

$db = pg_connect( "$host $port $dbname $credentials");
if(!$db) {
   echo "Error : Unable to open database\n";
}
/*
$sql =<<<EOF
    CREATE TABLE TEACHER
   (ID SERIAL PRIMARY KEY     NOT NULL,
   FIRSTNAME          TEXT    NOT NULL,
   LASTNAME           TEXT    NOT NULL,
   USERNAME           TEXT    NOT NULL,
   ADDRESS            TEXT    NOT NULL,
   EMAIL            char(50)     NOT NULL,
   PASSWORD        CHAR(50)      NOT NULL
);
   
EOF;

$ret = pg_query($db, $sql);
if(!$ret) {
   echo pg_last_error($db);
}*/

if (isset($_POST['reg_user'])) {
    echo "ashsi";
    $username = pg_escape_string($db, $_POST['username']);
    $email = pg_escape_string($db, $_POST['email']);
    $address = pg_escape_string($db, $_POST['address']);
    $password_1 = pg_escape_string($db, $_POST['password_1']);
    $password_2 = pg_escape_string($db, $_POST['password_2']);
    $firstname = pg_escape_string($db, $_POST['firstname']);
    $lastname = pg_escape_string($db, $_POST['lastname']);
    echo "ashsi";
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
      array_push($errors, "The two passwords do not match");
    }
  
    
    $user_check_query = "SELECT * FROM teacher WHERE name='$username' OR email='$email' LIMIT 1";
    $result = pg_query($db, $user_check_query);
    $user = pg_fetch_assoc($result);
    
    if ($user) { 
      if ($user['username'] == $username) {
        array_push($errors, "Username already exists");
      }
  
      if ($user['email'] == $email) {
        array_push($errors, "email already exists");
      }
    }
  
    
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database
        $query = "INSERT INTO teacher (firstname, lastname, username, address, email, password) 
                  VALUES('$firstname', '$lastname', '$username', '$address', '$email', '$password')";
        pg_query($db, $query);

        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: login.php');
    }
  }

  if (isset($_POST['reg_student'])) {
    //echo "ashsi";
    $username = pg_escape_string($db, $_POST['username']);
    $email = pg_escape_string($db, $_POST['email']);
    $address = pg_escape_string($db, $_POST['address']);
    $password_1 = pg_escape_string($db, $_POST['password_1']);
    $password_2 = pg_escape_string($db, $_POST['password_2']);
    $firstname = pg_escape_string($db, $_POST['firstname']);
    $lastname = pg_escape_string($db, $_POST['lastname']);
    //echo "ashsi";
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
      array_push($errors, "The two passwords do not match");
    }
  
    
    $user_check_query = "SELECT * FROM student WHERE name='$username' OR email='$email' LIMIT 1";
    $result = pg_query($db, $user_check_query);
    $user = pg_fetch_assoc($result);
    
    if ($user) { 
      if ($user['username'] == $username) {
        array_push($errors, "Username already exists");
      }
  
      if ($user['email'] == $email) {
        array_push($errors, "email already exists");
      }
    }
  
    
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database
        $teacher_id = $_SESSION['id'];
        $query = "INSERT INTO student (firstname, lastname, username, address, email, password, teacher_id, no_of_medals) 
                  VALUES('$firstname', '$lastname', '$username', '$address', '$email', '$password', '$teacher_id', 0)";
        pg_query($db, $query);

        /*$_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";*/
        header('location: roster.php');
    }
  }
  
  if (isset($_POST['login_user'])) {
      $username = pg_escape_string($db, $_POST['username']);
      $password = pg_escape_string($db, $_POST['password']);
    
      if (empty($username)) {
          array_push($errors, "Username is required");
      }
      if (empty($password)) {
          array_push($errors, "Password is required");
      }
    
      if (count($errors) == 0) {
          $password = md5($password);
          $query = "SELECT * FROM teacher WHERE username='$username' AND password='$password'";
          $query2 = "SELECT * FROM student WHERE username='$username' AND password='$password'";

          $results = pg_query($db, $query);
          $results2 = pg_query($db, $query2);

          if (pg_num_rows($results) == 1) {
            $_SESSION['id'] = pg_result($results, 0, 'id');
            $_SESSION['type'] = "teacher";
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
          }else if(pg_num_rows($results2) == 1){
              //array_push($errors, "Wrong username/password combination");
              $_SESSION['student_id'] = pg_result($results2, 0, 'student_id');
              $_SESSION['type'] = "student";
              $_SESSION['username'] = $username;
              $_SESSION['success'] = "You are now logged in";
              header('location: indexStudent.php');
          }else{
              array_push($errors, "Wrong username/password combination");
          }
      }
    }

    if(isset($_POST['answer'])){
    	//echo "ASSI";
    	$cnt = $_SESSION['ques_no'];
      $_SESSION['stud_ans'] = $_POST['answer'];
    	if($_SESSION['answer'] == $_POST['answer']){
    		$_SESSION['ques_no'] = $cnt + 1;
    		header('location: showCorrect.php');
    	}else {
			$_SESSION['ques_no'] = $cnt + 1;
			header('location: showWrong.php');
		}
    }
    if(isset($_POST['nextmath'])){
    	header('location: mathques.php');
    }


    if(isset($_POST['answerscience'])){
    	//echo "ASSI";
      $_SESSION['stud_ans'] = $_POST['answerscience'];
    	$cnt = $_SESSION['ques_no'];
    	if($_SESSION['answer'] == $_POST['answerscience']){
    		$_SESSION['ques_no'] = $cnt + 1;
    		header('location: showCorrectScience.php');
    	}else {
			$_SESSION['ques_no'] = $cnt + 1;
			header('location: showWrongScience.php');
		}
    }
   
    if(isset($_POST['nextscience'])){
    	header('location: scienceques.php');
    }

    if(isset($_POST['select_button'])) {
        $_SESSION['selected_category'] = $_POST['student_selects_category'];
        $_SESSION['selected_grade'] = $_POST['student_selects_grade'];
        header('location: student_scores.php');
    }

    if(isset($_POST['selected_student_id'])){
        $_SESSION['student_id'] = $_POST['selected_student_id'];
        header('location: teacher_query_options.php');
    }

    if(isset($_POST['teacher_query_button'])){
        $_SESSION['subject'] = $_POST['teacher_query_subject'];
        $_SESSION['grade'] = $_POST['teacher_query_grade'];
        $_SESSION['category'] = $_POST['teacher_query_category'];
        $_SESSION['skill'] = $_POST['teacher_query_skill'];

        if(isset($_POST['teacher_query_subject']))
          header('location: show_query_result_teacher.php');
    }
?>

