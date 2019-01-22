<?php
session_start();
include('connectdata.txt');

$db = mysqli_connect($server, $user, $pass , $dbname , $port)
or die('Error connecting to Mysql server.');
$query_1 = "Select Name from Housing where City_City_name = 'Eugene' and Classification = 'Housing';";
$result = mysqli_query($db,$query_1)
or die(mysqli_error($db));
?>

<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $layout_bedErr = $layout_bedErr = $spaceErr = $categoryErr = $descriptionErr = $priceErr = $phoneErr = "";
$name = $layout_bed = $layout_bath = $space = $category = $description = $address = $phone = $price = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["name"])) {
    $nameErr = "Name is required";
  }else{
    $name = $_POST["name"];
  }

  if (isset($_POST["description"])) {
    $descriptionErr = "description is required";
  }
  else{
    $description = $_POST["description"];
}
    
  if (isset($_POST["address"])) {
    $address = NULL;
  } 

  if (isset($_POST["phone"])) {
    $phoneErr = "Phone is required";
  } else {
    $phone = test_input($_POST["phone"]);
    if (!preg_match("?(\d3)?[-. ]?(\d{3})[-. ]?(\d{4})",$phone)) {
        $phoneErr = "Not valid phone number"; 
    }
  }

  if (isset($_POST['layout_bed'])){
      $layout_bedErr = "number(s) of bedroom is required";
  } else{
      $layout_bed = test_input($_POST['layout_bed']);
      if (!preg_match("^[1-9]\d*$",$layout_bed)) {
        $layout_bedErr = "should only contains integers"; 
      }
  }
  if (isset($_POST['layout_bath'])){
    $layout_bathErr = "number(s) of bathroom is required";
}else{
    $layout_bath = test_input($_POST['layout_bath']);
    if (!preg_match("/^[+]{0,1}(\d+)$|^[+]{0,1}(\d+\.\d+)$/",$layout_bath)) {
      $layout_bathErr = "should only contains number"; 
    }
}

if (isset($_POST['space'])){
    $spaceErr = "house space is required";
}else{
    $space = test_input($_POST['space']);
    if (!preg_match("/^[+]{0,1}(\d+)$|^[+]{0,1}(\d+\.\d+)$/",$space)) {
      $spaceErr = "should only contains number"; 
    }
}


if (isset($_POST['category'])){
    $categoryErr = "category of your house is required like (single room,condon ...）";
}else{
    $category = $_POST['category'];
}

if (isset($_POST['price'])){
    $priceErr = "Estimate selling price should provide";
}else{
    $price = test_input($_POST['price']);
    if (!preg_match("/^[+]{0,1}(\d+)$|^[+]{0,1}(\d+\.\d+)$/",$price)) {
      $priceErr = "should only contains number"; 
    }
}

  if(isset($nameErr)&&isset($descriptionErr)&&isset($layout_bathErr)&&isset($layout_bedErr)&&isset($spaceErr)&&isset($categoryErr)&&isset($priceErr)&&isset($phoneErr)){
      $layout = $layout_bed."BD,".$layout_bed."BR";
      $query = "Insert into CommunityList values(NULL,'".$name."','".$layout."','".$space."','".$category."','".$description."','".$address."','".$phone."','".$price."',default,'".$_SESSION[email]."','".$_SESSION[password]."','Eugene','".$_POST['classify']."');";
      $add = mysqli_query($db,$query)
      or die(mysqli_error($db));
      mysqli_free_result($add);
      mysqli_close($db);
      header("src = userinfor.php");
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Community Adding Form</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="addhousing.php">  
  Name: <textarea name="name" rows="5" cols="40" maxlength="50"><?php echo $name;?></textarea>
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Category: <input type="text" name="category" value="<?php echo $category;?>" maxlength="30">
  <span class="error">* <?php echo $categoryErr;?></span>
  <br><br>
  Space : <input type="text" name="space" value="<?php echo $space;?>" maxlength="30">
  <span class="error"><?php echo $spaceErr;?></span>
  <br><br>
  #Bedroom : <input type="text" name="layout_bed" value="<?php echo $layout_bed;?>" maxlength="30">
  <span class="error">* <?php echo $layout_bedErr;?></span>
  <br><br>
  #Bathroom : <input type="text" name="layout_bath" value="<?php echo $layout_bath;?>" maxlength="30">
  <span class="error">* <?php echo $layout_bathErr;?></span>
  <br><br>
  Price : <input type="text" name="price" value="<?php echo $price;?>" maxlength="30">
  <span class="error">* <?php echo $priceErr;?></span>
  <br><br>
  Description: <textarea name="description" rows="5" cols="40" maxlength="800"><?php echo $description;?></textarea>
  <span class="error">* <?php echo $descriptionErr;?></span>
  <br><br>
  Address: <input type="text" name="address" value="<?php echo $address;?>" maxlength="30">
  <br><br>
  Phone: <input type="text" name="phone" value="<?php echo $phone;?>">
  <span class="error">* <?php echo $phoneErr;?></span>
  <br><br>
  Classification: <select name = "classify">
		            <?php while ($row1 = mysqli_fetch_array($result)):;?>
                    <option><?php echo $row1['Name'];?></option>
                    <?php endwhile;
                    mysqli_free_result($result);?>
                  </select>
  <br><br>
  <input type="submit" name="submit" value="Go">  
</form>


</body>
</html>