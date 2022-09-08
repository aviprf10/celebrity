<?php
if(($_SESSION[$company_name_session.'_loggedin'] == 2)  && ($_SESSION['domain_link_'.$company_name_session] == $company_name_session))
{
	$celebrity 								= 1;
	$user 									= 0;
	$_SESSION['next_url']					= '';
	$loggedin_user_id 						= $_SESSION['user_id_'.$company_name_session];
	$loggedin_user_first_name 				= $_SESSION['first_name_'.$company_name_session];
	$loggedin_user_last_name 				= $_SESSION['last_name_'.$company_name_session];
	$loggedin_user_email 					= $_SESSION['user_email_'.$company_name_session];
	$loggedin_user_name_link 				= $_SESSION['user_name_link_'.$company_name_session];
	$loggedin_user_name 					= $_SESSION['user_name_'.$company_name_session];
	$logge_user_name 						= str_replace('-', '_', $loggedin_user_name_link);
	$loggedin_user_mobile 					= $_SESSION['mobile_'.$company_name_session];
	$loggedin_user_type 					= $_SESSION['user_type_'.$company_name_session];
	$loggedin_user_profile_pic_100  		= $_SESSION['profile_pic_100'.$company_name_session];
	$loggedin_user_profile_pic_450  		= $_SESSION['profile_pic_450'.$company_name_session];
    $page_layout 			                = $_SESSION['theme_layout'.$company_name_session];
    // page layout 1 - top menu
    // page layout 2 - side menu
    $theme_color 			                = $_SESSION['theme_color'.$company_name_session];
    $side_menu_state 			            = $_SESSION['side_menu_state'.$company_name_session];
	//$loggedin_user_mobile_access_token 	= $_SESSION['mobile_access_token_'.$company_name_session];
	//$loggedin_user_web_access_token 		= $_SESSION['web_access_token_'.$company_name_session];

//    $get_user_login_query = "SELECT theme_color, theme_layout, side_menu_state, profile_pic FROM user WHERE id='$loggedin_user_id'";
//
//    $result_get_user_login_query = mysqli_query($db_mysqli, $get_user_login_query);
//    $all_user_login_data_array = array();
//    while ($row_get_user_login_query = mysqli_fetch_assoc($result_get_user_login_query))
//    {
//        $all_user_login_data_array[] = $row_get_user_login_query;
//    }
//
//    // page layout 1 - top menu
//    // page layout 2 - side menu
//    $page_layout = $all_user_login_data_array[0]['theme_layout'];
//    $theme_color = $all_user_login_data_array[0]['theme_color'];
//    $side_menu_state = $all_user_login_data_array[0]['side_menu_state'];
//    $profile_pic = $all_user_login_data_array[0]['profile_pic'];
}
else
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$base_url.'logout.php">';
}
?>