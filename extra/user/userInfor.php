<?php
session_start();
?>

<html>
<head>
       <title>UserAccount</title>
</head>
<body bgcolor = "Pink">
<div class = "topcorner"><font size = "+1" face = "Comic Sans MS">

<?php
if (!isset($_SESSION['email'])){
    echo $_SESSION['msg'];
}
else{
    echo 'Hi!'.$_SESSION["username"];
}
?>

<frameset rows="*,*">
    <frameset cols="*,*,*"> 
            <frame src="community_user.php"> 
            <frame src="housing_user.php"> 
            <frame src="job_user.php"> 
        </frameset>
    <frameset cols="*,*"> 
            <frame src="service_user.php"> 
            <frame src="sale_user.php"> 
        </frameset>
    </frameset>
</frameset>
</body>
</html>