<?php
session_start();
include('connectdata.txt');

$db = mysqli_connect($server, $user, $pass , $dbname , $port)
or die('Error connecting to Mysql server.');
if(!isset($_GET['id'])){
    $id = $_GET['id'];
    $delete = mysqli_query($db,"Delete from CommunityList where Community_id = $id")
    or die(mysqli_error($conn));
}
$query_1 = "Select Community_name from Community where City_City_name = 'Eugene' and Classification = 'Community';";
$query_2 = "Select Co.Community_id, Co.Name, Co.Date_public from CommunityList C join User U on(C.User_Email = U.Email) and (C.User_Password = U.Password) where U.Email = '".$_SESSION[email]."' and U.Password = '".$_SESSION[Password]."';";
$result_1 =  mysqli_query($db,$query_1);
$result_2 =  mysqli_query($db,$query_2);
?>

<html>
<body>
    <h1>Community</h1>
    <ul>
    <?php while($row1 = mysql_fetch_assoc($result_1)){ ?>
    <li><?php echo $row[Community_name]?></li>
    <ul>
    <?php while($row2 = mysql_fetch_assoc($result_2)){ ?>
    <li><a href = "../list_of_application/community_list_content.php?id=<?php echo $row['Community_id'];?>"><?php echo $row['Name'].$row['Date_public'];?></a>||<a href = "community_user?id =<?php echo $row['Community_id'];?>">Delete</li>
    <?php
    }
    ?>
    </ul>
    <?php
    mysqli_free_result($result_2);
    }
    mysqli_free_result($result_1);
    mysqli_close($db);
    ?>
    </ul>
    <hr>
    <center><a href = "../userinfor/addcommunity.php">Add</a></center>
</body>
</html>