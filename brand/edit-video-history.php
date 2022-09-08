<?php
include 'common/config.php';
include 'common/check_login.php';
include "common/common_code.php";
if ($brand == 1)
{

    if (isset($_GET['id']))
    {
        $module_full_name = "Video History";
        $module_short_name = "Video History";
        $module_name = "video-history";

         $edit_id = $_GET['id'];

        $edit_data_array = array();
        $get_services_query = "select * from video_celebrity_history where id='$edit_id'";
        $result_get_services_query = mysqli_query($db_mysqli, $get_services_query);
        while ($row_get_services_query = mysqli_fetch_assoc($result_get_services_query))
        {
            $edit_data_array[] = $row_get_services_query;
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
                                            <a href="view-<?php echo $module_name; ?>" class="btn btn-primary" style="float:right;">View <?php echo $module_full_name; ?></a>
                                            
                                        </div>
                                    </div><br>
                                    <div class="row">
                                         <form id="<?php echo $module_name; ?>_form" method="POST" data-parsley-validate>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <video width="320" height="240"  <?php if($edit_data_array[0]['admin_approved']== '1' && $edit_data_array[0]['brand_approved']== '1'){ ?> controls <?php }else{ ?> controls controlsList="nodownload"<?php } ?>>
                                                                <source src="<?php echo $cele_base_path_uploads; ?>celebrity-video/<?php echo $edit_data_array[0]['video']; ?>" type="video/mp4">
                                                                <source src="movie.ogg" type="video/ogg">
                                                            </video>
                                                            <input type="hidden" name="edit_id" id="edit_id"
                                                                value="<?php echo $edit_id; ?>">  
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Request Type :</label>
                                                            <select class="form-control" name="brand_approved">
                                                                <option value="">Select Type</option>
                                                                <option value="1" <?php if($edit_data_array[0]['brand_apporved']== '1'){ echo 'selected'; } ?>>Approved</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>   
                                                <div style="margin-top:25px">
                                                    <div class="text-left">
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
