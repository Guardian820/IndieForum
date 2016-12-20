<?php

session_start();
include 'connect.php';

if(!isset($_SESSION['user_id'])){
    header('Location login.php');
}

if(isset($_POST['submit'])){
    if(isset($_FILES['post_image'])) {
        $file_name = $_FILES['post_image']['name'];
        $file_size = $_FILES['post_image']['size'];
        $file_tmp = $_FILES['post_image']['tmp_name'];
        $file_type = $_FILES['post_image']['type'];
    }
    $title = $_POST['title'];
    $body = $_POST['body'];
    $user_id = $_SESSION['user_id'];
    $body = htmlentities($body);


    move_uploaded_file($file_tmp,"images/".$file_name);



    mysqli_query($conn,"INSERT INTO games (user_id,title,body,image_name) VALUES ('$user_id','$title','$body','$file_name')");

    if(empty($title) || empty($body) ){
            echo "missing data";
    }

}
?>

<html>
<head>
    <title>Create New Post</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<img id='logo' src="images/logo.jpg"/>
<div id="wrapper">
    <div id="nav">
        <ul>
            <li><a href="index_logout.html">Home</a></li>
            <li><a href="games.php">Games</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="register.html">Register</a></li>
        </ul>
    </div>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label>Title</label><input type="text" name="title"/>
        <br>

        <br>
        <label>Body</label>
        <textarea name="body" cols="50" rows="10"></textarea>
        <br>
        <input name="post_image" type="file" />
        <br>
        <input type="submit" value="submit" name="submit"/>
    </form>
</div>
</body>
</html>