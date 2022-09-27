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
    <title><?php echo ucfirst($celebrity_details['meta_title']); ?></title>
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <style>
        .quote-wraper .slick-arrow {
            opacity:unset !important;
            visibility:unset !important;
        }
        .slick-prev:before, .slick-next:before 
        {
            color:#000 !important;
        }
        .card:hover .choose-one, .card:hover~.choose-one {
            color: #fff;
            background-color: #de0e0e;
            padding: 3px 10px;
            border-radius: 24px;
        }
        .more-templates:hover {
            color: red;
            background-color: #fff;
        }

        .tooltip123 {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted black;
            /* color of the span text */
            color: rgb(119, 162, 241);
            }

            .tooltip123 .tooltip123text {
            visibility: hidden;
            width: 120px;
            background-color: black;
            /* color of the tooltip text */
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            }

            .tooltip123:hover .tooltip123text {
            visibility: visible;
            }
    </style>    
</head>
<body  class="template-product product-simple-layout">
    <?php include "common/header.php";?>
    <div id="page-content">
        <!--Breadcrumbs-->
        <div class="breadcrumbs-wrapper text-uppercase">
            <div class="container">
                <div class="breadcrumbs"><a href="<?php echo $base_url; ?>" title="Back to the home page">Home</a><span>|</span><span class="fw-bold"><?php echo $celebrity_details['user_name']; ?></span></div>
            </div>
        </div>
        <!--End Breadcrumbs-->

        <!--Main Content-->
        <div class="container">
            <!--Product Content-->
            <div class="product-single">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="product-details-img product-horizontal-style clearfix mb-3 mb-md-0">
                            <div class="zoompro-wrap product-zoom-right w-100 p-0">
                                <div class="zoompro-span">
                                    <img id="zoompro" class="zoompro" src="<?php echo $cele_base_path_uploads ?>profile-pic/temp_file/<?php echo $celebrity_details_data_array[0]['profile_pic'] ?>" data-zoom-image="<?php echo $cele_base_path_uploads ?>profile-pic/temp_file/<?php echo $celebrity_details_data_array[0]['profile_pic'] ?>" alt="product" />
                                </div>
                                <div class="product-buttons">
                                        <a href="#" class="btn rounded-0 prlightbox"><i class="icon an an-expand-l-arrows"></i><span class="tooltip-label">Zoom Image</span></a>
                                </div>
                            </div>
                            <div class="product-thumb product-horizontal-thumb w-100 pt-2 mt-1">
                                <div id="gallery" class="product-thumb-style1 overflow-hidden">
                                    <a data-image="<?php echo $cele_base_path_uploads ?>profile-pic/temp_file/<?php echo $celebrity_details_data_array[0]['profile_pic'] ?>" data-zoom-image="<?php echo $cele_base_path_uploads ?>profile-pic/temp_file/<?php echo $celebrity_details_data_array[0]['profile_pic'] ?>" class="slick-slide slick-cloned active">
                                        <img class="blur-up lazyload" data-src="<?php echo $cele_base_path_uploads ?>profile-pic/temp_file/<?php echo $celebrity_details_data_array[0]['profile_pic'] ?>" src="<?php echo $cele_base_path_uploads ?>profile-pic/temp_file/<?php echo $celebrity_details_data_array[0]['profile_pic'] ?>" alt="product" />
                                    </a>
                                    <?php
                                    if(count($image_celebrity_data_array) >0)
                                    { 
                                        foreach($image_celebrity_data_array as $image_celebrity_data)
                                        {
                                    ?>
                                    <a data-image="<?php echo $cele_base_path_uploads ?>celebrity-images/size_large/<?php echo $image_celebrity_data['celebrity_images'] ?>" data-zoom-image="<?php echo $cele_base_path_uploads ?>celebrity-images/size_large/<?php echo $image_celebrity_data['celebrity_images'] ?>" class="slick-slide slick-cloned active">
                                        <img class="blur-up lazyload" data-src="<?php echo $cele_base_path_uploads ?>celebrity-images/size_large/<?php echo $image_celebrity_data['celebrity_images'] ?>" src="<?php echo $cele_base_path_uploads ?>celebrity-images/size_large/<?php echo $image_celebrity_data['celebrity_images'] ?>" alt="product" />
                                    </a>
                                    <?php } }?>
                                </div>
                            </div>
                            <div class="lightboximages">
                            <a href="<?php echo $cele_base_path_uploads ?>profile-pic/temp_file/<?php echo $celebrity_details_data_array[0]['profile_pic'] ?>" data-size="1000x1280"></a>
                            <?php
                                if(count($image_celebrity_data_array) >0)
                                { 
                                    foreach($image_celebrity_data_array as $image_celebrity_data)
                                    {
                                ?>
                                <a href="<?php echo $cele_base_path_uploads ?>celebrity-images/size_large/<?php echo $image_celebrity_data['celebrity_images'] ?>" data-size="1000x1280"></a>
                                <?php } }?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                        <!-- Product Info -->
                        <div class="product-single__meta">
                            <div class="title-nav d-flex justify-content-between">
                                <h1 class="product-single__title pe-5"><?php echo ucfirst($celebrity_details['user_name']); ?></h1>
                            </div>
                            <!-- Product Reviews -->
                            <div class="product-review mb-2">
                                <?php
                                if(count($celebritycategory_data_array))
                                { 
                                    foreach($celebritycategory_data_array as $celebritycategory_data){
                                ?>
                                <a class="reviewLink d-flex-left" href="<?php echo $base_url;?>celebrity-list/<?php echo $celebritycategory_data['category_unique_slug']; ?>" style="font-size: 26px; font-family: 'Kaushan Script', cursive; margin-right: 13px;">
                                    # <?php echo $celebritycategory_data['category_name'] ?>
                                </a>
                                <?php 
                                }}?>
                                <?php
                                
                                if(count($detailsubcategory_data_array))
                                { 
                                    foreach($detailsubcategory_data_array as $detailsubcategory_data){
                                ?>
                                <a class="reviewLink d-flex-left" href="<?php echo $base_url;?>celebrity-list/<?php echo $detailsubcategory_data['sub_category_unique_slug']; ?>" style="font-size: 26px; font-family: 'Kaushan Script', cursive; margin-right: 13px;">
                                    # <?php echo $detailsubcategory_data['sub_category_name'] ?>
                                </a>
                                <?php 
                                }}?>
                            </div>
                            <!-- End Product Reviews -->
                            <!-- Product Info -->
                            <div class="text">
                                <?php echo $celebrity_details['full_description']; ?><br>
                                <a href="<?php echo $celebrity_details_data_array[0]['profile_link_url'] ?>" target="_blank" class="btn btn-primary" style="background-color: yellowgreen; border-color:yellowgreen; border-radius: 10px; margin-top:10px;">Know more</a>
                            </div>
                            <div class="product-info"><br>
                                <p class="product-type" style="font-size: 15px;">Language spoken: <span><?php echo $celebrity_details['language_spoken'] ?></span></p>  
                            </div>    
                            <div class="social-sharing d-flex-center mb-3">
                                <span class="sharing-lbl me-2">Follow :</span>
                                <?php if($celebrity_details_data_array[0]['facebook_link'] !=''){ ?>
                                <a href="<?php echo $celebrity_details_data_array[0]['facebook_link'] ?>" class="d-flex-center btn btn-link btn--share share-facebook" data-bs-toggle="tooltip" data-bs-placement="top" title="Follow on Facebook"><i class="icon an an-facebook mx-1"></i><span class="share-title d-none">Facebook</span></a>
                                <?php }  if($celebrity_details_data_array[0]['twitter_link'] !=''){ ?>    
                                <a href="<?php echo $celebrity_details_data_array[0]['twitter_link'] ?>" class="d-flex-center btn btn-link btn--share share-twitter" data-bs-toggle="tooltip" data-bs-placement="top" title="Follow on Twitter"><i class="icon an an-twitter mx-1"></i><span class="share-title d-none">Tweet</span></a>
                                <?php }  if($celebrity_details_data_array[0]['instagram_link'] !=''){ ?>    
                                <a href="<?php echo $celebrity_details_data_array[0]['instagram_link'] ?>" class="d-flex-center btn btn-link btn--share share-instagram" data-bs-toggle="tooltip" data-bs-placement="top" title="Follow on Instagram"><i class="an an-instagram"></i> <span class="share-title d-none">Instagram</span></a>
                                <?php }  if($celebrity_details_data_array[0]['linkedin_link'] !=''){ ?>    
                                <a href="<?php echo $celebrity_details_data_array[0]['linkedin_link'] ?>" class="d-flex-center btn btn-link btn--share share-linkedin" data-bs-toggle="tooltip" data-bs-placement="top" title="Follow on Linkedin"><i class="icon an an-linkedin mx-1"></i><span class="share-title d-none">Linkedin</span></a>
                                <?php }  if($celebrity_details_data_array[0]['google_link'] !=''){ ?>    
                                <a href="<?php echo $celebrity_details_data_array[0]['google_link'] ?>" class="d-flex-center btn btn-link btn--share share-email" data-bs-toggle="tooltip" data-bs-placement="top" title="Follow by Email"><i class="icon an an-envelope-l mx-1"></i><span class="share-title d-none">Email</span></a>
                                <?php } ?>
                            </div>    
                        </div>
                        <!-- Product Form -->
                        <?php 
                        if($celebrity_details['is_pramotion'] == 1)
                        {
                        ?>
                        <a href="<?php echo $base_url; ?><?php echo $base_path_3; ?>/registration"><button class="btn btn-primary" style="background-color: cadetblue; border-radius: 6px; padding-left: 70px; padding-right: 70px; margin-top: 30px;">Brand Pramotion Inquiry</button></a>
                        <?php }else{ ?>
                        <form id="add_to_cart_form" method="POST" data-parsley-validate>
                            <div class="tabs-listing style2 mt-0 mt-md-5" style="margin-top:0px !important;">
                                <p><span style="font-size: 26px; font-family: 'Kaushan Script', cursive; margin-right: 13px;">Request for</span>  * Inclusive of GST</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select class="form-control" name="services_id" id="services_id" onchange="getServices(this.value)">
                                            <?php 
                                            if(count($celebrityprice_data_array) > 0)
                                            {
                                                foreach($celebrityprice_data_array as $celebrityprice_data){
                                                    if($celebrityprice_data['price_status'] == '1')
                                                    {
                                                        if ($celebrityprice_data["discount_type"] == 'percentage')
                                                        {
                                                            $discount = $celebrityprice_data['price']*$celebrityprice_data["discount"];
                                                            $total_discountt = $discount/100;
                                                            $total_discount = $celebrityprice_data['price']-$total_discountt;
                                                        }
                                                        else if($celebrityprice_data["discount_type"] == 'price')
                                                        {
                                                            $total_discount = $celebrityprice_data['price']-$celebrityprice_data["discount"];
                                                        }
                                                    }
                                                    else 
                                                    {
                                                        $total_discount = 'Comming Soon';
                                                    }
                                                    
                                                    
                                            ?>
                                            <option value="<?php echo $celebrityprice_data['id'] ?>-<?php echo $celebrityprice_data['services_name'] ?>-<?php echo $celebrityprice_data['price']; ?>-<?php echo $celebrityprice_data['celebrity_price_id'] ?>"><?php echo $celebrityprice_data['services_name'] ?>-<?php echo $selected_currency_icon;?> <?php echo $total_discount; ?></option>
                                             <?php } } ?>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="col-md-12" id="info"></div>   
                                </div>               
                                <div class="tab-container" style="padding-top: 10px;">
                                    <h3 class="tabs-ac-style rounded d-md-none active" rel="description">Brand enquiry<br>Let’s talk</h3>
                                    <div class="tab-content"  id="services_div">
                                    </div>
                                </div>
                            </div>    
                            <div class="product-action w-100 clearfix">
                                <div class="row g-2">
                                    <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="product-form__item--submit">
                                            <button type="submit" class="btn rounded-0 product-form__cart-submit mb-0" style="border-radius: 10px !important"><span>Add to cart</span></button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="product-form__item--buyit clearfix">
                                            <a onclick="book_cart()" class="btn rounded-0 btn-outline-primary proceed-to-checkout" style="border-radius: 10px !important">Book now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div><br><br>
        
        <?php if(count($image_celebrity_data_array) > 0){ ?>
        <section class="section product-slider pb-0">
            <div class="container">
                <div class="row">
                    <div class="section-header col-12">
                        <h2 class="text-transform-none">Related Video</h2>
                    </div>
                </div>
                <div class="productSlider grid-products">
                    <?php 
                    foreach($image_celebrity_data_array as $image_celebrity_data){
                    ?>
                    <div class="item">
                        <div class="product-image">
                            <video style="width:100%; height:200px;" controls>
                                <source src="<?php echo $cele_base_path_uploads ?>celebrity-file/<?php echo $image_celebrity_data['celebrity_video']; ?>" type="video/mp4">
                            </video>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <?php } ?>
        <section class="section product-slider pb-0">
            <div class="container">
                <div class="row">
                    <div class="section-header col-12">
                        <h2 class="text-transform-none">More Celebrity</h2>
                    </div>
                </div>
                <div class="productSlider grid-products">
                <?php
                if(count($related_user_list_data_array) > 0)
                { 
                    foreach($related_user_list_data_array as $user_list_data)
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
                    <div class="item">
                        <div class="product-image">
                            <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $user_list_data['user_unique_slug']; ?>" class="product-img" title="<?php echo $user_list_data['user_name']; ?>">
                                <?php if($user_list_data['profile_pic'] !=''){ ?>
                                <img  src="<?php echo $cele_base_path_uploads ?>profile-pic/size_450/<?php echo $user_list_data['profile_pic'] ?>" alt="<?php echo $user_list_data['user_name']; ?>" title="<?php echo $user_list_data['user_name']; ?>" style="height: unset;">
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
            </div>
        </section>
           


        <!-- <section class="store-features style1 py-0" style="padding-top: 50px !important; padding-bottom: 20px !important;  background: gainsboro;">
            <div class="container">
                <div class="row">
                    <div class="section-header col-12">
                        <h2>Why shop with us?</h2>
                    </div>
                </div>
                <div class="row store-info">
                    <div class="col mb-3 my-sm-3 text-center">
                        <i class="an an-shield rounded-circle mb-4"></i>
                        <h5 class="body-font">Products Quality</h5>
                        <p class="sub-text">Comprehensive quality control and affordable prices</p>
                    </div>
                    <div class="col mb-3 my-sm-3 text-center">
                        <i class="an an-warehouse rounded-circle mb-4"></i>
                        <h5 class="body-font">Global Warehouse</h5>
                        <p class="sub-text">Shop from 20+ warehouses world wide.</p>
                    </div>
                    <div class="col mb-3 my-sm-3 text-center">
                        <i class="an an-ship-fast rounded-circle mb-4"></i>
                        <h5 class="body-font">Fast Shipping</h5>
                        <p class="sub-text">Fast and convenient door to door delivery</p>
                    </div>
                    <div class="col mb-3 my-sm-3 text-center">
                        <i class="an an-award rounded-circle mb-4"></i>
                        <h5 class="body-font">Payment Security</h5>
                        <p class="sub-text">More than 8 different secure payment methods</p>
                    </div>
                    <div class="col mb-3 my-sm-3 text-center">
                        <i class="an an-chat rounded-circle mb-4"></i>
                        <h5 class="body-font">Dedicated Support</h5>
                        <p class="sub-text">24/7 Customer Service - We’re here & happy to help!</p>
                    </div>
                </div>
            </div>
        </section> -->
    </div>
    
    <?php include 'common/footer.php';?>
    <?php include 'common/footer-js.php';?>

    <script>
         
        $(document).ready(function () {
            var services_id = $('#services_id').val();
            getMessage(services_id, '', '');
            getServices(services_id, '', '');
            
        });

        function getfilter(services_id, type_id)
        {
            getServices(services_id, '',type_id);
            getMessage(services_id, '',type_id);
            
        }

        function getServices(services_id, occasion_id='', type_id='')
        {
            var user_name = '<?php echo ucfirst($celebrity_details['user_name']); ?>';
            var user_id = '<?php echo ucfirst($celebrity_details['id']); ?>';
            $.ajax(
            {
                url: "<?php echo $base_url; ?>get_services.php",
                type: "POST",
                data: {'user_name':user_name, 'services_id':services_id, 'user_id':user_id,'occasion_id':occasion_id,'type_id':type_id},
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
                        $('#services_div').html(data.html_message);
                        $('#info').html(data.html_message1);
                        var services_id = $('#services_id').val();
                        getMessage(services_id, '', type_id);
                    }
                    else
                    {
                        $.notifyBar({cssClass: "error", html: data.html_message});
                    }
                }
            });
            
        }

        function getMessage(services_id, occasion_id='', type_id='')
        {
            var user_name = '<?php echo ucfirst($celebrity_details['user_name']); ?>';
            var user_id = '<?php echo ucfirst($celebrity_details['id']); ?>';
            $.ajax(
            {
                url: "<?php echo $base_url; ?>get_occasionmessage.php",
                type: "POST",
                data: {'user_name':user_name, 'services_id':services_id, 'user_id':user_id,'occasion_id':occasion_id,'type_id':type_id},
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
                        $('#occasionmessage_div').html(data.html_message);
                        $('.items').slick({
                        dots: true,
                        infinite: true,
                        speed: 800,
                        autoplay: false,
                        autoplaySpeed: 2000,
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        responsive: [
                            {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                                infinite: true,
                                dots: true
                            }
                            },
                            {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                            },
                            {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                            }

                        ]
                        });
                    }
                    else
                    {
                        $.notifyBar({cssClass: "error", html: data.html_message});
                    }
                }
            });
            
        }

        function getMessage1(occasion_id)
        {
            var occasion_id = $('#occasion_id').val();
            $.ajax(
            {
                url: "<?php echo $base_url; ?>get_occasionmessage.php",
                type: "POST",
                data: {'occasion_id':occasion_id},
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
                        $('#occasionmessage_div').html(data.html_message);
                        $('.items').slick({
                        dots: true,
                        infinite: true,
                        speed: 800,
                        autoplay: false,
                        autoplaySpeed: 2000,
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        responsive: [
                            {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                                infinite: true,
                                dots: true
                            }
                            },
                            {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                            },
                            {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                            }

                        ]
                        });
                    }
                    else
                    {
                        $.notifyBar({cssClass: "error", html: data.html_message});
                    }
                }
            });
            
        }

        function getDisplaytextbox(id)
        {
            var user_name = '<?php echo $celebrity_details['user_name']; ?>';
            var services_id = $('#services_id').val();
            $.ajax(
            {
                url: "<?php echo $base_url; ?>get_idbyoccasionmessage.php",
                type: "POST",
                data: {'occasion_id':id, 'user_name':user_name, 'services_id':services_id},
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
                        $('#occasionmessage_div').css('display','none');
                        $('#select_text').css('display','block');
                        $('#select_text').html(data.html_message);
                        var services = $('#services_id').val();
                        const myArray = services.split("-");
                        let services_id = myArray[0];
                        var text_max = 300;
                        $('#textarea_feedback').html(' Text Limit: ' + text_max);

                        $('#user_message_'+services_id).keyup(function() {
                            var text_length = $('#user_message_'+services_id).val().length;
                            var text_remaining = text_max - text_length;

                            $('#textarea_feedback').html(' Text Limit: ' + text_remaining);
                        });
                    }
                    else
                    {
                        $.notifyBar({cssClass: "error", html: data.html_message});
                    }
                }
            });
        }

        function getDisplaymessage()
        {
            $('#select_text').css('display','none');
            $('#occasionmessage_div').css('display','block');
            
        }

        function book_cart()
        {
            var services = $('#services_id').val();
            const myArray = services.split("-");
            let services_id = myArray[0];
            if (services_id != '')
            {
                $.ajax({
                    url: "<?php echo $base_url;?>add-to-cart-submit.php",
                    type: "POST",
                    data: $('#add_to_cart_form').serialize(),
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
                            $("#header_cart_total_count").html(data.total_cart_celebrity);
                            $("#header_cart_total_amount").html('<?php echo $selected_currency_icon; ?> ' + data.total_cart_amount);
                            $.growl.notice({ title:"Success",message: data.html_message });
                            setTimeout(function ()
                            {
                                window.top.location="<?php echo $base_url; ?>checkout"
                            }, 2000);
                            //$.notifyBar({cssClass: "success", html: data.html_message});
                        }
                        else
                        {
                            $.growl.error({ title:"Error",message: data.html_message });
                            //$.notifyBar({cssClass: "error", html: data.html_message});
                        }
                    },
                    error: function (error)
                    {
                        $.growl.error({ title:"Error",message: "Error Loading data from server." });
                        //$.notifyBar({cssClass: "error", html: "Error Loading data from server."});
                    }
                });
            }
            else
            {
                $.growl.error({ title:"Error",message: "Please Enter Valid Quantity..!!" });
                //$.notifyBar({cssClass: "error", html: "Please Enter Valid Quantity..!!"});
            }
        }

    </script> 
    <script src="<?php echo $base_url_js ?>vendor/photoswipe.min.js"></script>
    <script>
        $(function () {
            var $pswp = $('.pswp')[0],
                    image = [],
                    getItems = function () {
                        var items = [];
                        $('.lightboximages a').each(function () {
                            var $href = $(this).attr('href'),
                                    $size = $(this).data('size').split('x'),
                                    item = {
                                        src: $href,
                                        w: $size[0],
                                        h: $size[1]
                                    };
                            items.push(item);
                        });
                        return items;
                    };
            var items = getItems();

            $.each(items, function (index, value) {
                image[index] = new Image();
                image[index].src = value['src'];
            });
            $('.prlightbox').on('click', function (event) {
                event.preventDefault();

                var $index = $(".active-thumb").parent().attr('data-slick-index');
                $index++;
                $index = $index - 1;

                var options = {
                    index: $index,
                    bgOpacity: 0.7,
                    showHideOpacity: true
                };
                var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
                lightBox.init();
            });
        });
    </script>
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>
            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div>
                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                    <button class="pswp__button pswp__button--share" title="Share"></button>
                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>
                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                <div class="pswp__caption"><div class="pswp__caption__center"></div></div>
            </div>
        </div>
    </div> 
                            
 </body>    
</html>