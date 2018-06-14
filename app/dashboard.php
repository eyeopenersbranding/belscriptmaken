<?php
//======================================================================
// Is er een sessie actief? Zo nee log dan eerst even in
//======================================================================

$PageID = "Dashboard"; 

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

if (in_array($user_role, array("6","5","2","1"))){
header('Location: script.php');
}else {
//er gebeurd niets wanneer de admin heeft ingelogd.	
};


//======================================================================
// Totaal aantal scripts uit de database halen voor deze admin
//======================================================================

//Aantal actieve gebruikers uit de database halen en tellen.
$sql = "SELECT tab_user_id FROM ccs_tabs WHERE tab_model = '1' AND tab_user_id = '$account_id'";
$result = mysqli_query($con, $sql);

if ($result)
	{
	 $count = array();
	
		foreach($result as $row)
			
		$count[] = $row['tab_user_id'];
			{
			$total_scripts = count($count);
			}
		} else{

	$total_scripts = "0";
}

//======================================================================
// Totaal aantal script items uit de database halen voor deze admin
//======================================================================

//Aantal actieve gebruikers uit de database halen en tellen.
$sql = "SELECT tab_user_id FROM ccs_tabs WHERE tab_user_id = '$account_id'";
$result = mysqli_query($con, $sql);

if ($result)
	{
	 $count = array();
	
		foreach($result as $row)
			
		$count[] = $row['tab_user_id'];
			{
			$total_script_items = count($count);
			}
		} else{

	$total_script_items = "0";
}

//======================================================================
// Totaal aantal collega's items uit de database halen voor deze admin
//======================================================================

//Aantal actieve gebruikers uit de database halen en tellen.
$sql = "SELECT id FROM ccs_users WHERE user_id = '$account_id'";
$result = mysqli_query($con, $sql);

if ($result)
	{
	 $count = array();
	
		foreach($result as $row)
			
		$count[] = $row['id'];
			{
			$colleagues = count($count);
			$een = "1";
			$colleagues = $colleagues - $een;  
			if($colleagues == -1){
				
			$colleagues = "0";
			}
			}
		} else{

	$colleagues = "0";
}


//======================================================================
// Totaal aantal ingezonden ideeen uit de database halen voor deze admin
//======================================================================

//Aantal actieve gebruikers uit de database halen en tellen.
$sql = "SELECT ideas_id FROM ccs_ideas WHERE ideas_account_id = '$account_id'";
$result = mysqli_query($con, $sql);

if ($result)
	{
	 $count = array();
	
		foreach($result as $row)
			
		$count[] = $row['ideas_id'];
			{
			$total_ideas = count($count);
			}
		} else{

	$total_ideas = "0";
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
                                    <i class="material-icons">dashboard</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Mijn dashboard</h4>
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>

                                      <div class="row">
                                          <div class="col-lg-3 col-md-6 col-sm-6">
                                              <div class="card card-stats">
                                                  <div class="card-header" data-background-color="purple">
                                                    <i class="material-icons">library_books</i>
                                                  </div>
                                                  <div class="card-content">
                                                      <p class="category">Scripts</p>
                                                      <h3 class="card-title"><?php echo "$total_scripts" ?></h3>
                                                  </div>
                                                  <div class="card-footer">
                                                      <div class="stats">
                                                          <i class="material-icons text-danger">face</i> Totaal aantal scripts
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6">
                                              <div class="card card-stats">
                                                  <div class="card-header" data-background-color="rose">
                                                     <i class="material-icons">view_headline</i>
                                                  </div>
                                                  <div class="card-content">
                                                      <p class="category">Script items</p>
                                                      <h3 class="card-title"><?php echo "$total_script_items"; ?></h3>
                                                  </div>
                                                  <div class="card-footer">
                                                      <div class="stats">
                                                          <i class="material-icons text-danger">business</i> Totaal aantal script items
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6">
                                              <div class="card card-stats">
                                                  <div class="card-header" data-background-color="orange">
                                                      <i class="material-icons">supervisor_account</i>
                                                  </div>
                                                  <div class="card-content">
                                                      <p class="category">Collega's</p>
                                                      <h3 class="card-title"><?php echo "$colleagues"; ?></h3>
                                                  </div>
                                                  <div class="card-footer">
                                                      <div class="stats">
                                                          <i class="material-icons text-danger">note</i> Totaal aantal collega's
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6">
                                              <div class="card card-stats">
                                                  <div class="card-header" data-background-color="blue">
                                                      <i class="material-icons">border_color</i>
                                                  </div>
                                                  <div class="card-content">
                                                      <p class="category">Aanvullingen</p>
                                                      <h3 class="card-title"><?php echo "$total_ideas"; ?></h3>
                                                  </div>
                                                  <div class="card-footer">
                                                      <div class="stats">
                                                          <i class="material-icons text-danger">library_books</i> Totaal ingezonden aanvullingen
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
									

                                </div>
                                <!-- end content-->
                            </div>
                            <!--  end card  -->
							
									<div class="col-lg-6 col-md-12">
										<div class="card">
											<div class="card-header card-header-text" data-background-color="orange">
												<h4 class="card-title"><i class="material-icons">group</i> Mijn callagents</h4>
											</div>
											<div class="card-content table-responsive">
												<table class="table table-hover">
													<thead class="text-warning">
														<th>Naam</th>
														<th>E-mail</th>
														<th></th>
													</thead>
													<tbody>
														<?php 
															//selecteer alle gebruikers die toegang hebben tot de volledige website
															$sql = "SELECT * FROM ccs_users WHERE sub_account = 'yes' AND user_id = '$account_id'";
															$result = mysqli_query($con, $sql);

															if($result -> num_rows >0){

															while($row = $result->fetch_assoc()) {

																  $id = $row['id'];
																  $name = $row['name'];
																  $surname = $row['surname'];
																  $email = $row['email'];

														echo"
															<tr>
																<td>";
																if($user_role == 4){
																	
																	echo"$name $surname";
																	
																} else {
																	
																echo"<a href='employee-card.php?employee_id=$id'>$name $surname</a>
															";	
																}
															
															echo"	
																
																</td>
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
																		  <i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Geen medewerkers gevonden
																		</div>";
															}?>

													</tbody>
												</table>
											</div>
										</div>
									</div>
							
							
							
							
							
							
								 <div class="col-md-6">
									<ul class="timeline timeline-simple">
										
										
										<?php 
											//selecteer alle gebruikers die toegang hebben tot de volledige website
											$sql = "SELECT * FROM ccs_ideas WHERE ideas_account_id = '$account_id' ORDER BY ideas_id DESC  LIMIT 3";
											$result = mysqli_query($con, $sql);

											if($result -> num_rows >0){

											while($row = $result->fetch_assoc()) {

												  $ideas_name = $row['ideas_name'];
												  $ideas_subject = $row['ideas_subject'];
												  $ideas_content = $row['ideas_content'];
	

										echo"
											<li class='timeline-inverted'>
												<div class='timeline-badge success'>
													<i class='material-icons'>mail</i>
												</div>
												<div class='timeline-panel'>
													<div class='timeline-heading'>
														<span class='label label-success'>$ideas_name</span>
													</div>
													<div class='timeline-body'>
														<strong>$ideas_subject</strong><br /><br />
														<p>$ideas_content</p>
														<br />
														<a href='idea-box.php'><button type='submit' class='btn btn-success btn-round'>Ga naar inbox</button></a>
													</div>
												</div>
											</li>
									   ";		
													}
											} 

											else {
											   echo "  
											 <li class='timeline-inverted'>
												<div class='timeline-badge success'>
													<i class='material-icons'>mail</i>
												</div>
												<div class='timeline-panel'>
													<div class='timeline-heading'>
														<span class='label label-success'>Het script is goed op orde zo te zien!</span>
													</div>
													<div class='timeline-body'>
														<strong>*Er zijn op dit moment nog geen aanvullingen ingezonden</strong><br /><br />
														
													</div>
												</div>
											</li>
														";
										}?>

										
										
										
									</ul>
								</div>
							
							
							
							
							
							
							
							
							
							
							
                        </div>
                        <!-- end col-md-12 -->
                    </div>
                    <!-- end row -->
                </div>
            </div>
<?php include 'page_includes/footer.php'; ?>
