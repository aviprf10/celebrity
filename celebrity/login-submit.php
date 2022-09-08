<?php
session_start();
include('common/config.php');
error_reporting(0);
header('Content-type: application/json');
if (isset($_POST['email']))
{
    $email = Secure1($db_mysqli, lcfirst($_POST['email']));
    $password = Secure1($db_mysqli, $_POST['password']);

    $all_user_data_array = array();
    $get_user_query = "select * from user where email='$email' and user_type='2' and is_deleted='0'";
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

    if ($all_user_data_array[0]['status'] == 2) // If email id does not exist.
    {
        $return["html_message"] = '<div class="alert bg-danger">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
            <span class="text-semibold">Oh snap!</span> Your profile under progress please contect to admin.
        </div>';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }

    if (count($user_data) == 0) // If email id does not exist.
    {
        $return["html_message"] = '<div class="alert bg-danger">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
            <span class="text-semibold">Oh snap!</span> Email id does not exist.
        </div>';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }
    else
    {

        if ($user_data['email'] == $email && $user_data['password'] == $password)
        {
            if ($user_data['status'] == 0)
                /***** Account is inactive. Redirect to login page with msg.*****/
            {
                $return["html_message"] = '<div class="alert bg-danger">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">Oh snap!</span> Account is not active. Try to contact admin.
                    </div>';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }
            else if ($user_data['status'] == 1)
                /***** Account is Active. *****/
            {

                /***** Start of getting user details from db *****/
                $user_id = $user_data['id'];
                $first_name = $user_data['first_name'];
                $last_name = $user_data['last_name'];
                $user_name = $user_data['first_name'] . " " . $user_data['last_name'];
                $user_type = $user_data['user_type'];
                $mobile = $user_data['mobile'];
                $user_name_link = $user_data['user_unique_slug'];
                $theme_layout = $user_data['theme_layout'];
                $theme_color = $user_data['theme_color'];
                $side_menu_state = $user_data['side_menu_state'];
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
                if ($user_type == 2)/*member*/
                {
                    $_SESSION[$company_name_session . '_loggedin'] = 2;
                }


                $_SESSION['domain_link_' . $company_name_session] = $company_name_session;
                $_SESSION['user_id_' . $company_name_session] = $user_id;
                $_SESSION['user_email_' . $company_name_session] = $email;
                $_SESSION['first_name_' . $company_name_session] = $first_name;
                $_SESSION['last_name_' . $company_name_session] = $last_name;
                $_SESSION['user_name_' . $company_name_session] = $user_name;
                $_SESSION['mobile_' . $company_name_session] = $mobile;
                $_SESSION['user_name_link_' . $company_name_session] = $user_name_link;
                $_SESSION['user_type_' . $company_name_session] = $user_type;
                $_SESSION['mobile_access_token_' . $company_name_session] = $mobile_access_token;


                $_SESSION['profile_pic_100' . $company_name_session] = $profile_pic_100;
                $_SESSION['profile_pic_450' . $company_name_session] = $profile_pic_450;
                $_SESSION['theme_color' . $company_name_session] = $theme_color;
                $_SESSION['theme_layout' . $company_name_session] = $theme_layout;
                $_SESSION['side_menu_state' . $company_name_session] = $side_menu_state;
                /***** End of setting all session variables. *****/

                /***** Start of updating user last login time and date *****/
                $last_login = get_current_date_time();
                $update_user_query = "update user set mobile_access_token='$mobile_access_token',mobile_token_exp_date='$mobile_token_exp_date',
                                            last_login='$last_login' where id = '$user_id'";
                $result_update_user_query = mysqli_query($db_mysqli, $update_user_query);
                /***** End of updating user last login time and date *****/

                /***** Start of checking user group and redirecting user  *****/
                if ($user_type == 2)
                    /***** User is admin *****/
                {
                    $all_celebritydetails_data_array = array();
                    $get_celebritydetails_query = "select * from celebrity_details where celebrity_id='$user_id'";
                    $result_get_celebritydetails_query = mysqli_query($db_mysqli, $get_celebritydetails_query);
                    while ($row_get_celebritydetails_query = mysqli_fetch_assoc($result_get_celebritydetails_query))
                    {
                        $all_celebritydetails_data_array[] = $row_get_celebritydetails_query;
                    }

                    if(count($all_celebritydetails_data_array) > 0)
                    {
                        $return["html_message"] = '';
                        $return["status"] = "success";
                        $return["page"] = "profile-details";
                        echo json_encode($return);
                        exit();
                    }
                    else 
                    {
                        $return["html_message"] = '';
                        $return["status"] = "success";
                        $return["page"] = "profile-details";
                        echo json_encode($return);
                        exit();
                    }
                    
                }
                else
                {
                    $return["html_message"] = '<div class="alert bg-danger">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                            <span class="text-semibold">Oh snap!</span> Some Error Occured! Try again later.
                        </div>';
                    $return["status"] = "error";
                    echo json_encode($return);
                    exit();
                }
                /***** End of checking user group and redirecting user  *****/

            }
            else if ($user_data['status'] == 2)
                /***** Account is block. Redirect to login page. *****/
            {
//                $return["html_message"] = 'Account is blocked. Try to contact Admin.';
                $return["html_message"] = ' 
                    <div class="alert bg-danger">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">Oh snap!</span> Account is blocked. Try to contact Admin.
                    </div>';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }
        }
        else
        {
            $return["html_message"] = ' 
				<div class="alert bg-danger">
					<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">Oh snap!</span> Email id or password does not match..
				</div>';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }

    }
}
else // If Post is not set. 
{
    $return["html_message"] = 'Some Error Occured!.';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}
?>                              