<?php
session_start();
include_once '../dbconnect.php';

if (isset($_SESSION['usr_id'])) {
    
} else {
    header('Location: login.php');
}
?>
<?php
    //Functie voor het verwijderen van een medewerker
    if(isset($_POST['delete_employee'])&& (!empty($_POST)) && $_SERVER['REQUEST_METHOD'] == 'POST'){
				
    $employee_id = $_POST['employee_id'];
		
	//Verwijder de medewerker
	$sql = "DELETE FROM ccs_users WHERE id = $_POST[employee_id]";
	$result = mysqli_query($con, $sql);


	// success post with session.
	$_SESSION['notification'] = "<div class='alert alert-danger alert-dismissable' role='alert'>
	<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Medewerker succesvol verwijderd.</div>";
		header('Location: ../employees.php?delete_success=ok');
		
	}


	
?>
