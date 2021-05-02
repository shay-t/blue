<?php
session_start();
$id1 = $_SESSION['id'];
if (isset($_POST['follow'])) {
    include("connexion.php");
    $val = $_POST["follow"];
    $sqls = "insert into suivre values('$id1','$val')";
    $ress = mysqli_query($link, $sqls);
    mysqli_close($link);
    header("Location:user.php");
}
if (isset($_POST['fichier'])) {
    include("connexion.php");
    $val = $_POST["fichier"];
    $txt=$_POST["comm"];
    $sqls = "insert into commenter (ID_USER, ID_TWEET,CONTENU) values('$id1','$val','$txt')";
    $ress = mysqli_query($link, $sqls);
    mysqli_close($link);
    header("Location:home_twitter.php");
}
?>