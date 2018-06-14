<?php
if (isset($_GET["tab_id"]))  
    {
$tab_id = $_GET["tab_id"]; 
    }else{
        $tab_id = "0";
   }

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

$big_box = "bigbox";
$small_box = "smallbox";
$button = "button";
$text_box= "textbox";






//======================================================================
// Ophalen van de previous tab
//======================================================================


	if (isset($_GET["tab_id"]))  
    {
$tab_id = $_GET["tab_id"]; 
    }else{
        $tab_id = "0";
     }


	//Selecteer de role
	$sql = "SELECT * FROM ccs_tabs WHERE tab_id = '$tab_id'";
	$result = mysqli_query($con, $sql);

	while($row = $result->fetch_assoc()) {


	$previous = $row['tab_previous'];

	} 







if(isset($_GET['box_type'])) {
    $box_type = $_GET["box_type"];
} else {
    $box_type = '';
}


if(isset($_GET['add_script'])) {
    $add_script = $_GET['add_script'];
} else {
    $add_script  = '';
}

if ($add_script == "success") { 
	
	//Succes melding printen
			$add_script_item_success = ($success_notification['add_script_item_success']);
			$success_message = ($success_notification['add_script_item_success']);
}
?>


<?php include 'page_includes/header.php'; ?>
    <?php include 'page_includes/sidebar.php'; ?>
       <?php include 'page_includes/headbar.php'; ?>

		<div class="content">
			<div class="container-fluid">
				

				<div class="col-md-8">
					
		
					
					<!-- Succes melding wordt geprint in de alert box -->
					<?php if (isset($success_message)) { ?>
						<div class="alert alert-success">
						 <button type="button" aria-hidden="true" class="close"><i class="material-icons">close</i></button>
							 <span>
								<?php if (isset($add_script_item_success)) echo $add_script_item_success; ?> 
							</span></div>
					<?php } ?>
	

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
					
					
						
					
								<a href="add-link.php?tab_id=<?php echo $tab_id ?>&box_type=button">
									<button class="btn btn-warning btn-lg"><i class="material-icons">link</i> Maak een koppeling<div class="ripple-container"></div></button>
								</a>
						<hr>
						<div class="card">
							
				
								<?php if ($box_type == $button) { ?>
							
								<!-- Het begin van het venster voor het toevoegen van een button -->
		
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<i class="material-icons">clear</i>
									</button>
									<h4 class="modal-title">Nieuwe button toevoegen</h4>
								</div>
								<div class="modal-body">
									 <form role="form" action="CCS_Engine/CCSAdd_tab.php" method="post" name="signupform">
									 <div class="row">
										<label class="col-sm-2 label-on-left">Titel</label>
										<div class="col-sm-10">
											<div class="form-group label-floating is-empty">
												<label class="control-label"></label>
												<input type='hidden' name='tab_id' value='<?php $tab_id = $_GET['tab_id']; echo $tab_id ?>' />
												<input type="text" name="button_title" class="form-control" required>
												<span class="help-block">A block of help text that breaks onto a new line.</span>
											</div>
										</div>
								</div>

								</div>
								<div class="modal-footer">
									<button type="submit" name="add_button" class="btn btn-primary"><i class="material-icons">add</i> Button toevoegen</button>
									</form>
								</div>
							
							

								<!--  Einde venster voor het toevoegen van een button -->

		
								<?php } if ($box_type == $small_box) { ?>
							

								<!-- Het begin van het venster voor het toevoegen van een smallbox  -->
		
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<i class="material-icons">clear</i>
									</button>
									<h4 class="modal-title">Kleine box toevoegen</h4>
								</div>
								<div class="modal-body">
								 <form role="form" action="CCS_Engine/CCSAdd_tab.php" method="post" name="signupform">
								 <div class="row">
									<label class="col-sm-2 label-on-left">Titel</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input type='hidden' name='tab_id' value='<?php $tab_id = $_GET['tab_id']; echo $tab_id ?>' />
											<input type="text" name="tab_title" class="form-control" required>
											<span class="help-block">A block of help text that breaks onto a new line.</span>
										</div>
									</div>
								</div>

							   <div class="row">						
									<div class="col-sm-12">
										<div class="form-group">
											<textarea name="tab_notes" class="form-control wysiwyg-editor" placeholder="Projectinhoud" rows="5" ></textarea>
											<i class="form-group__bar"></i>
										</div>
									</div>
								</div>
									 
							   <div class="radio">
									<label>
										<input type="radio" name="tab_continuation" checked="true" value="1"> Vervolgknop toevoegen
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="tab_continuation" value="0"> Vervolgknop weglaten
									</label>
								</div>

								</div>
								<div class="modal-footer">
									<button type="submit" name="add_smallbox" class="btn btn-primary"><i class="material-icons">add</i> Kleine box toevoegen</button>
									</form>
								</div>

								<!--  Einde venster voor het toevoegen van een smallbox -->

								<?php } if ($box_type == $big_box) { ?>
							
								<!-- Het begin van het venster voor het toevoegen van een Bigbox  -->
		
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<i class="material-icons">clear</i>
									</button>
									<h4 class="modal-title">Grote box toevoegen</h4>
								</div>
								<div class="modal-body">
								 <form role="form" action="CCS_Engine/CCSAdd_tab.php" method="post" name="signupform">
								 <div class="row">
									<label class="col-sm-2 label-on-left">Titel</label>
									<div class="col-sm-10">
										<div class="form-group label-floating is-empty">
											<label class="control-label"></label>
											<input type='hidden' name='tab_id' value='<?php $tab_id = $_GET['tab_id']; echo $tab_id ?>' />
											<input type="text" name="tab_title" class="form-control" required>
											<span class="help-block">A block of help text that breaks onto a new line.</span>
										</div>
									</div>
								</div>

							   <div class="row">						
									<div class="col-sm-12">
										<div class="form-group">
											<textarea name="tab_notes" class="form-control wysiwyg-editor" placeholder="Projectinhoud" rows="5" ></textarea>
											<i class="form-group__bar"></i>
										</div>
									</div>
								</div>
									 
								<div class="radio">
									<label>
										<input type="radio" name="tab_continuation" checked="true" value="1"> Vervolgknop toevoegen
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="tab_continuation" value="0"> Vervolgknop weglaten
									</label>
								</div>

								</div>
								<div class="modal-footer">
									<button type="submit" name="add_bigbox" class="btn btn-primary"><i class="material-icons">add</i> Grote box toevoegen</button>
									</form>
								</div>

								<!--  Einde venster voor het toevoegen van een Bigbox -->

							
								<?php } if ($box_type == $text_box) { ?>
							
								<!-- Het begin van het venster voor het toevoegen van een Bigbox  -->
		
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<i class="material-icons">clear</i>
									</button>
									<h4 class="modal-title">Tekst toevoegen</h4>
								</div>
								<div class="modal-body">
								 <form role="form" action="CCS_Engine/CCSAdd_tab.php" method="post" name="signupform">
								 <input type='hidden' name='tab_id' value='<?php $tab_id = $_GET['tab_id']; echo $tab_id ?>' />
								
							   <div class="row">						
									<div class="col-sm-12">
										<div class="form-group">
											<textarea name="tab_notes" class="form-control wysiwyg-editor" placeholder="Projectinhoud" rows="5" ></textarea>
											<i class="form-group__bar"></i>
										</div>
									</div>
								</div>

								</div>
									
									
								<input type="hidden" name="tab_continuation" value="0" />
									
								<div class="modal-footer">
									<button type="submit" name="add_text_box" class="btn btn-primary"><i class="material-icons">add</i> Tekst toevoegen</button>
									</form>
								</div>

								<!--  Einde venster voor het toevoegen van een Bigbox -->

								<?php } ?>

							
						</div>
					
					<h2>Maak een keuze:</h2>
			
					
						<a href='add-script.php?tab_id=<?php echo "$tab_id" ?>&box_type=button'><button type="submit"  class="btn btn-primary"> Button aanmaken</button></a>
					
						<br />
				
						<div class="col-lg-4">
								<div class="card card-pricing card-raised">
									<div class="content">
										<h2>Kleine box</h2>

										<br />
										<p class="card-description">
											Eventuele aanvullende teksten die hier geplaatst kunnen worden.
										</p>
										<a href='add-script.php?tab_id=<?php echo "$tab_id" ?>&box_type=smallbox
												 '><button type="submit"  class="btn btn-primary"> Kleine box aanmaken</button></a>
									</div>
								</div>
						   </div>
			
					
				
			
					   <div class="col-lg-6">
							<div class="card card-pricing card-raised">
								<div class="content">
									<h2>Grote box</h2>

									<br />
									<p class="card-description">
										Eventuele aanvullende teksten die hier geplaatst kunnen worden.
									</p>
									<a href='add-script.php?tab_id=<?php echo "$tab_id" ?>&box_type=bigbox'><button type="submit"  class="btn btn-primary">Grote box aanmaken</button></a>
								</div>
							</div>
					   </div>
					
					
				
						
						
				
						<div class="col-lg-7">
								<div class="content">
									<h2>Tekst</h2>

									<br />
									<p class="card-description">
										Het is al geruime tijd een bekend gegeven dat een lezer, tijdens het bekijken van de layout van een pagina, afgeleid wordt door de tekstuele inhoud. Het belangrijke punt van het gebruik van Lorem Ipsum is dat het uit een min of meer normale verdeling van letters bestaat, in tegenstelling tot "Hier uw tekst, hier uw tekst" wat het tot min of meer leesbaar nederlands maakt.
									</p>
									<a href='add-script.php?tab_id=<?php echo "$tab_id" ?>&box_type=textbox'><button type="submit"  class="btn btn-primary">Tekst aanmaken</button></a>
								</div>
					   </div>
		

					
					
					
					
							

							
					
					
								
					
					</div>

				
				
				
			</div>
		</div>

	<?php include 'page_includes/footer.php'; ?>

<?php include 'page_includes/modals.php'; ?>
