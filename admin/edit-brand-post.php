<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1)
{
    if (isset($_GET['id']))
    {
        $module_full_name = 'Brand Post';
        $module_short_name = 'Brand Post';
        $module_name = 'brand-post';

         $edit_id = $_GET['id'];

        $edit_data_array = array();
        $get_brandpost_query = "select * from brand_post where id='$edit_id' and is_deleted='0'";
        $result_get_brandpost_query = mysqli_query($db_mysqli, $get_brandpost_query);
        while ($row_get_brandpost_query = mysqli_fetch_assoc($result_get_brandpost_query))
        {
            $edit_data_array[] = $row_get_brandpost_query;
        }

        if (!empty($edit_data_array))
        {
            $edit_data = $edit_data_array[0];
            $edit_id = $edit_data['id'];
            $title = $edit_data['title'];
            $category_id = $edit_data['category_id'];
            $sub_category_id = $edit_data['sub_category_id'];
            $sort_description = $edit_data['sort_description'];
            $full_description = $edit_data['full_description'];
            $price = $edit_data['price'];
            $validate_days = $edit_data['validate_days'];
            $status = $edit_data['status'];

            $brandpostcelebrtylist_data_array = array();
            $get_brandpostcelebrtylist_query = "select * from brand_post_celebrty_list where brand_post_id='$edit_id'";
            $result_get_brandpostcelebrtylist_query = mysqli_query($db_mysqli, $get_brandpostcelebrtylist_query);
            while ($row_get_brandpostcelebrtylist_query = mysqli_fetch_assoc($result_get_brandpostcelebrtylist_query))
            {
                $brandpostcelebrtylist_data_array[] = $row_get_brandpostcelebrtylist_query;
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
        <script src="<?php echo $base_url; ?>ckeditor/ckeditor.js"></script>
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

                                <form id="<?php echo $module_name; ?>_form" method="POST" data-parsley-validate>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $module_full_name; ?> Name : <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="brand_name"
                                                    name="brand_name"
                                                    placeholder="Enter <?php echo $module_full_name; ?> Name"
                                                    data-parsley-required="true" value="<?php echo $title; ?>">
                                                <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">   
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Select Category : <span class="text-danger">*</span></label>
                                                <?php
                                                $all_category_data_array = array();
                                                $get_category_query = "SELECT * FROM category WHERE is_deleted='0'  order by id asc";
                                                $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);
                                                while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
                                                {
                                                    $all_category_data_array[] = $row_get_category_query;
                                                }
                                                ?>
                                                <select class="select-search form-control" id="category_id" multiple="multiple"
                                                        name="category_id[]" data-placeholder="Select a Category..." onchange="get_subcategory();">
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
                                                            value="<?php echo $all_category_data['id']; ?>" <?php if ($all_category_data['id'] == $category_id)
                                                            {
                                                                echo " selected='selected'";
                                                            } ?>>
                                                            <?php echo $all_category_data['category_name']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" id="subcategory_div">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Brand Cost : <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="price"
                                                    name="price" onkeyup="get_celebritydetails()"
                                                    placeholder="Enter Brand Cost"
                                                    data-parsley-required="true" value="<?php echo $price; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="celebritydetails_div">
                                    <?php
                                        if(count($brandpostcelebrtylist_data_array) > 0)
                                        { 
                                        ?>
                                        <div class="col-md-12">
                                            <table width="100%" border="1">
                                                <th style="text-align: center; padding: 8px;"></th>
                                                <th style="text-align: center; padding: 8px;">Sr. No.</th>
                                                <th style="text-align: center; padding: 8px;">Profile Pic</th>
                                                <th style="text-align: center; padding: 8px;">Name</th>
                                                <th style="text-align: center; padding: 8px;">Category</th>
                                                <th style="text-align: center; padding: 8px;">Instagram</th>
                                                <th style="text-align: center; padding: 8px;">Collaboration Brand Cost</th>
                                                <th style="text-align: center; padding: 8px;">Our Brand Cost</th>
                                        <?php         
                                            $i=1;  
                                            foreach($brandpostcelebrtylist_data_array as $all_celebritydetailsdata)
                                            {
                                                $all_category_data_array = array();
                                                $category = $all_celebritydetailsdata['category_id'];
                                                $get_category_query = "SELECT * FROM category WHERE id IN($category) and is_deleted='0'";
                                                $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);
                                                while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
                                                {
                                                    $all_category_data_array[] = $row_get_category_query;
                                                }
                                            
                                                $cate_arr = array();
                                                $cate_idarr = array();
                                                foreach($all_category_data_array as $all_category_data)
                                                {
                                                    $cate_arr[]= $all_category_data['category_name'];
                                                    $cate_idarr[]= $all_category_data['id'];
                                                }
                                                $category_name = implode(",",$cate_arr);;
                                                $categoryID = implode(",",$cate_idarr);;
                                            
                                                $profile_pic = $cele_base_path_uploads.'profile-pic/temp_file/'.$all_celebritydetailsdata['profile_pic'];
                                            ?>
                                                    <tr>
                                                        <td style="text-align: center; padding:8px;"><input type="checkbox" name="is_checked[<?php echo $i; ?>]" id="is_checked_<?php echo $i; ?>" value="<?php echo $all_celebritydetailsdata['is_checked']; ?>" <?php if($all_celebritydetailsdata['is_checked'] == 1){ echo "checked";} ?>></td>
                                                        <td style="text-align: center;"><?php echo $i; ?></td>
                                                        <td style="text-align: center;"><img src="<?php echo $profile_pic;?>" style="width:80px; padding: 10px;"></td>
                                                        <td style="text-align: center; padding:8px;"><?php echo $all_celebritydetailsdata['name'];?></td>
                                                        <td style="text-align: center; padding:8px;"><?php echo $category_name;?></td>
                                                        <td style="text-align: center; padding:8px;"><?php echo $all_celebritydetailsdata['insta_id'];?></td>
                                                        <td style="text-align: center; padding:8px;"><?php echo $all_celebritydetailsdata['celebrity_brand_cost'];?></td>
                                                        <td style="text-align: center; padding:8px;"><input type="text" name="brand_cost[<?php echo $i; ?>]" value="<?php echo $all_celebritydetailsdata['brand_cost']; ?>" id="brand_cost_<?php echo $i; ?>" placeholder="Our Brand Cost" class="form-control"></td>
                                                        <input type="hidden" name="celebrity_id[<?php echo $i; ?>]" value="<?php echo $all_celebritydetailsdata['celebrity_id']; ?>">
                                                        <input type="hidden" name="profile_pic[<?php echo $i; ?>]"value="<?php echo $all_celebritydetailsdata['profile_pic'];?>">
                                                        <input type="hidden" name="name[<?php echo $i; ?>]" value="<?php echo $all_celebritydetailsdata['name'];?>">
                                                        <input type="hidden" name="celebritycategory_id[<?php echo $i; ?>]" value="<?php echo $categoryID;?>">
                                                        <input type="hidden" name="insta_id[<?php echo $i; ?>]" value="<?php echo $all_celebritydetailsdata['instagram_link'];?>">
                                                        <input type="hidden" name="celebrity_brand_cost[<?php echo $i; ?>]" id="celebrity_brand_cost_<?php echo $i; ?>" value="<?php echo $all_celebritydetailsdata['celebrity_brand_cost'];?>">
                                                    </tr>
                                            <?php            
                                                $i++;
                                                
                                                }
                                                ?>
                                            </table>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Sort Description : <span class="text-danger">*</span></label>
                                                <textarea type="text" class="form-control" id="sort_description"  name="sort_description"  rows="5"  placeholder="Enter Sort Description" data-parsley-required="true"><?php echo $sort_description; ?></textarea>
                                            </div>           
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Full Description : <span class="text-danger">*</span></label>
                                                <textarea type="text" class="form-control" id="editor1"  name="full_description" rows="5"  placeholder="Enter Full Description"><?php echo $full_description; ?></textarea>
                                            </div>           
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Brand Pramotion Validity : <span class="text-danger">*</span></label>
                                                <select class="form-control" id="validate_days"  name="validate_days" data-parsley-required="true">
                                                    <option value="">Select Validity</option>
                                                    <option value="1 Days" <?php if($validate_days == '1 Days'){ echo 'selected'; } ?>>1 Days</option>
                                                    <option value="3 Days" <?php if($validate_days == '3 Days'){ echo 'selected'; } ?>>3 Days</option>
                                                    <option value="5 Days" <?php if($validate_days == '5 Days'){ echo 'selected'; } ?>>5 Days</option>
                                                    <option value="7 Days" <?php if($validate_days == '73 Days'){ echo 'selected'; } ?>>7 Days</option>
                                                </select>    
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="row">
                                        <div class="col-md-4">
                                            <br>
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
                                            <button type="reset" id="category_reset" onclick="reset_photo();" class="btn btn-default"><i class=" icon-undo position-left"></i> Reset</button>
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
    <?php include 'common/footer.php';?>
    <?php include 'common/footer-js.php';?>
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
                $('#<?php echo $module_name; ?>_form').parsley().destroy();
                var page_content = CKEDITOR.instances['editor1'].getData();
                for (instance in CKEDITOR.instances)
                {
                    CKEDITOR.instances[instance].updateElement();
                }
                var data = {
                    'page_content': page_content
                };
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
                                $.notifyBar({cssClass: "success", html: data.html_message});
                                setTimeout(function ()
                                {
                                    window.top.location="<?php echo $base_url; ?>view-brand-post";
                                }, 3000);
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
    CKEDITOR.replace('editor1');

    function get_subcategory()
    {
        var cat_id = new Array();
        cat_id = $('#category_id').val();
        var new_cat = cat_id.join(',')
        $.ajax(
            {
                url: "<?php echo $base_url; ?>get_subcategorycelebrty.php",
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
                        $('#celebritydetails_div').html(data.html_messages);
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

    function get_celebritydetails()
    {
        var cat_id = new Array();
        cat_id = $('#category_id').val();
        var new_cat = cat_id.join(',')

        var subcat_id = new Array();
        subcat_id = $('#sub_category_id').val();
        var new_subcat = subcat_id.join(',')
        
        var price = $('#price').val();
        $.ajax(
            {
                url: "<?php echo $base_url; ?>get_celebrtydetails.php",
                type: "POST",
                data: {'sub_category_id':new_subcat, 'category_id':new_cat, 'price':price},
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
                        $('#celebritydetails_div').html(data.html_messages);
                       
                    }
                    else
                    {
                        $.notifyBar({cssClass: "error", html: data.html_message});
                    }
                }
            });
        $('#<?php echo $module_name; ?>_form').parsley();
    }

   
    function delete_upload(delete_file_id)
    {
        $('#files' + delete_file_id).html('<center style="margin-top: 20px;"><i class="icon icon-add"></i><div style="clear:both"></div>ADD <br/> PHOTO </center>');
        $('#file_name' + delete_file_id).val("");
    }

    $('input[type="checkbox"]').change(function() {
    //check if check if checked 
    $(this).is(':checked') ?
        $('input.dislay-required').prop('required', false) :
        $('input.dislay-required').prop('required', true);

    });

    function getValue(value)
    {
        var checkBox = document.getElementById("is_checked_"+value);
        if(checkBox.checked)
        {
            $('#brand_cost_'+value).attr('data-parsley-required', 'true');
        }
        else 
        {
            $('#brand_cost_'+value).removeAttr('data-parsley-required', 'false');
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
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>  