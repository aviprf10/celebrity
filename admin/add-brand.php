<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1)
{
    $module_full_name = 'Brand';
    $module_short_name = 'Brand';
    $module_name = 'brand';
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
                                                    <label>Name : <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"  data-parsley-required="true">
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
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description : <span class="text-danger">*</span></label>
                                                    <textarea type="text" class="form-control" name="description"
                                                        placeholder="Enter Description " rows="5" maxlength="500"></textarea>
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
                                                    <label>Website :</label>
                                                    <input type="text" class="form-control"id="website" name="website"
                                                            placeholder="Enter Website">                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label" style="">Upload profile pic :</label>
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
                                    $('#<?php echo $module_name; ?>_form').trigger("reset");
                                    $('#<?php echo $module_name; ?>_form').parsley().destroy();
                                    $.notifyBar({cssClass: "success", html: data.html_message});
                                    setTimeout(function ()
                                    {
                                        window.top.location="<?php echo $base_url; ?>view-brand";
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

        <?php for($i = 1;$i <= 1;$i++){ ?>
        var file_name;
        $(function ()
        {
            var btnUpload = $('#upload<?php echo $i; ?>');
            var status = $('#status<?php echo $i; ?>');
            new AjaxUpload(btnUpload, {
                action: '<?php echo $base_url;?>upload-brand-profilepic-image.php',
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
                        $('<li></li>').add('#files<?php echo $i; ?>').html('<img src="<?php echo $brand_base_path_uploads ;?>profile-pic/size_450/' + file + '" style="margin-bottom:10px;width:150px;height:150px;"  alt="" /><div style="clear:both"></div><center><a class="" style="cursor:pointor" onclick="delete_upload(<?php echo $i;?>)"><i class="icon icon-subtract"></i><div style="clear:both"></div>DELETE </a></center>').addClass('success');
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
