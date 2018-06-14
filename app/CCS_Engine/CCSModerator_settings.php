<?php
session_start();
include_once '../dbconnect.php';

if (isset($_SESSION['usr_id'])) {
    
} else {
    header('Location: login.php');
}
//User_id uit de sessie halen
$user_id = $_SESSION['usr_id'];

$activate_moderator = "on";

	$moderator_settings = $_GET['set'];


	//======================================================================
	// Engine voor het aanpassen van de moderator zichtbaarheid
	//======================================================================
	
	
    //Script activeren wanneer de submit knop wordt geactiveerd
    if($moderator_settings == $activate_moderator){
	
	//Alle variable opsommen en ontrekken van het formulier
	$on = "1";
		
	$sql = "UPDATE ccs_users SET moderator_settings = '$on' WHERE id = $user_id";	
	$result = mysqli_query($con, $sql);
		
	}
   else{
	   
	 //Alle variable opsommen en ontrekken van het formulier
	$off = "0";
		
	$sql = "UPDATE ccs_users SET moderator_settings = '$off' WHERE id = $user_id";	
	$result = mysqli_query($con, $sql);  
	   
   }

header('Location: ../script.php');

?>
	
		




