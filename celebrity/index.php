<?php
include 'common/config.php';
include 'common/check_login.php';
if ($celebrity == 1)
{
    
    $get_user_order_query = "SELECT count(*) as total_order from user_order WHERE is_deleted='0' and celebrity_id='$loggedin_user_id'";
    $result_get_user_order_query = mysqli_query($db_mysqli, $get_user_order_query);
    $all_user_order_data_array = array();
    while ($row_get_user_order_query = mysqli_fetch_assoc($result_get_user_order_query))
    {
        $all_user_order_data_array[] = $row_get_user_order_query;
    }
    $total_user_order = $all_user_order_data_array[0]['total_order'];

    $get_brand_post_query = "SELECT count(*) as total_brand_post from brand_post_celebrty_list WHERE celebrity_id='$loggedin_user_id'";
    $result_get_brand_post_query = mysqli_query($db_mysqli, $get_brand_post_query);
    $all_brand_post_data_array = array();
    while ($row_get_brand_post_query = mysqli_fetch_assoc($result_get_brand_post_query))
    {
        $all_brand_post_data_array[] = $row_get_brand_post_query;
    }
    $total_brand_post = $all_brand_post_data_array[0]['total_brand_post'];
    
    $get_services_request_query = "SELECT count(*) as total_services_request from services_request WHERE is_deleted='0' and celebrity_id='$loggedin_user_id'";
    $result_get_services_request_query = mysqli_query($db_mysqli, $get_services_request_query);
    $all_services_request_data_array = array();
    while ($row_get_services_request_query = mysqli_fetch_assoc($result_get_services_request_query))
    {
        $all_services_request_data_array[] = $row_get_services_request_query;
    }
    $total_services_request = $all_services_request_data_array[0]['total_services_request'];

    $get_newuser_order_query = "SELECT count(*) as total_newuser_order from user_order WHERE is_deleted='0' and order_status='0' and celebrity_id='$loggedin_user_id'";
    $result_get_newuser_order_query = mysqli_query($db_mysqli, $get_newuser_order_query);
    $all_newuser_order_data_array = array();
    while ($row_get_newuser_order_query = mysqli_fetch_assoc($result_get_newuser_order_query))
    {
        $all_newuser_order_data_array[] = $row_get_newuser_order_query;
    }
    $total_newuser_order = $all_newuser_order_data_array[0]['total_newuser_order'];

    $get_rejecteduser_order_query = "SELECT count(*) as total_rejecteduser_order from user_order WHERE is_deleted='0' and order_status='8' and celebrity_id='$loggedin_user_id'";
    $result_get_rejecteduser_order_query = mysqli_query($db_mysqli, $get_rejecteduser_order_query);
    $all_rejecteduser_order_data_array = array();
    while ($row_get_rejecteduser_order_query = mysqli_fetch_assoc($result_get_rejecteduser_order_query))
    {
        $all_rejecteduser_order_data_array[] = $row_get_rejecteduser_order_query;
    }
    $total_rejecteduser_order = $all_rejecteduser_order_data_array[0]['total_rejecteduser_order'];

    $get_brand_inquery_response_query = "SELECT count(*) as total_brand_inquery_response from brand_inquery_response WHERE request_type='Accept' and celebrity_id='$loggedin_user_id'";
    $result_get_brand_inquery_response_query = mysqli_query($db_mysqli, $get_brand_inquery_response_query);
    $all_brand_inquery_response_data_array = array();
    while ($row_get_brand_inquery_response_query = mysqli_fetch_assoc($result_get_brand_inquery_response_query))
    {
        $all_brand_inquery_response_data_array[] = $row_get_brand_inquery_response_query;
    }
    $total_brand_inquery_response = $all_brand_inquery_response_data_array[0]['total_brand_inquery_response'];

    $get_celebrtityquery = "SELECT * from payment_history WHERE celebrity_id =$loggedin_user_id order by id desc limit 1";
    $result_get_celebrtityquery = mysqli_query($db_mysqli, $get_celebrtityquery);
    $all_celebrtitydata_array = array();
    while ($row_get_celebrtityquery = mysqli_fetch_assoc($result_get_celebrtityquery))
    {
        $all_celebrtitydata_array[] = $row_get_celebrtityquery;
    }

    $get_celebritydetailsquery = "SELECT * from celebrity_details WHERE celebrity_id =$loggedin_user_id and is_deleted='0'";
    $result_get_celebritydetailsquery = mysqli_query($db_mysqli, $get_celebritydetailsquery);
    $all_celebritydetailsdata_array = array();
    while ($row_get_celebritydetailsquery = mysqli_fetch_assoc($result_get_celebritydetailsquery))
    {
        $all_celebritydetailsdata_array[] = $row_get_celebritydetailsquery;
    }

    $amountpr = $all_celebrtitydata_array[0]['amount']*$all_celebritydetailsdata_array[0]['payment_percentage'];
    $mainamount = $amountpr/100;
    $main_amount  = $all_celebrtitydata_array[0]['amount']-$mainamount;
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $company_title; ?> - Dashboard</title>
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
            .graph_select_button{
                color: white; padding: 10px;
                height: 50px;
                text-align: center;
                font-weight: 500;
                font-size: small;
                border: 3px solid white;
                /*margin: 1px;*/
            }
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
                <!-- /page header end -->

                <div class="content">
                    <div class="panel panel-default">
                    <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card card-body bg-brown-400 has-bg-image" style="padding:30px;">
                                        <div class="media" style="display: flex; align-items: flex-start;">
                                            <div class="media-body" style="margin-top: -29px;">
                                                <h3 class="mb-0"><?php echo $total_user_order; ?></h3>
                                                <span class="text-uppercase font-size-xs">total order</span>
                                            </div>
                                            <div class="ml-3 align-self-center">
                                                <i class="icon-cart2 icon-3x opacity-75" style="opacity: .75;"></i>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-body bg-violet-400 has-bg-image" style="padding:30px;">
                                        <div class="media" style="display: flex; align-items: flex-start;">
                                            <div class="media-body" style="margin-top: -29px;">
                                                <h3 class="mb-0"><?php echo $total_brand_post; ?></h3>
                                                <span class="text-uppercase font-size-xs">total brand post</span>
                                            </div>
                                            <div class="ml-3 align-self-center">
                                                <i class="icon-certificate icon-3x opacity-75" style="opacity: .75;"></i>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-body bg-pink-400 has-bg-image" style="padding:30px;">
                                        <div class="media" style="display: flex; align-items: flex-start;">
                                            <div class="media-body" style="margin-top: -29px;">
                                                <h3 class="mb-0"><?php echo $total_services_request; ?></h3>
                                                <span class="text-uppercase font-size-xs">total Services Request </span>
                                            </div>
                                            <div class="ml-3 align-self-center">
                                                <i class="icon-cogs icon-3x opacity-75" style="opacity: .75;"></i>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-body bg-violet-400 has-bg-image" style="padding:30px; background: teal;">
                                        <div class="media" style="display: flex; align-items: flex-start;">
                                            <div class="media-body" style="margin-top: -29px;">
                                                <h3 class="mb-0"><?php echo $total_newuser_order; ?></h3>
                                                <span class="text-uppercase font-size-xs">total new order </span>
                                            </div>
                                            <div class="ml-3 align-self-center">
                                                <i class="icon-cart-add2 icon-3x opacity-75" style="opacity: .75;"></i>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card card-body bg-violet-400 has-bg-image" style="padding:30px; background: steelblue;">
                                        <div class="media" style="display: flex; align-items: flex-start;">
                                            <div class="media-body" style="margin-top: -29px;">
                                                <h3 class="mb-0"><?php echo $total_rejecteduser_order; ?></h3>
                                                <span class="text-uppercase font-size-xs">total rejected order</span>
                                            </div>
                                            <div class="ml-3 align-self-center">
                                                <i class="icon-bag icon-3x opacity-75" style="opacity: .75;"></i>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-body bg-violet-400 has-bg-image" style="padding:30px; background: darkgoldenrod;">
                                        <div class="media" style="display: flex; align-items: flex-start;">
                                            <div class="media-body" style="margin-top: -29px;">
                                                <h3 class="mb-0"><?php echo $total_brand_inquery_response; ?></h3>
                                                <span class="text-uppercase font-size-xs">total accepted order </span>
                                            </div>
                                            <div class="ml-3 align-self-center">
                                                <i class="icon-cart-add icon-3x opacity-75" style="opacity: .75;"></i>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-body bg-orange-400 has-bg-image" style="padding:30px;">
                                        <div class="media" style="display: flex; align-items: flex-start;">
                                            <div class="media-body" style="margin-top: -29px;">
                                                <h3 class="mb-0"><?php echo $selected_currency_icon; ?> <?php echo $main_amount; ?>.00</h3>
                                                <span class="text-uppercase font-size-xs">total balance </span>
                                            </div>
                                            <div class="ml-3 align-self-center">
                                                <i class="icon-wallet icon-3x opacity-75" style="opacity: .75;"></i>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- <div class="row">
                                <div class="col-md-4">
                                    <div class="card-header">
                                        <p style="font-size: 14px; font-weight: 700; padding-bottom: 10px; text-align: center;">Post Lead Info</p>
                                    </div>
                                    <div id="chartContainer" style="height:370px; width:100%;"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card-header">
                                        <p style="font-size: 14px; font-weight: 700; padding-bottom: 10px; text-align: center;">Loan Lead Info </p>
                                    </div>
                                    <div id="chartContainer1" style="height:370px; width:100%;"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card-header">
                                        <p style="font-size: 14px; font-weight: 700; padding-bottom: 10px; text-align: center;">Insurance Lead Info</p>
                                    </div>
                                    <div id="chartContainer2" style="height:370px; width:100%;"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-header">
                                        <p style="font-size: 14px; font-weight: 700; padding-bottom: 10px; text-align: center;">Last 3 Month Add Team Member</p>
                                    </div>
                                    <div id="chtAnimatedBarChart" class="bcBar"></div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="card-header">
                                        <p style="font-size: 14px; font-weight: 700; padding-bottom: 10px; text-align: center;">Last 3 Month Add Associte Partner</p>
                                    </div>
                                    <div id="chtAnimatedBarChart1" class="bcBar"></div>
                                </div>    
                            </div> -->
                        </div>
                    </div>
                        
                    
                    <?php include('common/footer.php'); ?>

                </div>
                    <!-- /main content -->
              </div> <!-- content ent -->
            </div>  <!-- content wrapper end -->

        </div> <!-- Page content end -->

    </div> <!-- Page container end -->
    <script type="text/javascript" src="<?php echo $base_url_js;?>jquery-1.11.1.min.js"></script>  
    <script type="text/javascript" src="<?php echo $base_url_js;?>jquery.canvasjs.min.js"></script>
    <link rel="stylesheet" href="<?php echo $base_url_js;?>bar.chart.min.css" />
    <script src="<?php echo $base_url_js;?>jquery.bar.chart.min.js"></script>
    <script src='https://d3js.org/d3.v4.min.js'></script>
    <script type="text/javascript">
        $(function() {
              var chart_data = getData();
              $('#chtAnimatedBarChart').animatedBarChart({ data: chart_data });
           });

           getData = function() {
              return [
                 { "group_name": "BDM", "name": "March(2021)", "value": 98 },
                 { "group_name": "BDM", "name": "February(2021)", "value": 29 },
                 { "group_name": "BDM", "name": "January(2021)", "value": 34 },
                 { "group_name": "ABDM", "name": "March(2021)", "value": 23 },
                 { "group_name": "ABDM", "name": "February(2021)", "value": 51 },
                 { "group_name": "ABDM", "name": "January(2021)", "value": 61 },
                 { "group_name": "DBDM", "name": "March(2021)", "value": 65 },
                 { "group_name": "DBDM", "name": "February(2021)", "value": 23 },
                 { "group_name": "DBDM", "name": "January(2021)", "value": 45 },
                 { "group_name": "RBDM", "name": "March(2021)", "value": 78 },
                 { "group_name": "RBDM", "name": "February(2021)", "value": 33 },
                 { "group_name": "RBDM", "name": "January(2021)", "value": 67 },
                 { "group_name": "SBDM", "name": "March(2021)", "value": 89 },
                 { "group_name": "SBDM", "name": "February(2021)", "value": 79 },
                 { "group_name": "SBDM", "name": "January(2021)", "value": 60 },
                 { "group_name": "ZBDM", "name": "February(2021)", "value": 76 },
                 { "group_name": "ZBDM", "name": "January(2021)", "value": 34 },
                 { "group_name": "ZBDM", "name": "January(2021)", "value": 31 },
              ];
           }

        $(function() {
              var chart_data = getData();
              $('#chtAnimatedBarChart1').animatedBarChart({ data: chart_data });
           });

           getData = function() {
              return [
                 { "group_name": "Total", "name": "March(2021)", "value": 98 },
                 { "group_name": "Total", "name": "February(2021)", "value": 29 },
                 { "group_name": "Total", "name": "January(2021)", "value": 34 },
                 { "group_name": "Active", "name": "March(2021)", "value": 23 },
                 { "group_name": "Active", "name": "February(2021)", "value": 51 },
                 { "group_name": "Active", "name": "January(2021)", "value": 61 },
                 { "group_name": "New Added", "name": "March(2021)", "value": 65 },
                 { "group_name": "New Added", "name": "February(2021)", "value": 23 },
                 { "group_name": "New Added", "name": "January(2021)", "value": 45 },
                 { "group_name": "Inactive", "name": "March(2021)", "value": 78 },
                 { "group_name": "Inactive", "name": "February(2021)", "value": 33 },
                 { "group_name": "Inactive", "name": "January(2021)", "value": 67 },
                 { "group_name": "Deleted", "name": "March(2021)", "value": 89 },
                 { "group_name": "Deleted", "name": "February(2021)", "value": 79 },
                 { "group_name": "Deleted", "name": "January(2021)", "value": 60 },
                
              ];
           }   
        window.onload = function() {
            var options = {
                animationEnabled: true,
                exportEnabled: true,
                title: {
                    //text: "Website Traffic Source"
                },
                subtitles: [{
                    //text: "Property Lead Info"
                }],
                data: [{
                        type: "pie",
                        startAngle: 45,
                        showInLegend: "true",
                        legendText: "{label}",
                        indexLabel: "{label} ({y})",
                        yValueFormatString:"#,##0.#"%"",
                        dataPoints: [
                            { label: "New Enquiry", y: 10 },
                            { label: "Tellecaller", y: 1 },
                            { label: "Location Manager", y: 3 },
                            { label: "Executive", y: 3 },
                            { label: "Property Shown", y: 3 },
                            { label: "Booked", y: 1 },
                            { label: "Complete", y: 2 },
                            { label: "Not Responding", y: 1 },
                            { label: "Cancelled", y: 1 }
                        ]
                }]
            };
            $("#chartContainer").CanvasJSChart(options);

            var options1 = {
                animationEnabled: true,
                exportEnabled: true,
                title: {
                    //text: "Website Traffic Source"
                },
                subtitles: [{
                    //text: "Loan Lead Info"
                }],
                data: [{
                        type: "pie",
                        startAngle: 45,
                        showInLegend: "true",
                        legendText: "{label}",
                        indexLabel: "{label} ({y})",
                        yValueFormatString:"#,##0.#"%"",
                        dataPoints: [
                            { label: "New Enquiry", y: 10 },
                            { label: "Tellecaller", y: 1 },
                            { label: "Paperwork", y: 3 },
                            { label: "Underwritting", y: 3 },
                            { label: "Sanctioned", y: 3 },
                            { label: "Disbursement process", y: 1 },
                            { label: "Disbursed", y: 2 },
                            { label: "Complete", y: 1 },
                            { label: "Not Responding", y: 1 },
                            { label: "Bank Login", y: 1 },
                            { label: "Declined", y: 1 },
                            { label: "Cancelled", y: 1 }
                        ]
                }]
            };
            $("#chartContainer1").CanvasJSChart(options1);

            var options2 = {
                animationEnabled: true,
                exportEnabled: true,
                title: {
                    //text: "Website Traffic Source"
                },
                subtitles: [{
                    //text: "Insurance Lead Info"
                }],
                data: [{
                        type: "pie",
                        startAngle: 45,
                        showInLegend: "true",
                        legendText: "{label}",
                        indexLabel: "{label} ({y})",
                        yValueFormatString:"#,##0.#"%"",
                        dataPoints: [
                            { label: "New Enquiry", y: 10 },
                            { label: "Tellecaller", y: 1 },
                            { label: "Paperwork", y: 3 },
                            { label: "Underwritting", y: 3 },
                            { label: "Booked", y: 3 },
                            { label: "Complete", y: 1 },
                            { label: "Login", y: 2 },
                            { label: "Declined", y: 1 },
                            { label: "Not Responding", y: 1 },
                            { label: "Cancelled", y: 1 }
                        ]
                }]
            };
            $("#chartContainer2").CanvasJSChart(options2);

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
