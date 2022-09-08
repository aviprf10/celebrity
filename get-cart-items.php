<?php 
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
include('common/cart.php');
   
$cart_html_message            = '';
$single_product_total_amount  = 0;
$cart_total_amount            = 0;
$total_product_show_in_cart   = 0;
if($user == 1)
{
  
   if(count($cart_data_array1) > 0)
   {
      $cart_html_message.='<div class="minicart-content">
                            <ul class="clearfix">';
      foreach($cart_data_array1 as $cart_data)
      {
         //print_r($cart_data); exit;
            $celebrity_id = $cart_data['celebrity_id'];
            $user_data_array = array();
            $get_user_query = "select * from user where status='1' and is_deleted='0' and id='$celebrity_id'";
            $result_user_data = mysqli_query($db_mysqli,$get_user_query);
            while ($row_user_data = mysqli_fetch_assoc($result_user_data))
            {
                  $user_data_array[] = $row_user_data;
            } 

            $user_name = $user_data_array[0]['user_name'];
            $user_unique_slug = $user_data_array[0]['user_unique_slug'];
            $celebrity_images = $cart_data['profile_pic'];
            $quantity = $cart_data['quantity'];
            $quantity = $cart_data['quantity'];
            $price = $cart_data['price'];
            $discount_type = $cart_data['discount_type'];
            $discount = $cart_data['discount'];
            $request_for = $cart_data['request_for'];

            if ($discount_type == 'percentage')
            {
               $discountt = $price*$discount;
               $total_discountt = $discountt/100;
               $total_discount = $price-$total_discountt;
            }
            else if($discount_type == 'price')
            {
                  $total_discount = $price-$discount;
            }

            if($celebrity_images!='')
            {
               $celebrity_images=$cele_base_path_uploads."profile-pic/temp_file/".$celebrity_images;
            }
            else
            {
               $celebrity_images=$base_url_images."07.jpg";
            }

            $cart_html_message.=' <li class="item d-flex justify-content-center align-items-center">
               <a class="product-image" href="'.$base_url.'celebrity-details/'.$user_unique_slug .'">
                  <img class="blur-up lazyload" src="'.$celebrity_images.'" data-src="'.$celebrity_images.'" alt="image" title="">
               </a>
               <div class="product-details">
                  <a class="product-title" href="'.$base_url.'celebrity-details/'.$user_unique_slug .'">'.ucfirst($user_name).'</a>
                  <p style="margin-bottom:0px;"><span  style="font-size:10px;">Request for* </span><br><span style="font-size:8px;"><i class="an an-play" style="font-size:8px;"></i> '.$request_for.'</span></p>
                  <div class="priceRow">
                     <div class="product-price">
                           <span class="money">'.$selected_currency_icon.' '.$total_discount.'</span>
                     </div>
                  </div>
               </div>
               <div class="qtyDetail text-center">
                  <div class="wrapQtyBtn">
                     <div class="qtyField">
                           <input type="text" name="quantity" value="'.$quantity.'" class="qty rounded-pill" readonly>
                     </div>
                  </div>
                  <a href="#" onclick="remove_from_cart('.$celebrity_id.')" class="remove"><i class="an an-times-r" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"></i></a>
               </div>
         </li>'; 
         $single_product_total_amount=$total_discount*$quantity;
         $cart_total_amount+=$single_product_total_amount;
         $total_product_show_in_cart=$total_product_show_in_cart + 1; 
      } 
      $cart_html_message.=' </ul>
        </div>
        <div class="minicart-bottom text-black">
             <div class="subtotal">
                <span>Total:</span>
                <span class="product-price">'.$selected_currency_icon.' '.$cart_total_amount.'</span>
            </div>
            <a href="'.$base_url.'checkout" class="w-100 p-2 my-2 btn btn-secondary rounded-pill proceed-to-checkout">Proceed to Checkout</a>
            <a href="'.$base_url.'cart" class="w-100 btn btn-outline-primary rounded-pill cart-btn">View Cart</a>
        </div>';
   } 
   else 
   {                  
      $cart_html_message.=' <div class="popup-cart__empty mt-20 d-none-important">Your shopping bag is empty.</div>';
   } 
}
else
{ 
   
   if(isset($_SESSION['cart_'.$company_name_session]) && (count($_SESSION['cart_'.$company_name_session])>0))
   { 
      $cart_html_message.='<div class="minicart-content">
                            <ul class="clearfix">';
      foreach($_SESSION['cart_'.$company_name_session] as $key=>$value)
      {
        $celebrity_id = $_SESSION['cart_'.$company_name_session][$key]['celebrity_id'];
        $user_data_array = array();
        $get_user_query = "select * from user where status='1' and is_deleted='0' and id='$celebrity_id'";
        $result_user_data = mysqli_query($db_mysqli,$get_user_query);
        while ($row_user_data = mysqli_fetch_assoc($result_user_data))
        {
            $user_data_array[] = $row_user_data;
        }  
        
         $user_name = $user_data_array[0]['user_name'];
         $user_unique_slug = $user_data_array[0]['user_unique_slug'];
         $quantity = $_SESSION['cart_'.$company_name_session][$key]['quantity'];
         $celebrity_images = $_SESSION['cart_'.$company_name_session][$key]['celebrity_images'];
         $quantity = $_SESSION['cart_'.$company_name_session][$key]['quantity'];
         $price = $_SESSION['cart_'.$company_name_session][$key]['price'];
         $discount_type = $_SESSION['cart_'.$company_name_session][$key]['discount_type'];
         $discount = $_SESSION['cart_'.$company_name_session][$key]['discount'];
         $request_for = $_SESSION['cart_'.$company_name_session][$key]['request_for'];
         if($celebrity_images!='')
         {
            $celebrity_images=$cele_base_path_uploads."profile-pic/temp_file/".$celebrity_images;
         }
         else
         {
            $celebrity_images=$base_url_images."07.jpg";
         }

         if ($discount_type == 'percentage')
         {
            $discountt = $price*$discount;
            $total_discountt = $discountt/100;
            $total_discount = $price-$total_discountt;
         }
         else if($discount_type == 'price')
         {
               $total_discount = $price-$discount;
         }

         $cart_html_message.=' <li class="item d-flex justify-content-center align-items-center">
         <a class="product-image" href="'.$base_url.'celebrity-details/'.$user_unique_slug .'">
             <img class="blur-up lazyload" src="'.$celebrity_images.'" data-src="'.$celebrity_images.'" alt="image" title="">
         </a>
         <div class="product-details">
             <a class="product-title" href="'.$base_url.'celebrity-details/'.$user_unique_slug .'">'.ucfirst($user_name).'</a>
            <p style="margin-bottom:0px;"><span  style="font-size:10px;">Request for* </span><br><span style="font-size:8px;"><i class="an an-play" style="font-size:8px;"></i> '.$request_for.'</span></p>
             <div class="priceRow">
                 <div class="product-price">
                     <span class="money">'.$selected_currency_icon.' '.$total_discount.'</span>
                 </div>
             </div>
         </div>
         <div class="qtyDetail text-center">
             <div class="wrapQtyBtn">
                 <div class="qtyField">
                     <input type="text" name="quantity" value="'.$quantity.'" class="qty rounded-pill" readonly>
                 </div>
             </div>
             <a href="#" onclick="remove_from_cart('.$celebrity_id.')" class="remove"><i class="an an-times-r" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"></i></a>
         </div>
     </li>'; 
         $single_product_total_amount=$total_discount*$quantity;
         $cart_total_amount+=$single_product_total_amount;
         $total_product_show_in_cart=$total_product_show_in_cart + 1; 
      } 
      $cart_html_message.=' </ul>
        </div>
        <div class="minicart-bottom text-black">
             <div class="subtotal">
                <span>Total:</span>
                <span class="product-price">'.$selected_currency_icon.' '.$cart_total_amount.'</span>
            </div>
            <a href="'.$base_url.'checkout" class="w-100 p-2 my-2 btn btn-secondary rounded-pill proceed-to-checkout">Proceed to Checkout</a>
            <a href="'.$base_url.'cart" class="w-100 btn btn-outline-primary rounded-pill cart-btn">View Cart</a>
        </div>';
   } 
   else 
   {                  
      $cart_html_message.='<div class="minicart-content">
      <p>our cart bag is empty.</p></div>';
   }
}
   $return["status"] = "success";
   $return["cart_html_message"] = $cart_html_message;
   echo json_encode($return);
   exit();
   ?>