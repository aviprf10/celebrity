<?php
include('common/config.php');
include('common/check_login.php');
if ($admin == 1)
{
    $module_full_name = 'Cms Page';
    $module_short_name = 'Cms Page';
    $module_name = 'cms-page';

    if (isset($_GET['id']))
    {
        $cms_page_id = $_GET['id'];
    }
    else
    {
        $cms_page_id = 1;
    }


    $get_cms_page_query = "SELECT * FROM cms_page WHERE status=1 AND is_deleted=0";
    $result_get_cms_page_data = mysqli_query($db_mysqli, $get_cms_page_query);

    $all_cms_page_data_array = array();
    while ($row_get_cms_page_data = mysqli_fetch_assoc($result_get_cms_page_data))
    {
        $all_cms_page_data_array[$row_get_cms_page_data['id']] = $row_get_cms_page_data;
    }

    $page_content = '';
    $meta_title = '';
    $meta_description = '';
    $search_keywords = '';
    $image_name = '';

    if (count($all_cms_page_data_array) > 0)
    {
        $selected_cms_page_data_array = array();

        foreach ($all_cms_page_data_array as $cms_page_data_arr)
        {
            if ($cms_page_id == $cms_page_data_arr['id'])
            {
                $selected_cms_page_data_array[] = $cms_page_data_arr;
            }

        }

        if (count($selected_cms_page_data_array) > 0)
        {
            $selected_cms_page_data = $selected_cms_page_data_array[0];
            $cms_page_id = $selected_cms_page_data['id'];
            $main_title = $selected_cms_page_data['main_title'];
            $page_content = $selected_cms_page_data['page_content'];
            $meta_title = $selected_cms_page_data['meta_title'];
            $meta_description = $selected_cms_page_data['meta_description'];
            $image_name = $selected_cms_page_data['image_name'];
            $search_keywords = $selected_cms_page_data['search_keywords'];
            $status = $selected_cms_page_data['status'];
        }
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
        <script src="<?php echo $base_url; ?>ckeditor/ckeditor.js"></script>
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
                                    <h5 class="panel-title"> <?php echo $module_short_name; ?></h5>
                                </div>

                                <div class="panel-body">

                                    <?php if (count($all_cms_page_data_array) > 0)
                                    { ?>
                                        <form id="<?php echo $module_name; ?>_form" method="POST" data-parsley-validate>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Select <?php echo $module_full_name; ?> Title:</label>
                                                        <select name="cms_page_id" id="cms_page_id" class="select-search"
                                                                data-parsley-required="true" onchange="get_selected_cms_page(this.value)">
                                                            <?php
                                                            if (count($all_cms_page_data_array) > 0)
                                                            {
                                                                ?>
                                                                <optgroup label="<?php echo $module_full_name; ?>">
                                                                    <?php
                                                                    foreach ($all_cms_page_data_array as $all_cms_page_data)
                                                                    {
                                                                        ?>
                                                                        <option
                                                                            <?php if ($all_cms_page_data['id'] == $cms_page_id)
                                                                            {
                                                                                echo "selected='selected'";
                                                                            }
                                                                            ?>
                                                                                value="<?php echo $all_cms_page_data['id']; ?>">
                                                                            <?php echo stripslashes($all_cms_page_data['main_title']); ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </optgroup>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label><?php echo $module_full_name; ?> Content: </label>
                                                        <textarea rows="6" id="editor1" name="editor1"
                                                                  class="form-control"><?php echo $page_content; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Meta Title : </label>
                                                        <input type="text" class="form-control" id="meta_title"
                                                               name="meta_title" value="<?php echo $meta_title; ?>"
                                                               placeholder="Enter Meta Title">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Meta Description :</label>
                                                        <textarea name="meta_description" id="meta_description" rows="2"
                                                                  cols="2" placeholder="Enter Product Meta Description"
                                                                  class="form-control "><?php echo $meta_description; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Search Keywords :</label>
                                                        <input id="search_keywords" name="search_keywords[]" type="text"
                                                               class="form-control tags" value="<?php echo $search_keywords; ?>"
                                                               placeholder="Enter Search Terms"/>
                                                        <span class="help-block">Note:Help someone to find your products - Use the 13 tags to optimize your listings.</span>
                                                        <div id="tag_error_div">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="row">
                                                <div class="col-md-4" style="margin-top:10px;margin-bottom: 15px;">
                                                    <div class="form-group">
                                                        <label>Upload logo image :</label>
                                                        <div style="clear:both"></div>
                                                         <p class="text-primary" style="color:primary">Image Size : 570px * 330px, File Size : Max 2 MB   </p>
                                                        <div style="margin-top:10px;margin-bottom: 15px;">
                                                            <?php for ($i = 1; $i <= 1; $i++)
                                                            { ?>
                                                                <div id="upload<?php echo $i; ?>"
                                                                     style="margin-top: 15px;width:297px;height:170px;border: 1px solid #dedede;float:left;padding: 0px;"
                                                                     class="">
                                                                    <ul class="" id="files<?php echo $i; ?>"
                                                                        style="width: auto;padding: 0px;margin:0px">
                                                                        <?php
                                                                            if ($image_name != '')
                                                                            {
                                                                                ?>
                                                                                <img src="<?php echo $base_url; ?>uploads/cms-images/size_small/<?php echo $image_name; ?>"
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
                                                                    <input type="hidden" name="file_name<?php echo $i; ?>" id="file_name<?php echo $i; ?>" value="<?php echo $image_name; ?>">
                                                                </div>
                                                                <?php
                                                            } ?>
                                                            <div style="clear:both"></div>
                                                            <div id="status"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                         <!--    <div class="row">
                                                <div class="col-md-4">
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
                                            </div> -->
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

    <script type="text/javascript" src="<?php echo $base_url_js_upload; ?>ajaxupload.3.5.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url_css_upload; ?>styles.css"/>
    <script src="<?php echo $base_url_js; ?>plugins/parsley/parsley.min.js"></script>
    <script type="text/javascript" src="<?php echo $base_url_js; ?>tag/jquery.tagsinput.js"></script>
    <script type="text/javascript">
        $(document).ready(function ()
        {
            $('#<?php echo $module_name; ?>_form').parsley();
            $('#<?php echo $module_name; ?>_form').on('submit', function (e)
            {
                var page_content = CKEDITOR.instances['editor1'].getData();
                e.preventDefault();
                var f = $(this);
                f.parsley().validate();
                if (f.parsley().isValid())
                {
                    for (instance in CKEDITOR.instances)
                    {
                        CKEDITOR.instances[instance].updateElement();
                    }
                    var data = {
                        'page_content': page_content
                    };
                    data = $('#<?php echo $module_name;?>_form').serialize() + '&' + $.param(data);

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
                                $.notifyBar({cssClass: "error", html: "Error Occurred!"});
                            }

                        });
                }
                else
                {
                    e.preventDefault();
                }
            });
        });

        CKEDITOR.replace('editor1');


        function get_selected_cms_page(selected_cms_page_id)
        {
            window.location.href = "<?php echo $base_url;?><?php echo $module_name;?>/" + selected_cms_page_id;
        }


        $('#search_keywords').tagsInput({
            width: 'auto', height: '44px'
        });

        <?php for($i = 1;$i <= 1;$i++){ ?>
        var file_name;
        $(function ()
        {
            var btnUpload = $('#upload<?php echo $i; ?>');
            var status = $('#status<?php echo $i; ?>');
            new AjaxUpload(btnUpload, {
                action: '<?php echo $base_url; ?>upload-cms-image.php',
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
                        $('<li></li>').add('#files<?php echo $i; ?>').html('<img src="<?php echo $base_url_uploads;?>cms-images/size_small/' + file + '" style="margin-bottom:10px;width:292px;height:156px;"  alt="" /><div style="clear:both"></div><a class="" style="cursor:pointor" onclick="delete_upload(<?php echo $i;?>)"><i class="icon icon-subtract"></i><div style="clear:both"></div>DELETE </a>').addClass('success');
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
?>