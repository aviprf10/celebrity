<?php
include "common/config.php";
header('Content-type: application/json');
if(isset($_POST) && $_POST['first_name']!='' && $_POST['last_name']!='' && $_POST['email']!='' && $_POST['mobile']!='' && $_POST['password']!='')
{
    if($_SESSION['otp_verify_status_'.$company_name_session] == 1)
    {
        $first_name = Secure1($db_mysqli,ucfirst($_POST['first_name']));
        $last_name = Secure1($db_mysqli,ucfirst($_POST['last_name']));
        $user_name = $first_name.' '. $last_name;
        $email = Secure1($db_mysqli,lcfirst($_POST['email']));
        $registered_from = '';
        $gender =  Secure1($db_mysqli,$_POST['gender']);
        $mobile = Secure1($db_mysqli,$_POST['mobile']);
        $insta_id = Secure1($db_mysqli,$_POST['insta_id']);
        $password1 =  Secure1($db_mysqli,$_POST['password']);
        $city_id =  Secure1($db_mysqli,$_POST['city_id']);
        $state_id =  Secure1($db_mysqli,$_POST['state_id']);
        $country_id =  Secure1($db_mysqli,$_POST['country_id']);
        $password =  Secure1($db_mysqli,$_POST['password']);
        if(Secure1($db_mysqli,$_POST['password']) != Secure1($db_mysqli,$_POST['confirm_password']))
        {
            $return["html_message"] = 'Password and Confirm Password does not match..! Try Again.';
            $return["status"] = "error";
            echo json_encode($return);
        }
        else
        {
            
            $all_user_data_array = array();
            $get_user_query = "select * from user where (email='$email' or mobile='$mobile') and is_deleted = 0";
            $result_get_user_query = mysqli_query($db_mysqli,$get_user_query);
            while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
            {
                $all_user_data_array[] = $row_get_user_query;
            }

            if(isset($all_user_data_array) && count($all_user_data_array) == 0)
            {
                $user_unique_slug = '';
                $user_unique_slug = get_unique_slug1($db_mysqli, $user_name, 'user', 'user_name');
                $created_on = date("Y-m-d H:i:s");
                $unique_key = md5(uniqid(rand()));
                $ip_address = getUserIP();
                

                //otp generate
                //$digits = 4;
                //$mobile_otp = rand(pow(10, $digits-1), pow(10, $digits)-1);

                /*$otp_array = array();
                $otp_array['mobile_otp'] = $mobile_otp;
                $otp_array['mobile_no'] = $mobile;
                $otp_sent_response = send_otp($otp_array);*/

                $_SESSION['temp_mobile'.$company_name_session] = $mobile;
                //$_SESSION['temp_mobile_otp'.$company_name_session] = $mobile_otp;


                $sql_insert_user = "insert into user (`first_name`, `last_name`,`user_name`,`user_unique_slug`, `email`,`password`,`gender`,`mobile`,`user_type`, `unique_key`,`ip_address`,`country_id`,`state_id`,`city_id`,`created_on`,`status`, `instagram_link` ) values('$first_name','$last_name','$user_name','$user_unique_slug','$email','$password','$gender','$mobile','3','$unique_key','$ip_address','$country_id','$state_id','$city_id','$created_on','1','$insta_id')";
                $result_insert_user = mysqli_query($db_mysqli, $sql_insert_user);
                $user_id = mysqli_insert_id($db_mysqli);
                
                if ($result_insert_user)
                {
                    $email_array = array();
                    $email_array['email'] = $email;
                    $email_array['user_name'] = $user_name;
                    $email_array['unique_key'] = $unique_key;
                    $email_array['email_type'] = 2;
                    $email_sent_response = send_email($email_array);
                    $email_sent_response = 1;
                    if($email_sent_response == 1)
                    {
                        $mobile_access_token = random_code_long();
                        $mobile_token_exp_date = date('Y-m-d', strtotime('+1 years'));
                        /***** Setting all session variables. *****/
                    
                        if(isset($_SESSION['cart_'.$company_name_session]) && (count($_SESSION['cart_'.$company_name_session])>0)) 
                        {
                            $check_user_cart_data_array = array();
                            $get_user_cart_query = "select * from user_cart where user_id='$user_id'";
                            $result_user_cart_data = mysqli_query($db_mysqli,$get_user_cart_query);
                            while ($row_user_cart_data = mysqli_fetch_assoc($result_user_cart_data))
                            {
                                $check_user_cart_data_array[] = $row_user_cart_data;
                            } 

                            include('common/cart.php');
                            foreach($_SESSION['cart_'.$company_name_session] as $key => $value)
                            {
                            
                                $celebrity_id = $quantity = $price = $mrp = '';
                                $celebrity_id = $_SESSION['cart_'.$company_name_session][$key]['celebrity_id'];
                                $name = $_SESSION['cart_'.$company_name_session][$key]['name'];
                                $occasion_id = $_SESSION['cart_'.$company_name_session][$key]['occasion_id'];
                                $quantity = $_SESSION['cart_'.$company_name_session][$key]['quantity'];
                                $price = $_SESSION['cart_'.$company_name_session][$key]['price'];
                                $date_of_delevery = $_SESSION['cart_'.$company_name_session][$key]['date_of_delevery'];
                                $user_message = $_SESSION['cart_'.$company_name_session][$key]['user_message'];
                                $message_id = $_SESSION['cart_'.$company_name_session][$key]['message_id'];
                                $request_for = $_SESSION['cart_'.$company_name_session][$key]['request_for'];
                                $services_id = $_SESSION['cart_'.$company_name_session][$key]['services_id'];
                                $celebrity_price_id = $_SESSION['cart_'.$company_name_session][$key]['celebrity_price_id'];
                                $cart_exist = '0';
                                $cart_quantity = '0';
                                //$current_cart_data = array();
                                
                                if(count($check_user_cart_data_array)>0) // check for update
                                {   
                                    foreach($check_user_cart_data_array as $check_user_cart_data)
                                    {
                                        if(($check_user_cart_data['user_id'] == $user_id) && ($check_user_cart_data['celebrity_id'] == $celebrity_id))
                                        {
                                            $cart_exist = '1';
                                            $cart_quantity = $check_user_cart_data['quantity'];
                                            //$current_cart_data = $cart_data;
                                        }
                                    }

                                    $order_date = date('Y-m-d');
                                    $order_date_time = date('Y-m-d H:i:s');
                                    $insert_user_cart_query = "INSERT INTO user_cart (user_id,name,occasion_id,date_of_delevery,price,celebrity_id,order_date,order_date_time,user_message,message_id,request_for,services_id,celebrity_price_id) VALUES ('$user_id','$name','$occasion_id','$date_of_delevery','$price','$celebrity_id','$order_date','$order_date_time','$user_message','$message_id','$request_for','$services_id','$celebrity_price_id');";
                                    $return_user_cart_data = mysqli_query($db_mysqli,$insert_user_cart_query);

                                    if($return_user_cart_data)
                                    {
                                        unset($_SESSION['cart_'.$company_name_session][$key]);
                                    }
                                }
                                else
                                {
                                    $order_date = date('Y-m-d');
                                    $order_date_time = date('Y-m-d H:i:s');
                                    $insert_user_cart_query = "INSERT INTO user_cart (user_id,name,occasion_id,date_of_delevery,price,celebrity_id,order_date,order_date_time,user_message,message_id,request_for,services_id,celebrity_price_id) VALUES ('$user_id','$name','$occasion_id','$date_of_delevery','$price','$celebrity_id','$order_date','$order_date_time','$user_message','$message_id','$request_for','$services_id','$celebrity_price_id');";
                                    $return_user_cart_data = mysqli_query($db_mysqli,$insert_user_cart_query);

                                    if($return_user_cart_data)
                                    {
                                        unset($_SESSION['cart_'.$company_name_session][$key]);
                                    }
                                }   
                                
                            }
                        }
                        $_SESSION[$company_name_session . '_loggedin'] = 3;
                        $_SESSION['domain_link_' . $company_name_session] = $company_name_session;
                        $_SESSION['user_id_' . $company_name_session] = $user_id;
                        $_SESSION['user_email_' . $company_name_session] = $email;
                        $_SESSION['first_name_' . $company_name_session] = $first_name;
                        $_SESSION['last_name_' . $company_name_session] = $last_name;
                        $_SESSION['user_name_' . $company_name_session] = $user_name;
                        $_SESSION['mobile_' . $company_name_session] = $mobile;
                        $_SESSION['user_name_link_' . $company_name_session] = $user_name_link;
                        $_SESSION['user_type_' . $company_name_session] = $user_type;
                        $_SESSION['mobile_access_token_' . $company_name_session] = $mobile_access_token;

                        $_SESSION['profile_pic_100' . $company_name_session] = $profile_pic_100;
                        $_SESSION['profile_pic_450' . $company_name_session] = $profile_pic_450;
                        /***** End of setting all session variables. *****/
                        
                        /***** Start of updating user last login time and date *****/
                        $last_login = date('Y-m-d H:i:s');
                        $module_user = "update user set last_login='$last_login' where id='$user_id'";
                        $result_user_query = mysqli_query($db_mysqli, $module_user);
                        /***** End of updating user last login time and date *****/
                        
                        if($return_user_cart_data)
                        {
                            $return["page"] = "checkout";
                            $return["html_message"] = 'Process Done successfully.';
                            $return["status"] = "success";
                            echo json_encode($return);
                            exit();   
                        }
                        else 
                        {
                            $return["page"] = "account-dashboard";
                            $return["html_message"] = 'Process Done successfully.';
                            $return["status"] = "success";
                            echo json_encode($return);
                            exit();
                        }
                        
                        }
                        else
                        {
                            $return["html_message"] = 'Some Error Occurred! Please Try Again.';
                            $return["status"] = "error";
                            echo json_encode($return);
                            exit();
                        }
                    }
                    else
                    {
                        $return["html_message"] = 'Some Error Occurred! Please Try Again.';
                        $return["status"] = "error";
                        echo json_encode($return);
                        exit();
                    }
                
            }
            else 
            {
                if($all_user_data_array[0]['email'] == $email)
                {
                    $return["html_message"] = 'Email Id already exists..! Please try another.';
                    $return["status"] = "error";
                    echo json_encode($return);
                    exit();
                }
                else if($all_user_data_array[0]['mobile'] == $mobile)
                {
                    $return["html_message"] = ' Mobile number already exists..! Try Another.';
                    $return["status"] = "error";
                    echo json_encode($return);
                    exit();
                }

            }
        }
    }     
    else
    {
        $return["html_message"] = 'Please Verified email id.';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }    
}
else 
{
   $return["html_message"] = 'Some Error Occured! Please try after some time.';
   $return["status"] = "error";
   echo json_encode($return);
   exit();
}
?>