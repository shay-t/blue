<?php
include('connexion.php');
if(isset($_POST['sub'])){
    /*Récupérer les valeurs saisis*/ 
	$nompre=$_POST['nompre'];
	$mail=$_POST['mail'];
	$mdp=$_POST['mdp'];
    $date=$_POST['date_naissance'];
    $bio=$_POST['bio'];
	if(isset($_FILES['fichier']) and $_FILES['fichier']['error']==0)
	{ 
		$dossier='photo/';
		$temp_name=$_FILES['fichier']['tmp_name'];
		if(!is_uploaded_file($temp_name))
		{
		exit("le fichier est untrouvable");
		}
		if ($_FILES['fichier']['size'] >= 1000000){
			exit("Erreur, le fichier est volumineux");
		}
		$infosfichier = pathinfo($_FILES['fichier']['name']);
		$extension_upload = $infosfichier['extension'];
		
		$extension_upload = strtolower($extension_upload);
		$extensions_autorisees = array('png','jpeg','jpg');
		if (!in_array($extension_upload, $extensions_autorisees))
		{
		exit("Erreur, Veuillez inserer une image svp (extensions autorisées: png)");
		}
		$nom_photo=$nompre.".".$extension_upload;
		if(!move_uploaded_file($temp_name,$dossier.$nom_photo)){
		exit("Problem dans le telechargement de l'image, Ressayez");
		}
		$ph_name=$nom_photo;
	}
	else{
		$ph_name="inconnu.jpg";
	}
	$requette=" INSERT INTO user VALUES(0,'$nompre','$mail','$date','$mdp','$ph_name','$bio')";
	$resultat=mysqli_query($link,$requette);
	$sql="select ID_USER from user where EMAIL='".$mail."'and MDP='".$mdp."'";
    $result=mysqli_query($link,$sql);
    $row=mysqli_fetch_assoc($result);
	$id=$row['ID_USER'];
	foreach($_POST['ci'] as $v){
		$req="INSERT INTO interesser VALUES('$v','$id')";
		$res=mysqli_query($link,$req);
	}
	header('Location:index.php');
 }
 ?>