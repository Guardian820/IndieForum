<?php

session_start();
include 'connect.php';


$record_count = mysqli_query($conn,"SELECT * FROM games");

$per_page = 3;

$pages = ceil($record_count->num_rows/$per_page);



if(isset($_GET['p']) && is_numeric($_GET['p'])){
    $page = $_GET['p'];
}else{
    $page = 1;
}
if($page<=0){
    $start = 0;
}else{
    $start = $page * $per_page - $per_page;
}

$prev = $page - 1;
$next = $page + 1;

$query = $conn->prepare("SELECT post_id,title,image_name,LEFT(body,100)AS body FROM games order by post_id desc
limit $start, $per_page");
$query->execute();
$query->bind_result($post_id,$title,$image_name,$body);


?>
<html>
<head>
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<img id='logo' src="images/logo.jpg"/>
<div id="wrapper">
    <div id="nav">
        <ul>
        <?php if(!isset($_SESSION['user_id'])){ ?>
            <li><a href="index_logout.html">Home</a></li>
            <li><a href="games.php">Games</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="register.html">Register</a></li>

        <?php }else{ ?>
            <li><a href="index_login.html">Home</a></li>
            <li><a href="games.php">Games</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php }?>
        </ul>
    </div>
    <div id="all_posts">
    <?php
    while($query->fetch()){
        $lastspace = strrpos($body,' ');
        ?>
        <div id="game_post">
        <article>
            <img src="<?php echo 'images/'.$image_name?>" height="250px"  id="post_image"  />
            <h2><?php echo $title ?></h2>
            <p><?php echo substr($body,0,$lastspace),"<a href='game.php?id=$post_id'>..</a>" ?></p>
        </article>
        </div>
    <?php } ?>
    </div>
    <?php
    if($prev > 0){
        echo "<a href='games.php?p=$prev'>Previous</a>";
    }
    if($page < $pages){
        echo "<a href='games.php?p=$next'>Next</a>";
    }
    ?>
</div>
</body>
</html>