<?php
session_start();

$email = "";
$password_1    = "";
$errors = array();
$_SESSION['success'] = "";

include('connectdata.txt');

$db = mysqli_connect($server, $user, $pass , $dbname , $port)
or die('Error connecting to Mysql server.');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $city = mysqli_real_escape_string($db, $_POST['city']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($fname)) { array_push($errors, "First name is required"); }
  if (empty($lname)) { array_push($errors, "Last name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($phone)) {array_push($errors , "Phone is required");}
  if (empty($city)) {array_push($errors , "city is required");}
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM Users WHERE Email='$email' and Password = '$password_1'";
  $result = mysqli_query($db, $user_check_query);

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    mysqli_free($result);
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO User (Email,Password,Fname,Lname,Phone,City_City_name) VALUES('$email', '$password','$fname','$lname','$phone','$city')";
  	$result_1 = mysqli_query($db, $query);
    $_SESSION['email'] = $email;
    $_SESSION['username'] = $fname.$lname;
    $_SESSION['password'] = $password;
    $_SESSION['success'] = "You are now logged in";
    mysqli_free($result_1);
    mysqli_close($db);
  	header('location: index.php');
  }
}

if (isset($_POST['login_user']))
{
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
  	array_push($errors, "Email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM User WHERE Email='$email' AND Password='$password'";
  	$results_2 = mysqli_query($db, $query);
  	if (mysqli_num_rows($results_2) == 1) {
      $_SESSION['email'] = $email;
      $_SESSION['username'] = $fname.$lname;
      $_SESSION['password'] = $password;
      $_SESSION['success'] = "You are now logged in";
      mysqli_free($results_2);
      mysqli_close($db);
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>


