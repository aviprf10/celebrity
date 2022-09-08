<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
   if(($_POST))
   {
      $delete_id = Secure1($db_mysqli,$_POST['delete_id']);

      $all_gift_cat_data_array = array();
      $get_gift_cat_query = "select * from gift_cat where id='$delete_id' and is_deleted='0'";
      $result_get_gift_cat_query = mysqli_query($db_mysqli,$get_gift_cat_query);
      while ($row_get_gift_cat_query = mysqli_fetch_assoc($result_get_gift_cat_query))
      {
         $all_gift_cat_data_array[] = $row_get_gift_cat_query;
      }

      if(count($all_gift_cat_data_array) > 0)
      {

         $update_gift_cat_query = "update gift_cat set is_deleted='1' where id='$delete_id'";
         $result_update_gift_cat_query = mysqli_query($db_mysqli,$update_gift_cat_query);
         if($result_update_gift_cat_query)
         {
            $return["html_message"] = 'Gift Category Removed Successfully.';
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
         $return["html_message"] = 'Gift_cat Does Not Exist.';
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