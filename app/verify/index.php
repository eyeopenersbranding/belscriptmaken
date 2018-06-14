<?php

include_once '../dbconnect.php';


$token = $_GET["token"];
$user_id = $_GET["user_id"];

//Token controleren in de database en de gebruiker doorverwijzen.
$sql = "SELECT email_token FROM ccs_users WHERE id = '$user_id'";
$result = mysqli_query($con, $sql);

if($result -> num_rows >0){

while($row = $result->fetch_assoc()) {
	
$email_token = $row['email_token'];

		

}
	
		if ($token == $email_token){

					$confirmed = "1";
					$reset_token = "0";


					$sql = "UPDATE ccs_users SET account_confirmed = '$confirmed', email_token = '$reset_token' WHERE id = '$user_id'";	
					$result = mysqli_query($con, $sql);	
			
					  header("Location: ../../dashboard.php");

				}else {
					echo "erorr";
					die();

				}
  
} else {
	
	echo "erorr";
	die();
}




?>