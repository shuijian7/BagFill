<?php
session_start();
include('connectdata.txt');

$db = mysqli_connect($server, $user, $pass , $dbname , $port)
or die('Error connecting to Mysql server.');
$query_1 = "Select Name from Sale where City_City_name = 'Eugene' and Classification = 'Sale';";
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
$nameErr = $descriptionErr = $phoneErr = $priceErr = "";
$name = $description = $address = $phone = $price = "";

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
  if (isset($_POST['price'])){
    $price = NULL;
    $price = test_input($_POST['price']);
    if (!preg_match("/^[+]{0,1}(\d+)$|^[+]{0,1}(\d+\.\d+)$/",$price)) {
      $priceErr = "should only contains number"; 
    }
}
  if(isset($nameErr)&&isset($descriptionErr)&&isset($phoneErr)&&isset($priceErr)){
      $query = "Insert into CommunityList values(NULL,'".$name."','".$phone."','".$description."','".$price."','".$address."',default,'".$_SESSION[email]."','".$_SESSION[password]."',Eugene,'".$_POST['classify']."');";
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
  <span class="error">*<?php echo $nameErr;?></span>
  <br><br>
  Price : <input type="text" name="price" value="<?php echo $price;?>" maxlength="30">
  <span class="error"><?php echo $priceErr;?></span>
  <br><br>
  Description: <textarea name="description" rows="5" cols="40" maxlength="800"><?php echo $description;?></textarea>
  <span class="error">*<?php echo $descriptionErr;?></span>
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
  <input type="submit" name="submit" value="Go">  
</form>


</body>
</html>