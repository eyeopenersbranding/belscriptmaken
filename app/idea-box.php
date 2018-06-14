<?php
//======================================================================
// Is er een sessie actief? Zo nee log dan eerst even in
//======================================================================

$PageID = "Idee & aanvulbox"; 

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
// Ophalen van de user_id om te bepalen welke knoppen er geladen mogen worden
//======================================================================

//Selecteer de role
$sql = "SELECT * FROM ccs_users WHERE id = '$user_id'";
$result = mysqli_query($con, $sql);

while($row = $result->fetch_assoc()) {

//Variable van de gebruiker

$tab_account_id = $row['user_id'];

} 


//======================================================================
// Deze pagina is alleen bedoeld voor rechthebbende
//======================================================================

if (in_array($user_role, array("5","2","1"))){
header('Location: script.php');
}else {
//er gebeurd niets wanneer de admin heeft ingelogd.	
};



//======================================================================
// Verwijderen van een idee
//======================================================================


//Functie voor het verwijderen van een tab
if(isset($_POST['submit_delete_idea'])&& (!empty($_POST)) && $_SERVER['REQUEST_METHOD'] == 'POST'){

$ideas_id = $_POST['ideas_id'];


		
	
	$sql = "DELETE FROM ccs_ideas WHERE ideas_id = $ideas_id";
	$result = mysqli_query($con, $sql);
	
	if($result === TRUE){

//Succes melding printen
	$delete_idea_success = ($success_notification['delete_idea_success']);
	$success_message = ($success_notification['delete_idea_success']);


}
else {
	
	echo"Ernstige fout, kan niet verwijderen";

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
                                <div class="card-header card-header-icon" data-background-color="purple">
                                    <i class="material-icons">lightbulb_outline</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Ingezonden ideeën</h4>
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>

                                    <div class="material-datatables">
										
										<!-- Succes melding wordt geprint in de alert box -->
										<?php if (isset($success_message)) { ?>
											<div class="alert alert-danger">
											 <button type="button" aria-hidden="true" class="close"><i class="material-icons">close</i></button>
												 <span>
													<?php if (isset($delete_idea_success)) echo $delete_idea_success; ?> 
												</span></div>
										<?php } ?>
										
                                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Naam</th>
                                                    <th>Onderwerp</th>
                                                    <th>Ingezonden idee</th>
                                                    <th class="text-right">Aanpassen of verwijderen</th>
                                                </tr>
                                            </thead>

                                            <tbody>

											 <?php 
													//selecteer alle gebruikers die toegang hebben tot de volledige website
													$sql = "SELECT * FROM ccs_ideas WHERE ideas_account_id = '$tab_account_id'";
													$result = mysqli_query($con, $sql);
												
													if($result -> num_rows >0){

													while($row = $result->fetch_assoc()) {
														
														  $ideas_id = $row['ideas_id'];
														  $ideas_name = $row['ideas_name'];
														  $ideas_subject = $row['ideas_subject'];
														  $ideas_content = $row['ideas_content'];
														  $ideas_tab_id = $row['ideas_tab_id'];
														  $ideas_edit_tab_id = $row['ideas_edit_tab_id'];

												echo"
													<tr>
														<td>$ideas_name</td>
														<td>$ideas_subject</td>
														<td>$ideas_content</td>
														<td class='text-right'>
														
														<form action='idea-box.php' method='post' enctype='multipart/form-data'>
															<input type='hidden' name='ideas_id' value='$ideas_id' />
															<button type='submit' name='submit_delete_idea' class='btn btn-round btn-danger btn-fab btn-fab-mini pull-right btn-space'><i class='material-icons'>clear</i></button></button>
														</form>
														
														<form action='edit-script.php' method='post' enctype='multipart/form-data'>
															<input type='hidden' name='script_id' value='$ideas_edit_tab_id' />
															<input type='hidden' name='previous' value='home' />
															<button type='submit' name='submit_edit_script' class='btn btn-round btn-warning btn-fab btn-fab-mini pull-right btn-space'><i class='material-icons'>mode_edit</i></button></button>
														</form>
														
													
														</td>
													</tr>
											   ";		
															}
														} 

														else {
														   echo "  <div class='alert alert-warning alert-dismissable' role='alert'>
																	  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
																	  <i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Geen aanvullingen gevonden
																	</div>";
															}?>
                                            </tbody>
                                        </table>
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
