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

if (in_array($user_role, array("2","1"))){
header('Location: script.php');
}else {
//er gebeurd niets wanneer de admin heeft ingelogd.	
};



//======================================================================
// Engine voor het ophalen van de tab data
//======================================================================

$tab_id = $_POST['script_id'];
$previous = $_POST['previous'];





//======================================================================
// Engine voor het toevoegen van het idee
//======================================================================


//Script activeren wanneer de submit knop wordt geactiveerd
if(isset($_POST['send_idea'])&& (!empty($_POST)) && $_SERVER['REQUEST_METHOD'] == 'POST'){

	$error = false;

	//Alle variable opsommen en ontrekken van het formulier
	$tab_id = $_POST['tab_id'];
	$idea_title = $_POST['idea_title'];
	$idea_notes = $_POST['idea_notes'];
	$employee_name = $_SESSION['usr_name']; 

	//Check voor de tab titel
	if (empty($idea_title)) {
	$error = true;
	$user_company_name_error = ($error_notification['user_company_name_error']);
	$error_message = ($error_notification['user_company_name_error']);
	}


	//Als er geen error is ga dan door met het updaten van de gegevens
	if (!$error){

	$sql = "INSERT INTO ccs_ideas
	(
	ideas_name,
	ideas_subject, 
	ideas_content,
	ideas_tab_id,
	ideas_edit_tab_id,
	ideas_account_id,
	ideas_user_id
		
	) 
	VALUES (
	'$employee_name',
	'$idea_title', 
	'$idea_notes',
	'$previous',
	'$tab_id',
	'$account_id',
	'$user_id'
	)";	

	$result = mysqli_query($con, $sql);

	if ($result === TRUE) 
	{	

			$idea_send_successful = ($success_notification['idea_send_successful']);
			$success_message = ($success_notification['idea_send_successful']);
		$home = "home";

	if ($previous == $home){
	// Redirect to the right URL  
	header("Location: script.php");
	}

	else {

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
								<?php if (isset($idea_send_successful)) echo $idea_send_successful; ?> 
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
					
						<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
						<div class="card">
                                <a href="script.php">
									<div class="card-header card-header-icon" data-background-color="purple">
										<i class="material-icons">lightbulb_outline</i> Idee inzenden
									</div>
								</a>
								 <br /><br />
                                    <div class="card-content">
                                        <div class="row">
                                     
                                            <div class="col-sm-6">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    	<input type="text" name="idea_title" value="" class="form-control" placeholder="Onderwerp" required>
					
                                                    <span class="help-block">A block of help text that breaks onto a new line.</span>
                                                </div>
                                            </div>
                                        </div>
										<input type="hidden" name="tab_id" value="<?php echo $tab_id ?>" />
														<input type="hidden" name="previous" value="<?php echo $previous ?>" />
														<input type="hidden" name="script_id" value="<?php echo $tab_id ?>" />
										 <div class="row">						
											<div class="col-sm-12">
												<div class="form-group">
													<textarea name="idea_notes"  class="form-control wysiwyg-editor" placeholder="Vertel, wat voor meesterlijke aanvulling of idee heb je ?" rows="5" ></textarea>
													<i class="form-group__bar"></i>
												</div>
											</div>
										</div>
										<button type="submit" name="send_idea" class="btn btn-success"><i class="material-icons">lightbulb_outline</i> Idee inzenden</button>
			
                                       
                                    </div>
							
								 </div>
                                </form>
							
							

							

					
				
							
					
					</div>

				
				
				
			</div>
		</div>

	<?php include 'page_includes/footer.php'; ?>

<?php include 'page_includes/modals.php'; ?>
