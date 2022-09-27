<?php
include "common/config.php";    
include "common/check_login.php";
include "common/common_code.php";
if($brand == 1)
{

    $module_full_name = 'Brand Post';
    $module_short_name = 'Brand Post';
    $module_name = 'brand-post';
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
                                    <a href="add-<?php echo $module_name; ?>" class="btn btn-success" style="float:right;">Add <?php echo $module_full_name; ?></a><br><br>
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
                                                    data-parsley-required="true">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Select Category : <span class="text-danger">*</span></label>
                                                <?php
                                                $celebrity_details_data_array = array();
                                                $get_celebrity_details_query = "select * from celebrity_details where is_deleted='0'";
                                                $result_get_celebrity_details_query = mysqli_query($db_mysqli, $get_celebrity_details_query);
                                                while ($row_get_celebrity_details_query = mysqli_fetch_assoc($result_get_celebrity_details_query))
                                                {
                                                    $celebrity_details_data_array[] = $row_get_celebrity_details_query;
                                                }
                                                $celebritydetails_data = array();
                                                $array_uni=array();
                                                foreach($celebrity_details_data_array as $celebrity_details_data)
                                                {
                                                    $celebritydetails_data = array_merge($celebritydetails_data, explode(",", $celebrity_details_data['category_id']));
                                                }
                                                
                                                $uniquePids = array_unique($celebritydetails_data);
                                                $categ_id = implode(',',array_values(array_unique($uniquePids)));
                                                $all_category_data_array = array();
                                                $get_category_query = "SELECT * FROM `category` where is_deleted='0'and id IN($categ_id)";
                                                $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);
                                                while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
                                                {
                                                    $all_category_data_array[] = $row_get_category_query;
                                                }
                                                ?>
                                                <select class="form-control" id="category_id" multiple="multiple"
                                                        name="category_id[]" placeholder="Select a Category..." onchange="get_subcategory();">
                                                    <?php foreach ($all_category_data_array as $all_category_data)
                                                    { ?>
                                                        <option value="<?php echo $all_category_data['id']; ?>">
                                                            <?php echo $all_category_data['category_name']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" id="subcategory_div"></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> Filter Brand Cost : <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="price"
                                                    name="price" onkeyup="get_celebritydetails()"
                                                    placeholder="Enter Filter Brand Cost"
                                                    data-parsley-required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="find_celeb"
                                                    name="find_celeb" onkeyup="get_celebritydetails()"
                                                    placeholder="Search more celebrty...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="celebritydetails_div"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Sort Description : <span class="text-danger">*</span></label>
                                                <textarea type="text" class="form-control" id="sort_description"  name="sort_description" rows="5"  placeholder="Enter Sort Description" data-parsley-required="true"></textarea>
                                            </div>           
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Full Description : <span class="text-danger">*</span></label>
                                                <textarea type="text" class="form-control" id="editor1"  name="full_description" rows="5"  placeholder="Enter Full Description"></textarea>
                                            </div>           
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Brand Pramotion Validity : <span class="text-danger">*</span></label>
                                                <select class="form-control" id="validate_days"  name="validate_days" data-parsley-required="true">
                                                    <option value="">Select Validity</option>
                                                    <option value="1 Days">1 Days</option>
                                                    <option value="3 Days">3 Days</option>
                                                    <option value="5 Days">5 Days</option>
                                                    <option value="7 Days">7 Days</option>
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
        var multipleCancelButton = new Choices('#category_id', {
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
                        url: "<?php echo $base_url1; ?>add-<?php echo $module_name; ?>-submit.php",
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
                                    window.top.location="<?php echo $base_url1; ?>payment-brand-post";
                                }, 1000);
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
        var new_cat = cat_id.join('|')
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
        var new_cat = cat_id.join('|')

        var subcat_id = new Array();
        subcat_id = $('#sub_category_id').val();
        var new_subcat = subcat_id.join('|')
        
        var price = $('#price').val();
        var find_celeb = $('#find_celeb').val();
        $.ajax(
            {
                url: "<?php echo $base_url1; ?>get_celebrtydetails.php",
                type: "POST",
                data: {'sub_category_id':new_subcat, 'category_id':new_cat, 'price':price, 'find_celeb':find_celeb},
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
   echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$base_url.'login">';
}
?>    