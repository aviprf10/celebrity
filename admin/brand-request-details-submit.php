<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
   
    if (isset($_POST))
    {
       
        $edit_id         = Secure1($db_mysqli, $_POST['edit_id']);
        $request_type   = Secure1($db_mysqli, $_POST['request_type']);
        $rejct_reason   = $_POST['rejct_reason'];
        $celebrity_id = Secure1($db_mysqli, $_POST['celebrity_id']);
        $response_id= Secure1($db_mysqli, $_POST['response_id']);
        $created_on = get_current_date_time();
        if (isset($_POST['display_mailid']))
        {
            $display_mailid = 1;
        }
        else
        {
            $display_mailid = 0;
        }

        $status_by = $loggedin_user_id;
      
        $get_brandpost_title_query = "select * from brand_inquery_response where brand_id='$edit_id' and celebrity_id='$celebrity_id'";
        $result_get_brandpost_title_query = mysqli_query($db_mysqli, $get_brandpost_title_query);
        while ($row_get_brandpost_title_query = mysqli_fetch_assoc($result_get_brandpost_title_query))
        {
            $check_brandpost_title_data_array[] = $row_get_brandpost_title_query;
        }
        
        if (!empty($check_brandpost_title_data_array))
        {
            $get_brandpost_query = "select * from  brand_post_celebrty_list bpc left join brand_post bp on bpc.brand_post_id=bp.id where bpc.id='$edit_id'";
            $result_get_brandpost_query = mysqli_query($db_mysqli, $get_brandpost_query);
            while ($row_get_brandpost_query = mysqli_fetch_assoc($result_get_brandpost_query))
            {
                $check_brandpost_data_array[] = $row_get_brandpost_query;
            }
            $added_by = $check_brandpost_data_array[0]['added_by'];
            $brand_post_id = $check_brandpost_data_array[0]['brand_post_id'];

            $update_product_query = "update brand_inquery_response set 
            celebrity_id='$celebrity_id', brand_id='$brand_post_id', brand_post_celebrty_id='$edit_id',request_type='$request_type', rejct_reason='$rejct_reason', display_mailid='$display_mailid', updated_on='$created_on', status_by='$status_by' 
             where id='$response_id'";
            $result_update_product_query = mysqli_query($db_mysqli, $update_product_query);

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
            $email_array['brand_name'] = $check_brandpost_data_array[0]['title'];
            $email_array['celebrty_name'] = $check_user_data_array[0]['user_name'];
            if($display_mailid==1)
            {
                $email_array['celebrty_email'] = $check_user_data_array[0]['email'];
            }
            $email_array['request_type'] = $request_type;
            $email_array['rejct_reason'] = $rejct_reason;
            $email_array['email_type'] = 4;
            $email_sent_response = send_email($email_array);

            #send mail on celebrty user
            $email_array1 = array();
            $email_array1['email'] = $check_user_data_array[0]['email'];
            $email_array1['user_name'] = $check_user_data_array[0]['user_name'];
            $email_array1['brand_name'] = $check_brandpost_data_array[0]['title'];
            $email_array1['sort_description'] = $check_brandpost_data_array[0]['sort_description'];
            if($display_mailid==1)
            {
                $email_array1['celebrty_email'] = $check_user_data_array[0]['email'];
            }
            $email_array1['request_type'] = $request_type;
            $email_array1['rejct_reason'] = $rejct_reason;
            $email_array1['email_type'] = 7;
            $email_sent_response1 = send_email($email_array1);

            $email_array2 = array();
            $email_array2['email'] = $check_user_data_array[0]['email'];
            $email_array2['user_name'] = $check_user_data_array[0]['user_name'];
            $email_array2['web_access_token'] = $web_access_token;
            $email_array2['email_type'] = 8;
            $email_sent_response2 = send_email($email_array2);
            $return["html_message"] = 'Response updated successfully.';
            $return["status"] = "success";
            echo json_encode($return);
            exit();
        }
        else 
        {
            $get_brandpost_query = "select * from  brand_post_celebrty_list bpc left join brand_post bp on bpc.brand_post_id=bp.id where bpc.id='$edit_id'";
            $result_get_brandpost_query = mysqli_query($db_mysqli, $get_brandpost_query);
            while ($row_get_brandpost_query = mysqli_fetch_assoc($result_get_brandpost_query))
            {
                $check_brandpost_data_array[] = $row_get_brandpost_query;
            }
            $added_by = $check_brandpost_data_array[0]['added_by'];
            $brand_post_id = $check_brandpost_data_array[0]['brand_post_id'];

            $insert_brandpost_query = "INSERT INTO brand_inquery_response (celebrity_id, brand_id, brand_post_celebrty_id,request_type,rejct_reason, display_mailid, status_by, created_on) 
            VALUES ('$celebrity_id','$edit_id','$brand_post_id ','$request_type','$rejct_reason','$display_mailid','$status_by','$created_on')";
            $result_insert_brandpost_query = mysqli_query($db_mysqli, $insert_brandpost_query);
            $brand_inquery_response_id = mysqli_insert_id($db_mysqli);
            
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

            $web_access_token = md5(uniqid(rand()));
            $web_token_exp_date = date("Y-m-d");
            $insert_brandpost_query = "INSERT INTO video_celebrity_history (celebrity_id, brand_post_id,brand_inquery_response_id, web_access_token, web_token_exp_date, created_on) 
            VALUES ('$celebrity_id','$brand_post_id','$brand_inquery_response_id','$web_access_token','$web_token_exp_date', '$created_on')";
            $result_insert_brandpost_query = mysqli_query($db_mysqli, $insert_brandpost_query);


            #send mail on brand user
            $email_array = array();
            $email_array['email'] = $check_branduser_data_array[0]['email'];
            $email_array['user_name'] = $check_branduser_data_array[0]['user_name'];
            $email_array['brand_name'] = $check_brandpost_data_array[0]['title'];
            $email_array['celebrty_name'] = $check_user_data_array[0]['user_name'];
            if($display_mailid==1)
            {
                $email_array['celebrty_email'] = $check_user_data_array[0]['email'];
            }
            $email_array['request_type'] = $request_type;
            $email_array['rejct_reason'] = $rejct_reason;
            $email_array['email_type'] = 4;
            $email_sent_response = send_email($email_array);

            #send mail on celebrty user
            $email_array1 = array();
            $email_array1['email'] = $check_user_data_array[0]['email'];
            $email_array1['user_name'] = $check_user_data_array[0]['user_name'];
            $email_array1['brand_name'] = $check_brandpost_data_array[0]['title'];
            // $email_array1['sort_description'] = $check_brandpost_data_array[0]['sort_description'];
            // if($display_mailid==1)
            // {
            //     $email_array1['celebrty_email'] = $check_user_data_array[0]['email'];
            // }
            $email_array1['request_type'] = $request_type;
            $email_array1['rejct_reason'] = $rejct_reason;
            $email_array1['email_type'] = 7;
            $email_sent_response1 = send_email($email_array1);
            
            $email_array2 = array();
            $email_array2['email'] = $check_user_data_array[0]['email'];
            $email_array2['user_name'] = $check_user_data_array[0]['user_name'];
            $email_array2['web_access_token'] = $web_access_token;
            $email_array2['email_type'] = 8;
            $email_sent_response2 = send_email($email_array2);

            $return["html_message"] = 'Response added successfully.';
            $return["status"] = "success";
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
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url1 . 'logout">';
}
?>