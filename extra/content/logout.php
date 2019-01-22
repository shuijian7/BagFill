<?php
session_start();
?>

<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION[email])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
              echo "Log out successfully"; 
              unset($_SESSION[email]);
              unset($_SESSION[username]);
              unset($_SESSION[password]);
              header('Refresh:1 ; URL=../list/classification.php');
          ?>
      	</h3>
      </div>
  	<?php endif ?>