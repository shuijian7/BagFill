<?php
session_start();
include('connectdata.txt');
$db = mysqli_connect($server, $user, $pass , $dbname , $port)
or die('Error connecting to Mysql server.');
if(!empty($_GET['id'])){
  $id = $_GET['id'];
  $delete = mysqli_query($db,"Delete from JobList where Job_id = $id")
	  or die(mysqli_error($db));
  header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>
