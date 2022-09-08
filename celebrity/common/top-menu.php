
<!-- Second navbar -->
<div class="navbar navbar-default" id="navbar-second">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav">
            <li><a href="<?php echo $base_url; ?>index"><i class="icon-home position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo $base_url; ?>profile-details">Profile Details</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                    <i class="icon-pie5 position-left"></i> Profile Module <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                    <li><a href="<?php echo $base_url; ?>view-profile-images"><i class="icon-play4"></i>Profile Images/Video</a></li>
                    <li><a href="<?php echo $base_url; ?>view-social-media"><i class="icon-play4"></i>Social Media Master</a></li>
                    <li><a href="<?php echo $base_url; ?>view-celebrity-price"><i class="icon-users position-left"></i> Celebrity Price Master</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                    <i class="icon-cogs position-left"></i> Manage Orders <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-200">
                    <li><a href="<?php echo $base_url; ?>new-orders"><i class="icon-play4"></i>New Orders</a></li>
                    <!-- <li><a href="<?php echo $base_url; ?>return-orders"><i class="icon-play4"></i>Returned Orders</a></li>-->
                    <li><a href="<?php echo $base_url; ?>cancelled-orders"><i class="icon-play4"></i>Rejected Orders</a></li>
                 </ul>
            </li>
            <li><a href="<?php echo $base_url; ?>view-services-request">Services Request</a></li>
            <li><a href="<?php echo $base_url; ?>view-brand-request">Brand Request</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                    <i class="icon-cogs position-left"></i> Payment Master <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-200">
                    <li class="dropdown"> <a href="<?php echo $base_url; ?>view-payment" >
                            <i class="icon-users position-left"></i> Payment History
                        </a>
                    </li>
                 </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /second navbar -->