<?php
include 'connect.php';

$username = $_POST['username'];
$password = $_POST['password'];
$user_level = 2;
/*
$sql = "INSERT INTO users (username, password ,user_level) VALUES ('$username', '$password', '$user_level')";

$result = mysqli_query($conn,$sql);

*/


if(empty($username) or empty($password)){
    echo "Fields Empty !";
}else{
    mysqli_query($conn,"INSERT INTO users (username,password,user_level) VALUES ('$username','$password','$user_level')");
    header('Location:index_logout.html');

}

