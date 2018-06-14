<?php
//======================================================================
// Is er een sessie actief? Zo nee log dan eerst even in
//======================================================================

$PageID = "Instellingen"; 

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


include 'page_includes/data_config.php';

//======================================================================
// Deze pagina is alleen bedoeld voor rechthebbende
//======================================================================

if (in_array($user_role, array("5","2"))){
header('Location: script.php');
}else {
//er gebeurd niets wanneer de admin heeft ingelogd.	
};

	

?>
<?php 

	//======================================================================
	// Engine voor het ophalen van de gebruikersgegevens
	//======================================================================

	//selecteer de informatie van de gebruiker in de ccs_user_info
	$sql = "SELECT * FROM ccs_user_info WHERE user_user_id = '$user_id'";
	$result = mysqli_query($con, $sql);

	while($row = $result->fetch_assoc()) {
		
		 //selecteer alle cellen die nodig zijn
		 $user_company_name = $row['user_company_name'];
		 $user_address = $row['user_address'];
		 $user_city = $row['user_city'];
		 $user_zipcode = $row['user_zipcode'];
		 $user_telephone = $row['user_telephone'];
		 $user_btw = $row['user_btw'];
		 $user_kvk = $row['user_kvk'];
}

	//selecteer basis account gegevens uit de ccs_users tabel
	$sql = "SELECT * FROM ccs_users WHERE id = '$user_id'";
	$result = mysqli_query($con, $sql);

	while($row = $result->fetch_assoc()) {
		
		 //selecteer alle cellen die nodig zijn
		 $name = $row['name'];
		 $surname = $row['surname'];
		 $email = $row['email'];
		 $password = $row['password'];
}

	//======================================================================
	// Engine voor het updaten van de profiel gegevens
	//======================================================================

    //Script activeren wanneer de submit knop wordt geactiveerd
    if(isset($_POST['submit_basic_info'])&& (!empty($_POST)) && $_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$error = false;
		
		//Alle variable opsommen en ontrekken van het formulier
		$user_company_name = $_POST['user_company_name'];
		$user_address = $_POST['user_address'];
		$user_zipcode = $_POST['user_zipcode'];
		$user_city = $_POST['user_city'];
		$user_telephone = $_POST['user_telephone'];
		$email = $_POST['email'];
		$user_btw = $_POST['user_btw'];
		$user_kvk = $_POST['user_kvk'];
		$user_id = $_POST['user_user_id'];
		
		//Check voor de bedrijfsnaam
		if (empty($user_company_name)) {
		$error = true;
		$user_company_name_error = ($error_notification['user_company_name_error']);
		$error_message = ($error_notification['user_company_name_error']);
		}
		
		//Check voor het adres
		if (empty($user_address)) {
		$error = true;
		$user_address_error = ($error_notification['user_address_error']);
		$error_message = ($error_notification['user_address_error']);
		}
		
		//Check voor de postcode
		if (empty($user_zipcode)) {
		$error = true;
		$user_zipcode_error = ($error_notification['user_zipcode_error']);
		$error_message = ($error_notification['user_zipcode_error']);
		}
		
		//Check voor de plaats
		if (empty($user_city)) {
		$error = true;
		$user_city_error = ($error_notification['user_city_error']);
		$error_message = ($error_notification['user_city_error']);
		}
		
		//Check voor het telefoonnummer
		if (empty($user_telephone)) {
		$error = true;
		$user_telephone_error = ($error_notification['user_telephone_error']);
		$error_message = ($error_notification['user_telephone_error']);
		}
		
		//Check voor het e-mail adres
		if (empty($email)) {
		$error = true;
		$user_email_error = ($error_notification['user_email_error']);
		$error_message = ($error_notification['user_email_error']);
		}
		
		//Ververs pagina om de foutmelding te dumpen
		header("Refresh:1; url=profile-settings.php");
		
		//Als er geen error is ga dan door met het updaten van de gegevens
		if (!$error){
			
			$sql = "UPDATE ccs_user_info SET 
			
			user_company_name = '$user_company_name', 
			user_address = '$user_address', 
			user_zipcode = '$user_zipcode', 
			user_city = '$user_city', 
			user_telephone = '$user_telephone', 
			user_btw = '$user_btw', 
			user_kvk = '$user_kvk' 
			
			WHERE user_user_id = '$user_id'";	
			$result = mysqli_query($con, $sql);
			
			$sql_email = "UPDATE ccs_users SET email = '$email' WHERE id = $user_id";	
			$result = mysqli_query($con, $sql_email);

			if ($result === TRUE) 
			{	
				//Succes melding printen
				$update_user_success = ($success_notification['update_user_success']);
				$success_message = ($success_notification['update_user_success']);
			} 
			else 
				
			{
				//Wanneer de data niet verwerkt kan worden in de database printen we een fatale fout
    			echo "Er is een ernstige fout opgetreden";
			}
		}
	}

	//======================================================================
	// Engine voor het updaten van het wachtwoord
	//======================================================================


 	if (isset($_POST['update_password'])) {
		
		$error = false;
		
		//Wanneer het huidige wachtwoord verkeerd wordt getypt, geef melding.
		$old_password = mysqli_real_escape_string($con, $_POST['old_password']);
		$result = mysqli_query($con, "SELECT * FROM ccs_users WHERE id = '" . $user_id. "' and password = '" . md5($old_password) . "'");
		
		if ($row = mysqli_fetch_array($result)) {
			
			//Alle variable opsommen en ontrekken van het formulier
			$password = mysqli_real_escape_string($con, $_POST['password']);
			$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
			$email = $_POST['email'];

			//Controleren of er tenminste 6 karakters gebruikt zijn voor het wachtwoord
			if(strlen($password) < 6) {
				$error = true;
				$user_password_error = ($error_notification['user_password_error']);
				$error_message = ($error_notification['user_password_error']);
			}
			
			//Controleren of de wachtwoorden exact overeen komen
			if($password != $cpassword) {
				$error = true;
				$user_cpassword_error = ($error_notification['user_cpassword_error']);
				$error_message = ($error_notification['user_cpassword_error']);
			}
			if (!$error) {

			$sql = "UPDATE ccs_users SET password = '". md5 ($password)."' WHERE id = $user_id";	
			$result = mysqli_query($con, $sql);
				
			//Succes melding printen
			$update_user_success = ($success_notification['update_user_success']);
			$success_message = ($success_notification['update_user_success']);
				
			}
		}
			
		else{
		
		$user_false_password_error = ($error_notification['user_false_password_error']);
		$error_message = ($error_notification['user_false_password_error']);
			
		}
		
	}
?>
<!-- Includes voor de pagina -->
<?php include 'page_includes/header.php'; ?>
    <?php include 'page_includes/sidebar.php'; ?>
       <?php include 'page_includes/headbar.php'; ?>

            <div class="content">
                <div class="container-fluid">


	<!-- Related Cases  -->
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="nav-center">
				<ul class="nav nav-pills nav-pills-primary nav-pills-icons" role="tablist">
					<li class="active">
						<a href="#profile" role="tab" data-toggle="tab">
							<i class="material-icons">settings</i> Profiel instellingen
						</a>
					</li>
					<li>
						<a href="#account" role="tab" data-toggle="tab">
							<i class="material-icons">lock</i> Wachtwoord wijzigen
						</a>
					</li>
				</ul>
		   </div>

	<div class="tab-content">
	

	<!-- Alle foutmeldingen worden geprint in de alert box -->
	<?php if (isset($error_message)) { ?>
		<div class="alert alert-danger">
         <button type="button" aria-hidden="true" class="close"><i class="material-icons">close</i></button>
             <span>
				<?php if (isset($user_company_name_error)) echo $user_company_name_error; ?> 
				<?php if (isset($user_address_error)) echo $user_address_error; ?>
				<?php if (isset($user_zipcode_error)) echo $user_zipcode_error; ?>
				<?php if (isset($user_city_error)) echo $user_city_error; ?>
				<?php if (isset($user_telephone_error)) echo $user_telephone_error; ?>
				<?php if (isset($user_email_error)) echo $user_email_error; ?>
				 
				<?php if (isset($user_false_password_error)) echo $user_false_password_error; ?>
				<?php if (isset($user_password_error)) echo $user_password_error; ?>
				<?php if (isset($user_cpassword_error)) echo $user_cpassword_error; ?>
			</span></div>
	<?php } ?>
	
	<!-- Succes melding wordt geprint in de alert box -->
	<?php if (isset($success_message)) { ?>
		<div class="alert alert-success">
         <button type="button" aria-hidden="true" class="close"><i class="material-icons">close</i></button>
             <span>
				<?php if (isset($update_user_success)) echo $update_user_success; ?> 
			</span></div>
	<?php } ?>
	
	
	
	
	
  <div class="tab-pane active" id="profile"> 
    <div class="card">
        <div class="card-header card-header-icon" data-background-color="purple">
            <i class="material-icons">settings</i>
        </div>
        <div class="card-content">
                      <h4 class="card-title">
                          <h4 class="card-title">Profiel instellingen</h4>
                      </h4>
                      <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="updateform">
                      <input type="hidden" name="user_user_id" value="<?php echo "$user_id" ?>" />
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating <?php if (isset($user_company_name_error)) { echo "has-error" ;} ?>">
                                        <label class="control-label">Naam bedrijf*</label>
                                        <input type="text" name="user_company_name" class="form-control" value="<?php echo "$user_company_name"; ?>">
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating <?php if (isset($user_address_error)) { echo "has-error" ;} ?>">
                                        <label class="control-label">Straat + Huisnummer</label>
                                        <input type="text" name="user_address" class="form-control" value="<?php echo "$user_address"; ?>">
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating <?php if (isset($user_zipcode_error)) { echo "has-error" ;} ?>">
                                        <label class="control-label">Postcode</label>
                                        <input type="text" name="user_zipcode" class="form-control" value="<?php echo "$user_zipcode"; ?>">
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating <?php if (isset($user_city_error)) { echo "has-error" ;} ?>">
                                        <label class="control-label">Plaats</label>
                                        <input type="text" name="user_city" class="form-control" value="<?php echo "$user_city"; ?>">
                                    </div>
                                </div>
                              </div>

                              <br /><br />

                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating <?php if (isset($user_telephone_error)) { echo "has-error" ;} ?>">
                                        <label class="control-label">Telefoonnummer</label>
                                        <input type="text" name="user_telephone" class="form-control" value="<?php echo "$user_telephone"; ?>">
                                    </div>
                                </div>
                              </div>
                              
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating" <?php if (isset($user_email_error)) { echo "has-error" ;} ?>>
                                        <label class="control-label">E-mail</label>
                                        <input type="text" name="email" class="form-control" value="<?php echo "$email"; ?>">
                                    </div>
                                </div>
                              </div>

                              <br /><br />

                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">BTW-nummer</label>
                                        <input type="text" name="user_btw" class="form-control" value="<?php echo "$user_btw"; ?>">
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">KVK-nummer</label>
                                        <input type="text" name="user_kvk" class="form-control" value="<?php echo "$user_kvk"; ?>">
                                    </div>
                                </div>
                              </div>
						  
	
                          <button type="submit" name="submit_basic_info" class="btn btn-primary pull-right">Update Klantkaart</button>
                          <div class="clearfix"></div>
                      </form>
                  </div>
              </div>
          </div>




  <div class="tab-pane" id="account">
    <div class="card">
      <div class="card-header card-header-icon" data-background-color="purple">
          <i class="material-icons">lock</i>
      </div>
      <div class="card-content">
        <div class="card-header">
            <h4 class="card-title">Wachtwoord wijzigen</h4>
        </div>


            <fieldset>
                <!-- Password input-->
				<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="updateform">
					<div class="control-group form-group <?php if (isset($user_false_password_error)) { echo "has-error" ;} ?>">
						<label class="control-label col-lg-4" for="old_password">
							Oud wachtwoord*
						</label>
						<div class="controls col-lg-8">
							<input id="old_password" name="old_password" type="password" class="input-xlarge form-control">
						</div>
					</div>

					<!-- Password input-->
					<div class="control-group form-group <?php if (isset($user_password_error)) { echo "has-error" ;} ?>">
						<label class="control-label col-lg-4" for="new_password">
							Nieuw wachtwoord*
						</label>
						<div class="controls col-lg-8">
							<input id="new_password" name="password" type="password" class="input-xlarge form-control">
						</div>
					</div>

					<!-- Password input-->
					<div class="control-group form-group <?php if (isset($user_password_error)) { echo "has-error" ;} ?>">
						<label class="control-label col-lg-4" for="new_password_confirm">
							Herhaal nieuw wachtwoord*
						</label>
						<div class="controls col-lg-8">
							<input id="new_password_confirm" name="cpassword"
								   type="password" class="input-xlarge form-control">
						</div>
					</div>

					<!-- Button -->
					<div class="control-group form-group">
						<label class="control-label col-lg-4" for="change_password"></label>
						<div class="controls col-lg-8">
							<button type="submit"  name="update_password" class="btn btn-primary">
							  <i class="material-icons">lock</i>  Update wachtwoord
							</button>
						</div>
					</div>
				</form>
            </fieldset>


    </div>
  </div>
</div>









  </div>
            </div>
          </div>
        </div>
</div>


  <?php include 'page_includes/footer.php'; ?>



