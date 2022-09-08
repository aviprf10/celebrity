<?php
include "common/config.php";    
include "common/check_login.php";
include "common/common_code.php";
$title = $_GET['title'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Signin | Signup  | <?php echo $company_title;?></title>
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
<body class="login-page">
   <?php include 'common/header.php';?>
   <div id="page-content">   
      <!--Collection Banner-->
      <div class="collection-header">
         <div class="collection-hero">
            <div class="collection-hero__image"></div>
            <div class="collection-hero__title-wrapper container">
                  <h1 class="collection-hero__title">Login</h1>
                  <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="index.html" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Login</span></div>
            </div>
         </div>
      </div>
      <!--End Collection Banner-->

      <!--Container-->
      <div class="container">
         <!--Main Content-->
         <div class="login-register pt-2 pt-lg-5">
            <div class="row">
                  <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4 mb-md-0">
                     <div class="inner">
                        <form method="POST" id="login_form" role="form" data-parsley-validate>	
                              <h3 class="h4 text-uppercase">LOGIN|SIGNIN BRANDS</h3>
                              <p>If you have an account with us, please log in.</p>
                              <div class="row">
                                 <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                          <label for="CustomerEmail" class="d-none">Email Id or Mobile No <span class="required">*</span></label>
                                          <input type="text" name="login_id" id="login_id" placeholder="E-Mail or Mobile" data-parsley-required="true"/>
                                          <input type="hidden"  name="login_id_session" id="login_id_session" value="<?php echo $_SESSION['wishlist_current_page_'.$company_name_session];?>" data-parsley-required="true"/>
                                    </div>
                                 </div>
                                 <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                          <label for="CustomerPassword" class="d-none">Password <span class="required">*</span></label>
                                          <input placeholder="Password"  type="password" name="password" id="password" data-parsley-required="true" />                        	
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="text-left col-12 col-sm-12 col-md-12 col-lg-12">
                                    <p class="d-flex-center">
                                          <input type="submit" class="btn rounded me-auto" value="Sign In">
                                          <!-- <a href="forgot-password.html">Forgot your password?</a> -->
                                    </p>
                                 </div>
                              </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                     <div class="inner">
                        <h3 class="h4 text-uppercase">NEW BRANDS?</h3>
                        <p>If you have no an account with us, please sign up.</p>
                        <form method="POST" id="registration_form" data-parsley-validate class="form-horizontal">
                           <div class="row mb-6">
                              <div class="col">
                                 <div class="form-outline">
                                    <label class="form-label" for="form6Example1">Brand Name</label>
                                    <input type="text" name="name" id="name" placeholder="Brand Name" data-parsley-required="true" class="form-control" />
                                 </div>
                              </div>
                              <div class="col">
                                 <div class="form-outline">
                                    <label class="form-label" for="form6Example5">Email</label>
                                    <input type="email" name="email" id="email" placeholder="E-Mail" data-parsley-required="true" class="form-control" />
                                 </div>
                              </div>
                           </div><br>
                           <div class="row mb-6">
                              <div class="col">
                                 <div class="form-outline">
                                    <label class="form-label" for="form6Example1">Password</label>
                                    <input type="password" name="password" id="password"  placeholder="Password" maxlength="30" minlength="6"  data-parsley-required="true" class="form-control" />
                                 </div>
                              </div>
                              <div class="col">
                                 <div class="form-outline">
                                    <label class="form-label" for="form6Example2">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password"  placeholder="Confirm Password" maxlength="30" minlength="6"  data-parsley-required="true" class="form-control" />
                                 
                                 </div>
                              </div>
                           </div><br>
                           <div class="row mb-6">
                              <div class="col">
                                 <div class="form-outline">
                                    <label class="form-label" for="form6Example6">Mobile</label>
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" data-parsley-required="true" maxlength="10" minlength="10" />
                                 </div>
                              </div> 
                              <div class="col">  
                                 <div class="form-outline">
                                    <label class="form-label" for="form6Example6">Social media url</label>
                                    <input type="text" name="social_media" id="social_media" class="form-control" placeholder="Social media url" data-parsley-required="true"/>
                                 </div>
                              </div>   
                           </div><br>   
                           <div class="form-outline mb-4">
                              <label class="form-label" for="form6Example6">Website</label>
                              <input type="text" name="website" id="website" class="form-control" placeholder="Website" data-parsley-required="true"/>
                           </div>
                           <div class="form-outline mb-4">
                              <label class="form-label" for="form6Example6">Description</label>
                              <textarea class="form-control" type="text" name="description" id="description" rows="4" placeholder="Description"></textarea>
                           </div>
                           <!-- Submit button -->
                           <button type="submit" class="btn btn-primary btn-block mb-4">Sign Up</button>
                     </form>
                     </div>
                  </div>
            </div>
         </div>
         <!--End Main Content-->
      </div>
      <!--End Container-->
</div>
    <?php include 'common/footer.php';?>
    <?php include 'common/footer-js.php';?>
    </body>    
</html>      