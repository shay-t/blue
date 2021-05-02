<?php
session_start();
$id1 = $_SESSION['id'];
if (isset($_POST['send'])) {
    $_SESSION['id2'] =$_POST["send"];
        header("Location:messagerie.php");
    }
?>
