<?php
include 'common/config.php';
include 'common/check_login.php';
//include 'add-city.php';
if ($admin == 1 || ($sub_admin == 1 && $is_city_write == 1))
{
    if (isset($_GET['id']) && $_GET['id'] > 0)
    {
        $module_full_name = 'City';
        $module_short_name = 'City';
        $module_name = 'city';

        $edit_id = $_GET['id'];
//        print_r($edit_id);
//        exit();

        $edit_data_array = array();
        $get_city_query = "select * from cities where id='$edit_id' and is_deleted='0'";
        $result_get_city_query = mysqli_query($db_mysqli, $get_city_query);
        while ($row_get_city_query = mysqli_fetch_assoc($result_get_city_query))
        {
            $edit_data_array[] = $row_get_city_query;
        }
//        print_r($edit_data_array);
//        exit();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title><?php echo $company_title; ?> - Edit <?php echo $module_full_name; ?></title>
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
                                <div class="panel panel-default"
                                >
                                    <div class="panel-heading">
                                        <h5 class="panel-title">Edit <?php echo $module_short_name; ?></h5>

                                        <div class="heading-elements">
                                            <a href="<?php echo $base_url; ?>view-<?php echo $module_name; ?>">
                                                <button type="button" class="btn bg-<?php echo $theme_color; ?> heading-btn">
                                                    <i class="icon-file-eye position-left"></i> View All <?php echo $module_full_name; ?>
                                                </button>
                                            </a>
                                        </div>

                                    </div>

                                    <div class="panel-body">

                                        <?php if (count($edit_data_array) > 0)
                                        { ?>
                                            <form id="<?php echo $module_name; ?>_form" method="POST" data-parsley-validate>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Select Country : <span
                                                                    class="text-danger">*</span></label>

                                                            <?php
                                                            $all_country_data_array = array();
                                                            $get_country_query = "SELECT * FROM country WHERE  is_deleted='0'";
                                                            $result_get_country_query = mysqli_query($db_mysqli, $get_country_query);
                                                            while ($row_get_country_query = mysqli_fetch_assoc($result_get_country_query))
                                                            {
                                                                $all_country_data_array[] = $row_get_country_query;
                                                            }

                                                            $all_country_id_data_array = array();
                                                            $state_id = $edit_data_array[0]['state_id'];
                                                            $get_country_id_query = "select country_id from states where id=$state_id and is_deleted='0'";
                                                            $result_get_country_id_query = mysqli_query($db_mysqli, $get_country_id_query);
                                                            while ($row_get_country_id_query = mysqli_fetch_assoc($result_get_country_id_query))
                                                            {
                                                                $all_country_id_data_array[] = $row_get_country_id_query;
                                                            }

                                                            $country_id = $all_country_id_data_array[0]['country_id'];

                                                            ?>
                                                            <select class="select-search form-control" id="country_id"
                                                                    name="country_id"
                                                                    onchange="get_state(this.value, 0)">
                                                                <!--                                                                <option value=""> select country</option>-->
                                                                <?php foreach ($all_country_data_array as $all_country_data)
                                                                { ?>
                                                                    <option
                                                                        value="<?php echo $all_country_data['id']; ?>"
                                                                        <?php if ($all_country_data['id'] == $country_id)
                                                                        {
                                                                            echo " selected='selected'";
                                                                        } ?>>
                                                                        <?php echo $all_country_data['country_name']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" id="state_div">
                                                        <div class="form-group">
                                                            <label>Select State : <span
                                                                    class="text-danger">*</span></label>


                                                            <?php
                                                            $all_state_data_array = array();
                                                            $get_state_query = "select * from states where country_id=$country_id and is_deleted='0'";
                                                            $result_get_state_query = mysqli_query($db_mysqli, $get_state_query);
                                                            while ($row_get_state_query = mysqli_fetch_assoc($result_get_state_query))
                                                            {
                                                                $all_state_data_array[] = $row_get_state_query;
                                                            }

                                                            $state_id = $edit_data_array[0]['state_id'];


                                                            ?>
                                                            <select class="select-search form-control" id="state_id"
                                                                    name="state_id"">
                                                            <?php foreach ($all_state_data_array as $all_state_data)
                                                            { ?>
                                                                <option
                                                                    value="<?php echo $all_state_data['id']; ?>"
                                                                    <?php if ($all_state_data['id'] == $edit_data_array[0]['state_id'])
                                                                    {
                                                                        echo " selected='selected'";
                                                                    } ?>>
                                                                    <?php echo $all_state_data['state_name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>City : <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="state_title"
                                                                   name="city_title"
                                                                   value="<?php echo $edit_data_array[0]['city_name']; ?>"
                                                                   placeholder="Enter <?php echo $module_full_name; ?>"
                                                                   data-parsley-required="true">

                                                            <input type="hidden" name="edit_id" id="edit_id"
                                                                   value="<?php echo $edit_id; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">

                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="status" class="styled" id="status" value="1" <?php if ($edit_data_array[0]['status'] == 1)
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
                                url: "<?php echo $base_url; ?>edit-<?php echo $module_name; ?>-submit.php",
                                type: "POST",
                                data: $('#<?php echo $module_name; ?>_form').serialize(),
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
                                        setTimeout(function ()
                                        {
                                            window.top.location="<?php echo $base_url; ?>view-city";
                                        }, 2000);
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


            function get_state(country_id, edit_flag=0)
            {
                $('#<?php echo $module_name; ?>_form').parsley().destroy();
                var formData =
                {
                    'country_id': country_id,
                    'edit_flag': edit_flag
                };
                $.ajax(
                    {
                        url: "<?php echo $base_url; ?>get_state.php",
                        type: "POST",
                        data: formData,
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
                                $('#state_div').html(data.html_message);
                                $('#state_id').attr('data-parsley-required', 'true').select2();
//                                $('select').select2('');
                                //$.notifyBar({cssClass: "success", html: data.html_message});
                                //dataTable.ajax.reload();
                            }
                            else
                            {
                                $.notifyBar({cssClass: "error", html: data.html_message});
                                //dataTable.ajax.reload();
                            }
                        }
                    });
                $('#<?php echo $module_name; ?>_form').parsley();
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
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>