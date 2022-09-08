<?php
include "common/config.php";    
include "common/check_login.php";
include "common/common_code.php";
if($user == 1)
{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Account Dashboard | <?php echo $company_title;?></title>
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
                    <h1 class="collection-hero__title">Account Dashboard</h1>
                    <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="<?php echo $base_url; ?>" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Account Dashboard</span></div>
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
                           <h2>Account Dashboard</h2>
                           <br/>
                           <p>Hello <strong><?php echo $loggedin_user_name; ?></strong> (<a href="?<?php echo $base_url;?>logout">Log out</a>)</p>
                           <p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                           <div class="row m-t-30">
                              <div class="col-md-4 col-sm-6">
                                 <div class="form-group">
                                    <div class="add_cart">
                                       <a class="single_add_to_cart_button add_to_cart_button  product_type_simple ajax_add_to_cart button btn-cart custom-edit-account" data-quantity="1" data-product_id="70" href="<?php echo $base_url;?>account-information">
                                          <span>Edit Account</span>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-6">
                                 <div class="form-group">
                                       <div class="add_cart">
                                       <a class="single_add_to_cart_button add_to_cart_button  product_type_simple ajax_add_to_cart button btn-cart custom-my-order" data-quantity="1" data-product_id="70" href="<?php echo $base_url;?>my-order">
                                          <span>My Orders</span>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-6">
                                 <div class="form-group">
                                    <div class="add_cart">
                                       <a class="single_add_to_cart_button add_to_cart_button  product_type_simple ajax_add_to_cart button btn-cart custom-address" data-quantity="1" data-product_id="70" href="<?php echo $base_url;?>address-book">
                                          <span>Address</span>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                              
                              <!-- <div class="col-md-4 col-sm-6">
                                 <div class="form-group">
                                 <div class="add_cart">
                                    <a class="single_add_to_cart_button add_to_cart_button  product_type_simple ajax_add_to_cart button btn-cart custom-newsletter" data-quantity="1" data-product_id="70" href="<?php echo $base_url;?>newsletter-subscription">
                                       <span>Newsletter</span>
                                    </a>
                                 </div>
                                 </div>
                              </div> -->
                              <div class="col-md-4 col-sm-6">
                                 <div class="form-group">
                                 <div class="add_cart">
                                    <a class="single_add_to_cart_button add_to_cart_button  product_type_simple ajax_add_to_cart button btn-cart custom-wishlist" data-quantity="1" data-product_id="70" href="<?php echo $base_url;?>my-wishlist">
                                       <span>Wishlist</span>
                                    </a>
                                 </div>
                                 </div>
                              </div>

                              <div class="col-md-4 col-sm-6">
                                 <div class="form-group">
                                 <div class="add_cart">
                                    <a class="single_add_to_cart_button add_to_cart_button  product_type_simple ajax_add_to_cart button btn-cart btn-cart" data-quantity="1" data-product_id="70" href="<?php echo $base_url;?>cart">
                                       <span>Cart</span>
                                    </a>
                                 </div>
                                 </div>
                              </div>
                           </div>
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