<?php
session_start();
include_once '../dbconnect.php';

if (isset($_SESSION['usr_id'])) {
    
} else {
    header('Location: login.php');
}
//User_id uit de sessie halen
$user_id = $_SESSION['usr_id'];
?>
<?php
    if (isset($_POST['update_password'])) {
		
			$old_password = mysqli_real_escape_string($con, $_POST['old_password']);
			$result = mysqli_query($con, "SELECT * FROM ccs_users WHERE id = '" . $user_id. "' and password = '" . md5($old_password) . "'");
		
		if ($row = mysqli_fetch_array($result)) {
		
			$password = mysqli_real_escape_string($con, $_POST['password']);
			$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
			$id = $_POST['id'];

			//name can contain only alpha characters and space
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

			$sql = "UPDATE ccs_users SET password = '". md5 ($password)."' WHERE id = $user_id";	
			$result = mysqli_query($con, $sql);
				
					// success post with session.
            $_SESSION['notification'] = "
				  <div class='alert alert-success'>
					<button type='button' aria-hidden='true' class='close'><i class='material-icons'>close</i></button>
					<span><i class='material-icons'>check_circle</i> - Wachtwoord succesvol aangepast </span>
				  </div>
			  
			  							";
				// Redirect to the right URL.
              header("Location: ../profile-settings.php");
			}
		}
			
		else{
		
echo "poep in je broek";
		die();	
		}
		
	}
		
		



?>


