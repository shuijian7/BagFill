<?php
session_start();
$_SESSION['name'];
include('connectdata.txt');

$db = mysqli_connect($server, $user, $pass , $dbname , $port)
or die('Error connecting to Mysql server.');
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $delete = mysqli_query($db,"Delete from HousingList where Housing_id = $id")
  or die(mysqli_error($db));
  mysqli_free($delete);

}
$query = "Select Ho.Housing_id, Ho.Name, Ho.Date_public from HousingList Ho join Housing H on (Ho.Housing_City_City_name = H.City_City_name) and (Ho.Housing_Housing_name = H.Housing_name) where Ho.Housing_City_City_name = '".$_SESSION['city']."' and H.Classfication = 'Housing' and Ho.Housing_Housing_name =";
?>

<html>
<head>
  <link rel="stylesheet" href="style.css">
  </head>
  
  <body>
  <?php
  	$name = $_GET['name'];
      $name = mysqli_real_escape_string($db,$name);
      if(!empty($name)){
          $_SESSION['name'] = $name;
      }
      $query= $query."'".$_SESSION['name']."';";
      $result = mysqli_query($db,$query) or die(mysqli_error($db));
      if(!empty($_GET['guide'])){
          $_SESSION['guide'] = $_GET['guide'];}
         $guide = $_SESSION['guide']."(".$_SESSION['city'].")";
    ?>
  <center><h1><font face = "Comic Sans MS"><?php echo $_SESSION['name']?></font></h1></center>
  <center><font size = "+1"><a href = "../Home/Home.html">Home</a> ||<a href = "../Home/Summary.html">Summary</a> || <a href = "../Home/Logical_design.html">Logical design</a> || <a href = "../list/classification.php">List of Application</a> || <a href = "../Home/UserGuide.html">User's guide</a> || <a href = "../Home/contents.php">Contents of tables</a> || <a href = "../Home/code.html">Implementation code</a> || <a href = "../Home/conclusion">Conclusion</a></font></center>
  <hr>
  <center><h1><?php echo $guide;?></h1></center>
    <ul>
    <?php while($row = mysqli_fetch_array($result)){ ?>
    <li><a href = "housing_list_content.php?id=<?php echo $row['Housing_id'];?>"><?php echo $row['Name'].$row['Date_public'];?></a> 
|| <a onclick = "return confirm('Are you sure to delete this advertisement?')" href ="delete_hous.php?id=<?php echo $row['Housing_id'];?>">Delete</a></li>
    <?php
    }
    mysqli_free_result($result);

    mysqli_close($db);
    ?>
    </ul>
    <center><a href = "addhousing.php">Add</a></center>
</body>
</html>
