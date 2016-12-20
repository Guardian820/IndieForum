<?php
session_start();

if(!isset($_GET['id'])){
    header('Location: index.phpid');
    exit();
}else{
    $id = $_GET['id'];
}
include 'connect.php';

if(!is_numeric($id)){
   header('Location: index.phpnumber');
}

$query = mysqli_query($conn,"SELECT title,body,image_name FROM games WHERE post_id='$id'");

if($query->num_rows != 1){
    header('Location: index.php');
    exit();
}

if(isset($_POST['submit'])){
    $name = $_SESSION['username'];
    $comment = $_POST['comment'];

    //$comment = $conn->real_escape_string($comment);

    mysqli_query($conn,"INSERT INTO comments (name,comment,post_id) VALUES ('$name','$comment','$id') ");




}

?>
<html>
<head>
    <title>Games</title>
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
    <div id="post">
        <?php
        $row = $query->fetch_object();
        echo "<img width='500px'  src='images/".$row->image_name." '/>";
        echo "<h2>".$row->title."</h2>";
        echo "<p>".$row->body."</p>";

        ?>
        <br>
    </div>
    <div id="comment_section">
        <?php
        $qu = $conn->prepare("SELECT name,comment FROM comments WHERE post_id='$id'");
        $qu->execute();
        $qu->bind_result($comm_name,$comm_body);
        while($qu->fetch()){
            $lastspace = strrpos($comm_body,' ');
            ?>
            <article>

                <p><?php echo $comm_name ?> : <?php echo $comm_body?></p>
            </article>
        <?php } ?>
    </div>
    <?php if(isset($_SESSION['user_id'])){ ?>
        <div id="comment">
            <form action="<?php echo $_SERVER['PHP_SELF'].'?id='.$id?>" method="post">
                <div>
                    Comment:
                    <br>
                    <textarea name="comment" rows="5" cols="50"></textarea>
                    <br>
                    <input type="submit" value="submit" name="submit"/>
               </div>
            </form>
        </div>
    <?php } ?>

</div>
</body>
</html>