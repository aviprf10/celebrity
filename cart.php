<?php
include "common/config.php";    
include "common/check_login.php";
include "common/common_code.php";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Cart | <?php echo $company_title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:keyword" content="<?php echo $company_title;?>" />
    <meta property="og:title" content="<?php echo $company_title;?>" />
     <meta property="og:description" content="<?php echo $company_title;?>" />
    <meta name="robots" content="noindex, follow" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="32x32" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="<?php echo $base_url_images; ?>fevicon.png" />
    <meta name="msapplication-TileImage" content="<?php echo $base_url_images; ?>fevicon.png" />
    <?php include "common/header-css.php";?>
</head>
<body class="my-wishlist-page">
   <?php include "common/header.php";?>
   <div id="page-content">  
      <!--Collection Banner-->
      <div class="collection-header">
         <div class="collection-hero">
            <div class="collection-hero__image"></div>
            <div class="collection-hero__title-wrapper container">
                  <h1 class="collection-hero__title">Cart</h1>
                  <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="<?php echo $bse_url; ?>" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Cart</span></div>
            </div>
         </div>
      </div>
      <!--End Collection Banner-->

      <!--Main Content-->
      <div class="container">
         <!--Cart Page-->
         <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                   <form action="#" method="post" class="cart style1">
                     <table width="100%" id="shopping-cart-table">
                        <thead class="cart__row cart__header small--hide" style="border-bottom: 1px solid #c7c7c7;">
                           <?php if($total_cart_celebrity > 0) { ?>
                              <tr>
                                 <th style="padding:10px; text-align:center;">Image</th>
                                 <th style="padding:10px; text-align:center;">Celebrity</th>
                                 <th style="padding:10px; text-align:center;">Price</th>
                                 <th style="padding:10px; text-align:center;">Request For</th>
                                 <th style="padding:10px; text-align:center;">Subtotal</th>
                                 <th>Remove</th>
                              </tr>
                           <?php } ?>   
                        </thead>
                        <tbody>
                        <?php
                        $cart_page_sub_total = 0;
                        $cart_page_grand_total = 0;
                        if($user == 1)
                        {  
                           if(count($cart_data_array1)>0)
                           {
                              $single_celebrity_total_amount = 0;
                              foreach($cart_data_array1 as $celebrity_data)
                              {
                                    $celebrity_id = $celebrity_data['celebrity_id'];
                                    $user_data_array = array();
                                    $get_user_query = "select * from user where status='1' and is_deleted='0' and id='$celebrity_id'";
                                    $result_user_data = mysqli_query($db_mysqli,$get_user_query);
                                    while ($row_user_data = mysqli_fetch_assoc($result_user_data))
                                    {
                                          $user_data_array[] = $row_user_data;
                                    } 

                                    $user_name = $user_data_array[0]['user_name'];
                                    $user_unique_slug = $user_data_array[0]['user_unique_slug'];
                                    $celebrity_images = $user_data_array[0]['profile_pic'];
                                    //main celebrity data   
                                    if($celebrity_images!='')
                                    {
                                       $celebrity_images=$cele_base_path_uploads."profile-pic/temp_file/".$celebrity_images;
                                    }
                                    else
                                    {
                                       $celebrity_images=$base_url_images."07.jpg";
                                    }  

                                    $quantity = $celebrity_data['quantity']; 
                                    $price = $celebrity_data['price']; 
                                    $celebrity_variant_mrp = $celebrity_data['mrp'];
                                    $request_for = $celebrity_data['request_for'];
                                    $discount_type = $celebrity_data['discount_type'];
                                    $discount = $celebrity_data['discount'];
                                    
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
                              
                                    $single_celebrity_total_amount = $quantity * $total_discount;
                                    $cart_page_sub_total += $single_celebrity_total_amount; 
                                    $cart_page_grand_total += $single_celebrity_total_amount; 
                                    $order_total_amount += $single_celebrity_total_amount; 
                                 ?>
                                 <tr class="cart_item"  id="row_<?php echo $celebrity_id;?>" style="border-bottom: 1px solid #dbdbdb;">
                                    <td style="padding:10px; text-align:center;">
                                       <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $user_unique_slug; ?>">
                                          <img class="cart__image blur-up lazyload" data-src="<?php echo $celebrity_images; ?>" src="<?php echo $celebrity_images; ?>" alt="" width="80" /></a>
                                    </td>
                                    <td style="padding:10px; text-align:center;">
                                       <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $user_unique_slug; ?>"><?php echo ucfirst($user_name); ?></a>
                                       </td>
                                    <td class="cart__price-wrapper cart-flex-item text-center small--hide">
                                       <span class="money"><?php echo $selected_currency_icon; ?> <?php echo $price; ?></span>
                                    </td>
                                    <td style="padding:10px; text-align:center;">
                                       <p style="margin-bottom:0px;">
                                          <span  style="font-size:10px;">Request for* </span><br>
                                             <?php if($request_for =='video_call') ?>
                                             <span style="font-size:8px;">
                                                <i class="an an-play" style="font-size:8px;"></i> 
                                                   Video Call
                                             </span>
                                       </p>
                                    </td>
                                    <td style="padding:10px; text-align:center;">
                                       <?php echo $selected_currency_icon;?><?php echo $single_celebrity_total_amount;?>
                                    </td>
                                    <td style="padding:10px; text-align:center;">
                                       <a href="#" onclick="remove_from_cart('<?php echo $celebrity_id; ?>')" class="btn btn--secondary cart__remove remove-icon position-static" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Remove item" aria-label="Remove item"><i class="icon an an-times-r"></i></a></td>
                                    
                                 </tr>
                              <?php
                              }
                                 //$cart_page_grand_total += $local_shipping; 
                           }
                           else
                           {
                              ?>
                              <tr>
                                 <td colspan="6" style="border:none">
                                    <div style="clear:both"></div>
                                    <center><img src="<?php echo $base_url_images;?>empty-cart.png"></center>
                                 </td>
                              </tr>
                              <?php
                           }
                        }
                        else
                        {
                              if(isset($_SESSION) && (count($_SESSION['cart_'.$company_name_session])>0))
                              {
                                 $single_celebrity_total_amount=0;
                                 foreach($_SESSION['cart_'.$company_name_session] as $celebrity_data)
                                 {
                                    
                                    $celebrity_id = $celebrity_data['celebrity_id'];
                                    $user_data_array = array();
                                    $get_user_query = "select * from user where status='1' and is_deleted='0' and id='$celebrity_id'";
                                    $result_user_data = mysqli_query($db_mysqli,$get_user_query);
                                    while ($row_user_data = mysqli_fetch_assoc($result_user_data))
                                    {
                                          $user_data_array[] = $row_user_data;
                                    } 

                                    $user_name = $user_data_array[0]['user_name'];
                                    $user_unique_slug = $user_data_array[0]['user_unique_slug'];
                                    $celebrity_images = $user_data_array[0]['profile_pic'];
                                    //main celebrity data   
                                    if($celebrity_images!='')
                                    {
                                       $celebrity_images=$cele_base_path_uploads."profile-pic/temp_file/".$celebrity_images;
                                    }
                                    else
                                    {
                                       $celebrity_images=$base_url_images."07.jpg";
                                    }  

                                    $quantity = $celebrity_data['quantity']; 
                                    $price = $celebrity_data['price']; 
                                    $celebrity_variant_mrp = $celebrity_data['mrp'];
                                    $request_for = $celebrity_data['request_for'];
                                    $discount_type = $celebrity_data['discount_type'];
                                    $discount = $celebrity_data['discount'];
                                    
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
                              
                                    $single_celebrity_total_amount = $quantity * $total_discount;
                                    $cart_page_sub_total += $single_celebrity_total_amount; 
                                    $cart_page_grand_total += $single_celebrity_total_amount; 
                                    $order_total_amount += $single_celebrity_total_amount; 
                                   
                                    ?>
                                    <tr class="cart_item"  id="row_<?php echo $celebrity_id;?>" style="border-bottom: 1px solid #dbdbdb;">
                                       <td style="padding:10px; text-align:center;">
                                          <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $user_unique_slug; ?>">
                                             <img class="cart__image blur-up lazyload" data-src="<?php echo $celebrity_images; ?>" src="<?php echo $celebrity_images; ?>" alt="" width="80" /></a>
                                       </td>
                                       <td style="padding:10px; text-align:center;">
                                          <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $user_unique_slug; ?>"><?php echo ucfirst($user_name); ?></a>
                                        </td>
                                       <td class="cart__price-wrapper cart-flex-item text-center small--hide">
                                          <span class="money"><?php echo $selected_currency_icon; ?> <?php echo $price; ?></span>
                                       </td>
                                       <td style="padding:10px; text-align:center;">
                                          <p style="margin-bottom:0px;">
                                             <span  style="font-size:10px;">Request for* </span><br>
                                               <?php if($request_for =='video_call') ?>
                                                <span style="font-size:8px;">
                                                   <i class="an an-play" style="font-size:8px;"></i> 
                                                      Video Call
                                                </span>
                                          </p>
                                       </td>
                                       <td style="padding:10px; text-align:center;">
                                        <?php echo $selected_currency_icon;?><?php echo $single_celebrity_total_amount;?>
                                       </td>
                                      <td style="padding:10px; text-align:center;">
                                         <a href="#" onclick="remove_from_cart('<?php echo $celebrity_id; ?>')" class="btn btn--secondary cart__remove remove-icon position-static" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Remove item" aria-label="Remove item"><i class="icon an an-times-r"></i></a></td>
                                       
                                    </tr>
                             <?php
                                 }
                                 //$cart_page_grand_total += $local_shipping; 
                              }
                              else
                              {
                                 ?>
                                 <tr>
                                    <td colspan="6" style="border:none">
                                       <div style="clear:both"></div>
                                       <center><img src="<?php echo $base_url_images;?>empty-cart.png"></center>
                                    </td>
                                 </tr>
                                 <?php   
                              } 
                           }
                           ?>       
                        </tbody>
                        <tfoot>
                              <tr>
                                 <td colspan="3" class="text-start pt-3"><a href="<?php echo $base_url; ?>" class="btn btn--link d-inline-flex align-items-center btn--small p-0 cart-continue"><i class="me-1 icon an an-angle-left-l"></i><span class="text-decoration-underline">Continue shopping</span></a></td>
                                 <td colspan="3" class="text-end pt-3">
                                 <?php
                                 if(($total_cart_celebrity > 0 && $user == 1) || (count($_SESSION['cart_'.$company_name_session]) > 0 && $user != '1') ) 
                                 { 
                                    ?>
                                    <div class="solid-border">	
                                       <div class="row border-bottom pb-2">
                                          <span class="col-6 col-sm-7 cart__subtotal-title">Subtotal</span>
                                          <span class="col-6 col-sm-4 text-right"><span class="money" id="cart_page_sub_total"><?php echo $selected_currency_icon; ?> <?php echo $cart_page_sub_total;?></span></span>
                                       </div>
                                    </div><br>
                                    <p>Shipping calculated at checkout</p>
                                 <?php 
                                       } 
                                       ?>    
                                    <button onclick="location.href = '<?php echo $base_url;?>checkout'" class="btn btn--small d-inline-flex align-items-center rounded cart-continue ml-2" type="button"><i class="me-1 icon an an-sync-ar d-none"></i>Proceed to Checkout</button>
                                 </td>
                              </tr>
                        </tfoot>
                     </table> 
                  </form>                   
            </div>
         </div>
      </div>
      <!--End Main Content-->
</div>
   
    <?php include 'common/footer.php';?>
    <?php include 'common/footer-js.php';?>

 </body>    
</html>