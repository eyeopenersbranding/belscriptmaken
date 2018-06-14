<div class="main-panel">
    <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container-fluid">
            <div class="navbar-minimize">
                <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                    <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                    <i class="material-icons visible-on-sidebar-mini">view_list</i>
                </button>
            </div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><?php echo $PageID ?></a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="material-icons">person</i>
                            <p class="hidden-lg hidden-md">
                                Beheer
                                <b class="caret"></b>
                            </p>
                        </a>
                        <ul class="dropdown-menu">
							<?php 
							if (in_array($user_role, array("3","2","1"))){ ?>
							 <li>
                                <a href="profile-settings.php"><i class="material-icons">settings</i> Persoonlijke instellingen</a>
                            </li>
					
							<?php }else {
							//er gebeurd niets wanneer de admin heeft ingelogd.	
							};
							?>
                            <li>
                                <a href="logout.php"><i class="material-icons">power_settings_new</i> Uitloggen</a>
                            </li>
                        </ul>
                    </li>
                    <li class="separator hidden-lg hidden-md"></li>
                </ul>
            </div>
        </div>
    </nav>
