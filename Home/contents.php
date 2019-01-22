<?php
include('delete_c.php');
include('connectdata.txt');
$db = mysqli_connect($server, $user, $pass , $dbname , $port)
or die('Error connecting to Mysql server.');
?>

<html>
<head>
       <title>Contents of table</title>
       <style>
       .item-a{   

        grid-column: 1;   
      
        grid-row: 1;  
    
        background:Pink; 
    }   
    .container{   
    
        display: grid;   
      
        grid-template-columns: 1fr;   
      
        grid-template-rows: 0.5fr 2fr 2fr 2fr 2fr 2fr 2fr 2fr 2fr 2fr 2fr 2fr;   
      
	grid-auto-flow: row;  
	
	grid-row-gap:20px;
      
      }
table, th, td {
  border: 1px solid black;
}
</style>
    </style>
</head>

<body bgcolor = "Pink">
<section class = "container">
    <center>
    <div class = "item-a">
    <h1><font face = "Comic Sans MS">Contents of table</font></h1>
    <font size = "+1"><a href = "../Home/Home.html">Home</a> ||<a href = "../Home/Summary.html">Summary</a> || <a href = "../Home/Logical_design.html">Logical design</a> || <a href = "../list/classification.php">List of Application</a> || <a href = "../Home/UserGuide.html">User's guide</a> || <a href = "../Home/contents.php">Contents of tables</a> || <a href = "../Home/code.html">Implementation code</a> || <a href = "../Home/conclusion">Conclusion</a></font>

    </div>

    <div class = "item-b">

<?php 
    $query = "select * from City;";
    $result = mysqli_query($db,$query);
?>
<h1>City</h1>

    <table style="width:80%">
        <tr>
            <th>City_name</th>
            <th>State</th> 
            <th>Found</th>
            <th>Area</th>
            <th>Zip_code</th>
        </tr>
    <?php while($row = mysqli_fetch_array($result)){ ?>
        <tr>
            <td><?php echo $row['City_name'];?></td>
            <td><?php echo $row['State'];?></td>
            <td><?php echo $row['Found'];?></td>
            <td><?php echo $row['Area'];?></td>
            <td><?php echo $row['Zip_code'];?></td>
        </tr>
        <?php
    }
    mysqli_free_result($result);

?>
    </table>
    </div>

    <div class = "item-c">
    <?php 
    $query = "select * from Sale;";
    $result = mysqli_query($db,$query);
?>
<h1>Sale</h1>
    <table style="width:80%">
        <tr>
            <th>Sale_name</th>
            <th>User_guide</th> 
            <th>Classification</th>
            <th>FK_City_name</th>
        </tr>
    <?php while($row = mysqli_fetch_array($result)){ ?>
        <tr>
            <td><?php echo $row['Sale_name'];?></td>
            <td><?php echo $row['User_guide'];?></td>
            <td><?php echo $row['Classfication'];?></td>
            <td><?php echo $row['City_City_name'];?></td>
        </tr>
        <?php
    }
    mysqli_free_result($result);

?>
    </table>
    </div>

    <div class = "item-d">
    <?php 
    $query = "select * from Community;";
    $result = mysqli_query($db,$query);
?>
<h1>Community</h1>
    <table style="width:80%">
        <tr>
            <th>Community_name</th>
            <th>User_guide</th> 
            <th>Classification</th>
            <th>FK_City_name</th>
        </tr>
    <?php while($row = mysqli_fetch_array($result)){ ?>
        <tr>
            <td><?php echo $row['Community_name'];?></td>
            <td><?php echo $row['User_guide'];?></td>
            <td><?php echo $row['Classfication'];?></td>
            <td><?php echo $row['City_City_name'];?></td>
        </tr>
     
        <?php
    }
    mysqli_free_result($result);

?>
    </table>
    </div>

    <div class = "item-e">
    <?php 
    $query = "select * from Housing;";
    $result = mysqli_query($db,$query);
?>
<h1>Housing</h1>
    <table style="width:80%">
        <tr>
            <th>Housing_name</th>
            <th>User_guide</th> 
            <th>Classification</th>
            <th>FK_City_name</th>
        </tr>
    <?php while($row = mysqli_fetch_array($result)){ ?>
        <tr>
            <td><?php echo $row['Housing_name'];?></td>
            <td><?php echo $row['User_guide'];?></td>
            <td><?php echo $row['Classfication'];?></td>
            <td><?php echo $row['City_City_name'];?></td>
        </tr>

        <?php
    }
    mysqli_free_result($result);

?>
    </table>
    </div>

    <div class = "item-f">
    <?php 
    $query = "select * from Job;";
    $result = mysqli_query($db,$query);
?>
<h1>Job</h1>
    <table style="width:80%">
        <tr>
            <th>Job_name</th>
            <th>User_guide</th> 
            <th>Classification</th>
            <th>FK_City_name</th>
        </tr>
    <?php while($row = mysqli_fetch_array($result)){ ?>
        <tr>
            <td><?php echo $row['Job_name'];?></td>
            <td><?php echo $row['User_guide'];?></td>
            <td><?php echo $row['Classfication'];?></td>
            <td><?php echo $row['City_City_name'];?></td>
        </tr>
     
        <?php
    }
    mysqli_free_result($result);

?>
    </table>
    </div>

    <div class = "item-g">
    <?php 
    $query = "select * from Service;";
    $result = mysqli_query($db,$query);
?>
<h1>Service</h1>
    <table style="width:80%">
        <tr>
            <th>Service_name</th>
            <th>User_guide</th> 
            <th>Classification</th>
            <th>FK_City_name</th>
        </tr>
    <?php while($row = mysqli_fetch_array($result)){ ?>
        <tr>
            <td><?php echo $row['Service_name'];?></td>
            <td><?php echo $row['User_guide'];?></td>
            <td><?php echo $row['Classfication'];?></td>
            <td><?php echo $row['City_City_name'];?></td>
        </tr>
      
        <?php
    }
    mysqli_free_result($result);

?>
    </table>
    </div>

    <div class = "item-h">
    <?php 
    $query = "select * from SaleList;";
    $result = mysqli_query($db,$query);
?>
<h1>SaleList</h1>
    <table style="width:80%">
        <tr>
            <th>Sale_id</th>
            <th>Name</th> 
            <th>Phone</th> 
            <th>Description</th>
            <th>Price</th>
            <th>Address_id</th>
            <th>Date_public</th>
            <th>FK City_City_name</th>
            <th>FK Sale_name</th>
        </tr>
    <?php while($row = mysqli_fetch_array($result)){ ?>
        <tr>
            <td><?php echo $row['Sale_id'];?></td>
            <td><?php echo $row['Name'];?></td>
            <td><?php echo $row['Phone'];?></td>
            <td><?php echo $row['Description'];?></td>
            <td><?php echo $row['Price'];?></td>
            <td><?php echo $row['Address_id'];?></td>
            <td><?php echo $row['Date_public'];?></td>
            <td><?php echo $row['Sale_City_City_name'];?></td>
            <td><?php echo $row['Sale_name'];?></td>
        </tr>
       
        <?php
    }
    mysqli_free_result($result);

    ?>
    </table>
    </div>

    <div class = "item-i">
    <?php 
    $query = "select * from CommunityList;";
    $result = mysqli_query($db,$query);
?>
<h1>CommunityList</h1>
    <table style="width:80%">
        <tr>
            <th>Community_id</th>
            <th>Name</th> 
            <th>Address_id</th> 
            <th>Description</th>
            <th>Phone</th>
            <th>Date_public</th>
            <th>FK City_City_name</th>
            <th>FK Community_name</th>
        </tr>
    <?php while($row = mysqli_fetch_array($result)){ ?>
        <tr>
            <td><?php echo $row['Community_id'];?></td>
            <td><?php echo $row['Name'];?></td>
            <td><?php echo $row['Address_id'];?></td>
            <td><?php echo $row['Description'];?></td>
            <td><?php echo $row['Phone'];?></td>
            <td><?php echo $row['Date_public'];?></td>
            <td><?php echo $row['Community_City_City_name'];?></td>
            <td><?php echo $row['Community_Community_name'];?></td>
        </tr>
        
        <?php
    }
    mysqli_free_result($result);

    ?>
    </table>
    </div>

    <div class = "item-j">
    <?php 
    $query = "select * from HousingList;";
    $result = mysqli_query($db,$query);
?>
<h1>HousingList</h1>
    <table style="width:80%">
        <tr>
            <th>Housing_id</th>
            <th>Name</th> 
            <th>Layout</th> 
            <th>Space</th>
            <th>Category</th>
            <th>Description</th>
            <th>Address_id</th>
            <th>Phone</th>
            <th>Price</th>
            <th>Date_public</th>
            <th>FK City_City_name</th>
            <th>FK Housing_name</th>
        </tr>
    <?php while($row = mysqli_fetch_array($result)){ ?>
        <tr>
            <td><?php echo $row['Housing_id'];?></td>
            <td><?php echo $row['Name'];?></td>
            <td><?php echo $row['Lay_out'];?></td>
            <td><?php echo $row['Space'];?></td>
            <td><?php echo $row['Category'];?></td>
            <td><?php echo $row['Description'];?></td>
            <td><?php echo $row['Address_id'];?></td>
            <td><?php echo $row['Phone'];?></td>
            <td><?php echo $row['Price'];?></td>
            <td><?php echo $row['Date_public'];?></td>
            <td><?php echo $row['Housing_City_City_name'];?></td>
            <td><?php echo $row['Housing_Housing_name'];?></td>
        </tr>
        
        <?php
    }
    mysqli_free_result($result);

    ?>
    </table>
    </div>

        <div class = "item-j">
    <?php 
    $query = "select * from JobList;";
    $result = mysqli_query($db,$query);
?>
<h1>JobList</h1>
    <table style="width:80%">
        <tr>
            <th>Job_id</th>
            <th>Name</th> 
            <th>Address_id</th> 
            <th>Salary</th>
            <th>Employment_type</th>
            <th>Phone</th>
            <th>Description</th>
            <th>Date_public</th>
            <th>FK City_City_name</th>
            <th>FK Job_name</th>
        </tr>
    <?php while($row = mysqli_fetch_array($result)){ ?>
        <tr>
            <td><?php echo $row['Job_id'];?></td>
            <td><?php echo $row['Name'];?></td>
            <td><?php echo $row['Address_id'];?></td>
            <td><?php echo $row['Salary'];?></td>
            <td><?php echo $row['Employment_type'];?></td>
            <td><?php echo $row['Phone'];?></td>
            <td><?php echo $row['Description'];?></td>
            <td><?php echo $row['Date_public'];?></td>
            <td><?php echo $row['Job_City_City_name'];?></td>
            <td><?php echo $row['Job_name'];?></td>
        </tr>
        
        <?php
    }
    mysqli_free_result($result);

    ?>
    </table>
    </div>  
  <div class = "item-k">
    <?php 
    $query = "select * from ServiceList;";
    $result = mysqli_query($db,$query);
?>
<h1>ServiceList</h1>
    <table style="width:80%">
        <tr>
            <th>Service_id</th>
            <th>Name</th> 
            <th>Address_id</th> 
            <th>Description</th>
            <th>Phone</th>
            <th>Date_public</th>
            <th>FK City_City_name</th>
            <th>FK Service_name</th>
        </tr>
    <?php while($row = mysqli_fetch_array($result)){ ?>
        <tr>
            <td><?php echo $row['Service_id'];?></td>
            <td><?php echo $row['Name'];?></td>
            <td><?php echo $row['Address_id'];?></td>
            <td><?php echo $row['Description'];?></td>
            <td><?php echo $row['Phone'];?></td>
            <td><?php echo $row['Date_public'];?></td>
            <td><?php echo $row['Service_City_City_name'];?></td>
            <td><?php echo $row['Service_Service_name'];?></td>
        </tr>
      
        <?php
    }
    mysqli_free_result($result);
    mysqli_close($db);
    ?>
    </table>
    </div>
</center>
</section>
</body>
</html>
