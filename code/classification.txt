<?php
session_start();
$_SESSION['city'] = "Eugene";
if (isset($_GET['city'])){
    $_SESSION['city'] = $_GET['city'];
}
include('connectdata.txt');

$db = mysqli_connect($server, $user, $pass , $dbname , $port)
or die('Error connecting to Mysql server.');
?>

<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class = "container">
        <div class = "item-a">
            <h1>Advertisement of <?php echo $_SESSION['city']?></h1>
            <ul>
            <li><a href = "../Home/Home.html">Home</a></li>
            <li><a href = "../Home/Summary.html">Summary</a></li>
            <li><a href = "../Home/Logical_design.html">Logical design</a></li>
            <li><a href = "../list/classification.php">List of Application</a></li>
            <li><a href = "../Home/UserGuide.html">User's guide</a></li>
            <li><a href = "../Home/contents">Contents of tables</a></li>
            <li><a href = "../Home/code">Implementation code</a></li>
            <li><a href = "../Home/conclusion">Conclusion</a></li>
	    </ul>
        </div>
        <div class = "item-b">
	    <?php

	    $query = "Select Community_name,User_guide from Community where City_City_name = '".$_SESSION['city']."' and Classfication = 'Community';";
            $result_1 = mysqli_query($db,$query);
            ?>
            <h1>Community</h1>
            <p>Content of Community</p>
            <ul>
            <?php while($row = mysqli_fetch_array($result_1)){ ?>
            <li><a href = "community_list.php?name=<?php echo $row['Community_name'];?>&guide=<?php echo urlencode($row['User_guide']);?>"><?php echo $row['Community_name'];?></a></li>
            <?php
            }
            mysqli_free_result($result_1);
            ?>
            </ul>
        </div>
        <div class = "item-c">
            <?php
            $query = "Select Housing_name,User_guide from Housing where City_City_name = '".$_SESSION['city']."' and Classfication = 'Housing';";
            $result_2 = mysqli_query($db,$query);
            ?>
            <h1>Housing</h1>
            <p>Content of Housing</p>
            <ul>
            <?php while($row = mysqli_fetch_array($result_2)){ ?>
            <li><a href = "housing_list.php?name=<?php echo $row['Housing_name'];?>&guide=<?php echo $row['User_guide'];?>"><?php echo $row['Housing_name'];?></a></li>
            <?php
            }
            mysqli_free_result($result_2);
            ?>
            </ul>
        </div>
        <div class = "item-d">
            <?php
            $query = "Select Job_name,User_guide from Job where City_City_name = '".$_SESSION['city']."' and Classfication = 'Job';";
            $result_3 = mysqli_query($db,$query);
            ?>
            <h1>Job</h1>
            <p>Content of Job</p>
            <ul>
            <?php while($row = mysqli_fetch_array($result_3)){ ?>
            <li><a href = "job_list.php?name=<?php echo $row['Job_name'];?>&guide=<?php echo $row['User_guide'];?>"><?php echo $row['Job_name'];?></a></li>
            <?php
            }
            mysqli_free_result($result_3);
            ?>
            </ul>
        </div>
        <div class = "item-e">
            <?php
            $query = "Select Sale_name, User_guide from Sale where City_City_name = '".$_SESSION['city']."' and Classfication = 'Sale';";
            $result_4 = mysqli_query($db,$query);
            ?>
            <h1>Sale</h1>
            <p>Content of Sale</p>
            <ul>
            <?php while($row = mysqli_fetch_array($result_4)){ ?>
            <li><a href = "sale_list.php?name=<?php echo $row['Sale_name'];?>&guide=<?php echo $row['User_guide'];?>"><?php echo $row['Sale_name'];?></a></li>
            <?php
            }
            mysqli_free_result($result_4);
            ?>
            </ul>
        </div>
        <div class = "item-f">
            <?php
            $query = "Select Service_name,User_guide from Service where City_City_name = '".$_SESSION['city']."' and Classfication = 'Service';";
            $result_5 = mysqli_query($db,$query);
            ?>
            <h1>Service</h1>
            <p>Content of Service</p>
            <ul>
            <?php while($row = mysqli_fetch_array($result_5)){ ?>
            <li><a href = "service_list.php?name=<?php echo $row['Service_name'];?>&guide=<?php echo $row['User_guide'];?>"><?php echo $row['Service_name'];?></a></li>
            <?php
            }
            mysqli_free_result($result_5);
            ?>
            </ul>
        </div>
        <div class = "item-g">
            <?php
            $query = "select City_name from City";
            $result_6 = mysqli_query($db,$query)
            or die(mysqli_error($db));
            ?>
            <h1>City</h1>
            <ul>
            <?php while($row = mysqli_fetch_array($result_6)){ ?>
            <li><a href = "classification.php?city=<?php echo $row['City_name'];?>"><?php echo $row['City_name'];?></a></li>
            <?php
            }
            mysqli_free_result($result_6);
            mysqli_close($db);
            ?>
            </ul>
	</div>
    </section>
</body>
</html>
