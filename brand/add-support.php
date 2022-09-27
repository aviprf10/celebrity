<?php
include "common/config.php";    
include "common/check_login.php";
include "common/common_code.php";
if($brand == 1)
{

    $module_full_name = 'Support';
    $module_short_name = 'Support';
    $module_name = 'support';
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
                                 <!-- <div class="col-md-5">
                                    <a href="view-<?php echo $module_name; ?>" class="btn btn-primary">View <?php echo $module_full_name; ?></a>
                                    <a href="add-<?php echo $module_name; ?>" class="btn btn-success" style="float:right;">Add <?php echo $module_full_name; ?></a><br><br>
                                </div> -->
                            </div><br>
                            <div class="row">
                                <form id="<?php echo $module_name; ?>_form" method="POST" data-parsley-validate>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Subject : <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="subject"
                                                    name="subject"
                                                    placeholder="Enter Subject"
                                                    data-parsley-required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Message : <span class="text-danger">*</span></label>
                                                <textarea type="text" class="form-control" id="description"  name="description" rows="5"  placeholder="Enter Message" data-parsley-required="true"></textarea>
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
                                    window.top.location="<?php echo $base_url1; ?>add-support";
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