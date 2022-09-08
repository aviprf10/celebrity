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
    <title>Change Password | <?php echo $company_title;?></title>
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
                    <h1 class="collection-hero__title">Change Password</h1>
                    <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="<?php echo $base_url; ?>" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Change Password</span></div>
                </div>
            </div>
        </div>
        <div class="container pt-2">
            <div class="row mb-4 mb-lg-5 pb-lg-5">
                <?php include'common/account-sidebar.php';?>
                <div class="col-xl-9 col-lg-10 col-md-12">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard-content">
                        <div class="product-order">
                           <h2>Change Password</h2>
                           <br/>
                           <div class="row m-t-30">
                              <form id="password_form" method="post" class="form-horizontal" data-parsley-validate>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label class="form-label" for="form6Example1">Old Password</label>
                                          <input class="form-control" type="password" name="old_password" id="old_password" value="" placeholder="Old Password"  minlength="6"  maxlength="35" data-parsley-required="true"/>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label class="form-label" for="form6Example2">New Password</label>
                                          <input class="form-control"type="password" name="new_password" id="new_password" value="" placeholder="New Password"  minlength="6"  maxlength="35" data-parsley-required="true"/>   
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label class="form-label" for="form6Example5">Repeat Password <span class="required">*</span></label>
                                          <input type="password" class="form-control"  name="repeat_password" id="repeat_password" value="" placeholder="Repeat Password" class="form-control"  minlength="6"  maxlength="35" data-parsley-required="true"/>
                                       </div>
                                    </div>   
                                 </div> 
                                 <div class="row">
                                    <div class="col-md-6">  
                                       <div class="form-group">
                                          <button type="submit" class="btn btn-primary btn-block" style="width: 25%; float: left; margin-right: 16px;"> <a style="color:#fff;" href="<?php echo $base_url;?>account-dashboard" type="button">Back</a></button>
                                          <button type="submit" class="btn btn-primary btn-block" style="width: 25%;">Continue</button>
                                       </div>
                                    </div>
                                 </div>   
                           </form>
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
   echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$base_url.'login">';
}
?>    