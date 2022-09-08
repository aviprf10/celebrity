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
    <section class="contact-page-title" style="background-image: url(assets/images/background/17.jpg)">
        <div class="auto-container">
            <h1>We are available <br> in your city with tasty food</h1>
        </div>
    </section>
    <!-- End Contact Page Title -->

    <!-- Contact Page Section -->
    <section class="contact-page-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Form Column -->
                <div class="form-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="title-box">
                            <h3>We Love To Hear From You</h3>
                            <div class="text">If it's not too much trouble informed us regarding whether you have an
                                inquiry, need to leave a remark, or might want additional data about Advotis</div>
                        </div>

                        <!-- Contact Form -->
                        <div class="contact-form">
                            <form method="post" action="#">
                                <div class="row clearfix">

                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                        <input type="text" name="username" value="" placeholder="Name" require>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                        <input type="email" name="email" value="" placeholder="Email" require>
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <input type="text" name="subject" value="" placeholder="Subject" require>
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <textarea name="message" placeholder="Message"></textarea>
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <button type="submit" class="theme-btn btn-style-five"><span
                                                class="txt">Submit</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <!-- Info Column -->
                <div class="info-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <h3>Our Office Address</h3>
                        <ul>
                            <li><strong>Main Restaurant:</strong><?php echo $company_info_data_array[0]['company_address']; ?>, <?php echo $company_info_data_array[0]['city']; ?>, <?php echo $company_info_data_array[0]['state']; ?>-<?php echo $company_info_data_array[0]['pincode']; ?>,
                            <?php echo $company_info_data_array[0]['country']; ?></li>
                            <li><strong>Have any querry:</strong>Call us on : <?php echo $company_info_data_array[0]['company_mobile']; ?>,<?php echo $company_info_data_array[0]['company_mobile2']; ?><br>Mail us on : <?php echo $company_info_data_array[0]['company_email']; ?></li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!--End Faq Section-->

    <!-- Map Section -->
    <section class="map-section">
        <!-- Map Boxed -->
        <div class="map-boxed">
            <!--Map Outer-->
            <div class="map-outer">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241316.6433243529!2d72.74109841464792!3d19.082522322829526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c6306644edc1%3A0x5da4ed8f8d648c69!2sMumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1652291565442!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    <?php include 'common/footer.php';?>
    <?php include 'common/footer-js.php';?>

 </body>    
</html>