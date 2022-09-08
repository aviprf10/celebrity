<?php
include 'common/config.php';
include 'common/check_login.php';
if ($celebrity == 1)
{

        $module_full_name = "Profile Details";
        $module_short_name = "Profile Details";
        $module_name = "profile-details";

        $category_id = '';
        $sub_category_id = '';
        $sub_sub_category_id = '';
        $giftcat_id = '';
        $giftsubcat_id = '';
        $giftsubsubcat_id = '';
        $celebrity_price = '';
        $discount_type = '';
        $discount = '';
        $sort_description = '';
        $full_description = '';
        $skill_tag = '';
        $meta_title = '';
        $meta_keyword = '';
        $meta_description = '';
        $insta_video_price = '';
        $record_video_price = '';
        $language_spoken = '';
        $brand_celebration_price = '';
        $flower_count = '';
        $status  =1;
        $edit_data_array = array();
        $get_celebrity_details_query = "select * from celebrity_details where celebrity_id='$loggedin_user_id' and is_deleted='0'";
        $result_get_celebrity_details_query = mysqli_query($db_mysqli, $get_celebrity_details_query);
        while ($row_get_celebrity_details_query = mysqli_fetch_assoc($result_get_celebrity_details_query))
        {
            $edit_data_array[] = $row_get_celebrity_details_query;
        }
        
        if(count($edit_data_array) > 0)
        {
            $category_id = $edit_data_array[0]['category_id'];
            $sub_category_id = $edit_data_array[0]['sub_category_id'];
            $sub_sub_category_id = $edit_data_array[0]['sub_sub_category_id'];
            $giftcat_id = $edit_data_array[0]['giftcat_id'];
            $giftsubcat_id = $edit_data_array[0]['giftsubcat_id'];
            $giftsubsubcat_id = $edit_data_array[0]['giftsubsubcat_id'];
            $celebrity_price = $edit_data_array[0]['celebrity_price'];
            $discount_type = $edit_data_array[0]['discount_type'];
            $discount = $edit_data_array[0]['discount'];
            $sort_description = $edit_data_array[0]['sort_description'];
            $full_description = $edit_data_array[0]['full_description'];
            $skill_tag = $edit_data_array[0]['skill_tag'];
            $meta_title = $edit_data_array[0]['meta_title'];
            $meta_keyword = $edit_data_array[0]['meta_keyword'];
            $meta_description = $edit_data_array[0]['meta_description'];
            $insta_video_price = $edit_data_array[0]['insta_video_price'];
            $record_video_price = $edit_data_array[0]['record_video_price'];
            $language_spoken = $edit_data_array[0]['language_spoken'];
            $brand_celebration_price = $edit_data_array[0]['brand_celebration_price'];
            $follower_count = $edit_data_array[0]['follower_count'];
            $status = $edit_data_array[0]['status'];
            $is_pramotion = $celebritydetails_data_array[0]['is_pramotion'];
        }
            
        $get_user_query = "SELECT * FROM user WHERE id='$loggedin_user_id'";
        $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
        $all_user_data_array = array();
        while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
        {
            $all_user_data_array[] = $row_get_user_query;
        }
            
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title><?php echo $company_title; ?> - Edit <?php echo $module_full_name; ?></title>
                <?php include('common/header-css.php'); ?>
                <link rel="stylesheet" type="text/css" href="<?php echo $base_url_css; ?>tag/jquery.tagsinput.css"/>
                <style>
                    table#all-<?php echo $module_name; ?>-table tr td:first-child {
                        display: none;
                    }

                    table#all-<?php echo $module_name; ?>-table th:first-child {
                        display: none;
                    }

                    <?php if($page_layout == 1){ ?>
                    .page-title {
                        padding: 15px 36px 15px 0;
                    }

                    .content:first-child {
                        padding-top: 2px;
                    }

                    .heading-elements > a {
                        padding: 7px 15px;
                    }

                    <?php } ?>
                </style>
            </head>

            <body class="<?php if ($page_layout == 1)
            { ?>navbar-top-md-md <?php }
            else if ($page_layout == 2)
            { ?> navbar-top pace-done
        <?php
                if ($side_menu_sub_category == 0)
                {
                    ?>
           sidebar-xs
        <?php
                }
            } ?>">
            <div class="<?php if ($page_layout == 1)
            { ?>navbar-fixed-top<?php }
            else if ($page_layout == 2)
            { ?>navbar navbar-inverse navbar-fixed-top bg-danger <?php } ?>">
                <?php include('common/header.php'); ?>
                <?php if ($page_layout == 1)
                { ?>
                    <?php include('common/top-menu.php'); ?>
                <?php } ?>
            </div>

            <?php if ($page_layout == 1)
            { ?>
                <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h6><i class="icon-home4 position-left"></i>
					<span class="text-semibold">
						<i class="icon-arrow-right13"></i>
						<a href="<?php echo $base_url; ?>">
                            Dashboard
                        </a>
					</span>
                                <i class="icon-arrow-right13"></i> <?php echo $module_short_name; ?>
                                <i class="icon-arrow-right13"></i> Edit <?php echo $module_short_name; ?>
                            </h6>
                        </div>


                    </div>
                </div>
            <?php } ?>

            <div class="page-container"> <!-- Page container start -->

                <div class="page-content"> <!-- Page content start -->

                    <?php if ($page_layout == 2)
                    { ?>
                        <?php include('common/side-menu.php'); ?>
                    <?php } ?>

                    <div class="content-wrapper"> <!-- content wrapper start -->

                        <!-- Page header Start -->
                        <?php if ($page_layout == 2)
                        { ?>
                            <div class="page-header page-header-default">
                                <div class="breadcrumb-line">
                                    <ul class="breadcrumb">
                                        <li>
                                            <a href="<?php echo $base_url; ?>">
                                                <i class="icon-home2 position-left"></i>
                                                Dashboard
                                            </a>
                                        </li>
                                        <li><?php echo $module_short_name; ?></li>
                                        <li class="active">Edit <?php echo $module_short_name; ?></li>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- /page header end -->

                        <div class="content"> <!-- content Start -->

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        

                                        <div class="panel-body">
                                            <form id="<?php echo $module_name; ?>_form" method="POST" data-parsley-validate>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Select Category : <span class="text-danger">*</span></label>
                                                            <?php
                                                            $all_category_data_array = array();
                                                            $get_category_query = "SELECT * FROM category WHERE is_deleted='0'";
                                                            $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);
                                                            while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
                                                            {
                                                                $all_category_data_array[] = $row_get_category_query;
                                                            }
                                                            ?>
                                                            <select class="select-search form-control" id="category_id" multiple="multiple"
                                                                    name="category_id[]" data-placeholder="Select a Category..." onchange="get_subcategory();" data-parsley-required="true">
                                                                <option value=""> select category</option>
                                                                <?php foreach ($all_category_data_array as $all_category_data)
                                                                { ?>
                                                                    <option
                                                                        <?php
                                                                            if (in_array($all_category_data['id'], explode(',', $category_id)))
                                                                            {
                                                                                echo " selected='selected'";
                                                                            }
                                                                            ?>
                                                                        value="<?php echo $all_category_data['id']; ?>"
                                                                        <?php if ($all_category_data['id'] == $category_id)
                                                                        {
                                                                            echo " selected='selected'";
                                                                        } ?>>
                                                                        <?php echo $all_category_data['category_name']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3" id="subcategory_div">
                                                        <div class="form-group">
                                                            <label>Select Subcategory : <span  class="text-danger">*</span></label>
                                                            <?php
                                                            if($sub_category_id !=''){
                                                            $all_sub_category_data_array = array();
                                                            $get_sub_category_query = "select * from sub_category where id IN($sub_category_id) and is_deleted='0'";
                                                            $result_get_sub_category_query = mysqli_query($db_mysqli, $get_sub_category_query);
                                                            while ($row_get_sub_category_query = mysqli_fetch_assoc($result_get_sub_category_query))
                                                            {
                                                                $all_sub_category_data_array[] = $row_get_sub_category_query;
                                                            }
                                                            ?>
                                                            <select class="select-search form-control" id="sub_category_id"  multiple="multiple"  name="sub_category_id[]">
                                                            <?php 
                                                            foreach ($all_sub_category_data_array as $all_sub_category_data)
                                                            { ?>
                                                                <option
                                                                    <?php
                                                                        if (in_array($all_sub_category_data['id'], explode(',', $sub_category_id)))
                                                                        {
                                                                            echo " selected='selected'";
                                                                        }
                                                                        ?>
                                                                    value="<?php echo $all_sub_category_data['id']; ?>"
                                                                    <?php if ($all_sub_category_data['id'] == $sub_category_id)
                                                                    {
                                                                        echo " selected='selected'";
                                                                    } ?>>
                                                                    <?php echo $all_sub_category_data['sub_category_name']; ?>
                                                                </option>
                                                            <?php } } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Select Gift Category : <span
                                                                    class="text-danger">*</span></label>
                                                                    <?php
                                                                    $get_gift_cat_query = "select * from gift_cat where status='1' and is_deleted='0'";
                                                                    $result_get_gift_cat_query = mysqli_query($db_mysqli, $get_gift_cat_query);
                                                                    while ($row_get_gift_cat_query = mysqli_fetch_assoc($result_get_gift_cat_query))
                                                                    {
                                                                        $all_gift_cat_data_array[] = $row_get_gift_cat_query;
                                                                    }

                                                                
                                                                    ?>
                                                            <select class="select-search form-control" id="giftcat_id"
                                                                    name="giftcat_id[]" data-placeholder="Select a Gift Category..." data-parsley-required="true"  multiple="multiple" onchange="get_giftsubcategory();">
                                                                    <option value=""> select Gift Category</option>
                                                            <?php foreach ($all_gift_cat_data_array as $all_gift_cat_data)
                                                            { ?>
                                                                <option
                                                                    <?php
                                                                        if (in_array($all_gift_cat_data['id'], explode(',', $giftcat_id)))
                                                                        {
                                                                            echo " selected='selected'";
                                                                        }
                                                                        ?>
                                                                    value="<?php echo $all_gift_cat_data['id']; ?>"
                                                                    <?php if ($all_gift_cat_data['id'] == $giftcat_id)
                                                                    {
                                                                        echo " selected='selected'";
                                                                    } ?>>
                                                                    <?php echo $all_gift_cat_data['gift_name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3" id="giftsubcategory_div">
                                                        <div class="form-group">
                                                            <label>Select Gift Subcategory : <span  class="text-danger">*</span></label>
                                                            <?php
                                                            if($giftcat_id !=''){
                                                            $all_gift_subcat_data_array = array();
                                                            $get_gift_subcat_query = "select * from gift_subcat where giftcate_id IN($giftcat_id) and is_deleted='0'";
                                                            $result_get_gift_subcat_query = mysqli_query($db_mysqli, $get_gift_subcat_query);
                                                            while ($row_get_gift_subcat_query = mysqli_fetch_assoc($result_get_gift_subcat_query))
                                                            {
                                                                $all_gift_subcat_data_array[] = $row_get_gift_subcat_query;
                                                            }
                                                            ?>
                                                            <select class="select-search form-control" id="giftsubcat_id"  multiple="multiple" name="giftsubcat_id[]">
                                                            <?php foreach ($all_gift_subcat_data_array as $all_gift_subcat_data)
                                                            { ?>
                                                                <option
                                                                    <?php
                                                                        if (in_array($all_gift_subcat_data['id'], explode(',', $giftsubcat_id)))
                                                                        {
                                                                            echo " selected='selected'";
                                                                        }
                                                                        ?>
                                                                    value="<?php echo $all_gift_subcat_data['id']; ?>"
                                                                    <?php if ($all_gift_subcat_data['id'] == $giftsubcat_id)
                                                                    {
                                                                        echo " selected='selected'";
                                                                    } ?>>
                                                                    <?php echo $all_gift_subcat_data['giftsubcate_name']; ?>
                                                                </option>
                                                            <?php } } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row"> 
                                                    <div class="col-md-3" id="giftsubsubcategory_div">
                                                        <div class="form-group">
                                                            <label>Select Gift Sub Subcategory : <span  class="text-danger">*</span></label>
                                                            <?php
                                                            if($giftsubcat_id !=''){
                                                            $all_gift_subsubcate_data_array = array();
                                                            $get_gift_subsubcate_query = "select * from gift_subsubcate where giftsubcat_id IN($giftsubcat_id) and is_deleted='0'";
                                                            $result_get_gift_subsubcate_query = mysqli_query($db_mysqli, $get_gift_subsubcate_query);
                                                            while ($row_get_gift_subsubcate_query = mysqli_fetch_assoc($result_get_gift_subsubcate_query))
                                                            {
                                                                $all_gift_subsubcate_data_array[] = $row_get_gift_subsubcate_query;
                                                            }
                                                            ?>
                                                            <select class="select-search form-control"  multiple="multiple" id="giftsubsubcat_id"  name="giftsubsubcat_id[]">
                                                            <?php foreach ($all_gift_subsubcate_data_array as $all_gift_subsubcate_data)
                                                            { ?>
                                                                <option
                                                                    <?php
                                                                        if (in_array($all_gift_subsubcate_data['id'], explode(',', $giftsubsubcat_id)))
                                                                        {
                                                                            echo " selected='selected'";
                                                                        }
                                                                        ?>
                                                                    value="<?php echo $all_gift_subsubcate_data['id']; ?>"
                                                                    <?php if ($all_gift_subsubcate_data['id'] == $giftsubcat_id)
                                                                    {
                                                                        echo " selected='selected'";
                                                                    } ?>>
                                                                    <?php echo $all_gift_subsubcate_data['giftsubsubcate_name']; ?>
                                                                </option>
                                                            <?php } }?>
                                                            </select>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Spoken Language : </label>
                                                            <?php
                                                            $all_spoken_language_data_array = array();
                                                            $get_spoken_language_query = "SELECT * FROM spoken_language WHERE is_deleted='0'";
                                                            $result_get_spoken_language_query = mysqli_query($db_mysqli, $get_spoken_language_query);
                                                            while ($row_get_spoken_language_query = mysqli_fetch_assoc($result_get_spoken_language_query))
                                                            {
                                                                $all_spoken_language_data_array[] = $row_get_spoken_language_query;
                                                            }
                                                            ?>
                                                            <select class="select-search form-control" id="language_spoken" multiple="multiple"
                                                                    name="language_spoken[]" data-placeholder="Select a Spoken Language..." data-parsley-required="true">
                                                                <option value=""> select Spoken Language</option>
                                                                <?php foreach ($all_spoken_language_data_array as $all_spoken_language_data)
                                                                { ?>
                                                                    <option 
                                                                    <?php
                                                                        if (in_array($all_spoken_language_data['language_name'], explode(',', $language_spoken)))
                                                                        {
                                                                            echo " selected='selected'";
                                                                        }
                                                                        ?>
                                                                    
                                                                    value="<?php echo $all_spoken_language_data['language_name']; ?>"
                                                                    <?php if ($all_spoken_language_data['language_name'] == $language_spoken)
                                                                    {
                                                                        echo " selected='selected'";
                                                                    } ?>>
                                                                        <?php echo $all_spoken_language_data['language_name']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>        
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="price" style="color:#000">Brand Collaboration Price : </label>
                                                        <input type="text" name="brand_celebration_price" data-parsley-required="true" id="brand_celebration_price" value="<?php echo $brand_celebration_price; ?>" class="form-control" placeholder="Brand Collaboration Price" min="100">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="price" style="color:#000">Brand Pramotion : </label>
                                                        <select class="form-control" name="is_pramotion" id="is_pramotion" onchange="get_showservices(this.value)">
                                                            <option value="">Select Brand Pramotion</option>
                                                            <option value="1" <?php if($is_pramotion == 1){ echo 'selected'; } ?>>Yes</option>
                                                            <option value="0" <?php if($is_pramotion == 0){ echo 'selected'; } ?>>No</option>
                                                        </select>
                                                    </div>                
                                                </div>
                                                 <?php 
                                                $get_celebrityprice_query = "select * from celebrity_price where celebrity_id='$loggedin_user_id'";
                                                $result_get_celebrityprice_query = mysqli_query($db_mysqli,$get_celebrityprice_query);
                                                while ($row_get_celebrityprice_query = mysqli_fetch_assoc($result_get_celebrityprice_query))
                                                {
                                                    $celebrityprice_data[] = $row_get_celebrityprice_query;
                                                }
                                                $celebrityprice_entry_count = 0;
                                                $total_add_append = '1';
                                                if(isset($celebrityprice_data) && count($celebrityprice_data)>0)
                                                {
                                                    foreach($celebrityprice_data AS $celebrityprice)
                                                    { 
                                                        
                                                        $celebrityprice_entry_count += 1;
                                                ?>
                                                <div class="row" <?php if($is_pramotion == 1){ ?>style="display:none;" <?php }else{ ?>id="services_div"<?php } ?>>
                                                    <div class="col-md-3" id="inputedu">
                                                        <input type="hidden" name="old_price_entry_id_<?php echo $celebrityprice_entry_count; ?>" id="old_price_entry_id_<?php echo $celebrityprice_entry_count; ?>" value="<?php echo $celebrityprice['id']; ?>">
                                                        <label for="price" style="color:#000">Select Services : </label>
                                                        <?php
                                                        $all_services_data_array = array();
                                                        $get_services_query = "SELECT * FROM services WHERE is_deleted='0'";
                                                        $result_get_services_query = mysqli_query($db_mysqli, $get_services_query);
                                                        while ($row_get_services_query = mysqli_fetch_assoc($result_get_services_query))
                                                        {
                                                            $all_services_data_array[] = $row_get_services_query;
                                                        }
                                                        ?>
                                                        <select class="select-search form-control" id="services_id_<?php echo $celebrityprice_entry_count; ?>"
                                                                name="services_id_<?php echo $celebrityprice_entry_count; ?>" data-placeholder="Select a Services..."  data-parsley-required="true">
                                                            <option value=""> select Services</option>
                                                            <?php foreach ($all_services_data_array as $all_services_data)
                                                            { ?>
                                                                <option value="<?php echo $all_services_data['id']; ?>" <?php if($all_services_data['id'] == $celebrityprice['services_id']){ echo 'selected';} ?>>
                                                                    <?php echo $all_services_data['services_name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>    
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="price" style="color:#000">Price : </label>
                                                        <input type="text" name="price_<?php echo $celebrityprice_entry_count; ?>" id="price_<?php echo $celebrityprice_entry_count; ?>" value="<?php echo $celebrityprice['price']; ?>" class="form-control" placeholder="Price" min="100"  data-parsley-required="true">
                                                    </div> 
                                                    <div class="col-md-3">
                                                        <label for="price" style="color:#000">Discount Type : </label>
                                                        <select class="form-control" name="disocunt_type_<?php echo $celebrityprice_entry_count; ?>" id="disocunt_type_<?php echo $celebrityprice_entry_count; ?>">
                                                            <option value="">Select Discount Type</option>
                                                            <option value="price" <?php if($celebrityprice['discount_type'] == 'price'){ echo 'selected';} ?>>Price</option>
                                                            <option value="percentage" <?php if($celebrityprice['discount_type'] == 'percentage'){ echo 'selected';} ?>>Percentage</option>
                                                        </select>    
                                                    </div> 
                                                    <div class="col-md-2">
                                                        <label for="price" style="color:#000">Discount : </label>
                                                        <input type="text" class="form-control" value="<?php echo $celebrityprice['discount']; ?>" id="discount_<?php echo $celebrityprice_entry_count; ?>"  name="discount_<?php echo $celebrityprice_entry_count; ?>" placeholder="Enter Discount">
                                                    </div>    
                                                    <div class="col-md-1" id="addbotton">
                                                        <a onclick="remove_price_entry(<?php echo $celebrityprice_entry_count; ?>)" style="cursor:pointer">
                                                            <img src="<?php echo $base_url_images;?>minus.png" style="margin-top: 32px;">
                                                        </a>&nbsp;&nbsp;
                                                        <a onclick="add_price_entry(1)" style="cursor:pointer">
                                                            <img src="<?php echo $base_url_images;?>plus.png" style="margin-top: 32px;">
                                                        </a>
                                                    </div>
                                                </div>
                                                <?php 
                                                        }
                                                    }   
                                                    else
                                                    {   
                                                ?>
                                                <div class="row" <?php if($is_pramotion == 1){ ?>style="display:none;" <?php }else{ ?>id="services_div"<?php } ?>>
                                                    <div class="col-md-3" id="inputedu">
                                                        <input type="hidden" name="old_price_entry_id_1" id="old_price_entry_id_1" value="">
                                                        <label for="price" style="color:#000">Select Services : </label>
                                                        <?php
                                                        $all_services_data_array = array();
                                                        $get_services_query = "SELECT * FROM services WHERE is_deleted='0'";
                                                        $result_get_services_query = mysqli_query($db_mysqli, $get_services_query);
                                                        while ($row_get_services_query = mysqli_fetch_assoc($result_get_services_query))
                                                        {
                                                            $all_services_data_array[] = $row_get_services_query;
                                                        }
                                                        ?>
                                                        <select class="select-search form-control" id="services_id_1"  name="services_id_1"  data-placeholder="Select a Services...">
                                                            <option value=""> select Services</option>
                                                            <?php foreach ($all_services_data_array as $all_services_data)
                                                            { ?>
                                                                <option value="<?php echo $all_services_data['id']; ?>">
                                                                    <?php echo $all_services_data['services_name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>    
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="price" style="color:#000">Price : </label>
                                                        <input type="text" name="price_1" id="price_1" class="form-control" placeholder="Price" min="100">
                                                    </div> 
                                                    <div class="col-md-3">
                                                        <label for="price" style="color:#000">Discount Type : </label>
                                                        <select class="form-control" name="disocunt_type_1" id="disocunt_type_1">
                                                            <option value="">Select Discount Type</option>
                                                            <option value="price">Price</option>
                                                            <option value="percentage">Percentage</option>
                                                        </select>    
                                                    </div> 
                                                    <div class="col-md-2">
                                                        <label for="price" style="color:#000">Discount : </label>
                                                        <input type="text" data-parsley-required="true" class="form-control" id="discount_1"  name="discount_1" placeholder="Enter Discount">
                                                    </div>    
                                                    <div class="col-md-1" id="addbotton">
                                                        <a onclick="add_price_entry(2)" style="cursor:pointer">
                                                            <img src="<?php echo $base_url_images;?>plus.png" style="margin-top: 32px;">
                                                        </a>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <div id="price_div"></div> <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>FUll Description : <span class="text-danger">*</span></label>
                                                            <textarea type="text" class="form-control" name="full_description"
                                                                placeholder="Enter Full Description" data-parsley-required="true" rows="5" maxlength="500"><?php echo $full_description; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Facebook URL :</label>
                                                            <input type="text" class="form-control"id="facebook_link" name="facebook_link"
                                                                    placeholder="Enter Facebook " value="<?php echo $all_user_data_array[0]['facebook_link'] ?>">                                                
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Twitter URL :</label>
                                                            <input type="text" class="form-control"id="twitter_link" name="twitter_link"
                                                                    placeholder="Enter Twitter " value="<?php echo $all_user_data_array[0]['twitter_link'] ?>">                                                
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Instagram URL :</label>
                                                            <input type="text" class="form-control"id="instagram_link" name="instagram_link"
                                                                    placeholder="Enter Instagram " value="<?php echo $all_user_data_array[0]['instagram_link'] ?>">                                                
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Whatsapp URL :</label>
                                                            <input type="text" class="form-control"id="whatsapp_link" name="whatsapp_link"
                                                                    placeholder="Enter Whatsapp " value="<?php echo $all_user_data_array[0]['whatsapp_link'] ?>">                                                
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">    
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Linkdin URL :</label>
                                                            <input type="text" class="form-control"id="linkedin_link" name="linkedin_link"
                                                                    placeholder="Enter Linkdin " value="<?php echo $all_user_data_array[0]['linkedin_link'] ?>">                                                
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Google URL :</label>
                                                            <input type="text" class="form-control"id="google_link" name="google_link"
                                                                    placeholder="Enter Google " value="<?php echo $all_user_data_array[0]['google_link'] ?>">                                                
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Your follower rang(K) :</label>
                                                        <input class="form-control" type="text" data-parsley-required="true" name="follower_count" id="follower_count" placeholder="Enter Follower" value="<?php echo $follower_count; ?>">
                                                        <!-- <div class="range-slider">
                                                            <input class="range-slider__range" type="range" data-parsley-required="true" name="follower_count" id="follower_count" <?php if(count($follower_count) > 0){ ?>value="<?php echo $follower_count; ?>"<?php }else{ ?> value="1000"<?php } ?> min="1000" max="10000000">
                                                            <span class="range-slider__value">0K</span>
                                                        </div> -->
                                                    </div>
                                                </div> 
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Meta Title :</label>
                                                            <input type="text" class="form-control"id="meta_title" name="meta_title"
                                                                    placeholder="Enter Meta Title " value="<?php echo $meta_title; ?>">                                                
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Profile Details Link :</label>
                                                            <input type="text" class="form-control"id="profile_link_url" name="profile_link_url"
                                                                    placeholder="Enter Profile Details Link " value="<?php echo $all_user_data_array[0]['profile_link_url']; ?> ">                                                
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Meta Description :</label>
                                                            <textarea type="text" class="form-control"id="meta_description" name="meta_description"
                                                                    placeholder="Enter Meta Description "> <?php echo $meta_description; ?>  </textarea>                                             
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Meta Keywords :</label>
                                                            <input id="search_keywords" name="search_keywords[]" type="text"  class="form-control tags"  placeholder="Enter Search Terms" value="<?php echo $meta_keyword; ?>" />
                                                            <span class="help-block">Note:Help someone to find your celebrity_detailss - Use the 13 tags to optimize your listings.</span>
                                                            <div id="tag_error_div">
                                                            </div>                                             
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label" style="">Upload profile pic (Image Size 193X268PX and 2MB):</label>
                                                            <div style="clear:both"></div>
                                                            <div style="margin-top:10px;margin-bottom: 15px;">
                                                                <?php
                                                                $i = 1;
                                                                $profile_pic = $all_user_data_array[0]['profile_pic'];
                                                                for ($i = 1; $i <= 1; $i++)
                                                                {
                                                                    ?>
                                                                    <div style="height: 200px;float:left;margin-left:15px;margin-top: 15px;">
                                                                        <div id="upload<?php echo $i; ?>" style="width:160px;height:160px;padding: 0px;border: 1px solid #dedede;"
                                                                                class="">
                                                                            <ul class="" id="files<?php echo $i; ?>"
                                                                                style="width: auto;padding: 0px;margin:0px;height: 103px;text-align:center">
                                                                                <?php
                                                                                if ($profile_pic != '')
                                                                                {
                                                                                    ?>
                                                                                    <img src="<?php echo $base_url; ?>uploads/profile-pic/size_450/<?php echo $profile_pic; ?>"
                                                                                            style="margin-bottom:20px;width:150px;height:150px;">
                                                                                    <div style="clear:both"></div>
                                                                                    <center><a class="" style="cursor:pointer" onclick="delete_upload(<?php echo $i; ?>)">
                                                                                            <i class="icon icon-subtract"></i>
                                                                                            <div style="clear:both"></div>
                                                                                            DELETE
                                                                                        </a></center>
                                                                                    <?php
                                                                                }
                                                                                else
                                                                                {
                                                                                    ?>
                                                                                    <img src="<?php echo $base_url_images; ?>default_profile.jpg"
                                                                                            style="margin-bottom:20px;width:150px;height:150px;">
                                                                                    <div style="clear:both"></div>
                                                                                    <center><a class="" style="cursor:pointer" onclick="delete_upload(<?php echo $i; ?>)">
                                                                                            <i class="icon icon-subtract"></i>
                                                                                            <div style="clear:both"></div>
                                                                                            DELETE
                                                                                        </a></center>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                            <input type="hidden" name="file_name<?php echo $i; ?>" id="file_name<?php echo $i; ?>"
                                                                                    value="<?php echo $profile_pic; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <div style="clear:both"></div>
                                                                <div id="status"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="status" class="styled" id="status" value="1" <?php if ($status == 1)
                                                                    {
                                                                        echo "checked";
                                                                    } ?>>
                                                                    Active
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-top:25px">
                                                    <div class="text-left">
                                                        <button type="submit" class="btn bg-<?php echo $theme_color; ?>">Submit <i class="icon-arrow-right14 position-right"></i></button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php include('common/footer.php'); ?>
                        </div> <!-- content ent -->

                    </div>  <!-- content wrapper end -->

                </div> <!-- Page content end -->

            </div> <!-- Page container end -->
                                                              
            <script src="<?php echo $base_url_js; ?>plugins/parsley/parsley.min.js"></script>
            <script type="text/javascript" src="<?php echo $base_url_js_upload; ?>ajaxupload.3.5.js"></script>
            <script type="text/javascript" src="<?php echo $base_url_js; ?>tag/jquery.tagsinput.js"></script>
            <script type="text/javascript">
                $(document).ready(function ()
                {
                    $('#<?php echo $module_name; ?>_form').parsley();
                    $('#<?php echo $module_name; ?>_form').on('submit', function (e)
                    {
                        e.preventDefault();
                        var f = $(this);
                        f.parsley().validate();
                        if (f.parsley().isValid())
                        {
                            $.ajax(
                            {
                                url: "<?php echo $base_url; ?><?php echo $module_name; ?>-submit.php",
                                type: "POST",
                                data: $('#<?php echo $module_name; ?>_form').serialize()+ "&price_entry_list=" + price_entry_list_array,
                                dataType: 'json',
                                encode: true,
                                beforeSend: function ()
                                {
                                    $.blockUI({message: '<i class="icon-spinner3 spinner position-left" style="font-size:21px"></i>'});
                                },
                                success: function (data)
                                {
                                    $.unblockUI();
                                    if (data.status == 'success')
                                    {
                                        $('#<?php echo $module_name; ?>_form').parsley().destroy();
                                        $.notifyBar({cssClass: "success", html: data.html_message});
                                        //dataTable.ajax.reload();
                                    }
                                    else
                                    {
                                        $.notifyBar({cssClass: "error", html: data.html_message});
                                        //dataTable.ajax.reload();
                                    }
                                },
                                error: function (data, errorThrown)
                                {
                                    $.unblockUI();
                                    $.notifyBar({cssClass: "error", html: "Error occured!"});
                                }

                            });
                        }
                        else
                        {
                            e.preventDefault();
                        }
                    });
                });
               
                 $('#search_keywords, #skill_tags').tagsInput({
                    width: 'auto', height: '44px'
                });

                
                function get_subcategory()
                {
                    var cat_id = new Array();
                    cat_id = $('#category_id').val();
                    var new_cat = cat_id.join(',')
                    $('#<?php echo $module_name; ?>_form').parsley().destroy();
                    $.ajax(
                        {
                            url: "<?php echo $base_url; ?>get_subcategory.php",
                            type: "POST",
                            data: {'category_id':new_cat},
                            dataType: 'json',
                            encode: true,
                            beforeSend: function ()
                            {
                                $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
                            },
                            success: function (data)
                            {
                                $.unblockUI();

                                if (data.status == 'success')
                                {
                                    $('#subcategory_div').html(data.html_message);
                                    $('#sub_category_id').attr('data-parsley-required', 'true').select2();
                                    
                                }
                                else
                                {
                                    $.notifyBar({cssClass: "error", html: data.html_message});
                                }
                            }
                        });
                    $('#<?php echo $module_name; ?>_form').parsley();
                }

                function get_giftsubcategory()
                {
                    var giftcat_id = new Array();
                    giftcat_id = $('#giftcat_id').val();
                    var new_giftcat = giftcat_id.join(',')
                    $('#<?php echo $module_name; ?>_form').parsley().destroy();
                    $.ajax(
                        {
                            url: "<?php echo $base_url; ?>get_giftsubcategory.php",
                            type: "POST",
                            data: {'giftcat_id':new_giftcat},
                            dataType: 'json',
                            encode: true,
                            beforeSend: function ()
                            {
                                $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
                            },
                            success: function (data)
                            {
                                $.unblockUI();

                                if (data.status == 'success')
                                {
                                    $('#giftsubcategory_div').html(data.html_message);
                                    $('#giftsubcat_id').attr('data-parsley-required', 'true').select2();
                                    
                                }
                                else
                                {
                                    $.notifyBar({cssClass: "error", html: data.html_message});
                                }
                            }
                        });
                    $('#<?php echo $module_name; ?>_form').parsley();
                }

                function get_giftsubsubcategory(giftsubcat_id)
                {
                    var giftsubcat_id = new Array();
                    giftsubcat_id = $('#giftsubcat_id').val();
                    var new_giftsubcat = giftsubcat_id.join(',')
                    $('#<?php echo $module_name; ?>_form').parsley().destroy();
                    $.ajax(
                        {
                            url: "<?php echo $base_url; ?>get_giftsubsubcategory.php",
                            type: "POST",
                            data: {'giftsubcat_id':new_giftsubcat},
                            dataType: 'json',
                            encode: true,
                            beforeSend: function ()
                            {
                                $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
                            },
                            success: function (data)
                            {
                                $.unblockUI();

                                if (data.status == 'success')
                                {
                                    $('#giftsubsubcategory_div').html(data.html_message);
                                    $('#giftsubsubcat_id').attr('data-parsley-required', 'true').select2();
                                    
                                }
                                else
                                {
                                    $.notifyBar({cssClass: "error", html: data.html_message});
                                }
                            }
                        });
                    $('#<?php echo $module_name; ?>_form').parsley();
                }

                <?php for($i = 1;$i <= 1;$i++){ ?>
                var file_name;
                $(function ()
                {
                    var btnUpload = $('#upload<?php echo $i; ?>');
                    var status = $('#status<?php echo $i; ?>');
                    new AjaxUpload(btnUpload, {
                        action: '<?php echo $base_url;?>upload-profilepic-image.php',
                        name: 'uploadfile',
                        onSubmit: function (file, ext)
                        {
                            if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext)))
                            {
                                $('#status').html('<p style="color:#d05165;margin-left:10px">Only JPG, JPEG, PNG or GIF files are allowed.</p>');
                                $('#files<?php echo $i; ?>').html('<center><i class="icon  icon-add" style="color:#3333FF;font-size: 20px;margin-top: 20px;"></i><div style="clear:both"></div>ADD <br/> PHOTOS </center>');
                                return false;
                            }
                            document.getElementById('files<?php echo $i;?>').innerHTML = '<center><img src="<?php echo $base_url_images?>loading.gif" style="width:30px;margin-top:35px"></center>';
                        },
                        onComplete: function (file, response)
                        {
                            var file_name_split = response.split("$$");
                            file = file_name_split[1];
                            file1 = file_name_split[0];

                            if (file1 === "success")
                            {
                                document.getElementById('file_name<?php echo $i; ?>').value = file;
                                $('<li></li>').add('#files<?php echo $i; ?>').html('<img src="<?php echo $base_url_uploads;?>profile-pic/size_450/' + file + '" style="margin-bottom:10px;width:150px;height:150px;"  alt="" /><div style="clear:both"></div><center><a class="" style="cursor:pointor" onclick="delete_upload(<?php echo $i;?>)"><i class="icon icon-subtract"></i><div style="clear:both"></div>DELETE </a></center>').addClass('success');
                                $('input').attr('title', ' ');
                            }
                            else if (response == 'size_error')
                            {
                                $('#status').html('<p style="color:#d05165;margin-left:10px">Please upload image with max size 2MB.</p>');
                                $('#files<?php echo $i; ?>').html('<center><i class="icon-add" style="color:#3333FF;font-size: 20px;margin-top: 20px;"></i><div style="clear:both"></div>ADD <br/> PHOTOS </center>');
                                return false;
                            }
                            else
                            {
                                $('<li></li>').add('#files<?php echo $i; ?>').text(file).addClass('error');
                            }
                        }
                    });
                });
            <?php } ?>
            function delete_upload(delete_file_id)
            {
//                debugger;
                $('#files' + delete_file_id).html('<center style="margin-top: 20px;"><i class="icon icon-add"></i><div style="clear:both"></div>ADD <br/> PHOTOS </center>');
                $('#file_name' + delete_file_id).val("");
            }

            <?php if($celebrityprice_entry_count > 0){ ?>
            var z = <?php echo $celebrityprice_entry_count; ?>;
            price_entry_list_array = [];
            for (var i = 1; i <= <?php echo $celebrityprice_entry_count; ?>; i++) {
                price_entry_list_array.push(i)
            }
            <?php }else{ ?>
            var z = 1;
            var price_entry_list_array = [1];
            <?php } ?>
            function add_price_entry() {
                z++;
                price_entry_list_array.push(z);
                var a = {
                    index_no: z,
                };

                var one = $('#services_id_1').val();
                var two = $('#services_id_2').val();
                var three = $('#services_id_3').val();
                var four = $('#services_id_4').val();
                const values = [one, two, three, four].filter(i => 'Select' !== i).filter(Boolean);
                const filtered = values.filter((v, i) => values.indexOf(v) === i)
                if (values.length) {
                    if (values.length === filtered.length) {
                        
                    } else {
                        $.notifyBar({cssClass: "error", html: "You can not select same value again..Please select different value"});
                        return false;
                    }
                }
                
                $.ajax({
                    type: "POST",
                    data: a,
                    url: "<?php echo $base_url;?>ajax-add-price-entry.php",
                    dataType: "json",
                    encode: true,
                    success: function(b) {
                        if (b.status == "success") {
                            $("#price_div").append(b.html_message)
                        } else {
                            $.growl.error({
                                title: "Error",
                                html: b.html_message
                            })
                        }
                    }
                })
                
            }

            function remove_price_entry(a) {
                remove_array_value(price_entry_list_array, a);
                $("#price_entry_div_" + a).remove()
            }

            function remove_array_value(c) {
                var g, d = arguments,
                    b = d.length,
                    f;
                while (b > 1 && c.length) {
                    g = d[--b];
                    while ((f = c.indexOf(g)) !== -1) {
                        c.splice(f, 1)
                    }
                }
                return c
            }

            // var rangeSlider = function(){
            // var slider = $('.range-slider'),
            //     range = $('.range-slider__range'),
            //     value = $('.range-slider__value');
                
            // slider.each(function(){

            //     value.each(function(){
            //     var value = $(this).prev().attr('value');
            //     $(this).html(value);
            //     });

            //     range.on('input', function(){
            //     $(this).next(value).html(this.value);
            //     });
            // });
            // };

            // rangeSlider();

            function get_showservices(ispramotion)
            {
                if(ispramotion==1)
                {
                    $('#services_div').css('display','none');
                    $("#services_id_1").attr("data-parsley-required", false);
                    $("#price_1").attr("data-parsley-required", false);
                }
                else
                {
                    $('#services_div').css('display','block');
                    $("#services_id_1").attr("data-parsley-required", true);
                    $("#price_1").attr("data-parsley-required", true);
                }
            } 
            </script>
        </body>
    </html>
    <?php


}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>
