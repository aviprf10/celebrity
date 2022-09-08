<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
	if(isset($_POST))
	{
        $order_id = Secure1($db_mysqli,$_POST['order_id']);
        $order_status = Secure1($db_mysqli,$_POST['order_status']);
        $date_of_delevery = Secure1($db_mysqli,$_POST['date_of_delevery']);
        $name = Secure1($db_mysqli,$_POST['name']);
        $cancel_order_reason = Secure1($db_mysqli,$_POST['cancel_order_reason']);
        $cancel_by_user = Secure1($db_mysqli,$_POST['cancel_by_user']);
        $updated_on = get_current_date_time();
        
        $update_user_order_query = "update user_order set date_of_delevery='$date_of_delevery',name='$name',order_status='$order_status',cancel_order_reason='$cancel_order_reason',cancel_by_user='$cancel_by_user',cancel_order_date='$updated_on',modified_on='$updated_on' where order_id='$order_id'";
        $result_update_user_order_query = mysqli_query($db_mysqli,$update_user_order_query);
        $affected_rows = mysqli_affected_rows($db_mysqli);
        
        if($result_update_user_order_query)
        {
            
            $edit_data_array = array();
            $get_user_order_query = "select uo.id, uo.name,uo.date_of_delevery,uo.user_message,uo.request_for,uo.price,o.occasion_title,uo.order_id, uo.order_date, uo.order_status,c.user_name as celebrity_name, c.email as celebrity_email, u.user_name, u.email, u.mobile, ci.celebrity_images, uo.cancel_order_reason, uo.cancel_by_user, c.profile_pic from user_order uo LEFT JOIN occasion o on uo.message_id = o.id LEFT JOIN user c on uo.celebrity_id = c.id LEFT JOIN celebrity_images ci on uo.celebrity_id=ci.celebrity_id LEFT JOIN user u on uo.user_id = u.id where uo.order_id='$order_id' and uo.is_deleted='0' group by order_id";
            $result_get_user_order_query = mysqli_query($db_mysqli, $get_user_order_query);
            while ($row_get_user_order_query = mysqli_fetch_assoc($result_get_user_order_query))
            {
                $edit_data_array[] = $row_get_user_order_query;
            }

            $email_array = array();
            $email_array['email'] = $edit_data_array[0]['email'];
            $email_array['user_name'] = $edit_data_array[0]['user_name'];
            $email_array['buyer_name'] = $edit_data_array[0]['user_name'];
            $email_array['order_id'] = $edit_data_array[0]['order_id'];
            $email_array['order_date_time'] = date('Y-m-d H:i:s');
            $email_array['date_of_delevery'] = $edit_data_array[0]['date_of_delevery'];
            $email_array['user_message'] = $edit_data_array[0]['user_message'];
            $email_array['request_for'] = $edit_data_array[0]['request_for'];
            $email_array['price'] = $edit_data_array[0]['price'];
            if($order_status == '6')
            {
                $email_array['order_status'] = 'Delivered';
                $email_array['cancel_order_reason']='';
            }
            else
            {
                $email_array['order_status'] = 'Rejected';
                $email_array['cancel_order_reason']=$cancel_order_reason;
            }
            $email_array['email_type'] = 5;
            $email_sent_response = send_email($email_array);
            

            $email_array = array();
            $email_array['email'] = $edit_data_array[0]['celebrity_email'];
            $email_array['user_name'] = $edit_data_array[0]['celebrity_name'];
            $email_array['buyer_name'] = $edit_data_array[0]['celebrity_name'];
            $email_array['order_id'] = $edit_data_array[0]['order_id'];
            $email_array['order_date_time'] = date('Y-m-d H:i:s');
            $email_array['date_of_delevery'] = $edit_data_array[0]['date_of_delevery'];
            $email_array['user_message'] = $edit_data_array[0]['user_message'];
            $email_array['request_for'] = $edit_data_array[0]['request_for'];
            $email_array['price'] = $edit_data_array[0]['price'];
            if($order_status == '6')
            {
                $email_array['order_status'] = 'Delivered By Super Admin';
                $email_array['cancel_order_reason']='';
            }
            else
            {
                $email_array['order_status'] = 'Rejected By Super Admin';
                $email_array['cancel_order_reason']=$cancel_order_reason;
            }
                
            $email_array['email_type'] = 6;
            $email_sent_response = send_email($email_array);
            $return["html_message"] = 'Order Updated Successfully.';
            $return["status"] = "success";
            $return["update"] = 1;
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