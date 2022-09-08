<?php
include "common/config.php";
header('Content-type: application/json');
if(isset($_POST))
{
   $forgot_password_id = Secure1($db_mysqli,$_POST['forgot_password_id']);

   $all_user_data_array = array();
   $get_user_query = "select * from user where (email='$forgot_password_id' or  mobile='$forgot_password_id')";
   $result_get_user_query = mysqli_query($db_mysqli,$get_user_query);
   while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
   {
      $all_user_data_array[] = $row_get_user_query;
   } 

   if(count($all_user_data_array)>0)
   {
      $user_data = $all_user_data_array[0];

      if($user_data['registered_from'] == 'facebook' || $user_data['registered_from'] == 'google_plus')
      {
         if($user_data['registered_from'] == 'facebook')
         {
            $return["html_message"] = 'Account is Associate with facebook. Try to signin using facebook.';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
         }
         else if($user_data['registered_from'] == 'google_plus')
         {
            $return["html_message"] = 'Account is Associate with google. Try to signin using google.';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
         }
         else
         {
            $return["html_message"] = 'Some Error Occured..! Please Try Again.';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
         }
      }
      else
      {
         $unique_key=md5(uniqid(rand()));
         $current_date = date('Y-m-d');
         $email = $all_user_data_array[0]['email'];
         $user_data_array = array();
         $update_user_query = "update user set unique_key_forgot_password='$unique_key',forgot_password_date='$current_date' where email='$email'";
         $user_data_array = mysqli_query($db_mysqli,$update_user_query);


         if(isset($user_data_array) && count($user_data_array) == 1)    
         {
            $user_name = $user_data['first_name']." ".$user_data['last_name'];
            $user_type = $user_data['user_type'];

            $email_array = array();
               $email_array['email']      = $email;
               $email_array['user_name']  = $user_name;
               $email_array['unique_key']    = $unique_key;
               $email_array['user_type']  = $user_type;
               $email_array['social_media_link'] = $master_settings_data_array;
               $email_array['email_type']    = 4;//Forgot Password Link
               $email_sent_response       = send_email($email_array);
               if($email_sent_response == 1)
               {
               $return["html_message"] = 'Well done!  Please check your email for password recovery link..';
               $return["status"] = "success";
               echo json_encode($return);
               exit();
               }
            else
            {
               $return["html_message"] = 'Oh snap! Some Error Occured..!';
               $return["status"] = "error";
               echo json_encode($return);
               exit();
            }
         }
         else
         {
            $return["html_message"] = 'Oh snap! Some Error Occured..!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
         }
      }
   }
   else
   {
      $return["html_message"] = 'Oh snap! User id does not exist...!';
      $return["status"] = "error";
      echo json_encode($return);
   }
}
else 
{
   $return["html_message"] = 'Oh snap! Some Error Occured..!';
   $return["status"] = "error";
   echo json_encode($return);
}
?>