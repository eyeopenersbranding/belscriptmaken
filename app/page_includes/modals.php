 <!-- Begin van de modal voor het toevoegen van een medewerker -->
		<div class="modal fade" id="modal-add-employee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="modal-title">Callagent toevoegen</h4>
					</div>
					<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
					<div class="modal-body">
						 <div class="row">
							<label class="col-sm-2 label-on-left">Voornaam</label>
							<div class="col-sm-10">
								<div class="form-group label-floating is-empty">
									<label class="control-label"></label>
									<input type="text" name="name" class="form-control" value>
									<span class="help-block">A block of help text that breaks onto a new line.</span>
								</div>
							</div>
						</div>
						<div class="row">
							<label class="col-sm-2 label-on-left">Achternaam</label>
							<div class="col-sm-10">
								<div class="form-group label-floating is-empty">
									<label class="control-label"></label>
									<input type="text" name="surname" class="form-control" value>
									<span class="help-block">A block of help text that breaks onto a new line.</span>
								</div>
							</div>
						</div>
						<div class="row">
							<label class="col-sm-2 label-on-left">E-mail</label>
							<div class="col-sm-10">
								<div class="form-group label-floating is-empty">
									<label class="control-label"></label>
									<input type="text" name="email" class="form-control" value>
									<span class="help-block">A block of help text that breaks onto a new line.</span>
								</div>
							</div>
						</div>
						
						<div class="row">
							<label class="col-sm-2 label-on-left">Password</label>
							<div class="col-sm-10">
								<div class="form-group label-floating is-empty">
									<label class="control-label"></label>
									<input type="password" name="password" class="form-control" value>
								</div>
							</div>
						</div>
						<div class="row">
							<label class="col-sm-2 label-on-left">Password</label>
							<div class="col-sm-10">
								<div class="form-group label-floating is-empty">
									<label class="control-label"></label>
									<input type="password" name="cpassword" class="form-control" value>
								</div>
							</div>
						</div>
						
						
				
					</div>
					<div class="modal-footer">
						<button type="submit" name="register" class="btn btn-primary"><i class="material-icons">add</i> Collega toevoegen</button>
					</div>
					</form>
				</div>
			</div>
		</div>
<!--  End Modal -->

<!-- Begin van de modal voor het toevoegen van een hoofdtegel -->

		<div class="modal fade" id="modal-add-headtile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="add_headtile">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="modal-title">Hoofdtegel toevoegen</h4>
					</div>
					<div class="modal-body">
			
						 <div class="row">
							<label class="col-sm-2 label-on-left">Titel</label>
							<div class="col-sm-10">
								<div class="form-group label-floating is-empty">
									<label class="control-label"></label>
									
									<input type="text" name="tab_title" class="form-control" required>
									<span class="help-block">A block of help text that breaks onto a new line.</span>
									
								</div>
							</div>
						</div>			 
					   <div class="row">						
							<div class="col-sm-12">
								<div class="form-group">
									<textarea name="tab_notes" class="form-control wysiwyg-editor" placeholder="Projectinhoud" rows="5" ></textarea>
									<i class="form-group__bar"></i>
								</div>
							</div>
						</div>

					</div>
					<div class="modal-footer">
							
							<button name="add_headtile" type="submit" id="modal-add-headtile" class="btn btn-primary"><i class="material-icons">add</i> Hoofdtegel toevoegen</button>

					</div>
				</div>
			</div>
			</form>
		</div>
		
<!--  End Modal -->

<!-- Modal voor het verwijderen van een medeweker -->
	<div class="modal fade" id="modal-delete-employee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-small ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				</div>
				<div class="modal-body text-center">
					<h5>Weet u zeker dat u deze medewerker wilt verwijderen? </h5>
				</div>
				<div class="modal-footer text-center">
					<form action='CCS_Engine/CCSDelete_functions.php' method='post' enctype='multipart/form-data'>
						<input type="hidden" name="employee_id" value="<?php echo $id ?>" />
						<button type="button" class="btn btn-simple" data-dismiss="modal">Never mind</button>
						<button type="submit" name="delete_employee" class="btn btn-success btn-simple">Yes</button>
					</form>
				</div>
			</div>
		</div>
	</div>
<!--   Einde modal -->

<!-- Modal voor het verwijderen van een tab -->
	<div class="modal fade" id="modal-delete-tab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-small ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				</div>
				<div class="modal-body text-center">
					<h5>Weet u zeker dat u deze tab wilt verwijderen? </h5>
					<?php echo "$tab_id"; ?>
					<?php echo "$previous"; ?>
				</div>
				<div class="modal-footer text-center">
					<form action='script-card.php' method='post' enctype='multipart/form-data'>
						<input type="hidden" name="delete_tab_id" value="<?php echo $tab_id ?>" />
						<input type="hidden" name="delete_script_id" value="<?php echo $previous ?>" />
						<input type="hidden" name="delete_tab_link_id" value="<?php echo $tab_link_id ?>" />
						<input type="hidden" name="tab_model" value="<?php echo $tab_model ?>" />
						<input type="hidden" name="script_id" value="<?php echo $previous ?>" />
						
						<button type="button" class="btn btn-simple" data-dismiss="modal">Never mind</button>
						<button type="submit" name="delete_tab" class="btn btn-success btn-simple">Yes</button>
					</form>
					
					
					
				
				</div>
			</div>
		</div>
	</div>

<!-- Begin van de modal voor het instellen van de bewerkmodus -->

		<div class="modal fade" id="moderator_settings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="moderator_settings">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="material-icons">clear</i>
						</button>
						<h4 class="modal-title">Instellingen voor bewerken</h4>
					</div>
					<div class="modal-body">
			
						 <div class="row">
							<label class="col-sm-2 label-on-left">Titel</label>
							<div class="col-sm-10">
								<div class="form-group label-floating is-empty">
									<label class="control-label"></label>
									
									<input type="text" name="tab_title" class="form-control" required>
									<span class="help-block">A block of help text that breaks onto a new line.</span>
									
								</div>
							</div>
						</div>			 
					   <div class="row">						
							<div class="col-sm-12">
								<div class="form-group">
									<textarea name="tab_notes" class="form-control wysiwyg-editor" placeholder="Projectinhoud" rows="5" ></textarea>
									<i class="form-group__bar"></i>
								</div>
							</div>
						</div>

					</div>
					<div class="modal-footer">
							
							<button name="add_headtile" type="submit" id="modal-add-headtile" class="btn btn-primary"><i class="material-icons">add</i> Hoofdtegel toevoegen</button>

					</div>
				</div>
			</div>
			</form>
		</div>
		
<!--  End Modal -->
