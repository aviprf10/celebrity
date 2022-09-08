<?php
include 'common/config.php';
include 'common/check_login.php';
if ($celebrity == 1)
{
    if (isset($_GET['id']) && $_GET['id'] > 0)
    {
        $module_full_name = 'Images/Video';
        $module_short_name = 'Images/Video';
        $module_name = 'profile-images';

        $edit_id = $_GET['id'];
        $edit_data_array = array();
        $get_celebrity_images_query = "select * from celebrity_images where id='$edit_id' and is_deleted='0'";
        $result_get_celebrity_images_query = mysqli_query($db_mysqli, $get_celebrity_images_query);
        while ($row_get_celebrity_images_query = mysqli_fetch_assoc($result_get_celebrity_images_query))
        {
            $edit_data_array[] = $row_get_celebrity_images_query;
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
                                                    <div class="col-md-4" style="margin-top:10px;margin-bottom: 15px;">
                                                        <div class="form-group">
                                                            <label>Media Type : <span class="text-danger">*</span></label>
                                                            <select class="select-search form-control" id="media_type"  name="media_type"
                                                            data-placeholder="Select a Media Type..." onchange="get_filterdiv(this.value);">
                                                                <option value=""> Select Media Type</option>
                                                                <option value="image" <?php if($edit_data_array[0]['media_type'] == 'image'){ echo 'selected';} ?>> Image</option>
                                                                <option value="video" <?php if($edit_data_array[0]['media_type'] == 'video'){ echo 'selected';} ?>>Video</option>
                                                            </select>	
                                                        </div>
                                                    </div>
                                                </div>	
                                                <div class="row">
                                                    <div class="col-md-4" id="images_div" <?php if($edit_data_array[0]['media_type'] == 'image'){?>style="margin-top:10px;margin-bottom: 15px;" <?php }else{ ?>style="margin-top:10px;margin-bottom: 15px; display:none;"<?php } ?>>
                                                        <div class="form-group">
                                                            <label>Upload big image :</label>
                                                            <div style="clear:both"></div>
                                                            <div style="margin-top:10px;margin-bottom: 15px;">
                                                                <?php for ($i = 2; $i <= 2; $i++)
                                                                { ?>
                                                                    <div id="upload<?php echo $i; ?>"
                                                                        style="margin-top: 15px;width:292px;height:156px;border: 1px solid #dedede;float:left;padding: 0px;"
                                                                        class="">
                                                                        <ul class="" id="files<?php echo $i; ?>"
                                                                            style="width: auto;padding: 0px;margin:0px">
                                                                            <?php
                                                                            if ($edit_data_array[0]['celebrity_images'] != '')
                                                                            {
                                                                                ?>
                                                                                <img src="<?php echo $base_url; ?>uploads/celebrity-images/size_small/<?php echo $edit_data_array[0]['celebrity_images']; ?>"
                                                                                        style="margin-bottom:20px;width:295px;height:160px;">
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
                                                                                <center>
                                                                                    <i class="icon-plus-circle2" style="font-size: 20px;margin-top: 20px;"></i>
                                                                                    <div style="clear:both"></div>
                                                                                    ADD <br/> PHOTOS
                                                                                </center>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                        <input type="hidden" name="file_name<?php echo $i; ?>"
                                                                            id="file_name<?php echo $i; ?>" value="<?php echo $edit_data_array[0]['celebrity_images']; ?>">
                                                                    </div>
                                                                    <?php
                                                                } ?>
                                                                <div style="clear:both"></div>
                                                                <div id="status2"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" id="video_div"  <?php if($edit_data_array[0]['media_type'] == 'video'){?>style="margin-top:10px;margin-bottom: 15px;" <?php }else{ ?>style="margin-top:10px;margin-bottom: 15px; display:none;"<?php } ?>>
                                                        <div class="form-group">
                                                            <label>Upload Video :</label>
                                                            <div style="clear:both"></div>
                                                            <div style="margin-top:10px;margin-bottom: 15px;">
                                                                <?php for ($i = 1; $i <= 1; $i++)
                                                                { ?>
                                                                    <div id="upload<?php echo $i; ?>"
                                                                        style="margin-top: 15px;width:292px;height:156px;border: 1px solid #dedede;float:left;padding: 0px;"
                                                                        class="">
                                                                        <ul class="" id="files<?php echo $i; ?>"
                                                                            style="width: auto;padding: 0px;margin:0px">
                                                                            <?php
                                                                            if ($edit_data_array[0]['celebrity_video'] != '')
                                                                            {
                                                                                ?>
                                                                                <img src="<?php echo $base_url_images;?>video-doc.png" style="margin-bottom:10px;width:290px;height:153px;">
                                                                                <div style="clear:both"></div>
                                                                                <center><a class="" style="cursor:pointer;float: left; margin-left: 22%;" onclick="delete_upload(<?php echo $i; ?>)">
                                                                                        <i class="icon icon-subtract"></i>
                                                                                        <div style="clear:both"></div>
                                                                                        DELETE
                                                                                    </a>
                                                                                    <a class="" style="cursor:pointer;float: left; margin-left: 24%;" href="<?php echo $base_url; ?>uploads/celebrity-file/<?php echo $edit_data_array[0]['celebrity_video']; ?>" download>
                                                                                        <i class="icon icon-download"></i>
                                                                                        <div style="clear:both"></div>
                                                                                        DOWNLOAD
                                                                                    </a></center>
                                                                                <?php
                                                                            }
                                                                            else
                                                                            {
                                                                                ?>
                                                                                <center>
                                                                                    <i class="icon-plus-circle2" style="font-size: 20px;margin-top: 20px;"></i>
                                                                                    <div style="clear:both"></div>
                                                                                    ADD <br/> Video
                                                                                </center>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                        <input type="hidden" name="file_name<?php echo $i; ?>"
                                                                            id="file_name<?php echo $i; ?>" value="<?php echo $edit_data_array[0]['celebrity_video']; ?>">
                                                                       
                                                                    </div>
                                                                    <?php
                                                                } ?>
                                                                 <input type="hidden" name="edit_id"  id="edit_id" value="<?php echo $edit_id; ?>">
                                                                <div style="clear:both"></div>
                                                                <div id="status"></div>
                                                            </div>
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
                action: '<?php echo $base_url; ?>upload-profile-file.php',
                name: 'uploadfile',
                onSubmit: function (file, ext)
                {
                    if (!(ext && /^(mp4|AVI|MKV|WMV)$/.test(ext)))
                    {
                        $('#status').html('<p style="color:#d05165;margin-left:10px">Only mp4, AVI, MKV or WMV files are allowed.</p>');
                        $('#files<?php echo $i; ?>').html('<center><i class="icon  icon-add" style="color:#000;font-size: 20px;margin-top: 20px;"></i><div style="clear:both"></div>ADD <br/> VIDEO </center>');
                        return false;
                    }
                    document.getElementById('files<?php echo $i;?>').innerHTML = '<center><img src="<?php echo $base_url_images?>loading.gif" style="width:30px;margin-top:35px"></center>';
                },
                onComplete: function (file, response)
                {
                   //debugger;
                    var file_name_split = response.split("$$");
                    file = file_name_split[1];
                    file1 = file_name_split[0];
                    if (file1 === "success")
                    {
                        document.getElementById('file_name<?php echo $i; ?>').value = file;
                        $('<li></li>').add('#files<?php echo $i; ?>').html('<img src="<?php echo $base_url_images;?>video-doc.png" style="margin-bottom:10px;width:290px;height:153px;"  alt="" /><div style="clear:both"></div><a class="" style="cursor:pointor" onclick="delete_upload(<?php echo $i;?>)"><i class="icon icon-subtract"></i><div style="clear:both"></div>DELETE </a>').addClass('success');
                        $('input').attr('title', ' ');
                    }
                    else if (response == 'size_error')
                    {
                        $('#status').html('<p style="color:#d05165;margin-left:10px">Please upload image with max size 10MB.</p>');
                        $('#files<?php echo $i; ?>').html('<center><i class="icon  icon-add" style="color:#000;font-size: 20px;margin-top: 20px;"></i><div style="clear:both"></div>ADD <br/> VIDEO </center>');
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

        <?php for($i = 2;$i <= 2;$i++){ ?>
        var file_name;
        $(function ()
        {
            var btnUpload = $('#upload<?php echo $i; ?>');
            var status = $('#status<?php echo $i; ?>');
            new AjaxUpload(btnUpload, {
                action: '<?php echo $base_url; ?>upload-profile-image.php',
                name: 'uploadfile',
                onSubmit: function (file, ext)
                {
                    if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext)))
                    {
                        $('#status2').html('<p style="color:#d05165;margin-left:10px">Only JPG, JPEG, PNG or GIF files are allowed.</p>');
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
                        $('<li></li>').add('#files<?php echo $i; ?>').html('<img src="<?php echo $base_url_uploads;?>celebrity-images/size_small/' + file + '" style="margin-bottom:10px;width:290px;height:153px;"  alt="" /><div style="clear:both"></div><a class="" style="cursor:pointor" onclick="delete_upload(<?php echo $i;?>)"><i class="icon icon-subtract"></i><div style="clear:both"></div>DELETE </a>').addClass('success');
                        $('input').attr('title', ' ');
                    }
                    else if (response == 'size_error')
                    {
                        $('#status2').html('<p style="color:#d05165;margin-left:10px">Please upload image with max size 2MB.</p>');
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

        function delete_upload_small(delete_file_id)
        {
            $('#files' + delete_file_id).html('<center style="margin-top: 20px;"><i class="icon icon-add"></i><div style="clear:both"></div>ADD <br/> PHOTO </center>');
            $('#file_name' + delete_file_id).val("");
        }

        function get_filterdiv(type)
        {
            if(type=='image')
            {
                $('#images_div').css('display', 'block');
                $('#video_div').css('display', 'none');
            }
            else 
            {
                $('#video_div').css('display', 'block');
                $('#images_div').css('display', 'none');
                
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
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>