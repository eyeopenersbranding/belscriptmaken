<?php
/**
 * Login,registreren, wachtwoord vergeten script.
 * @Inlog-cabinet
 * @author Carlos Keijzers
 */
session_start();

if(isset($_SESSION['usr_id'])) {
	header("Location: dashboard.php");
}

//Verbinding maken met de database
include_once 'dbconnect.php';

//Algemeen variable data bestand embedden
require_once 'page_includes/data_config.php';

//set validation error flag as false
$error = false;

//======================================================================
// Engine voor het registreren
//======================================================================

if (isset($_POST['signup'])) {
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$surname = mysqli_real_escape_string($con, $_POST['surname']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
	
	//name can contain only alpha characters and space
	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true;
		$name_error = ($error_notification['registration_name_error']);
		$error_message_register = ($error_notification['registration_name_error']);
	}
	if (!preg_match("/^[a-zA-Z ]+$/",$surname)) {
		$error = true;
		$surname_error = ($error_notification['registration_surname_error']);
		$error_message_register = ($error_notification['registration_surname_error']);
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = ($error_notification['registration_email_error']);
		$error_message_register = ($error_notification['registration_email_error']);
	}
	if(strlen($password) < 6) {
		$error = true;
		$password_error = ($error_notification['registration_password_error']);
		$error_message_register = ($error_notification['registration_password_error']);
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = ($error_notification['registration_cpassword_error']);
		$error_message_register = ($error_notification['registration_cpassword_error']);
	}
	if (!$error) {
		$role = "4";
		$status = "Inactief";
		$licence_start_date = "0";
		setlocale(LC_ALL, 'nl_NL');
        $demo_start_date = date("j-m-Y");
		$email_token = uniqid();
		if(mysqli_query($con, "INSERT INTO ccs_users(name,surname,email,password,role,status,email_token,demo_start_date,licence_start_date) VALUES('" . $name . "', '" . $surname . "', '" . $email . "', '" . md5($password) . "', '" . $role . "', '" . $status . "', '" . $email_token . "', '" . $demo_start_date . "', '" . $licence_start_date . "')")) {
			
			$register_success = ($success_notification['registration_success']);
			$success_message_register = ($success_notification['registration_success']);
		
			
		} else {
			$errormsg = "Error in registering...Please try again later!";
		}
	}
}



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="visualtheme/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="visualtheme/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Belscriptmaken.nl</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="visualtheme/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="visualtheme/css/material-dashboard-login.css" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="visualtheme/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
</head>

<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="ASLibrary/js/js-bootstrap.php"></script>

<body>
    <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="../index.php">Belscriptmaken.nl</a>
            </div>
     
        </div>
    </nav>
    <div class="wrapper wrapper-full-page">	
        <div class="full-page login-page" filter-color="black"   data-image="visualtheme/img/login.jpeg">
			
            <div class="content">
                <div class="container">
                    <div class="row">
	
						
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
			
							
							<?php if (isset($error_message)) { ?>
							
							<div class="alert alert-danger">
								<button type="button" aria-hidden="true" class="close">
								</button>
								<span>
									<i class="material-icons">report_problem</i>
							
										<?php echo "$error_message"; ?>
									
								</span>
							</div>

						<?php } if (isset($error_message_register)) { ?>
							<div class="alert alert-danger">
								<button type="button" aria-hidden="true" class="close">
								</button>
								<span>
								<?php if (isset($name_error)) echo $name_error; ?> 
								<?php if (isset($surname_error)) echo $surname_error; ?>
								<?php if (isset($email_error)) echo $email_error; ?>
								<?php if (isset($password_error)) echo $password_error; ?>
								<?php if (isset($cpassword_error)) echo $cpassword_error; ?>
								</span>
							</div>
						<?php } ?>
							
							
						<?php if (isset($success_message_register)) { ?>
							<div class="alert alert-success">
								<button type="button" aria-hidden="true" class="close">
								</button>
								<span>
								<?php if (isset($register_success)) echo $register_success; ?> 
								</span>
							</div>
						<?php } ?>
							
                            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
                                <div class="card card-login card-hidden">
                                    <div class="card-header text-center" data-background-color="purple">
                                        <h4 class="card-title">Maak een account aan</h4>
									</div>
									<center><strong>Welkom bij belscriptmaken.nl!</strong></center>
									<br />
										<div class="card-content">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons">face</i>
												</span>
												<div class="form-group label-floating">
													<label class="control-label">Naam</label>
													<input type="text" name="name" class="form-control">
												</div>
											</div>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons">face</i>
												</span>
												<div class="form-group label-floating">
													<label class="control-label">Achternaam</label>
													<input type="text" name="surname" class="form-control">
												</div>
											</div>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons">email</i>
												</span>
												<div class="form-group label-floating">
													<label class="control-label">E-mail adres</label>
													<input type="text" name="email" class="form-control">
												</div>
											</div>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons">lock_outline</i>
												</span>
												<div class="form-group label-floating">
													<label class="control-label">Wachtwoord</label>
													<input type="password" name="password" class="form-control">
												</div>
											</div>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="material-icons">lock_outline</i>
												</span>
												<div class="form-group label-floating">
													<label class="control-label">Wachtwoord</label>
													<input type="password" name="cpassword" class="form-control">
												</div>
											</div>
										</div>
									
									<hr>
                                    <div class="footer text-center">
										<button type="submit" name="signup" class="btn btn-block  btn-primary">Registreren<div class="ripple-container"></div></button><br />
										<a href="login.php" class="btn btn-block  btn-success" role="button">Inloggen</a>
										<br />
										<br />
										<a href="../index.php">www.belscriptmaken.nl</a>
										
                                    </div>
									<p class="panel-body text-center">
										Door verder te gaan met het maken van je account en het gebruiken van belscriptmaken.nl, ga je akkoord met onze <strong>Algemene Voorwaarden en Privacybeleid.</strong> Indien je hier niet mee akkoord gaat, kun je belscriptmaken.nl niet gebruiken.
										</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        Belscriptmaken.nl | Powered by Keijzersgroup
                    </p>
                </div>
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="visualtheme/js/demo.js"></script>

<script type="text/javascript">
    $().ready(function() {
        demo.checkFullPageBackgroundImage();

        setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>

</html>
