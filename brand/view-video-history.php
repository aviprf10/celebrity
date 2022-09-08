<?php
include "common/config.php";    
include "common/check_login.php";
include "common/common_code.php";
if($brand == 1)
{

    $module_full_name = 'Video History';
    $module_short_name = 'Video History';
    $module_name = 'video-history';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Manage Video History | <?php echo $company_title;?></title>
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
    
    <style>
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-position: right center;
            background-image: url(../images/arrow-select.png) !important;
            background-repeat: no-repeat !important;
            background-position: right 10px center !important;
            line-height: 1.2;
            text-indent: 0.01px;
            text-overflow: '';
            cursor: pointer;
            padding: 8px 20px 8px 10px;
            float: left;
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
                            <div class="row"  style="border-bottom: 1px solid #dbdbdb;">
                                <div class="col-md-7">
                                    <h5><?php echo $module_full_name; ?></h5>
                                </div>
                                 <div class="col-md-5">
                                    <a href="view-<?php echo $module_name; ?>" class="btn btn-primary">View <?php echo $module_full_name; ?></a>
                                   <br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-checkable dataTable no-footer "
                                            id="all-<?php echo $module_name; ?>-table">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Video</th>
                                            <th>Celebrity</th>
                                            <th>Brand Inquiry Name</th>
                                            <th>Brand Name</th>
                                            <th>Admin Status</th>
                                            <th>Brand Status</th>
                                            <th>Uploaded Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <thead style="background: #fff">
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
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
    <script src="<?php echo $base_url_js; ?>plugins/datatables/dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function ()
        {
            $("#all-<?php echo $module_name; ?>-table_filter").css("display", "none");  // hiding global search box
            load_data();
        });

        $("#search_user_name,#search_email,#search_mobile").on("keydown", function (e)
        {
            if (e.keyCode === 13)
            {  //checks whether the pressed key is "Enter"
                load_data();
            }
        });

        function load_data(reset_flag = 0)
        {
            var form_data;

//            debugger;
            if (reset_flag == 0)            //call to load_data() when on first table load or when search button is clicked
            {
                var search_status = $('#search_status').val();
                if (search_status == '2')
                {
                    search_status = '';
                }
                var search_gender = $('#search_gender').val();
                if (search_gender == '2')
                {
                    search_gender = '';
                }
                form_data =
                    {
                        "search_user_name": $('#search_user_name').val(),
                        "search_usercode": $('#search_usercode').val(),
                        "search_email": $('#search_email').val(),
                        "search_mobile": $('#search_mobile').val(),
                        "search_refrralcode": $('#search_refrralcode').val(),
                        "search_refrralname": $('#search_refrralname').val(),
                        "search_gender": search_gender,
                        "search_status": search_status
                    };
            }
            else if (reset_flag == 1)           //call to load_data() when reset button is clicked
            {
                $('#search_user_name').val('');
                $('#search_usercode').val('');
                $('#search_email').val('');
                $('#search_mobile').val('');
                $('#search_refrralcode').val('');
                $('#search_refrralname').val('');

                form_data =
                    {
                        "search_user_name": '',
                        "search_usercode": '',
                        "search_email": '',
                        "search_mobile": '',
                        "search_refrralcode": '',
                        "search_refrralname": '',
                        "search_gender": '',
                        "search_status": ''
                    }
            }

            var dataTable = $('#all-<?php echo $module_name; ?>-table').DataTable(
                {
                    "processing": true,
                    "serverSide": true,
                    "bDestroy": true,
                    "bAutoWidth": false,
                    "bFilter": false,
                    "aaSorting": [0, "desc"],
                    "sDom": 'Rfrtlip',
                    "fnDrawCallback": function ()
                    {
                        $('.tooltip_class').tooltip();
                    },
                    "oLanguage": {
                        "sProcessing": '<i class="icon-spinner3 spinner position-left" style="font-size:21px"></i>'
                    },
                    "ajax": {
                        "type": "POST",
                        "url": "<?php echo $base_url1; ?>all-<?php echo $module_name; ?>-table-data.php",
                        "dataType": "json",
                        "data": form_data,
                        "dataSrc": function (json)
                        {
                            console.log(json);
                            return json.data;

                        },
                        error: function ()
                        {
                            $.notifyBar({cssClass: "error", html: "Error loading data from server."});
                        }
                    }
                });
        }

        $("#reset_filter").click(function ()
        {
            $('#search_status').select2('val', '2');
            $('#search_gender').select2('val', '2');
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