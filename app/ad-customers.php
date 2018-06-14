<?php
//======================================================================
// Is er een sessie actief? Zo nee log dan eerst even in
//======================================================================

$PageID = "Mijn klanten"; 

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




//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['register'])) {
	$role = mysqli_real_escape_string($con, $_POST['role']);
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$surname = mysqli_real_escape_string($con, $_POST['surname']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
	//name can contain only alpha characters and space
	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true;
		$name_error = "Name must contain only alphabets and space";
	}
	if (!preg_match("/^[a-zA-Z ]+$/",$surname)) {
		$error = true;
		$surname_error = "Name must contain only alphabets and space";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please Enter Valid Email ID";
	}
	if(strlen($password) < 6) {
		$error = true;
		$password_error = "Password must be minimum of 6 characters";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}
	if (!$error) {
		$sub_account = "";
		$account_confirmed = "1";
		$demo_start_date = "0";
		$email_token = "0";
		$status = "Actief";
		
		//Maak huidige datum aan
		setlocale(LC_ALL, 'nl_NL');
        $licence_start_date = date("j-m-Y");

		if(mysqli_query($con, "INSERT INTO ccs_users(name,surname,email,password,role,status,email_token,account_confirmed,demo_start_date,licence_start_date,sub_account,user_id) VALUES('" . $name . "', '" . $surname . "', '" . $email . "', '" . md5($password) . "', '" . $role . "', '" . $status . "', '" . $email_token . "', '" . $account_confirmed . "', '" . $demo_start_date . "', '" . $licence_start_date . "', '" . $sub_account . "', '" . $user_id . "')")) 
		{
			//Succes melding printen
			$add_colleague_success = ($success_notification['add_colleague_success']);
			$success_message = ($success_notification['add_colleague_success']);
			
		
		} else {
			$errormsg = "Error in registering...Please try again later!";
		}
	}
}

if(isset($_GET['delete_success'])) {
    $delete_success = $_GET['delete_success'];
} else {
    $delete_success = '';
}

if ($delete_success == "ok") { 
	
	//Succes melding printen
			$delete_colleague_success = ($error_notification['delete_colleague_success']);
			$error_message = ($error_notification['delete_colleague_success']);
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
								<a href="" data-toggle="modal" data-target="#modal-add-employee" > <div class="card-header card-header-icon" data-background-color="purple">
                                    <i class="material-icons">add_circle_outline</i>
									<strong>Klant toevoegen</strong>
                                </div>
								</a>
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
													$sql = "SELECT * FROM ccs_users WHERE NOT licence_start_date = '0'";
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



 <!-- Begin van de modal voor het toevoegen van een medewerker -->
		<div class="modal fade" id="modal-add-employee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="modal-title">Belscriptmaken.nl | klant toevoegen</h4>
					</div>
					<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
					<div class="modal-body">
						<div class="row">
						     <div class="col-lg-5 col-md-6 col-sm-3">
								<select name="role" class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
									<option disabled selected>Type pakket</option>
									<option value="4">Medium</option>
									<option value="3">Large</option>
								</select>
							</div>	
						</div>
						<br /><br />
						
						 <div class="row">
							<label class="col-sm-2 label-on-left">Voornaam</label>
							<div class="col-sm-10">
								<div class="form-group label-floating is-empty">
									<label class="control-label"></label>
									<input type="text" name="name" class="form-control" value>
									<span class="help-block">A block of help text that breaks onto a new line.</span>
								</div>
							</div>
						</div>
						<div class="row">
							<label class="col-sm-2 label-on-left">Achternaam</label>
							<div class="col-sm-10">
								<div class="form-group label-floating is-empty">
									<label class="control-label"></label>
									<input type="text" name="surname" class="form-control" value>
									<span class="help-block">A block of help text that breaks onto a new line.</span>
								</div>
							</div>
						</div>
						<div class="row">
							<label class="col-sm-2 label-on-left">E-mail</label>
							<div class="col-sm-10">
								<div class="form-group label-floating is-empty">
									<label class="control-label"></label>
									<input type="text" name="email" class="form-control" value>
									<span class="help-block">A block of help text that breaks onto a new line.</span>
								</div>
							</div>
						</div>
						
						<div class="row">
							<label class="col-sm-2 label-on-left">Password</label>
							<div class="col-sm-10">
								<div class="form-group label-floating is-empty">
									<label class="control-label"></label>
									<input type="password" name="password" class="form-control" value>
								</div>
							</div>
						</div>
						<div class="row">
							<label class="col-sm-2 label-on-left">Password</label>
							<div class="col-sm-10">
								<div class="form-group label-floating is-empty">
									<label class="control-label"></label>
									<input type="password" name="cpassword" class="form-control" value>
								</div>
							</div>
						</div>
						
						
				
					</div>
					<div class="modal-footer">
						<button type="submit" name="register" class="btn btn-primary"><i class="material-icons">add</i> Klant toevoegen</button>
					</div>
					</form>
				</div>
			</div>
		</div>
<!--  End Modal -->














<?php include 'page_includes/footer.php'; ?>
<script>
    $(document).ready(function() {
        demo.initCharts();
    });
</script>
