<?php
include "common/config.php";    
include "common/check_login.php";
include "common/common_code.php";
if($brand == 1)
{
    
    $edit_data_array = array();
    $get_brandpost_query = "select * from brand_post where is_deleted='0' and  added_by='$loggedin_user_id'";
    $result_get_brandpost_query = mysqli_query($db_mysqli, $get_brandpost_query);
    while ($row_get_brandpost_query = mysqli_fetch_assoc($result_get_brandpost_query))
    {
        $edit_data_array[] = $row_get_brandpost_query;
    }

    $brandinquiry_data_array = array();
    $get_brandinquiry_query = "select * from brand_inquery_response b left join brand_post bp on b.brand_id=bp.id where bp.is_deleted='0' and  bp.added_by='$loggedin_user_id'";
    $result_get_brandinquiry_query = mysqli_query($db_mysqli, $get_brandinquiry_query);
    while ($row_get_brandinquiry_query = mysqli_fetch_assoc($result_get_brandinquiry_query))
    {
        $brandinquiry_data_array[] = $row_get_brandinquiry_query;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Account Dashboard | <?php echo $company_title;?></title>
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
                    <h1 class="collection-hero__title">Account Dashboard</h1>
                    <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="<?php echo $base_url; ?>" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Account Dashboard</span></div>
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
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card card-body bg-blue-400 has-bg-image" style="padding:30px; border-color: #e1dddd; border-radius: 5px;">
                                        <div class="media" style="display: flex; align-items: flex-start;">
                                            <div class="media-body" style="margin-top: -29px;"><br>
                                                <h3 class="mb-0"><?php echo count($edit_data_array); ?></h3>
                                                <span class="text-uppercase font-size-xs">total brand post</span>
                                            </div>
                                            <div class="ml-3 align-self-center">
                                                <i class="icon-users4 icon-3x opacity-75" style="opacity: .75;"></i>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-body bg-blue-400 has-bg-image" style="padding:30px; border-color: #e1dddd; border-radius: 5px;">
                                        <div class="media" style="display: flex; align-items: flex-start;">
                                            <div class="media-body" style="margin-top: -29px;"><br>
                                                <h3 class="mb-0"><?php echo count($brandinquiry_data_array); ?></h3>
                                                <span class="text-uppercase font-size-xs">total brand inquiry</span>
                                            </div>
                                            <div class="ml-3 align-self-center">
                                                <i class="icon-users4 icon-3x opacity-75" style="opacity: .75;"></i>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div><br>
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