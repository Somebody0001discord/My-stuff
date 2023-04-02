<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>

<html>
<head>
	<title>Home</title>
	
</head>
<body>

<div class="header">
	<center><h2>IXL</h2></center>
</div>

<center>
<div>
  <a href="questions.php">LEARNING </a>
</div>
</center>

<center>
<div>
  <a href="student_usage.php">ANALYTICS </a>
</div>
</center>

<center>
<div>
  <a href="select_category_and_grade.php">SCORES </a>
</div>
</center>

<center>
<div>
  <a href="show_history.php">SOLVE HISTORY</a>
</div>
</center>

<div class="content">
  
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<center><h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3></center>
      </div>
  	<?php endif ?>

    
    <?php  if (isset($_SESSION['username'])) : ?>
    	<center><p>Welcome <strong><?php echo $_SESSION['username']; ?></strong> <strong><?php echo $_SESSION['student_id']; ?></strong></p></center>
    	<center><p> <a href="index.php ? logout='1' ">logout</a> </p></center>
    <?php endif ?>
</div>
		
</body>
</html>