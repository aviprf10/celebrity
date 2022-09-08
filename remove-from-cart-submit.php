<?php 
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if(isset($_POST))
{
   $celebrity_id = Secure1($db_mysqli,$_POST['celebrity_id']);
   
   $celebrity_data_array = array();
   $get_celebrity_query = "select * from user u LEFT JOIN celebrity_details cd on cd.celebrity_id = u.id WHERE  u.id = '$celebrity_id' AND u.status = '1'  AND u.is_deleted = '0'";
   $result_celebrity_data = mysqli_query($db_mysqli,$get_celebrity_query);

   while ($row_celebrity_data = mysqli_fetch_assoc($result_celebrity_data))
   {
      $celebrity_data_array[] = $row_celebrity_data;
   } 

  
   if(count($celebrity_data_array) > 0) /* if celebrity is exist in database */
   {
      $celebrity_data = $celebrity_data_array[0];
      //$celebrity_id = $celebrity_data['id'];
      $category_id = $celebrity_data['category_id'];

      $remove_cart = 0;
      if($user == 1)
      {
         $cart_data_array = array();
         $get_user_cart_query = "select * from user_cart where user_id='$loggedin_user_id' and celebrity_id=$celebrity_id";
         $result_user_cart_data = mysqli_query($db_mysqli,$get_user_cart_query);
         while ($row_user_cart_data = mysqli_fetch_assoc($result_user_cart_data))
         {
           $cart_data_array[] = $row_user_cart_data;
         } 

         if(count($cart_data_array)>0)
         {
            $return_cart_data = array();
            $user_cart_query = "delete from user_cart where celebrity_id='$celebrity_id' and user_id='$loggedin_user_id'";
            $return_cart_data = mysqli_query($db_mysqli,$user_cart_query);
            if($return_cart_data == '1')
            {
               $remove_cart = 1;
            }
         }
      }
      else
      {
         
         if(isset($_SESSION['cart_'.$company_name_session]) && (count($_SESSION['cart_'.$company_name_session])>0))
         {  
            foreach($_SESSION['cart_'.$company_name_session] as $key=>$value)
            {
               if($value['celebrity_id'] == $celebrity_id)
               {
                  unset($_SESSION['cart_'.$company_name_session][$key]);
                  $remove_cart = 1;
               }
            }
         }
      }
      
      if($remove_cart == 1) /* if celebrity purchase is alreay in cart  */  
      {
         $return["html_message"] = ' Celebrity removed from cart.';
         include('common/cart.php');
         $return["status"] = "success";
         $return["total_cart_celebrity"] = $_SESSION['total_user_cart_data_'.$company_name_session];
         $return["total_cart_amount"] = $_SESSION['order_total_amount_'.$company_name_session];
         $return["total_cart_saving_amount"] = $_SESSION['save_total_amount_'.$company_name_session];
         $return["final_order_amount"] = $_SESSION['final_order_total_'.$company_name_session];
         $return["delete"] = 1;
         $return["add"] = 0;
         echo json_encode($return);
      }
      else 
      {
         $return["html_message"] = ' Some Error Occured! Please try again.';
         $return["status"] = "error";
         echo json_encode($return);
      }  
   }
   else 
   {
      $return["html_message"] = ' Celebrity does not exist.';
      $return["status"] = "error";
      echo json_encode($return);
   }
}
else
{
   $return["html_message"] = ' Some Error Occured! Please try again.';
      $return["status"] = "error";
      echo json_encode($return);
}
?>