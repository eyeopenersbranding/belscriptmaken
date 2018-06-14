<footer class="footer">
    <div class="container-fluid">
		
			<?php if ($PageID == $define_launch_page){ } else{ ?>
		
		
			<?php if ($user_role == $master_admin) { ?>
				<nav class="pull-left">
					<ul>
					  <li>
						  <a href="ad-dashboard.php">
							  <p>Dashboard</p>
						  </a>
					  </li>

					  <li>
						  <a href="ad-charts.php">
							  <p>Aanvullende grafieken</p>
						  </a>
					  </li>

					  <li>
						  <a href="ad-leads.php">
							  <p>Mijn leads</p>
						  </a>
					  </li>

					  <li>
						  <a href="ad-customers.php">
							  <p>Mijn klanten</p>
						  </a>
					  </li>
					</ul>
				</nav>
		
		
			<?php }if ($user_role == $admin_large) { ?>
				<nav class="pull-left">
					<ul>
					  <li>
						  <a href="dashboard.php">
							  <p>Dashboard</p>
						  </a>
					  </li>

					  <li>
						  <a href="script.php">
							  <p>Script</p>
						  </a>
					  </li>

					  <li>
						  <a href="idea-box.php">
							  <p>Idee & aanvulbox</p>
						  </a>
					  </li>

					  <li>
						  <a href="employees.php">
							  <p>Callagents</p>
						  </a>
					  </li>

					  <li>
						  <a href="profile-settings.php">
							  <p>Instellingen</p>
						  </a>
					  </li>

					</ul>
				</nav>
		
				<?php }if ($user_role == $admin_medium) { ?>
				<nav class="pull-left">
					<ul>
					  <li>
						  <a href="dashboard.php">
							  <p>Dashboard</p>
						  </a>
					  </li>

					  <li>
						  <a href="script.php">
							  <p>Script</p>
						  </a>
					  </li>

					  <li>
						  <a href="idea-box.php">
							  <p>Idee & aanvulbox</p>
						  </a>
					  </li>

					  <li>
						  <a href="employees.php">
							  <p>Callagents</p>
						  </a>
					  </li>

					  <li>
						  <a href="profile-settings.php">
							  <p>Instellingen</p>
						  </a>
					  </li>

					</ul>
				</nav>
		
			<?php } if ($user_role == $employee) { ?>
				<nav class="pull-left">
				<ul>
					  <li>
						  <a href="script.php">
							  <p>Script</p>
						  </a>
					 </li>
					<li>
						  <a href="employee-ideas.php">
							  <p>Mijn aanvullingen</p>
						  </a>
					 </li>
				</ul>
		   </nav>
			<?php } ?>
				
			<?php if ($user_role == $moderator) { ?>
			<nav class="pull-left">
				<ul>
					  <li>
						  <a href="dashboard.php">
							  <p>Dashboard</p>
						  </a>
					  </li>
					  <li>
						  <a href="script.php">
							  <p>Script</p>
						  </a>
					 </li>
					
					<li>
						  <a href="script-overview.php">
							  <p>Script overzicht</p>
						  </a>
					 </li>
	
				  <li>
					  <a href="idea-box.php">
						  <p>Idee & aanvulbox</p>
					  </a>
				  </li>
				</ul>
		   </nav>
		<?php } ?>
		
		<?php } ?>
       
        <p class="copyright pull-right">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>
             Belscriptmaken.nl | Powered by <a href="http://www.keijzersgroup.nl" target="_blank">Keijzersgroup</a>
        </p>
    </div>
</footer>

</div>
</div>
</body>
   <!-- Javascript -->
    

<!--   Core JS Files   -->
<script src="visualtheme/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="visualtheme/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="visualtheme/js/bootstrap.min.js" type="text/javascript"></script>
<script src="visualtheme/js/material.min.js" type="text/javascript"></script>
<script src="visualtheme/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="visualtheme/js/jquery.validate.min.js"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="visualtheme/js/moment.min.js"></script>
<!--  Charts Plugin -->
<script src="visualtheme/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="visualtheme/js/bootstrap-notify.js"></script>
<!-- DateTimePicker Plugin -->
<script src="visualtheme/js/bootstrap-datetimepicker.js"></script>
<!-- Vector Map plugin -->
<script src="visualtheme/js/jquery-jvectormap.js"></script>
<!-- Sliders Plugin -->
<script src="visualtheme/js/nouislider.min.js"></script>

<!-- Select Plugin -->
<script src="visualtheme/js/jquery.select-bootstrap.js"></script>
<!--  DataTables.net Plugin    -->
<script src="visualtheme/js/jquery.datatables.js"></script>
<!-- Sweet Alert 2 plugin -->
<script src="visualtheme/js/sweetalert2.js"></script>

<!--  Full Calendar Plugin    -->
<script src="visualtheme/js/fullcalendar.min.js"></script>
<!-- TagsInput Plugin -->
<script src="visualtheme/js/jquery.tagsinput.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="visualtheme/js/material-dashboard.js"></script>

    <!-- Vendors -->

<script src="visualtheme/js/demo.js"></script>
      
<script src="app_data/vendors/bower_components/Waves/dist/waves.min.js"></script>



<script src="app_data/vendors/bower_components/trumbowyg/dist/trumbowyg.min.js"></script>

<!-- App functions and actions -->
<script src="app_data/js/app.min.js"></script>




<script type="text/javascript">
$(document).ready(function() {
$('#datatables').DataTable({
"pagingType": "full_numbers",
"lengthMenu": [
    [10, 25, 50, -1],
    [10, 25, 50, "All"]
],
responsive: true,
language: {
    search: "_INPUT_",
    searchPlaceholder: "Specifiek zoeken",
}

});



});
</script>

<script type="text/javascript">
$(document).ready(function() {
$('#datatables1').DataTable({
"pagingType": "full_numbers",
"lengthMenu": [
    [10, 25, 50, -1],
    [10, 25, 50, "All"]
],
responsive: true,
language: {
    search: "_INPUT_",
    searchPlaceholder: "Specifiek zoeken",
}

});



});
</script>

<script type="text/javascript">
$(document).ready(function() {
$('#datatables2').DataTable({
"pagingType": "full_numbers",
"lengthMenu": [
    [10, 25, 50, -1],
    [10, 25, 50, "All"]
],
responsive: true,
language: {
    search: "_INPUT_",
    searchPlaceholder: "Specifiek zoeken",
}

});



});
</script>

<script type="text/javascript">
$(document).ready(function() {
$('#datatables3').DataTable({
"pagingType": "full_numbers",
"lengthMenu": [
    [10, 25, 50, -1],
    [10, 25, 50, "All"]
],
responsive: true,
language: {
    search: "_INPUT_",
    searchPlaceholder: "Specifiek zoeken",
}

});



});
</script>

<script type="text/javascript">
$(document).ready(function() {
$('#datatables4').DataTable({
"pagingType": "full_numbers",
"lengthMenu": [
    [10, 25, 50, -1],
    [10, 25, 50, "All"]
],
responsive: true,
language: {
    search: "_INPUT_",
    searchPlaceholder: "Specifiek zoeken",
}

});



});
</script>
</html>
