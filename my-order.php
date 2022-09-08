<?php
include "common/config.php";    
include "common/check_login.php";
if($user == 1)
{
   if(isset($_GET["page"]))
   {
      $page = (int)$_GET["page"];
   }
   else
   {
      $page = 1;
   }
   $setLimit = 10;
   $pageLimit = ($page * $setLimit) - $setLimit;
   include 'common/common_code.php';
   include 'common/pagination.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>My Order | <?php echo $company_title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:keyword" content="<?php echo $meta_keyword;?>" />
    <meta property="og:title" content="<?php echo $title;?>" />
     <meta property="og:description" content="<?php echo $meta_description;?>" />
    <meta name="robots" content="noindex, follow" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="32x32" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="<?php echo $base_url_images; ?>fevicon.png" />
    <meta name="msapplication-TileImage" content="<?php echo $base_url_images; ?>fevicon.png" />
    <?php include "common/header-css.php";?>
</head>
<body class="category-page category-empty">
   <?php include 'common/header.php';?>
   <div id="page-content">
        <!--Collection Banner-->
        <div class="collection-header">
            <div class="collection-hero">
                <div class="collection-hero__image"></div>
                <div class="collection-hero__title-wrapper container">
                    <h1 class="collection-hero__title">My Order</h1>
                    <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="<?php echo $base_url; ?>" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">My Order</span></div>
                </div>
            </div>
        </div>
        <!--End Collection Banner-->

        <!--Container-->
        <div class="container pt-2">
            <div class="row mb-4 mb-lg-5 pb-lg-5">
                <?php include'common/account-sidebar.php';?>
                <div class="col-xl-9 col-lg-10 col-md-12">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard-content">
                        <div class="product-order">
                            <h3>My Orders</h3>
                            <?php
                           
                            if(count($order_data_array) > 0)
                            {
                                ?>
                            <div class="table-responsive order-table">
                                <table class="table table-bordered table-hover align-middle text-center mb-0">
                                    <thead class="alt-font">
                                        <tr>
                                            <th>Image</th>
                                            <th>Celebrity</th>
                                            <th>Request Details</th>
                                            <th>Date of Delevery</th>
                                            <th>Order Details</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                       
                                        foreach ($order_data_array as $order_data)
                                        { 
                                            $celebrity_id = $order_data['celebrity_id'];
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

                                            $celebrity_price = $order_data['price'];
                                            $discount_type = $order_data['discount_type'];
                                            $total_discout_price += $order_data['total_discout_price'];
                            
                                            
                                            if ($discount_type == 'percentage')
                                            {
                                                $discount = $celebrity_price*$total_discout_price;
                                                $total_discountt = $discount/100;
                                                $total_discount = $celebrity_price-$total_discountt;
                                            }
                                            else if($discount_type == 'price')
                                            {
                                                $total_discount = $celebrity_price-$total_discout_price;
                                            }

                                           
                                            ?>
                                        <tr>
                                            <td style="text-align: center; padding:10px;">
                                                <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $user_unique_slug; ?>">
                                                    <img  src="<?php echo $cele_base_path_uploads?>profile-pic/temp_file/<?php echo $celebrity_images; ?>"
                                                            alt="<?php echo $user_name; ?>"
                                                            title="<?php echo $user_name; ?>"
                                                            style="width: 100px; height:100px;">
                                                </a><br/>
                                                            
                                            </td>
                                            <td>
                                                <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $user_unique_slug; ?>" title="<?php echo $user_name; ?>">
                                                    <?php echo $user_name; ?>
                                                </a>
                                                <div> 
                                                    <?php echo $selected_currency_icon; ?><?php echo $total_discount; ?>
                                                </div>
                                            </td>
                                            <td>
                                            <strong>Name: </strong><?php echo $order_data['name']; ?>
                                                <div><strong>Messages:</strong> <?php echo $order_data['user_message']; ?></div>
                                                <div><strong>Request For*:</strong> <?php echo $order_data['request_for']; ?></div>
                                            </td>
                                            <td>
                                                <?php echo date('d-m-Y', strtotime($order_data['date_of_delevery'])); ?>
                                            </td>
                                            <td style="padding:10px;">
                                                <div><?php
                                                    if ($order_data['total_product'] > 1)
                                                    {
                                                        ?>
                                                        <b class="text-semibold no-margin-top"><a href="<?php echo $base_url; ?>view-order/<?php echo $order_data['order_id']; ?>"  style="color:#0a4d87">+<?php echo $order_data['total_product'] - 1; ?>&nbsp;More
                                                                Items</a></b>
                                                        <?php
                                                    }
                                                    ?></div>  
                                                        <strong>Order Id : </strong> <?php echo $order_data['order_id']; ?><br>
                                                        <strong>Order Date : </strong> <?php echo date('d-M-Y H:i', strtotime($order_data['order_date_time'])); ?> <br/>
                                                        <!-- <?php
                                                        // if ($order_data['shipping_charges'] > 0)
                                                        // {
                                                            ?>
                                                            <strong>Shipping Charges : </strong> <?php //echo $selected_currency_icon; ?><?php //echo $order_data['shipping_charges']; ?><br>
                                                            <strong>Total : </strong> <?php //echo $selected_currency_icon; ?><?php //echo $order_data['shipping_charges']+$order_data['price']; ?><br>
                                                            <?php
                                                        //} -->

                                                        // if ($order_data['coupon_discount'] > 0)
                                                        // {
                                                            ?>
                                                            <strong>Coupon Discount : </strong> <?php //echo $selected_currency_icon; ?><?php //echo $order_data['coupon_discount']; ?><br>
                                                            <?php
                                                        //} 
                                                        ?>
                                                        <strong>Payment Type : </strong> <?php
                                                        //$mod_of_payment = $order_data['mod_of_payment'];
                                                        // if ($mod_of_payment == 1)
                                                        // {
                                                            ?>
                                                            <span class="label label-success" style="padding: 3px;color:#fff;background-color: #4CAF50;">Online</span>
                                                            <?php
                                                        // }
                                                        // else
                                                        // {
                                                            ?>
                                                            <span class="label label-success" style="padding: 3px;color:#fff;background-color: #4CAF50;">COD</span>
                                                            <?php
                                                        //}
                                                        ?>                        -->
                                            </td>
                                            <td  style="text-align: center; padding:10px;" id="my_order_status_<?php echo $order_data['order_id']; ?>">
                                                <?php
                                                    $order_status = $order_data['order_status'];
                                                    $order_status_array = array_unique(explode(',', $order_data['order_status_list']));
                                                    $partial_return = 0;

                                                    if ((count($order_status_array) > 1 && in_array(7, $order_status_array)))
                                                    {
                                                        $partial_return = 1;
                                                    }
                                                    $status_html_message = '';
                                                    if ($order_status == '0')
                                                    {
                                                        $status_html_message .= '<span class="label label-primary " style="padding: 3px;color:#fff;background-color: #2196F3;">In Process</span>';
                                                    }
                                                    else if ($order_status == '1')
                                                    {
                                                        $status_html_message .= '<span class="label label-warning" style="padding: 3px;color:#fff;background-color: #FF5722;">To be Picked</span>';
                                                    }
                                                    else if ($order_status == '2')
                                                    {
                                                        $status_html_message .= '<span class="label label-teal" style="padding: 3px;color:#fff;background-color: #6bccb4;">To Dispatch</span>';
                                                    }
                                                    else if ($order_status == '3')
                                                    {
                                                        $status_html_message .= '<span class="label label-info" style="padding: 3px;color:#fff;background-color: #00BCD4;">To Handover</span>';
                                                    }
                                                    else if ($order_status == '4')
                                                    {
                                                        $status_html_message .= '<span class="label label-info" style="padding: 3px;color:#fff;background-color: #00BCD4;">In Transit</span>';
                                                    }
                                                    else if ($order_status == '5')
                                                    {
                                                        $status_html_message .= '<span class="label label-default" style="padding: 3px;color:#fff; background-color: #999;">Manual</span>';
                                                    }
                                                    else if ($order_status == '6')
                                                    {
                                                        if($partial_return)
                                                        {
                                                            $status_html_message .= '<span class="label label-inverse" style="padding: 3px;color:#fff;background-color: #2a2a2a;">Partial Return</span>';
                                                        }
                                                        else
                                                        {
                                                            $status_html_message .= '<span class="label label-success" style="padding: 3px;color:#fff;background-color: #4CAF50;">Delivered</span>';
                                                        }
                                                    }
                                                    else if ($order_status == '7')
                                                    {
                                                        if($partial_return)
                                                        {
                                                            $status_html_message .= '<span class="label label-inverse" style="padding: 3px;color:#fff;background-color: #2a2a2a;">Partial Return</span>';
                                                        }
                                                        else
                                                        {
                                                            $status_html_message .= '<span class="label label-inverse" style="padding: 3px;color:#fff;background-color: #2a2a2a;">Return</span>';
                                                        }
                                                    }
                                                    else if ($order_status == '8')
                                                    {
                                                        $status_html_message .= '<span class="label label-inverse" style="padding: 3px;color:#fff;background-color: #2a2a2a;">Rejected</span>';
                                                    }
                                                    else if ($order_status == '9')
                                                    {
                                                        $status_html_message .= '<span class="label label-inverse" style="padding: 3px;color:#fff;background-color: #2a2a2a;">Cancelled</span>';
                                                    }
                                                    else if ($order_status == '10')
                                                    {
                                                        $status_html_message .= '<span class="label label-inverse" style="padding: 3px;color:#fff;background-color: #2a2a2a;">UnDelivered</span>';
                                                    }
                                                    echo $status_html_message;
                                                    ?>
                                            </td>
                                            <td  style="text-align: center; padding:10px;">
                                                <div class="m-b-5">
                                                    <a class="button add_to_cart"  href="<?php echo $base_url; ?>view-order/<?php echo $order_data['order_id']; ?>" class="btn btn-default" id="edit-item" title="View" style="text-decoration: none;"> <i class="icon an an-eye"></i> </a>
                                                        <?php
                                                        if ($order_status <= 2)
                                                        {
                                                            ?>
                                                            <span id="cancel_order_button_div_<?php echo $order_data['order_id']; ?>" style="margin-top: 10px;">
                                                                <a  onclick="cancel_order_dialog('<?php echo $order_data['order_id']; ?>')" class="button remove-item" title="Cancel order" style="cursor:pointer;"><i class="icon an an-times-r" aria-hidden="true"></i></a>
                                                                
                                                            </span>
                                                            <?php
                                                        }
                                                        ?>
                                                </div>
                                            </td>
                                        </tr>
                                            <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                            }
                            else
                            {
                                ?>
                                <br>
                                        <center>
                                        <h6><i class="fa fa-thumbs-down" title="No Data found" style="font-size:26px"></i></h6>
                                        <h4>No Data Found!</h4>
                                        </center>
                                        <br> 
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <!-- End Tab panes -->
                </div>
            </div>
            <!--End Main Content-->
        </div>
        <!--End Container-->
    </div> 
   <br><br>
    <?php include 'common/footer.php';?>
    <?php include 'common/footer-js.php';?>
   </body>    
</html>  
<?php 
} 
else
{
   echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$base_url.'registration">';
}
?>     