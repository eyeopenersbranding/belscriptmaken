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

//Redirect de master admin wanneer hij op deze pagina beland
if ($user_role == $master_admin) {
    header('Location: ad-dashboard.php');
} else {
	
}


//======================================================================
// Verwijderen van een tab
//======================================================================


//Functie voor het verwijderen van een tab
if(isset($_POST['delete_tab'])&& (!empty($_POST)) && $_SERVER['REQUEST_METHOD'] == 'POST'){

$delete_tab_id = $_POST['delete_tab_id'];
$delete_previous = $_POST['delete_script_id']; 
$script_id = $_POST['delete_script_id'];
$tab_model = $_POST['tab_model']; 

$sql = "SELECT * FROM ccs_tabs WHERE tab_previous = '$delete_tab_id'";
$result = mysqli_query($con, $sql);

if($result -> num_rows >0){

	echo "kan niet verwijderen clennie";
	
}
	else {
		
			// success post with session.
			$_SESSION['deleted'] = "<div class='alert alert-danger alert-dismissable' role='alert'>
			<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Script item succesvol verwijderd.</div>";

			//Verwijder de medewerker
			$sql = "DELETE FROM ccs_tabs WHERE tab_id = $_POST[delete_tab_id]";
			$result = mysqli_query($con, $sql);
			
			if($delete_previous == "script-overview"){
				
				header('Location: script-overview.php');
			}
			
			if($tab_model == 1){
				
				 header('Location: script.php');
			}
			
		 }
}

?>
<?php   


//======================================================================
// Ophalen van de user_id om te bepalen welke knoppen er geladen mogen worden
//======================================================================

//Selecteer de role
$sql = "SELECT user_id,moderator_settings FROM ccs_users WHERE id = '$user_id'";
$result = mysqli_query($con, $sql);

while($row = $result->fetch_assoc()) {

//Variable van de gebruiker

$moderator_settings = $row['moderator_settings'];
$moderator_settings_active = "1";

} 

//Selecteer ID's van de tabs die getoond moeten worden op deze pagina
$script_id = $_POST["script_id"];

$error = false;	



//======================================================================
// Het ophalen van script gegevens voor deze pagina
//======================================================================
	
	
 
	$sql = "SELECT * FROM ccs_tabs WHERE tab_id = '$script_id'";
	$result = mysqli_query($con, $sql);

	if($result -> num_rows >0){
		
	while($row = $result->fetch_assoc()) { 
		
		$previous = $row['tab_previous']; 
	
	}

	$sql = "SELECT * FROM ccs_tabs WHERE tab_previous = '$script_id'";
	$result = mysqli_query($con, $sql);

	if($result -> num_rows >0){
		
		while($row = $result->fetch_assoc()) {

		$tab_link_id = $row['tab_previous'];

		}
	} 

	else {
		
		$error = true;
		$empty_tab_error = ($error_notification['empty_tab_error']);
		$error_message = ($error_notification['empty_tab_error']);
		
		//Geef een 0 ID uit wanneer er geen resultaat is gevonden.
		$tab_link_id = "0";
		$tab_link_id_button = "0";
	 
	}

}



 
?>

<?php include 'page_includes/header.php'; ?>
    <?php include 'page_includes/sidebar.php'; ?>
       <?php include 'page_includes/headbar.php'; ?>

				

            <div class="content">
					<?php if (isset($error_message)) { ?>
						<div class="alert alert-danger">
						 <button type="button" aria-hidden="true" class="close"><i class="material-icons">close</i></button>
							 <span>
								<?php if (isset($empty_tab_error)) echo $empty_tab_error;?>
							</span></div>
				<?php 
					//Bepalen of de moderate extensies geladen mogen worden. Dit kan alleen wanneer de roles Moderator of Admin actief is.
					if (in_array($user_role, array("4","3"))){

						if ($moderator_settings == $moderator_settings_active){

							echo"
							<a href='add-script.php?tab_id=$script_id&box_type=button'> 
							<button type='submit'  class='btn btn-primary btn-success'><i class='material-icons'>add</i>Vervolg toevoegen</button>
							</a>
							
							";
					
						}
						else{
						//echo niets wanneer er geen rechten zijn verleend.
						}
					}
												
			?>					

					<?php } ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
								<a href="script.php">
									   <div class="card-header card-header-icon" data-background-color="purple">
                                    <i class="material-icons">home</i>
                                </div>
								</a>
								

								    <div class='card-content'>	
									
									
									
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>

                                      <div class="row">
									<br /><br />
							
										  
								<?php if($previous == "0"){ ?>	
								<a href="script.php">
									<button class="btn btn-primary btn-lg"><i class="material-icons">arrow_back</i>terug<div class="ripple-container"></div></button>
								</a>
								
								<?php } else{ ?>	
								
	
									<form action='script-card.php' method='post' enctype='multipart/form-data'>
									<input type='hidden' name='script_id' value='<?php echo "$previous" ?>' />
									<input type='hidden' name='previous' value='home' />
										
										<button type="submit" class="btn btn-primary btn-lg"><i class="material-icons">arrow_back</i>terug<div class="ripple-container"></div></button>

									</form>
								
							
									<?php } ?>
										  
			<!-- Sessie notification laten zien -->
			<?php echo isset($_SESSION['deleted']) ? $_SESSION['deleted'] : " "; ?>
			<!-- Sessie notification leeg maken -->
			<?php unset($_SESSION['deleted']); ?>
			
											   
			<div class="row">	
			<?php 
				
			//======================================================================
			// Ophalen van alle tekst boxen voor dit account
			//======================================================================
				
			//Laten we alle teksten maar eens ophalen.
			$sql4 = "SELECT * FROM ccs_tabs WHERE tab_previous = $script_id AND tab_model = '2'";
			$result4 = mysqli_query($con, $sql4);

			if($result4 -> num_rows >0){

			while($row = $result4->fetch_assoc()) {

			  $tab_id4 = $row['tab_id'];
			  $tab_notes4 = $row['tab_notes'];
			  $tab_continuation4 = $row['tab_continuation'];
			  $show_continuation = "1";
				
				echo"<div class='col-lg-12'>";		
				//Bepalen of de moderate extensies geladen mogen worden. Dit kan alleen wanneer de roles Moderator of Admin actief is.
					if (in_array($user_role, array("4","3"))){

						if ($moderator_settings == $moderator_settings_active){
							echo"
						
							<form action='edit-script.php' method='post' enctype='multipart/form-data'>
									<input type='hidden' name='script_id' value='$tab_id4' />
									<input type='hidden' name='previous' value='$script_id' />
									<button type='submit' name='submit_edit_script' class='btn btn-round btn-warning btn-fab btn-fab-mini pull-right btn-space'><i class='material-icons'>mode_edit</i></button></button>
								</form>
							";
					
						}
						else{
						//echo niets wanneer er geen rechten zijn verleend.
						}
					}
				
					//Bepalen of de idee inzend knop geladen mag worden
						if (in_array($user_role, array("5"))){

		

							echo"
								<form action='idea-card.php' method='post' enctype='multipart/form-data'>
									<input type='hidden' name='script_id' value='$tab_id4' />
									<input type='hidden' name='previous' value='$script_id' />
									<button type='submit' name='submit_edit_script' class='btn btn-round btn-success btn-fab btn-fab-mini pull-right btn-space'><i class='material-icons'>lightbulb_outline</i></button></button>
								</form>
						
								";

							}
							else{
							//echo niets wanneer er geen rechten zijn verleend.
							}
					


				echo"
					<br />
					<br />
					<div class='card'>
						<div class='card-content'>
								<H3>
									$tab_notes4
								</H3>
							</div>
						</div>
					</div>
								
				";
				}

					}

						else {
							//Er gebeurd niets wanneer er geen resultaat is 

							}?>


			</div>	

							   


		<div class="row">				
		<?php
		//======================================================================
		// Ophalen van alle grote boxen voor dit account
		//======================================================================
					
		//selecteer alle gebruikers die toegang hebben tot de volledige website
		$sql3 = "SELECT * FROM ccs_tabs WHERE tab_previous = $script_id AND tab_model = '3'";
		$result3 = mysqli_query($con, $sql3);

		if($result3 -> num_rows >0){

		while($row = $result3->fetch_assoc()) {

			  $tab_id2 = $row['tab_id'];
			  $tab_title2 = $row['tab_title'];
			  $tab_notes2 = $row['tab_notes'];
			  $tab_continuation2 = $row['tab_continuation'];
			  $show_continuation = "1";


				echo"<div class='col-lg-6'>
				";
						
				//Bepalen of de moderate extensies geladen mogen worden. Dit kan alleen wanneer de roles Moderator of Admin actief is.
					if (in_array($user_role, array("4","3"))){

						if ($moderator_settings == $moderator_settings_active){

							echo"
							<a href='add-script.php?tab_id=$tab_id2&box_type=button'> <button type='submit' name='submit_script_item' class='btn btn-round btn-success btn-fab btn-fab-mini pull-right'><i class='material-icons'>add</i></button> </a>
							
							<form action='edit-script.php' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='script_id' value='$tab_id2' />
								<input type='hidden' name='previous' value='$script_id' />
								<button type='submit' name='submit_edit_script' class='btn btn-round btn-warning btn-fab btn-fab-mini pull-right btn-space'><i class='material-icons'>mode_edit</i></button></button>
							</form>
							
							";
						}
						else{
						//echo niets wanneer er geen rechten zijn verleend.
						}
					}
			
						//Bepalen of de idee inzend knop geladen mag worden
						if (in_array($user_role, array("5"))){

					

							echo"
								<form action='idea-card.php' method='post' enctype='multipart/form-data'>
									<input type='hidden' name='script_id' value='$tab_id2' />
									<input type='hidden' name='previous' value='$script_id' />
									<button type='submit' name='submit_edit_script' class='btn btn-round btn-success btn-fab btn-fab-mini pull-right btn-space'><i class='material-icons'>lightbulb_outline</i></button></button>
								</form>
						
								";

							}
							else{
							//echo niets wanneer er geen rechten zijn verleend.
							}
					


				echo"		
					<div class='card card-pricing card-raised'>
						<div class='content'>
							<h2>$tab_title2</h2>

							<br />
							<H3>
								$tab_notes2
							</H3>
					";

					if ($tab_continuation2 == $show_continuation){

							echo "
								<form action='script-card.php' method='post' enctype='multipart/form-data'>
									<input type='hidden' name='script_id' value='$tab_id2' />
									<input type='hidden' name='previous' value='$script_id' />
									<button type='submit' class='btn btn-primary btn-round'>Doorgaan</button>
								</form>
							
							
							";

							} else {//Niets laten zien wanneer de knop weggehaald moet worden 
							};


							echo "</div>	</div>
					</div>";
								}
							} 

						else {
							//Er gebeurd niets wanneer er geen resultaat is 

							}?>

				</div>	

					
								   
															   
		 <div class="row">	   
			<?php 
			//======================================================================
			// Ophalen van alle kleine boxjes voor dit account
			//======================================================================

			//selecteer alle gebruikers die toegang hebben tot de volledige website
			$sql2 = "SELECT * FROM ccs_tabs WHERE tab_previous = $script_id AND tab_model = '4'";
			$result2 = mysqli_query($con, $sql2);

			if($result2 -> num_rows >0){

			while($row = $result2->fetch_assoc()) {

				  $tab_id = $row['tab_id'];
				  $tab_title = $row['tab_title'];
				  $tab_notes = $row['tab_notes'];
				  $tab_continuation = $row['tab_continuation'];
				  $show_continuation = "1";

					echo"<div class='col-lg-3'>
	
					";
					//Bepalen of de moderate extensies geladen mogen worden. Dit kan alleen wanneer de roles Moderator of Admin actief is.
					if (in_array($user_role, array("4","3"))){

						if ($moderator_settings == $moderator_settings_active){

							echo"
							<a href='add-script.php?tab_id=$tab_id&box_type=button'> <button type='submit' name='submit_script_item' class='btn btn-round btn-success btn-fab btn-fab-mini pull-right'><i class='material-icons'>add</i></button> </a>	
							
							<form action='edit-script.php' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='script_id' value='$tab_id' />
								<input type='hidden' name='previous' value='$script_id' />
								<button type='submit' name='submit_edit_script' class='btn btn-round btn-warning btn-fab btn-fab-mini pull-right btn-space'><i class='material-icons'>mode_edit</i></button></button>
							</form>
						
							";
					
						}
						else{
						//echo niets wanneer er geen rechten zijn verleend.
						}
					}
				
						//Bepalen of de idee inzend knop geladen mag worden
						if (in_array($user_role, array("5"))){

						

							echo"
								<form action='idea-card.php' method='post' enctype='multipart/form-data'>
									<input type='hidden' name='script_id' value='$tab_id' />
									<input type='hidden' name='previous' value='$script_id' />
									<button type='submit' name='submit_edit_script' class='btn btn-round btn-success btn-fab btn-fab-mini pull-right btn-space'><i class='material-icons'>lightbulb_outline</i></button></button>
								</form>
						
								";

							}
							else{
							//echo niets wanneer er geen rechten zijn verleend.
							}
					


				echo"
					<div class='card card-pricing card-raised'>
						<div class='content'>
							<h2>$tab_title</h2>

							<br />
							<H3>
								$tab_notes
							</H3>
							";
				
						if ($tab_continuation == $show_continuation){

							echo "
								<form action='script-card.php' method='post' enctype='multipart/form-data'>
									<input type='hidden' name='script_id' value='$tab_id' />
									<input type='hidden' name='previous' value='$script_id' />
									<button type='submit' class='btn btn-primary btn-round'>Doorgaan</button>
								</form>
							
							";

							} else {//Niets laten zien wanneer de knop weggehaald moet worden 
							};


							echo "</div>	</div>
					</div>";
								}
							} 

						else {
							//Er gebeurd niets wanneer er geen resultaat is 

							}?>

				</div>						   
									   
											   
						
								   

			<div class="row">

			<div class='col-lg-3'>
			  <?php  
				
				//======================================================================
				// Ophalen van alle buttons voor dit account
				//======================================================================
				
				//selecteer alle gebruikers die toegang hebben tot de volledige website
				$sql1 = "SELECT * FROM ccs_tabs WHERE tab_id = $script_id AND tab_model = '5'";
				$result1 = mysqli_query($con, $sql1);
				
				if($result1 -> num_rows >0){

				while($row = $result1->fetch_assoc()) {

				   	  $tab_id1 = $row['tab_id'];
					  $tab_title1 = $row['tab_title'];
					  $tab_notes1 = $row['tab_notes'];
					  $tab_next1 = $row['tab_next'];
					  $tab_continuation1 = $row['tab_continuation'];
				
					echo"<hr>";
						//Bepalen of de moderate extensies geladen mogen worden. Dit kan alleen wanneer de roles Moderator of Admin actief is.
						if (in_array($user_role, array("4","3"))){

							if ($moderator_settings == $moderator_settings_active){

								echo"
								<a href='add-script.php?tab_id=$tab_id1&box_type=button'> <button type='submit' name='submit_script_item' class='btn btn-round btn-success btn-fab btn-fab-mini pull-right'><i class='material-icons'>add</i></button> </a>


								<form action='edit-script.php' method='post' enctype='multipart/form-data'>
									<input type='hidden' name='script_id' value='$tab_id1' />
									<input type='hidden' name='previous' value='$script_id' />
									<button type='submit' name='submit_edit_script' class='btn btn-round btn-warning btn-fab btn-fab-mini pull-right btn-space'><i class='material-icons'>mode_edit</i></button></button>
								</form>
								
						
								";

							}
							else{
							//echo niets wanneer er geen rechten zijn verleend.
							}
						}
					
						//Bepalen of de idee inzend knop geladen mag worden
						if (in_array($user_role, array("5"))){

					

							echo"
								<form action='idea-card.php' method='post' enctype='multipart/form-data'>
									<input type='hidden' name='script_id' value='$tab_id1' />
									<input type='hidden' name='previous' value='$script_id' />
									<button type='submit' name='submit_edit_script' class='btn btn-round btn-success btn-fab btn-fab-mini pull-right btn-space'><i class='material-icons'>lightbulb_outline</i></button></button>
								</form>
						
								";

							}
							else{
							//echo niets wanneer er geen rechten zijn verleend.
							}
						


						
						
						
						echo"
						<form action='script-card.php' method='post' enctype='multipart/form-data'>
							<input type='hidden' name='script_id' value='$tab_next1' />
							<input type='hidden' name='previous' value='$script_id' />
							<button type='submit' class='btn btn-primary'>$tab_title1</button>
						</form>


						";

						}

					} 

					else {
						//Er gebeurd niets wanneer er geen resultaat is 

						}?>			   

			   </div>	
			 </div>

			   
										
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
