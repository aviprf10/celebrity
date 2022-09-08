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
    <title><?php echo $company_title;?> | <?php echo $title; ?></title>
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
<body  class="shop-listing shop-right-sidebar">
    <?php include "common/header.php";?>
    <div id="page-content">     
        <!-- Collection Banner -->
        <div class="collection-header">
            <div class="collection-hero">
                <div class="collection-hero__image"></div>
                <div class="collection-hero__title-wrapper container">
                    <h2 class="collection-hero__title"><?php echo $title; ?></h2>
                    <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="<?php $base_url;?>" title="Back to the home page">Home</a><span>/</span><span class="fw-bold"><?php echo $category_name; ?></span><?php if(!empty($sub_category_name)){ ?><span>/</span><span class="fw-bold"><?php echo $sub_category_name; ?></span><?php }?></div>
                </div>
            </div>
        </div>
        <!-- End Collection Banner -->

        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-3 sidebar sidebar-bg filterbar">
                    <div class="closeFilter d-block d-lg-none"><i class="icon icon an an-times-r"></i></div>
                    <div class="sidebar_tags">
                        <!--Price Filter-->
                        <div class="sidebar_widget filterBox filter-widget">
                            <div class="widget-title"><h2 class="mb-0">Price</h2></div>
                            <form  method="post" class="price-filter filterDD">
                                <div id="slider-range"></div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="no-margin"><input id="amount" type="text">
                                        <input id="min_amount" type="hidden">
                                        <input id="max_amount" type="hidden">
                                        <input id="category_title" type="hidden" value="<?php echo $category_unique_slug; ?>">
                                    </p>
                                    </div>
                                    <!-- <div class="col-6 text-right margin-25px-top">
                                        <button class="btn btn--small rounded">filter</button>
                                    </div> -->
                                </div>
                            </form>
                        </div>
                        <div class="sidebar_widget filterBox filter-widget size-swacthes availability">
                            <div class="widget-title"><h2 class="mb-0">Filter B</h2></div>
                            <div class="filterDD"><br>
                                <ul class="clearfix">
                                    <div class="customRadio clearfix">
                                        <input name="sort_by_filter" id="sort_by_filter" onchange="filter_product();" value="1" type="radio" class="radio"> 
                                        <label for="sort_by_filter">Popular</label>
                                    </div>
                                    <div class="customRadio clearfix">
                                        <input name="sort_by_filter" id="sort_by_filter1" onchange="filter_product();" value="2" type="radio" class="radio"> 
                                        <label for="sort_by_filter1">Lowest Price</label>
                                    </div>
                                    <div class="customRadio clearfix">
                                        <input  name="sort_by_filter" id="sort_by_filter2" onchange="filter_product();" value="3" type="radio" class="radio"> 
                                        <label for="sort_by_filter2">Highest Price</label>
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <?php 
                            $servicesdetails_data_array = array();
                            $get_servicesdetails_query = "select * from services where is_deleted='0'";
                            $result_get_servicesdetails_query = mysqli_query($db_mysqli, $get_servicesdetails_query);
                            while ($row_get_servicesdetails_query = mysqli_fetch_assoc($result_get_servicesdetails_query))
                            {
                                $servicesdetails_data_array[] = $row_get_servicesdetails_query;
                            }

                            if(count($servicesdetails_data_array) > 0){
                            ?>
                        <div class="sidebar_widget filterBox filter-widget size-swacthes availability">
                            <div class="widget-title"><h2 class="mb-0">Filter C</h2></div>
                            <div class="filterDD"><br>
                                <ul class="clearfix">
                                   <?php foreach($servicesdetails_data_array as $servicesdetails_data){ ?>
                                    <div class="customRadio clearfix">
                                        <input name="sort_by_filter_service" id="sort_by_filter_service<?php echo $servicesdetails_data['id'] ?>" onchange="filter_product();" value="<?php echo $servicesdetails_data['id'] ?>" type="radio" class="radio"> 
                                        <label for="sort_by_filter_service<?php echo $servicesdetails_data['id'] ?>"><?php echo $servicesdetails_data['services_name'] ?></label>
                                    </div>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <?php } ?>
                        <!--End Popular Products-->
                        <!--Banner-->
                        <div class="sidebar_widget static-banner d-none">
                            <a href="shop-fullwidth.html"><img src="<?php echo $base_url_images; ?>shop-banner.jpg" alt="image"></a>
                        </div>
                        <!--End Banner-->
                    </div>
                </div>
                <!--Main Content-->
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 main-col">
                    <!-- Collection Description-->
                    <div class="collection-description pt-0" style="padding-bottom:0px;">
                        <div class="widget-title"><h2><?php echo $title; ?></h2></div>
                    </div>
                    <!--End Collection Description-->

                    <!--End Active Filters-->
                    <!--Toolbar-->
                    <div class="toolbar">
                        <div class="filters-toolbar-wrapper">
                            <ul class="list-unstyled d-flex align-items-center">
                                <li class="collection-view ms-sm-auto">
                                    <div class="filters-toolbar__item collection-view-as d-flex align-items-center me-3">
                                        <a href="javascript:void(0)" class="change-view prd-grid change-view--active"><i class="icon an an-th" aria-hidden="true"></i><span class="tooltip-label">Grid View</span></a>
                                        <a href="javascript:void(0)" class="change-view prd-list"><i class="icon an an-th-list" aria-hidden="true"></i><span class="tooltip-label">List View</span></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--End Toolbar-->

                    <!--Product List-->
                    <div class="product-load-more">
                        <!--Product Grid-->
                        <div class="grid-products grid--view-items prd-grid">
                            <div class="row" id="celebritys_div">
                            <?php
                               
                                if(count($user_list_data_array) > 0)
                                { 
                                    foreach($user_list_data_array as $user_list_data)
                                    {
                                        if($user_list_data['price_status'] == 1)
                                        {
                                            if ($user_list_data["discount_type"] == 'percentage')
                                            {
                                                $discount = $user_list_data['celebrity_price']*$user_list_data["discount"];
                                                $total_discountt = $discount/100;
                                                $total_discount = $user_list_data['celebrity_price']-$total_discountt;
                                            }
                                            else if($user_list_data["discount_type"] == 'price')
                                            {
                                                    $total_discount = $user_list_data['celebrity_price']-$user_list_data["discount"];
                                            }
                                        }
                                        else 
                                        {
                                            $total_discount = 'Comming Soon';
                                        }
                                        
                                ?>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                    <div class="product-image">
                                        <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $user_list_data['user_unique_slug']; ?>" class="product-img" title="<?php echo $user_list_data['user_name']; ?>">
                                            <?php if($user_list_data['profile_pic'] !=''){ ?>
                                            <img  src="<?php echo $cele_base_path_uploads ?>profile-pic/size_450/<?php echo $user_list_data['profile_pic'] ?>" alt="<?php echo $user_list_data['user_name']; ?>" title="<?php echo $user_list_data['user_name']; ?>">
                                            <?php }else{ ?>
                                                <img src="<?php echo $base_url_images;?>1.jpg" alt="<?php echo $user_list_data['user_name']; ?>" title="<?php echo $user_list_data['user_name']; ?>">
                                            <?php } ?>    
                                        </a>
                                        <div class="button-set style0 d-none d-md-block">
                                            <ul>
                                                <li><a class="btn-icon btn cartIcon pro-quickshop-popup" onclick="add_to_cart('<?php echo $user_list_data['id']; ?>')"  aria-controls="pro-quickshop1"><i class="icon an an-cart-l"></i> <span class="tooltip-label top">Add to Cart</span></a></li>
                                                <li><a class="btn-icon" onclick="book_cart('<?php echo $user_list_data['id']; ?>')"><i class="icon an an-search-l"></i> <span class="tooltip-label top">Book Now</span></a></li>
                                                <li><a class="btn-icon wishlist add-to-wishlist" onclick="add_to_wishlist('<?php echo $user_list_data['id']; ?>')"><i class="icon an an-heart-l"></i> <span class="tooltip-label top">Add To Wishlist</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-details text-center">
                                        <div class="product-name text-uppercase">
                                            <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $user_list_data['user_unique_slug']; ?>"><?php echo $user_list_data['user_name']; ?></a>
                                        </div>
                                        <div class="product-price">
                                            <span class="old-price"><?php echo $selected_currency_icon;?> <?php echo $user_list_data['celebrity_price'];  ?></span>
                                            <span class="price"><?php echo $selected_currency_icon;?> <?php echo $total_discount;  ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                } }else{ 
                                ?>
                                <p><b>No Product Available?</b></p>
                                <?php } ?>            
                            </div>
                            <div class="row"  id="all_celebritys_div"></div>
                        </div>
                        <!--End Product Grid-->

                        <!--Load More Button-->
                        <!-- <div class="infinitpaginOuter">
                            <div class="infinitpagin">	
                                <a href="#" class="btn rounded loadMore">Load More</a>
                            </div>
                        </div> -->
                        <!--End Load More Button-->
                    </div>
                    <!--End Product List-->
                </div>
                <!--End Main Content-->

                <!--Sidebar-->
               
                <!--End Sidebar-->
            </div>
        </div>
    </div>
    <?php include 'common/footer.php';?>
    <?php include 'common/footer-js.php';?>

 </body>    
</html>