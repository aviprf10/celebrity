<!-- Main navbar -->
<?php
//if ($admin == 1 || $user == 1)
//    include '../common/check_login.php';
?>
<?php if ($page_layout == 1)
{ ?>
    <style>
        .navbar {
            margin-bottom: 0 !important;
            border-width: 0 !important;;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24) !important;
            z-index: initial !important;
        }
    </style>
<?php } ?>

<div class="navbar navbar-inverse bg-<?php echo $theme_color; ?>">
    <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo $base_url; ?>index" style="font-size:20px">
            <i class="icon-office"></i>

            <span style="font-size: 16px;margin-left: 15px"><?php echo $company_title; ?></span>
        </a>


        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <?php if ($page_layout == 2)
            { ?>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            <?php } ?>
        </ul>

    </div>

    <?php
    if ($user == 1 || $admin == 1)
    {
        ?>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <?php if ($page_layout == 2)
            { ?>

            <?php } ?>

            <div class="navbar-right">
                <ul class="nav navbar-nav">

                    <li class="dropdown dropdown-user">
                        <a class="dropdown-toggle" data-toggle="dropdown">

                            <img src="<?php echo $loggedin_user_profile_pic_100; ?>" alt="">
                            <span><?php echo $loggedin_user_first_name . " " . $loggedin_user_last_name ?></span>
                            <i class="caret"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="<?php echo $base_url; ?>account-settings"><i class="icon-cog5"></i> Account settings</a></li>
                            <li><a href="<?php echo $base_url; ?>logout.php"><i class="icon-switch2"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    <?php } ?>

</div>
<!-- /main navbar -->
			
