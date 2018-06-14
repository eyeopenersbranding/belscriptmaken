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
	header('Location: ad-dashboard.php');
	}else {
	//er gebeurd niets wanneer de admin heeft ingelogd.	
	};

	//======================================================================
	// Ophalen van de gebruiker om te bepalen welke scriptreeks er geladen mag worden
	//======================================================================

	//Selecteer de role
	$sql = "SELECT user_id,moderator_settings FROM ccs_users WHERE id = '$user_id'";
	$result = mysqli_query($con, $sql);

	while($row = $result->fetch_assoc()) {

	//Variable van de gebruiker
	$script_user_id = $row['user_id'];
	$moderator_settings = $row['moderator_settings'];
	$moderator_settings_active = "1";

	} 


	//======================================================================
	// Engine voor het toevoegen van een nieuwe hoofdtegel
	//======================================================================


    //Script activeren wanneer de submit knop wordt geactiveerd
    if(isset($_POST['add_headtile'])&& (!empty($_POST)) && $_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$error = false;
		
		//Alle variable opsommen en ontrekken van het formulier
		$tab_title = $_POST['tab_title'];
		$tab_notes = $_POST['tab_notes'];
		$tab_model = "1";
		
		//Check voor de tab titel
		if (empty($tab_title)) {
		$error = true;
		$user_company_name_error = ($error_notification['user_company_name_error']);
		$error_message = ($error_notification['user_company_name_error']);
		}
	
		
		
		//Ververs pagina om de foutmelding te dumpen
		header("Refresh:1; url=profile-settings.php");
		
		//Als er geen error is ga dan door met het updaten van de gegevens
		if (!$error){
			
			$sql = "INSERT INTO ccs_tabs
			
			(
			tab_title, 
			tab_notes, 
			tab_model,
			tab_user_id
			) 
			VALUES (
			'$tab_title', 
			'$tab_notes',
			'$tab_model',
			'$script_user_id'
			)";	
			
			$result = mysqli_query($con, $sql);

			if ($result === TRUE) 
			{	
				//Succes melding printen
				$update_user_success = ($success_notification['update_user_success']);
				$success_message = ($success_notification['update_user_success']);
				
				 header("Location: script.php");
			} 
			else 
				
			{
				//Wanneer de data niet verwerkt kan worden in de database printen we een fatale fout
    			echo "Er is een ernstige fout opgetreden";
			}
		}
	}



?>
<?php include 'page_includes/header.php'; ?>
    <?php include 'page_includes/sidebar.php'; ?>
       <?php include 'page_includes/headbar.php'; ?>


            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
								<?php
								//Bepalen of de moderate extensies geladen mogen worden. Dit kan alleen wanneer de roles Moderator of Admin actief is.
								if (in_array($user_role, array("4","3"))){
		
									if ($moderator_settings == $moderator_settings_active){
									echo"
									<a href='' data-toggle='modal' data-target='#modal-add-headtile' > <div class='card-header card-header-icon' data-background-color='green'>
											<i class='material-icons'>add_circle_outline</i>
											<strong>Hoofdtegel toevoegen</strong>
										</div>
									</a>
									
									<a href='CCS_Engine/CCSModerator_settings.php?set=off'> <div class='card-header card-header-icon' data-background-color='red'>
											<i class='material-icons'>edit</i>
											<strong>Bewerk modus Uitschakelen</strong>
										</div>
									</a>";
									}
									else { 
										echo"
									
										<a href='CCS_Engine/CCSModerator_settings.php?set=on'> <div class='card-header card-header-icon' data-background-color='red'>
											<i class='material-icons'>edit</i>
											<strong>Bewerk modus inschakelen</strong>
										</div>
									</a>";
										
									}

								}
								else{
								//echo niets wanneer er geen rechten zijn verleend.
								}
								?>			
								
                                <div class="card-header card-header-icon" data-background-color="purple">
                                    <i class="material-icons">description</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Selecteer een item geschikt voor jouw situatie</h4>
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>

                                      <div class="row">
										<?php 
										//selecteer alle gebruikers die toegang hebben tot de volledige website
										$sql = "SELECT * FROM ccs_tabs WHERE tab_model = '1' AND tab_user_id = '$script_user_id'";
										$result = mysqli_query($con, $sql);

										if($result -> num_rows >0){

										while($row = $result->fetch_assoc()) {

										$tab_id = $row['tab_id'];
										$tab_next = $row['tab_next'];
										$tab_title = $row['tab_title'];
										$tab_notes = $row['tab_notes'];
											
	
										echo"<div class='col-lg-3'>";
											
										//Bepalen of de moderate extensies geladen mogen worden. Dit kan alleen wanneer de roles Moderator of Admin actief is.
										if (in_array($user_role, array("4","3"))){
											
											if ($moderator_settings == $moderator_settings_active){
										
											echo"
									
											
											<ul class='nav navbar-nav navbar-right'>
													<div class='col-md-12'>
														<a href='add-script.php?tab_id=$tab_id&box_type=button'> <button type='submit' name='submit_script_item' class='btn btn-round btn-success btn-fab btn-fab-mini pull-right'><i class='material-icons'>add</i></button> </a>
														Vervolg toevoegen&nbsp;&nbsp;
													</div>
												</ul>
												";

										}
										else{
										//echo niets wanneer er geen rechten zijn verleend.
										}
										}
											
										echo"

												<div class='card card-pricing card-raised'>
													<div class='content'>
														<h2>$tab_title</h2>
														<div class='icon icon-primary'>
															<i class='material-icons'>assignment</i>
														</div>
														<br />
														<p class='card-description'>
															$tab_notes
														</p>
														<form action='script-card.php' method='post' enctype='multipart/form-data'>
															<input type='hidden' name='script_id' value='$tab_next' />
															<input type='hidden' name='previous' value='home' />
															<button type='submit' class='btn btn-primary btn-round'>Doorgaan</button></button>
														</form>
				
													
													
											";
											
													
											//Bepalen of de moderate extensies geladen mogen worden. Dit kan alleen wanneer de roles Moderator of Admin actief is.
											if (in_array($user_role, array("4","3"))){
												
												if ($moderator_settings == $moderator_settings_active){
												echo"
													<form action='edit-script.php' method='post' enctype='multipart/form-data'>
														<input type='hidden' name='script_id' value='$tab_id' />
														<input type='hidden' name='previous' value='home' />
														<button type='submit' name='submit_edit_script' class='btn btn-warning'><i class='material-icons'>mode_edit</i> Wijzigen</button></button>
													</form>
												";

											}
											else{
											//echo niets wanneer er geen rechten zijn verleend.
											}
											}
				
											echo" </div> </div> </div>";		
													}
												} 

												else {
												   echo "  <div class='alert alert-warning alert-dismissable' role='alert'>
															  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
															  <i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Geen script gevonden
															</div>";
													}?>


											   
											   
											
											   
											
                                      </div>



                                </div>
                                <!-- end content-->
                            </div>
                            <!--  end card  -->
                        </div>
                        <!-- end col-md-12 -->
                    </div>
                    <!-- end row -->
                </div>
            </div>
<?php include 'page_includes/footer.php'; ?>
<?php include 'page_includes/modals.php';?>
