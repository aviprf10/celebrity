<?php
session_start();
include 'common/config.php';
include 'common/fb_config.php';
header('Content-type: application/json');
if(isset($_POST))
{ 
    $registered_from = '';

    $profile_pic = '';
    $mobile = '';
    $password = '';
    $mobile_otp = '';

    $registered_from = Secure1($db_mysqli, $_POST['registered_from']);
    $login_id = Secure1($db_mysqli, strtolower($_POST['login_id']));
    $login_id_session = Secure1($db_mysqli, strtolower($_POST['login_id_session']));
    $password = Secure1($db_mysqli, $_POST['password']);


    $all_user_data_array = array();
    $get_user_query = "select * from brand_user where (email='$login_id' or  mobile='$login_id') and is_deleted=0 and user_type='1'";
    $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
    while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
    {
        $all_user_data_array[] = $row_get_user_query;
    }

    if (isset($all_user_data_array) && count($all_user_data_array) > 0)
    {
        $user_data = $all_user_data_array[0];
    }
    else
    {
        $user_data = array();
    }

    if(count($user_data) == 0) // If email id does not exist.
    {
        $return["html_message"] = 'Oh snap! Email id does not exist...!';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }
    else 
    {
        $valid_user = 0;

        if ($user_data['registered_from'] == '')
        {
            if (($user_data['email'] == $login_id || $user_data['mobile'] == $login_id ) && $user_data['password'] == $password)
            {
                $valid_user = 1;
            }
            else
            {
                $return["html_message"] = 'Oh snap! id & password does not match...!';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }
        }
        else
        {
            $return["html_message"] = 'Some Error Occured..Please try after some time..!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
    }    

    if ($valid_user == 1 && ( $user_data['registered_from'] == ''))
    {
        if ($user_data['status'] == 0)
            /***** Account is inactive. Redirect to login page with msg.*****/
        {
            $return["html_message"] = 'Account is not active. Try to contact admin.';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
        else if ($user_data['status'] == 1)/***** Account is Active. *****/
        {
           
            /***** Start of getting user details from db *****/
            $user_id = $user_data['id'];
            $user_name = $user_data['user_name'] ;
            $first_name = $user_data['name'];
            $member_level = $user_data['member_level'];
            $email = $user_data['email'];
            $is_member = $user_data['is_member'];
            $mobile = $user_data['mobile'];
            $user_type = $user_data['user_type'];
            $user_name_link = $user_data['user_name'];
            $profile_pic = $user_data['profile_pic'];
            if ($profile_pic == '')
            {
                $profile_pic_100 = $base_url_images . "default_profile.jpg";
                $profile_pic_450 = $base_url_images . "default_profile.jpg";
            }
            else
            {
                $profile_pic_100 = $base_url_uploads . "profile-pic/size_100/" . $profile_pic;
                $profile_pic_450 = $base_url_uploads . "profile-pic/size_450/" . $profile_pic;
            }


            $mobile_token_exp_date = $user_data['mobile_token_exp_date'];
            if ($mobile_token_exp_date > date('Y-m-d'))
            {
                $temp_user_data_array['mobile_access_token'] = $user_data['mobile_access_token'];
                $temp_user_data_array['mobile_token_exp_date'] = $user_data['mobile_token_exp_date'];
                $mobile_access_token = $user_data['mobile_access_token'];
                $mobile_token_exp_date = $user_data['mobile_token_exp_date'];
            }
            else
            {
                $mobile_access_token = random_code_long();
                $mobile_token_exp_date = date('Y-m-d', strtotime('+1 years'));
            }

            /***** End of getting user details from db. *****/


            /***** Setting all session variables. *****/
            if ($user_type == 1)/*admin*/
            {
                $_SESSION[$company_name_session . '_loggedin'] = 1;
            }
            else if ($user_type == 3)/*member*/
            {
                $_SESSION[$company_name_session . '_loggedin'] = 3;
            }
 

            $_SESSION['domain_link_' . $company_name_session] = $company_name_session;
            $_SESSION['user_is_member_' . $company_name_session] = $is_member;
            $_SESSION['user_member_level_' . $company_name_session] = $member_level;
            $_SESSION['user_id_' . $company_name_session] = $user_id;
            $_SESSION['user_email_' . $company_name_session] = $email;
            $_SESSION['name_' . $company_name_session] = $first_name;
            $_SESSION['user_name_' . $company_name_session] = $user_name;
            $_SESSION['mobile_' . $company_name_session] = $mobile;
            $_SESSION['user_name_link_' . $company_name_session] = $user_name_link;
            $_SESSION['user_type_' . $company_name_session] = $user_type;
            $_SESSION['mobile_access_token_' . $company_name_session] = $mobile_access_token;

            $_SESSION['profile_pic_100' . $company_name_session] = $profile_pic_100;
            $_SESSION['profile_pic_450' . $company_name_session] = $profile_pic_450;
            /***** End of setting all session variables. *****/

            /******* Store Cokies **********************/
            setcookie('user_id', $user_id, time()+ (86400 * 30),"/");
            setcookie('user_name',  $user_name, time()+ (86400 * 30),"/");
            setcookie('mobile', $mobile, time()+ (86400 * 30),"/");
            setcookie('user_type', $user_type, time()+ (86400 * 30),"/");
            setcookie('email', $email, time()+ (86400 * 30),"/");
             /***** Start of updating user last login time and date *****/
            $last_login = date('Y-m-d H:i:s');
            $module_user = "update brand_user set last_login='$last_login', mobile_access_token='$mobile_access_token',mobile_token_exp_date='$mobile_token_exp_date' where id='$user_id'";
            $result_user_query = mysqli_query($db_mysqli, $module_user);
            /***** End of updating user last login time and date *****/

            /* Move session cart product to database */
            
            $is_from_login_submit = 1;  
            
            
            if($user_type == 1) /***** User is admin *****/
            {
                $return["html_message"] = '';
                $return["status"] = "success";
                $return["page"] = "index";
                echo json_encode($return);
                exit();
            }
            else
            {
                $return["html_message"] = 'Oh snap! Some Error Occured..!';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }
            /***** End of checking user group and redirecting user  *****/
        }
        else if ($user_data['status'] == 2)/***** Account is block. Redirect to login page. *****/
        {
            $return["html_message"] = 'Account is Blocked..! Try to contact admin.';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
    }
    else
    {
        $return["html_message"] = 'Some Error Occured..Please try after some time..! ';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }
}
else
{
    $return["html_message"] = 'Some Error Occured..Please try after some time..! ';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}
?>