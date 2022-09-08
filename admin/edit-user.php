<?php
include 'common/config.php';
include 'common/check_login.php';

if ($admin == 1)
{
    if (isset($_GET['id']))
    {
        $module_full_name = "User";
        $module_short_name = "User";
        $module_name = "user";
        
        $edit_id = $_GET['id'];

        $edit_data_array = array();
        $get_user_query = "select * from user where id='$edit_id' and is_deleted='0'";
        $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
        while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
        {
            $edit_data_array[] = $row_get_user_query;
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
                            <i class="icon-arrow-right13"></i> User
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
                                                        <select class="select form-control" id="user_type" name="user_type" >
                                                            <option value="">Seelct User Type</option>
                                                            <option value="3" <?php if($edit_data_array[0]['user_type']==3){ echo 'selected';} ?> selected>User</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>First name : <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="first_name" value="<?php echo $edit_data_array[0]['first_name'] ?>" name="first_name" placeholder="Enter first name"  >
                                                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Last name : <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                                            placeholder="Enter last name" value="<?php echo $edit_data_array[0]['last_name'] ?>" >
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
                                                             value="<?php echo $edit_data_array[0]['email'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Gender : <span
                                                                    class="text-danger">*</span></label>
                                                        <select class="select form-control" id="gender"
                                                                name="gender">
                                                            <option value="male" <?php if($edit_data_array[0]['gender'] == 'male'){ echo 'selected';} ?>>Male</option>
                                                            <option value="female" <?php if($edit_data_array[0]['gender'] == 'female'){ echo 'selected';} ?>>Female</option>
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
                                                            
                                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                            maxlength="10"
                                                            minlength="10" value="<?php echo $edit_data_array[0]['mobile'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>DOB : <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control pickadate-accessibility" value="<?php echo date('d-m-Y', strtotime($edit_data_array[0]['dob'])); ?>"  name="date_of_birthday" id="date_of_birthday"   placeholder="Date of birth">
                                                        <div class="form-control-feedback">
                                                            <i class="icon-collender text-muted"></i>
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
       <script type="text/javascript">
            $(document).ready(function ()
            {
                $('#date_of_birthday').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    locale: {
                        format: 'DD-MM-YYYY'
                    }
                });

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
                                            window.top.location="<?php echo $base_url; ?>view-user"
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