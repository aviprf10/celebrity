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
    <title><?php echo $page_meta_title;?></title>
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
<body  class="about-page about-pstyle3">
    <?php include "common/header.php";?>
    <div id="page-content">
        <!--Collection Banner-->
        <div class="collection-header">
            <div class="collection-hero">
                <div class="collection-hero__image"></div>
                <div class="collection-hero__title-wrapper container">
                    <h1 class="collection-hero__title"><?php echo $page_title;?></h1>
                    <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="<?php $base_url; ?>" title="Back to the home page">Home</a><span>|</span><span class="fw-bold"><?php echo $page_title;?></span></div>
                </div>
            </div>
        </div>
        <!--End Collection Banner-->

        <!--Main Content-->
        <div class="container">
           <div class="row section">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-12 mb-md-0">
                    <h3><?php echo $page_title;?></h3>
                    <?php
                        if(count($page_data_array)>0)
                        {
                            echo html_entity_decode($page_content);
                        }
                        else
                        {
                            ?>
                            <center><h3>Not Available</h3></center>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <!-- End Content Info -->
        </div>
    </div>
    
    <?php include 'common/footer.php';?>
    <?php include 'common/footer-js.php';?>
                  
 </body>    
</html>