<?php session_start();

if (isset($_SESSION['usr_id'])) {
	
	$user_id = $_SESSION['usr_id']; 
    
} else {
 

}

$empty = "empty";

if(empty($user_id)){
	
	$user_id = "empty";
}

else{$hide_button = "hide";} 
						  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="assets/img/favicon/apple-icon.png">
    <link rel="icon" href="assets/img/favicon/favicon.png">
    <title>
        Belscriptmaken.nl
    </title>
	

    <!-- SEO -->
    <!--  Social tags      -->
    <meta name="keywords" content="belscript, bellen met script, script voor bedrijven, klantenservice script, klantenservice, 
	callcenter, callcenterscript, callagents, zakelijk bellen, zakelijk script">
    <meta name="description" content="Maak eenvoudig een belscript voor uw afdeling klantenservice. Zo bellen uw callagents extra zelfverzekerd en genereert u meer sales">


    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="../../../maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/belscriptmaken.css">
	
    <link href="../assets/assets-for-demo/demo.css" rel="stylesheet" />
    <link href="../assets/assets-for-demo/vertical-nav.css" rel="stylesheet" />

	
</head>


<body class="presentation-page ">
	
	
    <div class="main main-raised">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
						<h2 class="text-center"><strong>Bevestig uw e-mailadres</strong></h2>
					<br />
						<h4 class="description text-center">
							<strong>Bijna klaar…</strong><br /><br />
							U hoeft nog slechts uw e-mail adres te bevestigen.<br />
							We hebben u zojuist een email gestuurd. naar <strong><?php $email = $_GET["email"]; echo "$email"; ?></strong> <br />
							Klik op de link in dat bericht om de aanmelding te voltooien.<br /><br />
							Ga terug naar <a href="../index.php">belscriptmaken.nl</a><br /><br />
							<?php if ( $empty == $user_id) { ?>
							<a href="../app/login.php"><button class="btn btn-lg btn-success"><i class="material-icons">view_stream</i> Inloggen</button></a>
				
							<?php } else { ?>
							<?php } ?>
							<br /><br />
						</h4>
                    </div>
                </div>

            </div>
        </div>

		
		
		
		
		
		


    </div>
		
		
</body>

</html>