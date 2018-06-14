<body>
    <div class="wrapper">
        <div class="sidebar" data-active-color="purple" data-background-color="black">
            <!--
        Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
        Tip 2: you can also add an image using data-image tag
        Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->

            <div class="logo">
              <a href="dashboard.php" class="simple-text">
                  Belscriptmaken.nl
              </a>
            </div>


            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="visualtheme/img/faces/person.png"/>
                    </div>

                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                            Welkom <?php echo $_SESSION['usr_name'];  ?> <?php echo $_SESSION['usr_surname'];  ?>
                        </a>
                    </div>
                </div>
				
			<?php if ($PageID == $define_launch_page){ } else{ ?>
				
				
			<?php if ($user_role == $master_admin) { ?>
				<ul class="nav">
					<li <?php if ($PageID=="Dashboard") echo " class=\"active\""; ?>>
                        <a href="ad-dashboard.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
					
					<li <?php if ($PageID=="Aanvullende grafieken") echo " class=\"active\""; ?>>
                        <a href="ad-charts.php">
                            <i class="material-icons">library_books</i>
                            <p>Aanvullende grafieken</p>
                        </a>
                    </li>
					
					  <li <?php if ($PageID=="Mijn leads") echo " class=\"active\""; ?>>
                        <a href="ad-leads.php">
                            <i class="material-icons">subject</i>
                            <p>Mijn leads</p>
                        </a>
                    </li>
					
					 <li <?php if ($PageID=="Mijn klanten") echo " class=\"active\""; ?>>
                        <a href="ad-customers.php">
                            <i class="material-icons">note</i>
                            <p>Mijn klanten</p>
                        </a>
                    </li>

					
                </ul>
		
				
		
			<?php } if ($user_role == $admin_large) { ?>
				<ul class="nav">
					<li <?php if ($PageID=="Dashboard") echo " class=\"active\""; ?>>
                        <a href="dashboard.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
					
					<li <?php if ($PageID=="Script") echo " class=\"active\""; ?>>
                        <a href="script.php">
                            <i class="material-icons">library_books</i>
                            <p>Script</p>
                        </a>
                    </li>
					
					  <li <?php if ($PageID=="Script overzicht") echo " class=\"active\""; ?>>
                        <a href="script-overview.php">
                            <i class="material-icons">subject</i>
                            <p>Script overzicht</p>
                        </a>
                    </li>
					
					 <li <?php if ($PageID=="Idee & aanvulbox") echo " class=\"active\""; ?>>
                        <a href="idea-box.php">
                            <i class="material-icons">note</i>
                            <p>Idee & aanvulbox</p>
                        </a>
                    </li>

					
                    <li <?php if ($PageID=="Callagents") echo " class=\"active\""; ?>>
                        <a href="employees.php">
                            <i class="material-icons">face</i>
                            <p>Callagents</p>
                        </a>
                    </li>

                    <li <?php if ($PageID=="Instellingen") echo " class=\"active\""; ?>>
                        <a href="profile-settings.php">
                            <i class="material-icons">build</i>
                            <p>Instellingen</p>
                        </a>
                    </li>
                </ul>
				
				<?php } if ($user_role == $admin_medium) { ?>
				<ul class="nav">
					<li <?php if ($PageID=="Dashboard") echo " class=\"active\""; ?>>
                        <a href="dashboard.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
					
					<li <?php if ($PageID=="Script") echo " class=\"active\""; ?>>
                        <a href="script.php">
                            <i class="material-icons">library_books</i>
                            <p>Script</p>
                        </a>
                    </li>
					
					  <li <?php if ($PageID=="Script overzicht") echo " class=\"active\""; ?>>
                        <a href="script-overview.php">
                            <i class="material-icons">subject</i>
                            <p>Script overzicht</p>
                        </a>
                    </li>
					
					 <li <?php if ($PageID=="Idee & aanvulbox") echo " class=\"active\""; ?>>
                        <a href="idea-box.php">
                            <i class="material-icons">note</i>
                            <p>Idee & aanvulbox</p>
                        </a>
                    </li>

					
                    <li <?php if ($PageID=="Callagents") echo " class=\"active\""; ?>>
                        <a href="employees.php">
                            <i class="material-icons">face</i>
                            <p>Callagents</p>
                        </a>
                    </li>

                    <li <?php if ($PageID=="Instellingen") echo " class=\"active\""; ?>>
                        <a href="profile-settings.php">
                            <i class="material-icons">build</i>
                            <p>Instellingen</p>
                        </a>
                    </li>
                </ul>
				
				
			<?php } if ($user_role == $employee) { ?>
				
				<ul class="nav">
					
					<li <?php if ($PageID=="Script") echo " class=\"active\""; ?>>
                        <a href="script.php">
                            <i class="material-icons">library_books</i>
                            <p>Script</p>
                        </a>
                    </li>
					 <li <?php if ($PageID=="Mijn aanvullingen") echo " class=\"active\""; ?>>
                        <a href="employee-ideas.php">
                            <i class="material-icons">lightbulb_outline</i>
                            <p>Mijn aanvullingen</p>
                        </a>
                    </li>
                </ul>
		
				
				<?php } if ($user_role == $moderator) { ?>
			<ul class="nav">
				<li <?php if ($PageID=="Dashboard") echo " class=\"active\""; ?>>
                        <a href="dashboard.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                 </li>

				<li <?php if ($PageID=="Script") echo " class=\"active\""; ?>>
					<a href="script.php">
						<i class="material-icons">library_books</i>
						<p>Script</p>
					</a>
				</li>
				
				  <li <?php if ($PageID=="Script overzicht") echo " class=\"active\""; ?>>
                        <a href="script-overview.php">
                            <i class="material-icons">subject</i>
                            <p>Script overzicht</p>
                        </a>
                    </li>
				
			   <li <?php if ($PageID=="Idee & aanvulbox") echo " class=\"active\""; ?>>
					<a href="idea-box.php">
						<i class="material-icons">note</i>
						<p>Idee & aanvulbox</p>
					</a>
				</li>
			</ul>
		<?php } ?>
		
		<?php } ?>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
                
            </div>
        </div>
