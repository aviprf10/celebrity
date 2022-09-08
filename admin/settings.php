<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1)
{
    if (1 == 1)
    {
        $module_full_name = 'Settings';
        $module_short_name = 'Settings';
        $module_name = 'settings';
        $edit_id = 1;
        $edit_data_array = array();
        $get_company_info_query = "select * from company_info WHERE id='$edit_id'";
        $result_get_company_info_query = mysqli_query($db_mysqli, $get_company_info_query);
        while ($row_get_company_info_query = mysqli_fetch_assoc($result_get_company_info_query))
        {
            $edit_data_array[] = $row_get_company_info_query;
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
                            <i class="icon-arrow-right13"></i> Company Information
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
                                    <li class="active">Company Information</li>
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
                                        <h5 class="panel-title">Company Information</h5>
                                    </div>

                                    <div class="panel-body">

                                        <?php if (1 == 1)
                                        { ?>
                                            <form id="<?php echo $module_name; ?>_form" method="POST" data-parsley-validate>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Company title : <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="company_title" name="company_title" value="<?php echo $edit_data_array[0]['company_title']; ?>"
                                                                   placeholder="Enter Company Title" data-parsley-required="true">
                                                            <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Company Description : <span class="text-danger">*</span></label>
                                                            <textarea name="company_description"
                                                                      id="company_description" rows="2" cols="2" placeholder="Enter Description" data-parsley-required="true" class="form-control"><?php echo $edit_data_array[0]['company_description']; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Address 1 : <span class="text-danger">*</span></label>
                                                            <textarea name="company_address"
                                                                      id="company_address" rows="2" cols="2" placeholder="Enter Address 1" data-parsley-required="true" class="form-control"><?php echo $edit_data_array[0]['company_address']; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Address 2 : </label>
                                                            <textarea name="company_address2" id="company_address2" rows="2" cols="2"
                                                                      placeholder="Enter Address 2" class="form-control"><?php echo $edit_data_array[0]['company_address2']; ?></textarea>
                                                        </div>
                                                    </div>
                                                   <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Country : <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="country" name="country" value="<?php echo $edit_data_array[0]['country']; ?>"
                                                                   placeholder="Enter country" data-parsley-required="true">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>State : <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="state" name="state" value="<?php echo $edit_data_array[0]['state']; ?>"
                                                                   placeholder="Enter state" data-parsley-required="true">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>City : <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="city" name="city" value="<?php echo $edit_data_array[0]['city']; ?>"
                                                                   placeholder="Enter city" data-parsley-required="true">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Pincode : <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="pincode" name="pincode" value="<?php echo $edit_data_array[0]['pincode']; ?>"
                                                                   placeholder="Enter pincode" data-parsley-required="true">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Phone number 1: </label>
                                                            <input type="text" class="form-control" id="company_mobile" name="company_mobile" value="<?php echo $edit_data_array[0]['company_mobile']; ?>"
                                                                   placeholder="Enter phone number 1">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Phone number 2: </label>
                                                            <input type="text" class="form-control" id="company_mobile2" name="company_mobile2" value="<?php echo $edit_data_array[0]['company_mobile2']; ?>"
                                                                   placeholder="Enter phone number 2">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Email 1: </label>
                                                            <input type="email" class="form-control" id="company_email" name="company_email" value="<?php echo $edit_data_array[0]['company_email']; ?>"
                                                                   placeholder="Enter email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Email 2: </label>
                                                            <input type="email" class="form-control" id="company_email2" name="company_email2" value="<?php echo $edit_data_array[0]['company_email2']; ?>"
                                                                   placeholder="Enter email 2">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Facebook Link : </label>
                                                            <textarea name="facebook_link"
                                                                      id="facebook_link" rows="2" cols="2"
                                                                      placeholder="Enter Facebook Link"
                                                                      class="form-control"><?php echo $edit_data_array[0]['facebook_link']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Google Plus Link: </label>
                                                            <textarea name="google_link"
                                                                      id="google_link" rows="2" cols="2"
                                                                      placeholder="Enter Google Plus Link"
                                                                      class="form-control"><?php echo $edit_data_array[0]['google_link']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Pinterest Link : </label>
                                                            <textarea name="linkedin_link"
                                                                      id="pinterest_link" rows="2" cols="2"
                                                                      placeholder="Enter Pinterest Link"
                                                                      class="form-control"><?php echo $edit_data_array[0]['pinterest_link']; ?></textarea>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Instagram Link : </label>
                                                            <textarea name="insta_link"
                                                                      id="insta_link" rows="2" cols="2"
                                                                      placeholder="Enter Instagram Link"
                                                                      class="form-control"><?php echo $edit_data_array[0]['insta_link']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Twitter Link: </label>
                                                            <textarea name="twitter_link"
                                                                      id="twitter_link" rows="2" cols="2"
                                                                      placeholder="Enter Twitter Link"
                                                                      class="form-control"><?php echo $edit_data_array[0]['twitter_link']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Youtube Link : </label>
                                                            <textarea name="youtube_link"
                                                                      id="youtube_link" rows="2" cols="2"
                                                                      placeholder="Enter Youtube Link"
                                                                      class="form-control"><?php echo $edit_data_array[0]['youtube_link']; ?></textarea>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Skype Link : </label>
                                                            <textarea name="skype_link"
                                                                      id="skype_link" rows="2" cols="2"
                                                                      placeholder="Enter Skype Link"
                                                                      class="form-control"><?php echo $edit_data_array[0]['skype_link']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Whatsapp Link: </label>
                                                            <textarea name="whatsapp_link"  id="whatsapp_link" rows="2" cols="2" placeholder="Enter Whatsapp Link" class="form-control"><?php echo $edit_data_array[0]['whatsapp_link']; ?></textarea>
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
        <script type="text/javascript" src="<?php echo $base_url_js_upload; ?>ajaxupload.3.5.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo $base_url_css_upload; ?>styles.css"/>
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

            <?php for($i = 1;$i <= 1;$i++){ ?>
                var file_name;
                $(function ()
                {
                    var btnUpload = $('#upload<?php echo $i; ?>');
                    var status = $('#status<?php echo $i; ?>');
                    new AjaxUpload(btnUpload, {
                        action: '<?php echo $base_url; ?>upload-company-image.php',
                        name: 'uploadfile',
                        onSubmit: function (file, ext)
                        {
                            if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext)))
                            {
                                $('#status').html('<p style="color:#d05165;margin-left:10px">Only JPG, JPEG, PNG or GIF files are allowed.</p>');
                                $('#files<?php echo $i; ?>').html('<center><i class="icon  icon-add" style="color:#000;font-size: 20px;margin-top: 20px;"></i><div style="clear:both"></div>ADD <br/> PHOTOS </center>');
                                return false;
                            }
                            document.getElementById('files<?php echo $i;?>').innerHTML = '<center><img src="<?php echo $base_url_images?>loading.gif" style="width:30px;margin-top:35px"></center>';
                        },
                        onComplete: function (file, response)
                        {
        //                    debugger;
                            var file_name_split = response.split("$$");
                            file = file_name_split[1];
                            file1 = file_name_split[0];
                            if (file1 === "success")
                            {
                                document.getElementById('file_name<?php echo $i; ?>').value = file;
                                $('<li></li>').add('#files<?php echo $i; ?>').html('<img src="<?php echo $base_url_uploads;?>company-images/size_small/' + file + '" style="margin-bottom:10px;width:290px;height:153px;"  alt="" /><div style="clear:both"></div><a class="" style="cursor:pointor" onclick="delete_upload(<?php echo $i;?>)"><i class="icon icon-subtract"></i><div style="clear:both"></div>DELETE </a>').addClass('success');
                                $('input').attr('title', ' ');
                            }
                            else if (response == 'size_error')
                            {
                                $('#status').html('<p style="color:#d05165;margin-left:10px">Please upload image with max size 2MB.</p>');
                                $('#files<?php echo $i; ?>').html('<center><i class="icon  icon-add" style="color:#000;font-size: 20px;margin-top: 20px;"></i><div style="clear:both"></div>ADD <br/> PHOTOS </center>');
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
                    $('#files' + delete_file_id).html('<center style="margin-top: 20px;"><i class="icon icon-add"></i><div style="clear:both"></div>ADD <br/> PHOTO </center>');
                    $('#file_name' + delete_file_id).val("");
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