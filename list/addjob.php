<?php
session_start();
include('connectdata.txt');

$db = mysqli_connect($server, $user, $pass , $dbname , $port)
or die('Error connecting to Mysql server.');
?>

<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $descriptionErr = $phoneErr = $salaryErr = $employmentErr = $addressErr = "";
$name = $description = $address = $phone = $salary = $employment = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  }else{
    $str = preg_replace("/( )+$/","", $_POST["name"]);
    if (strlen($str) == 0){
      $nameErr = "name can't be all blank";
  }
    $name = $_POST["name"];
  }

  if (empty($_POST["description"])) {
    $descriptionErr = "description is required";
  }
  else{
    $str = preg_replace("/( )+$/","", $_POST["description"]);
    if (strlen($str) == 0){
      $descriptionErr = "description can't be all blank";
  }
    $description = $_POST["description"];
}
    
  if (empty($_POST["address"])) {
    $address = NULL;
  } else{
    $str = preg_replace("/( )+$/","", $_POST["address"]);
    if (strlen($str) == 0){
      $addressErr = "address can't be all blank";
    }
    $address = $_POST['address'];
  }

  if (empty($_POST["phone"])) {
    $phoneErr = "Phone is required";
  } else {
    $phone = test_input($_POST["phone"]);
    if (!preg_match("/^(\+?1)?[2-9]\d{2}[2-9](?!11)\d{6}$/",$phone)) {
        $phoneErr = "Not valid phone number"; 
    }
  }
  if (empty($_POST['salary'])){
    $salaryErr = "Salary is required";
  }else{
    $salary = test_input($_POST['salary']);
    if (!preg_match("/^[+]{0,1}(\d+)$|^[+]{0,1}(\d+\.\d+)$/",$salary)) {
      $salaryErr = "should only contains number"; 
    }
}

   if(empty($_POST['employment'])){
       $employmentErr = "Job position is required";
   }else{
    $str = preg_replace("/( )+$/","",$_POST["employment"]);
    if (strlen($str) == 0){
      $employmentErr = "job position can't be all blank";
  }
    $employment = $_POST['employment'];
   }
  if(empty($nameErr)&&empty($descriptionErr)&&empty($salaryErr)&&empty($priceErr)&&empty($employmentErr)&&empty($addressErr)){
	  $name = addslashes($name);
	  $description = addslashes($description);
	  $employment = addslashes($employment);
	  $address = addslashes($address);
	  $query = "Insert into JobList values(NULL,'".$name."','".$address."','".$salary."','".$employment."','".$phone."','".$description."',default,'".$_SESSION['city']."','".$_SESSION['name']."');";
      $add = mysqli_query($db,$query)
      or die(mysqli_error($db));
      mysqli_free_result($add);
      mysqli_close($db);
      header("Location: job_list.php");
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Job Adding Form</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="addjob.php">  
  Name: <textarea name="name" rows="5" cols="40" maxlength="200"><?php echo $name;?></textarea>
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Job Position : <input type="text" name="employment" value="<?php echo $employment;?>" maxlength="30">
  <span class="error">*<?php echo $employmentErr;?></span>
  <br><br>
  Salary $: <input type="text" name="salary" value="<?php echo $salary;?>" maxlength="30">
  <span class="error">*<?php echo $salaryErr;?></span>
  <br><br>
  Description: <textarea name="description" rows="5" cols="40" maxlength="500"><?php echo $description;?></textarea>
  <span class="error">* <?php echo $descriptionErr;?></span>
  <br><br>
  Address: <input type="text" name="address" value="<?php echo $address;?>" maxlength="30">
<span class="error"><?php echo $addressErr;?></span>
  <br><br>
  Phone: <input type="text" name="phone" value="<?php echo $phone;?>">
  <span class="error">* <?php echo $phoneErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Go"> || <a href="job_list.php">Back</a>

</form>


</body>
</html>
