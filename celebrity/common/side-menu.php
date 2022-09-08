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
                        <a href="#"><i class="icon-pie5 text-<?php echo $theme_color; ?>"></i> <span>Profile Module</span></a>
                        <ul>
                            <li><a href="<?php echo $base_url; ?>profile-details"><i class="icon-play4"></i>Profile Details</a></li>
                            <li><a href="<?php echo $base_url; ?>view-profile-images"><i class="icon-play4"></i>Profile Images/Video</a></li>
                            <li><a href="<?php echo $base_url; ?>view-profile-messages"><i class="icon-play4"></i>Profile Messages</a></li>
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