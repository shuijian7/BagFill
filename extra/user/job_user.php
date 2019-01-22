<?php
session_start();
include('connectdata.txt');

$db = mysqli_connect($server, $user, $pass , $dbname , $port)
or die('Error connecting to Mysql server.');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $delete = mysqli_query($db,"Delete from JobList where Job_id = $id")
    or die(mysqli_error($conn));
}
$query_1 = "Select Name from Job where City_City_name = 'Eugene' and Classification = 'Job';";
$query_2 = "Select J.Job_id, J.Name, J.Date_public from JobList J join User U on(J.User_Email = U.Email) and (J.User_Password = U.Password) where U.Email = '".$_SESSION[email]."' and U.Password = '".$_SESSION[Password]."';";
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
    <li><a href = "../list_of_application/job_list_content.php?id=<?php echo $row['Job_id'];?>"><?php echo $row['Name'].$row['Date_public'];?></a>||<a href = "job_user?id =<?php echo $row['Job_id'];?>">Delete</li>
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
    <center><a href = "../userinfor/addjob.php">Add</a></center>
</body>
</html>