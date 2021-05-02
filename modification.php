<?php
session_start();
include('connexion.php');
if(isset($_POST['sub'])){
    /*Récupérer les valeurs saisis*/ 
	$nompre=$_POST['nompre'];
	$mail=$_POST['mail'];
	$mdp=$_POST['mdp'];
    $date=$_POST['date_naissance'];
    $bio=$_POST['bio'];
    /*En ce qui concerne la modification de la pdp*/
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
	}
    //UPDATE `user` SET `ID_USER`=[value-1],`NOM_PRENOM`=[value-2],`EMAIL`=[value-3],
    //`DATE_NAISSANCE`=[value-4],`MDP`=[value-5],`PDP`=[value-6],`DESCRIPTION`=[value-7] WHERE 1
    $b=$_SESSION['id'];
	$requette="UPDATE user SET `NOM_PRENOM`='$nompre',`EMAIL`='$mail', 'DATE_NAISSANCE`='$date',`MDP`='$mdp',`DESCRIPTION`='$bio',WHERE 'ID_USER'='$b'";
	$resultat=mysqli_query($link,$requette);
    print "Vos informations ont été modifié"."<br>";
    print "<a color='black' href='javascript: history.go (-1)'> Retour </a>";

 }
 ?>