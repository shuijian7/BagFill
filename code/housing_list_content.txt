<?php

include('connectdata.txt');

$db = mysqli_connect($server, $user, $pass , $dbname , $port)
or die('Error connecting to Mysql server.');
?>
<html>
<head>
  <style>
  .container{   

  display: grid;   

  grid-template-columns: 1fr 2fr 2fr 2fr 2fr;   

  grid-template-rows: 1fr 1fr;   

  grid-auto-flow: row;  

  grid-column-gap:20px;

}
.item-a{   

grid-column: 1;   

grid-row: 1 / 3;  

background:Yellow; 
}  
</style>
</head>
<body>
<section class = "container">
          <div class = "item-a">
          <h1>Link</h1>
            <ul>
            <li><a href = "../Home/Home.html">Home</a></li>
            <li><a href = "../Home/Summary.html">Summary</a></li>
            <li><a href = "../Home/Logical_design.html">Logical design</a></li>
            <li><a href = "../list/classification.php">List of Allication</a></li>
            <li><a href = "../Home/UserGuide.html">User's guide</a></li>
            <li><a href = "../Home/contents">Contents of tables</a></li>
            <li><a href = "../Home/code">Implementation code</a></li>
            <li><a href = "../Home/conclusion">Conclusion</a></li>
            </ul>
        </div>
        <?php
        $id = $_GET['id'];
        $query = "Select * from HousingList where Housing_id = ".$id;
        $result = mysqli_query($db,$query) or die(mysqli_error($db));
        ?>
        <?php while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {?>
        <div class = "item-b">
          <h1>Name</h1>
        <ul>
          <li><?php echo $row['Name'];?></li>
        </ul>
        </div>
        <div class = "item-c">
          <h1>Description</h1>
        <ul>
          <li><?php echo $row['Description'];?></li>
        </ul>
        </div>
        <div class = "item-d">
          <h1>House information</h1>
        <ul>
          <li><?php echo "Category"." ".$row['Category'];?></li>
          <li><?php echo "Layout"." ".$row['Lay_out'];?></li>
          <li><?php echo "Space ft^2"." ".$row['Space'];?></li>
        </div>
        <div class = "item-d">
          <h1>Contact information</h1>
          <ul>
          <li><?php echo "Address"." ".$row['Address_id'];?></li>
          <li><?php echo "Phone"." ".$row['Phone'];?></li>
        </div>
 </section>
<?php
}
mysqli_free_result($result);

mysqli_close($db);
?>
</body>
</html>
