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

if (in_array($user_role, array("5","2","1"))){
header('Location: script.php');
}else {
//er gebeurd niets wanneer de admin heeft ingelogd.	
};


//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['register'])) {
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
		$sub_account = "yes";
		$role = "5";
		$account_confirmed = "1";
		
		$demo_start_date = "0";
		$licence_start_date = "0";

		if(mysqli_query($con, "INSERT INTO ccs_users(name,surname,email,password,role,account_confirmed,demo_start_date,licence_start_date,sub_account,user_id) VALUES('" . $name . "', '" . $surname . "', '" . $email . "', '" . md5($password) . "', '" . $role . "', '" . $account_confirmed . "', '" . $demo_start_date . "', '" . $licence_start_date . "', '" . $sub_account . "', '" . $user_id . "')")) 
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
									<strong>Collega toevoegen</strong>
                                </div>
								</a>
                     
                                <div class="card-header card-header-icon" data-background-color="purple">
                                    <i class="material-icons">face</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Alle collega's</h4>
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>
								
                                    <div class="material-datatables">
											<!-- Alle foutmeldingen worden geprint in de alert box -->
											<?php if (isset($error_message)) { ?>
												<div class="alert alert-danger">
												 <button type="button" aria-hidden="true" class="close"><i class="material-icons">close</i></button>
													 <span>
														<?php if (isset($delete_colleague_success)) echo $delete_colleague_success; ?> 
													</span></div>
											<?php } ?>
										
										<!-- Succes melding wordt geprint in de alert box -->
											<?php if (isset($success_message)) { ?>
												<div class="alert alert-success">
												 <button type="button" aria-hidden="true" class="close"><i class="material-icons">close</i></button>
													 <span>
														<?php if (isset($add_colleague_success)) echo $add_colleague_success; ?> 
													</span></div>
											<?php } ?>
										
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
													$sql = "SELECT * FROM ccs_users WHERE sub_account = 'yes' AND user_id = '$user_id'";
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
<?php include 'page_includes/modals.php';?>
