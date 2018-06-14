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
    //Come to action when submit button is activated.
    if(isset($_POST['submit'])&& (!empty($_POST)) && $_SERVER['REQUEST_METHOD'] == 'POST'){

      //Define Required fields
      $required = array('user_company_name');

      // The engine that checks if the fields are filled.
      $error = false;
      foreach($required as $field) {
      if (empty($_POST[$field])) {
      $error = true;

      }
  }

        if ($error) {

          // error post with session.
          $_SESSION['notification'] = "<div class='alert alert-danger alert-dismissable' role='alert'>
                                <i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Vul de verplichte velden aan.</div>
                                ";

                  // Redirect to the right URL
                  header("Location: ../account-setup.php");

        die();

               } else {

            //Post all data from input fields
            $user_company_name = $_POST['user_company_name'];
            $user_address = $_POST['user_address'];
            $user_zipcode = $_POST['user_zipcode'];
            $user_city = $_POST['user_city'];	
            $user_telephone = $_POST['user_telephone'];
            $user_kvk = $_POST['user_kvk'];
            $user_btw = $_POST['user_btw'];
			$user_user_id = $user_id;
			$user_intro1 = "1";
			$user_intro2 = "1";
			$status = "Actief";
			
			$name = $_SESSION['usr_name'];
			$surname = $_SESSION['usr_surname'];
			
			$notification_title = "Welkom bij ikwilfactureren.nl!";
			$notification_content = "Welkom $name $surname, uw proefperiode loopt tot %demo-eind-datum%";

			setlocale(LC_ALL, 'nl_NL');
			$notification_date = date("j-m-Y");

            include '../dbconnect.php';
			
			$sql = "UPDATE CCS_users SET status = '$status' WHERE id = $user_id";	
			$result = mysqli_query($con, $sql);

			//$sql1 = "INSERT INTO ikwil_notifications (notification_title, notification_content, notification_date, notification_user_id) 
			//VALUES ('$notification_title', '$notification_content','$notification_date', '$user_id')";	
			//$result = mysqli_query($con, $sql1);
				

			$sql3 = "INSERT INTO ccs_user_info (user_company_name, user_address, user_zipcode, user_city, user_telephone, user_kvk, user_btw, user_intro1, user_intro2, user_user_id) 
			VALUES ('$user_company_name', '$user_address','$user_zipcode', '$user_city', '$user_telephone', '$user_kvk', '$user_btw', '$user_intro1', '$user_intro2', '$user_user_id')";	
			$result = mysqli_query($con, $sql3);

			if ($result === TRUE) 
			{	
              header("Location: ../dashboard.php");
			} 
			else 
			{
    			echo "errorr";
			}
		}
	}

?>
