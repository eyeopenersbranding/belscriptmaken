<?php
session_start();
include_once '../dbconnect.php';

if (isset($_SESSION['usr_id'])) {
    
} else {
    header('Location: login.php');
}

//======================================================================
// Ophalen van de gebruiker id om te bepalen van wie alle script items zijn
//======================================================================

//USER_ID uit de sessie halen
$user_id = $_SESSION['usr_id'];

//Selecteer de role
$sql = "SELECT * FROM ccs_users WHERE id = '$user_id'";
$result = mysqli_query($con, $sql);

while($row = $result->fetch_assoc()) {

//Variable van de gebruiker

$account_id = $row['user_id'];


} 

//======================================================================
// Engine voor het toevoegen van een nieuwe button
//======================================================================


//Script activeren wanneer de submit knop wordt geactiveerd
if(isset($_POST['add_button'])&& (!empty($_POST)) && $_SERVER['REQUEST_METHOD'] == 'POST'){
	$box_type = "0";
	$error = false;

	//Alle variable opsommen en ontrekken van het formulier
	$button_title = $_POST['button_title'];
	$tab_id = $_POST['tab_id'];
	$tab_model = "5";

	//Check voor de tab titel
	if (empty($button_title)) {
	$error = true;

	}
	//Ververs pagina om de foutmelding te dumpen
	header("Refresh:1; url=add-script.php?box_type=button");

	//Als er geen error is ga dan door met het updaten van de gegevens
	if (!$error){

	$sql = "INSERT INTO ccs_tabs
	(
	tab_title, 
	tab_model,
	tab_previous,
	tab_user_id
	) 
	VALUES (
	'$button_title', 
	'$tab_model',
	'$tab_id',
	'$account_id'
	)";	

	$result = mysqli_query($con, $sql);
	$tab_next = mysqli_insert_id($con);
	
	$sql = "UPDATE ccs_tabs SET 
			
	tab_next = '$tab_next'
	
	WHERE tab_id = '$tab_id'";	
		
	$result = mysqli_query($con, $sql);

	if ($result === TRUE){
		
		// success post with session.
		  $_SESSION['script_item_added'] = "<div class='alert alert-success alert-dismissable' role='alert'>
			<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Script item succesvol aangemaakt.</div>";

			header("Location: ../add-script.php?tab_id=$tab_id&box_type=button&add_script=success");

	} 
	else 

	{
		//Wanneer de data niet verwerkt kan worden in de database printen we een fatale fout
		echo "Er is een ernstige fout opgetreden";
	}
		

		}
		
	
		}




//======================================================================
// Engine voor het toevoegen van een kleine box
//======================================================================

//Script activeren wanneer de submit knop wordt geactiveerd
if(isset($_POST['add_smallbox'])&& (!empty($_POST)) && $_SERVER['REQUEST_METHOD'] == 'POST'){

$error = false;

//Alle variable opsommen en ontrekken van het formulier
$button_title = $_POST['tab_title'];
$tab_id = $_POST['tab_id'];
$tab_notes = $_POST['tab_notes'];
$tab_model = "4";
$tab_continuation = $_POST['tab_continuation'];


//Check voor de tab titel
if (empty($button_title)) {
// success post with session.
              $_SESSION['script_item_added'] = "<div class='alert alert-success alert-dismissable' role='alert'>
				<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> errorretje</div>";
			 
				header("Location: ../add-script.php?tab_id=$tab_id&box_type=button");
}

//Ververs pagina om de foutmelding te dumpen
header("Refresh:1; url=add-script.php");

//Als er geen error is ga dan door met het updaten van de gegevens
if (!$error){

$sql = "INSERT INTO ccs_tabs

(
tab_title, 
tab_model,
tab_notes,
tab_continuation,
tab_previous,
tab_user_id
) 
VALUES (
'$button_title', 
'$tab_model',
'$tab_notes',
'$tab_continuation',
'$tab_id',
'$account_id'
)";	

$result = mysqli_query($con, $sql);
$tab_next = mysqli_insert_id($con);
	
	$sql = "UPDATE ccs_tabs SET 
			
	tab_next = '$tab_next'
	
	WHERE tab_id = '$tab_id'";	
		
	$result = mysqli_query($con, $sql);
	
	if ($result === TRUE){
		
			// success post with session.
		  $_SESSION['script_item_added'] = "<div class='alert alert-success alert-dismissable' role='alert'>
			<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Script item succesvol aangemaakt.</div>";

			header("Location: ../add-script.php?tab_id=$tab_id&box_type=button&add_script=success");
	} 
	else 

	{
		//Wanneer de data niet verwerkt kan worden in de database printen we een fatale fout
		echo "Er is een ernstige fout opgetreden";
	}

		}

	
		}



//======================================================================
// Engine voor het toevoegen van een grote box
//======================================================================


    //Script activeren wanneer de submit knop wordt geactiveerd
    if(isset($_POST['add_bigbox'])&& (!empty($_POST)) && $_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$error = false;
		
		//Alle variable opsommen en ontrekken van het formulier
		$button_title = $_POST['tab_title'];
		$tab_id = $_POST['tab_id'];
		$tab_notes = $_POST['tab_notes'];
		$tab_model = "3";
		$tab_continuation = $_POST['tab_continuation'];
	
		
		//Check voor de tab titel
		if (empty($button_title)) {
		$error = true;
		$user_company_name_error = ($error_notification['user_company_name_error']);
		$error_message = ($error_notification['user_company_name_error']);
		}
	
		
		
		//Ververs pagina om de foutmelding te dumpen
		header("Refresh:1; url=add-script.php");
		
		//Als er geen error is ga dan door met het updaten van de gegevens
		if (!$error){
			
		$sql = "INSERT INTO ccs_tabs

		(
		tab_title, 
		tab_model,
		tab_notes,
		tab_continuation,
		tab_previous,
		tab_user_id
		) 
		VALUES (
		'$button_title', 
		'$tab_model',
		'$tab_notes',
		'$tab_continuation',
		'$tab_id',
		'$account_id'
		)";	

		$result = mysqli_query($con, $sql);
		$tab_next = mysqli_insert_id($con);
	
		$sql = "UPDATE ccs_tabs SET 

		tab_next = '$tab_next'

		WHERE tab_id = '$tab_id'";	

		$result = mysqli_query($con, $sql);
			
		if ($result === TRUE){
			
			// success post with session.
			  $_SESSION['script_item_added'] = "<div class='alert alert-success alert-dismissable' role='alert'>
				<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Script item succesvol aangemaakt.</div>";

				header("Location: ../add-script.php?tab_id=$tab_id&box_type=button&add_script=success");
		} 
		else 

		{
			//Wanneer de data niet verwerkt kan worden in de database printen we een fatale fout
			echo "Er is een ernstige fout opgetreden";
		}

			}

			
			}











//======================================================================
	// Engine voor het toevoegen van een text box
	//======================================================================


    //Script activeren wanneer de submit knop wordt geactiveerd
    if(isset($_POST['add_text_box'])&& (!empty($_POST)) && $_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$error = false;
		
		//Alle variable opsommen en ontrekken van het formulier
		$tab_id = $_POST['tab_id'];
		$tab_notes = $_POST['tab_notes'];
		$tab_model = "2";
		$tab_continuation = $_POST['tab_continuation'];


		
		
		//Ververs pagina om de foutmelding te dumpen
		header("Refresh:1; url=add-script.php");
		
		//Als er geen error is ga dan door met het updaten van de gegevens
		if (!$error){
			
			$sql = "INSERT INTO ccs_tabs
			
			(
			tab_model,
			tab_notes,
			tab_continuation,
			tab_previous,
			tab_user_id
			) 
			VALUES (
			'$tab_model',
			'$tab_notes',
			'$tab_continuation',
			'$tab_id',
			'$account_id'
			)";	
			
		$result = mysqli_query($con, $sql);
		$tab_next = mysqli_insert_id($con);
	
		$sql = "UPDATE ccs_tabs SET 

		tab_next = '$tab_next'

		WHERE tab_id = '$tab_id'";	

		$result = mysqli_query($con, $sql);
			
		if ($result === TRUE){
			
				// success post with session.
			  $_SESSION['script_item_added'] = "<div class='alert alert-success alert-dismissable' role='alert'>
				<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Script item succesvol aangemaakt.</div>";

				header("Location: ../add-script.php?tab_id=$tab_id&box_type=button&add_script=success");
		} 
		else 

		{
			//Wanneer de data niet verwerkt kan worden in de database printen we een fatale fout
			echo "Er is een ernstige fout opgetreden";
		}

			}

		
			}



?>
