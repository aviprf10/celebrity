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
        $get_user_query = "select * from user where id='$edit_id' and is_deleted='0'";
        $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
        while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
        {
            $all_user_data_array[] = $row_get_user_query;
        }

        if (count($all_user_data_array) > 0)
        {
           
            $user_type  = 3;
            $first_name = Secure1($db_mysqli, $_POST['first_name']);
            $last_name  = Secure1($db_mysqli, $_POST['last_name']);
            $email      = Secure1($db_mysqli, $_POST['email']);
            $gender     = Secure1($db_mysqli, $_POST['gender']);
            $mobile     = Secure1($db_mysqli, $_POST['mobile']);
            $date_of_birthday   = Secure1($db_mysqli, $_POST['date_of_birthday']);
            $user_name       = $first_name.' '. $last_name;
            $updated_on   = get_current_date_time();
            $user_unique_slug = '';
            $user_unique_slug = get_unique_slug1($db_mysqli, $user_name, 'user', 'user_name');
            
            $check_user_email_data_array = array();
            $check_user_email_query = "select * from user where email='$email' AND id!='$edit_id'";
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
            $check_user_mobile_query = "select * from user where mobile='$mobile' AND id!='$edit_id'";
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

            $update_user_query = "update user set first_name='$first_name',last_name='$last_name',user_name='$user_name', user_unique_slug='$user_unique_slug',email='$email',gender='$gender',mobile='$mobile', dob='$date_of_birthday',profile_pic='$profile_pic',user_type='$user_type',status='1' where id='$edit_id'";
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
                    $return["html_message"] = 'User Updated Successfully!';;
                    $return["status"] = "success";
                    $return["update"] = 1;
                    echo json_encode($return);
                    exit();
                }
            }
        }
        else
        {
            $return["html_message"] = 'User address Does Not Exist.';
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