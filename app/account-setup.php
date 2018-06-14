<?php
$PageID = "account-setup";
session_start();
include_once 'dbconnect.php';


if (isset($_SESSION['usr_id'])) {
    
} else {
    header('Location: login.php');
}


include 'page_includes/ikwil_redirect_core.php';

?>
<?php include 'page_includes/header.php'; ?>

       <?php include 'page_includes/headbar.php'; ?>

            <div class="content">
                <div class="container-fluid">
					        <div class="col-sm-8 col-sm-offset-2">
                        <!--      Wizard container        -->
                        <div class="wizard-container">
                            <div class="card wizard-card" data-color="rose" id="wizardProfile">
                                <form action='CCS_Engine/CCSSetup.php' method='post' enctype='multipart/form-data'>
                                    <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                                    <div class="wizard-header">
                                        <h3 class="wizard-title">
                                            Bijna klaar !
                                        </h3>
                                        <h5>We hebben alleen nog een aantal gegevens nodig</h5>
                                    </div>
                                    <div class="wizard-navigation">
                                        <ul>
                                            <li>
                                                <a href="#about" data-toggle="tab">Uw bedrijf</a>
                                            </li>
                                            <li>
                                                <a href="#account" data-toggle="tab">Adres</a>
                                            </li>
                                            <li>
                                                <a href="#address" data-toggle="tab">Contactgegevens</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane" id="about">
                                            <div class="row">
                                                <h4 class="info-text"> Bedrijfsgegevens</h4>
                                                <div class="col-sm-4 col-sm-offset-1">
                                                    <div class="picture-container">
															<div class="icon icon-info">
																<i class="material-icons" style="font-size: 20rem;">domain</i>
															</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">face</i>
                                                        </span>
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Bedrijfsnaam
                                                                <small>(verplicht)</small>
                                                            </label>
                                                            <input name="user_company_name" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">record_voice_over</i>
                                                        </span>
                                                        <div class="form-group label-floating">
                                                            <label class="control-label"> KVK
                                                                <small>(verplicht)</small>
                                                            </label>
                                                            <input name="user_kvk" type="text" class="form-control">
                                                        </div>
                                                    </div>
													 <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">record_voice_over</i>
                                                        </span>
                                                        <div class="form-group label-floating">
                                                            <label class="control-label"> BTW
                                                                <small>(verplicht)</small>
                                                            </label>
                                                            <input name="user_btw" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="account">
                                            <div class="row">
                                                <h4 class="info-text"> Nog een aantal gegevens zodat uw factuuradres klopt.</h4>
                                                <div class="col-sm-4 col-sm-offset-1">
                                                     <div class="picture-container">
															<div class="icon icon-info">
																<i class="material-icons" style="font-size: 20rem;">pin_drop</i>
															</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">face</i>
                                                        </span>
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Straat + huisnummer
                                                                <small>(verplicht)</small>
                                                            </label>
                                                            <input name="user_address" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">record_voice_over</i>
                                                        </span>
                                                        <div class="form-group label-floating">
                                                            <label class="control-label"> Postcode
                                                                <small>(verplicht)</small>
                                                            </label>
                                                            <input name="user_zipcode" type="text" class="form-control">
                                                        </div>
                                                    </div>
													 <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">record_voice_over</i>
                                                        </span>
                                                        <div class="form-group label-floating">
                                                            <label class="control-label"> Plaats
                                                                <small>(verlpicht)</small>
                                                            </label>
                                                            <input name="user_city" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="address">
                                           <div class="row">
                                                <h4 class="info-text"> Let's start with the basic information (with validation)</h4>
                                                <div class="col-sm-4 col-sm-offset-1">
                                                     <div class="picture-container">
															<div class="icon icon-info">
																<i class="material-icons" style="font-size: 20rem;">local_phone</i>
															</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">face</i>
                                                        </span>
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Telefoonnummer
                                                                <small>(verplicht)</small>
                                                            </label>
                                                            <input name="user_telephone" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wizard-footer">
                                        <div class="pull-right">
                                            <input type='button' class='btn btn-next btn-fill btn-rose btn-wd' name='next' value='Next' />
                                            <input type='submit' class='btn btn-finish btn-fill btn-rose btn-wd' name='submit' value='Finish' />
                                        </div>
                                        <div class="pull-left">
                                            <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- wizard container -->
                    </div>
                   
                </div>
            </div>

<!--   Core JS Files   -->
<script src="visualtheme/account-setup/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="visualtheme/account-setup/js/bootstrap.min.js" type="text/javascript"></script>
<script src="visualtheme/account-setup/js/material.min.js" type="text/javascript"></script>
<script src="visualtheme/account-setup/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="visualtheme/account-setup/js/arrive.min.js" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="visualtheme/account-setup/js/jquery.validate.min.js"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="visualtheme/account-setup/js/moment.min.js"></script>
<!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
<script src="visualtheme/account-setup/js/chartist.min.js"></script>
<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="visualtheme/account-setup/js/jquery.bootstrap-wizard.js"></script>
<!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
<script src="visualtheme/account-setup/js/bootstrap-notify.js"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="visualtheme/account-setup/js/bootstrap-datetimepicker.js"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="visualtheme/account-setup/js/jquery-jvectormap.js"></script>
<!-- Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
<script src="visualtheme/account-setup/js/nouislider.min.js"></script>

<!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="visualtheme/account-setup/js/jquery.select-bootstrap.js"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="visualtheme/account-setup/js/jquery.datatables.js"></script>
<!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
<script src="visualtheme/account-setup/js/sweetalert2.js"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="visualtheme/account-setup/js/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="visualtheme/account-setup/js/fullcalendar.min.js"></script>
<!-- Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="visualtheme/account-setup/js/jquery.tagsinput.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="visualtheme/account-setup/js/material-dashboard.js?v=1.2.1"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="visualtheme/account-setup/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        demo.initMaterialWizard();
        setTimeout(function() {
            $('.card.wizard-card').addClass('active');
        }, 600);
    });
</script>


