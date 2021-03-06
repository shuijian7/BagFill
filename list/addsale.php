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
$nameErr = $descriptionErr = $phoneErr = $priceErr = $addressErr = "";
$name = $description = $address = $phone = $price = "";

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
  }else{
    $str = preg_replace("/( )+$/","", $_POST["address"]);
    if (strlen($str) == 0){
      $addressErr = "address can't be all blank";
    }
    $address = $_POST["address"];
  }

  if (empty($_POST["phone"])) {
    $phoneErr = "Phone is required";
  } else {
    $phone = test_input($_POST["phone"]);
    if (!preg_match("/^(\+?1)?[2-9]\d{2}[2-9](?!11)\d{6}$/",$phone)) {
        $phoneErr = "Not valid phone number"; 
    }
  }
  if (empty($_POST['price'])){
	  $price = NULL;
  }else{
    $price = test_input($_POST['price']);
    if (!preg_match("/^[+]{0,1}(\d+)$|^[+]{0,1}(\d+\.\d+)$/",$price)) {
      $priceErr = "should only contains number"; 
    }
}
if(empty($nameErr)&&empty($descriptionErr)&&empty($phoneErr)&&empty($priceErr)&&empty($addressErr)){
	$name = addslashes($name);
	$description = addslashes($description);
	$address = addslashes($address);
	$query = "Insert into SaleList values(NULL,'".$name."','".$phone."','".$description."','".$price."','".$address."',default,'".$_SESSION['city']."','".$_SESSION['name']."');";

      $add = mysqli_query($db,$query)
      or die(mysqli_error($db));
      mysqli_free_result($add);
      mysqli_close($db);
      header("Location: sale_list.php");
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Sale Adding Form</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="addsale.php">  
  Name: <textarea name="name" rows="5" cols="40" maxlength="200"><?php echo $name;?></textarea>
  <span class="error">*<?php echo $nameErr;?></span>
  <br><br>
  Price $: <input type="text" name="price" value="<?php echo $price;?>" maxlength="30">
  <span class="error"><?php echo $priceErr;?></span>
  <br><br>
  Description: <textarea name="description" rows="5" cols="40" maxlength="500"><?php echo $description;?></textarea>
  <span class="error">*<?php echo $descriptionErr;?></span>
  <br><br>
  Address: <input type="text" name="address" value="<?php echo $address;?>" maxlength="30">
   <span class="error"><?php echo $addressErr;?></span>
  <br><br>
  Phone: <input type="text" name="phone" value="<?php echo $phone;?>">
  <span class="error">* <?php echo $phoneErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Go">||<a href="sale_list.php">Back</a>
</form>


</body>
</html>
