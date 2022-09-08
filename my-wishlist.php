<?php
include "common/config.php";    
include "common/check_login.php";
if($user == 1)
{
   if(isset($_GET["page"]))
   {
      $page = (int)$_GET["page"];
   }
   else
   {
      $page = 1;
   }
   $setLimit = 10;
   $pageLimit = ($page * $setLimit) - $setLimit;
   include 'common/common_code.php';
   include 'common/pagination.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>My Wishlist | <?php echo $company_title;?></title>
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
                    <h1 class="collection-hero__title">My Wishlist</h1>
                    <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="<?php echo $base_url; ?>" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">My Wishlist</span></div>
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
                           <h2>My Wishlist</h2>
                           <br/>
                           <div class="row m-t-30">
                           <?php
                           if(count($wishlist_data_array)>0)
                           {
                           ?>
                           <div class="cart wow bounceInUp ">
                              <div class="table-responsive" id="wishlist_table">
                                 <table border="1" width="100%" id="shopping-cart-table" style="margin-top: 0px;">
                                    <thead>
                                       <tr>
                                          <th style="text-align: center; padding:10px;">Image</th>
                                          <th style="text-align: center; padding:10px;">
                                             <span class="nobr">Product Name</span>
                                          </th>
                                          <th style="text-align: center; padding:10px;">
                                             Price Detail
                                          </th>
                                          <th style="text-align: center; padding:10px;">
                                             Action
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach($wishlist_data_array as $wishlist_data) { 

                                             $celebrity_id = $wishlist_data['celebrity_id'];
                                             $user_data_array = array();
                                             $get_user_query = "select * from user where status='1' and is_deleted='0' and id='$celebrity_id'";
                                             $result_user_data = mysqli_query($db_mysqli,$get_user_query);
                                             while ($row_user_data = mysqli_fetch_assoc($result_user_data))
                                             {
                                                $user_data_array[] = $row_user_data;
                                             } 

                                             $user_name = $user_data_array[0]['user_name'];
                                             $user_unique_slug = $user_data_array[0]['user_unique_slug'];
                                             $celebrity_images = $user_data_array[0]['profile_pic'];

                                             $celebritydetails_data_array = array();
                                             $get_celebritydetails_query = "select * from celebrity_details where status='1' and is_deleted='0' and celebrity_id='$celebrity_id'";
                                             $result_celebritydetails_data = mysqli_query($db_mysqli,$get_celebritydetails_query);
                                             while ($row_celebritydetails_data = mysqli_fetch_assoc($result_celebritydetails_data))
                                             {
                                                $celebritydetails_data_array[] = $row_celebritydetails_data;
                                             } 

                                             $image_celebrityprice_data_array = array();
                                             $image_get_celebrityprice_query = "select * from celebrity_price where celebrity_id='$celebrity_id'";
                                             $image_result_get_celebrityprice_query = mysqli_query($db_mysqli, $image_get_celebrityprice_query);
                                             while ($image_row_get_celebrityprice_query = mysqli_fetch_assoc($image_result_get_celebrityprice_query))
                                             {
                                                $image_celebrityprice_data_array[] = $image_row_get_celebrityprice_query;
                                             } 

                                            
                                          ?>
                                       <tr id="row_<?php echo $wishlist_data['celebrity_id']; ?>">
                                          <td style="text-align: center; padding:10px;">
                                          <a href="<?php echo $base_url;?>celebrity-details/<?php echo $user_unique_slug; ?>">
                                             <img width="75" height="75" src="<?php echo $cele_base_path_uploads."profile-pic/temp_file/".$celebrity_images; ?>" alt="<?php echo $user_name;?>" title="<?php echo $user_name;?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image"/>
                                          </a>
                                          </td>
                                          <td style="text-align: center; padding:10px;">
                                             <a href="<?php echo $base_url;?>product-details/<?php echo $wishlist_data['product_unique_slug']; ?>"  alt="<?php echo $user_name;?>" title="<?php echo $user_name;?>"><?php echo $user_name;?></a>
                                                                     
                                          </td>
                                          <td style="text-align: center; padding:10px;">
                                             <ins>Price: <span class="woocommerce-Price-amount amount"><?php echo $selected_currency_icon;?> <?php echo $image_celebrityprice_data_array[0]['price']; ?></span></ins>                            
                                          </td>
                                          <td style="text-align: center; padding:10px;">
                                          
                                             <div class="m-b-5">
                                                <a onclick="add_to_cart('<?php echo $wishlist_data['celebrity_id']; ?>')" title="Add To Cart"  id="edit-item" class="button edit-item"><i class="icon an an-cart-l"></i></a>
                                                <a onclick="add_to_wishlist('<?php echo $wishlist_data['celebrity_id']; ?>')"  class="button remove-item" title="Remove this item"><i class="icon an an-times-r" aria-hidden="true"></i></a>
                                             </div>
                                          </td>
                                       </tr>
                                       <?php } ?>
                                    </tbody>
                                 </table>
                                 <div class="row pagination-results">
                                 <div class="text-right">
                                    <div class="pagination-container">
                                       <?php 
                                       // $filter_array = array();   
                                       // $filter_array['loggedin_user_id'] = $loggedin_user_id;   
                                       // echo displayPaginationBelow($db_mysqli,$setLimit,$page,$page_title='wishlist',$filter_array); 
                                       ?>
                                    </div>
                                 </div>
                              </div>
                              </div>
                           </div>
                              <?php
                              }
                              else{
                                 ?>
                                 <br>
                                 <center>
                                 <h6><i class="fa fa-thumbs-down" title="No Data found" style="font-size:26px"></i></h6>
                                 <h4>No Data Found!</h4>
                                 </center>
                                 <br> 
                                 
                           <?php
                              }
                              ?>
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
   echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$base_url.'registration">';
}
?>     