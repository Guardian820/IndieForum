<?php
include 'connect.php';
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);  // 7 day cookie lifetime
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$_SESSION['username'] = $username;


if(empty($username) or empty($password)){
    echo "Fields Empty !";
}else{
        $check_login = mysqli_query($conn,"SELECT id FROM users WHERE username='$username' AND password='$password'");
        if(mysqli_num_rows($check_login) == 1){
            $run = mysqli_fetch_array($check_login);
            $user_id = $run['id'];
            $user_level = $run['user_level'];
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_level'] = $user_level;
            header('location: index_login.html');
    }else{
        echo "wrong username/pass";
    }


}

