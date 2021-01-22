<?php 
	include '../server/server.php';

	$id 	= $conn->real_escape_string($_GET['id']);


	if($id != ''){
		$query 		= "DELETE FROM students WHERE id = '$id'";
		
		$result 	= $conn->query($query);
		
		if($result){
            $_SESSION['error'] = "Student has been removed!";
            header('location: ../pages/dashboard.php');
		}
	}else{
        $_SESSION['error'] = "Student has been removed!";
        header('location: ../pages/dashboard.php');
	}

	$conn->close();


