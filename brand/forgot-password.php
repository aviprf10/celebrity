<?php
include 'common/config.php';
include "common/check_login.php";
include 'common/common_code.php';
if($brand == 1)
{
   echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$base_url.'account-dashboard">';
}
else
{
   ?>
<!DOCTYPE html>
<html lang="en-US" id="parallax_scrolling">
   <head>
      <title>Forgot Password | <?php echo $company_title;?></title>
      <?php include "common/header-css.php";?>
   </head>
   <body class="page-template-default page page-id-8 cms-index-index cms-home-page woocommerce-account woocommerce-page woocommerce-lost-password cms-index-index inner-page" >
       <div id="loading">
         <center><img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading..."/></center>
      </div>
      <div id="main_site_div" style="display:none;">
         <div id="page" class="page catalog-category-view">
            <?php include "common/header.php";?>
            <div class="page-heading ">
               <div class="breadcrumbs">
               </div>
               <div class="page-title">
                  <h1 class="entry-title">
                     Forgot Password      
                  </h1>
               </div>
            </div>
            <div class="main-container col1-layout wow bounceInUp">
               <div class="container">
                  <div class="row">
                     <div class="col-sm-6 col-sm-offset-3" id="content">
                        <div class="page-content">
                           <div class="woocommerce">
                               <h2>Forgot Password</h2>
                             <form method="POST" id="forgot_password_form" data-parsley-validate  class="form-horizontal">
                                 <p>Lost your password? Please enter your email address. You will receive a link to create a new password via email.</p>
                                 <p class="woocommerce-form-row woocommerce-form-row--first form-row">
                                    <label for="user_login">Email id : <span class="required">*</span></label>
                                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="forgot_password_id" id="forgot_password_id" placeholder="Email id" data-parsley-required="true" />
                                 </p>
                                 <div class="clear"></div>
                                 <p class="woocommerce-form-row form-row">
                                    <button type="submit" class="btn btn-theme" value="Reset password">Forgot password</button>
                                    <a href="<?php echo $base_url;?>login" style="float: right;line-height: 34px;"><u>Back To Login</u> <i class="fa fa-angle-double-right"></i></a>
                                 </p>
                              </form>
                           </div>
                        </div>
                        <!-- .entry-content -->
                     </div>
                  </div>
               </div>
            </div>
            <?php include "common/footer.php";?>
         </div>
      </div>
         <?php include "common/common-mobile-menu.php";?>
      <?php include'common/footer-js.php';?>    
   </body>
</html>
  <?php 
} 
?>