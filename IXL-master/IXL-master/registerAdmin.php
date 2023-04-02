<?php include('server2.php') ?>

<html>
<body>
    <div class = "header">
        <h2>Registration</h2>
    </div>

    <form method="post" action="registerAdmin.php">
  	<?php include('errors.php'); ?>

    <div class="input-group">
      <label>FirstName</label>
      <input type="text" name="firstname" value="<?php echo $firstname; ?>">
    </div>

    <div class="input-group">
      <label>LastName</label>
      <input type="text" name="lastname" value="<?php echo $lastname; ?>">
    </div>

  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>

    <div class="input-group">
      <label>Address</label>
      <input type="text" name="address" value="<?php echo $address; ?>">
    </div>

  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>

  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>

  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>

  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html> 
