<!-- <div id="pre-loader"><img src="<?php echo $base_url_images; ?>loader.gif" alt="Loading..." /></div> -->
    <!-- End Page Loader -->

    <!--Page Wrapper-->
    <div class="page-wrapper">
        <!-- <div class="top-info-bar">
            <div class="container">
                <div class="row">
                    <div class="item fw-600 d-flex flex-row justify-content-lg-start justify-content-center justify-content-md-center justify-content-sm-center col-12 col-sm-12 col-md-12 col-lg-4">
                        Store Time : 10AM – 11PM. Sunday Closed
                    </div>
                    <div class="item fw-600 d-flex flex-row justify-content-center justify-content-md-center justify-content-sm-center col-12 col-sm-6 col-md-4 col-lg-4 center d-none d-lg-flex">
                        Free Shipping World Wide
                    </div>
                    <div class="item fw-600 d-flex flex-row justify-content-lg-end justify-content-center justify-content-md-center justify-content-sm-center col-12 col-sm-6 col-md-4 col-lg-4 d-none d-lg-flex">
                        <ul class="toplinks list-inline m-0"><li class="list-inline-item"><a href="faqs-style1.html">Help &amp; Faqs</a></li><li class="list-inline-item"><a href="contact-style1.html">Contact Us</a></li></ul>
                    </div>
                </div>
            </div>
        </div> -->
        <!--End Topbar-->

        <!--Header-->
        <header id="header" class="header header-main mih-70 d-flex align-items-center header-5">
            <div class="container">        
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-2 align-self-center justify-content-start d-flex">
                        <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open me-3 d-lg-none"><i class="icon an an-times-l"></i><i class="icon an an-bars-l"></i></button>
                        <div class="logo"><a href="<?php echo $base_url; ?>"><img class="logo-img" src="<?php echo $base_url_images; ?>logo-demo-4.svg" alt="Optimal" title="Optimal" /><span class="logo-txt d-none">Optimal</span></a></div>
                    </div>
                    <div class="col-1 col-sm-1 col-md-1 col-lg-7 align-self-center d-menu-col">
                        <nav class="grid__item" id="AccessibleNav">
                            <ul id="siteNav" class="site-nav medium center hidearrow">
                                <li class="lvl1 parent dropdown"><a href="#">Categories <i class="an an-angle-down-l"></i></a>
                                    <ul class="dropdown">
                                    <?php 
                                        if(count($category_data_array) > 0){
                                            foreach($category_data_array as $category_data){
                                                $cat_id = $category_data['id'];
                                                $subcategory_data_array = array();
                                                $get_subcategory_query = 'SELECT * FROM `sub_category` where  CONCAT(",", category_id, ",") REGEXP ",('.$cat_id.')," or CONCAT(",", id, ",") REGEXP ",('.$subcateg_id.')," and is_deleted=0';
                                                $result_get_subcategory_query = mysqli_query($db_mysqli, $get_subcategory_query);
                                                while ($row_get_subcategory_query = mysqli_fetch_assoc($result_get_subcategory_query))
                                                {
                                                    $subcategory_data_array[] = $row_get_subcategory_query;
                                                }

                                               
                                        ?>
                                        <li><a href="<?php echo $base_url;?>celebrity-list/<?php echo $category_data['category_unique_slug']; ?>" class="site-nav"><?php echo $category_data['category_name']; ?> <?php if(count($subcategory_data_array) > 0){ ?><i class="an an-angle-right-l"></i><?php } ?></a>
                                            <ul class="dropdown">
                                            <?php 
                                                if(count($subcategory_data_array) > 0)
                                                {
                                                    foreach($subcategory_data_array as $subcategory_data){
                                                ?>
                                                <li><a href="<?php echo $base_url;?>celebrity-list/<?php echo $subcategory_data['sub_category_unique_slug']; ?>" class="site-nav"><?php echo $subcategory_data['sub_category_name']; ?></a></li>
                                                <?php } } ?>
                                            </ul>
                                           
                                        </li>
                                        <?php } } ?>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="Nnav" href="#" data-bs-toggle="dropdown"> Gifting</a>
                                    <ul class="dropdown-menu" id="dd" >
                                    <?php 
                                        if(count($gift_cat_data_array) > 0){
                                            $i=1;
                                            foreach($gift_cat_data_array as $gift_cat_data){
                                                $giftcate_id = $gift_cat_data['id'];
                                                $gift_subcat_data_array = array();
                                                $get_gift_subcat_query = "select * from gift_subcat where giftcate_id='$giftcate_id' and is_deleted='0' order by id asc";
                                                $result_get_gift_subcat_query = mysqli_query($db_mysqli, $get_gift_subcat_query);
                                                while ($row_get_gift_subcat_query = mysqli_fetch_assoc($result_get_gift_subcat_query))
                                                {
                                                    $gift_subcat_data_array[] = $row_get_gift_subcat_query;
                                                }
                                        ?> 
                                        <li class="has-megasubmenu" id="dd" <?php if($i>1){ ?> style="border-top: 1px solid #eeeeee; position: relative;" <?php } ?>>
                                            <a class="dropdown-item" href="#"> <img src="<?php echo $base_path_uploads ?>gift-category-images/temp_file/<?php echo $gift_cat_data['gift_images']; ?>" style="max-width: 10% !important;  margin-right: 10px;"><?php echo $gift_cat_data['gift_name']; ?> <?php if(count($gift_subcat_data_array) > 0){ ?><i class="an an-angle-right-l" style="font-size: 18px; position: absolute; right: 5px; top: 8px;"></i><?php } ?></a>
                                            <?php if(count($gift_subcat_data_array) > 0){ ?>
                                            <div class="megasubmenu dropdown-menu" id="dd">
                                                <div class="row"  id="dd">
                                                    <?php 
                                                    if(count($gift_subcat_data_array) > 0){
                                                        foreach($gift_subcat_data_array as $gift_subcat_data){
                                                            $giftsubcate_id = $gift_subcat_data['id'];
                                                            $gift_subsubcat_data_array = array();
                                                            $get_gift_subsubcat_query = "select * from gift_subsubcate where giftsubcat_id='$giftsubcate_id' and is_deleted='0' order by id asc";
                                                            $result_get_gift_subsubcat_query = mysqli_query($db_mysqli, $get_gift_subsubcat_query);
                                                            while ($row_get_gift_subsubcat_query = mysqli_fetch_assoc($result_get_gift_subsubcat_query))
                                                            {
                                                                $gift_subsubcat_data_array[] = $row_get_gift_subsubcat_query;
                                                            } 
                                                    ?>
                                                    <div class="col-6" <?php if(count($gift_subcat_data_array) > 0){ ?> style="border-left: 1px solid #dadada;" <?php } ?>>
                                                            <h6 class="title" style="margin-bottom: 10px;"><img src="<?php echo $base_path_uploads ?>gift-sub-category-images/temp_file/<?php echo $gift_subcat_data['giftsubcate_images']; ?>" style="max-width: 10% !important;  margin-right: 10px;"><?php echo $gift_subcat_data['giftsubcate_name'] ?></h6>
                                                            <ul class="list-unstyled">
                                                                <?php 
                                                                    if(count($gift_subsubcat_data_array) > 0){
                                                                        foreach($gift_subsubcat_data_array as $gift_subsubcat_data){
                                                                ?>
                                                                <li><a href="<?php echo $base_url; ?>gifting/best-birthday-gift-for-<?php echo $gift_subsubcat_data['giftsubsubcate_slug']; ?>"><?php echo $gift_subsubcat_data['giftsubsubcate_name']; ?></a></li>
                                                                <?php }} ?>
                                                            </ul>
                                                    </div>
                                                    <?php }}?>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </li>
                                        <?php  $i++;} } ?> 
                                    </ul>
                                </li>
                                <li class="lvl1 parent dropdown"><a href="#">Support</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!--End Main Navigation Desktop-->
                    <!--Right Action-->
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 align-self-center icons-col text-right d-flex justify-content-end">
                        <!--Search-->
                        <?php 
                        if($user==1)
                        {
                        ?>
                        <div class="user-link iconset"><i class="icon an an-user-expand"></i></div>
                        <div id="userLinks">
                            <h4 style="margin-bottom: 0px;">Welcome:: <?php echo $loggedin_user_first_name; ?></h4>
                            <ul class="user-links">
                                <li><a href="<?php echo $base_url; ?>logout">Logout</a></li>
                            </ul>
                        </div>
                        <?php
                        }
                        else
                        {
                        ?>
                        <div class="user-link iconset quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview"><i class="icon an an-user-expand"></i></div>
                        <?php } ?>
                    </div>
                    <!--End Right Action-->
                </div>
            </div>
            <!--Search Popup-->
            <div id="search-popup" class="search-drawer">
                <div class="container">
                    <span class="closeSearch an an-times-l"></span>
                    <form class="form minisearch" id="header-search" action="#" method="get">
                        <label class="label"><span>Search</span></label>
                        <div class="control">
                            <div class="searchField">
                                 <div class="input-box">
                                    <button type="submit" title="Search" class="action search" disabled=""><i class="icon an an-search-l"></i></button>
                                    <input type="text" name="q" value="" placeholder="Search by keyword or #" class="input-text">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--End Search Popup-->
        </header>
        <!--End Header-->
        <!--Mobile Menu-->
        <div class="mobile-nav-wrapper" role="navigation">
            <div class="closemobileMenu"><i class="icon an an-times-l pull-right"></i> Close Menu</div>
            <ul id="MobileNav" class="mobile-nav">
                <li class="lvl1 parent dropdown"><a href="#">Categories <i class="an an-angle-down-l"></i></a>
                    <ul class="dropdown">
                        <?php 
                        if(count($category_data_array) > 0){
                            foreach($category_data_array as $category_data){
                                $cat_id = $category_data['id'];
                                $subcategory_data_array = array();
                                $get_subcategory_query = "select * from sub_category where category_id='$cat_id' and is_deleted='0' order by id asc";
                                $result_get_subcategory_query = mysqli_query($db_mysqli, $get_subcategory_query);
                                while ($row_get_subcategory_query = mysqli_fetch_assoc($result_get_subcategory_query))
                                {
                                    $subcategory_data_array[] = $row_get_subcategory_query;
                                }
                        ?>
                        <li><a href="<?php echo $base_url;?>celebrity-list/<?php echo $category_data['category_unique_slug']; ?>" class="site-nav"><?php echo $category_data['category_name']; ?> <?php if(count($subcategory_data_array) > 0){ ?><i class="an an-angle-right-l"></i><?php } ?></a>
                            <?php 
                            if(count($subcategory_data_array) > 0)
                            {
                                foreach($subcategory_data_array as $subcategory_data){
                            ?>
                            <ul class="dropdown">
                                <li><a href="<?php echo $base_url;?>celebrity-list/<?php echo $subcategory_data['sub_category_unique_slug']; ?>" class="site-nav"><?php echo $subcategory_data['sub_category_name']; ?></a></li>
                            </ul>
                            <?php } } ?>
                        </li>
                        <?php } } ?>
                    </ul>
                </li>
                <li class="lvl1 parent dropdown"><a href="#"> Gifting <i class="an an-angle-down-l"></i></a>
                    <ul class="dropdown">
                    <?php 
                        if(count($gift_cat_data_array) > 0){
                            $i=1;
                            foreach($gift_cat_data_array as $gift_cat_data){
                                $giftcate_id = $gift_cat_data['id'];
                                $gift_subcat_data_array = array();
                                $get_gift_subcat_query = "select * from gift_subcat where giftcate_id='$giftcate_id' and is_deleted='0' order by id asc";
                                $result_get_gift_subcat_query = mysqli_query($db_mysqli, $get_gift_subcat_query);
                                while ($row_get_gift_subcat_query = mysqli_fetch_assoc($result_get_gift_subcat_query))
                                {
                                    $gift_subcat_data_array[] = $row_get_gift_subcat_query;
                                }
                        ?> 
                        <li><a href="#" class="site-nav"><?php echo $gift_cat_data['gift_name']; ?><?php if(count($gift_subcat_data_array) > 0){ ?><i class="an an-angle-right-l"></i><?php } ?></a>
                            <ul>     
                                <?php if(count($gift_subcat_data_array) > 0){ ?>
                                        <?php 
                                        if(count($gift_subcat_data_array) > 0){
                                            foreach($gift_subcat_data_array as $gift_subcat_data){
                                                $giftsubcate_id = $gift_subcat_data['id'];
                                                $gift_subsubcat_data_array = array();
                                                $get_gift_subsubcat_query = "select * from gift_subsubcate where giftsubcat_id='$giftsubcate_id' and is_deleted='0' order by id asc";
                                                $result_get_gift_subsubcat_query = mysqli_query($db_mysqli, $get_gift_subsubcat_query);
                                                while ($row_get_gift_subsubcat_query = mysqli_fetch_assoc($result_get_gift_subsubcat_query))
                                                {
                                                    $gift_subsubcat_data_array[] = $row_get_gift_subsubcat_query;
                                                } 
                                        ?>
                                        <li><a href="#" class="site-nav"><?php echo $gift_subcat_data['giftsubcate_name']; ?><?php if(count($gift_subsubcat_data_array) > 0){ ?><i class="an an-angle-right-l"></i><?php } ?></a>
                                                <ul>
                                                    <?php 
                                                        if(count($gift_subsubcat_data_array) > 0){
                                                            foreach($gift_subsubcat_data_array as $gift_subsubcat_data){
                                                    ?>
                                                    <li><a href="<?php $base_url; ?>gifting/best-birthday-gift-for-<?php echo $gift_subsubcat_data['giftsubsubcate_slug']; ?>"><?php echo $gift_subsubcat_data['giftsubsubcate_name']; ?></a></li>
                                                    <?php }} ?>
                                                </ul>
                                        </li>        
                                        <?php }}?>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php  $i++;} } ?> 
                    </ul>
                </li>
                <li class="lvl1 parent dropdown"><a href="#">Support</a></li>
            </ul>
        </div>
        <!--End Mobile Menu-->