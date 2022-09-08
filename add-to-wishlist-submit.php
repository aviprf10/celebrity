<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');

if($user == 1)
{
   if(isset($_POST))
   {
         $celebrity_id = Secure1($db_mysqli,$_POST['celebrity_id']);
         $celebrity_data_array = array();
         $get_celebrity_query = "select * from user  where is_deleted='0' and status='1' and id='$celebrity_id'";

         $result_celebrity_data = mysqli_query($db_mysqli,$get_celebrity_query);
         while ($row_celebrity_data = mysqli_fetch_assoc($result_celebrity_data))
         {
            $celebrity_data_array[] = $row_celebrity_data;
         } 

         if(count($celebrity_data_array) > 0) /* if celebrity is exist in database */
         {
            $celebrity_data = $celebrity_data_array[0];
            //$celebrity_id = $celebrity_data['id'];

            $wishlist_data_array = array();
            $get_wishlist_query = "select * from user_wishlist where celebrity_id='$celebrity_id' and user_id='$loggedin_user_id'";

            $result_wishlist_data = mysqli_query($db_mysqli,$get_wishlist_query);
            while ($row_wishlist_data = mysqli_fetch_assoc($result_wishlist_data))
            {
               $wishlist_data_array[] = $row_wishlist_data;
            } 

            if(count($wishlist_data_array)>0)
            {  
               $delete_wishlist_query = "delete from user_wishlist where celebrity_id='$celebrity_id' and user_id='$loggedin_user_id'";
               
               $result_delete_wishlist_query = mysqli_query($db_mysqli,$delete_wishlist_query);
               $count_wishlist_data_array = array();
               $count_get_wishlist_query = "select * from user_wishlist where user_id='$loggedin_user_id'";

               $count_result_wishlist_data = mysqli_query($db_mysqli,$count_get_wishlist_query);
               while ($count_row_wishlist_data = mysqli_fetch_assoc($count_result_wishlist_data))
               {
                  $count_wishlist_data_array[] = $count_row_wishlist_data;
               }
               $total_user_wishlist = count($count_wishlist_data_array);

               if($result_delete_wishlist_query == 1)
               {
                  $return["html_message"] = 'Celebrity is removed from wishlist.';
                  $return["status"] = "success";
                  $return["add"] = "0";
                  $return["delete"] = "1";
                  $return["wishlist_count"] = $total_user_wishlist;
                  //$return["login"] = "1";
                  echo json_encode($return);
                  exit();
               }
               else
               {
                  $return["html_message"] = 'Error occured while removing celebrity from wishlist.';
                  $return["status"] = "error";
                  $return["add"] = 0;
                  $return["delete"] = 0;
                  //$return["login"] = "1";
                  echo json_encode($return);
                  exit();
               }
            }
            else
            {
               $date_time= date('Y-m-d H:i:s');

               $insert_user_wishlist_query = "INSERT INTO user_wishlist (user_id, celebrity_id,date_time) VALUES ('$loggedin_user_id','$celebrity_id','$date_time' );";
               $return_user_wishlist_data = mysqli_query($db_mysqli,$insert_user_wishlist_query);

               if(isset($return_user_wishlist_data) && $return_user_wishlist_data == 1)    
               {     
                  $return["html_message"] = 'Celebrity added to wishlist successfully.';
                  $return["status"] = "success";
                  $return["add"] = 1;
                  $return["delete"] = 0;
                  $return["login"] = "1";
                  echo json_encode($return);
                  exit();
               }
               else
               {     
                  $return["html_message"] = 'Some Error Occured! Please try again.';
                  $return["status"] = "error";
                  $return["add"] = 0;
                  $return["delete"] = 0;
                  $return["login"] = "1";
                  echo json_encode($return);
                  exit();
               }
            }
         }
         else 
         {
            $return["html_message"] = 'Celebrity does not exist.';
            $return["status"] = "error";
            echo json_encode($return);
            $return["login"] = "1";
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
    //  echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$base_url.'login">';

   $return["html_message"] = 'Please login to continue.';
   $return["status"] = "error";
   $return["login"] = "0";
   echo json_encode($return);
   exit();
}
?>