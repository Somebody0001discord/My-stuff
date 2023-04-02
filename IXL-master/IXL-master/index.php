<?php 
  include 'server2.php'; 

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
	<title><center>Home</center></title>
</head>
<body>

<div align = "center" class="header">
	<h2>Home Page</h2>
</div>

<div align = "center">
  <a href="roster.php"> roster </a>
</div>

<div align = "center">
  <a href="teacher_analytics.php"> ANALYTICS </a>
</div>

<div class="content">
  
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <?php 
        $teacher_id = $_SESSION['id'];
        $tot = "SELECT COUNT(*) AS cnt from SOLVE_HISTORY, student where teacher_id = '$teacher_id' group by question_id";
        $res = pg_query($db, $tot);
        $totalSolve = pg_num_rows($res);
        echo "<center>"."We've solved" ." $totalSolve ". "Questions"."</center>";
    ?>
    <?php  if (isset($_SESSION['username'])) : ?>
    	<center><p>Welcome <strong><?php echo $_SESSION['username']; ?></strong> <strong><?php echo $_SESSION['id']; ?></strong></p></center>
      <div align="center">
    	<p> <a href="index.php ? logout='1' ">logout</a> </p>
    </div>
    <?php endif ?>
</div>
		
</body>
</html>