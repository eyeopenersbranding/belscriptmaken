<?php
//======================================================================
// Is er een sessie actief? Zo nee log dan eerst even in
//======================================================================

$PageID = "Aanvullende grafieken"; 

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



//======================================================================
// Aantal actieve gebruikers uit database halen
//======================================================================

//Aantal actieve gebruikers uit de database halen en tellen.
$sql = "SELECT status FROM ccs_users WHERE status = 'Actief'";
$result = mysqli_query($con, $sql);

if ($result)
	{
	 $count = array();
	
		foreach($result as $row)
			
		$count[] = $row['status'];
			{
			$total_active_users = count($count);
			}
		} else{

	$total_active_users = "0";
	}


//======================================================================
// Aantal actieve gebruikers uit database halen
//======================================================================

//Aantal actieve gebruikers uit de database halen en tellen.
$sql = "SELECT status FROM ccs_users WHERE status = 'Inactief'";
$result = mysqli_query($con, $sql);

if ($result)
	{
	 $count = array();
	
		foreach($result as $row)
			
		$count[] = $row['status'];
			{
			$total_inactive_users = count($count);
			}
		} else{

	$total_inactive_users = "0";
	}

//======================================================================
// Aantal verkochte MEDIUM producten
//======================================================================

//Aantal verkochte basis producten
$sql = "SELECT status,email_token FROM ccs_users WHERE role = '4'  AND email_token = '1'";
$result = mysqli_query($con, $sql);

if ($result)
	{
	 $count = array();
	
		foreach($result as $row)
			
		$count[] = $row['status'];
			{
			$total_medium_sold = count($count);
			}
		} else{

	$total_medium_sold = "0";
	}


//======================================================================
// Aantal verkochte LARGE producten
//======================================================================

//Aantal verkochte basis producten
$sql = "SELECT status,email_token FROM ccs_users WHERE role = '3' AND email_token = '1'";
$result = mysqli_query($con, $sql);

if ($result)
	{
	 $count = array();
	
		foreach($result as $row)
			
		$count[] = $row['status'];
			{
			$total_large_sold = count($count);
			}
		} else{

	$total_large_sold = "0";
	}

//======================================================================
// Aantal lopende trials
//======================================================================

//Aantal lopende trials
$sql = "SELECT demo_start_date FROM ccs_users WHERE NOT demo_start_date = '0'";
$result = mysqli_query($con, $sql);

if ($result)
	{
	 $count = array();
	
		foreach($result as $row)
			
		$count[] = $row['demo_start_date'];
			{
			$total_in_trial = count($count);
			}
		} else{

	$total_in_trial = "0";
	}


//======================================================================
// Aantal accounts ingevoerd door admin
//======================================================================

//Aantal accounts ingevoerd door admin
$sql = "SELECT email_token FROM ccs_users WHERE email_token = '0'";
$result = mysqli_query($con, $sql);

if ($result)
	{
	 $count = array();
	
		foreach($result as $row)
			
		$count[] = $row['email_token'];
			{
			$total_accounts_sponsored = count($count);
			}
		} else{

	$total_accounts_sponsored = "0";
	}


//======================================================================
// Aantal script items in database
//======================================================================

//Aantal accounts ingevoerd door admin
$sql = "SELECT tab_id FROM ccs_tabs";
$result = mysqli_query($con, $sql);

if ($result)
	{
	 $count = array();
	
		foreach($result as $row)
			
		$count[] = $row['tab_id'];
			{
			$total_script_items = count($count);
			}
		} else{

	$total_script_items = "0";
	}

//======================================================================
// Aantal scripts in database
//======================================================================

//Aantal accounts ingevoerd door admin
$sql = "SELECT tab_model FROM ccs_tabs WHERE tab_model = '1'";
$result = mysqli_query($con, $sql);

if ($result)
	{
	 $count = array();
	
		foreach($result as $row)
			
		$count[] = $row['tab_model'];
			{
			$total_scripts = count($count);
			}
		} else{

	$total_scripts = "0";
	}


//======================================================================
// Aantal call agents
//======================================================================

//Aantal accounts ingevoerd door admin
$sql = "SELECT sub_account FROM ccs_users WHERE sub_account = 'yes'";
$result = mysqli_query($con, $sql);

if ($result)
	{
	 $count = array();
	
		foreach($result as $row)
			
		$count[] = $row['sub_account'];
			{
			$total_agents = count($count);
			}
		} else{

	$total_agents = "0";
	}

//======================================================================
// Aantal ingezonden items
//======================================================================

//Aantal accounts ingevoerd door admin
$sql = "SELECT ideas_id FROM ccs_ideas";
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

                                      <div class="row">
											<div class="col-md-5">
												<div class="card">
													<div class="card-header card-header-icon" data-background-color="red">
														<i class="material-icons">pie_chart</i>
													</div>
													<div class="card-content">
														<h4 class="card-title">Balans account overzicht</h4>
													</div>
													<div id="chartPreferences" class="ct-chart"></div>
													<div class="card-footer">
														<h6>Legend</h6>
														<i class="fa fa-circle text-info"></i> Apple
														<i class="fa fa-circle text-warning"></i> Samsung
														<i class="fa fa-circle text-danger"></i> Windows Phone
													</div>
												</div>
											</div>
							
									
									
											
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
<script>
    $(document).ready(function() {
        demo.initCharts();
    });
</script>
