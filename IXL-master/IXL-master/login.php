<?php include('server2.php') ?>
<html>
<head> <center><h1>Registration System</h1></center> </head>
<body>
    <div align = "center" class ="header">
    <h2>Login</h2>
    </div>

 <form method="post" action="login.php">
    <?php include('errors.php'); ?>
    <div align = "center" class="input-group">
        <label>Username</label>
        <input type="text" name="username">
    </div>
    <div align = "center" class="input-group">
        <label>Password</label>
        <input type="password" name = "password">
    </div>
    <div align = "center" class = "input-group">
        <button type="submit" class="btn"
        name = "login_user">Login</button>
    </div>
    <p>
        <center>Not a member?</center> 
        <center><a href="registerAdmin.php">Sign Up </a></center>
    </p>
   
 </form>
</body>
</html>