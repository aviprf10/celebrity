<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if(isset($_POST))
{
    
    if(isset($_POST['add_to_cart_valid']))
    {
        $celebrity_id = Secure1($db_mysqli,$_POST['celebrity_id']);
        
        $celebritydetails_data_array = array();
        $get_celebritydetails_query = "select * from celebrity_details where status='1' and is_deleted='0' and celebrity_id='$celebrity_id'";
        $result_celebritydetails_data = mysqli_query($db_mysqli,$get_celebritydetails_query);
        while ($row_celebritydetails_data = mysqli_fetch_assoc($result_celebritydetails_data))
        {
            $celebritydetails_data_array[] = $row_celebritydetails_data;
        }

        $celebrityprice_data_array = array();
        $get_celebrityprice_query = "select * from celebrity_price where  celebrity_id='$celebrity_id'";
        $result_celebrityprice_data = mysqli_query($db_mysqli,$get_celebrityprice_query);
        while ($row_celebrityprice_data = mysqli_fetch_assoc($result_celebrityprice_data))
        {
            $celebrityprice_data_array[] = $row_celebrityprice_data;
        } 

        $services_id = $celebrityprice_data_array[0]['services_id'];

        $celebritymessages_data_array = array();
        $get_celebritymessages_query = "select * from celebrity_messages where status='1' and is_deleted='0' and id='$services_id'";
        $result_celebritymessages_data = mysqli_query($db_mysqli,$get_celebritymessages_query);
        while ($row_celebritymessages_data = mysqli_fetch_assoc($result_celebritymessages_data))
        {
            $celebritymessages_data_array[] = $row_celebritymessages_data;
        } 

        $name = '';
        $occasion_id = $celebritymessages_data_array[0]['occasion_id'];
        $user_message = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '',$celebritymessages_data_array[0]['celebrity_message']);
        $date_of_delevery = '';
        $celebrity_price = $celebrityprice_data_array[0]['price'];
        $discount_type = $celebrityprice_data_array[0]['discount_type'];
        $discount = $celebrityprice_data_array[0]['discount'];
        $services_id = $celebrityprice_data_array[0]['services_id'];
        $message_id = $celebritymessages_data_array[0]['id'];
        $request_for = 'Recorded Video';
        $celebrity_price_id = $celebrityprice_data_array[0]['id'];
        $type_id = 'My Selef';
        $from_name = '';
        $instagramid='';
        
    }
    else 
    {
        $from_name = '';
        $service_arr = explode('-', $_POST['services_id']);
        $services_id = $service_arr[0];
        $name = Secure1($db_mysqli,$_POST["name_{$services_id}"]);
        $instagramid = Secure1($db_mysqli,$_POST["instagram_{$services_id}"]);
        $occasion_id = Secure1($db_mysqli,$_POST["occasion_id_{$services_id}"]);
        $date_of_delevery = Secure1($db_mysqli,$_POST["date_of_delevery_{$services_id}"]);
        $celebrity_id = Secure1($db_mysqli,$_POST["celebrity_id_{$services_id}"]);
        $user_message = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '',$_POST["user_message_{$services_id}"]);
        $message_id = Secure1($db_mysqli,$_POST["message_id_{$services_id}"]);
        if(isset($_POST["from_name_{$services_id}"]))
        {
            $from_name = Secure1($db_mysqli,$_POST["from_name_{$services_id}"]);;
        }
        $type_id = Secure1($db_mysqli,$_POST["type_id_{$services_id}"]);
        $request_for = $service_arr[1];
        $celebrity_price = $service_arr[2];
        $celebrity_price_id = $service_arr[3];
        
    }
    
	$celebrityprice_data_array = array();
    $get_celebrityprice_query = "select * from celebrity_price where id='$celebrity_price_id'";
    $result_get_celebrityprice_query = mysqli_query($db_mysqli, $get_celebrityprice_query);
    while ($row_get_celebrityprice_query = mysqli_fetch_assoc($result_get_celebrityprice_query))
    {
        $celebrityprice_data_array[] = $row_get_celebrityprice_query;
    }

    $discount_type = $celebrityprice_data_array[0]['discount_type'];
    $discount = $celebrityprice_data_array[0]['discount'];

    $userdt_data_array = array();
	$get_userdt_query = "select * from user where status='1' and is_deleted='0' and id='$celebrity_id'";
	$result_userdt_data = mysqli_query($db_mysqli,$get_userdt_query);
	while ($row_userdt_data = mysqli_fetch_assoc($result_userdt_data))
	{
	  $userdt_data_array[] = $row_userdt_data;
	} 
   
    $celebrity_images = $userdt_data_array[0]['profile_pic'];
	$add_cart = 0;
    $quantity_updated = 0;
    if($user == 1) // user is logged in
    {
        $cart_data_array = array();
        $get_user_cart_query = "select * from user_cart where user_id= '$loggedin_user_id'";
        $result_user_cart_data = mysqli_query($db_mysqli,$get_user_cart_query);
        while ($row_user_cart_data = mysqli_fetch_assoc($result_user_cart_data))
        {
            $cart_data_array[] = $row_user_cart_data;
        } 

        


        if(count($cart_data_array)>0)
        {
            $new_cart_array['name'] = $name;
            $new_cart_array['occasion_id'] = $occasion_id;
            $new_cart_array['date_of_delevery'] = $date_of_delevery;
            $new_cart_array['celebrity_id'] = $celebrity_id;
            $new_cart_array['celebrity_images'] = stripslashes($celebrity_images);
            $new_cart_array['price'] = stripslashes($celebrity_price);
            $new_cart_array['quantity'] = 1;
            $new_cart_array['user_message'] = stripslashes($user_message);
            $new_cart_array['message_id'] = stripslashes($message_id);
            $new_cart_array['request_for'] = stripslashes($request_for);
            $new_cart_array['celebrity_price_id'] = stripslashes($celebrity_price_id);
            $new_cart_array['services_id'] = stripslashes($services_id);
            $new_cart_array['discount_type'] = $discount_type;
            $new_cart_array['discount'] = $discount;
            $new_cart_array['from_name'] = $from_name;
            $new_cart_array['type_id'] = $type_id;
            $new_cart_array['instagramid']=$instagramid;

            $order_date = date('Y-m-d');
            $order_date_time = date('Y-m-d H:i:s');
            $update_user_cart_query = "update user_cart set name='$name',from_name='$from_name',type='$type_id',occasion_id='$occasion_id',date_of_delevery='$date_of_delevery', price='$celebrity_price', celebrity_id='$celebrity_id', discount_type='$discount_type',discount='$discount',user_message='$user_message', message_id='$message_id',request_for='$request_for',celebrity_price_id='$celebrity_price_id',services_id='$services_id',order_date='$order_date', order_date_time='$order_date_time', instagramid='$instagramid' where user_id='$loggedin_user_id' and celebrity_id='$celebrity_id'";
            $update_user_cart_data = mysqli_query($db_mysqli,$update_user_cart_query);
            if($update_user_cart_data)
            {
                $add_cart = 1;
            }

        }
        else
        {
            $new_cart_array['name'] = $name;
            $new_cart_array['occasion_id'] = $occasion_id;
            $new_cart_array['date_of_delevery'] = $date_of_delevery;
            $new_cart_array['celebrity_id'] = $celebrity_id;
            $new_cart_array['celebrity_images'] = stripslashes($celebrity_images);
            $new_cart_array['price'] = stripslashes($celebrity_price);
            $new_cart_array['quantity'] = 1;
            $new_cart_array['user_message'] = stripslashes($user_message);
            $new_cart_array['message_id'] = stripslashes($message_id);
            $new_cart_array['request_for'] = stripslashes($request_for);
            $new_cart_array['celebrity_price_id'] = stripslashes($celebrity_price_id);
            $new_cart_array['services_id'] = stripslashes($services_id);
            $new_cart_array['discount_type'] = $discount_type;
            $new_cart_array['discount'] = $discount;
            $new_cart_array['from_name'] = $from_name;
            $new_cart_array['type_id'] = $type_id;
            $new_cart_array['instagramid']=$instagramid;

            $order_date = date('Y-m-d');
            $order_date_time = date('Y-m-d H:i:s');
            $insert_user_cart_query = "INSERT INTO user_cart (user_id, name, from_name, type, occasion_id, date_of_delevery, price, celebrity_id,discount_type,discount,order_date,order_date_time,user_message,message_id,request_for,services_id,celebrity_price_id, instagramid) VALUES ('$loggedin_user_id','$name','$from_name', '$type_id','$occasion_id','$date_of_delevery','$celebrity_price','$celebrity_id','$discount_type','$discount','$order_date','$order_date_time','$user_message','$message_id','$request_for','$services_id','$celebrity_price_id', '$instagramid')";
            $return_cart_data = mysqli_query($db_mysqli,$insert_user_cart_query) or die(mysqli_error($db_mysqli));
            if($return_cart_data)
            {
                $add_cart = 1;
            }
        }

        if($add_cart == 1) /* if celebrity purchase is alreay in cart  */  
        {     
            $return["html_message"] = ' Celebrity added to cart.';
            include('common/cart.php');
            $return["status"] = "success";
            $return["total_cart_celebrity"] = $_SESSION['total_user_cart_data_'.$company_name_session];
            $return["total_cart_amount"] = $_SESSION['order_total_amount_'.$company_name_session];
            $return["total_cart_saving_amount"] = $_SESSION['save_total_amount_'.$company_name_session];
            $return["final_order_amount"] = $_SESSION['final_order_total_'.$company_name_session];
            $return["delete"] = 0;
            $return["add"] = 1;
            echo json_encode($return);
        }
        else 
        {
            $return["html_message"] = ' Some Error Occured! Please try again1.';
            $return["status"] = "error";
            echo json_encode($return);
        }
    } 
    else 
    {
        //print_r($_SESSION); exit;
        if(isset($_SESSION['cart_'.$company_name_session]) && (count($_SESSION['cart_'.$company_name_session])>0))
        { 
            foreach($_SESSION['cart_'.$company_name_session] as $key=>$value)
            {
                if($value['celebrity_id'] == $celebrity_id)
                {
                    $total_available_quantity = $total_available_quantity - $value['quantity'];
                    $total_celebrity_quantity = $value['quantity'] + 1;

                    $_SESSION['cart_'.$company_name_session][$key]['quantity'] = $value['quantity'] + 1;
                    $_SESSION['cart_'.$company_name_session][$key]['price'] = $celebrity_price;
                    $add_cart = 1;
                    $quantity_updated = 1;
                }
            } 
        }
        else 
        {
            $celebrityprice_data_array = array();
            $get_celebrityprice_query = "select * from celebrity_price where id='$celebrity_price_id'";
            $result_get_celebrityprice_query = mysqli_query($db_mysqli, $get_celebrityprice_query);
            while ($row_get_celebrityprice_query = mysqli_fetch_assoc($result_get_celebrityprice_query))
            {
                $celebrityprice_data_array[] = $row_get_celebrityprice_query;
            }

            
            $new_cart_array['name'] = $name;
            $new_cart_array['occasion_id'] = $occasion_id;
            $new_cart_array['date_of_delevery'] = $date_of_delevery;
            $new_cart_array['celebrity_id'] = $celebrity_id;
            $new_cart_array['celebrity_images'] = stripslashes($celebrity_images);
            $new_cart_array['price'] = stripslashes($celebrity_price);
            $new_cart_array['quantity'] = 1;
            $new_cart_array['user_message'] = stripslashes($user_message);
            $new_cart_array['message_id'] = stripslashes($message_id);
            $new_cart_array['request_for'] = stripslashes($request_for);
            $new_cart_array['celebrity_price_id'] = stripslashes($celebrity_price_id);
            $new_cart_array['services_id'] = stripslashes($services_id);
            $new_cart_array['discount_type'] = $discount_type;
            $new_cart_array['discount'] = $discount;
            $new_cart_array['from_name'] = $from_name;
            $new_cart_array['type_id'] = $type_id;
            $new_cart_array['instagramid']=$instagramid;
            
           
            
            $_SESSION['cart_'.$company_name_session][] = $new_cart_array;
            $add_cart = 1;
        }
        
        if($add_cart == 1) /* if celebrity purchase is alreay in cart  */  
        {     
            include('common/cart.php');
            $return["html_message"] = 'Product added to cart.';
            $return["status"] = "success";
            $return["total_cart_celebrity"] = $total_cart_celebrity;
            $return["total_cart_amount"] = $_SESSION['order_total_amount_'.$company_name_session];
            $return["total_cart_saving_amount"] = $_SESSION['save_total_amount_'.$company_name_session];
            $return["final_order_amount"] = $_SESSION['final_order_total_'.$company_name_session];
            $return["delete"] = 0;
            $return["add"] = 1;
            echo json_encode($return);
            exit();
        }
        else 
        {
            $return["html_message"] = ' Some Error Occured! Please try again.';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
    } // end of user is not logged in
}
else
{
   $return["html_message"] = 'Some Error Occured! Please try again.';
   $return["status"] = "error";
   echo json_encode($return);
   exit();
}
?>