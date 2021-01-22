<?php 
	include '../server/server.php';

	$id_admission 	= $conn->real_escape_string($_POST['id_admission']);
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

    $insert 	= "INSERT INTO students (id_admission, nom, prenom, etab, formation, promo, seance, `type`, debut, fin, duree, `date`, heure_pointage, categorie, enseig, cat_fusionee) 
                VALUES ('$id_admission','$nom', '$prenom', '$etab' , '$formation', '$promo', '$seance', '$type', '$debut','$fin', '$duree', '$date', '$heure_pointage','$categorie', '$enseig','$cat_fusionee')";	
    $insert_res 	= $conn->query($insert);

    if($insert_res){
        $_SESSION['message'] = "Student has been saved!";
        header('location: ../pages/dashboard.php');
    }

	$conn->close();

?>