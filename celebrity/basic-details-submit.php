<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($celebrity == 1)
{
    if (isset($_POST))
    {

        $edit_id = Secure1($db_mysqli, $_POST['edit_user_id']);
        //$edit_user_unique_slug = Secure1($db_mysqli, $_POST['edit_user_unique_slug']);
        $profilepic_data_array = array();
        $profilepic_query = "select * from user where id='$edit_id'";
        $result_profilepic_query = mysqli_query($db_mysqli, $profilepic_query);
        while ($row_profilepic_query = mysqli_fetch_assoc($result_profilepic_query))
        {
            $profilepic_data_array[] = $row_profilepic_query;
        }


        $first_name = Secure1($db_mysqli, $_POST['first_name']);
        $last_name = Secure1($db_mysqli, $_POST['last_name']);
        $user_name = $first_name . ' ' . $last_name;
        $user_unique_slug = get_unique_slug_edit1($db_mysqli, $user_name, 'user', 'user_unique_slug', $edit_id);
        $email = Secure1($db_mysqli, $_POST['email']);
        $mobile = Secure1($db_mysqli, $_POST['mobile']);
        $modified_on = get_current_date_time();
        $logge_user_name 	 = str_replace('-', '_', $user_unique_slug);
        $date = date('dmyhsi');
        $old_imagesname  = '../celebrity/uploads/profile-pic/temp_file/'.$profilepic_data_array[0]['profile_pic'];
        $old_imagesname1 = '../celebrity/uploads/profile-pic/size_450/'.$profilepic_data_array[0]['profile_pic'];
        $old_imagesname2 = '../celebrity/uploads/profile-pic/size_100/'.$profilepic_data_array[0]['profile_pic'];
        $imge_arr = explode('.',$profilepic_data_array[0]['profile_pic']);
        $new_imagesname = '../celebrity/uploads/profile-pic/temp_file/'.$logge_user_name.'_'.$edit_id.'_'.$date.'.'.$imge_arr[1];
        $new_imagesname1 = '../celebrity/uploads/profile-pic/size_450/'.$logge_user_name.'_'.$edit_id.'_'.$date.'.'.$imge_arr[1];
        $new_imagesname2 = '../celebrity/uploads/profile-pic/size_100/'.$logge_user_name.'_'.$edit_id.'_'.$date.'.'.$imge_arr[1];
        rename($old_imagesname ,$new_imagesname); 
        rename($old_imagesname1 ,$new_imagesname1); 
        rename($old_imagesname2 ,$new_imagesname2);   
        $profile_pic =  $logge_user_name.'_'.$edit_id.'_'.$date.'.'.$imge_arr[1];

        if (isset($_POST['status']))
        {
            $status = 1;
            $status_by = '';
        }
        else
        {
            $status = 0;
            $status_by = 'Celebrity';
        }

        if (isset($_POST['is_deleted']))
        {
            $is_deleted = 1;
        }
        else
        {
            $is_deleted = 0;
        }

        $get_user_email_query = "SELECT * FROM user WHERE email='$email' AND id!='$loggedin_user_id'";
        $result_get_user_email_query = mysqli_query($db_mysqli, $get_user_email_query);
        $all_user_email_data_array = array();
        while ($row_get_user_email_query = mysqli_fetch_assoc($result_get_user_email_query))
        {
            $all_user_email_data_array[] = $row_get_user_email_query;
        }


        if (count($all_user_email_data_array) > 0)
        {
            $return["html_message"] = 'User Already Exists With This Email id..!';
            $return["status"] = "error";
            echo json_encode($return);
        }
        else
        {
            $get_user_mobile_query = "SELECT * FROM user WHERE mobile='$mobile' AND id!='$loggedin_user_id'";

            $result_get_user_mobile_query = mysqli_query($db_mysqli, $get_user_mobile_query);
            $all_user_mobile_data_array = array();
            while ($row_get_user_mobile_query = mysqli_fetch_assoc($result_get_user_mobile_query))
            {
                $all_user_mobile_data_array[] = $row_get_user_mobile_query;
            }

            if (count($all_user_mobile_data_array) > 0)
            {
                $return["html_message"] = 'Mobile No. Already Exists..!Try Another.';
                $return["status"] = "error";
                echo json_encode($return);
            }
            else
            {
                $update_user_query = "update user set first_name='$first_name',last_name='$last_name',user_name='$user_name',user_unique_slug='$user_unique_slug',email='$email',mobile='$mobile',status='$status',status_by='$status_by',is_deleted='$is_deleted',updated_on='$modified_on', profile_pic='$profile_pic' where id='$edit_id'";

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
                        $return["html_message"] = 'Basic details updated successfully.';
                        if($status == 0)
                        {
                            $return["is_status"] = "1";
                        }
                        if($is_deleted == 0)
                        {
                            $return["is_deleted"] = "1";
                        }
                        $return["status"] = "success";
                        echo json_encode($return);
                    }
                }
                else
                {
                    $return["html_message"] = 'Some Error Occured! Please try again.';
                    $return["status"] = "error";
                    echo json_encode($return);
                }
            }
        }

    }
    else
    {
        $return["html_message"] = 'Some Error Occured! Please try again.';
        $return["status"] = "error";
        echo json_encode($return);
    }
}
else
{

    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>