<?php
//======================================================================
// Is er een sessie actief? Zo nee log dan eerst even in
//======================================================================

$PageID = "Script overzicht"; 

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
                                    <i class="material-icons">subject</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Script overzicht</h4>
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>
									 <form action="script-overview.php" method="POST">
										<input type="text" name="search" />
										<input type="submit" value="Search" />
									</form>
									<?php


$output='';
if(isset($_POST['search'])){
    $searchkey= $_POST['search'];
    $searchkey=preg_replace("#[^0-9a-z]#i", "", $searchkey);

    $query = mysqli_query($con,"SELECT * FROM ccs_tabs WHERE tab_title LIKE '%$searchkey%' OR tab_notes LIKE '%$searchkey%'") or die("Could not search!");
    $count = mysqli_num_rows($query);

    if($count == 0){
        $output="There was no search result!";
    }
    else{
        while($row=mysqli_fetch_array($query)){
            $tab_title=$row['tab_title'];
            $tab_notes=$row['tab_notes'];

            $output .='<div>'.$tab_title.''.$tab_notes.'</div>';

            echo "<h2>$output</h2>";

        }
    }
}
?>

                                    <div class="material-datatables">
                                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Naam</th>
                                                    <th>Onderwerp</th>
                                                    <th>Script item</th>
                                                    <th class="text-right">Actie</th>
                                                </tr>
                                            </thead>

                                            <tbody>

											 <?php 
													//selecteer alle gebruikers die toegang hebben tot de volledige website
													$sql = "SELECT * FROM ccs_tabs WHERE tab_user_id = '$tab_account_id'";
													$result = mysqli_query($con, $sql);
												
													if($result -> num_rows >0){

													while($row = $result->fetch_assoc()) {

														  $tab_title = $row['tab_title'];
														  $tab_notes = $row['tab_notes'];
														  $tab_id = $row['tab_id'];
												

												echo"
													<tr>
														<td>$tab_title</td>
														<td>$tab_title</td>
														<td>$tab_notes</td>
														<td class='text-right'>
														
														<form action='edit-script.php' method='post' enctype='multipart/form-data'>
															<input type='hidden' name='script_id' value='$tab_id' />
															<input type='hidden' name='previous' value='script-overview' />
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
