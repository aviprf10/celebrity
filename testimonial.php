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
<body>
   <?php include "common/header.php";?>
   <section class="page-title" style="background-image: url(assets/images/background/11.jpg)">
        <div class="auto-container">
            <h1>Testimonials</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index-2.html">Home</a></li>
                <li>Testimonials</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title -->

    <section class="testimonial-page-section">
        <div class="auto-container">
            <!-- Title Box -->
            <div class="title-box">
                <h2>What Our Clients Says</h2>
                <div class="text">Collaboratively administrate empowered markets via plug-and-play networks.
                    Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize
                    customer directed</div>
            </div>

            <div class="row clearfix">

                <?php 
                   if(count($testimonial_data_array) > 0)
                   {
                       foreach($testimonial_data_array as $testimonial_data){ 
                ?>
                
                <div class="testimonial-block-three col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                        <div class="content">
                            <div class="image">
                                <img src="<?php echo $base_url_uploads ?>testimonial-images/temp_file/<?php echo $testimonial_data['images'] ?>" alt="" />
                            </div>
                            <h3><?php echo $testimonial_data['name'] ?></h3>
                            <div class="title"><?php echo $testimonial_data['degination'] ?></div>
                            <div class="text"><?php echo $testimonial_data['description'] ?></div>
                        </div>
                    </div>
                </div>
                <?php } }else{?>
                <p>No data found!</p>
                <?php } ?>
            </div>

        </div>
    </section>
    <?php include 'common/footer.php';?>
    <?php include 'common/footer-js.php';?>

 </body>    
</html>