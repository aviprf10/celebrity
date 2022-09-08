<?php
session_start();
include('common/config.php');
error_reporting(0);
header('Content-type: application/json');
if (isset($_POST['email']))
{
    $first_name = Secure1($db_mysqli, $_POST['first_name']);
    $last_name = Secure1($db_mysqli, $_POST['last_name']);
    $email = Secure1($db_mysqli, $_POST['email']);
    $password = Secure1($db_mysqli, $_POST['password']);
    $confirm_password = Secure1($db_mysqli, $_POST['confirm_password']);
    $gender = Secure1($db_mysqli, $_POST['gender']);
    $mobile = Secure1($db_mysqli, $_POST['mobile']);
    $date_of_birthday = Secure1($db_mysqli, $_POST['date_of_birthday']);
    $social_media = Secure1($db_mysqli, $_POST['social_media']);
    $user_name = $first_name.' '. $last_name;

    if(strpos($social_media, 'https://twitter.com/') !== false) {
        $twitter_link=$social_media;
    }

    if(strpos($social_media, 'https://www.facebook.com/') !== false) {
        $facebook_link=$social_media;
    }

    if(strpos($social_media, 'https://www.instagram.com/') !== false) {
        $instagram_link=$social_media;
    }

    if(strpos($social_media, 'https://web.whatsapp.com/') !== false) {
        $whatsapp_link=$social_media;
    }

    if(strpos($social_media, 'https://www.linkedin.com/') !== false) {
        $linkedin_link=$social_media;
    }

    $all_user_data_array = array();
    $get_user_query = "select * from user where email='$email'";
    $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
    while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
    {
        $all_user_data_array[] = $row_get_user_query;
    }
    
    if(count($all_user_data_array) > 0)
    {
        $return["html_message"] = 'Email id all ready register please try an other!.';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }

    $all_mobile_data_array = array();
    $get_mobile_query = "select * from user where  mobile='$mobile'";
    $result_get_mobile_query = mysqli_query($db_mysqli, $get_mobile_query);
    while ($row_get_mobile_query = mysqli_fetch_assoc($result_get_mobile_query))
    {
        $all_mobile_data_array[] = $row_get_mobile_query;
    }
    
    if(count($all_mobile_data_array) > 0)
    {
        $return["html_message"] = 'Mobile id all ready register please try an other!.';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }
    else 
    {
        if($password == $confirm_password)
        {
            $pass = $password;
            $date = get_current_date_time();
            $user_unique_slug = '';
            $user_unique_slug = get_unique_slug1($db_mysqli, $user_name, 'user', 'user_name');
            $unique_key = md5(uniqid(rand()));
            $ip_address = getUserIP();

            $insert_user_query = "INSERT INTO user (first_name,last_name,user_name, user_unique_slug,email,password,gender,mobile,dob,registration_date,user_type,unique_key,ip_address,created_on,status,facebook_link,twitter_link,instagram_link,whatsapp_link,linkedin_link) VALUES ('$first_name','$last_name', '$user_name', '$user_unique_slug','$email','$pass','$gender','$mobile','$date_of_birthday','$date','2','$unique_key','$ip_address','$date','2','$facebook_link','$twitter_link','$instagram_link','$whatsapp_link','$linkedin_link');";
            $result_insert_user_query = mysqli_query($db_mysqli, $insert_user_query);
            $user_id = mysqli_insert_id($db_mysqli);
            if ($result_insert_user_query) 
            {
                $email_array = array();
                $email_array['email'] = $email;
                $email_array['user_name'] = $user_name;
                $email_array['social_media_link'] = $master_settings_data_array;
                $email_array['unique_key'] = $unique_key;
                $email_array['email_type'] = 2;
                $email_sent_response = send_email($email_array);
                $email_sent_response = 1;

                $all_user_data_array = array();
                $get_user_query = "select * from user where id='$user_id' and user_type='2' and is_deleted='0'";
                $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
                while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
                {
                    $all_user_data_array[] = $row_get_user_query;
                }
                
                if (isset($all_user_data_array) && count($all_user_data_array) > 0)
                {
                    $user_data = $all_user_data_array[0];
                }

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

                $celebrity 								= 1;
                $user 									= 0;
                $_SESSION['next_url']					= '';
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
                
                $return["html_message"] = 'Celebrtiy User Submit Successfully.';
                $return["status"] = "success";
                echo json_encode($return);
                exit();
            } else {
                $return["html_message"] = 'Some Error Occured While adding Celebrtiy User';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }
        }
        else 
        {
            $return["html_message"] = 'Password and confirm password do not match please try again?';
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