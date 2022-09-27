<?php
include 'common/config.php';
include 'common/check_login.php';
include "common/common_code.php";
if ($brand == 1)
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
                <meta charset="UTF-8">
                <meta http-equiv="x-ua-compatible" content="ie=edge" />
                <title>Manage Brand Post | <?php echo $company_title;?></title>
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                <meta property="og:locale" content="en_US" />
                <meta property="og:keyword" content="<?php echo $meta_keyword;?>" />
                <meta property="og:title" content="<?php echo $title;?>" />
                <meta property="og:description" content="<?php echo $meta_description;?>" />
                <meta name="robots" content="noindex, follow" />
                <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="32x32" />
                <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="192x192" />
                <link rel="apple-touch-icon" href="<?php echo $base_url_images; ?>fevicon.png" />
                <meta name="msapplication-TileImage" content="<?php echo $base_url_images; ?>fevicon.png" />
                <?php include "common/header-css.php";?>
                <link rel="stylesheet" href="<?php echo $base_url_css; ?>choices.min.css">
                <script src="<?php echo $base_url_js; ?>choices.min.js"></script>
                <script src="<?php echo $base_url1; ?>ckeditor/ckeditor.js"></script>
                <style>
                table, th, td {
                    border: 1px solid black;
                    }
                </style>
            </head>
            <body class="category-page category-empty">
                <?php include 'common/header.php';?>
                <div id="page-content">
                    <!--Collection Banner-->
                    <div class="collection-header">
                        <div class="collection-hero">
                            <div class="collection-hero__image"></div>
                            <div class="collection-hero__title-wrapper container">
                                <h1 class="collection-hero__title">Manage Brand Post</h1>
                                <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="<?php echo $base_url; ?>" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Manage Brand Post</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="container pt-2">
                        <div class="row mb-4 mb-lg-5 pb-lg-5">
                            <?php include'common/account-sidebar.php';?>
                            <div class="col-xl-9 col-lg-10 col-md-12">
                                <!-- Tab panes -->
                                <div class="tab-content dashboard-content">
                                    <div class="product-order">
                                        <div class="row" style="border-bottom: 1px solid #dbdbdb;">
                                            <div class="col-md-7">
                                                <h5><?php echo $module_full_name; ?></h5>
                                            </div>
                                            <div class="col-md-5">
                                                <a href="view-<?php echo $module_name; ?>" class="btn btn-primary">View <?php echo $module_full_name; ?></a>
                                                <a href="add-<?php echo $module_name; ?>" class="btn btn-success" style="float:right;">Add <?php echo $module_full_name; ?></a>
                                            </div>
                                        </div><br>
                                        <div class="row">
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
                                                            $get_category_query = "SELECT * FROM category WHERE is_deleted='0' order by id asc";
                                                            $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);
                                                            while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
                                                            {
                                                                $all_category_data_array[] = $row_get_category_query;
                                                            }
                                                            ?>
                                                            <select class="form-control" id="category_id" multiple="multiple"
                                                                    name="category_id[]" placeholder="Select a Category..." onchange="get_subcategory();">
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
                                                    <div class="col-md-12" id="subcategory_div">
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
                                                                    <input type="hidden" name="insta_id[<?php echo $i; ?>]" value="<?php echo $all_celebritydetailsdata['insta_id'];?>">
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
                                                            <label>Filter Brand Cost : <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="price"
                                                                name="price"
                                                                placeholder="Enter Filter Brand Cost"
                                                                data-parsley-required="true" value="<?php echo $price; ?>">
                                                        </div>
                                                    </div>
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
                                        </div><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            <br><br> 
                <?php include 'common/footer.php';?>
                <?php include 'common/footer-js.php';?>
                <script src="<?php echo $base_url_js; ?>plugins/parsley/parsley.min.js"></script>
                <script type="text/javascript">
                $(document).ready(function ()
                {
                    var multipleCancelButton = new Choices('#category_id,#sub_category_id', {
                        removeItemButton: true,
                    });

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
                                    url: "<?php echo $base_url1; ?>edit-<?php echo $module_name; ?>-submit.php",
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
                                                window.top.location="<?php echo $base_url1; ?>view-brand-post";
                                            }, 3000);
                                            
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
                            url: "<?php echo $base_url1; ?>get_subcategory.php",
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
                                    $('#sub_category_id').attr('data-parsley-required', 'false');
                                    var multipleCancelButton = new Choices('#sub_category_id', {
                                        removeItemButton: true,
                                    });
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
                    $.ajax(
                        {
                            url: "<?php echo $base_url1; ?>get_celebrtydetails.php",
                            type: "POST",
                            data: {'sub_category_id':new_subcat, 'category_id':new_cat},
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

                $("#category_reset").click(function ()
                {
                    $('#selected_category_id').select2("val", "0");
                    $('#<?php echo $module_name; ?>_form').parsley().destroy();
                });


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
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>
