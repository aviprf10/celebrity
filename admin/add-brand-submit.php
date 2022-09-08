<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if ($_POST)
    {
        
        $name = Secure1($db_mysqli, $_POST['name']);
        $email = Secure1($db_mysqli, $_POST['email']);
        $password = Secure1($db_mysqli, $_POST['password']);
        $confirm_password = Secure1($db_mysqli, $_POST['confirm_password']);
        $mobile = Secure1($db_mysqli, $_POST['mobile']);
        $social_media = Secure1($db_mysqli, $_POST['social_media']);
        $website = Secure1($db_mysqli, $_POST['website']);
        $description = Secure1($db_mysqli, $_POST['description']);
        $user_name = $name;
        $created_on   = get_current_date_time();
        $facebook_link   = $_POST['facebook_link'];
        $twitter_link   = $_POST['twitter_link'];
        $instagram_link   = $_POST['instagram_link'];
        $whatsapp_link   = $_POST['whatsapp_link'];
        $linkedin_link   = $_POST['linkedin_link'];
        $google_link   = $_POST['google_link'];
        
        $date = date('dmyhsi');
        $user_unique_slug = '';
        $user_unique_slug = get_unique_slug1($db_mysqli, $user_name, 'brand_user', 'user_name');
        $meta_title          = Secure1($db_mysqli, $_POST['meta_title']);
        $arr_search_keywords = $_POST['search_keywords'];
        $search_keywords     = implode(',', $arr_search_keywords);
        $meta_description    = Secure1($db_mysqli, $_POST['meta_description']);
        $logge_user_name 	 = str_replace('-', '_', $user_unique_slug);
        if(empty($_POST['file_name1']))
        {
            $return["html_message"] = 'Profile pic can not be blank?';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
        $old_imagesname  = '../brand/uploads/profile-pic/temp_file/'.$_POST['file_name1'];
        $old_imagesname1 = '../brand/uploads/profile-pic/size_450/'.$_POST['file_name1'];
        $old_imagesname2 = '../brand/uploads/profile-pic/size_100/'.$_POST['file_name1'];
        $imge_arr = explode('.',$_POST['file_name1']);
        $new_imagesname = '../brand/uploads/profile-pic/temp_file/'.$logge_user_name.'_'.$loggedin_user_id.'_'.$date.'.'.$imge_arr[1];
        $new_imagesname1 = '../brand/uploads/profile-pic/size_450/'.$logge_user_name.'_'.$loggedin_user_id.'_'.$date.'.'.$imge_arr[1];
        $new_imagesname2 = '../brand/uploads/profile-pic/size_100/'.$logge_user_name.'_'.$loggedin_user_id.'_'.$date.'.'.$imge_arr[1];
        rename($old_imagesname ,$new_imagesname); 
        rename($old_imagesname1 ,$new_imagesname1); 
        rename($old_imagesname2 ,$new_imagesname2);   
        $profile_pic =  $logge_user_name.'_'.$loggedin_user_id.'_'.$date.'.'.$imge_arr[1];
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        $check_user_email_data_array = array();
        $check_user_email_query = "select * from brand_user where email='$email'";
        $result_check_user_email_query = mysqli_query($db_mysqli, $check_user_email_query);
        while ($row_check_user_email_query = mysqli_fetch_assoc($result_check_user_email_query))
        {
            $check_user_email_data_array[] = $row_check_user_email_query;
        }

        if (count($check_user_email_data_array) > 0)
        {
            $return["html_message"] = 'Email Already Exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }

        $check_user_mobile_data_array = array();
        $check_user_mobile_query = "select * from brand_user where mobile='$mobile'";
        $result_check_user_mobile_query = mysqli_query($db_mysqli, $check_user_mobile_query);
        while ($row_check_user_mobile_query = mysqli_fetch_assoc($result_check_user_mobile_query))
        {
            $check_user_mobile_data_array[] = $row_check_user_mobile_query;
        }

        if (count($check_user_mobile_data_array) > 0)
        {
            $return["html_message"] = 'Mobile Number Already Exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }

        
        $created_on = date("Y-m-d H:i:s");
        $unique_key = md5(uniqid(rand()));
        $ip_address = getUserIP();
        $mobile_verify     =  1;
        $email_verify      =  1;
        $status            = 1;
           
        $insert_user_query = "insert into brand_user (`name`, `user_name`,`user_unique_slug`, `email`,`password`,`mobile`,`user_type`, `unique_key`,`ip_address`,`created_on`,`status` ,`mobile_verify`, `email_verify`, `registration_date`, `profile_pic`,`facebook_link`,`twitter_link`,`instagram_link`,`whatsapp_link`,`linkedin_link`,`google_link`,`website_url`,`description`) values('$name','$user_name','$user_unique_slug','$email','$password','$mobile','1','$unique_key','$ip_address','$created_on','$status', '$mobile_verify', '$email_verify', '$created_on',  '$profile_pic','$facebook_link','$twitter_link','$instagram_link','$whatsapp_link','$linkedin_link','$google_link','$website','$description')";
        $result_insert_user_query = mysqli_query($db_mysqli, $insert_user_query);
        if ($result_insert_user_query)
        {

            $return["html_message"] = 'Brand Added Successfully!';
            $return["status"] = "success";
            echo json_encode($return);
            exit();
        }
        else
        {
            $return["html_message"] = 'Some Error Occured While adding User address';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
//        }
    }
    else
    {
        $return["html_message"] = 'Some Error Occured! Please try again.';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }
}
else
{
    $return["html_message"] = 'Please login.';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}
?>