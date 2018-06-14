<?php
//======================================================================
// Is er een sessie actief? Zo nee log dan eerst even in
//======================================================================

$PageID = "Mijn leads"; 

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

if (in_array($user_role, array("6","5","4","3"))){
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
                                <div class="card-header card-header-icon" data-background-color="grey">
                                    <i class="material-icons">dashboard</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Administrator dashboard</h4>
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>
									<hr>
									<h2>Master admin dashboard</h2>
									<hr>

                                   <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
											<thead class="thead-default">
												<tr>
													<th>Naam</th>
													<th>E-mail</th>
													<th class="text-right">Actie</th>
												</tr>
											</thead>
											<tbody>
											<?php 
													//selecteer alle gebruikers die toegang hebben tot de volledige website
													$sql = "SELECT * FROM ccs_users WHERE NOT demo_start_date = '0'";
													$result = mysqli_query($con, $sql);
												
													if($result -> num_rows >0){

													while($row = $result->fetch_assoc()) {

														  $id = $row['id'];
														  $name = $row['name'];
														  $surname = $row['surname'];
														  $email = $row['email'];

												echo"
													<tr>
														<td><a href='employee-card.php?employee_id=$id'>$name $surname</a></td>
														<td>$email</td>
														<td class='text-right'>
														<i class='material-icons dp48'>face</i></i>
														</td>
													</tr>
											   ";		
															}
														} 

														else {
														   echo "  <div class='alert alert-warning alert-dismissable' role='alert'>
																	  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
																	  <i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Geen leads gevonden
																	</div>";
															}?>
											</tbody>
										</table>
									
							
										

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
<script>
    $(document).ready(function() {
        demo.initCharts();
    });
</script>
