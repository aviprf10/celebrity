<?php
include 'common/config.php';
include 'common/check_login.php';
if ($admin == 1)
{
    if (isset($_GET['id']))
    {
        $module_full_name = "Brand Request Details";
        $module_short_name = "Brand Request Details";
        $module_name = "brand-request-details";

         $edit_id = $_GET['id'];

        $edit_data_array = array();
        $get_services_query = "select * from brand_post_celebrty_list bpc left join brand_post bp on bpc.brand_post_id=bp.id where bpc.id='$edit_id'";
        $result_get_services_query = mysqli_query($db_mysqli, $get_services_query);
        while ($row_get_services_query = mysqli_fetch_assoc($result_get_services_query))
        {
            $edit_data_array[] = $row_get_services_query;
        }

        if (!empty($edit_data_array))
        {
            $rejct_reason = '';
            $display_mailid = '0';
            $brandidquery_data_array = array();
             $get_brandidquery = "select * from brand_inquery_response where brand_post_celebrty_id='$edit_id'";
            $result_get_brandidquery_query = mysqli_query($db_mysqli, $get_brandidquery);
            while ($row_get_brandidquery_query = mysqli_fetch_assoc($result_get_brandidquery_query))
            {
                $brandidquery_data_array[] = $row_get_brandidquery_query;
            }
            $response_id = $brandidquery_data_array[0]['id'];
            $rejct_reason = $brandidquery_data_array[0]['rejct_reason'];
            $display_mailid = $brandidquery_data_array[0]['display_mailid'];
            $request_type = $brandidquery_data_array[0]['request_type'];
            $status_by = $brandidquery_data_array[0]['status_by'];
           
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title><?php echo $company_title; ?> - <?php echo $module_full_name; ?></title>
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
                                        <li class="active"> <?php echo $module_short_name; ?></li>
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

                                            <div class="heading-elements">
                                                <a href="<?php echo $base_url; ?>view-brand-request">
                                                    <button type="button" class="btn bg-<?php echo $theme_color; ?> heading-btn">
                                                        <i class="icon-file-eye position-left"></i> View All <?php echo $module_full_name; ?>
                                                    </button>
                                                </a>
                                            </div>

                                        </div>

                                        <div class="panel-body">
                                            <form id="<?php echo $module_name; ?>_form" method="POST" data-parsley-validate>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label><b>Title :</b> <?php echo $edit_data_array[0]['title'] ?></label>
                                                            <input type="hidden" name="edit_id" id="edit_id"
                                                                value="<?php echo $edit_id; ?>">
                                                            <input type="hidden" name="celebrity_id" id="celebrity_id"
                                                                value="<?php echo $edit_data_array[0]['celebrity_id']; ?>">
                                                            <input type="hidden" name="response_id" id="response_id"
                                                                value="<?php echo $response_id; ?>">    
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label><b>Price :</b> <?php echo $edit_data_array[0]['price'] ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label><b>Description :</b> <?php echo htmlspecialchars_decode($edit_data_array[0]['full_description']); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label><b>Reply Validate Days :</b> <?php echo $edit_data_array[0]['validate_days'] ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label><b>Celebrity Name :</b> <?php echo $edit_data_array[0]['name'] ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Request Type :</label>
                                                            <select class="form-control" name="request_type"  onchange="get_div(this.value)">
                                                                <option value="">Select Type</option>
                                                                <option value="Accept" <?php if($request_type == 'Accept'){ echo 'selected'; } ?>>Accept</option>
                                                                <option value="Reject" <?php if($request_type == 'Reject'){ echo 'selected'; } ?>>Reject</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12" id="reject_div" <?php if($request_type != 'Reject'){ ?>  style="display:none;" <?php } ?>>
                                                        <div class="form-group">
                                                            <label>Reason :</label>
                                                            <textarea class="form-control" name="rejct_reason" id="rejct_reason"><?php echo $rejct_reason; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-12" id="accept_div"  <?php if($request_type != 'Accept'){ ?>  style="display:none;" <?php } ?>>
                                                        <div class="form-group">
                                                            <label>
                                                                <input type="checkbox" name="display_mailid" class="styled" id="display_mailid" value="1" <?php if ($display_mailid == 1)
                                                                {
                                                                    echo "checked";
                                                                } ?>>
                                                                Display your mail id in brand
                                                            </label>
                                                        </div>
                                                    </div> -->
                                                </div> 
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label><b>Status Update By :</b> <?php  if($status_by == '1'){ echo 'Super Admin';}else{ echo 'Celebrity';} ?></label>
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
            <script type="text/javascript" src="<?php echo $base_url_js; ?>tag/jquery.tagsinput.js"></script>
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

                $('#search_keywords').tagsInput({
                    width: 'auto', height: '44px'
                });

                
                function get_div(id)
                {
                    if(id == 'Accept')
                    {
                        $('#reject_div').css('display', 'none');
                        $('#rejct_reason').removeAttr('data-parsley-required', 'false');
                        $('#accept_div').css('display', 'block');
                        
                    }
                    else 
                    {
                        $('#accept_div').css('display', 'none');
                        $('#reject_div').css('display', 'block');
                        $('#rejct_reason').attr('data-parsley-required', 'true');
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
