<?php
include 'connect.php';
session_start();
$username = $_SESSION['username'];


$query_name = mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");
$run_name = mysqli_fetch_array($query_name);
$user_level = $run_name['user_level'];
$query_level = mysqli_query($conn,"SELECT name FROM user_level WHERE id='$user_level' ");
$run_level = mysqli_fetch_array($query_level);
$level_name = $run_level['name'];

?>
<html>
<head>
    <title>Profile Panel</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<img id='logo' src="images/logo.jpg"/>
<div id="wrapper">
    <div id="nav">
        <ul>
            <li><a href="index_login.html">Home</a></li>
            <li><a href="games.php">Games</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <h3>Profile</h3>

    <p>You are logged in as <b><?php echo $username ?></b> [ <?php  echo "$level_name"?> ] </p>


    <p>
        <?php
        if($user_level == 1){
            echo "<a href='admin.php'> Admin Panel</a>";
        }
        ?>
        <a href="upload.php">Upload</a>

    </p>
</div>
</body>
</html>
