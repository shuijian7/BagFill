<?php
session_start();
include('connectdata.txt');

$db = mysqli_connect($server, $user, $pass , $dbname , $port)
or die('Error connecting to Mysql server.');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $delete = mysqli_query($db,"Delete from SaleList where Sale_id = $id")
    or die(mysqli_error($conn));
}
$query_1 = "Select Name from Sale where City_City_name = 'Eugene' and Classification = 'Sale';";
$query_2 = "Select S.Sale_id, S.Name, S.Date_public from SaleList S join User U on(S.User_Email = U.Email) and (S.User_Password = U.Password) where U.Email = '".$_SESSION[email]."' and U.Password = '".$_SESSION[Password]."';";
$result_1 =  mysqli_query($db,$query_1);
$result_2 =  mysqli_query($db,$query_2);
?>

<html>
<body>
    <h1>Sale</h1>
    <ul>
    <?php while($row1 = mysql_fetch_assoc($result_1)){ ?>
    <li><?php echo $row[Name]?></li>
    <ul>
    <?php while($row2 = mysql_fetch_assoc($result_2)){ ?>
    <li><a href = "../list_of_application/sale_list_content.php?id=<?php echo $row['Sale_id'];?>"><?php echo $row['Name'].$row['Date_public'];?></a>||<a href = "sale_user?id =<?php echo $row['Sale_id'];?>">Delete</li>
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
    <center><a href = "../userinfor/addsale.php">Add</a></center>
</body>
</html>