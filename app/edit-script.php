<?php
//======================================================================
// Is er een sessie actief? Zo nee log dan eerst even in
//======================================================================

$PageID = "Script"; 

//Sessie starten om het inlogscript te activeren
session_start();

//Verbinding maken met de database
include_once 'dbconnect.php';

//Als sessie is gestart, ga lekker door en anders ga je naar het loginscherm!
if (isset($_SESSION['usr_id'])) {

} else {
	header('Location: login.php');
}

//Include de redirect core, de motor voor het omleiden van restrictie clashes
include 'page_includes/ikwil_redirect_core.php';


//======================================================================
// Deze pagina is alleen bedoeld voor rechthebbende
//======================================================================

if (in_array($user_role, array("5","2","1"))){
header('Location: script.php');
}else {
//er gebeurd niets wanneer de admin heeft ingelogd.	
};


$big_box = "4";
$small_box = "3";
$button = "5";
$text_box= "2";
$home_box = "1";



//======================================================================
// Engine voor het ophalen van de tab data
//======================================================================

$tab_id = $_POST['script_id'];
$previous = $_POST['previous'];

//selecteer de informatie van de tabs in de ccs_tabs
$sql = "SELECT * FROM ccs_tabs WHERE tab_id = '$tab_id'";
$result = mysqli_query($con, $sql);

while($row = $result->fetch_assoc()) {

	 //selecteer alle cellen die nodig zijn
	 $tab_model = $row['tab_model'];
	 $tab_title = $row['tab_title'];
	 $tab_notes = $row['tab_notes'];

	 $tab_continuation = $row['tab_continuation'];

}




//======================================================================
// Engine voor het wijzigen van een tab
//======================================================================


//Script activeren wanneer de submit knop wordt geactiveerd
if(isset($_POST['edit_tab'])&& (!empty($_POST)) && $_SERVER['REQUEST_METHOD'] == 'POST'){

	$error = false;

	//Alle variable opsommen en ontrekken van het formulier
	$tab_id = $_POST['tab_id'];
	$tab_title = $_POST['tab_title'];
	$tab_notes = $_POST['tab_notes'];
	$tab_model = $_POST['tab_model'];

	$previous = $_POST['previous'];



	//Check voor de tab titel
	if (empty($tab_title)) {
	$error = true;
	$user_company_name_error = ($error_notification['user_company_name_error']);
	$error_message = ($error_notification['user_company_name_error']);
	}


   
			

	//Als er geen error is ga dan door met het updaten van de gegevens
	if (!$error){

		
	
	$sql = "UPDATE ccs_tabs SET 

	tab_title = '$tab_title', 
	tab_notes = '$tab_notes' 

	WHERE tab_id = '$tab_id'";	
	$result = mysqli_query($con, $sql);

	if ($result === TRUE) 
	{	

			$update_user_success = ($success_notification['update_user_success']);
			$success_message = ($success_notification['update_user_success']);
		$home = "home";

	if ($previous == $home){
	// Redirect to the right URL  
	header("Location: script.php");
	}

	else { // niets

	};

	} 
	else 
	{
		echo "Oeps, er klopt iets niet";
	}	

}

}


?>



<?php include 'page_includes/header.php'; ?>
    <?php include 'page_includes/sidebar.php'; ?>
       <?php include 'page_includes/headbar.php'; ?>

		<div class="content">
			<div class="container-fluid">
				<!-- Succes melding wordt geprint in de alert box -->
					<?php if (isset($success_message)) { ?>
						<div class="alert alert-success">
						 <button type="button" aria-hidden="true" class="close"><i class="material-icons">close</i></button>
							 <span>
								<?php if (isset($update_user_success)) echo $update_user_success; ?> 
							</span></div>
					<?php } ?>

				

				<div class="col-md-8">
						<?php if($previous == "home"){ ?>	
								<a href="script.php">
									<button class="btn btn-primary btn-lg"><i class="material-icons">arrow_back</i>terug<div class="ripple-container"></div></button>
								</a>
					
						<?php } if($previous == "script-overview"){ ?>	
								<a href="script-overview.php">
									<button class="btn btn-primary btn-lg"><i class="material-icons">arrow_back</i>terug<div class="ripple-container"></div></button>
								</a>
								
								<?php } if(is_numeric($previous)){ ?>	
								
	
									<form action='script-card.php' method='post' enctype='multipart/form-data'>
									<input type='hidden' name='script_id' value='<?php echo "$previous" ?>' />
									<input type='hidden' name='previous' value='home' />
										
										<button type="submit" class="btn btn-primary btn-lg"><i class="material-icons">arrow_back</i>terug<div class="ripple-container"></div></button>

									</form>
								
							
								<?php } ?>
					
			
						<div class="card">
								<a href="script.php">
									<div class="card-header card-header-icon" data-background-color="purple">
										<i class="material-icons">mode_edit</i>
									</div>
								</a>
			
			
								<?php if ($tab_model == $button) { ?>
							
								<!-- Het begin van het venster voor het toevoegen van een button -->
		
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<i class="material-icons">clear</i>
									</button>
									<h4 class="modal-title">Nieuwe button toevoegen</h4>
								</div>
								<div class="modal-body">
									 <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
									 <div class="row">
										<label class="col-sm-2 label-on-left">Titel</label>
										<div class="col-sm-10">
											<div class="form-group label-floating is-empty">
												<label class="control-label"></label>
												<input type="hidden" name="tab_id" value="<?php echo $tab_id ?>" />
												<input type="hidden" name="previous" value="<?php echo $previous ?>" />
												<input type="hidden" name="script_id" value="<?php echo $script_id ?>" />
												<input type="hidden" name="tab_model" value="<?php echo $tab_model ?>" />
												<input type="hidden" name="tab_notes" value="" />
												<input type="text" name="tab_title" value="<?php echo "$tab_title"; ?>" class="form-control" required>
												<span class="help-block">A block of help text that breaks onto a new line.</span>
											</div>
										</div>
								</div>
 
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-tab"><i class="material-icons">clear</i> Verwijderen</button>
									<button type="submit" name="edit_tab" class="btn btn-warning"><i class="material-icons">mode_edit</i> Tab wijzigen</button>
									</form>
								</div>

								<!--  Einde venster voor het toevoegen van een button -->

		
								<?php } if ($tab_model == $small_box) {  ?>
							

								<!-- Het begin van het venster voor het toevoegen van een smallbox  -->
		
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<i class="material-icons">clear</i>
									</button>
									<h4 class="modal-title">Tab wijzigen</h4>
								</div>
								<div class="modal-body">
								 <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
								 <div class="row">
									<label class="col-sm-2 label-on-left">Titel</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input type="hidden" name="tab_id" value="<?php echo $tab_id ?>" />
											<input type="hidden" name="previous" value="<?php echo $previous ?>" />
											<input type="hidden" name="script_id" value="<?php echo $script_id ?>" />
											<input type="hidden" name="tab_model" value="<?php echo $tab_model ?>" />
											<input type="text" name="tab_title" value="<?php echo "$tab_title"; ?>" class="form-control" required>
											<span class="help-block">A block of help text that breaks onto a new line.</span>
										</div>
									</div>
								</div>

							   <div class="row">						
									<div class="col-sm-12">
										<div class="form-group">
											<textarea name="tab_notes"  class="form-control wysiwyg-editor" placeholder="Projectinhoud" rows="5" ><?php echo "$tab_notes"; ?></textarea>
											<i class="form-group__bar"></i>
										</div>
									</div>
								</div>
									

								</div>
								<div class="modal-footer">
								  	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-tab"><i class="material-icons">clear</i> Verwijderen</button>
									
									<button type="submit" name="edit_tab" class="btn btn-warning"><i class="material-icons">mode_edit</i> Tab wijzigen</button>
									</form>
								</div>

								<!--  Einde venster voor het toevoegen van een smallbox -->
							
							<?php } if ($tab_model == $big_box) {  ?>
							

								<!-- Het begin van het venster voor het toevoegen van een smallbox  -->
		
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<i class="material-icons">clear</i>
									</button>
									<h4 class="modal-title">Tab wijzigen</h4>
								</div>
								<div class="modal-body">
								 <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
								 <div class="row">
									<label class="col-sm-2 label-on-left">Titel</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input type="hidden" name="tab_id" value="<?php echo $tab_id ?>" />
											<input type="hidden" name="previous" value="<?php echo $previous ?>" />
											<input type="hidden" name="script_id" value="<?php echo $script_id ?>" />
											<input type="hidden" name="tab_model" value="<?php echo $tab_model ?>" />
											<input type="text" name="tab_title" value="<?php echo "$tab_title"; ?>" class="form-control" required>
											<span class="help-block">A block of help text that breaks onto a new line.</span>
										</div>
									</div>
								</div>

							   <div class="row">						
									<div class="col-sm-12">
										<div class="form-group">
											<textarea name="tab_notes"  class="form-control wysiwyg-editor" placeholder="Projectinhoud" rows="5" ><?php echo "$tab_notes"; ?></textarea>
											<i class="form-group__bar"></i>
										</div>
									</div>
								</div>
									

								</div>
								<div class="modal-footer">
								  	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-tab"><i class="material-icons">clear</i> Verwijderen</button>
									
									<button type="submit" name="edit_tab" class="btn btn-warning"><i class="material-icons">mode_edit</i> Tab wijzigen</button>
									</form>
								</div>

								<!--  Einde venster voor het toevoegen van een smallbox -->
							<?php } if ($tab_model == $home_box) {  ?>
							

								<!-- Het begin van het venster voor het toevoegen van een smallbox  -->
		
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<i class="material-icons">clear</i>
									</button>
									<h4 class="modal-title">Tab wijzigen</h4>
								</div>
								<div class="modal-body">
								 <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
								 <div class="row">
									<label class="col-sm-2 label-on-left">Titel</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input type="hidden" name="tab_id" value="<?php echo $tab_id ?>" />
											<input type="hidden" name="previous" value="<?php echo $previous ?>" />
											<input type="hidden" name="script_id" value="<?php echo $script_id ?>" />
											<input type="hidden" name="tab_model" value="<?php echo $tab_model ?>" />
											<input type="text" name="tab_title" value="<?php echo "$tab_title"; ?>" class="form-control" required>
											<span class="help-block">A block of help text that breaks onto a new line.</span>
										</div>
									</div>
								</div>

							   <div class="row">						
									<div class="col-sm-12">
										<div class="form-group">
											<textarea name="tab_notes"  class="form-control wysiwyg-editor" placeholder="Projectinhoud" rows="5" ><?php echo "$tab_notes"; ?></textarea>
											<i class="form-group__bar"></i>
										</div>
									</div>
								</div>
									

								</div>
								<div class="modal-footer">
								  	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-tab"><i class="material-icons">clear</i> Verwijderen</button>
									
									<button type="submit" name="edit_tab" class="btn btn-warning"><i class="material-icons">mode_edit</i> Tab wijzigen</button>
									</form>
								</div>

								<!--  Einde venster voor het toevoegen van een smallbox -->

								
								<?php } if ($tab_model == $text_box) {  ?>
							

								<!-- Het begin van het venster voor het toevoegen van een smallbox  -->
		
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<i class="material-icons">clear</i>
									</button>
									<h4 class="modal-title">Tab wijzigen</h4>
								</div>
								<div class="modal-body">
								 <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
								 <div class="row">
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input type="hidden" name="tab_id" value="<?php echo $tab_id ?>" />
											<input type="hidden" name="previous" value="<?php echo $previous ?>" />
											<input type="hidden" name="script_id" value="<?php echo $script_id ?>" />
											<input type="hidden" name="tab_model" value="<?php echo $tab_model ?>" />
											<input type="hidden" name="tab_title" value="nvt" class="form-control"/>
											<span class="help-block">A block of help text that breaks onto a new line.</span>
										</div>
									</div>
								</div>

							   <div class="row">						
									<div class="col-sm-12">
										<div class="form-group">
											<textarea name="tab_notes"  class="form-control wysiwyg-editor" placeholder="Projectinhoud" rows="5" ><?php echo "$tab_notes"; ?></textarea>
											<i class="form-group__bar"></i>
										</div>
									</div>
								</div>
									

								</div>
								<div class="modal-footer">
								  	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-tab"><i class="material-icons">clear</i> Verwijderen</button>
									
									<button type="submit" name="edit_tab" class="btn btn-warning"><i class="material-icons">mode_edit</i> Tab wijzigen</button>
									</form>
								</div>

								<!--  Einde venster voor het toevoegen van een smallbox -->

								<?php }?>
							

							
						</div>
					
				
								
					
					</div>

				
				
				
			</div>
		</div>

	<?php include 'page_includes/footer.php'; ?>

<?php include 'page_includes/modals.php'; ?>
