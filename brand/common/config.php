<?php
error_reporting(0);
if(!isset($_SESSION))
{
	session_start();
}

$company_name_session = 'c1e2l3b4r5i6t7y8m9y1s2i3t4e6';
$company_title = 'Welcome::Celebrity';
$noreply_email = "noreply@domain.com";
$info_email = 'info@domain.com';
$selected_currency_icon = '₹';
$selected_currency_text = 'Rs. ';
$current_page = basename($_SERVER['PHP_SELF']);
$admin_email_id='noreply@domain.com';

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'celebrity';
$db_mysqli = new mysqli($host, $user, $password, $database);

$base_url = 'http://localhost/celebrity/';
$base_url1 = 'http://localhost/celebrity/brand/';
$base_url_common = $base_url1.'assets/common/';
$base_url_css = $base_url1.'assets/css/';
$base_url_js = $base_url1.'assets/js/';
$base_url_images = $base_url1.'assets/images/';
$base_url_uploads = $base_url1.'admin/uploads/';


$document_root = $_SERVER['DOCUMENT_ROOT'];
$base_path = "/celebrity/admin/";
$base_path_1 = "/celebrity/celebrity/";
$base_path_2 = "/celebrity/";
$base_path_3 = "/celebrity/brand/";
$full_path = $document_root.$base_path;
$full_path_2 = $document_root.$base_path_3;
$base_path_common = $base_path.'common/';
$base_path_uploads = $base_path.'uploads/';
$cele_base_path_uploads = $base_path_1.'uploads/';
$brand_base_path_uploads = $base_path_3.'uploads/';

include $full_path_2.'common/functions.php';
include $full_path_2.'common/email.php';
//require $full_path.'phpmailer/PHPMailerAutoload.php';
include $full_path_2.'common/mobile_otp.php';
include $full_path_2.'phpmailer/src/Exception.php';
include $full_path_2.'phpmailer/src/PHPMailer.php';
include $full_path_2.'phpmailer/src/SMTP.php';
$user_ip = getUserIP();

$pincode_array= array("400708", "400701", "400709", "400703", "400705", "400706", "400614", "410210", "410209", "410218", "410206");
$master_settings_data_array = array();
$master_settings_query = "SELECT * FROM master_settings WHERE id='1'";
$result_master_settings_data = mysqli_query($db_mysqli, $master_settings_query);
while ($row_master_settings_data = mysqli_fetch_assoc($result_master_settings_data))
{
    $master_settings_data_array[] = $row_master_settings_data;
}
?>