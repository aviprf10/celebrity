<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($celebrity == 1)
{
   if(($_POST))
   {
      $delete_id = Secure1($db_mysqli,$_POST['delete_id']);

      $all_services_data_array = array();
      $get_services_query = "select * from services_request where id='$delete_id' and is_deleted='0'";
      $result_get_services_query = mysqli_query($db_mysqli,$get_services_query);
      while ($row_get_services_query = mysqli_fetch_assoc($result_get_services_query))
      {
         $all_services_data_array[] = $row_get_services_query;
      }

      if(count($all_services_data_array) > 0)
      {

         $update_services_query = "update services_request set is_deleted='1' where id='$delete_id'";
         $result_update_services_query = mysqli_query($db_mysqli,$update_services_query);
         if($result_update_services_query)
         {
            $return["html_message"] = 'Services Removed Successfully.';
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
         $return["html_message"] = 'Services Does Not Exist.';
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