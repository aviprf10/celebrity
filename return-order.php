<?php
include 'common/config.php';
include "common/check_login.php";
include 'common/common_code.php';
if ($user == 1)
{
    if (isset($_GET['order_id']))
    {
        if (count($product_data_array) > 0)
        {
            ?>
<!DOCTYPE html>
<html lang="en-US" id="parallax_scrolling">
   <head>
      <title>Return Order | <?php echo $company_title;?></title>
      <?php include'common/header-css.php';?>
      <style type="text/css">
         table tbody td{font-size: 13px;padding: 0px;}
         .product-thumbnail{width: 130px;}
         form #shopping-cart-table{margin-top: 0px !important;}

      </style>
   </head>
   <body class="page-template-default page page-id-8 logged-in cms-index-index cms-home-page woocommerce-account woocommerce-page cms-index-index inner-page" >
     <div id="loading">
         <center><img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading..."/></center>
      </div>
      <div id="main_site_div" style="display:none;">
      <div id="page" class="page catalog-category-view">
         <!-- Header -->
         <?php include "common/header.php";?>
         <!-- end header -->
         <div class="page-heading ">
            <div class="breadcrumbs">
            </div>
            <div class="page-title">
               <h1 class="entry-title">
                  Return Order  
               </h1>
            </div>
         </div>
         <div class="main-container col1-layout wow bounceInUp">
            <div class="container">
               <div class="row">
                  <div class="col-main col-sm-12" id="content">
                     <div class="page-content">
                        <div class="woocommerce">
                           <?php include'common/account-sidebar.php';?>
                           <div class="woocommerce-MyAccount-content">
                              <h3 class="m-0" style="border:none;padding: 0px;">Return Order(Order id:<?php echo $order_id; ?>)</h3>
                              <br/>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="cart wow bounceInUp">
                                        <form method="POST" id="return_order_option_form" data-validate="parsley">
                                <input type="hidden" name="order_id" id="order_id" value="<?php echo $order_id; ?>">
                                          <div class="table-responsive"  id="shopping-cart-table">
                                             <table class="data-table cart-table"   style="margin-top: 0px;">
                                                <thead>
                                                   <tr>
                                                      <th class="product-thumbnail">Image</th>
                                                      <th>Order detail</th>
                                                      <th>Return Qty</th>
                                                      <th>Return Reason</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                        if (count($product_data_array) > 0)
                                        {
                                            $order_total_amount = 0;
                                            $single_product_total_amount = 0;
                                            foreach ($product_data_array as $product_data)
                                            {

                                                $product_title = $product_data['product_name'];
                                                $product_variant_seo_url = $product_data['product_variant_seo_url'];
                                                $product_image1 = $product_data['photo1'];
                                                $product_variant_one = $product_data['variant_one'];
                                                $product_variant_two = $product_data['variant_two'];
                                                $product_quantity = $product_data['single_product_total_quantity'];
                                                $product_price = $product_data['price'];
                                                $product_full_title = $product_title." ".$product_variant_one." ".$product_variant_two;
                                                $order_id = $product_data['order_id'];
                                                $order_unique_key = $product_data['order_unique_key'];
                                                $order_status = $product_data['order_status'];
                                                $return_status = $product_data['return_status'];
                                                $single_product_total_amount = $product_data['single_product_total_amount'];
                                                $order_status_list = $product_data['order_status_list'];
                                                $order_status_array = explode(',', $order_status_list);
                                                $return_order_status_list = $product_data['return_order_status_list'];
                                                $return_order_status_array = explode(',', $return_order_status_list);
                                                $order_total_amount += $single_product_total_amount;
                                                ?>
                                                <tr class="product-thumbnail">
                                                    <td class="product-name">
                                                        <div class="img_item">
                                                            <a class="image text-left" href="<?php echo $base_url; ?>product-detail/<?php echo $product_variant_seo_url; ?>"><img
                                                                        src="<?php echo $base_url_uploads; ?>product/size_extra_small/<?php echo $product_image1; ?>"
                                                                        alt="<?php echo $product_full_title; ?>"
                                                                        title="<?php echo $product_full_title; ?>"></a>
                                                        </div>
                                                       
                                                    </td>
                                                    <td class="product-name">
                                                       <div class="link">
                                                            <p class="product-title"><a class="title text-left" href="<?php echo $base_url; ?>product-detail/<?php echo $product_variant_seo_url; ?>" style="font-size: 13px;" title="<?php echo $product_full_title; ?>"><?php echo $product_full_title; ?></a>
                                                            </p>
                                                            <ul class="list list-unstyled">
                                                                  <li style="margin-top: 0px;"><span class="text-semibold">Qty: </span> <?php echo $product_quantity; ?>,<span class="text-semibold">Price: </span><?php echo $selected_currency_icon; ?> <?php echo $product_price; ?></li>
                                                                
                                                                  <li style="margin-top: 0px;"><span  class="text-semibold">Sub Total: </span><?php echo $selected_currency_icon; ?> <?php echo $single_product_total_amount; ?></li>
                                                        </ul>
                                                    </td>
                                                    <td class="product-add-to-cart">
                                                        <select id="return_qty_<?php echo $order_unique_key; ?>" name="return_qty_<?php echo $order_unique_key; ?>" style="width: 65px"
                                                            <?php
                                                            if ((in_array(7, $order_status_array) && ($return_status == 1 || $return_status == 6) && $is_returnable == 1 && $return_period > 0) ||
                                                                ($order_status == 6 && $product_data['is_returnable'] == 1 && $product_data['return_till_date'] >= date('Y-m-d') && $is_returnable == 1 && $return_period > 0)
                                                            )
                                                            {

                                                            }
                                                            else
                                                            {
                                                                echo "disabled";
                                                            }
                                                            ?>>
                                                            <?php
                                                            for ($x = 0; $x <= $product_quantity; $x++)
                                                            {
                                                                if (in_array(7, $order_status_array))
                                                                {
                                                                    $return_qty = $product_data['single_product_total_return_quantity'];
                                                                    ?>
                                                                    <option <?php if ($x == $return_qty)
                                                                    {
                                                                        echo "selected='selected'";
                                                                    } ?> value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                                    <?php
                                                                }
                                                                else
                                                                {
                                                                    ?>
                                                                    <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td class="product-add-to-cart">
                                                        <?php
                                                        $return_status_html_message = '';
                                                        if (in_array(7, $order_status_array) && in_array(1, $return_order_status_array))
                                                        {
                                                            $return_status_html_message .= '<span class="label label-primary" style="padding: 3px;color:#fff;background-color: #2196F3;">Pending Request(You can modify)</span>';
                                                        }
                                                        else if (in_array(7, $order_status_array) && in_array(2, $return_order_status_array))
                                                        {
                                                            $return_status_html_message .= '<span class="label label-info" style="padding: 3px;color:#fff;background-color: #00BCD4;">Accept</span>';
                                                        }
                                                        else if (in_array(7, $order_status_array) && in_array(3, $return_order_status_array))
                                                        {
                                                            $return_status_html_message .= '<span class="label label-info" style="padding: 3px;color:#fff;background-color: #00BCD4;">In Transit</span>';
                                                        }
                                                        else if (in_array(7, $order_status_array) && in_array(4, $return_order_status_array))
                                                        {
                                                            $return_status_html_message .= '<span class="label label-success" style="padding: 3px;color:#fff;background-color: #4CAF50;">Completed</span>';
                                                        }
                                                        else if (in_array(7, $order_status_array) && in_array(5, $return_order_status_array))
                                                        {
                                                            $return_status_html_message .= '<span class="label label-inverse" style="padding: 3px;color:#fff;background-color: #2a2a2a;">Rejected</span>';
                                                        }
                                                        else if (in_array(7, $order_status_array) && in_array(6, $return_order_status_array))
                                                        {
                                                            $return_status_html_message .= '<span class="label label-inverse" style="padding: 3px;color:#fff;background-color: #2a2a2a;">Return Canceled(You can return)</span>';
                                                        }
                                                        else if ((in_array(7, $order_status_array) && in_array(1, $return_order_status_array) && $is_returnable == 1 && $return_period > 0) || ($order_status == 6 && $product_data['is_returnable'] == 1 && $product_data['return_till_date'] >= date('Y-m-d') && $is_returnable == 1 && $return_period > 0))
                                                        {
                                                            $return_status_html_message .= '<span class="label label-primary" style="padding: 3px;color:#fff;background-color: #2196F3;">You can return</span>';
                                                        }
                                                        else
                                                        {
                                                            $return_status_html_message .= '<span class="label label-inverse" style="padding: 3px;color:#fff;background-color: #2a2a2a;">Return Expired</span>';
                                                        }

                                                        echo 'Status:- <span id="return_order_status_div_'.$order_unique_key.'">' . $return_status_html_message.'</span>';
                                                                  
                                                                  $disable_return_reason = '';
                                                                  if (!((in_array(7, $order_status_array) && (in_array(1, $return_order_status_array) || in_array(6, $return_order_status_array)) && $is_returnable == 1 && $return_period > 0) ||
                                                                      ($order_status == 6 && $product_data['is_returnable'] == 1 && $product_data['return_till_date'] >= date('Y-m-d') && $is_returnable == 1 && $return_period > 0)))
                                                                  {
                                                                      $disable_return_reason = 'disabled';
                                                                  }
                                                                  if (in_array(7, $order_status_array) && in_array(1, $return_order_status_array))
                                                                      {
                                                                         $disable_return_reason = 'disabled';
                                                                      }
                                                                  $return_reason = '';
                                                                  if ($product_data['return_reason'] != '')
                                                                  {
                                                                      $return_reason = html_entity_decode($product_data['return_reason']);
                                                                  }
                                                                  ?>
                                                               <textarea style="margin: 5px 0px;" rows="1" name="return_reason_<?php echo $order_unique_key; ?>" id="return_reason_<?php echo $order_unique_key; ?>"
                                                                  class="input-full form-control" placeholder="Reason"
                                                                  style="margin-bottom:0px;" <?php echo $disable_return_reason; ?>><?php echo $return_reason; ?></textarea>
                                                               <input type="hidden" name="return_attachment_<?php echo $order_unique_key; ?>" id="return_attachment_<?php echo $order_unique_key; ?>" value="">
                                                               <input type="hidden" name="order_unique_key" id="order_unique_key" value="<?php echo $order_unique_key; ?>">
                                                            </div>
                                                            <div class="col-md-4"> 
                                                               <?php
                                                                  if (in_array(7, $order_status_array) && in_array(1, $return_order_status_array))
                                                                  {
                                                                      echo '<a  onclick="return_order_cancel(\''.$order_unique_key.'\')" class="button remove-item" title="Cancel"><span><span>Cancel item</span></span></a> ';
                                                                  }?>
                                                            </div>
                                                        
                                                    </td>
                                                </tr>
                                                      <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                             </table>
                                          </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 m-t-10">
                                    <div class="row">
                                       <div class="col-md-6">
                                          <p class="woocommerce-LostPassword">
                                             <a class="btn btn-theme" href="<?php echo $base_url;?>view-order/<?php echo $order_id; ?>" type="button">Back</a>
                                          </p>
                                       </div>
                                       <div class="col-md-6 pull-right" id="return_order_button_div">
                                        <?php
                                        if ($is_returnable == 1 && $return_period > 0)
                                        {
                                            ?>
                                            <div class="pull-right" id="return_order_button_div">
                                                <?php
                                                if ($return_option_available == 1)
                                                {
                                                    ?>
                                                    <!-- <a href="--><?php //echo $base_url; ?><!--return-order/--><?php //echo $order_id; ?><!--" class="btn btn-default">Return</a>-->
                                                    <input type="submit" class="btn btn-theme" value="Return Order">
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    </div>
                                 </div>
                              </div>
                                       </form>
                           </div>
                        </div>
                     </div>
                     <!-- .entry-content -->
                  </div>
               </div>
            </div>
         </div>
         <?php include'common/footer.php';?>
      </div>      
      </div>      
      <?php include "common/common-mobile-menu.php";?>
      <?php include'common/footer-js.php';?>     
     <script type="text/javascript">
         function return_order_cancel()
          {
             
              var order_id = $("#order_id").val();
              var order_unique_key = $("#order_unique_key").val();
              $.ajax(
                  {
                      url: "<?php echo $base_url;?>return-order-cancel-submit.php",
                      type: "POST",
                      data:  {"order_id": order_id, "order_unique_key": order_unique_key},
                      dataType: 'json',
                      encode: true,
                      beforeSend: function ()
                      {
                          $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
                      },
                      success: function (data)
                      {
                          $.unblockUI();
                          if (data.status == 'success')
                          {
                              $('#return_order_status_div_'+order_unique_key).html(data.return_order_status);
                              setTimeout(function(){
                               location.reload();
                              }, 1000);
                              $.growl.notice({ title:"Success",message: data.html_message });
                          }
                          else
                          {
                              $.growl.error({ title:"Error",message: data.html_message });
                              //$.notifyBar({cssClass: "error", html: data.html_message});
                          }
                      }
                  });
          }
     </script>
   </body>
</html>
  <?php
        }
        else
        {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'my-order">';
        }
    }
    else
    {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'my-order">';
    }
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>