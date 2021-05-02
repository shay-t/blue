<?php
session_start();
$log=$_GET['mail'];
$pass=$_GET['pass'];
if(empty($log)or empty($pass)){
    print "Saisissez votre log et votre mdp"."<br>";
    print "<a color='black' href='javascript: history.go (-1)'></a>";
}else{
    include('connexion.php');
    $sql="select * from user where EMAIL='".$log."'and MDP='".$pass."'";
    $result=mysqli_query($link,$sql);
    $row=mysqli_fetch_assoc($result);
    if($row != false){
        $_SESSION['name']=$row['NOM_PRENOM'];
        $_SESSION['id']=$row['ID_USER'];
        $_SESSION['pdp']=$row['PDP'];
        $_SESSION['id2'] =NULL;
        header('Location: user.php'); 
    }else{
        echo "erreur d'authentification ";
        print "Saisissez votre Login et votre mot de passe" . "<br>";
        print "<a href='javascript: history.go(-1)'>Retour</a>";
    }
}
?>