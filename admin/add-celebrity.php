<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1)
{
    $module_full_name = 'Celebrity';
    $module_short_name = 'Celebrity';
    $module_name = 'celebrity';
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $company_title; ?> - Add <?php echo $module_full_name; ?></title>
        <?php include('common/header-css.php'); ?>
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
        if ($side_menu_state == 0)
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
                        <i class="icon-arrow-right13"></i> Add <?php echo $module_short_name; ?>
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
                                <li class="active">Add <?php echo $module_short_name; ?></li>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
                <!-- /page header end -->

                <div class="content"> <!-- content Start -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Add <?php echo $module_short_name; ?></h5>

                                    <div class="heading-elements">
                                        <a href="<?php echo $base_url; ?>view-<?php echo $module_name; ?>">
                                            <button type="button" class="btn bg-<?php echo $theme_color; ?> heading-btn">
                                                <i class="icon-file-eye position-left"></i> View All <?php echo $module_full_name; ?>
                                            </button>
                                        </a>
                                    </div>

                                </div>

                                <div class="panel-body">

                                    <form id="<?php echo $module_name; ?>_form" method="POST" data-parsley-validate>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>User Type : <span class="text-danger">*</span></label>
                                                    <select class="select form-control" id="user_type" name="user_type" data-parsley-required="true">
                                                        <option value="">Seelct User Type</option>
                                                        <option value="2" selected>Celebrity</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>First name : <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name"  data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Last name : <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                                           placeholder="Enter last name" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Email : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" id="email"
                                                           name="email"
                                                           placeholder="Enter email"
                                                           data-type="email"
                                                           data-parsley-required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Password : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="password" class="form-control" id="password"
                                                           name="password"
                                                           placeholder="Enter password"
                                                           data-parsley-required="true">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Gender : <span
                                                                class="text-danger">*</span></label>
                                                    <select class="select form-control" id="gender"
                                                            name="gender">
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Mobile : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="mobile"
                                                           name="mobile"
                                                           placeholder="Enter mobile"
                                                           data-parsley-required="true"
                                                           onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                           maxlength="10"
                                                           minlength="10">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>DOB : <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control pickadate-accessibility"  name="date_of_birthday" id="date_of_birthday" data-parsley-required="true"  placeholder="Date of birth">
                                                    <div class="form-control-feedback">
                                                        <i class="icon-collender text-muted"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                                    <select class="select form-control" id="category_id" multiple="multiple"
                                                            name="category_id[]" data-placeholder="Select a Category..." onchange="get_subcategory();">
                                                        <option value=""> select category</option>
                                                        <?php foreach ($all_category_data_array as $all_category_data)
                                                        { ?>
                                                            <option value="<?php echo $all_category_data['id']; ?>">
                                                                <?php echo $all_category_data['category_name']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3" id="subcategory_div">
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
                                                            name="giftcat_id[]" data-placeholder="Select a Gift Category..."  multiple="multiple" onchange="get_giftsubcategory();">
                                                            <option value=""> select Gift Category</option>
                                                    <?php foreach ($all_gift_cat_data_array as $all_gift_cat_data)
                                                    { ?>
                                                        <option value="<?php echo $all_gift_cat_data['id']; ?>">
                                                            <?php echo $all_gift_cat_data['gift_name']; ?>
                                                        </option>
                                                    <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3" id="giftsubcategory_div">
                                               
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="col-md-3" id="giftsubsubcategory_div"></div> 
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
                                                            name="language_spoken[]" data-placeholder="Select a Spoken Language...">
                                                        <option value=""> select Spoken Language</option>
                                                        <?php foreach ($all_spoken_language_data_array as $all_spoken_language_data)
                                                        { ?>
                                                            <option value="<?php echo $all_spoken_language_data['language_name']; ?>">
                                                                <?php echo $all_spoken_language_data['language_name']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>        
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="price" style="color:#000">Brand Celebration Price : </label>
                                                <input type="text" name="brand_celebration_price" data-parsley-required="true" id="brand_celebration_price" class="form-control" placeholder="Brand Celebration Price">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="price" style="color:#000">Brand Pramotion : </label>
                                                <select class="form-control" name="is_pramotion" id="is_pramotion" onchange="get_showservices(this.value)">
                                                    <option value="">Select Brand Pramotion</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" id="services_div">
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
                                                <select class="select-search form-control" id="services_id_1"
                                                        name="services_id_1" data-placeholder="Select a Services...">
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
                                                <input type="text" class="form-control" id="discount_1"  name="discount_1" placeholder="Enter Discount">
                                            </div>    
                                            <div class="col-md-1" id="addbotton">
                                                <a onclick="add_price_entry(2)" style="cursor:pointer">
                                                    <img src="<?php echo $base_url_images;?>plus.png" style="margin-top: 32px;">
                                                </a>
                                            </div>
                                        </div>
                                         <div id="price_div"></div> <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>FUll Description : <span class="text-danger">*</span></label>
                                                    <textarea type="text" class="form-control" name="full_description"
                                                        placeholder="Enter Full Description " rows="5" maxlength="500"></textarea>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Facebook URL :</label>
                                                    <input type="text" class="form-control"id="facebook_link" name="facebook_link"
                                                            placeholder="Enter Facebook ">                                                
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Twitter URL :</label>
                                                    <input type="text" class="form-control"id="twitter_link" name="twitter_link"
                                                            placeholder="Enter Twitter ">                                                
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Instagram URL :</label>
                                                    <input type="text" class="form-control"id="instagram_link" name="instagram_link"
                                                            placeholder="Enter Instagram ">                                                
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Whatsapp URL :</label>
                                                    <input type="text" class="form-control"id="whatsapp_link" name="whatsapp_link"
                                                            placeholder="Enter Whatsapp ">                                                
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Linkdin URL :</label>
                                                    <input type="text" class="form-control"id="linkedin_link" name="linkedin_link"
                                                            placeholder="Enter Linkdin ">                                                
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Google URL :</label>
                                                    <input type="text" class="form-control"id="google_link" name="google_link"
                                                            placeholder="Enter Google ">                                                
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Meta Title :</label>
                                                    <input type="text" class="form-control"id="meta_title" name="meta_title"
                                                            placeholder="Enter Meta Title ">                                                
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Profile Details Link :</label>
                                                    <input type="text" class="form-control"id="profile_link_url" name="profile_link_url"
                                                            placeholder="Enter Profile Details Link ">                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Meta Description :</label>
                                                    <textarea type="text" class="form-control"id="meta_description" name="meta_description"
                                                            placeholder="Enter Meta Description "></textarea>                                             
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Your follower rang(K) :</label>
                                                <input class="form-control" type="text" data-parsley-required="true" name="follower_count" id="follower_count" placeholder="Enter Follower">
                                                <!-- <div class="range-slider">
                                                    <input class="range-slider__range" type="range" data-parsley-required="true" name="follower_count" id="follower_count"  value="1000" min="1000" max="10000000">
                                                    <span class="range-slider__value">0K</span>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Meta Keywords :</label>
                                                    <input id="search_keywords" name="search_keywords[]" type="text"  class="form-control tags"  placeholder="Enter Search Terms"/>
                                                    <span class="help-block">Note:Help someone to find your celebrity_detailss - Use the 13 tags to optimize your listings.</span>
                                                    <div id="tag_error_div">
                                                    </div>                                             
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Share Payment (percentage) :</label>
                                                    <input type="text" class="form-control"id="payment_percentage" name="payment_percentage"
                                                            placeholder="Enter Share Payment (percentage)">                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label" style="">Upload profile pic (Image Size 193X268PX and 2MB) :</label>
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
                                                                        <img src="<?php echo $base_url_images; ?>default_profile.jpg"
                                                                                    style="margin-bottom:20px;width:150px;height:150px;">
                                                                        <div style="clear:both"></div>
                                                                        <center><a class="" style="cursor:pointer" onclick="delete_upload(<?php echo $i; ?>)">
                                                                                <i class="icon icon-subtract"></i>
                                                                                <div style="clear:both"></div>
                                                                                DELETE
                                                                            </a></center>
                                                                    </ul>
                                                                    <input type="hidden" name="file_name<?php echo $i; ?>" id="file_name<?php echo $i; ?>"
                                                                            value="">
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="status" class="styled" id="status" value="1" checked="checked">
                                                        Active
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top:25px">
                                            <div class="text-left">
                                                <button type="reset" class="btn btn-default" id="user_reset"><i class=" icon-undo position-left"></i> Reset</button>
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
            $('#date_of_birthday').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'DD-MM-YYYY'
                }
            }).val('');

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
                            url: "<?php echo $base_url; ?>add-<?php echo $module_name; ?>-submit.php",
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
                                    $('#<?php echo $module_name; ?>_form').trigger("reset");
                                    $('#<?php echo $module_name; ?>_form').parsley().destroy();
                                    $.notifyBar({cssClass: "success", html: data.html_message});
                                    setTimeout(function ()
                                    {
                                        window.top.location="<?php echo $base_url; ?>view-celebrity";
                                    }, 2000);
                                }
                                else
                                {
                                    $.notifyBar({cssClass: "error", html: data.html_message});
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

        $("#user_reset").click(function ()
        {
            $('#<?php echo $module_name; ?>_form').parsley().destroy();
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
                            $('#sub_category_id').attr('data-parsley-required', 'false').select2();
                            
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
                            $('#giftsubcat_id').attr('data-parsley-required', 'false').select2();
                            
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
                            $('#giftsubsubcat_id').attr('data-parsley-required', 'false').select2();
                            
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
                        $('<li></li>').add('#files<?php echo $i; ?>').html('<img src="<?php echo $cele_base_path_uploads ;?>profile-pic/size_450/' + file + '" style="margin-bottom:10px;width:150px;height:150px;"  alt="" /><div style="clear:both"></div><center><a class="" style="cursor:pointor" onclick="delete_upload(<?php echo $i;?>)"><i class="icon icon-subtract"></i><div style="clear:both"></div>DELETE </a></center>').addClass('success');
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

        $('#files' + delete_file_id).html('<center style="margin-top: 20px;"><i class="icon icon-add"></i><div style="clear:both"></div>ADD <br/> PHOTOS </center>');
        $('#file_name' + delete_file_id).val("");
    }

    var z = 1;
    var price_entry_list_array = [1];
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
    //     var slider = $('.range-slider'),
    //         range = $('.range-slider__range'),
    //         value = $('.range-slider__value');
            
    //     slider.each(function(){

    //         value.each(function(){
    //         var value = $(this).prev().attr('value');
    //         $(this).html(value);
    //         });

    //         range.on('input', function(){
    //         $(this).next(value).html(this.value);
    //         });
    //     });
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
