<?php
include "common/config.php";    
include "common/check_login.php";
include 'common/common_code.php';
if($brand == 1)
{
    
    if (isset($_GET['order_id']))
    {
       
        if (count($celebrity_data_array) > 0)
        {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>View Order | <?php echo $company_title;?></title>
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
                            <div id="address" class="address tab-pane">
                                <h3 style="margin-bottom:0px;">View Order</h3>
                                <p class="xs-fon-13 margin-10px-bottom">The following addresses will be used on the checkout page by default.</p>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <h4 class="billing-address">Delivery Address</h4>
                                        <span><?php echo $celebrity_data_array[0]['user_fname'] . ' ' . $celebrity_data_array[0]['user_lname']; ?></span><br/>
                                        <?php
                                        if ($celebrity_data_array[0]['address1'] != '')
                                        {
                                            echo $celebrity_data_array[0]['address1'] . ",<br>" . $celebrity_data_array[0]['city'] . " - " . $celebrity_data_array[0]['pincode'] . ", <br>" .
                                                $celebrity_data_array[0]['state'] . ", " . $celebrity_data_array[0]['country'] . ".";
                                        }
                                        ?>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <h4 class="billing-address">Payment Details</h4>
                                        <?php
                                            if (count($celebrity_data_array) > 0)
                                            {
                                                $single_celebrity_total_amount = 0;
                                                $order_total_amount = 0;
                                                $order_coupon_discount = 0;

                                                foreach ($celebrity_data_array as $celebrity_data)
                                                {
                                                    $celebrity_quantity = $celebrity_data['quantity'];
                                                    $celebrity_price = $celebrity_data['price'];
                                                    $shipping_charges = $celebrity_data['shipping_charges'];
                                                    $order_coupon_discount += $celebrity_data['coupon_discount'];
                                    
                                                    $single_celebrity_total_amount = $celebrity_price * $celebrity_quantity;
                                                    $order_total_amount += $single_celebrity_total_amount;
                                                }
                                                $final_order_total_amount = $order_total_amount + $shipping_charges - $order_coupon_discount;
                                            }
                                            ?>
                                            <span> <b> Subtotal :</b> </span> <?php echo $selected_currency_icon; ?> <?php echo $order_total_amount; ?>.00 <br/>
                                            <?php
                                            if ($order_coupon_discount > 0)
                                            {
                                                ?>
                                                <span><b> Discount(-) : </b></span> <?php echo $selected_currency_icon; ?><?php echo $order_coupon_discount; ?><br>
                                                <?php
                                            }
                                            if ($shipping_charges > 0)
                                            {
                                                ?>
                                                <span><b> Shipping Charges(+) : </b></span> <?php echo $selected_currency_icon; ?><?php echo $shipping_charges; ?><br>
                                                <?php
                                            }

                                            ?>

                                            <span><b> Order Total : </b></span> <?php echo $selected_currency_icon; ?> <?php echo $final_order_total_amount; ?>.00 <br/>
                                    </div>
                                </div>
                            </div><br>
                            <?php
                           
                            if(count($celebrity_data_array) > 0)
                            {
                                ?>
                            <div class="table-responsive order-table">
                                <table class="table table-bordered table-hover align-middle text-center mb-0">
                                    <thead class="alt-font">
                                        <tr>
                                            <th style="text-align: center; padding:10px;">Image</th>
                                            <th style="text-align: center; padding:10px;"> Order Details</th>
                                            <th style="text-align: center; padding:10px;"> Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                       
                                        foreach ($celebrity_data_array as $order_data)
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
                                            
                                            $celebrity_quantity = $order_data['quantity'];
                                            $celebrity_price = $order_data['price']+$order_data['shipping_charges'];
                                            $order_id = $order_data['order_id'];
                                            $order_status = $order_data['order_status'];
                                            $return_status = $order_data['return_status'];

                                            $single_celebrity_total_amount = $celebrity_price * $celebrity_quantity;
                                            $order_total_amount += $single_celebrity_total_amount;
                                            ?>
                                        <tr>
                                            <td style="text-align: center; padding:10px;">
                                                <a class="image text-left" href="<?php echo $base_url; ?>celebrity-details/<?php echo $user_unique_slug; ?>">
                                                <img src="<?php echo $cele_base_path_uploads; ?>profile-pic/temp_file/<?php echo $celebrity_images; ?>"
                                                        alt="<?php echo $user_name; ?>" style="width:75px; height:75px;" title="<?php echo $user_name; ?>">
                                                </a>
                                            </td>
                                            <td style="text-align: center; padding:10px;">
                                                <a class="title text-left" href="<?php echo $base_url; ?>celebrity-details/<?php echo $user_unique_slug; ?>"
                                                title="<?php echo $user_name; ?>">
                                                <?php echo $user_name; ?>
                                            </a><br/>
                                                <span class="text-semibold">Order ID:</span> &nbsp;<?php echo $order_id; ?><br/>
                                                <span>Price : </span> <?php echo $selected_currency_icon; ?> <?php echo $celebrity_price; ?>
                                            </td>
                                            <td style="text-align: center; padding:10px;">
                                            <?php
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
                                                    $status_html_message .= '<span class="label label-success" style="padding: 3px;color:#fff;background-color: #4CAF50;">Delivered</span>';
                                                }
                                                else if ($order_status == '7')
                                                {
                                                    $status_html_message .= '<span class="label label-inverse" style="padding: 3px;color:#fff;background-color: #2a2a2a;">Return</span>';
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

                                                $return_status_html_message = '';
                                                if ($return_status == '1')
                                                {
                                                    $return_status_html_message .= '<span class="label label-primary" style="padding: 3px;color:#fff;background-color: #2196F3;">Pending Request</span>';
                                                }
                                                else if ($return_status == '2')
                                                {
                                                    $return_status_html_message .= '<span class="label label-info" style="padding: 3px;color:#fff;background-color: #00BCD4;">Accept</span>';
                                                }
                                                else if ($return_status == '3')
                                                {
                                                    $return_status_html_message .= '<span class="label label-info" style="padding: 3px;color:#fff;background-color: #00BCD4;">In Transit</span>';
                                                }
                                                else if ($return_status == '4')
                                                {
                                                    $return_status_html_message .= '<span class="label label-success" style="padding: 3px;color:#fff;background-color: #4CAF50;">Completed</span>';
                                                }
                                                else if ($return_status == '5')
                                                {
                                                    $return_status_html_message .= '<span class="label label-inverse" style="padding: 3px;color:#fff;background-color: #2a2a2a;">Rejected</span>';
                                                }
                                                else if ($return_status == '6')
                                                {
                                                    $return_status_html_message .= '<span class="label label-inverse" style="padding: 3px;color:#fff;background-color: #2a2a2a;">Return Cancelled</span>';
                                                }
                                                echo "&nbsp;". $return_status_html_message;
                                                ?>
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