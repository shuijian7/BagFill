<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password" value="<?php echo $password; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
		<div class="input-group">
  	  <label>First name</label>
  	  <input type="text" name="fname">
  	</div>
		<div class="input-group">
  	  <label>Last name</label>
  	  <input type="text" name="lname">
  	</div>
		<div class="input-group">
  	  <label>Phone</label>
  	  <input type="integer" name="phone">
  	</div>
		<div class="input-group">
  	  <label>City</label>
  	  <input type="text" name="city">
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