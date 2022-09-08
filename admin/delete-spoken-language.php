<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
   if(($_POST))
   {
      $delete_id = Secure1($db_mysqli,$_POST['delete_id']);

      $all_spoken_language_data_array = array();
      $get_spoken_language_query = "select * from spoken_language where id='$delete_id' and is_deleted='0'";
      $result_get_spoken_language_query = mysqli_query($db_mysqli,$get_spoken_language_query);
      while ($row_get_spoken_language_query = mysqli_fetch_assoc($result_get_spoken_language_query))
      {
         $all_spoken_language_data_array[] = $row_get_spoken_language_query;
      }

      if(count($all_spoken_language_data_array) > 0)
      {

         $update_spoken_language_query = "update spoken_language set is_deleted='1' where id='$delete_id'";
         $result_update_spoken_language_query = mysqli_query($db_mysqli,$update_spoken_language_query);
         if($result_update_spoken_language_query)
         {
            $return["html_message"] = 'Spoken Language Removed Successfully.';
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
         $return["html_message"] = 'Spoken_language Does Not Exist.';
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