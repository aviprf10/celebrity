<?php
include 'common/config.php';
include 'common/check_login.php';
if ($celebrity == 1)
{
    if (1 == 1)
    {
        $module_full_name = 'Account Settings';
        $module_short_name = 'Account Settings';
        $module_name = 'account-settings';

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
                                    <div class="panel-heading">
                                        <h5 class="panel-title">Edit <?php echo $module_short_name; ?></h5>
                                    </div>

                                    <div class="panel-body">

                                        <?php if (1 == 1)
                                        { ?>

                                            <div class="panel-group content-group-lg" id="accordion1">
                                                <div class="panel panel-white">
                                                    <a data-toggle="collapse" data-parent="#accordion1"
                                                       href="<?php echo $base_url; ?>account-settings.php#accordion-group1"
                                                       aria-expanded="false" class="collapsed">
                                                        <div class="panel-heading" style="height:40px">
                                                            <h6 class="panel-title">
                                                                <i class="icon-user position-left"></i>Basic
                                                                Details
                                                            </h6>
                                                        </div>
                                                    </a>
                                                    <div id="accordion-group1" class="panel-collapse collapse" aria-expanded="false"
                                                         style="height: 0px;">
                                                        <div class="panel-body">
                                                            <form class="form-basic" method="POST" id="basic_details_form" data-parsley-validate>
                                                                <fieldset>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>First Name: <span class="text-danger">*</span></label>
                                                                                <input type="hidden" name="edit_user_id"
                                                                                       value="<?php echo $all_user_data_array[0]['id']; ?>"
                                                                                       class="form-control">
                                                                                <input type="hidden" name="edit_user_unique_slug"
                                                                                       value="<?php echo $all_user_data_array[0]['user_unique_slug']; ?>"
                                                                                       class="form-control">
                                                                                <input type="text" name="first_name" id="first_name"
                                                                                       value="<?php echo $all_user_data_array[0]['first_name']; ?>"
                                                                                       class="form-control" placeholder="Enter Your First Name"
                                                                                       data-parsley-required="true">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Last Name: <span class="text-danger">*</span></label>
                                                                                <input type="text" name="last_name" id="last_name"
                                                                                       value="<?php echo $all_user_data_array[0]['last_name']; ?>"
                                                                                       class="form-control" placeholder="Enter Your Last Name"
                                                                                       data-parsley-required="true">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label>Email address: <span class="text-danger">*</span></label>
                                                                            <input type="email" name="email"
                                                                                   value="<?php echo $all_user_data_array[0]['email']; ?>"
                                                                                   class="form-control"
                                                                                   placeholder="Enter Your Email" data-type="email"
                                                                                   data-parsley-required="true">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="control-label">Mobile No: <span
                                                                                            class="text-danger">*</span></label>
                                                                                <input type="text" name="mobile"
                                                                                       value="<?php echo $all_user_data_array[0]['mobile']; ?>"
                                                                                       placeholder="Enter Your Mobile No."
                                                                                       onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                                       class="form-control" maxlength="10"
                                                                                       minlength="10"
                                                                                       data-parsley-required="true">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">

                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="status" class="styled" id="status" value="1" <?php if ($all_user_data_array[0]['status'] == 1)
                                                                                        {
                                                                                            echo "checked";
                                                                                        } ?>>
                                                                                        Active
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">

                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="is_deleted" class="styled" id="is_deleted" value="1" <?php if ($all_user_data_array[0]['is_deleted'] == 1)
                                                                                        {
                                                                                            echo "checked";
                                                                                        } ?>>
                                                                                        Is Deleted
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>    
                                                                </fieldset>
                                                                <!--                                                                <div class="form-wizard-actions">-->
                                                                <!--                                                                    <input class="btn btn-default" id="basic-back" value="Clear" type="reset">-->
                                                                <!--                                                                    <input class="btn bg-slate-800" id="basic-next" value="Submit" type="submit">-->
                                                                <!--                                                                </div>-->

                                                                <div style="margin-top:25px">
                                                                    <div class="text-left">
                                                                        <button type="submit" class="btn bg-<?php echo $theme_color; ?>">Submit <i class="icon-arrow-right14 position-right"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-white">
                                                    <a data-toggle="collapse" data-parent="#accordion1"
                                                       href="<?php echo $base_url; ?>account-settings.php#accordion-group2"
                                                       aria-expanded="false" class="collapsed">
                                                        <div class="panel-heading" style="height:40px">
                                                            <h6 class="panel-title">
                                                                <i class="icon-key position-left"></i>Change
                                                                Password Details
                                                            </h6>
                                                        </div>
                                                    </a>
                                                    <div id="accordion-group2" class="panel-collapse collapse" aria-expanded="false"
                                                         style="height: 0px;">
                                                        <div class="panel-body">
                                                            <form class="form-basic" method="POST" id="change_password_details_form"
                                                                  data-parsley-validate>
                                                                <fieldset>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Current password: <span class="text-danger">*</span></label>
                                                                                <input type="password" name="old_password" class="form-control"
                                                                                       placeholder="Current Password" data-parsley-required="true"
                                                                                       minlength="6">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>New password: <span class="text-danger">*</span></label>
                                                                                <input type="password" name="new_password" id="new_password" class="form-control"
                                                                                       placeholder="New Password" data-parsley-required="true"
                                                                                       minlength="6">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label>Repeat New password: <span class="text-danger">*</span></label>
                                                                            <input type="password" name="repeat_password" class="form-control"
                                                                                   placeholder="Repeat New Password" data-parsley-required="true"
                                                                                   minlength="6" data-parsley-equalto="#new_password">
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <!--                                                                <div class="form-wizard-actions">-->
                                                                <!--                                                                    <input class="btn btn-default" id="basic-back" value="Clear" type="reset">-->
                                                                <!--                                                                    <input class="btn bg-slate-800" id="basic-next" value="Submit" type="submit">-->
                                                                <!--                                                                </div>-->
                                                                <div style="margin-top:25px">
                                                                    <div class="text-left">
                                                                        <button type="submit" class="btn bg-<?php echo $theme_color; ?>">Submit <i class="icon-arrow-right14 position-right"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-white" style="display: none">
                                                    <a class="" data-toggle="collapse" data-parent="#accordion1"
                                                       href="<?php echo $base_url; ?>account-settings.php#accordion-group3"
                                                       aria-expanded="true">
                                                        <div class="panel-heading" style="height:40px">
                                                            <h6 class="panel-title">
                                                                <i class="icon-location3 position-left"></i>Address Details
                                                            </h6>
                                                        </div>
                                                    </a>
                                                    <div id="accordion-group3" class="panel-collapse collapse" aria-expanded="false"
                                                         style="height: 0px;">
                                                        <div class="panel-body">
                                                            <form class="form-basic" method="POST" id="address_details_form"
                                                                  data-parsley-validate>
                                                                <fieldset>
                                                                    <div class="row">

                                                                        <?php
                                                                        if ($all_user_data_array[0]['country_id'] > 0)
                                                                        { ?>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label>Country: <span class="text-danger">*</span></label>
                                                                                    <select name="address_details_form_country_id"
                                                                                            id="address_details_form_country_id"
                                                                                            data-placeholder="Select country" class="select-search form-control"
                                                                                            data-parsley-required="true"
                                                                                            onchange="get_state_selection(this.value,'address_details_form')">
                                                                                        <?php
                                                                                        $all_country_data_array = array();
                                                                                        $get_country_query = "SELECT * FROM country WHERE is_deleted='0'";
                                                                                        $result_get_country_query = mysqli_query($db_mysqli, $get_country_query);
                                                                                        while ($row_get_country_query = mysqli_fetch_assoc($result_get_country_query))
                                                                                        {
                                                                                            $all_country_data_array[] = $row_get_country_query;
                                                                                        }
                                                                                        if (count($all_country_data_array) > 0)
                                                                                        {
                                                                                            ?>
                                                                                            <optgroup label="All country">
                                                                                                <option value="">Select country</option>
                                                                                                <?php
                                                                                                foreach ($all_country_data_array as $all_country_data)
                                                                                                {
                                                                                                    if ($all_country_data['country_name'] != '' && isset($all_country_data['country_name']))
                                                                                                    {
                                                                                                        ?>
                                                                                                        <option
                                                                                                                value="<?php echo $all_country_data['id']; ?>"
                                                                                                            <?php if ($all_country_data['id'] == $all_user_data_array[0]['country_id'])
                                                                                                            {
                                                                                                                echo " selected='selected'";
                                                                                                            } ?>><?php echo $all_country_data['country_name']; ?></option>
                                                                                                        <?php
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                                                                            </optgroup>
                                                                                            <?php
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        <?php }
                                                                        else
                                                                        { ?>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label>Country: <span class="text-danger">*</span></label>
                                                                                    <select name="address_details_form_country_id"
                                                                                            id="address_details_form_country_id"
                                                                                            data-placeholder="Select Country" class="select-search form-control"
                                                                                            data-parsley-required="true"
                                                                                            onchange="get_state_selection(this.value,'address_details_form')">
                                                                                        <?php
                                                                                        $all_country_data_array = array();
                                                                                        $get_country_query = "SELECT * FROM country WHERE is_deleted='0'";
                                                                                        $result_get_country_query = mysqli_query($db_mysqli, $get_country_query);
                                                                                        while ($row_get_country_query = mysqli_fetch_assoc($result_get_country_query))
                                                                                        {
                                                                                            $all_country_data_array[] = $row_get_country_query;
                                                                                        }
                                                                                        if (count($all_country_data_array) > 0)
                                                                                        {
                                                                                            ?>
                                                                                            <optgroup label="All Country">
                                                                                                <option value="">Select Country</option>
                                                                                                <?php
                                                                                                foreach ($all_country_data_array as $all_country_data)
                                                                                                {
                                                                                                    if ($all_country_data['country_name'] != '' && isset($all_country_data['country_name']))
                                                                                                    {
                                                                                                        ?>
                                                                                                        <option
                                                                                                                value="<?php echo $all_country_data['id']; ?>"><?php echo $all_country_data['country_name']; ?></option>
                                                                                                        <?php
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                                                                            </optgroup>
                                                                                            <?php
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>



                                                                        <div class="col-md-4" id="address_details_form_state_selection_div">
                                                                            <?php
                                                                            if ($all_user_data_array[0]['state_id'] > 0)
                                                                            { ?>
                                                                            <!--                                                <div class="col-md-4">-->
                                                                            <div class="form-group">
                                                                                <label>State: <span class="text-danger">*</span></label>
                                                                                <select name="address_details_form_state_id"
                                                                                        id="address_details_form_state_id"
                                                                                        data-placeholder="Select state" class="select-search form-control"
                                                                                        data-parsley-required="true"
                                                                                        onchange="get_city_selection(this.value,'address_details_form')">
                                                                                    <?php
                                                                                    $all_state_data_array = array();
                                                                                    $country_id = $all_user_data_array[0]['country_id'];
                                                                                    $get_state_query = "SELECT * FROM states WHERE country_id='$country_id' AND is_deleted='0'";
                                                                                    $result_get_state_query = mysqli_query($db_mysqli, $get_state_query);
                                                                                    while ($row_get_state_query = mysqli_fetch_assoc($result_get_state_query))
                                                                                    {
                                                                                        $all_state_data_array[] = $row_get_state_query;
                                                                                    }
                                                                                    if (count($all_state_data_array) > 0)
                                                                                    {
                                                                                        ?>
                                                                                        <optgroup label="All state">
                                                                                            <option value="">Select State</option>
                                                                                            <?php
                                                                                            foreach ($all_state_data_array as $all_state_data)
                                                                                            {
                                                                                                if ($all_state_data['state_name'] != '' && isset($all_state_data['state_name']))
                                                                                                {
                                                                                                    ?>
                                                                                                    <option
                                                                                                            value="<?php echo $all_state_data['id']; ?>"
                                                                                                        <?php if ($all_state_data['id'] == $all_user_data_array[0]['state_id'])
                                                                                                        {
                                                                                                            echo " selected='selected'";
                                                                                                        } ?>><?php echo $all_state_data['state_name']; ?></option>
                                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                        </optgroup>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <?php }
                                                                        ?>

                                                                        <div class="col-md-4" id="address_details_form_city_selection_div">
                                                                            <?php
                                                                            if ($all_user_data_array[0]['city_id'] > 0)
                                                                            { ?>
                                                                            <div class="form-group">
                                                                                <label>City: <span class="text-danger">*</span></label>
                                                                                <select name="address_details_form_city_id"
                                                                                        id="address_details_form_city_id"
                                                                                        data-placeholder="Select city" class="select-search form-control"
                                                                                        data-parsley-required="true">
                                                                                    <?php
                                                                                    $all_city_data_array = array();
                                                                                    $state_id = $all_user_data_array[0]['state_id'];
                                                                                    $get_city_query = "SELECT * FROM cities WHERE state_id='$state_id' AND is_deleted='0'";
                                                                                    $result_get_city_query = mysqli_query($db_mysqli, $get_city_query);
                                                                                    while ($row_get_city_query = mysqli_fetch_assoc($result_get_city_query))
                                                                                    {
                                                                                        $all_city_data_array[] = $row_get_city_query;
                                                                                    }
                                                                                    if (count($all_city_data_array) > 0)
                                                                                    {
                                                                                        ?>
                                                                                        <optgroup label="All city">
                                                                                            <option value="">Select city</option>
                                                                                            <?php
                                                                                            foreach ($all_city_data_array as $all_city_data)
                                                                                            {
                                                                                                if ($all_city_data['city_name'] != '' && isset($all_city_data['city_name']))
                                                                                                {
                                                                                                    ?>
                                                                                                    <option
                                                                                                            value="<?php echo $all_city_data['id']; ?>"
                                                                                                        <?php if ($all_city_data['id'] == $all_user_data_array[0]['city_id'])
                                                                                                        {
                                                                                                            echo " selected='selected'";
                                                                                                        } ?>><?php echo $all_city_data['city_name']; ?></option>
                                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                        </optgroup>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    <?php }
                                                                    ?>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="control-label">Pincode: <span
                                                                                            class="text-danger">*</span></label>
                                                                                <input type="text" name="pincode" id="pincode"
                                                                                       value="<?php echo $all_user_data_array[0]['pincode']; ?>"
                                                                                       placeholder="Enter Your Pincode"
                                                                                       onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                                       class="form-control" data-rangelength="[6,6]"
                                                                                       data-parsley-type="integer" data-parsley-required="true">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Landmark: <span class="text-danger">*</span></label>
                                                                                <input type="text" name="landmark" id="landmark"
                                                                                       value="<?php echo $all_user_data_array[0]['landmark']; ?>"
                                                                                       class="form-control" placeholder="Enter Your Landmark"
                                                                                       data-parsley-required="true">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Address 1: <span class="text-danger">*</span></label>
                                                                                <textarea rows="2" cols="5" name="address1" class="form-control"
                                                                                          placeholder="Address"
                                                                                          data-parsley-required="true"><?php echo $all_user_data_array[0]['address1']; ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Address 2: </label>
                                                                                <textarea rows="2" cols="5" name="address2" class="form-control"
                                                                                          placeholder="Address"><?php echo $all_user_data_array[0]['address2']; ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <div style="margin-top:25px">
                                                                    <div class="text-left">
                                                                        <button type="submit" class="btn bg-<?php echo $theme_color; ?>">Submit <i class="icon-arrow-right14 position-right"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-white">
                                                    <a data-toggle="collapse" data-parent="#accordion1"
                                                       href="<?php echo $base_url; ?>account-settings.php#accordion-group4"
                                                       aria-expanded="false" class="collapsed">
                                                        <div class="panel-heading" style="height:40px">
                                                            <h6 class="panel-title">
                                                                <i class="icon-key position-left"></i>Display preferences
                                                            </h6>
                                                        </div>
                                                    </a>
                                                    <div id="accordion-group4" class="panel-collapse collapse" aria-expanded="false"
                                                         style="height: 0px;">
                                                        <div class="panel-body">
                                                            <form class="form-basic" method="POST" id="display_preferences_form"
                                                                  data-parsley-validate>
                                                                <fieldset>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Theme color: <span class="text-danger">*</span></label>
                                                                                <?php
                                                                                $all_theme_color_array = ['pink', 'violet', 'purple', 'indigo', 'blue', 'teal', 'green', 'orange', 'brown', 'grey', 'slate'];
                                                                                ?>

                                                                                <select class="form-control select-search" id="theme_color"
                                                                                        name="theme_color">
                                                                                    <?php
                                                                                    foreach ($all_theme_color_array as $selected_theme_color)
                                                                                    { ?>
                                                                                        <option <?php if ($all_user_data_array[0]['theme_color'] == $selected_theme_color) echo " selected='selected'" ?>
                                                                                                value="<?php echo $selected_theme_color ?>"><?php echo $selected_theme_color ?></option>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Theme layout: <span class="text-danger">*</span></label>
                                                                                <select class="form-control select" id="theme_layout"
                                                                                        name="theme_layout">
                                                                                    <option value="1" <?php if ($all_user_data_array[0]['theme_layout'] == 1)
                                                                                    {
                                                                                        echo " selected='selected'";
                                                                                    } ?>>Layout 1 - Top menu
                                                                                    </option>
                                                                                    <option value="2" <?php if ($all_user_data_array[0]['theme_layout'] == 2)
                                                                                    {
                                                                                        echo " selected='selected'";
                                                                                    } ?>>Layout 2 - Side menu
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </fieldset>


                                                                <div style="margin-top:25px">
                                                                    <div class="text-left">
                                                                        <button type="submit" class="btn bg-<?php echo $theme_color; ?>">Submit <i class="icon-arrow-right14 position-right"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php }
                                        else
                                        { ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p>No <?php echo $module_full_name; ?> Exists.</p>
                                                </div>
                                            </div>

                                        <?php } ?>

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
        <script type="text/javascript">
            $(document).ready(function ()
            {
                //basic_details_form action

                $('#basic_details_form').parsley();
                $('#basic_details_form').on('submit', function (e)
                {
//                    debugger;
                    e.preventDefault();
                    var f = $(this);
                    f.parsley().validate();
                    if (f.parsley().isValid())
                    {
                        $.ajax(
                            {
                                url: "<?php echo $base_url;?>basic-details-submit.php",
                                type: "POST",
                                data: $('#basic_details_form').serialize(), // our data object
                                dataType: 'json', // what type of data do we expect back from the server
                                encode: true,
                                beforeSend: function ()
                                {
                                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" />'});
                                },
                                success: function (data)
                                {
                                    $.unblockUI();
                                    if (data.status == 'success')
                                    {
                                        $('#basic_details_form').parsley().destroy();
                                        $.notifyBar({cssClass: "success", html: data.html_message});
                                        if(data.is_status == '1')
                                        {
                                            setTimeout(function ()
                                            {
                                                window.location.href = '<?php echo $base_url ?>logout';
                                            }, 2000);
                                        }
                                        if(data.is_deleted == '1')
                                        {
                                            setTimeout(function ()
                                            {
                                                window.location.href = '<?php echo $base_url ?>logout';
                                            }, 2000);
                                        }
                                    }
                                    else
                                    {
                                        $.notifyBar({cssClass: "error", html: data.html_message});
                                    }
                                }
                            });
                    }
                    else
                    {
                        e.preventDefault();
                    }
                });

                //change_password_details_form action
                $('#change_password_details_form').parsley();
                $('#change_password_details_form').on('submit', function (e)
                {
                    e.preventDefault();
                    var f = $(this);
                    f.parsley().validate();
                    if (f.parsley().isValid())
                    {
                        $.ajax(
                            {
                                url: "<?php echo $base_url;?>edit-password-submit.php",
                                type: "POST",
                                data: $('#change_password_details_form').serialize(),
                                dataType: 'json',
                                encode: true,
                                beforeSend: function ()
                                {
                                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" />'});
                                },
                                success: function (data)
                                {
                                    $.unblockUI();
                                    if (data.status == 'success')
                                    {
                                        $('#change_password_details_form').parsley().destroy();
                                        $.notifyBar({cssClass: "success", html: data.html_message});
                                    }
                                    else
                                    {
                                        $.notifyBar({cssClass: "error", html: data.html_message});
                                    }
                                }
                            });
                    }
                    else
                    {
                        e.preventDefault();
                    }
                });


                //address_details_form action
                $('#address_details_form').parsley();
                $('#address_details_form').on('submit', function (e)
                {
                    e.preventDefault();
                    var f = $(this);
                    f.parsley().validate();
                    if (f.parsley().isValid())
                    {
                        $.ajax(
                            {
                                url: "<?php echo $base_url;?>address-details-submit.php",
                                type: "POST",
//                            data: $('#' + form_id + '').serialize(),
                                data: $('#address_details_form').serialize(),
                                dataType: 'json',
                                encode: true,
                                beforeSend: function ()
                                {
                                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" />'});
                                },
                                success: function (data)
                                {
                                    $.unblockUI();
                                    if (data.status == 'success')
                                    {
                                        $('#address_details_form').parsley().destroy();
                                        $.notifyBar({cssClass: "success", html: data.html_message});
                                    }
                                    else
                                    {
                                        $.notifyBar({cssClass: "error", html: data.html_message});
                                    }
                                }
                            });
                    }
                    else
                    {
                        e.preventDefault();
                    }
                });

                $('#display_preferences_form').parsley();
                $('#display_preferences_form').on('submit', function (e)
                {
                    e.preventDefault();
                    var f = $(this);
                    f.parsley().validate();
                    if (f.parsley().isValid())
                    {
                        $.ajax(
                            {
                                url: "<?php echo $base_url;?>display-preferences-submit.php",
                                type: "POST",
//                            data: $('#' + form_id + '').serialize(),
                                data: $('#display_preferences_form').serialize(),
                                dataType: 'json',
                                encode: true,
                                beforeSend: function ()
                                {
                                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" />'});
                                },
                                success: function (data)
                                {
                                    $.unblockUI();
                                    if (data.status == 'success')
                                    {
                                        $.notifyBar({cssClass: "success", html: data.html_message});
                                        setTimeout(function ()
                                        {
                                            location.reload();
                                        }, 1000);
                                    }
                                    else
                                    {
                                        $.notifyBar({cssClass: "error", html: data.html_message});
                                    }
                                }
                            });
                    }
                    else
                    {
                        e.preventDefault();
                    }
                });
            });


            var form_id = '';
            function get_state_selection(country_id, form_id)
            {
                $('#address_details_form').parsley().destroy();

                if (country_id > 0)
                {
                    $.ajax({
                        url: "<?php echo $base_url;?>get-state-selection-div.php",
                        type: "POST",
                        data: {
                            "country_id": country_id,
                            "form_id": form_id
                        },
                        dataType: 'json',
                        encode: true,

                        beforeSend: function ()
                        {
                            $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" />'});
                        },
                        success: function (data)
                        {
                            $.unblockUI();
                            if (data.status === 'success')
                            {

                                $('#' + form_id + '_state_selection_div').html(data.html_message);
                                $('#' + form_id + '_city_selection_div').html("");

                                $('#' + form_id + '_state_id').attr('data-parsley-required', 'true').select2();
                            }
                            else
                            {
                                $('#' + form_id + '_state_selection_div').html("");
                            }
                        }
                    });
                }
                else
                {
                    $('#' + form_id + '_state_selection_div').html("");
                    $('#' + form_id + '_city_selection_div').html("");

                    $('#address_details_form').parsley().destroy();

                    if ($('#' + form_id + '_state_id').size() > 0)
                    {
                        $('#' + form_id + '_state_id').attr('data-parsley-required', 'false');
                    }
                    if ($('#' + form_id + '_city_id').size() > 0)
                    {
                        $('#' + form_id + '_city_id').attr('data-parsley-required', 'false');
                    }
                }
                $('#address_details_form').parsley();
            }

            function get_city_selection(state_id, form_id)
            {
                $('#address_details_form').parsley().destroy();
                if (state_id > 0)
                {

                    $.ajax({
                        url: "<?php echo $base_url;?>get-city-selection-div.php",
                        type: "POST",
                        data: {
                            "state_id": state_id,
                            "form_id": form_id
                        },
                        dataType: 'json',
                        encode: true,

                        beforeSend: function ()
                        {
                            $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" />'});
                        },
                        success: function (data)
                        {
                            $.unblockUI();

                            if (data.status == 'success')
                            {
                                $('#' + form_id + '_city_selection_div').html(data.html_message);
                                $('#' + form_id + '_city_id').attr('data-parsley-required', 'true').select2();
                            }
                            else
                            {
                                $('#' + form_id + '_city_selection_div').html("");
                            }
                        }
                    });
                }
                else
                {
                    $('#' + form_id + '_city_selection_div').html("");
                    $('#' + form_id + '_city_id').attr('data-parsley-required', 'false');
                }

                $('#address_details_form').parsley();
            }

            function delete_upload(delete_file_id)
            {
//                debugger;
                $('#files' + delete_file_id).html('<center style="margin-top: 20px;"><i class="icon icon-add"></i><div style="clear:both"></div>ADD <br/> PHOTOS </center>');
                $('#file_name' + delete_file_id).val("");
            }

            //
            //            $("#address_reset").click(function ()
            //            {
            //                $('select').select2('val', '');
            //            });
        </script>

        </body>
        </html>
        <?php
    }
    else
    {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
    }
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>