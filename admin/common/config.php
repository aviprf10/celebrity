<?php
error_reporting(0);
if (!isset($_SESSION))
{
    session_start();
}
$company_name_session = 'c1e2l3b4r5i6t7y8m9y1s2i3t4e6';
$company_title = 'Welcome::Celebrity | Admin';
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

$base_url = 'http://localhost/celebrity/admin/';
$base_url_common = $base_url . 'common/';
$base_url_css = $base_url . 'assets/css/';
$base_url_js = $base_url . 'assets/js/';
$base_url_images = $base_url . 'assets/images/';
$base_url_css_upload = $base_url . 'assets/css-upload/';
$base_url_js_upload = $base_url . 'assets/js-upload/';
$base_url_uploads = $base_url . 'uploads/';

$front_end_url = '/celebrity/';
$document_root = $_SERVER['DOCUMENT_ROOT'];
$base_path = "/celebrity/admin/";
$base_path_1 = "/celebrity/celebrity/";
$base_path_2 = "/celebrity/brand/";
$full_path = $document_root . $base_path;
$base_path_common = $base_path . 'common/';
$base_path_uploads = $base_path . 'uploads/';
$cele_base_path_uploads = $base_path_1.'uploads/';
$brand_base_path_uploads = $base_path_2.'uploads/';

include $full_path . 'common/email.php';
include $full_path . 'common/functions.php';
require $full_path . 'common/timeago.inc.php';
include $full_path . 'phpmailer/src/Exception.php';
include $full_path . 'phpmailer/src/PHPMailer.php';
include $full_path . 'phpmailer/src/SMTP.php';
// $user_ip = getUserIP();


?>