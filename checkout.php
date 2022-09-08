<?php
session_start();
include 'common/config.php';
include "common/check_login.php";
include 'common/common_code.php';
if ($user == 1 || $_POST['email'])
{
   
    if ($_POST)
    {
        //echo '<pre>'; print_r($_POST); exit;
        $users_id = $_GET['user_id'];
        $celebrity_id = $_GET['celebrity_id'];
        $get_user_query = "select * from user where status='1' and is_deleted='0' and id='$users_id'";
        $result_user_data = mysqli_query($db_mysqli,$get_user_query);
        while ($row_user_data = mysqli_fetch_assoc($result_user_data))
        {
            $getuser_data_array[] = $row_user_data;
        } 
        if(!isset($_SESSION))
        {
            session_start();
        }
        $admin = 0;
		$user = 1;
        $_SESSION['user_id_' . $company_name_session]= $getuser_data_array[0]['id'];
        $_SESSION['user_email_' . $company_name_session] = $getuser_data_array[0]['email'];
        $_SESSION['first_name_' . $company_name_session] = $getuser_data_array[0]['first_name'];
        $_SESSION['last_name_' . $company_name_session] = $getuser_data_array[0]['last_name'];
        $_SESSION['user_name_link_' . $company_name_session] = $getuser_data_array[0]['user_unique_slug'];
        $_SESSION['user_name_' . $company_name_session] = $getuser_data_array[0]['user_name'];
        $_SESSION['mobile_' . $company_name_session] = $getuser_data_array[0]['mobile'];
        $_SESSION['user_type_' . $company_name_session] = $getuser_data_array[0]['user_type'];
        $_SESSION['mobile_access_token_' . $company_name_session] = $getuser_data_array[0]['mobile_access_token'];
        $_SESSION['profile_pic_100' . $company_name_session] = $getuser_data_array[0]['profile_pic'];
        $_SESSION['profile_pic_450' . $company_name_session] = $getuser_data_array[0]['profile_pic'];
        
        $loggedin_user_id = $_SESSION['user_id_'.$company_name_session];
		$loggedin_user_email = $_SESSION['user_email_'.$company_name_session];
		$loggedin_user_first_name = $_SESSION['first_name_'.$company_name_session];
		$loggedin_user_last_name = $_SESSION['last_name_'.$company_name_session];
		$loggedin_user_name_link = $_SESSION['user_name_link_'.$company_name_session];
		$loggedin_user_name = $_SESSION['user_name_'.$company_name_session];
		$loggedin_user_mobile = $_SESSION['mobile_'.$company_name_session];
		$loggedin_user_type = $_SESSION['user_type_'.$company_name_session];
		$loggedin_user_mobile_access_token = $_SESSION['mobile_access_token_'.$company_name_session];
		$loggedin_user_total_user_cart_data = $_SESSION['total_user_cart_data_'.$company_name_session];
		$loggedin_user_profile_pic_100 = $_SESSION['profile_pic_100'.$company_name_session];
		$loggedin_user_profile_pic_450 = $_SESSION['profile_pic_450'.$company_name_session];
		$loggedin_user_is_compete = $_SESSION['is_compete'.$company_name_session];
       
        if($_POST['status'] =='success')
        {
            $get_cart_query = "select * from user_cart where celebrity_id='$celebrity_id' and user_id='$users_id'";
            $result_cart_data = mysqli_query($db_mysqli,$get_cart_query);
            while ($row_cart_data = mysqli_fetch_assoc($result_cart_data))
            {
                $cart_data_array1[] = $row_cart_data;
            } 
        }
        
       
        if ((isset($_POST['mihpayid'])) || (Secure1($db_mysqli, $_POST['mod_of_payment']) == '2'))
        {
            $flag = "false";
            $payment_id = 0;
            $mihpayid = '';
            if ($_POST['mihpayid'] != '')
            {
                $flag = "true";
                $mihpayid = $_POST['mihpayid'];
                $mode = $_POST['mode'];
                $status = $_POST['status'];
                $unmappedstatus = $_POST['unmappedstatus'];
                $key = $_POST['key'];
                $txnid = $_POST['txnid'];
                $amount = $_POST['amount'];
                $cardCategory = $_POST['cardCategory'];
                $discount = $_POST['discount'];
                $net_amount_debit = $_POST['net_amount_debit'];
                $addedon = $_POST['addedon'];
                $productinfo = $_POST['productinfo'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $address1 = $_POST['address1'];
                $address2 = $_POST['address2'];
                $city = $_POST['city'];
                $state = $_POST['state'];
                $country = $_POST['country'];
                $zipcode = $_POST['zipcode'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $udf1 = $_POST['udf1'];
                $udf2 = $_POST['udf2'];
                $udf3 = $_POST['udf3'];
                $udf4 = $_POST['udf4'];
                $udf5 = $_POST['udf5'];
                $udf6 = $_POST['udf6'];
                $udf7 = $_POST['udf7'];
                $udf8 = $_POST['udf8'];
                $udf9 = $_POST['udf9'];
                $udf10 = $_POST['udf10'];
                $hash = $_POST['hash'];
                $field1 = $_POST['field1'];
                $field2 = $_POST['field2'];
                $field3 = $_POST['field3'];
                $field4 = $_POST['field4'];
                $field5 = $_POST['field5'];
                $field6 = $_POST['field6'];
                $field7 = $_POST['field7'];
                $field8 = $_POST['field8'];
                $field9 = $_POST['field9'];
                $payment_source = $_POST['payment_source'];
                $PG_TYPE = $_POST['PG_TYPE'];
                $bank_ref_num = $_POST['bank_ref_num'];
                $bankcode = $_POST['bankcode'];
                $error = $_POST['error'];
                $error_Message = $_POST['error_Message'];
                $cardnum = $_POST['cardnum'];
                $cardhash = $_POST['cardhash'];
                $issuing_bank = $_POST['issuing_bank'];
                $card_type = $_POST['card_type'];
                $created_on = date('Y-m-d H:i:s');

                $insert_user_order_payment_query = "INSERT INTO user_order_payment_details (`mihpayid`, `mode`, `status`, `unmappedstatus`, `paymentkey`, `txnid`, `amount`, `cardCategory`, `discount`, `net_amount_debit`, `addedon`, `productinfo`, `firstname`, `lastname`, `address1`, `address2`, `city`, `state`, `country`, `zipcode`, `email`, `phone`, `udf1`, `udf2`, `udf3`, `udf4`, `udf5`, `udf6`, `udf7`, `udf8`, `udf9`, `udf10`, `hash`, `field1`, `field2`, `field3`, `field4`, `field5`, `field6`, `field7`, `field8`, `field9`, `payment_source`, `PG_TYPE`, `bank_ref_num`, `bankcode`, `error`, `error_Message`, `cardnum`, `cardhash`, `issuing_bank`, `card_type`, `created_on`) VALUES ('$mihpayid', '$mode', '$status', '$unmappedstatus', '$paymentkey', '$txnid', '$amount', '$cardCategory', '$discount', '$net_amount_debit', '$addedon', '$productinfo', '$firstname', '$lastname', '$address1', '$address2', '$city', '$state', '$country', '$zipcode', '$email', '$phone', '$udf1', '$udf2', '$udf3', '$udf4', '$udf5', '$udf6', '$udf7', '$udf8', '$udf9', '$udf10', '$hash', '$field1', '$field2', '$field3', '$field4', '$field5', '$field6', '$field7', '$field8', '$field9', '$payment_source', '$PG_TYPE', '$bank_ref_num', '$bankcode', '$error', '$error_Message', '$cardnum', '$cardhash', '$issuing_bank', '$card_type', '$created_on')"; 
                $user_order_payment_data_query = mysqli_query($db_mysqli, $insert_user_order_payment_query);
                $payment_id = mysqli_insert_id($db_mysqli);


            }
            else if ($_POST['mod_of_payment'] == '2')
            {
                $flag = "true";

            }

        }
    }
    $all_order_id = '';

   
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Checkout | <?php echo $company_title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:keyword" content="<?php echo $meta_keyword;?>" />
    <meta property="og:title" content="<?php echo $title;?>" />
     <meta property="og:description" content="<?php echo $meta_description;?>" />
    <meta name="robots" content="noindex, follow" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="32x32" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="<?php echo $base_url_images; ?>fevicon.png" />
    <meta name="msapplication-TileImage" content="<?php echo $base_url_images; ?>fevicon.png" />
    <?php include "common/header-css.php";?>
</head>
<body class="checkout-page">
   <div id="shopify-section-product-variants" class="shopify-section"></div>
   <?php include 'common/header.php';?>
   <main id="MainContent" style="overflow-y: hidden; margin-bottom: 240px;">
        <div class="collections js-collections pb-10">
            <div class="collection-header">
                <div class="collection-hero">
                    <div class="collection-hero__image"></div>
                    <div class="collection-hero__title-wrapper container">
                        <h1 class="collection-hero__title">Checkout</h1>
                        <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="<?php echo $base_url; ?>" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Checkout</span></div>
                    </div>
                </div>
            </div>
            <div class="container mt-10 mt-lg-25">
              <div class="col-md-12" style="float:left;">
                  <h2>Checkout</h2>
                  <div class="container">
              <?php
            
            if(!empty($cart_data_array1))
            {
            ?>
            <div id="response_message" style="margin-top: 20px;">
                <?php
                if (!empty($cart_data_array1))
                { 
                   
                    if (isset($mihpayid) || Secure1($db_mysqli, $_POST['mod_of_payment']) == '2')
                    {
                       
                        if ($flag == "true")
                        {
                           
                            if (!empty($cart_data_array1))
                            {
                                
                                $mod_of_payments = '';
                                if (isset($_POST['mihpayid'])) //from payment gateway
                                {
                                    $mod_of_payments = '1';
                                    
                                }
                                else if (Secure1($db_mysqli, $_POST['mod_of_payment']) == '2')
                                {
                                    $mod_of_payments = '2';
                                }

                                $all_user_cart_order = $cart_data_array1;
                                $user_cart_key_array = array();
                                $user_cart_key_array = array_keys($all_user_cart_order);
                                $order_id = random_code();
                                $total_sale_amount = 0;
                                $all_product_title = '';
                                $order_placed = 0;
                             
                                foreach ($all_user_cart_order as $user_cart_order)
                                {
                                    
                                    $cart_id = $user_cart_order['id'];
                                    $celebrity_id = $user_cart_order['celebrity_id'];
                                    $user_data_array = array();
                                    $get_user_query = "select * from user where status='1' and is_deleted='0' and id='$celebrity_id'";
                                    $result_user_data = mysqli_query($db_mysqli,$get_user_query);
                                    while ($row_user_data = mysqli_fetch_assoc($result_user_data))
                                    {
                                        $user_data_array[] = $row_user_data;
                                    } 

                                    $user_name = $user_data_array[0]['user_name'];
                                    $user_unique_slug = $user_data_array[0]['user_unique_slug'];
                                    
                                    $name = $user_cart_order['name'];
                                    $quantity = 1;
                                    $price = $user_cart_order['price'];
                                    $occasion_id = $user_cart_order['occasion_id'];
                                    $date_of_delevery = $user_cart_order['date_of_delevery'];
                                    $user_message = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '',$user_cart_order['user_message']);
                                    $message_id = $user_cart_order['message_id'];
                                    $request_for = $user_cart_order['request_for'];
                                    $services_id = $user_cart_order['services_id'];
                                    $celebrity_price_id = $user_cart_order['celebrity_price_id'];
                                    $discount_type = $user_cart_order['discount_type'];
                                    $discount = $user_cart_order['discount'];
                                    $from_name = $user_cart_order['from_name'];
                                    $type = $user_cart_order['type'];
                                    $instagramid = $user_cart_order['instagramid'];
                                    $is_coupon_apply = '0';
                                    $gst_percentage ='0';
                                    

                                    if ($quantity > 0)
                                    {

                                        if ($user_cart_order["discount_type"] == 'percentage')
                                        {
                                            $discount = $user_cart_order['price']*$user_cart_order["discount"];
                                            $total_discountt = $discount/100;
                                            $total_discount = $user_cart_order['price']-$total_discountt;
                                        }
                                        else if($user_cart_order["discount_type"] == 'price')
                                        {
                                            $total_discount = $user_cart_order['price']-$user_cart_order["discount"];
                                        }

                                        $coupon_code = '0';
                                        $coupon_discount = '0';
                                        $added_amount = '0';
                                        if ($user_cart_order["discount_type"] == 'percentage')
                                        {
                                            $is_coupon_apply = '1';
                                            $discount = $price*$user_cart_order["discount"];
                                            $coupon_discount += $discount/100;
                                        }
                                        else if($user_cart_order["discount_type"] == 'price')
                                        {
                                            $is_coupon_apply = '1';
                                            $coupon_discount += $user_cart_order["discount"];
                                        }
                                        $total_sale_amount = $total_sale_amount + ($price * $quantity);
                                        $all_product_title .= $user_name . ", ";
                                        $order_unique_key = md5(uniqid(rand()));
                                        $order_status = '0';
                                        $order_date = date('Y-m-d');
                                        $order_date_time = date('Y-m-d H:i:s');
                                        $order_status_timestamp_array = [$order_date_time, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                        $order_status_timestamp = implode(',', $order_status_timestamp_array);
                                        $insert_user_order_query = '';
                                        $insert_user_order_query = "INSERT INTO user_order (user_id,celebrity_id,name,from_name,type,date_of_delevery,user_message,message_id,request_for,services_id,celebrity_price_id,price,quantity,order_id,occasion_id,order_unique_key,order_status,order_date,order_date_time,order_status_timestamp, order_address_id,mod_of_payment,is_coupon_apply,discount_type,discount,total_discout_price,shipping_charges,gst_percentage,payu_payment_id,mihpayid,is_deleted,instagramid) VALUES ('$users_id','$celebrity_id','$name','$from_name','$type','$date_of_delevery','$user_message','$message_id','$request_for','$services_id','$celebrity_price_id','$price','$quantity','$order_id','$occasion_id','$order_unique_key','$order_status','$order_date','$order_date_time','$order_status_timestamp','1','$mod_of_payments','$is_coupon_apply','$discount_type','$discount','$coupon_discount','$local_shipping','$gst_percentage','$payment_id','$mihpayid','0','$instagramid')"; 
                                        $user_order_data_query = mysqli_query($db_mysqli, $insert_user_order_query);
                                        $order_placed = 1;
                                        $all_order_id  = 1;
                                        
                                        if ($order_placed == 1)
                                        {
                                            $get_pyh_query = "select * from payment_history where user_id='$users_id' and celebrity_id='$celebrity_id' order by id DESC limit 1";
                                            $result_pyh_data = mysqli_query($db_mysqli,$get_pyh_query);
                                            while ($row_pyh_data = mysqli_fetch_assoc($result_pyh_data))
                                            {
                                                $pyh_data_array[] = $row_pyh_data;
                                            } 
                                            $createdamt = $pyh_data_array[0]['amount']+$price;

                                            $paymenthistory_cart = "INSERT INTO payment_history (user_id,celebrity_id,brand_id,created_amount,debit_amount,amount,payment_type,created_on,status) VALUES ('$users_id','$celebrity_id','0','$price','0','$createdamt','Request','$created_on','0')";
                                            $update_paymenthistory_array = mysqli_query($db_mysqli, $paymenthistory_cart);

                                            $user_cart = "delete from user_cart where user_id='$users_id' and id='$cart_id'";
                                            $update_user_cart_array = mysqli_query($db_mysqli, $user_cart);
                                        }
                                    }
                                }
                                $sale_amount = $total_sale_amount - $temp_user_wallet_amount;
                                $product = $all_product_title;
                               
                                if ($all_order_id != '' && $order_placed == 1)
                                {
                                   
                                    if ($_POST['mod_of_payment'] == '2') // cash on delivery
                                    {

                                    }
                                    else
                                    {
                                        
                                    }

                                    

                                    $buyer_name  = $getuser_data_array[0]['first_name'] . " " . $getuser_data_array[0]['last_name'];
                                    $buyer_email = $getuser_data_array[0]['email'];
                                    
                                    /* Send mail to buyer */
                                    $email_array = array();
                                    $email_array['base_url'] = $base_url;
                                    $email_array['email'] = $buyer_email;
                                    $email_array['user_name'] = $buyer_name;
                                    $email_array['buyer_name'] = $buyer_name;
                                    $email_array['order_id'] = $order_id;
                                    $email_array['order_date_time'] = date('Y-m-d H:i:s');
                                    $email_array['date_of_delevery'] = $date_of_delevery;
                                    $email_array['user_message'] = $user_message;
                                    $email_array['request_for'] = $request_for;
                                    $email_array['price'] = $total_discount;
                                    $email_array['email_type'] = 3;
                                    $email_sent_response = send_email($email_array);

                                    /* Send mail to celebrty */
                                    $email_array1 = array();
                                    $email_array1['base_url'] = $base_url;
                                    $email_array1['email'] = $user_data_array[0]['email'];
                                    $email_array1['user_name'] = $user_data_array[0]['user_name'];
                                    $email_array1['buyer_name'] = $buyer_name;
                                    $email_array1['order_id'] = $order_id;
                                    $email_array1['order_date_time'] = date('Y-m-d H:i:s');
                                    $email_array1['date_of_delevery'] = $date_of_delevery;
                                    $email_array1['user_message'] = $user_message;
                                    $email_array1['request_for'] = $request_for;
                                    $email_array1['price'] = $total_discount;
                                    $email_array1['instagramid'] = $instagramid;
                                    $email_array1['email_type'] = 4;
                                    $email_sent_response1 = send_email($email_array1);

                                }
                                    
                                
                                
                            }
                        }
                        else if ($flag == "false")
                        {
                            $transaction_failer_message = '
                             <div class="alert alert-danger alert-dismissable">
                               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                               <i class="fa fa-ban-circle"></i><a class="alert-link"> Error While Placing your Order.</a>Please try again.
                             </div>';
                        }
                        /*else if($flag == "false" && $_POST['mod_of_payment'] == '2')
                        {
                           $transaction_failer_message = '
                           <div class="alert alert-danger alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <i class="fa fa-ban-circle"></i><a href="#" class="alert-link"> Error While Placing your Order.</a>Please try again.
                           </div>';
                        }*/
                      
                        unset($_POST);
                        if ($flag == "false")
                        {
                            echo $transaction_failer_message;
                        }
                        else if ($all_order_id != '' && $order_placed == 1)
                        { 
                           
                            ?>
                            <br>
                            <br>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
                                <tbody>
                                <tr>
                                    <td align="center" valign="top" style="padding-right:10px;padding-left:10px" id="bodyCell">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperTable" style="max-width:600px">
                                            <tbody>
                                            <tr>
                                                <td align="center" valign="top">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="oneColumn"
                                                           style="background-color: rgb(255, 255, 255); box-shadow: rgb(216, 216, 216) 0px 0px 10px;">
                                                        <tbody>
                                                        <tr>
                                                            <td style="background-color:#88be4c;font-size:1px;line-height:29px; border-radius: 10px 10px 0px 0px;" class="topBorder" height="3">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" valign="top" class="imgHero" style="padding-bottom: 40px;"><a href="#" style="text-decoration:none" target="_blank">
                                                            <img alt="" border="0" mc:edit="heroImg" src="<?php echo $base_url_images; ?>order.png" style="width:100%;max-width:600px;height:auto;display:block" width="600"></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" valign="top" class="title" style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;">
                                                                <h2 class="bigTitle" mc:edit="title"
                                                                    style="color:#313131;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:26px;font-weight:600;font-style:normal;letter-spacing:normal;line-height:34px;text-align:center;padding:0;margin:0">
                                                                    Order Confirmation</h2>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" valign="top" class="subTitle" style="padding-bottom: 20px; padding-left: 20px; padding-right: 20px;">
                                                                <h4 class="midTitle" mc:edit="subTitle"
                                                                    style="color:#919191;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:26px;text-align:center;padding:0;margin:0">
                                                                    Order ID #<?php echo $order_id; ?> | Date <?php echo date('d-M-Y H:i', strtotime($order_date_time)); ?></h4>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td align="center" valign="top" class="productName" style="padding-bottom:10px;padding-left:20px;padding-right:20px">
                                                                <p class="midTitle" mc:edit="productName"
                                                                   style="color:#313131;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:26px;text-align:center;padding:0;margin:0">
                                                                    Thank You For Placing Order On <?php echo $company_title; ?>.</p>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td align="center" valign="top" class="infoTitle" style="padding-bottom:5px;padding-left:20px;padding-right:20px">
                                                                <p class="midTitle" mc:edit="infoTitle"
                                                                   style="color:#313131;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:24px;text-align:center;padding:0;margin:0">
                                                                    Delivery Address :</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" valign="top" class="address" style="padding-bottom: 10px; padding-left: 20px; padding-right: 20px;">
                                                                <p class="midText" mc:edit="address"
                                                                   style="color:#919191;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:22px;text-align:center;padding:0;margin:0"><?php echo $shipping_address; ?></p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" valign="top" class="btnCard" style="padding-bottom:5px;padding-left:20px;padding-right:20px">
                                                                <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td align="center"
                                                                            style="background-color:#88be4c;border-radius:2px">
                                                                            <a href="<?php echo $base_url; ?>my-order"
                                                                               style="color:#fff;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:12px;font-weight:600;letter-spacing:1px;line-height:20px;text-transform:uppercase;text-decoration:none;display:block;padding-top:10px;padding-bottom:10px;padding-left:25px;padding-right:25px;">Manage
                                                                                Orders</a></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td style="font-size:1px;line-height:1px" height="10">&nbsp;</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
                                                        <tbody>
                                                        <tr>
                                                            <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <?php
                            $cart_data_array1 = array();
                            $order_total_amount = 0;
                            $save_total_amount = 0;
                            $discount = 0;
                            $final_order_total = 0;
                            $_SESSION['total_user_cart_data_' . $company_name_session] = 0;
                            if($user!=1)
                            {
                                session_destroy(); 
                            } 
                            ?>
                            <script src="<?php echo $base_url; ?>admin/assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
                            <script type="text/javascript">
                                $('#header_cart_total_count').html('0');
                                $('#header_cart_total_amount').html('<?php echo $selected_currency_icon; ?> 0');
                                $('#checkout_order_sub_total').html('<?php echo $selected_currency_icon; ?> 0');

                                $('#checkout_order_saving_total').html('<?php echo $selected_currency_icon; ?> 0');
                                //$('#checkout_order_shipping').html("-");
                                //$('#checkout_order_total').html('<?php echo $selected_currency_icon; ?> 0');


                                $('#checkout_order_shipping').html('<?php echo $selected_currency_icon; ?> 0');
                                $('#checkout_discount_total').html('<?php echo $selected_currency_icon; ?> 0');
                                $('#checkout_qty_discount_total').html('<?php echo $selected_currency_icon; ?> 0');

                                $('#checkout_final_order_total').html('<?php echo $selected_currency_icon; ?> 0');

                                $('#checkout_form').trigger("reset");
                                $('#checkout_form').css({"display": "none"});
                            </script>
                            <?php
                        }
                    }
                    else if ($_POST['status'] == 'failure')
                    {
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="fa fa-ban-circle"></i><a class="alert-link"> Thank you for shopping with us.However,the transaction has been declined.</a>Please try again.
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <br>
            <?php
            if ($all_order_id == '')
            {  
               
                ?>
                <form class="panel-default" role="form" id="checkout_form" method="POST" data-parsley-validate action="<?php echo $base_url; ?>place-order">
                    <div class="row">
                         <div class="col-md-4 col-sm-6" id="content" >
                            <div class="page-content" style="border: 1px solid #dee2e6;  padding: 12px;">
                                <div class="woocommerce">
                                <div class="step-title"><h3 class="one_page_heading m-0"> Name & Address</h3>
                                        </div>
                                        <br/>
                                    <div class="buttons clearfix">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="control-label">First Name: <span class="asterisk-mark">*</span></label>
                                                    <input type="hidden" name="tid" id="tid" readonly/>
                                                    <input name="first_name" id="first_name" type="text" value="<?php echo $loggedin_user_first_name; ?>"  class="woocommerce-Input woocommerce-Input--text input-text line-height-1 readonly" data-parsley-required="true" <?php echo $is_disable; ?>>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="control-label">Last Name: <span class="asterisk-mark">*</span></label>
                                                    <input name="last_name" id="last_name" type="text" value="<?php echo $loggedin_user_last_name; ?>" class="woocommerce-Input woocommerce-Input--text input-text line-height-1 readonly"
                                                        data-parsley-required="true" <?php echo $is_disable; ?>>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="control-label">Email: <span class="asterisk-mark">*</span></label>
                                                    <input name="email" id="email" type="text" value="<?php echo $loggedin_user_email; ?>" class="woocommerce-Input woocommerce-Input--text input-text line-height-1 readonly"  <?php echo $is_disable; ?>>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="control-label">Mobile No: <span class="asterisk-mark">*</span></label>
                                                    <input type="text" name="mobile" id="mobile" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" maxlength="10" minlength="10"
                                                        value="<?php echo $loggedin_user_mobile; ?>" data-parsley-type="integer" data-parsley-required="true"
                                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                </div>
                                            </div>
                                        </div>
        
                                            <!-- <div id="select_address_dropdown_div">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <label class="control-label">Select Address Option: <span class="asterisk-mark">*</span></label>
                                                            <select name="address_id" id="address_id" data-placeholder="Select Address" class="" onchange="select_shipping_address(this.value)" data-parsley-required="true">
                                                                <option value="">Select Address</option>
                                                                <option value="00">Create New Address</option>
                                                                <?php
                                                                if (count($user_address_data_array) > 0)
                                                                {
                                                                    foreach ($user_address_data_array as $user_address_data)
                                                                    {
                                                                        if ($user_address_data['address1'] != '' && isset($user_address_data['address1']))
                                                                        {
                                                                            ?>
                                                                            <option value="<?php echo $user_address_data['id']; ?>"
                                                                                <?php
                                                                                if ($temp_cart_data_array[0]['address_id'] == $user_address_data['id'])
                                                                                {
                                                                                    echo "selected";
                                                                                }
                                                                                ?>>
                                                                                <?php echo $user_address_data['address1'] . " - " . $user_address_data['pincode']; ?>
                                                                            </option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="selected_address_div">
                                                    <?php
                                                    if ($temp_cart_data_array[0]['address_id'])
                                                    {
                                                        $address_id = $temp_cart_data_array[0]['address_id'];
                                                        $check_user_address_data_array = array();
                                                        $get_user_address_data = "select  uad.*,c.id as c_id,c.city_name,s.id as s_id,s.state_name,cy.id as cy_id,cy.country_name FROM user_address uad LEFT JOIN cities c on uad.city_id=c.id LEFT JOIN states s on uad.state_id=s.id LEFT JOIN country cy on uad.country_id=cy.id WHERE  uad.id = '$address_id'  AND uad.user_id = '$loggedin_user_id'  AND uad.status = '1'  AND uad.is_deleted = '0'";
                                                        $result_user_address_data = mysqli_query($db_mysqli, $get_user_address_data);
                                                        while ($row_user_address_data = mysqli_fetch_assoc($result_user_address_data))
                                                        {
                                                            $check_user_address_data_array[] = $row_user_address_data;
                                                        }
                                                        if (count($check_user_address_data_array) > 0)
                                                        {
                                                            $user_address_data = $check_user_address_data_array[0];

                                                    ?>
                                                    <div class="woocommerce">
                                                    <div class="step-title"><h3 class="one_page_heading m-0">Shipping Address<a onclick="modal_edit_address('<?php echo $user_address_data['id']; ?>')"><i
                                                            class="pull-right fa fa-pencil" style="padding-top:5px;color:#ff0000;"></i></a></h3>
                                                            </div>
                                                            <br/> 
                                                                <div class="checkout-box-border">
                                                                    
                                                                    <div class="panel-body pd-0 border-15" id="address_<?php echo $user_address_data['id']; ?>">

                                                                        <table class="table table-borderless table-xs content-group-sm order-detail" id="address_table">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td><b>First Name:</b></td>
                                                                                <td id="checkout_order_sub_total"><?php echo $user_address_data['first_name']; ?></td>
                                                                                <input type="hidden" name="first_name" id="first_name" value="<?php echo $user_address_data['first_name']; ?>">
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Last Name:</b></td>
                                                                                <td id="checkout_order_sub_total"><?php echo $user_address_data['last_name']; ?></td>
                                                                                <input type="hidden" name="last_name" id="last_name" value="<?php echo $user_address_data['last_name']; ?>">
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>company:</b></td>
                                                                                <td id="checkout_order_sub_total"><?php echo $user_address_data['company']; ?></td>
                                                                                <input type="hidden" name="company" id="company" value="<?php echo $user_address_data['company']; ?>">
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Mobile:</b></td>
                                                                                <td id="checkout_order_saving_total"><?php echo $user_address_data['mobile']; ?></td>
                                                                                <input type="hidden" name="mobile" id="mobile" value="<?php echo $user_address_data['mobile']; ?>">
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Address1:</b></td>
                                                                                <td id="checkout_order_sub_total"><?php echo $user_address_data['address1']; ?></td>
                                                                                <input type="hidden" name="address1" id="address1" value="<?php echo $user_address_data['address1']; ?>">
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Address2:</b></td>
                                                                                <td id="checkout_order_saving_total"><?php echo $user_address_data['address2']; ?></td>
                                                                                <input type="hidden" name="address1" id="address1" value="<?php echo $user_address_data['address2']; ?>">
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Pincode:</b></td>
                                                                                <td id="checkout_discount_total"><?php echo $user_address_data['pincode']; ?></td>
                                                                                <input type="hidden" name="pincode" id="pincode" value="<?php echo $user_address_data['pincode']; ?>">
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>City:</b></td>
                                                                                <td id="checkout_qty_discount_total"><?php echo $user_address_data['city_name']; ?></td>
                                                                                <input type="hidden" name="city_name" id="city_name" value="<?php echo $user_address_data['city_name']; ?>">
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b> State:</b></td>
                                                                                <td id="checkout_order_shipping"><?php echo $user_address_data['state_name']; ?></td>
                                                                                <input type="hidden" name="state_name" id="state_name" value="<?php echo $user_address_data['state_name']; ?>">
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Country:</b></td>
                                                                                <td id="checkout_final_order_total"><?php echo $user_address_data['country_name']; ?></td>
                                                                                <input type="hidden" name="country_name" id="country_name" value="<?php echo $user_address_data['country_name']; ?>">
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                            </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6" id="content">
                            <div class="page-content"   style="border: 1px solid #dee2e6;  padding: 12px;">
                                <div class="woocommerce">
                                <div class="step-title"><h3 class="one_page_heading m-0">Mode Of Payment</h3>
                                        </div>
                                        <br/>
                                    <div class="buttons clearfix">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="control-label">Mode Of Payment <span class="asterisk-mark">*</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group" style="margin-bottom: 0px;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                <span class="radio custom-radio">
                                                <input type="radio" name="mod_of_payment" id="mode_of_payment1" value="1" style="background: none;margin-left: 0;width: auto;border: none;min-height: 16px;" data-parsley-multiple="mod_of_payment">
                                                <label for="mode_of_payment1">&nbsp;&nbsp;Online</label>
                                                </span>
                                            </div>
                                            </div>
                                        </div> -->
                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="customRadio clearfix">
                                                        <input type="radio" name="mod_of_payment" id="formcheckoutRadio1" value="1"  checked="" class="radio"> 
                                                        <label for="formcheckoutRadio1">Online</label>
                                                    </div> 
                                                    <!-- <div class="customRadio clearfix">
                                                        <input type="radio" name="mod_of_payment" id="formcheckoutRadio2" value="2"  checked="" class="radio"> 
                                                        <label for="formcheckoutRadio2">Cash On Delivery</label>
                                                    </div> -->
                                                    <!-- <span class="radio custom-radio">
                                                        <input type="radio" name="mod_of_payment" id="mode_of_payment2" value="2"  checked="" style="background: none;margin-left: 0;width: auto;border: none;min-height: 16px;" data-parsley-multiple="mod_of_payment">
                                                        <label for="mode_of_payment2">&nbsp;&nbsp;Cash On Delivery</label>
                                                    </span> -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="row">
                                                    <div class="col-xs-8 col-sm-12 col-md-7">
                                                    <label class="control-label">Coupon Codes: </label>
                                                    <input name="coupon_code" id="coupon_code" type="text" value="<?php echo $all_coupon_data_array[$coupon_id]['coupon_code']; ?>" class="woocommerce-Input woocommerce-Input--text input-text line-height-1">
                                                </div>
                                                <div class="col-xs-4 col-sm-12 col-md-5">
                                                    <button type="button" class="btn btn-theme" title="Apply" style="float:left;margin-top: 33px;height:37px;" 
                                                            onclick="coupon_code_submit()">
                                                    <span>
                                                        <span style="text-transform: none !important;" id="apply_coupon_button_text">
                                                            <?php
                                                            if ($total_discount > 0)
                                                            {
                                                                ?>
                                                                Remove
                                                                <input type="hidden" value="1" id="coupon_applied" name="coupon_applied">
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                Apply
                                                                <input type="hidden" value="0" id="coupon_applied" name="coupon_applied">
                                                                <?php
                                                            }
                                                            ?>
                                                        </span>
                                                    </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                </div>
                                </div>
                                <div class="col-md-4 col-sm-6" id="content">
                            <div class="page-content">
                                <div class="woocommerce">
                                <div class="step-title"><h3 class="one_page_heading m-0">Order Details</h3>
                                        </div>
                                        <br/>
                                    <div class="buttons clearfix">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td><i class="icon-alarm-check position-left"></i> SubTotal:</td>
                                                    <td class="text-right"
                                                        id="checkout_order_sub_total"><?php echo $selected_currency_icon; ?><?php echo $order_total_amount; ?></td>
                                                </tr>
                                                <!-- <tr>
                                                    <td><i class="icon-history position-left"></i> Saving Total:</td>
                                                    <td class="text-right"
                                                        id="checkout_order_saving_total"><?php echo $selected_currency_icon; ?><?php echo $save_total_amount; ?></td>
                                                </tr> -->
                                                <tr>
                                                    <td><i class="icon-file-plus position-left"></i>Discount:</td>
                                                    <td class="text-right"
                                                        id="checkout_discount_total"><?php echo $selected_currency_icon; ?><?php echo $total_discount; ?></td>
                                                </tr>
                                                <!-- <tr>
                                                    <td><i class="icon-file-plus position-left"></i> Shipping:</td>
                                                    <td class="text-right" id="checkout_order_shipping"><?php
                                                        // if (($local_shipping > 0) && ($local_shipping != ''))
                                                        // {
                                                        //     echo $selected_currency_icon . " " . $local_shipping;
                                                        // }
                                                        // else
                                                        // {
                                                        //     echo "Free";
                                                        // }
                                                        ?></td>
                                                </tr> -->
                                                <tr>
                                                    <td><i class="icon-file-check position-left"></i> Order Total:</td>
                                                    <td class="text-right"
                                                        id="checkout_final_order_total"><?php echo $selected_currency_icon; ?><?php echo $final_order_total; ?></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="submit" name="submit" title="Proceed" class="btn btn-theme" style="width: 100%;">
                                        <span>
                                        <span style="text-transform: none !important;">
                                        Proceed</span>
                                        </span>
                                        </button>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </form>
             
                <?php
            }
            ?>
            <?php
        }
        else
        {
            $users_id = $_GET['user_id'];
            $celebrity_id = $_GET['celebrity_id'];
            $get_user_query = "select * from user where status='1' and is_deleted='0' and id='$users_id'";
            $result_user_data = mysqli_query($db_mysqli,$get_user_query);
            while ($row_user_data = mysqli_fetch_assoc($result_user_data))
            {
                $getuser_data_array[] = $row_user_data;
            } 
            if(!isset($_SESSION))
            {
                session_start();
            }
            if ($$getuser_data_array[0]['user_type'] == 1)/*admin*/
            {
                $_SESSION[$company_name_session . '_loggedin'] = 1;
            }
            else if ($$getuser_data_array[0]['user_type'] == 3)/*member*/
            {
                $_SESSION[$company_name_session . '_loggedin'] = 3;
            }

            $admin = 0;
            
            $_SESSION['user_id_' . $company_name_session]= $getuser_data_array[0]['id'];
            $_SESSION['user_email_' . $company_name_session] = $getuser_data_array[0]['email'];
            $_SESSION['first_name_' . $company_name_session] = $getuser_data_array[0]['first_name'];
            $_SESSION['last_name_' . $company_name_session] = $getuser_data_array[0]['last_name'];
            $_SESSION['user_name_link_' . $company_name_session] = $getuser_data_array[0]['user_unique_slug'];
            $_SESSION['user_name_' . $company_name_session] = $getuser_data_array[0]['user_name'];
            $_SESSION['mobile_' . $company_name_session] = $getuser_data_array[0]['mobile'];
            $_SESSION['user_type_' . $company_name_session] = $getuser_data_array[0]['user_type'];
            $_SESSION['mobile_access_token_' . $company_name_session] = $getuser_data_array[0]['mobile_access_token'];
            $_SESSION['profile_pic_100' . $company_name_session] = $getuser_data_array[0]['profile_pic'];
            $_SESSION['profile_pic_450' . $company_name_session] = $getuser_data_array[0]['profile_pic'];
            
            $user = 1;
            $loggedin_user_id = $_SESSION['user_id_'.$company_name_session];
            $loggedin_user_email = $_SESSION['user_email_'.$company_name_session];
            $loggedin_user_first_name = $_SESSION['first_name_'.$company_name_session];
            $loggedin_user_last_name = $_SESSION['last_name_'.$company_name_session];
            $loggedin_user_name_link = $_SESSION['user_name_link_'.$company_name_session];
            $loggedin_user_name = $_SESSION['user_name_'.$company_name_session];
            $loggedin_user_mobile = $_SESSION['mobile_'.$company_name_session];
            $loggedin_user_type = $_SESSION['user_type_'.$company_name_session];
            $loggedin_user_mobile_access_token = $_SESSION['mobile_access_token_'.$company_name_session];
            $loggedin_user_total_user_cart_data = $_SESSION['total_user_cart_data_'.$company_name_session];
            $loggedin_user_profile_pic_100 = $_SESSION['profile_pic_100'.$company_name_session];
            $loggedin_user_profile_pic_450 = $_SESSION['profile_pic_450'.$company_name_session];
            $loggedin_user_is_compete = $_SESSION['is_compete'.$company_name_session];
            
            $get_cart_query = "select * from user_cart where celebrity_id='$celebrity_id' and user_id='$users_id'";
            $result_cart_data = mysqli_query($db_mysqli,$get_cart_query);
            while ($row_cart_data = mysqli_fetch_assoc($result_cart_data))
            {
                $cart_data_array1[] = $row_cart_data;
            } 

                $order_total_amount = $cart_data_array1[0]['price'];
                $total_discount = $cart_data_array1[0]['discount'];
                $final_order_total = $cart_data_array1[0]['price']-$cart_data_array1[0]['discount'];

                $_SESSION['order_total_amount_'.$company_name_session]=$order_total_amount;
                $_SESSION['save_total_amount_'.$company_name_session] = $total_discount;
                $_SESSION['final_order_total_'.$company_name_session] = $final_order_total;
                $_SESSION['cart_data_array1']=$cart_data_array1;
                
            ?>
            <form class="panel-default" role="form" id="checkout_form" method="POST" data-parsley-validate action="<?php echo $base_url; ?>place-order">
            <div class="row">
                    <div class="col-md-4 col-sm-6" id="content" >
                    <div class="page-content" style="border: 1px solid #dee2e6;  padding: 12px;">
                        <div class="woocommerce">
                        <div class="step-title"><h3 class="one_page_heading m-0"> Name & Address</h3>
                                </div>
                                <br/>
                            <div class="buttons clearfix">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="control-label">First Name: <span class="asterisk-mark">*</span></label>
                                            <input type="hidden" name="tid" id="tid" readonly/>
                                            <input name="first_name" id="first_name" type="text" value="<?php echo $loggedin_user_first_name; ?>"  class="woocommerce-Input woocommerce-Input--text input-text line-height-1 readonly" data-parsley-required="true" <?php echo $is_disable; ?>>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">Last Name: <span class="asterisk-mark">*</span></label>
                                            <input name="last_name" id="last_name" type="text" value="<?php echo $loggedin_user_last_name; ?>" class="woocommerce-Input woocommerce-Input--text input-text line-height-1 readonly"
                                                data-parsley-required="true" <?php echo $is_disable; ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="control-label">Email: <span class="asterisk-mark">*</span></label>
                                            <input name="email" id="email" type="text" value="<?php echo $loggedin_user_email; ?>" class="woocommerce-Input woocommerce-Input--text input-text line-height-1 readonly"  <?php echo $is_disable; ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="control-label">Mobile No: <span class="asterisk-mark">*</span></label>
                                            <input type="text" name="mobile" id="mobile" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" maxlength="10" minlength="10"
                                                value="<?php echo $loggedin_user_mobile; ?>" data-parsley-type="integer" data-parsley-required="true"
                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                        </div>
                                    </div>
                                </div>

                                    <!-- <div id="select_address_dropdown_div">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="control-label">Select Address Option: <span class="asterisk-mark">*</span></label>
                                                    <select name="address_id" id="address_id" data-placeholder="Select Address" class="" onchange="select_shipping_address(this.value)" data-parsley-required="true">
                                                        <option value="">Select Address</option>
                                                        <option value="00">Create New Address</option>
                                                        <?php
                                                        if (count($user_address_data_array) > 0)
                                                        {
                                                            foreach ($user_address_data_array as $user_address_data)
                                                            {
                                                                if ($user_address_data['address1'] != '' && isset($user_address_data['address1']))
                                                                {
                                                                    ?>
                                                                    <option value="<?php echo $user_address_data['id']; ?>"
                                                                        <?php
                                                                        if ($temp_cart_data_array[0]['address_id'] == $user_address_data['id'])
                                                                        {
                                                                            echo "selected";
                                                                        }
                                                                        ?>>
                                                                        <?php echo $user_address_data['address1'] . " - " . $user_address_data['pincode']; ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="selected_address_div">
                                            <?php
                                            if ($temp_cart_data_array[0]['address_id'])
                                            {
                                                $check_user_address_data_array = array();
                                                $get_user_address_data = "select  uad.*,c.id as c_id,c.city_name,s.id as s_id,s.state_name,cy.id as cy_id,cy.country_name FROM user_address uad LEFT JOIN cities c on uad.city_id=c.id LEFT JOIN states s on uad.state_id=s.id LEFT JOIN country cy on uad.country_id=cy.id WHERE  uad.user_id = '$loggedin_user_id'  AND uad.status = '1'  AND uad.is_deleted = '0'";
                                                $result_user_address_data = mysqli_query($db_mysqli, $get_user_address_data);
                                                while ($row_user_address_data = mysqli_fetch_assoc($result_user_address_data))
                                                {
                                                    $check_user_address_data_array[] = $row_user_address_data;
                                                }
                                                if (count($check_user_address_data_array) > 0)
                                                {
                                                    $user_address_data = $check_user_address_data_array[0];

                                            ?>
                                            <div class="woocommerce">
                                            <div class="step-title"><h3 class="one_page_heading m-0">Shipping Address<a onclick="modal_edit_address('<?php echo $user_address_data['id']; ?>')"><i
                                                    class="pull-right fa fa-pencil" style="padding-top:5px;color:#ff0000;"></i></a></h3>
                                                    </div>
                                                    <br/> 
                                                        <div class="checkout-box-border">
                                                            
                                                            <div class="panel-body pd-0 border-15" id="address_<?php echo $user_address_data['id']; ?>">

                                                                <table class="table table-borderless table-xs content-group-sm order-detail" id="address_table">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td><b>First Name:</b></td>
                                                                        <td id="checkout_order_sub_total"><?php echo $user_address_data['first_name']; ?></td>
                                                                        <input type="hidden" name="first_name" id="first_name" value="<?php echo $user_address_data['first_name']; ?>">
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>Last Name:</b></td>
                                                                        <td id="checkout_order_sub_total"><?php echo $user_address_data['last_name']; ?></td>
                                                                        <input type="hidden" name="last_name" id="last_name" value="<?php echo $user_address_data['last_name']; ?>">
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>company:</b></td>
                                                                        <td id="checkout_order_sub_total"><?php echo $user_address_data['company']; ?></td>
                                                                        <input type="hidden" name="company" id="company" value="<?php echo $user_address_data['company']; ?>">
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>Mobile:</b></td>
                                                                        <td id="checkout_order_saving_total"><?php echo $user_address_data['mobile']; ?></td>
                                                                        <input type="hidden" name="mobile" id="mobile" value="<?php echo $user_address_data['mobile']; ?>">
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>Address1:</b></td>
                                                                        <td id="checkout_order_sub_total"><?php echo $user_address_data['address1']; ?></td>
                                                                        <input type="hidden" name="address1" id="address1" value="<?php echo $user_address_data['address1']; ?>">
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>Address2:</b></td>
                                                                        <td id="checkout_order_saving_total"><?php echo $user_address_data['address2']; ?></td>
                                                                        <input type="hidden" name="address1" id="address1" value="<?php echo $user_address_data['address2']; ?>">
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>Pincode:</b></td>
                                                                        <td id="checkout_discount_total"><?php echo $user_address_data['pincode']; ?></td>
                                                                        <input type="hidden" name="pincode" id="pincode" value="<?php echo $user_address_data['pincode']; ?>">
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>City:</b></td>
                                                                        <td id="checkout_qty_discount_total"><?php echo $user_address_data['city_name']; ?></td>
                                                                        <input type="hidden" name="city_name" id="city_name" value="<?php echo $user_address_data['city_name']; ?>">
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b> State:</b></td>
                                                                        <td id="checkout_order_shipping"><?php echo $user_address_data['state_name']; ?></td>
                                                                        <input type="hidden" name="state_name" id="state_name" value="<?php echo $user_address_data['state_name']; ?>">
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>Country:</b></td>
                                                                        <td id="checkout_final_order_total"><?php echo $user_address_data['country_name']; ?></td>
                                                                        <input type="hidden" name="country_name" id="country_name" value="<?php echo $user_address_data['country_name']; ?>">
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                    </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6" id="content">
                    <div class="page-content"   style="border: 1px solid #dee2e6;  padding: 12px;">
                        <div class="woocommerce">
                        <div class="step-title"><h3 class="one_page_heading m-0">Mode Of Payment</h3>
                                </div>
                                <br/>
                            <div class="buttons clearfix">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="control-label">Mode Of Payment <span class="asterisk-mark">*</span></label>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group" style="margin-bottom: 0px;">
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <span class="radio custom-radio">
                                        <input type="radio" name="mod_of_payment" id="mode_of_payment1" value="1" style="background: none;margin-left: 0;width: auto;border: none;min-height: 16px;" data-parsley-multiple="mod_of_payment">
                                        <label for="mode_of_payment1">&nbsp;&nbsp;Online</label>
                                        </span>
                                    </div>
                                    </div>
                                </div> -->
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="customRadio clearfix">
                                                <input type="radio" name="mod_of_payment" id="formcheckoutRadio1" value="1"  checked="" class="radio"> 
                                                <label for="formcheckoutRadio1">Online</label>
                                            </div> 
                                            <!-- <div class="customRadio clearfix">
                                                <input type="radio" name="mod_of_payment" id="formcheckoutRadio2" value="2"  checked="" class="radio"> 
                                                <label for="formcheckoutRadio2">Cash On Delivery</label>
                                            </div> -->
                                            <!-- <span class="radio custom-radio">
                                                <input type="radio" name="mod_of_payment" id="mode_of_payment2" value="2"  checked="" style="background: none;margin-left: 0;width: auto;border: none;min-height: 16px;" data-parsley-multiple="mod_of_payment">
                                                <label for="mode_of_payment2">&nbsp;&nbsp;Cash On Delivery</label>
                                            </span> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <div class="row">
                                            <div class="col-xs-8 col-sm-12 col-md-7">
                                            <label class="control-label">Coupon Codes: </label>
                                            <input name="coupon_code" id="coupon_code" type="text" value="<?php echo $all_coupon_data_array[$coupon_id]['coupon_code']; ?>" class="woocommerce-Input woocommerce-Input--text input-text line-height-1">
                                        </div>
                                        <div class="col-xs-4 col-sm-12 col-md-5">
                                            <button type="button" class="btn btn-theme" title="Apply" style="float:left;margin-top: 33px;height:37px;" 
                                                    onclick="coupon_code_submit()">
                                            <span>
                                                <span style="text-transform: none !important;" id="apply_coupon_button_text">
                                                    <?php
                                                    if ($total_discount > 0)
                                                    {
                                                        ?>
                                                        Remove
                                                        <input type="hidden" value="1" id="coupon_applied" name="coupon_applied">
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                        Apply
                                                        <input type="hidden" value="0" id="coupon_applied" name="coupon_applied">
                                                        <?php
                                                    }
                                                    ?>
                                                </span>
                                            </span>
                                            </button>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="col-md-4 col-sm-6" id="content">
                    <div class="page-content">
                        <div class="woocommerce">
                        <div class="step-title"><h3 class="one_page_heading m-0">Order Details</h3>
                                </div>
                                <br/>
                            <div class="buttons clearfix">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td><i class="icon-alarm-check position-left"></i> SubTotal:</td>
                                            <td class="text-right"
                                                id="checkout_order_sub_total"><?php echo $selected_currency_icon; ?><?php echo $order_total_amount; ?></td>
                                        </tr>
                                        <!-- <tr>
                                            <td><i class="icon-history position-left"></i> Saving Total:</td>
                                            <td class="text-right"
                                                id="checkout_order_saving_total"><?php echo $selected_currency_icon; ?><?php echo $save_total_amount; ?></td>
                                        </tr> -->
                                        <tr>
                                            <td><i class="icon-file-plus position-left"></i>Discount:</td>
                                            <td class="text-right"
                                                id="checkout_discount_total"><?php echo $selected_currency_icon; ?><?php echo $total_discount; ?></td>
                                        </tr>
                                        <!-- <tr>
                                            <td><i class="icon-file-plus position-left"></i> Shipping:</td>
                                            <td class="text-right" id="checkout_order_shipping"><?php
                                                // if (($local_shipping > 0) && ($local_shipping != ''))
                                                // {
                                                //     echo $selected_currency_icon . " " . $local_shipping;
                                                // }
                                                // else
                                                // {
                                                //     echo "Free";
                                                // }
                                                ?></td>
                                        </tr> -->
                                        <tr>
                                            <td><i class="icon-file-check position-left"></i> Order Total:</td>
                                            <td class="text-right"
                                                id="checkout_final_order_total"><?php echo $selected_currency_icon; ?><?php echo $final_order_total; ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" name="submit" title="Proceed" class="btn btn-theme" style="width: 100%;">
                                <span>
                                <span style="text-transform: none !important;">
                                Proceed</span>
                                </span>
                                </button>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php
        }
        ?>
            </div>
            
                    <div id="shipping_address_model_div"></div>
                    <div id="edit_address_model_div"></div>
                    </div>
               </div>
            </div>
         </div>
    </main>
    
    <?php include 'common/footer.php';?>
    <?php include 'common/footer-js.php';?>
    <script>
    function select_shipping_address(selected_address_id)
    {
        if (selected_address_id != '')
        {
            var UrlToPass = '&id=' + selected_address_id;
            $.ajax(
                {
                    url: "<?php echo $base_url;?>selected-shipping-address-data.php",
                    type: "POST",
                    data: UrlToPass,
                    dataType: 'json',
                    encode: true,
                    beforeSend: function ()
                    {
                        $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
                    },
                    success: function (data)
                    {
                        $.unblockUI();
                        if (data.status == 'success')
                        {
                            if (selected_address_id == 00)
                            {
                                $('#selected_address_div').html('');
                                $('#shipping_address_model_div').html(data.html_message);
                                $('#shipping_address_model').modal('show');

                                $('#address_form').parsley().destroy();

                                $('#address_form').parsley();
                                $('#address_form').on('submit', function (e)
                                {
                                    e.preventDefault();
                                    var f = $(this);
                                    f.parsley().validate();
                                    if (f.parsley().isValid())
                                    {
                                        $.ajax(
                                            {
                                                url: "<?php echo $base_url;?>add-shipping-address-submit.php",
                                                type: "POST",
                                                data: $('#address_form').serialize(),
                                                dataType: 'json',
                                                encode: true,
                                                beforeSend: function ()
                                                {
                                                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
                                                },
                                                success: function (data)
                                                {
                                                    $.unblockUI();
                                                    if (data.status == 'success')
                                                    {
                                                        $('#address_form').trigger("reset");
                                                        $('#shipping_address_model_div').modal('hide');
                                                        $('#select_address_dropdown_div').html(data.select_address_dropdown_html);
                                                        $('#selected_address_div').html(data.address_html_message);
                                                        $('#address_form_error_msg').html(data.html_message);
                                                        $.growl.error({ title:"Success",message: "User details submit successfully" });
                                                        location.reload();
                                                    }
                                                    else
                                                    {
                                                        $('#address_form_error_msg').html(data.html_message);
                                                        //$.notifyBar({ cssClass: "error", html: data.html_message});
                                                    }
                                                },
                                                error: function (error)
                                                {
                                                    $.growl.error({ title:"Error",message: "Error Loading data from server." });
                                                    //$.notifyBar({cssClass: "error", html: "Error Loading data from server."});
                                                }
                                            });
                                    }
                                    else
                                    {
                                        e.preventDefault();
                                    }
                                });
                            }
                            else
                            {
                                $('#selected_address_div').html(data.html_message);
                            }
                        }
                        else
                        {
                            $.growl.error({ title:"Error",message: data.html_message });
                            //$.notifyBar({cssClass: "error", html: data.html_message});
                        }
                    },
                    error: function (error)
                    {
                        $.growl.error({ title:"Error",message: "Error Loading data from server." });
                        //$.notifyBar({cssClass: "error", html: "Error Loading data from server."});
                    }
                });
        }
        else
        {
            $.growl.error({ title:"Error",message: "Please Select Address." });
            $('#selected_address_div').html('');
            //$.notifyBar({cssClass: "error", html: 'Please Select Address.'});
        }
    }

    var form_id = '';
    function get_state_selection(country_id, form_id)
    {
        $('#' + form_id).parsley().destroy();
        if (country_id > 0)
        {
            $.ajax({
                url: "<?php echo $base_url;?>get-state-selection-div.php",
                type: "POST",
                data: {"country_id": country_id, "form_id": form_id},
                dataType: 'json',
                encode: true,
                beforeSend: function ()
                {
                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
                },
                success: function (data)
                {
                    $.unblockUI();
                    if (data.status == 'success')
                    {
                        $('#' + form_id + '_state_selection_div').html(data.html_message);
                        $('#' + form_id + '_city_selection_div').html("");

                        $('#' + form_id + '_state_id').attr('data-parsley-required', 'true');
                        $('#' + form_id).parsley();
                    }
                    else
                    {
                        $('#' + form_id + '_state_selection_div').html("");
                        $('#' + form_id).parsley();
                    }
                },
                error: function ()
                {
                    $.unblockUI();
                    $('#' + form_id + '_city_selection_div').html("");
                    $('#' + form_id + '_state_selection_div').html("");
                    $('#' + form_id).parsley();
                }
            });
        }
        else
        {
            $('#' + form_id + '_state_selection_div').html("");
            $('#' + form_id + '_city_selection_div').html("");
            $('#' + form_id).parsley();
        }
    }

    function get_city_selection(state_id, form_id)
    {
        $('#' + form_id).parsley().destroy();

        if (state_id > 0)
        {
            $.ajax({
                url: "<?php echo $base_url;?>get-city-selection-div.php",
                type: "POST",
                data: {"state_id": state_id, "form_id": form_id},
                dataType: 'json',
                encode: true,
                beforeSend: function ()
                {
                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
                },
                success: function (data)
                {
                    $.unblockUI();
                    if (data.status == 'success')
                    {
                        $('#' + form_id + '_city_selection_div').html(data.html_message);
                        $('#' + form_id + '_city_id').attr('data-parsley-required', 'true');
                        $('#' + form_id).parsley();
                    }
                    else
                    {
                        $('#' + form_id + '_city_selection_div').html("");
                        $('#' + form_id).parsley();
                    }
                },
                error: function ()
                {
                    $.unblockUI();
                    $('#' + form_id + '_city_selection_div').html("");
                    $('#' + form_id).parsley();
                }
            });
        }
        else
        {
            $('#' + form_id + '_city_selection_div').html("");
            $('#' + form_id).parsley();
        }
    }
    </script>
    </body>    
</html>  
<?php
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'registration">';
}
?>