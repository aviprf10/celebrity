<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if ($_POST)
    {
        
        $user_type  = 3;
        $first_name = Secure1($db_mysqli, $_POST['first_name']);
        $last_name  = Secure1($db_mysqli, $_POST['last_name']);
        $email      = Secure1($db_mysqli, $_POST['email']);
        $gender     = Secure1($db_mysqli, $_POST['gender']);
        $mobile     = Secure1($db_mysqli, $_POST['mobile']);
        $password   = md5(Secure1($db_mysqli, $_POST['password']));
        $date_of_birthday   = Secure1($db_mysqli, $_POST['date_of_birthday']);
        $user_name       = $first_name.' '. $last_name;
        $created_on   = get_current_date_time();
        
        $user_unique_slug = '';
        $user_unique_slug = get_unique_slug1($db_mysqli, $user_name, 'user', 'user_name');
       
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        $check_user_email_data_array = array();
        $check_user_email_query = "select * from user where email='$email'";
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
        $check_user_mobile_query = "select * from user where mobile='$mobile'";
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

        
        $created_on = date("Y-m-d H:i:s");
        $unique_key = md5(uniqid(rand()));
        $ip_address = getUserIP();
        $mobile_verify     =  1;
        $email_verify      =  1;
        $status            = 1;
           
        $insert_user_query = "insert into user (`first_name`, `last_name`,`user_name`,`user_unique_slug`, `email`,`password`,`gender`,`mobile`,`user_type`, `unique_key`,`ip_address`,`created_on`,`status` ,`mobile_verify`, `email_verify`, `registration_date`, `dob`) values('$first_name','$last_name','$user_name','$user_unique_slug','$email','$password','$gender','$mobile','$user_type','$unique_key','$ip_address','$created_on','$status', '$mobile_verify', '$email_verify', '$created_on', '$date_of_birthday')";
        $result_insert_user_query = mysqli_query($db_mysqli, $insert_user_query);
        $celebrity_id = mysqli_insert_id($db_mysqli);
        if ($result_insert_user_query)
        {
            $return["html_message"] = 'User Added Successfully!';
            $return["status"] = "success";
            echo json_encode($return);
            exit();
        }
        else
        {
            $return["html_message"] = 'Some Error Occured While adding User address';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
//        }
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