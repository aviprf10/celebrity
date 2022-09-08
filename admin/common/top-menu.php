
<!-- Second navbar -->
<div class="navbar navbar-default" id="navbar-second">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav">
            <li><a href="<?php echo $base_url; ?>index"><i class="icon-home position-left"></i> Dashboard</a></li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                    <i class="icon-pie5 position-left"></i> Master Module <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                    <li><a href="<?php echo $base_url; ?>settings"><i class="icon-play4"></i>Company Info</a></li>
                    <li><a href="<?php echo $base_url; ?>view-country"><i class="icon-play4"></i>Country Master</a></li>
                    <li><a href="<?php echo $base_url; ?>view-state"><i class="icon-play4"></i>State Master</a></li>
                    <li><a href="<?php echo $base_url; ?>view-city"><i class="icon-play4"></i>City Master</a></li>
                    <li><a href="<?php echo $base_url; ?>view-occasion"><i class="icon-play4"></i>Occasion Master</a></li>
                    <li><a href="<?php echo $base_url; ?>view-services"><i class="icon-play4"></i>Services Master</a></li>
                    <li><a href="<?php echo $base_url; ?>view-services-request"><i class="icon-play4"></i>Request Services Master</a></li>
                    <li><a href="<?php echo $base_url; ?>view-profile-messages"><i class="icon-play4"></i>Celebrity Messages</a></li>
                    <li><a href="<?php echo $base_url; ?>view-spoken-language"><i class="icon-play4"></i>Spoken Language Master</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                    <i class="icon-pie5 position-left"></i>Category Master<span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                    <li><a href="<?php echo $base_url; ?>view-category"><i class="icon-play4"></i> Category</a></li>
                    <li><a href="<?php echo $base_url; ?>view-sub-category"><i class="icon-play4"></i> Sub Category</a></li>
                    <li><a href="<?php echo $base_url; ?>view-gift-category"><i class="icon-play4"></i> Gift Category</a></li>
                    <li><a href="<?php echo $base_url; ?>view-gift-sub-category"><i class="icon-play4"></i> Gift Sub Category</a></li>
                    <li><a href="<?php echo $base_url; ?>view-gift-sub-sub-category"><i class="icon-play4"></i> Gift Sub Sub Category</a></li>
                    <!-- <li><a href="<?php echo $base_url; ?>view-sub-sub-category"><i class="icon-play4"></i> Sub Sub Category</a></li> -->
                    <!-- <li><a href="<?php echo $base_url; ?>view-product"><i class="icon-play4"></i>Product</a></li>
                     <li><a href="<?php echo $base_url; ?>view-product-images"><i class="icon-play4"></i>Product Images</a></li> -->
                   
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                    <i class="icon-cogs position-left"></i> Manage Pages <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-200">
                   <li><a href="<?php echo $base_url; ?>cms-page"><i class="icon-play4"></i>CMS Page</a></li>
                   <li><a href="<?php echo $base_url; ?>view-home-banner"><i class="icon-play4"></i>Home Banner</a></li>
                   <li><a href="<?php echo $base_url; ?>view-offer-banner"><i class="icon-play4"></i>Offer Banner</a></li>
                   <li><a href="<?php echo $base_url; ?>view-category-section"><i class="icon-play4"></i>Category Wise Section<br> Home Page</a></li>
                   <!-- <li><a href="<?php echo $base_url; ?>view-client-portfolio"><i class="icon-play4"></i>Client Portfolio</a></li> -->
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
            <li class="dropdown">
                <a href="<?php echo $base_url; ?>view-user" >
                    <i class="icon-users position-left"></i> Users Master
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                    <i class="icon-cogs position-left"></i> Celebrity Master <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-200">
                    <li class="dropdown"> <a href="<?php echo $base_url; ?>view-celebrity">
                            <i class="icon-users position-left"></i> Celebrity Master
                        </a>
                    </li>
                    <li class="dropdown"> <a href="<?php echo $base_url; ?>view-celebrity-price">
                            <i class="icon-users position-left"></i> Celebrity Price Master
                        </a>
                    </li>
                    <li class="dropdown"> <a href="<?php echo $base_url; ?>view-video-history" >
                            <i class="icon-users position-left"></i> Celebrity Video History
                        </a>
                    </li>
                 </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                    <i class="icon-cogs position-left"></i> Brand Master <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-200">
                    <li class="dropdown"> <a href="<?php echo $base_url; ?>view-brand" >
                            <i class="icon-users position-left"></i> Brand Master
                        </a>
                    </li>
                    <li class="dropdown"> <a href="<?php echo $base_url; ?>view-brand-post" >
                            <i class="icon-users position-left"></i> Brand Post
                        </a>
                    </li>
                    <li><a href="<?php echo $base_url; ?>view-brand-request"> <i class="icon-users position-left"></i>  Brand Request</a></li>
                 </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                    <i class="icon-cogs position-left"></i> Payment Master <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-200">
                    <li class="dropdown"> <a href="<?php echo $base_url; ?>view-payment" >
                            <i class="icon-users position-left"></i> Payment History
                        </a>
                    </li>
                    <li class="dropdown"> <a href="<?php echo $base_url; ?>view-brand-payment" >
                            <i class="icon-users position-left"></i>Brand Payment History
                        </a>
                    </li>
                 </ul>
            </li>
            
        </ul>
    </div>
</div>
<!-- /second navbar -->