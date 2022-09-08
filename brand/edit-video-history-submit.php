<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($brand == 1)
{
   
    if (isset($_POST))
    {
       
        $edit_id          = Secure1($db_mysqli, $_POST['edit_id']);
        $brand_approved   = Secure1($db_mysqli, $_POST['brand_approved']);
        $created_on       = get_current_date_time();

        $get_videohistory_query = "select * from video_celebrity_history where id='$edit_id'";
        $result_get_videohistory_query = mysqli_query($db_mysqli, $get_videohistory_query);
        while ($row_get_videohistory_query = mysqli_fetch_assoc($result_get_videohistory_query))
        {
            $check_videohistory_data_array[] = $row_get_videohistory_query;
        }
        $celebrity_id = $check_videohistory_data_array[0]['celebrity_id'];
        $brand_post_id = $check_videohistory_data_array[0]['brand_post_id'];
        
        $get_brandpost_query = "select * from brand_post where id='$brand_post_id'";
        $result_get_brandpost_query = mysqli_query($db_mysqli, $get_brandpost_query);
        while ($row_get_brandpost_query = mysqli_fetch_assoc($result_get_brandpost_query))
        {
            $check_brandpost_data_array[] = $row_get_brandpost_query;
        }
        $price = $check_brandpost_data_array[0]['price'];

        $update_product_query = "update video_celebrity_history set brand_apporved='$brand_approved' where id='$edit_id'";
        $result_update_product_query = mysqli_query($db_mysqli, $update_product_query);
 
        $get_branduser_query = "select * from user where id='1'";
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

        $get_pyh_query = "select * from payment_history where brand_id='$loggedin_user_id' and celebrity_id='$celebrity_id' order by id DESC limit 1";
        $result_pyh_data = mysqli_query($db_mysqli,$get_pyh_query);
        while ($row_pyh_data = mysqli_fetch_assoc($result_pyh_data))
        {
            $pyh_data_array[] = $row_pyh_data;
        } 
        $createdamt = $pyh_data_array[0]['amount']+$price;


        $paymenthistory_cart = "INSERT INTO payment_history (celebrity_id,brand_id,created_amount,debit_amount,amount,payment_type,created_on,status) VALUES ('$celebrity_id','$loggedin_user_id','$price','0','$createdamt','Request','$created_on','3')";
        $update_paymenthistory_array = mysqli_query($db_mysqli, $paymenthistory_cart);


        $get_bpyh_query = "select * from brand_payment_history where brand_id='$loggedin_user_id' order by id DESC limit 1";
        $result_bpyh_data = mysqli_query($db_mysqli,$get_bpyh_query);
        while ($row_bpyh_data = mysqli_fetch_assoc($result_bpyh_data))
        {
            $bpyh_data_array[] = $row_bpyh_data;
        } 
        $bcreatedamt = $bpyh_data_array[0]['amount']+$price;

        $bpaymenthistory_cart = "INSERT INTO  brand_payment_history (admin_id,brand_id,created_amount,amount,payment_type,created_on,status) VALUES ('1','$loggedin_user_id','$price','$bcreatedamt','Request','$created_on','0')";
        $update_bpaymenthistory_array = mysqli_query($db_mysqli, $bpaymenthistory_cart);

        #send mail on brand user
        $email_array = array();
        $email_array['email'] = $check_branduser_data_array[0]['email'];
        $email_array['user_name'] = $check_branduser_data_array[0]['user_name'];
        $email_array['celebrty_name'] = $check_user_data_array[0]['user_name'];
        $email_array1['admin_approved'] = 'Approved By Brand';
        $email_array['email_type'] = 4;
        $email_sent_response = send_email($email_array);

        #send mail on celebrty user
        $email_array1 = array();
        $email_array1['email'] = $check_user_data_array[0]['email'];
        $email_array1['user_name'] = $check_user_data_array[0]['user_name'];
        $email_array1['brand_name'] = $loggedin_user_name;
        $email_array1['admin_approved'] = 'Approved By Brand';
        $email_array1['email_type'] = 5;
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