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
$nameErr = $layout_bedErr = $layout_bedErr = $spaceErr = $categoryErr = $descriptionErr = $priceErr = $phoneErr = $addressErr = "";
$name = $layout_bed = $layout_bath = $space = $category = $description = $address = $phone = $price = "";

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

  if (empty($_POST['layout_bed'])){
      $layout_bedErr = NULL;
  } else{
      $layout_bed = test_input($_POST['layout_bed']);
      if (!preg_match("/^[+]{0,1}(\d+)$|^[+]{0,1}(\d+\.\d+)$/",$layout_bed)) {
        $layout_bedErr = "should only contains integers"; 
      }
  }
  if (empty($_POST['layout_bath'])){
    $layout_bathErr = NULL;
}else{
    $layout_bath = test_input($_POST['layout_bath']);
    if (!preg_match("/^[+]{0,1}(\d+)$|^[+]{0,1}(\d+\.\d+)$/",$layout_bath)) {
      $layout_bathErr = "should only contains number"; 
    }
}

if (empty($_POST['space'])){
    $spaceErr = "house space is required";
}else{
    $space = test_input($_POST['space']);
    if (!preg_match("/^[+]{0,1}(\d+)$|^[+]{0,1}(\d+\.\d+)$/",$space)) {
      $spaceErr = "should only contains number"; 
    }
}


if (empty($_POST['category'])){
    $categoryErr = "category of your house is required like (single room,condon ...）";
}else{
    $str = preg_replace("/( )+$/","", $_POST["category"]);
    if (strlen($str) == 0){
      $categoryErr = "category can't be all blank";
    }
    $category = $_POST['category'];
}

if (empty($_POST['price'])){
    $priceErr = "Estimate selling price should provide";
}else{
    $price = test_input($_POST['price']);
    if (!preg_match("/^[+]{0,1}(\d+)$|^[+]{0,1}(\d+\.\d+)$/",$price)) {
      $priceErr = "should only contains number"; 
    }
}

  if(empty($nameErr)&&empty($descriptionErr)&&empty($layout_bathErr)&&empty($layout_bedErr)&&empty($spaceErr)&&empty($categoryErr)&&empty($priceErr)&&empty($phoneErr)&&empty($addressErr)){
	  $layout = $layout_bed."BD,".$layout_bed."BR";
	  $name = addslashes($name);
	  $description = addslashes($description);
	  $category = addslashes($category);
	  $address = addslashes($address);
      $query = "Insert into HousingList values(NULL,'".$name."','".$layout."','".$space."','".$category."','".$description."','".$address."','".$phone."','".$price."',default,'".$_SESSION['city']."','".$_SESSION['name']."');";
      $add = mysqli_query($db,$query)
      or die(mysqli_error($db));
      mysqli_free_result($add);
      mysqli_close($db);
      header("Location: housing_list.php");
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Housing Adding Form</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="addhousing.php">  
  Name: <textarea name="name" rows="5" cols="40" maxlength="200"><?php echo $name;?></textarea>
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Category: <input type="text" name="category" value="<?php echo $category;?>" maxlength="30">
  <span class="error">* <?php echo $categoryErr;?></span>
  <br><br>
  Space ft^2: <input type="text" name="space" value="<?php echo $space;?>" maxlength="30">
  <span class="error">* <?php echo $spaceErr;?></span>
  <br><br>
  #Bedroom : <input type="text" name="layout_bed" value="<?php echo $layout_bed;?>" maxlength="30">
  <span class="error"><?php echo $layout_bedErr;?></span>
  <br><br>
  #Bathroom : <input type="text" name="layout_bath" value="<?php echo $layout_bath;?>" maxlength="30">
  <span class="error"><?php echo $layout_bathErr;?></span>
  <br><br>
  Price $: <input type="text" name="price" value="<?php echo $price;?>" maxlength="30">
  <span class="error">* <?php echo $priceErr;?></span>
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
  <input type="submit" name="submit" value="Go">||<a href="housing_list.php">Back</a>  
</form>


</body>
</html>
