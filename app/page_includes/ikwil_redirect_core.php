<?php
require_once 'data_config.php';

//======================================================================
// Is er een sessie actief? Zo nee log dan eerst even in
//======================================================================

//Verbinding maken met de database
include_once 'dbconnect.php';

//Als sessie is gestart, ga lekker door en anders ga je naar het loginscherm!
if (isset($_SESSION['usr_id'])) {
 

//USER_ID uit de sessie halen
$user_id = $_SESSION['usr_id'];
	
	



//======================================================================
// Activatie redirect
//======================================================================

//Geen activatie = forceer naar activatie pagina
$sql = "SELECT * FROM ccs_users WHERE id = '$user_id'";
$result = mysqli_query($con, $sql);


while($row = $result->fetch_assoc()) {
	
	$account_confirmed = $row['account_confirmed'];
	$sub_account = $row['sub_account'];
	$account_id = $row['user_id'];
	$email = $row['email'];
	$account_confirmed_ok = "1";
	
	if ($account_confirmed == $account_confirmed_ok) {
  
	} else {

		header("Location: ../registration-successful/index.php?email=$email"); 
	die();	
	}
}
	
//======================================================================
// Nog geen setup doorlopen voor de gegevens? Ga naar de setup!
//======================================================================

$stop_account_loop = "account-setup";
$ignore_sub_account = "yes";
	
if ($PageID == $stop_account_loop) {
  
	} else {
			
			if($sub_account == $ignore_sub_account){
				
				
			}
			else{

			//Start demo wanneer er geen user_info regel aanwezig is.
			$sql = "SELECT * FROM ccs_user_info WHERE user_user_id = '$user_id'";
			$result = mysqli_query($con, $sql);

			if($result -> num_rows >0){

			while($row = $result->fetch_assoc()) {

			}

			} else {
			 header('Location: account-setup.php');	
			}
				
		}
	
	}
	

//======================================================================
// Account definieren om te bepalen welke extra's geladen mogen worden
//======================================================================

//Selecteer de role om vervolgens het account de categoriseren.
$sql = "SELECT role,demo_start_date FROM ccs_users WHERE id = '$user_id'";
$result = mysqli_query($con, $sql);

while($row = $result->fetch_assoc()) {
	
//Het recht van de gebruiker
$user_role = $row['role'];
	
//Startdatum van de demo ophalen
$demo_start_date = $row['demo_start_date'];
  
} 

//Negeer deze code wanneer de end-of-trial is geopend om een loop te voorkomen.
$define_launch_page = "end-of-trial";
	
if ($demo_start_date == 0){
	
	
}

	
	else {

				//======================================================================
				// Proefperiode bepaler
				//======================================================================

				//Bepalen van de einddatum van de proefperiode
				$demo_end_date_raw = date('j-m-Y', strtotime($demo_start_date. " + $set_trial_time days"));

				//======================================================================
				// Proefperiode verstreken? Dan moet je toch echt kopen!
				//======================================================================

				

				if ($PageID == $define_launch_page){ } else{

				//Maak huidige datum aan
				setlocale(LC_ALL, 'nl_NL');
				$date_today = strtotime(date("j-m-Y"));

				$demo_end_date=strtotime("$demo_end_date_raw");


				//Redirect wanneer de einddatum is geraakt
				if ($demo_end_date < $date_today ) 
				{ 
					header('Location: end-of-trial.php');	
				} 

	
		}	
	
	
}
	
	} else 
	
	{
		header('Location: login.php');
	}
?>