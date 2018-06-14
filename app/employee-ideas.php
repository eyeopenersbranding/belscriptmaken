<?php
//======================================================================
// Is er een sessie actief? Zo nee log dan eerst even in
//======================================================================

$PageID = "Mijn aanvullingen"; 

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

if (in_array($user_role, array("4","3","2","1"))){
header('Location: script.php');
}else {
//er gebeurd niets wanneer de admin heeft ingelogd.	
};

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
                                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Onderwerp</th>
                                                    <th>Mijn idee</th>
                                                    <th class="text-right">Script item bekijken</th>
                                                </tr>
                                            </thead>

                                            <tbody>

											 <?php 
													//selecteer alle gebruikers die toegang hebben tot de volledige website
													$sql = "SELECT * FROM ccs_ideas WHERE ideas_account_id = '$tab_account_id'";
													$result = mysqli_query($con, $sql);
												
													if($result -> num_rows >0){

													while($row = $result->fetch_assoc()) {

														  $ideas_subject = $row['ideas_subject'];
														  $ideas_content = $row['ideas_content'];
														  $ideas_tab_id = $row['ideas_tab_id'];

												echo"
													<tr>
														<td>$ideas_subject</td>
														<td>$ideas_content</td>
														<td class='text-right'>
															<form action='script-card.php' method='post' enctype='multipart/form-data'>
																<input type='hidden' name='script_id' value='$ideas_tab_id' />
																<button type='submit' class='btn btn-primary btn-round btn-fab btn-fab-mini'><i class='material-icons'>forward</i></button>
															</form>
														</td>
													</tr>
											   ";		
															}
														} 

														else {
														   echo "  <div class='alert alert-warning alert-dismissable' role='alert'>
																	  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
																	  <i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Geen medewerkers gevonden
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
