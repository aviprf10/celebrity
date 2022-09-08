<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
   
    if (isset($_POST))
    {
       
        $edit_id          = Secure1($db_mysqli, $_POST['edit_id']);
        $admin_approved   = Secure1($db_mysqli, $_POST['admin_approved']);

        $get_videohistory_query = "select * from  video_celebrity_history where id='$edit_id'";
        $result_get_videohistory_query = mysqli_query($db_mysqli, $get_videohistory_query);
        while ($row_get_videohistory_query = mysqli_fetch_assoc($result_get_videohistory_query))
        {
            $check_videohistory_data_array[] = $row_get_videohistory_query;
        }
        $celebrity_id = $check_videohistory_data_array[0]['celebrity_id'];
        $brand_post_id = $check_videohistory_data_array[0]['brand_post_id'];

        $update_product_query = "update video_celebrity_history set 
        admin_approved='$admin_approved' where id='$edit_id'";
        $result_update_product_query = mysqli_query($db_mysqli, $update_product_query);

        $get_brandpost_query = "select * from brand_post where id='$brand_post_id'";
        $result_get_brandpost_query = mysqli_query($db_mysqli, $get_brandpost_query);
        while ($row_get_brandpost_query = mysqli_fetch_assoc($result_get_brandpost_query))
        {
            $check_brandpost_data_array[] = $row_get_brandpost_query;
        }

        $added_by = $check_brandpost_data_array[0]['added_by'];
        $get_branduser_query = "select * from brand_user where id='$added_by'";
        $result_get_branduser_query = mysqli_query($db_mysqli, $get_branduser_query);
        while ($row_get_branduser_query = mysqli_fetch_assoc($result_get_branduser_query))
        {
            $check_branduser_data_array[] = $row_get_branduser_query;
        }

        $get_user_query = "select * from user where id='$celebrity_id'";
        $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
        while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
        {
            $check_user_data_array[] = $row_get_user_query;
        }

        #send mail on brand user
        $email_array = array();
        $email_array['email'] = $check_branduser_data_array[0]['email'];
        $email_array['user_name'] = $check_branduser_data_array[0]['user_name'];
        $email_array['celebrty_name'] = $check_user_data_array[0]['user_name'];
        $email_array1['admin_approved'] = 'Approved By Admin';
        $email_array['email_type'] = 9;
        $email_sent_response = send_email($email_array);

        #send mail on celebrty user
        $email_array1 = array();
        $email_array1['email'] = $check_user_data_array[0]['email'];
        $email_array1['user_name'] = $check_user_data_array[0]['user_name'];
        $email_array1['brand_name'] = $check_branduser_data_array[0]['user_name'];
        $email_array1['admin_approved'] = 'Approved By Admin';
        $email_array1['email_type'] = 10;
        $email_sent_response1 = send_email($email_array1);

        $return["html_message"] = 'Response updated successfully.';
        $return["status"] = "success";
        echo json_encode($return);
        exit();
        
        
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
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url1 . 'logout">';
}
?>