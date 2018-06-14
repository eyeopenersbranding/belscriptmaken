<?php
/**
 * Data config bestand. Alle algemene variable zijn hier in meegenomen.
 * @Data-config-cabinet
 * @author Carlos Keijzers
 */
$tab_id = false;
$set_trial_time = "30"; //dagen
$price_medium = "50"; //euro, admin dashboard rekent met deze waardes
$price_large = "80"; //euro, admin dashboard rekent met deze waardes


//Waarde voor de rechten vastleggen
$master_admin = "1";
$master_reader = "2";
$admin_large = "3";
$admin_medium = "4";
$moderator = "5";
$employee = "6";


//======================================================================
// Melding registratie /inloggen / wachtwoord vergeten
//======================================================================

$error_notification['wrong_credentials'] = '<strong>Sorry</strong>, dat was geen geldige login. Probeer opnieuw. Als je je wachtwoord vergeten bent, kan je het altijd resetten.';
$error_notification['registration_email_error'] = 'Please Enter Valid Email ID hoer';
$error_notification['registration_password_error'] = 'Password must be minimum of 6 characters hoer';
$error_notification['registration_name_error'] = 'Name must contain only alphabets and space';
$error_notification['registration_surname_error'] = 'Name must contain only alphabets and space';
$error_notification['registration_cpassword_error'] = "Password and Confirm Password doesn't match";

$error_notification['empty_tab_error'] = "Geen vervolgstap aangemaakt.";

$success_notification['registration_success'] = "Registratie succesvol, u kunt nu inloggen.";


//======================================================================
// Profile-settings meldingen
//======================================================================

$error_notification['user_company_name_error'] = 'Geen bedrijfsnaam ingevoerd.';
$error_notification['user_address_error'] = 'Geen adres ingevoerd.';
$error_notification['user_zipcode_error'] = 'Geen postcode ingevoerd.';
$error_notification['user_city_error'] = 'Geen plaats ingevoerd.';
$error_notification['user_telephone_error'] = 'Geen telefoonnummer ingevoerd.';
$error_notification['user_email_error'] = 'Geen e-mail adres ingevoerd.';

$error_notification['user_false_password_error'] = 'Onjuist wachtwoord';
$error_notification['user_password_error'] = 'Wachtwoord dient tenminste 6 tekens te zijn';
$error_notification['user_cpassword_error'] = 'Wachtwoord komt niet overeen';

//======================================================================
// Employee-card meldingen
//======================================================================

$error_notification['name_error'] = 'Geen voornaam ingevoerd.';
$error_notification['surname_error'] = 'Geen achternaam ingevoerd.';
$error_notification['email_error'] = 'Geen e-mail adres ingevoerd.';

$error_notification['password_error'] = 'Wachtwoord dient tenminste 6 tekens te zijn';
$error_notification['cpassword_error'] = 'Wachtwoord komt niet overeen';

$success_notification['update_user_success'] = 'Gegevens succesvol aangepast';
$success_notification['add_colleague_success'] = 'Collega succesvol aangemaakt';
$error_notification['delete_colleague_success'] = 'Collega succesvol verwijderd';


//======================================================================
// Meldingen voor het inzenden en verwijderen van een idee
//======================================================================


$success_notification['delete_idea_success'] = 'Ingezonden idee verwijderd';
$success_notification['idea_send_successful'] = 'Ingezonden idee verzonden, de moderator pakt dit zo spoedig mogelijk op!';

//======================================================================
// Meldingen script
//======================================================================

$success_notification['add_script_item_success'] = 'Script item succesvol aangemaakt';
?>