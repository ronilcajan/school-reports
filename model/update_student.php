<?php 
	include '../server/server.php';

	$id 	        = $conn->real_escape_string($_POST['id']);
	$nom 	        = $conn->real_escape_string($_POST['nom']);
	$prenom         = $conn->real_escape_string($_POST['prenom']);
	$etab 		    = $conn->real_escape_string($_POST['etab']);
	$formation		= $conn->real_escape_string($_POST['formation']);
	$promo 	        = $conn->real_escape_string($_POST['promo']);
	$seance         = $conn->real_escape_string($_POST['seance']);
	$type 	        = $conn->real_escape_string($_POST['type']);
    $debut 	        = $conn->real_escape_string($_POST['debut']);
    $fin 	        = $conn->real_escape_string($_POST['fin']);
	$duree 	        = $conn->real_escape_string($_POST['duree']);
	$date           = $conn->real_escape_string($_POST['date']);
	$heure_pointage = $conn->real_escape_string($_POST['heure_pointage']);
	$categorie		= $conn->real_escape_string($_POST['categorie']);
    $enseig 	    = $conn->real_escape_string($_POST['enseig']);
    $cat_fusionee   = $conn->real_escape_string($_POST['cat_fusionee']);


    $update 	= "UPDATE students SET nom='$nom', prenom='$prenom', etab='$etab', formation='$formation', promo='$promo', seance='$seance', `type`='$type', 
    debut='$debut', fin='$fin', duree='$duree', `date`='$date', heure_pointage='$heure_pointage', categorie='$categorie', enseig='$enseig', cat_fusionee='$cat_fusionee'
    WHERE id='$id'";	
    $result 	= $conn->query($update);

    if($result){
        $_SESSION['message'] = "Student has been updated!";
        header('location: ../pages/edit_student.php?id='.$id);
    }else{
        $_SESSION['error'] = "Student not updated!";
        header('location: ../pages/edit_student.php?id='.$id);
    }

	$conn->close();

?>