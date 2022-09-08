<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
   if(($_POST))
   {
      $delete_id = Secure1($db_mysqli,$_POST['delete_id']);

      $all_occasion_data_array = array();
      $get_occasion_query = "select * from occasion where id='$delete_id' and is_deleted='0'";
      $result_get_occasion_query = mysqli_query($db_mysqli,$get_occasion_query);
      while ($row_get_occasion_query = mysqli_fetch_assoc($result_get_occasion_query))
      {
         $all_occasion_data_array[] = $row_get_occasion_query;
      }

      if(count($all_occasion_data_array) > 0)
      {

         $update_occasion_query = "update occasion set is_deleted='1' where id='$delete_id'";
         $result_update_occasion_query = mysqli_query($db_mysqli,$update_occasion_query);
         if($result_update_occasion_query)
         {
            $return["html_message"] = 'Occasion Removed Successfully.';
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
         $return["html_message"] = 'Occasion Does Not Exist.';
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