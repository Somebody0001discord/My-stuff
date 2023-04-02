<?php
session_start();

$username = "" ;
$firstname = "" ;
$lastname = "" ;
$address = "" ;
$email = "" ;
$medals = 0;
$errors = array() ;

$host        = "host = 127.0.0.1";
$port        = "port = 5432";
$dbname      = "dbname = testdb1";
$credentials = "user = postgres password=123";

$db = pg_connect( "$host $port $dbname $credentials");
if(!$db) {
   echo "Error : Unable to open database\n";
}
/*
$sql =<<<EOF
    CREATE TABLE STUDENT
   (ID SERIAL PRIMARY KEY     NOT NULL,
   FIRSTNAME          TEXT    NOT NULL,
   LASTNAME           TEXT    NOT NULL,
   USERNAME           TEXT    NOT NULL,
   ADDRESS            TEXT    NOT NULL,
   EMAIL            char(50)     NOT NULL,
   PASSWORD        CHAR(50)      NOT NULL,
   NO_OF_MEDALS       INTEGER    NOT NULL
);
   
EOF;

$ret = pg_query($db, $sql);
if(!$ret) {
   echo pg_last_error($db);
}
*/
if (isset($_POST['reg_user'])) {
    $username = pg_escape_string($db, $_POST['username']);
    $email = pg_escape_string($db, $_POST['email']);
    $address = pg_escape_string($db, $_POST['address']);
    $password_1 = pg_escape_string($db, $_POST['password_1']);
    $password_2 = pg_escape_string($db, $_POST['password_2']);
    $firstname = pg_escape_string($db, $_POST['firstname']);
    $lastname = pg_escape_string($db, $_POST['lastname']);
  
    
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
      array_push($errors, "The two passwords do not match");
    }
  
    
    $user_check_query = "SELECT * FROM stud WHERE name='$username' OR email='$email' LIMIT 1";
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
  
        $query = "INSERT INTO student (username, firstname, lastname, address, email, password, no_of_medals) 
                  VALUES('$username', '$firstname', '$lastname', '$address', '$email', '$password', '$medals')";
        pg_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
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
          $results = pg_query($db, $query);
          if (pg_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
          }else {
              array_push($errors, "Wrong username/password combination");
          }
      }
    }
    
?>

