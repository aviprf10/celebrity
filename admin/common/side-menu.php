<!-- Main sidebar -->
<?php
//include "common/check_login.php";
?>
<div class="sidebar sidebar-main sidebar-default">
    <div class="sidebar-content">
        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav" style="float: none">
                <li style="float: none">
                    <a class="sidebar-control sidebar-main-toggle hidden-xs text-<?php echo $theme_color; ?>" id="sidemenu_toggle_id" style="padding: 10px 20px">
                        <center>
                            <i class="icon-paragraph-justify3"></i>
                        </center>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">

                <ul class="navigation navigation-main navigation-accordion" style="padding:0">

                    <!-- Main -->

                    <li><a href="<?php echo $base_url; ?>"><i class="icon-home text-<?php echo $theme_color; ?>"></i> <span>Dashboard</span></a></li>
                    <li>
                        <a href="#"><i class="icon-pie5 text-<?php echo $theme_color; ?>"></i> <span>Master Module</span></a>
                        <ul>
                            <li><a href="<?php echo $base_url; ?>view-category"><i class="icon-play4"></i>Category</a></li>
                            <li><a href="<?php echo $base_url; ?>view-country"><i class="icon-play4"></i>Country</a></li>
                            <li><a href="<?php echo $base_url; ?>view-state"><i class="icon-play4"></i>State</a></li>
                            <li><a href="<?php echo $base_url; ?>view-city"><i class="icon-play4"></i>City</a></li>
                            <li><a href="<?php echo $base_url; ?>view-newsletter-subscription"><i class="icon-play4"></i> Newsletter subscription</a></li>
                            <li><a href="<?php echo $base_url; ?>view-brand-master"><i class="icon-play4"></i> Brand</a></li>
                            <li><a href="<?php echo $base_url; ?>view-sales"><i class="icon-play4"></i> Sales</a></li>
                            <li><a href="<?php echo $base_url; ?>view-logistics"><i class="icon-play4"></i> Logistics</a></li>
                            <li><a href="<?php echo $base_url; ?>settings"><i class="icon-play4"></i> <span>Company Info</span></a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-box text-<?php echo $theme_color; ?>"></i> <span>Product</span></a>
                        <ul>
                            <li><a href="<?php echo $base_url; ?>view-top-product/0"><i class="icon-play4"></i>Listings</a></li>
                            <li><a href="<?php echo $base_url; ?>add-bulk-images"><i class="icon-play4"></i>Bulk Images</a></li>
                            <li><a href="<?php echo $base_url; ?>view-top-product/1"><i class="icon-play4"></i>Top Viewed Product</a></li>
                            <li><a href="<?php echo $base_url; ?>view-top-product/2"><i class="icon-play4"></i>Top Reviewed Product</a></li>
                            <li><a href="<?php echo $base_url; ?>view-top-product/3"><i class="icon-play4"></i>Top Ordered Product</a></li>
                            <li><a href="<?php echo $base_url; ?>view-top-product/4"><i class="icon-play4"></i>Top Rejected Product</a></li>
                            <li><a href="<?php echo $base_url; ?>view-top-product/5"><i class="icon-play4"></i>Top Cancelled Product</a></li>
                            <li><a href="<?php echo $base_url; ?>view-top-product/6"><i class="icon-play4"></i>Top Returned Product</a></li>
                            <li><a href="<?php echo $base_url; ?>view-top-product/7"><i class="icon-play4"></i>Top Wishlisted Product</a></li>
                            <li><a href="<?php echo $base_url; ?>view-top-product/8"><i class="icon-play4"></i>Top Abandoned Product</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-menu6 text-<?php echo $theme_color; ?>"></i> <span>Product Reports</span></a>
                        <ul>
                            <li><a href="<?php echo $base_url; ?>view-product-reports/1"><i class="icon-play4"></i>Product Viewed</a></li>
                            <li><a href="<?php echo $base_url; ?>view-product-reports/2"><i class="icon-play4"></i>Product Reviewed</a></li>
                            <li><a href="<?php echo $base_url; ?>view-product-reports/3"><i class="icon-play4"></i>Product Ordered</a></li>
                            <li><a href="<?php echo $base_url; ?>view-product-reports/4"><i class="icon-play4"></i>Product Rejected</a></li>
                            <li><a href="<?php echo $base_url; ?>view-product-reports/5"><i class="icon-play4"></i>Product Cancelled</a></li>
                            <li><a href="<?php echo $base_url; ?>view-product-reports/6"><i class="icon-play4"></i>Product Returned</a></li>
                            <li><a href="<?php echo $base_url; ?>view-product-reports/7"><i class="icon-play4"></i>Product Wishlisted</a></li>
                            <li><a href="<?php echo $base_url; ?>view-product-reports/8"><i class="icon-play4"></i>Product Abandoned</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-cube3 text-<?php echo $theme_color; ?>"></i> <span>Variant Master</span></a>
                        <ul>
                            <li><a href="<?php echo $base_url; ?>view-variant-master"><i class="icon-play4"></i>Variant</a></li>
                            <li><a href="<?php echo $base_url; ?>view-variant-data-master"><i class="icon-play4"></i> Variant Data</a></li>
                            <li><a href="<?php echo $base_url; ?>view-category-wise-variant-master"><i class="icon-play4"></i> Category wise Variant</a></li>
                            <li><a href="<?php echo $base_url; ?>view-specification-master"><i class="icon-play4"></i>Specification</a></li>
                            <li><a href="<?php echo $base_url; ?>category-wise-specification-master"><i class="icon-play4"></i>Category wise Specification</a></li>
                        </ul>
                    </li>


                    <li>
                        <a href="#"><i class="icon-cart4 text-<?php echo $theme_color; ?>"></i> <span> User Order</span></a>
                        <ul>
                            <li><a href="<?php echo $base_url; ?>new-orders"><i class="icon-play4"></i>New Orders</a></li>
                            <li><a href="<?php echo $base_url; ?>track-orders"><i class="icon-play4"></i>Track Orders</a></li>
                            <li><a href="<?php echo $base_url; ?>return-orders"><i class="icon-play4"></i>Returned Orders</a></li>
                            <li><a href="<?php echo $base_url; ?>cancelled-orders"><i class="icon-play4"></i>Cancelled Orders</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?php echo $base_url; ?>view-user/2"><i class="icon-users text-<?php echo $theme_color; ?>"></i> <span>Users</span></a>
                    </li>

                    <li>
                        <a href="#"><i class="icon-magic-wand2 text-<?php echo $theme_color; ?>"></i> <span>Offers</span></a>
                        <ul>
                            <li><a href="<?php echo $base_url; ?>cms-page"><i class="icon-play4"></i> CMS Page</a></li>
                            <li><a href="<?php echo $base_url; ?>view-coupon"><i class="icon-play4"></i> Coupons</a></li>
                        </ul>
                    </li>


                    <li>
                        <a href="#"><i class="icon-cogs text-<?php echo $theme_color; ?>"></i> <span>Manage Homepage</span></a>
                        <ul>
                            <li><a href="<?php echo $base_url; ?>view-home-big-slider"><i class="icon-play4"></i> Home big slider</a></li>
                            <li><a href="<?php echo $base_url; ?>home-offer-products"><i class="icon-play4"></i> Home offer products</a></li>
                            <li><a href="<?php echo $base_url; ?>home-offer-banner"><i class="icon-play4"></i> Home offer banner</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->

<script type="text/javascript">
    $("#sidemenu_toggle_id").on("click", function ()
    {
        $.ajax({
            url: "<?php echo $base_url;?>set-side-menu-state.php",
            type: "POST",
            dataType: 'json',
            encode: true,
            beforeSend: function ()
            {
//                $.blockUI({message: '<img id="loading-image" src="<?php //echo $base_url_images;?>//loading.gif" />'});
            },
            success: function (data)
            {

            }
        });
    });
</script>