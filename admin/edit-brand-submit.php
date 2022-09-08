<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $edit_id = Secure1($db_mysqli, $_POST['edit_id']);

        $all_user_data_array = array();
        $get_user_query = "select * from brand_user where id='$edit_id' and is_deleted='0'";
        $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
        while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
        {
            $all_user_data_array[] = $row_get_user_query;
        }

        if (count($all_user_data_array) > 0)
        {
            
            $name = Secure1($db_mysqli, $_POST['name']);
            $email = Secure1($db_mysqli, $_POST['email']);
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
            $logge_user_name 	 = str_replace('-', '_', $user_unique_slug);
            // if(empty($_POST['file_name1']))
            // {
            //     $return["html_message"] = 'Profile pic can not be blank?';
            //     $return["status"] = "error";
            //     echo json_encode($return);
            //     exit();
            // }
            $old_imagesname  = '../brand/uploads/profile-pic/temp_file/'.$_POST['file_name1'];
            $old_imagesname1 = '../brand/uploads/profile-pic/size_450/'.$_POST['file_name1'];
            $old_imagesname2 = '../brand/uploads/profile-pic/size_100/'.$_POST['file_name1'];
            $imge_arr = explode('.',$_POST['file_name1']);
            $new_imagesname = '../brand/uploads/profile-pic/temp_file/'.$logge_user_name.'_'.$edit_id.'_'.$date.'.'.$imge_arr[1];
            $new_imagesname1 = '../brand/uploads/profile-pic/size_450/'.$logge_user_name.'_'.$edit_id.'_'.$date.'.'.$imge_arr[1];
            $new_imagesname2 = '../brand/uploads/profile-pic/size_100/'.$logge_user_name.'_'.$edit_id.'_'.$date.'.'.$imge_arr[1];
            rename($old_imagesname ,$new_imagesname); 
            rename($old_imagesname1 ,$new_imagesname1); 
            rename($old_imagesname2 ,$new_imagesname2);   
            $profile_pic =  $logge_user_name.'_'.$edit_id.'_'.$date.'.'.$imge_arr[1];
            if ($_POST['status'] == 0)
            {
                $status = 0;
                $status_by = 'Admin';
            }
            else 
            {
                $status = $_POST['status'];
                $status_by = '';
            }
            

            $check_user_email_data_array = array();
            $check_user_email_query = "select * from brand_user where email='$email' AND id!='$edit_id'";
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
            $check_user_mobile_query = "select * from brand_user where mobile='$mobile' AND id!='$edit_id'";
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


            $update_user_query = "update brand_user set name='$name',user_name='$user_name', user_unique_slug='$user_unique_slug',email='$email',mobile='$mobile', profile_pic='$profile_pic',status='$status',status_by='$status_by',facebook_link='$facebook_link',twitter_link='$twitter_link',instagram_link='$instagram_link',whatsapp_link='$whatsapp_link',linkedin_link='$linkedin_link',google_link='$google_link', website_url='$website',description='$description' where id='$edit_id'";
            $result_update_user_query = mysqli_query($db_mysqli, $update_user_query);

            $affected_rows = mysqli_affected_rows($db_mysqli);
            if ($result_update_user_query)
            {

                if ($affected_rows == 0)
                {
                    $return["html_message"] = 'Nothing Updated by user.';
                    $return["status"] = "success";
                    echo json_encode($return);
                    exit();
                }
                else
                {
                    $return["html_message"] = 'Brand Updated Successfully!';;
                    $return["status"] = "success";
                    $return["update"] = 1;
                    echo json_encode($return);
                    exit();
                }
            }
        }
        else
        {
            $return["html_message"] = 'Brand address Does Not Exist.';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
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