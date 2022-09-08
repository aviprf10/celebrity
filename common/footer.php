<?php 
$master_settings_data_array = array();
$master_settings_query = "SELECT * FROM company_info WHERE id='1'";
$result_master_settings_data = mysqli_query($db_mysqli, $master_settings_query);
while ($row_master_settings_data = mysqli_fetch_assoc($result_master_settings_data))
{
    $master_settings_data_array[] = $row_master_settings_data;
}
?>
<!--Footer-->
<div class="footer footer-5" style="background: #2b2b2b;">
   <div class="footer-top clearfix bg-transparent">
      <div class="container">
         <div class="row">
               <!-- <div class="col-12 col-sm-12 col-md-12 col-lg-12 newsletter-col mt-0 mb-md-4">
                  <form action="#" method="post" class="footer-newsletter">
                     <label class="h4 mb-2 text-transform-none">Sign up now & get 10% off</label>
                     <p>Be the first to know about our new arrivals and exclusive offers.</p>
                     <div class="input-group">
                           <input type="email" class="border-0 rounded-pill-start ps-4 input-group__field newsletter-input" name="EMAIL" value="" placeholder="Email address" required>
                           <span class="input-group__btn"><button type="submit" class="an-1x btn btn-secondary rounded-pill-end newsletter__submit rounded-0" name="commit">SUBSCRIBE</button></span>
                     </div>
                  </form>
               </div> -->

               <div class="col-12 col-sm-12 col-md-6 col-lg-6 footer-about">
                  <img src="<?php echo $base_url_images; ?>logo.png" alt="Wish Vader" class="mb-3" width="160" height="33" />
                  <p class="mb-1" style="color:#fff;"><?php echo $master_settings_data_array[0]['company_description']; ?></p>
                  <ul class="list-inline social-icons pt-1">
                     <li class="list-inline-item"><a href="<?php echo $master_settings_data_array[0]['facebook_link']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook"><i class="an an-facebook" style="color:#fff;" aria-hidden="true"></i></a></li>
                     <li class="list-inline-item"><a href="<?php echo $master_settings_data_array[0]['twitter_link']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter"><i class="an an-twitter"  style="color:#fff;"aria-hidden="true"></i></a></li>
                     <li class="list-inline-item"><a href="<?php echo $master_settings_data_array[0]['pintrest_link']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Pinterest"><i class="an an-pinterest-p"  style="color:#fff;"aria-hidden="true"></i></a></li>
                     <li class="list-inline-item"><a href="<?php echo $master_settings_data_array[0]['insta_link']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Instagram"><i class="an an-instagram"  style="color:#fff;"aria-hidden="true"></i></a></li>
                     <li class="list-inline-item"><a href="<?php echo $master_settings_data_array[0]['google_link']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="google"><i class="an an-google "  style="color:#fff;"aria-hidden="true"></i></a></li>
                     <li class="list-inline-item"><a href="<?php echo $master_settings_data_array[0]['linkedin_link']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="linkedin"><i class="an an-linkedin "  style="color:#fff;"aria-hidden="true"></i></a></li>
                     <li class="list-inline-item"><a href="<?php echo $master_settings_data_array[0]['whatsapp_link']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Whatsapp"><i class="an an-whatsapp"  style="color:#fff;"aria-hidden="true"></i></a></li>
                  </ul>
               </div>
               <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                  <h4 class="h4 text-transform-none" style="color:#fff;">Informations</h4>
                  <ul>
                     
                     <li><a href="<?php echo $base_url ?>about-us" style="color:#fff;">About us</a></li>
                     <li><a href="<?php echo $base_url ?>disclaimer" style="color:#fff;">Disclaimer</a></li>
                     <li><a href="<?php echo $base_url ?>return-policy" style="color:#fff;">Return Policy</a></li>
                     <li><a href="<?php echo $base_url ?>privacy-policy" style="color:#fff;">Privacy Policy</a></li>
                     <li><a href="<?php echo $base_url ?>terms-and-condition" style="color:#fff;">Terms &amp; condition</a></li>
                  </ul>
               </div>
               <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-contact">
                  <h4 class="h4 text-transform-none" style="color:#fff;">Contact Us</h4>
                  <?php if($master_settings_data_array[0]['company_address'] !=''){ ?>
                  <p class="address d-flex align-items-center" style="color:#fff;">
                     <i class="an an-map-marker-al" style="color:#fff;"></i><?php  echo $master_settings_data_array[0]['company_address']; ?> <?php echo $master_settings_data_array[0]['company_address2']; ?>  <?php echo $master_settings_data_array[0]['city']; ?>-<?php echo $master_settings_data_array[0]['pincode']; ?>, <?php echo $master_settings_data_array[0]['state']; ?>, <?php echo $master_settings_data_array[0]['country']; ?>
                  </p>
                  <?php } ?>
                  <?php if($master_settings_data_array[0]['company_mobile'] !=''){ ?>
                  <p class="phone d-flex align-items-center" style="color:#fff;"><i class="an an-phone-l" style="color:#fff;"></i>  <b class="me-1 d-none">Phone:</b> <a href="tel:+91<?php echo $master_settings_data_array[0]['company_mobile']; ?>" style="color:#fff;">(+91) <?php echo $master_settings_data_array[0]['company_mobile']; ?></a>, &nbsp;
                  <a href="tel:+91<?php echo $master_settings_data_array[0]['company_mobile2']; ?>" style="color:#fff;">(+91)<?php echo $master_settings_data_array[0]['company_mobile2']; ?></a></p>
                  <?php } ?>
                  <?php if($master_settings_data_array[0]['company_email'] !=''){ ?>
                  <p class="email d-flex align-items-center" style="color:#fff;"><i class="an an-envelope-l" style="color:#fff;"></i> <b class="me-1 d-none">Email:</b> <a href="mailto:<?php echo $master_settings_data_array[0]['company_email']; ?>" style="color:#fff;"><?php echo $master_settings_data_array[0]['company_email']; ?></a>, &nbsp;
                  <a href="mailto:<?php echo $master_settings_data_array[0]['company_email2']; ?>" style="color:#fff;"><?php echo $master_settings_data_array[0]['company_email2']; ?></a></p>
                  <?php } ?>   
               </div>
         </div>               
      </div>
   </div>
   <div class="footer-bottom clearfix bg-transparent">
      <div class="container">
         <div class="d-flex-center flex-column justify-content-md-between flex-md-row-reverse">
               <!-- <img src="<?php echo $base_url_images; ?>payment.png" alt="Paypal Visa Payments"/> -->
               <div class="copytext" style="color:#fff;">&copy; <?php echo date('Y'); ?> Wish Vader. All Rights Reserved.</div>
         </div>
      </div>
   </div>
</div>
<!--End Footer-->

<!--Scoll Top-->
<!-- <span id="site-scroll" class="textbase" title="SCROLL UP">SCROLL UP <i class="an an-long-arrow-alt-right" aria-hidden="true"></i></span> -->
<!--End Scoll Top-->

<!--MiniCart Drawer-->
<div class="minicart-right-drawer modal right fade" id="minicart-drawer">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="block block-cart">
               <div class="minicart-header">
                  <a href="javascript:void(0);" class="close-cart" onclick="closeModel();"><i class="an an-times-r" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="left" title="Close"></i></a>
                  <h4 class="fs-6 text-black">Your cart <span id="header_cart_total_count">(<?php echo $_SESSION['total_user_cart_data_'.$company_name_session]; ?> Items)</span></h4>
               </div>
               <ul id="header_cart_container" class="mini-products-list" style="list-style: none;"></ul>
         </div>
      </div>
   </div>
</div>
<!--End MiniCart Drawer-->
<div class="modalOverly"></div>

<!--Quickview Popup-->
<div class="loadingBox"><div class="an-spin"><i class="icon an an-spinner4"></i></div></div>
<div id="quickView-modal" class="mfp-with-anim mfp-hide">
   <button title="Close (Esc)" type="button" class="mfp-close">×</button>
   <div class="row">
      <h4>Who i am ?</h4>
      <div class="col-md-3">
         <div class="col-md-12"  style="border: 1px solid #d7d2d2; border-radius: 10px; padding: 10px; margin-left: 3%;">
            <a href="<?php echo $base_url;?>registration"><img src="<?php echo $base_url_images ?>user.jpeg"></a>
         </div>   
         <h2 style="text-align: center;  padding: 15px; padding-bottom: 0px; margin-bottom: 0px;">User</h2>
      </div> 
      <div class="col-md-1"></div>
      <div class="col-md-3">
         <div class="col-md-12"  style="border: 1px solid #d7d2d2; border-radius: 10px; padding: 10px;">
            <a href="<?php echo $base_url;?>brand/registration"><img src="<?php echo $base_url_images ?>brand.png"></a>
         </div>  
         <h2  style="text-align: center;  padding: 15px; padding-bottom: 0px; margin-bottom: 0px;">Brand</h2>
      </div> 
      <div class="col-md-1"></div>
      <div class="col-md-3">
         <div class="col-md-12"  style="border: 1px solid #d7d2d2; border-radius: 10px; padding: 10px;">
            <a href="<?php echo $base_url;?>celebrity/login"><img src="<?php echo $base_url_images ?>celebrty.png"></a>
         </div> 
         <h2  style="text-align: center;  padding: 15px; padding-bottom: 0px; margin-bottom: 0px;">Celebrity</h2>
      </div>   
   </div>
</div>
<!--End Quickview Popup-->

<!--Addtocart Added Popup-->
<div id="pro-addtocart-popup" class="mfp-with-anim mfp-hide">
   <button title="Close (Esc)" type="button" class="mfp-close">×</button>
   <div class="addtocart-inner text-center clearfix">
      <h4 class="title mb-3 text-success">Added to your shopping cart successfully.</h4>
      <div class="pro-img mb-3">
         <img class="img-fluid blur-up lazyload" src="<?php echo $base_url_images; ?>products/kids-products1.jpg" data-src="<?php echo $base_url_images; ?>products/kids-products1.jpg" alt="Added to your shopping cart successfully." title="Added to your shopping cart successfully." />
      </div>
      <div class="pro-details">   
         <h5 class="pro-name mb-0">Ditsy Floral Dress</h5>
         <p class="sku my-2">Color: Gray</p>
         <p class="mb-0 qty-total">1 X $113.88</p>
         <div class="addcart-total bg-light mt-3 mb-3 p-2">
               Total: <b class="price">$113.88</b>
         </div>
         <div class="button-action">
               <a href="#" class="btn btn-primary view-cart mx-1 rounded-pill">Go To Checkout</a>
               <a href="#" class="btn btn-secondary rounded-pill">Continue Shopping</a>
         </div>
      </div>
   </div>
</div>
<!-- End Addtocart Added Popup-->
