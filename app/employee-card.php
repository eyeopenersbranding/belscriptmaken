<?php
//======================================================================
// Is er een sessie actief? Zo nee log dan eerst even in
//======================================================================

$PageID = "Callagents"; 

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

if (in_array($user_role, array("5","4","2","1"))){
header('Location: script.php');
}else {
//er gebeurd niets wanneer de admin heeft ingelogd.	
};


?>
<?php                         
	//Selecteer de medewerker waarvan het ID is doorgegeven.
	$employee_id = $_GET["employee_id"];
	$sql = "SELECT * FROM ccs_users WHERE id = '$employee_id' AND user_id = '$user_id'";
	$result = mysqli_query($con, $sql);

	if($result -> num_rows >0){
		
		while($row = $result->fetch_assoc()) {

			 $id = $row['id'];
			 $role = $row['role'];
			 $name = $row['name'];
			 $surname = $row['surname'];
			 $email = $row['email'];

		}
	} 

	else {
		
		//Laat de code doodbloeden wanneer het id niet is gevonden of niet matched met de aanmaker.
	    die();
}	
?>
<?php
    //Come to action when submit button is activated.
    if(isset($_POST['update_employee_data'])&& (!empty($_POST)) && $_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$error = false;
		
		//Alle variable opsommen en ontrekken van het formulier
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];
		if(isset($_POST['moderator'])) {
		$role = "4";
		$moderator_settings = "0";
		} else { 
    	$role = "5";
		$moderator_settings = "0";
		};

		//Check voor de voornaam
		if (empty($name)) {
		$error = true;
		$name_error = ($error_notification['name_error']);
		$error_message = ($error_notification['name_error']);
		}
		
		//Check voor de achternaam
		if (empty($surname)) {
		$error = true;
		$surname_error = ($error_notification['surname_error']);
		$error_message = ($error_notification['surname_error']);
		}
		
		//Check voor de achternaam
		if (empty($email)) {
		$error = true;
		$email_error = ($error_notification['email_error']);
		$error_message = ($error_notification['email_error']);
		}
		
		header("Refresh:1; url=employee-card.php?employee_id=$employee_id");

		if (!$error){


		$sql = "UPDATE ccs_users SET name = '$name', role = '$role', surname = '$surname', email = '$email', moderator_settings = '$moderator_settings' WHERE id = '$id'";	
		$result = mysqli_query($con, $sql);

		if ($result === TRUE) 
		{	

				$update_user_success = ($success_notification['update_user_success']);
				$success_message = ($success_notification['update_user_success']);
			
		} 
		else 
		{
			echo "Oeps, er klopt iets niet";
		}
	}
}

	if (isset($_POST['update_password'])) {
		
		$error = false;

		$password = mysqli_real_escape_string($con, $_POST['password']);
		$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

		//name can contain only alpha characters and space
		if(strlen($password) < 6) {
		$error = true;
		$password_error = ($error_notification['password_error']);
		$error_message = ($error_notification['password_error']);
		}
		
		if($password != $cpassword) {
		$error = true;
		$cpassword_error = ($error_notification['cpassword_error']);
		$error_message = ($error_notification['cpassword_error']);
		}
		
		header("Refresh:1; url=employee-card.php?employee_id=$employee_id");
		
		if (!$error) {

			$sql = "UPDATE ccs_users SET password = '". md5 ($password)."' WHERE id = $id";	
			$result = mysqli_query($con, $sql);
				
				$update_user_success = ($success_notification['update_user_success']);
				$success_message = ($success_notification['update_user_success']);
			
				header("Refresh:1; url=employee-card.php?employee_id=$employee_id");
				
			}
		}
?>


<?php include 'page_includes/header.php'; ?>
    <?php include 'page_includes/sidebar.php'; ?>
       <?php include 'page_includes/headbar.php'; ?>

		<div class="content">
			<div class="container-fluid">

				<div class="col-md-8">
						<div class="card">
							<a href="employees.php">
								<div class="card-header card-header-icon" data-background-color="purple">
									<i class="material-icons">arrow_back</i>
								</div>
							</a>
							<div class="card-header card-header-icon" data-background-color="purple">
								<i class="material-icons">face</i>
							</div>
							<div class="card-header">
								<ul class="nav navbar-nav navbar-right">
                                    <div class="col-md-12">

                                      <button type="button" class="btn btn-round btn-danger btn-fab btn-fab-mini pull-right" data-toggle="modal" data-target="#modal-delete-employee"><i class="material-icons">clear</i></button>

                                    </div>
                                  </ul>
								<h4 class="card-title"><?php echo "$name $surname"; ?>
									<small class="category">| Gegevens medewerker</small>
								</h4>
							</div>
							<div class="card-content">
								
							<?php if (isset($error_message)) { ?>
								<div class="alert alert-danger">
								 <button type="button" aria-hidden="true" class="close"><i class="material-icons">close</i></button>
									 <span>
										<?php if (isset($name_error)) echo $name_error; ?>
										<?php if (isset($surname_error)) echo $surname_error; ?>
										<?php if (isset($email_error)) echo $email_error; ?>
										 
										<?php if (isset($password_error)) echo $password_error; ?>
										<?php if (isset($cpassword_error)) echo $cpassword_error; ?>
								
									</span></div>
							<?php } ?>
								
							<?php if (isset($success_message)) { ?>
								<div class="alert alert-success">
								 <button type="button" aria-hidden="true" class="close"><i class="material-icons">close</i></button>
									 <span>
										<?php if (isset($update_user_success)) echo $update_user_success; ?> 
									</span></div>
							<?php } ?>
								
								<div class="row">
									<div class="col-md-4">
										<ul class="nav nav-pills nav-pills-icons nav-pills-purple nav-stacked" role="tablist">

											<li class="active">
												<a href="#dashboard-2" role="tab" data-toggle="tab">
													<i class="material-icons">subject</i> Gegevens medewerker
												</a>
											</li>
											<li>
												<a href="#schedule-2" role="tab" data-toggle="tab">
													<i class="material-icons">trending_up</i> Statistieken
												</a>
											</li>
										</ul>
									</div>
									<div class="col-md-8">
										<div class="tab-content">
											<div class="tab-pane active" id="dashboard-2">

												<!-- Formulier voor de gegevens van de medewerker -->
												<hr>
												<form role="form" action="employee-card.php?employee_id=<?php echo "$employee_id"; ?>" method="post" name="updateform">
												<div class="row">
													<label class="col-sm-2 label-on-left">Voornaam</label>
													<div class="col-sm-10">
														<div class="form-group label-floating is-empty <?php if (isset($name_error)) { echo "has-error" ;} ?>">
															<label class="control-label"></label>
															<input type="text" name="name" class="form-control" value="<?php echo "$name"; ?>">
															<span class="help-block">A block of help text that breaks onto a new line.</span>
														</div>
													</div>
												</div>
												<div class="row">
													<label class="col-sm-2 label-on-left">Achternaam</label>
													<div class="col-sm-10">
														<div class="form-group label-floating is-empty <?php if (isset($surname_error)) { echo "has-error" ;} ?>">
															<label class="control-label"></label>
															<input type="text" name="surname" class="form-control" value="<?php echo "$surname"; ?>">
															<span class="help-block">A block of help text that breaks onto a new line.</span>
														</div>
													</div>
												</div>
												<div class="row">
													<label class="col-sm-2 label-on-left">E-mail</label>
													<div class="col-sm-10">
														<div class="form-group label-floating is-empty <?php if (isset($email_error)) { echo "has-error" ;} ?>">
															<label class="control-label"></label>
															<input type="text" name="email" class="form-control" value="<?php echo "$email"; ?>">
															<span class="help-block">A block of help text that breaks onto a new line.</span>
														</div>
													</div>
												</div>
												<div class="row">
													 <div class="col-md-8">
														<br />
														<br />
														<div class="togglebutton">
															<label>
																<input type="checkbox" name="moderator" value="4" <?php if ($role =="4") echo "checked"; ?>> Mag <?php echo "$name" ?> het script aanpassen?
															</label>
														</div>
													</div>
												</div>
												<br />
												<button type="submit" name="update_employee_data" class="btn btn-primary"><i class="material-icons">done</i> Gegevens updaten</button>
												</form>
												<br />										
												<br />
												<hr>
												<form role="form" action="employee-card.php?employee_id=<?php echo "$employee_id"; ?>" method="post" name="updateform">
												<input type="hidden" name="id" value="<?php echo $id ?>" />
												<div class="row">
													<label class="col-sm-2 label-on-left">Wachtwoord</label>
													<div class="col-sm-10">
														<div class="form-group label-floating is-empty <?php if (isset($password_error)) { echo "has-error" ;} ?>">
															<label class="control-label"></label>
															<input type="password" name="password" class="form-control" value = "12345678";>
														</div>
													</div>
												</div>
												<div class="row">
													<label class="col-sm-2 label-on-left">Wachtwoord controle</label>
													<div class="col-sm-10">
														<div class="form-group label-floating is-empty <?php if (isset($password_error)) { echo "has-error" ;} ?>">
															<label class="control-label"></label>
															<input type="password" name="cpassword" class="form-control" value = "12345678";>
														</div>
													</div>
												</div>
												<!-- Einde formulier -->

												<button type="submit" name="update password" class="btn btn-danger"><i class="material-icons">lock</i> Wachtwoord Updaten</button><br /><br />
												</form>
											</div>
											<div class="tab-pane" id="schedule-2">
												Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas.
												<br />
												<br /> Dramatically maintain clicks-and-mortar solutions without functional solutions. Dramatically visualize customer directed convergence without revolutionary ROI. Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

			</div>
		</div>

	<?php include 'page_includes/footer.php'; ?>

<?php include 'page_includes/modals.php'; ?>
