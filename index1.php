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
    <title><?php echo $company_title;?></title>
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
<body class="template-index index-demo5">
   <?php include "common/header.php";?>
   <div id="page-content">
      <!--Home slider-->
      <section class="slideshow slideshow-wrapper">
         <div class="home-slideshow">
            <?php
            if(count($homebanner_data_array) > 0){ 
               $i = 0;
               foreach ($homebanner_data_array as $homebanner_data) { 
            ?>
            <div class="slide">
                  <div class="blur-up lazyload">
                     <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 d-flex align-items-center p-0 order-md-<?php echo $i ?> order-xl-<?php if($i == '0'){ echo $i+1;}else{ echo $i;} ?> order-sm-<?php echo $i ?> order-lg-<?php if($i == '0'){ echo $i+1;}else{ echo $i;} ?> order-<?php echo $i ?>">
                              <img data-src="<?php echo $base_url_uploads;?>home-banner-small-images/temp_file/<?php echo $homebanner_data['small_images'] ?>" src="<?php echo $base_url_uploads;?>/home-banner-small-images/temp_file/<?php echo $homebanner_data['small_images'] ?>" alt="<?php echo $homebanner_data['title_1'] ?> <?php echo $homebanner_data['title_2'] ?>" title="<?php echo $homebanner_data['title_1'] ?> <?php echo $homebanner_data['title_2'] ?>" />
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center blue-bg p-0 order-md-<?php echo $i;?> order-xl-<?php echo $i; ?> order-sm-<?php if($i == '0'){ echo $i+1;}else{ echo $i;} ?> order-lg-<?php echo $i; ?> order-<?php echo $i; ?>">
                              <div class="text-center whiteText">
                                 <div class="wrap-caption style1">
                                    <h2 class="h1 mega-title ss-mega-title fs-1 text-capitalize"><?php echo $homebanner_data['title_1'] ?><br><?php echo $homebanner_data['title_2'] ?></h2>
                                    <span class="mega-subtitle fs-5 ss-sub-title d-md-block d-lg-block d-none"><?php echo $homebanner_data['title_3'] ?><br><?php echo $homebanner_data['title_4'] ?></span>
                                    <div class="ss-btnWrap">
                                          <a class="btn btn-lg border-0 btn-primary rounded-pill" href="#">Shop Collection</a>
                                    </div>
                                 </div>
                              </div>
                        </div>    
                     </div>
                  </div>
            </div>
            <?php  $i++; }} ?>
         </div>
      </section>
      <!--End Home slider-->

      <!--Banner Masonary-->
      <!-- <section class="collection-banners style1 mt-4">
         <div class="container">
            <div class="grid-masonary banner-grid">
                  <div class="grid-sizer col-md-4 col-lg-4"></div>
                  <div class="row">
                     <div class="col-md-4 banner-item rounded">
                        <div class="collection-grid-item rounded">
                              <a href="shop-right-sidebar.html">
                                 <div class="img">
                                    <img class="blur-up lazyload" data-src="assets/images/collection/demo5-banner1.jpg" src="assets/images/collection/demo5-banner1.jpg" alt="Girls Jacket" title="Girls Jacket" />
                                 </div>
                                 <div class="details top w-100 white-text px-2 py-2">
                                    <div class="inner">
                                          <h3 class="title fs-3 mb-2 mt-1 body-font text-capitalize">Girls Jacket</h3>
                                          <span class="btn--link text-uppercase fw-600">Shop Now</span>
                                    </div>
                                 </div>
                              </a>
                        </div>
                     </div>
                     <div class="col-md-4 banner-item rounded">
                        <div class="collection-grid-item rounded">
                              <a href="shop-right-sidebar.html">
                                 <div class="img">
                                    <img class="blur-up lazyload" data-src="assets/images/collection/demo5-banner2.jpg" src="assets/images/collection/demo5-banner2.jpg" alt="Toys &amp; Accessories" title="Toys &amp; Accessories" />
                                 </div>
                                 <div class="details top w-100 white-text px-2 py-2">
                                    <div class="inner">
                                          <h3 class="title fs-3 mb-2 mt-1 body-font text-capitalize">Toys &amp; Accessories</h3>
                                          <span class="btn--link text-uppercase fw-600">Shop Now</span>
                                    </div>
                                 </div>
                              </a>
                        </div>
                     </div>
                     <div class="col-md-4 banner-item">
                        <div class="collection-grid-item rounded">
                              <a href="shop-right-sidebar.html">
                                 <div class="img">
                                    <img class="blur-up lazyload" data-src="assets/images/collection/demo5-banner3.jpg" src="assets/images/collection/demo5-banner3.jpg" alt="Boys Tshirt" title="Boys Tshirt" />
                                 </div>
                                 <div class="details top w-100 white-text px-2 py-2">
                                    <div class="inner">
                                          <h3 class="title fs-3 mb-2 mt-1 body-font text-capitalize">Boys Tshirt</h3>
                                          <span class="btn--link text-uppercase fw-600">Shop Now</span>
                                    </div>
                                 </div>
                              </a>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </section> -->
      <!--End Banner Masonary-->

      <!--Editors Pick Products Grid-->
      <?php 
         $all_categorysection_data_array = array();
         $get_categorysection_query = "SELECT * FROM display_category_wise_section";
         $result_get_categorysection_query = mysqli_query($db_mysqli, $get_categorysection_query);
         while ($row_get_categorysection_query = mysqli_fetch_assoc($result_get_categorysection_query))
         {
             $all_categorysection_data_array[] = $row_get_categorysection_query;
         }
         $categorysec_id = explode(',',$all_categorysection_data_array[0]['category_id']);
         foreach ($categorysec_id as $key => $value) {
            if($key=='0'){
               $movieartist_data_array = array();
               $get_movieartist_query = "select u.*, cp.price, cp.discount_type, cp.discount from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where c.category_id IN($value) and u.status='1' and u.is_deleted='0' and u.user_type='2' and cp.price > '0' group by u.id  order by id desc limit 6";
               $result_get_movieartist_query = mysqli_query($db_mysqli, $get_movieartist_query);
               while ($row_get_movieartist_query = mysqli_fetch_assoc($result_get_movieartist_query))
               {
                  $movieartist_data_array[] = $row_get_movieartist_query;
               }

               $category_data_array = array();
               $get_category_query = "SELECT * FROM `category` where is_deleted='0'and id IN($value)";
               $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);
               while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
               {
                  $category_data_array[] = $row_get_category_query;
               }  
               if(count($movieartist_data_array) > 0){
      ?>
      <section class="section product-slider" style="background: aliceblue;">
         <div class="container">
            <div class="row">
                  <div class="col-12 section-header style1" style="text-align: left; border-bottom: 1px solid #e5e5e5;">
                     <div class="section-header-left">
                        <h2 style="margin-bottom: 5px;"><?php echo ucfirst($category_data_array[0]['category_name']); ?></h2>
                     </div>
                  </div>
            </div>
            <div class="productPageSlider grid-products">
                  <?php 
                     if(count($movieartist_data_array) > 0)
                     {
                        foreach($movieartist_data_array as $movieartist_data){

                           if ($movieartist_data["discount_type"] == 'percentage')
                           {
                              $discount = $movieartist_data['celebrity_price']*$movieartist_data["discount"];
                              $total_discountt = $discount/100;
                              $total_discount = $movieartist_data['celebrity_price']-$total_discountt;
                           }
                           else if($movieartist_data["discount_type"] == 'price')
                           {
                                 $total_discount = $movieartist_data['price']-$movieartist_data["discount"];
                           }
                  ?>
                  <div class="item">
                     <div class="product-image">
                           <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $movieartist_data['user_unique_slug']; ?>" class="product-img">
                              <?php if($movieartist_data['profile_pic'] !=''){ ?>
                                 <img src="<?php echo $cele_base_path_uploads ?>profile-pic/size_450/<?php echo $movieartist_data['profile_pic'] ?>" alt="<?php echo $movieartist_data['user_name']; ?>" title="">
                              <?php }else{ ?>
                                 <img src="<?php echo $base_url_images;?>1.jpg" alt="<?php echo $movieartist_data['user_name']; ?>" title="<?php echo $movieartist_data['user_name']; ?>">
                              <?php } ?>  
                           </a>
                           <div class="button-set position-absolute style4 justify-content-center d-none d-md-flex d-lg-flex">
                              <a class="btn-icon btn btn-addto-cart pro-addtocart-popup" onclick="add_to_cart('<?php echo $movieartist_data['id']; ?>')">
                                 <i class="icon an an-cart-l"></i>
                                 <span class="tooltip-label">Add To Cart</span>
                              </a>
                              <a onclick="book_cart('<?php echo $movieartist_data['id']; ?>')" title="Quick View" class="btn-icon" >
                                 <i class="icon an an-search-l"></i>
                                 <span class="tooltip-label">Book Now</span>
                              </a>
                              <a class="btn-icon wishlist add-to-wishlist" onclick="add_to_wishlist('<?php echo $movieartist_data['id']; ?>')">
                                 <i class="icon an an-heart-l"></i>
                                 <span class="tooltip-label">Add To Wishlist</span>
                              </a>
                           </div>
                     </div>
                     <div class="product-details text-center">
                           <div class="product-name">
                              <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $movieartist_data['user_unique_slug']; ?>" class="fw-600"><?php echo ucfirst($movieartist_data['user_name']); ?></a>
                           </div>
                           <div class="product-price">
                              <span class="old-price"><?php echo $selected_currency_icon;?> <?php echo $movieartist_data['price'];  ?></span>
                              <span class="price"><?php echo $selected_currency_icon;?> <?php echo $total_discount;  ?></span>
                           </div>
                     </div>
                  </div>
                  <?php } }else{ echo 'No record found in our storage';} ?>
            </div>
         </div>
      </section>
      <?php 
        } }else if($key=='1'){ 
            $influencers_data_array = array();
            $get_influencers_query = "select u.*, cp.price, cp.discount_type, cp.discount from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where c.category_id IN($value) and u.status='1' and u.is_deleted='0' and u.user_type='2' and cp.price > '0' group by u.id  order by id desc limit 6";
            $result_get_influencers_query = mysqli_query($db_mysqli, $get_influencers_query);
            while ($row_get_influencers_query = mysqli_fetch_assoc($result_get_influencers_query))
            {
               $influencers_data_array[] = $row_get_influencers_query;
            }

            $category_data_array = array();
            $get_category_query = "SELECT * FROM `category` where is_deleted='0'and id IN($value)";
            $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);
            while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
            {
               $category_data_array[] = $row_get_category_query;
            }
            if(count($influencers_data_array) > 0){
            ?>                           
      <section class="section product-slider" style="background: #403c3c;">
         <div class="container">
            <div class="row">
                  <div class="col-12 section-header style1" style="text-align: left; border-bottom: 1px solid #e5e5e5;">
                     <div class="section-header-left">
                        <h2 style="margin-bottom: 5px;"><?php echo ucfirst($category_data_array[0]['category_name']); ?> </h2>
                     </div>
                  </div>
            </div>
            <div class="productPageSlider grid-products">
               <?php 
                     if(count($influencers_data_array) > 0)
                     {
                        foreach($influencers_data_array as $influencers_data){

                           if ($influencers_data["discount_type"] == 'percentage')
                           {
                              $discount = $influencers_data['celebrity_price']*$influencers_data["discount"];
                              $total_discountt = $discount/100;
                              $total_discount = $influencers_data['celebrity_price']-$total_discountt;
                           }
                           else if($influencers_data["discount_type"] == 'price')
                           {
                                 $total_discount = $influencers_data['price']-$influencers_data["discount"];
                           }
                  ?>
                  <div class="item">
                     <div class="product-image">
                           <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $influencers_data['user_unique_slug']; ?>" class="product-img">
                              <?php if($influencers_data['profile_pic'] !=''){ ?>
                                 <img src="<?php echo $cele_base_path_uploads ?>profile-pic/size_450/<?php echo $influencers_data['profile_pic'] ?>" alt="<?php echo $influencers_data['user_name']; ?>" title="">
                              <?php }else{ ?>
                                 <img src="<?php echo $base_url_images;?>1.jpg" alt="<?php echo $influencers_data['user_name']; ?>" title="<?php echo $influencers_data['user_name']; ?>">
                              <?php } ?>  
                           </a>
                           <div class="button-set position-absolute style4 justify-content-center d-none d-md-flex d-lg-flex">
                              <a class="btn-icon btn btn-addto-cart pro-addtocart-popup" onclick="add_to_cart('<?php echo $influencers_data['id']; ?>')">
                                 <i class="icon an an-cart-l"></i>
                                 <span class="tooltip-label">Add To Cart</span>
                              </a>
                              <a onclick="book_cart('<?php echo $influencers_data['id']; ?>')" title="Quick View" class="btn-icon" >
                                 <i class="icon an an-search-l"></i>
                                 <span class="tooltip-label">Book Now</span>
                              </a>
                              <a class="btn-icon wishlist add-to-wishlist" onclick="add_to_wishlist('<?php echo $influencers_data['id']; ?>')">
                                 <i class="icon an an-heart-l"></i>
                                 <span class="tooltip-label">Add To Wishlist</span>
                              </a>
                           </div>
                     </div>
                     <div class="product-details text-center">
                           <div class="product-name">
                              <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $influencers_data['user_unique_slug']; ?>" class="fw-600" style="color:#fff;"><?php echo ucfirst($influencers_data['user_name']); ?></a>
                           </div>
                           <div class="product-price">
                              <span class="old-price" style="color:#fff;"><?php echo $selected_currency_icon;?> <?php echo $influencers_data['price'];  ?></span>
                              <span class="price"><?php echo $selected_currency_icon;?> <?php echo $total_discount;  ?></span>
                           </div>
                     </div>
                  </div>
                  <?php } }else{ echo 'No record found in our storage';} ?>
            </div>
         </div>
      </section>
      <?php } }} ?>                           
      <!--End Editors Pick Products Grid-->

      <!--Parallax Banner-->
      <!-- <div class="section parallax-banner-style1 py-0">
         <div class="hero hero--exlarge hero__overlay bg-size" style="background:#121212;">
            <div class="hero__inner">
               <div class="container">
                  <h1 style="color:#fff;">Tring For Change</h1>
                  <div class="row" style="padding-left:4%">
                     <div class="item col-md-2" style="float: left;  margin-left: 12px; width: 18%;">
                        <div class="product-image">
                              <a href="product-layout1.html" class="product-img">
                                 <img class="primary blur-up lazyload rounded" data-src="assets/images/products/kids-products1.jpg" src="assets/images/products/kids-products1.jpg" alt="image" title="">
                              </a>
                        </div>
                        <div class="product-details text-center">
                              <div class="product-name">
                                 <a href="product-layout1.html" class="fw-600" style="color:#fff;">New Summer Baby Girl Clothes</a>
                              </div>
                              <div class="product-price">
                                 <span class="price" style="color:#fff;">$219.00</span>
                              </div>
                        </div>
                     </div>
                     <div class="item col-md-2" style="float: left;  margin-left: 12px; width: 18%;">
                        <div class="product-image">
                              <a href="product-layout1.html" class="product-img">
                                 <img class="primary blur-up lazyload rounded" data-src="assets/images/products/kids-products1.jpg" src="assets/images/products/kids-products1.jpg" alt="image" title="">
                              </a>
                        </div>
                        <div class="product-details text-center">
                              <div class="product-name">
                                 <a href="product-layout1.html" class="fw-600" style="color:#fff;">New Summer Baby Girl Clothes</a>
                              </div>
                              <div class="product-price">
                                 <span class="price" style="color:#fff;">$219.00</span>
                              </div>
                        </div>
                     </div>
                     <div class="item col-md-2" style="float: left;  margin-left: 12px; width: 18%;">
                        <div class="product-image">
                              <a href="product-layout1.html" class="product-img">
                                 <img class="primary blur-up lazyload rounded" data-src="assets/images/products/kids-products1.jpg" src="assets/images/products/kids-products1.jpg" alt="image" title="">
                              </a>
                        </div>
                        <div class="product-details text-center">
                              <div class="product-name">
                                 <a href="product-layout1.html" class="fw-600" style="color:#fff;">New Summer Baby Girl Clothes</a>
                              </div>
                              <div class="product-price">
                                 <span class="price" style="color:#fff;">$219.00</span>
                              </div>
                        </div>
                     </div>
                     <div class="item col-md-2" style="float: left;  margin-left: 12px; width: 18%;">
                        <div class="product-image">
                              <a href="product-layout1.html" class="product-img">
                                 <img class="primary blur-up lazyload rounded" data-src="assets/images/products/kids-products1.jpg" src="assets/images/products/kids-products1.jpg" alt="image" title="">
                              </a>
                        </div>
                        <div class="product-details text-center">
                              <div class="product-name">
                                 <a href="product-layout1.html" class="fw-600" style="color:#fff;">New Summer Baby Girl Clothes</a>
                              </div>
                              <div class="product-price">
                                 <span class="price" style="color:#fff;">$219.00</span>
                              </div>
                        </div>
                     </div>
                     <div class="item col-md-2" style="float: left;  margin-left: 12px; width: 18%;">
                        <div class="product-image">
                              <a href="product-layout1.html" class="product-img">
                                 <img class="primary blur-up lazyload rounded" data-src="assets/images/products/kids-products1.jpg" src="assets/images/products/kids-products1.jpg" alt="image" title="">
                              </a>
                        </div>
                        <div class="product-details text-center">
                              <div class="product-name">
                                 <a href="product-layout1.html" class="fw-600" style="color:#fff;">New Summer Baby Girl Clothes</a>
                              </div>
                              <div class="product-price">
                                 <span class="price" style="color:#fff;">$219.00</span>
                              </div>
                        </div>
                     </div>
                  </div> 
                  <div class="row"  style="padding-left:4%">  
                     <div class="item col-md-2" style="float: left;  margin-left: 12px; width: 18%;">
                        <div class="product-image">
                              <a href="product-layout1.html" class="product-img">
                                 <img class="primary blur-up lazyload rounded" data-src="assets/images/products/kids-products1.jpg" src="assets/images/products/kids-products1.jpg" alt="image" title="">
                              </a>
                        </div>
                        <div class="product-details text-center">
                              <div class="product-name">
                                 <a href="product-layout1.html" class="fw-600" style="color:#fff;">New Summer Baby Girl Clothes</a>
                              </div>
                              <div class="product-price">
                                 <span class="price" style="color:#fff;">$219.00</span>
                              </div>
                        </div>
                     </div>
                     <div class="item col-md-2" style="float: left;  margin-left: 12px; width: 18%;">
                        <div class="product-image">
                              <a href="product-layout1.html" class="product-img">
                                 <img class="primary blur-up lazyload rounded" data-src="assets/images/products/kids-products1.jpg" src="assets/images/products/kids-products1.jpg" alt="image" title="">
                              </a>
                        </div>
                        <div class="product-details text-center">
                              <div class="product-name">
                                 <a href="product-layout1.html" class="fw-600" style="color:#fff;">New Summer Baby Girl Clothes</a>
                              </div>
                              <div class="product-price">
                                 <span class="price" style="color:#fff;">$219.00</span>
                              </div>
                        </div>
                     </div>
                     <div class="item col-md-2" style="float: left;  margin-left: 12px; width: 18%;">
                        <div class="product-image">
                              <a href="product-layout1.html" class="product-img">
                                 <img class="primary blur-up lazyload rounded" data-src="assets/images/products/kids-products1.jpg" src="assets/images/products/kids-products1.jpg" alt="image" title="">
                              </a>
                        </div>
                        <div class="product-details text-center">
                              <div class="product-name">
                                 <a href="product-layout1.html" class="fw-600" style="color:#fff;">New Summer Baby Girl Clothes</a>
                              </div>
                              <div class="product-price">
                                 <span class="price" style="color:#fff;">$219.00</span>
                              </div>
                        </div>
                     </div>
                     <div class="item col-md-2" style="float: left;  margin-left: 12px; width: 18%;">
                        <div class="product-image">
                              <a href="product-layout1.html" class="product-img">
                                 <img class="primary blur-up lazyload rounded" data-src="assets/images/products/kids-products1.jpg" src="assets/images/products/kids-products1.jpg" alt="image" title="">
                              </a>
                        </div>
                        <div class="product-details text-center">
                              <div class="product-name">
                                 <a href="product-layout1.html" class="fw-600" style="color:#fff;">New Summer Baby Girl Clothes</a>
                              </div>
                              <div class="product-price">
                                 <span class="price" style="color:#fff;">$219.00</span>
                              </div>
                        </div>
                     </div>
                     <div class="item col-md-2" style="float: left;  margin-left: 12px; width: 18%;">
                        <div class="product-image">
                              <a href="product-layout1.html" class="product-img">
                                 <img class="primary blur-up lazyload rounded" data-src="assets/images/products/kids-products1.jpg" src="assets/images/products/kids-products1.jpg" alt="image" title="">
                              </a>
                        </div>
                        <div class="product-details text-center">
                              <div class="product-name">
                                 <a href="product-layout1.html" class="fw-600" style="color:#fff;">New Summer Baby Girl Clothes</a>
                              </div>
                              <div class="product-price">
                                 <span class="price" style="color:#fff;">$219.00</span>
                              </div>
                        </div>
                     </div>
                  </div>   
               </div> 
            </div>
         </div>
      </div> -->
      <!--End Parallax Banner-->

      <!--Collection Slider Section-->
      <section class="section testimonial-slider style2 pt-0" style="padding-top: 30px !important;">
         <div class="container">
            <div class="section-header">
                  <h2 class="mb-0">Gifting</h2>
                  <p>Unique Personalised Gifts for your loved ones!</p>
            </div>
            <div class="quote-wraper">
                  <!--Testimonial Slider Items-->
                  <div class="quotes-slider arwOut3">
                  <?php
                     if(count($giftsubsubcate_data_array) > 0)
                     { 
                        $i = 1;
                        foreach($giftsubsubcate_data_array as $giftsubsubcate_data){
                     ?>
                     <div class="slide">
                        <blockquote class="quotes-slider__text">             
                           <a href="<?php echo $base_url ?>gifting/best-birthday-gift-for-<?php echo $giftsubsubcate_data['giftsubsubcate_name']; ?>" class="collection-grid-link">
                           <div class="img" <?php if($i%2==0){ ?>style="background-image: url(assets/images/even-slide.png); background-repeat: no-repeat;  background-size: contain; margin: 0 10px; width: 300px; text-align: -webkit-center; padding: 12px 0;"<?php }else{?>style="background-image: url(assets/images/odd-slide.png); background-repeat: no-repeat;  background-size: contain; margin: 0 10px; width: 300px; text-align: -webkit-center; padding: 12px 0;"<?php }?>>
                                 <img class="blur-up lazyload" data-src="<?php echo $base_url_uploads ?>gift-sub-sub-category-images/temp_file/<?php echo $giftsubsubcate_data['giftsubsubcate_images']; ?>" src="<?php echo $base_url_uploads; ?>gift-sub-sub-category-images/temp_file/<?php echo $giftsubsubcate_data['giftsubsubcate_images']; ?>" alt="<?php echo $giftsubsubcate_data['giftsubsubcate_name']; ?>" style="width: unset;"/>
                           </div>
                           <div class="details">
                                 <h3 class="collection-item-title body-font text-capitalize text-center">Best Birthday Gift For<br> <?php echo $giftsubsubcate_data['giftsubsubcate_name']; ?></h3>
                           </div>
                        </a>
                        </blockquote>
                     </div>
                     <?php $i++; } } ?>  
                  </div>
                  <!--Testimonial Slider Items-->
            </div>
         </div>
      </section>
      <!--Collection Slider Section-->
      <?php 
         $all_categorysection_data_array = array();
         $get_categorysection_query = "SELECT * FROM display_category_wise_section";
         $result_get_categorysection_query = mysqli_query($db_mysqli, $get_categorysection_query);
         while ($row_get_categorysection_query = mysqli_fetch_assoc($result_get_categorysection_query))
         {
             $all_categorysection_data_array[] = $row_get_categorysection_query;
         }
         $categorysec_id = explode(',',$all_categorysection_data_array[0]['category_id']);
         foreach ($categorysec_id as $key => $value) {
            if($key=='2'){
               $music_data_array = array();
               $get_music_query = "select u.*, cp.price, cp.discount_type, cp.discount from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where c.category_id IN($value) and u.status='1' and u.is_deleted='0' and u.user_type='2' and cp.price > '0' group by u.id  order by id desc limit 6";
               $result_get_music_query = mysqli_query($db_mysqli, $get_music_query);
               while ($row_get_music_query = mysqli_fetch_assoc($result_get_music_query))
               {
                  $music_data_array[] = $row_get_music_query;
               }

               $category_data_array = array();
               $get_category_query = "SELECT * FROM `category` where is_deleted='0'and id IN($value)";
               $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);
               while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
               {
                  $category_data_array[] = $row_get_category_query;
               }  
               if(count($music_data_array) > 0){
      ?>                     
      <section class="section product-slider" style="background: lavender;">
         <div class="container">
            <div class="row">
                  <div class="col-12 section-header style1" style="text-align: left; border-bottom: 1px solid #e5e5e5;">
                     <div class="section-header-left">
                        <h2 style="margin-bottom: 5px;"><?php echo ucfirst($category_data_array[0]['category_name']); ?> </h2>
                     </div>
                  </div>
            </div>
            <div class="productPageSlider grid-products">
               <?php 
                     if(count($music_data_array) > 0)
                     {
                        foreach($music_data_array as $music_data){

                           if ($music_data["discount_type"] == 'percentage')
                           {
                              $discount = $music_data['celebrity_price']*$music_data["discount"];
                              $total_discountt = $discount/100;
                              $total_discount = $music_data['celebrity_price']-$total_discountt;
                           }
                           else if($music_data["discount_type"] == 'price')
                           {
                                 $total_discount = $music_data['price']-$music_data["discount"];
                           }
                  ?>
                  <div class="item">
                     <div class="product-image">
                           <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $music_data['user_unique_slug']; ?>" class="product-img">
                              <?php if($user_data_array[0]['profile_pic'] !=''){ ?>
                                 <img src="<?php echo $cele_base_path_uploads ?>profile-pic/size_450/<?php echo $music_data['profile_pic'] ?>" alt="<?php echo $music_data['user_name']; ?>" title="">
                              <?php }else{ ?>
                                 <img src="<?php echo $base_url_images;?>1.jpg" alt="<?php echo $music_data['user_name']; ?>" title="<?php echo $music_data['user_name']; ?>">
                              <?php } ?>  
                           </a>
                           <div class="button-set position-absolute style4 justify-content-center d-none d-md-flex d-lg-flex">
                              <a class="btn-icon btn btn-addto-cart pro-addtocart-popup" onclick="add_to_cart('<?php echo $music_data['id']; ?>')">
                                 <i class="icon an an-cart-l"></i>
                                 <span class="tooltip-label">Add To Cart</span>
                              </a>
                              <a onclick="book_cart('<?php echo $music_data['id']; ?>')" title="Quick View" class="btn-icon" >
                                 <i class="icon an an-search-l"></i>
                                 <span class="tooltip-label">Book Now</span>
                              </a>
                              <a class="btn-icon wishlist add-to-wishlist" onclick="add_to_wishlist('<?php echo $music_data['id']; ?>')">
                                 <i class="icon an an-heart-l"></i>
                                 <span class="tooltip-label">Add To Wishlist</span>
                              </a>
                           </div>
                     </div>
                     <div class="product-details text-center">
                           <div class="product-name">
                              <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $music_data['user_unique_slug']; ?>" class="fw-600"><?php echo ucfirst($music_data['user_name']); ?></a>
                           </div>
                           <div class="product-price">
                              <span class="old-price"><?php echo $selected_currency_icon;?> <?php echo $music_data['price'];  ?></span>
                              <span class="price"><?php echo $selected_currency_icon;?> <?php echo $total_discount;  ?></span>
                           </div>
                     </div>
                  </div>
                  <?php } }else{ echo 'No record found in our storage';} ?>
            </div>
         </div>
      </section>
      <?php 
         }}else if($key=='3'){ 
            $models_data_array = array();
            $get_models_query = "select u.*, cp.price, cp.discount_type, cp.discount from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where c.category_id IN($value) and u.status='1' and u.is_deleted='0' and u.user_type='2' and cp.price > '0' group by u.id  order by id desc limit 6";
            $result_get_models_query = mysqli_query($db_mysqli, $get_models_query);
            while ($row_get_models_query = mysqli_fetch_assoc($result_get_models_query))
            {
               $models_data_array[] = $row_get_models_query;
            }

            $category_data_array = array();
            $get_category_query = "SELECT * FROM `category` where is_deleted='0'and id IN($value)";
            $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);
            while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
            {
               $category_data_array[] = $row_get_category_query;
            } 
            if(count($models_data_array) > 0){
         ?>                           
      <section class="section product-slider">
         <div class="container">
            <div class="row">
                  <div class="col-12 section-header style1" style="text-align: left; border-bottom: 1px solid #e5e5e5;">
                     <div class="section-header-left">
                        <h2 style="margin-bottom: 5px;"><?php echo ucfirst($category_data_array[0]['category_name']); ?> </h2>
                     </div>
                  </div>
            </div>
            <div class="productPageSlider grid-products">
               <?php 
                     if(count($models_data_array) > 0)
                     {
                        foreach($models_data_array as $models_data){

                           if ($models_data["discount_type"] == 'percentage')
                           {
                              $discount = $models_data['celebrity_price']*$models_data["discount"];
                              $total_discountt = $discount/100;
                              $total_discount = $models_data['celebrity_price']-$total_discountt;
                           }
                           else if($models_data["discount_type"] == 'price')
                           {
                                 $total_discount = $models_data['price']-$models_data["discount"];
                           }
                  ?>
                  <div class="item col-md-2">
                     <div class="product-image">
                           <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $models_data['user_unique_slug']; ?>" class="product-img">
                              <?php if($models_data['profile_pic'] !=''){ ?>
                                 <img src="<?php echo $cele_base_path_uploads ?>profile-pic/size_450/<?php echo $models_data['profile_pic'] ?>" alt="<?php echo $models_data['user_name']; ?>" title="">
                              <?php }else{ ?>
                                 <img src="<?php echo $base_url_images;?>1.jpg" alt="<?php echo $models_data['user_name']; ?>" title="<?php echo $models_data['user_name']; ?>">
                              <?php } ?>  
                           </a>
                           <div class="button-set position-absolute style4 justify-content-center d-none d-md-flex d-lg-flex">
                              <a class="btn-icon btn btn-addto-cart pro-addtocart-popup" onclick="add_to_cart('<?php echo $models_data['id']; ?>')">
                                 <i class="icon an an-cart-l"></i>
                                 <span class="tooltip-label">Add To Cart</span>
                              </a>
                              <a onclick="book_cart('<?php echo $models_data['id']; ?>')" title="Quick View" class="btn-icon" >
                                 <i class="icon an an-search-l"></i>
                                 <span class="tooltip-label">Book Now</span>
                              </a>
                              <a class="btn-icon wishlist add-to-wishlist" onclick="add_to_wishlist('<?php echo $models_data['id']; ?>')">
                                 <i class="icon an an-heart-l"></i>
                                 <span class="tooltip-label">Add To Wishlist</span>
                              </a>
                           </div>
                     </div>
                     <div class="product-details text-center">
                        <div class="product-name">
                           <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $models_data['user_unique_slug']; ?>" class="fw-600"><?php echo ucfirst($models_data['user_name']); ?></a>
                        </div>
                        <div class="product-price">
                              <span class="old-price"><?php echo $selected_currency_icon;?> <?php echo $models_data['price'];  ?></span>
                              <span class="price"><?php echo $selected_currency_icon;?> <?php echo $total_discount;  ?></span>
                        </div>
                     </div>
                  </div>
                  <?php } }else{ echo 'No record found in our storage';} ?>
            </div>
         </div>
      </section>       
      <?php }}} ?>                           
      <!--Store Feature-->
      <section class="section store-features style3">
         <div class="container">
            <div class="section-header d-none">
                  <h2>Store Features</h2>
            </div>
            <div class="row store-info">
                  <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-flex flex-column align-items-center text-center mb-3 mb-md-0">
                     <i class="an an-home-l text-white m-0"></i>
                     <div class="detail text-white">
                        <p>At Optimal, family always comes first. It inspires everything that we do.</p>
                     </div>
                  </div>
                  <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-flex flex-column align-items-center text-center mb-3 mb-md-0">
                     <i class="an an-phone-24 text-white m-0"></i>
                     <div class="detail text-white">
                        <p>We provide the top notch customer service, worldwide and in over 10 languages.</p>
                     </div>
                  </div>
                  <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-flex flex-column align-items-center text-center mb-3 mb-sm-0">
                     <i class="an an-like text-white m-0"></i>
                     <div class="detail text-white">
                        <p>Shop the designers you know and love. Authenticity and quality are guaranteed.</p>
                     </div>
                  </div>
                  <div class="col-12 col-sm-6 col-md-3 col-lg-3 d-flex flex-column align-items-center text-center">
                     <i class="an an-star-o text-white m-0"></i>
                     <div class="detail text-white">
                        <p>Your feedback is important to us. We enjoy hearing from every one of you.</p>
                     </div>
                  </div>
            </div>
         </div>
      </section>
      <?php 
         $all_categorysection_data_array = array();
         $get_categorysection_query = "SELECT * FROM display_category_wise_section";
         $result_get_categorysection_query = mysqli_query($db_mysqli, $get_categorysection_query);
         while ($row_get_categorysection_query = mysqli_fetch_assoc($result_get_categorysection_query))
         {
             $all_categorysection_data_array[] = $row_get_categorysection_query;
         }
         $categorysec_id = explode(',',$all_categorysection_data_array[0]['category_id']);
         foreach ($categorysec_id as $key => $value) {
            if($key=='4'){
               $athletes_data_array = array();
               $get_athletes_query = "select u.*, cp.price, cp.discount_type, cp.discount from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where c.category_id IN($value) and u.status='1' and u.is_deleted='0' and u.user_type='2' and cp.price > '0' group by u.id  order by id desc limit 6";
               $result_get_athletes_query = mysqli_query($db_mysqli, $get_athletes_query);
               while ($row_get_athletes_query = mysqli_fetch_assoc($result_get_athletes_query))
               {
                  $athletes_data_array[] = $row_get_athletes_query;
               }    

               $category_data_array = array();
               $get_category_query = "SELECT * FROM `category` where is_deleted='0'and id IN($value)";
               $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);
               while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
               {
                  $category_data_array[] = $row_get_category_query;
               }  
               if(count($athletes_data_array) > 0){
      ?>   
      <section class="section product-slider">
         <div class="container">
            <div class="row">
                  <div class="col-12 section-header style1" style="text-align: left; border-bottom: 1px solid #e5e5e5;">
                     <div class="section-header-left">
                        <h2 style="margin-bottom: 5px;"><?php echo ucfirst($category_data_array[0]['category_name']); ?> </h2>
                     </div>
                  </div>
            </div>
            <div class="productPageSlider grid-products">
               <?php 
                     if(count($athletes_data_array) > 0)
                     {
                        foreach($athletes_data_array as $athletes_data){

                           if ($athletes_data["discount_type"] == 'percentage')
                           {
                              $discount = $athletes_data['celebrity_price']*$athletes_data["discount"];
                              $total_discountt = $discount/100;
                              $total_discount = $athletes_data['celebrity_price']-$total_discountt;
                           }
                           else if($athletes_data["discount_type"] == 'price')
                           {
                                 $total_discount = $athletes_data['price']-$athletes_data["discount"];
                           }
                  ?>
                  <div class="item">
                     <div class="product-image">
                           <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $athletes_data['user_unique_slug']; ?>" class="product-img">
                              <?php if($user_data_array[0]['profile_pic'] !=''){ ?>
                                 <img src="<?php echo $cele_base_path_uploads ?>profile-pic/size_450/<?php echo $athletes_data['profile_pic'] ?>" alt="<?php echo $athletes_data['user_name']; ?>" title="">
                              <?php }else{ ?>
                                 <img src="<?php echo $base_url_images;?>1.jpg" alt="<?php echo $athletes_data['user_name']; ?>" title="<?php echo $athletes_data['user_name']; ?>">
                              <?php } ?>  
                           </a>
                           <div class="button-set position-absolute style4 justify-content-center d-none d-md-flex d-lg-flex">
                              <a class="btn-icon btn btn-addto-cart pro-addtocart-popup" onclick="add_to_cart('<?php echo $athletes_data['id']; ?>')">
                                 <i class="icon an an-cart-l"></i>
                                 <span class="tooltip-label">Add To Cart</span>
                              </a>
                              <a onclick="book_cart('<?php echo $athletes_data['id']; ?>')" title="Quick View" class="btn-icon" >
                                 <i class="icon an an-search-l"></i>
                                 <span class="tooltip-label">Book Now</span>
                              </a>
                              <a class="btn-icon wishlist add-to-wishlist" onclick="add_to_wishlist('<?php echo $athletes_data['id']; ?>')">
                                 <i class="icon an an-heart-l"></i>
                                 <span class="tooltip-label">Add To Wishlist</span>
                              </a>
                           </div>
                     </div>
                     <div class="product-details text-center">
                           <div class="product-name">
                              <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $athletes_data['user_unique_slug']; ?>" class="fw-600"><?php echo ucfirst($athletes_data['user_name']); ?></a>
                           </div>
                           <div class="product-price">
                              <span class="old-price"><?php echo $selected_currency_icon;?> <?php echo $athletes_data['price'];  ?></span>
                              <span class="price"><?php echo $selected_currency_icon;?> <?php echo $total_discount;  ?></span>
                           </div>
                     </div>
                  </div>
                  <?php } }else{ echo 'No record found in our storage';} ?>
            </div>
         </div>
      </section>
      <?php 
         }}else if($key == '5'){

            $tvartist_data_array = array();
            $get_tvartist_query = "select u.*, cp.price, cp.discount_type, cp.discount from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where c.category_id IN($value) and u.status='1' and u.is_deleted='0' and u.user_type='2' and cp.price > '0' group by u.id  order by id desc limit 6";
            $result_get_tvartist_query = mysqli_query($db_mysqli, $get_tvartist_query);
            while ($row_get_tvartist_query = mysqli_fetch_assoc($result_get_tvartist_query))
            {
                $tvartist_data_array[] = $row_get_tvartist_query;
            }   

            $category_data_array = array();
            $get_category_query = "SELECT * FROM `category` where is_deleted='0'and id IN($value)";
            $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);
            while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
            {
               $category_data_array[] = $row_get_category_query;
            } 
            if(count($tvartist_data_array) > 0){
         ?>
      <section class="section product-slider" style="background: papayawhip;">
         <div class="container">
            <div class="row">
                  <div class="col-12 section-header style1" style="text-align: left; border-bottom: 1px solid #e5e5e5;">
                     <div class="section-header-left">
                        <h2 style="margin-bottom: 5px;">TV Artist </h2>
                     </div>
                  </div>
            </div>
            <div class="productPageSlider grid-products">
               <?php 
                     if(count($tvartist_data_array) > 0)
                     {
                        foreach($tvartist_data_array as $tvartist_data){

                           if ($tvartist_data["discount_type"] == 'percentage')
                           {
                              $discount = $tvartist_data['celebrity_price']*$tvartist_data["discount"];
                              $total_discountt = $discount/100;
                              $total_discount = $tvartist_data['celebrity_price']-$total_discountt;
                           }
                           else if($tvartist_data["discount_type"] == 'price')
                           {
                                 $total_discount = $tvartist_data['price']-$tvartist_data["discount"];
                           }
                  ?>
                  <div class="item">
                     <div class="product-image">
                           <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $tvartist_data['user_unique_slug']; ?>" class="product-img">
                              <?php if($user_data_array[0]['profile_pic'] !=''){ ?>
                                 <img src="<?php echo $cele_base_path_uploads ?>profile-pic/size_450/<?php echo $tvartist_data['profile_pic'] ?>" alt="<?php echo $tvartist_data['user_name']; ?>" title="">
                              <?php }else{ ?>
                                 <img src="<?php echo $base_url_images;?>1.jpg" alt="<?php echo $tvartist_data['user_name']; ?>" title="<?php echo $tvartist_data['user_name']; ?>">
                              <?php } ?>  
                           </a>
                           <div class="button-set position-absolute style4 justify-content-center d-none d-md-flex d-lg-flex">
                              <a class="btn-icon btn btn-addto-cart pro-addtocart-popup" onclick="add_to_cart('<?php echo $tvartist_data['id']; ?>')">
                                 <i class="icon an an-cart-l"></i>
                                 <span class="tooltip-label">Add To Cart</span>
                              </a>
                              <a onclick="book_cart('<?php echo $tvartist_data['id']; ?>')" title="Quick View" class="btn-icon" >
                                 <i class="icon an an-search-l"></i>
                                 <span class="tooltip-label">Book Now</span>
                              </a>
                              <a class="btn-icon wishlist add-to-wishlist" onclick="add_to_wishlist('<?php echo $tvartist_data['id']; ?>')">
                                 <i class="icon an an-heart-l"></i>
                                 <span class="tooltip-label">Add To Wishlist</span>
                              </a>
                           </div>
                     </div>
                     <div class="product-details text-center">
                           <div class="product-name">
                              <a href="<?php echo $base_url; ?>celebrity-details/<?php echo $tvartist_data['user_unique_slug']; ?>" class="fw-600"><?php echo ucfirst($tvartist_data['user_name']); ?></a>
                           </div>
                           <div class="product-price">
                              <span class="old-price"><?php echo $selected_currency_icon;?> <?php echo $tvartist_data['price'];  ?></span>
                              <span class="price"><?php echo $selected_currency_icon;?> <?php echo $total_discount;  ?></span>
                           </div>
                     </div>
                  </div>
                  <?php } }else{ echo 'No record found in our storage';} ?>
            </div>
         </div>
      </section>
      <?php }}} ?>  
      <!--End Store Feature-->
</div>
   
    <?php include 'common/footer.php';?>
    <?php include 'common/footer-js.php';?>

 </body>    
</html>