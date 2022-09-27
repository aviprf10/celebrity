<?php
include "common/config.php";    
include "common/check_login.php";
include "common/common_code.php";

if($brand == 1 || $_POST['email'])
{
    //echo '<pre>'; print_R($_GET); exit;
    $module_full_name  = 'Brand Post';
    $module_short_name = 'Brand Post';
    $module_name       = 'brand-post';

    $users_id = $_GET['id'];
    $brand_post_id = $_GET['last_id'];
    $get_user_query = "select * from brand_user where status='1' and is_deleted='0' and id='$users_id'";
    $result_user_data = mysqli_query($db_mysqli,$get_user_query);
    while ($row_user_data = mysqli_fetch_assoc($result_user_data))
    {
        $getuser_data_array[] = $row_user_data;
    } 
   
    if(!isset($_SESSION))
    {
        session_start();
    }

    if ($getuser_data_array[0]['user_type'] == 1)/*admin*/
    {
        $_SESSION[$company_name_session . '_loggedin'] = 1;
    }
    else if ($getuser_data_array[0]['user_type'] == 3)/*member*/
    {
        $_SESSION[$company_name_session . '_loggedin'] = 3;
    }
    
    $brand = 1;
    $_SESSION['domain_link_' . $company_name_session] = $company_name_session;
    $_SESSION['user_id_' . $company_name_session]= $getuser_data_array[0]['id'];
    $_SESSION['user_email_' . $company_name_session] = $getuser_data_array[0]['email'];
    $_SESSION['first_name_' . $company_name_session] = $getuser_data_array[0]['name'];
    $_SESSION['user_name_link_' . $company_name_session] = $getuser_data_array[0]['user_unique_slug'];
    $_SESSION['user_name_' . $company_name_session] = $getuser_data_array[0]['user_name'];
    $_SESSION['mobile_' . $company_name_session] = $getuser_data_array[0]['mobile'];
    $_SESSION['user_type_' . $company_name_session] = $getuser_data_array[0]['user_type'];
    $_SESSION['mobile_access_token_' . $company_name_session] = $getuser_data_array[0]['mobile_access_token'];
    $_SESSION['profile_pic_100' . $company_name_session] = $getuser_data_array[0]['profile_pic'];
    $_SESSION['profile_pic_450' . $company_name_session] = $getuser_data_array[0]['profile_pic'];
    
    
    $loggedin_user_id = $_SESSION['user_id_'.$company_name_session];
    $loggedin_user_email = $_SESSION['user_email_'.$company_name_session];
    $loggedin_user_first_name = $_SESSION['first_name_'.$company_name_session];
    $loggedin_user_name_link = $_SESSION['user_name_link_'.$company_name_session];
    $loggedin_user_name = $_SESSION['user_name_'.$company_name_session];
    $loggedin_user_mobile = $_SESSION['mobile_'.$company_name_session];
    $loggedin_user_type = $_SESSION['user_type_'.$company_name_session];
    $loggedin_user_mobile_access_token = $_SESSION['mobile_access_token_'.$company_name_session];
    $loggedin_user_total_user_cart_data = $_SESSION['total_user_cart_data_'.$company_name_session];
    $loggedin_user_profile_pic_100 = $_SESSION['profile_pic_100'.$company_name_session];
    $loggedin_user_profile_pic_450 = $_SESSION['profile_pic_450'.$company_name_session];
    $loggedin_user_is_compete = $_SESSION['is_compete'.$company_name_session];
    
    if ((isset($_POST['mihpayid'])) || (Secure1($db_mysqli, $_POST['mod_of_payment']) == '2'))
    {
        $flag = "false";
        $payment_id = 0;
        $mihpayid = '';
        if ($_POST['mihpayid'] != '')
        {
            $flag = "true";
            $mihpayid = $_POST['mihpayid'];
            $mode = $_POST['mode'];
            $status = $_POST['status'];
            $unmappedstatus = $_POST['unmappedstatus'];
            $key = $_POST['key'];
            $txnid = $_POST['txnid'];
            $amount = $_POST['amount'];
            $cardCategory = $_POST['cardCategory'];
            $discount = $_POST['discount'];
            $net_amount_debit = $_POST['net_amount_debit'];
            $addedon = $_POST['addedon'];
            $productinfo = $_POST['productinfo'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $address1 = $_POST['address1'];
            $address2 = $_POST['address2'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $country = $_POST['country'];
            $zipcode = $_POST['zipcode'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $udf1 = $_POST['udf1'];
            $udf2 = $_POST['udf2'];
            $udf3 = $_POST['udf3'];
            $udf4 = $_POST['udf4'];
            $udf5 = $_POST['udf5'];
            $udf6 = $_POST['udf6'];
            $udf7 = $_POST['udf7'];
            $udf8 = $_POST['udf8'];
            $udf9 = $_POST['udf9'];
            $udf10 = $_POST['udf10'];
            $hash = $_POST['hash'];
            $field1 = $_POST['field1'];
            $field2 = $_POST['field2'];
            $field3 = $_POST['field3'];
            $field4 = $_POST['field4'];
            $field5 = $_POST['field5'];
            $field6 = $_POST['field6'];
            $field7 = $_POST['field7'];
            $field8 = $_POST['field8'];
            $field9 = $_POST['field9'];
            $payment_source = $_POST['payment_source'];
            $PG_TYPE = $_POST['PG_TYPE'];
            $bank_ref_num = $_POST['bank_ref_num'];
            $bankcode = $_POST['bankcode'];
            $error = $_POST['error'];
            $error_Message = $_POST['error_Message'];
            $cardnum = $_POST['cardnum'];
            $cardhash = $_POST['cardhash'];
            $issuing_bank = $_POST['issuing_bank'];
            $card_type = $_POST['card_type'];
            $created_on = date('Y-m-d H:i:s');

            $insert_user_order_payment_query = "INSERT INTO brand_payment_details (`mihpayid`, `mode`, `status`, `unmappedstatus`, `paymentkey`, `txnid`, `amount`, `cardCategory`, `discount`, `net_amount_debit`, `addedon`, `productinfo`, `firstname`, `lastname`, `address1`, `address2`, `city`, `state`, `country`, `zipcode`, `email`, `phone`, `udf1`, `udf2`, `udf3`, `udf4`, `udf5`, `udf6`, `udf7`, `udf8`, `udf9`, `udf10`, `hash`, `field1`, `field2`, `field3`, `field4`, `field5`, `field6`, `field7`, `field8`, `field9`, `payment_source`, `PG_TYPE`, `bank_ref_num`, `bankcode`, `error`, `error_Message`, `cardnum`, `cardhash`, `issuing_bank`, `card_type`, `created_on`) VALUES ('$mihpayid', '$mode', '$status', '$unmappedstatus', '$paymentkey', '$txnid', '$amount', '$cardCategory', '$discount', '$net_amount_debit', '$addedon', '$productinfo', '$firstname', '$lastname', '$address1', '$address2', '$city', '$state', '$country', '$zipcode', '$email', '$phone', '$udf1', '$udf2', '$udf3', '$udf4', '$udf5', '$udf6', '$udf7', '$udf8', '$udf9', '$udf10', '$hash', '$field1', '$field2', '$field3', '$field4', '$field5', '$field6', '$field7', '$field8', '$field9', '$payment_source', '$PG_TYPE', '$bank_ref_num', '$bankcode', '$error', '$error_Message', '$cardnum', '$cardhash', '$issuing_bank', '$card_type', '$created_on')"; 
            $user_order_payment_data_query = mysqli_query($db_mysqli, $insert_user_order_payment_query);
            $payment_id = mysqli_insert_id($db_mysqli);

            if($_POST['status'] =='success')
            {
                $update_category_query = "update brand_post set payment_status='Paid', payu_payment_id='$payment_id', mihpayid='$mihpayid' where id='$brand_post_id'";
                $result_update_category_query = mysqli_query($db_mysqli, $update_category_query);
                
            }
        }
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
                                    <a href="add-<?php echo $module_name; ?>" class="btn btn-success" style="float:right;">Add <?php echo $module_full_name; ?></a><br><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-checkable dataTable no-footer "
                                            id="all-<?php echo $module_name; ?>-table">
                                        <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Validate Days</th>
                                            <th>Payment Status</th>
                                            <th>Status</th>
                                            <th class="text-center" width="200px">Actions</th>
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


        function delete_row(delete_id)
        {
            bootbox.confirm("Continue Delete?", function (result)
            {
                if (result == true)
                {
                    var formData =
                        {
                            'delete_id': delete_id,
                        };
                    $.ajax(
                        {
                            url: "<?php echo $base_url;?>delete-<?php echo $module_name; ?>.php",
                            type: "POST",
                            data: formData,
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
                                    $('#row_' + delete_id).remove();
                                    $.notifyBar({cssClass: "success", html: data.html_message});
                                    load_data();
                                }
                                else
                                {
                                    $.notifyBar({cssClass: "error", html: data.html_message});
                                }
                            },
                            error: function (data, errorThrown)
                            {
                                $.unblockUI();
                                $.notifyBar({cssClass: "error", html: "Error occured!"});
                            }
                        });
                }

            });

        }

        function modal_address_delete_row(delete_id)
        {
            bootbox.confirm("Continue Delete?", function (result)
            {
                if (result == true)
                {
                    var formData =
                        {
                            'delete_id': delete_id
                        };
                    $.ajax({
                        url: "<?php echo $base_url;?>delete-user-address.php",
                        type: "POST",
                        data: formData,
                        dataType: 'json',
                        encode: true,
                        beforeSend: function ()
                        {
//                            $.blockUI({message: '<i class="icon-spinner3 spinner position-left" style="font-size:21px"></i>'});
                        },
                        success: function (data)
                        {
                            if (data.status == 'success')
                            {
                                //new PNotify({title: 'Success',text: data.html_message,  icon: 'icon-checkmark3', type: 'success'});
                                $('#row_user_address_' + delete_id).remove();
                                $.notifyBar({cssClass: "success", html: data.html_message});
                            }
                            else
                            {
                                $.notifyBar({cssClass: "error", html: data.html_message});
                            }
                        },
                        error: function (data, errorThrown)
                        {
                            $.unblockUI();
                            $.notifyBar({cssClass: "error", html: "Error occured!"});
                        }
                    });
                }
            });
        }

        function modal_user_address(user_id)
        {
            $.ajax({
                url: "<?php echo $base_url;?>modal-<?php echo $module_name; ?>-address.php",
                type: "POST",
                data: {user_id: user_id},
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
                        $('#modal_response_user_address_div').html(data.html_message);
                        $("#modal_user_address").modal("show");
                    }
                    else
                    {
                        $.notifyBar({cssClass: "error", html: data.html_message});
                    }
                },
                error: function (data, errorThrown)
                {
                    $.unblockUI();
                    $.notifyBar({cssClass: "error", html: "Error occured!"});
                }
            });
        }

        function modal_user_add_address(user_id)
        {
            $.ajax({
                url: "<?php echo $base_url;?>modal-user-add-address.php",
                type: "POST",
                data: {user_id: user_id},
                dataType: 'json',
                encode: true,
                success: function (data)
                {
                    if (data.status == 'success')
                    {
                        $('#modal_response_user_add_address_div').html(data.html_message);
                        $("#modal_user_address").modal("hide");
                        $("#modal_user_add_address").modal("show");
//                        $('#status').addClass('styled');
                        $.getScript("<?php echo $base_url_js;?>pages/form_checkboxes_radios.js");
                        $.getScript("<?php echo $base_url_common;?>common.js");
                        $('#country_id').select2();

                        $('#address_reset').on('click', function ()
                        {
//                            debugger;
                            $('#modal_add_user_address_form').parsley().destroy();
                            $('#modal_add_user_address_form_state_selection_div').empty();
                            $('#modal_add_user_address_form_city_selection_div').empty();
                            $('#country_id').select2('val', ' ');
                        });

                        $('#modal_add_user_address_form').parsley();
                        $('#modal_add_user_address_form').on('submit', function (e)
                        {
                            e.preventDefault();
                            var f = $(this);
                            f.parsley().validate();
                            if (f.parsley().isValid())
                            {
                                $.ajax(
                                    {
                                        url: "<?php echo $base_url; ?>modal-user-add-address-submit.php",
                                        type: "POST",
                                        data: $('#modal_add_user_address_form').serialize(),
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
                                                $('#<?php echo $module_name; ?>_form').trigger("reset");
                                                $.notifyBar({cssClass: "success", html: data.html_message});
                                                $("#modal_user_add_address").modal("hide");
                                            }
                                            else
                                            {
                                                $.notifyBar({cssClass: "error", html: data.html_message});
                                                //dataTable.ajax.reload();
                                            }
                                        }
                                    });
                            }
                            else
                            {
                                e.preventDefault();
                            }
                        });

                    }
                    else
                    {
                        $.notifyBar({cssClass: "error", html: data.html_message});
                    }
                }
            });
        }

        function modal_user_edit_address(user_address_id)
        {
            $.ajax({
                url: "<?php echo $base_url;?>modal-<?php echo $module_name; ?>-edit-address.php",
                type: "POST",
                data: {user_address_id: user_address_id},
                dataType: 'json',
                encode: true,
                success: function (data)
                {
                    $.unblockUI();
                    if (data.status == 'success')
                    {
                        $('#modal_response_user_edit_address_div').html(data.html_message);
                        $("#modal_user_address").modal("hide");
                        $("#modal_user_edit_address").modal("show");
                        $.getScript("<?php echo $base_url_js;?>pages/form_checkboxes_radios.js");
                        $('#country_id').select2();
                        $('#modal_edit_user_address_form_state_id').select2();
                        $('#modal_edit_user_address_form_city_id').select2();

                        $('#modal_edit_user_address_form').parsley();
                        $('#modal_edit_user_address_form').on('submit', function (e)
                        {
                            e.preventDefault();
                            var f = $(this);
                            f.parsley().validate();
                            if (f.parsley().isValid())
                            {
                                $.ajax(
                                    {
                                        url: "<?php echo $base_url; ?>modal-user-edit-address-submit.php",
                                        type: "POST",
                                        data: $('#modal_edit_user_address_form').serialize(),
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
                                                $.notifyBar({cssClass: "success", html: data.html_message});
                                                $("#modal_user_edit_address").modal("hide");
                                            }
                                            else
                                            {
                                                $.notifyBar({cssClass: "error", html: data.html_message});
                                                //dataTable.ajax.reload();
                                            }
                                        }
                                    });
                            }
                            else
                            {
                                e.preventDefault();
                            }
                        });


                    }
                    else
                    {
                        $.notifyBar({cssClass: "error", html: data.html_message});
                    }
                }
            });
        }

        var form_id = '';
        function get_state_selection(country_id, form_id)
        {
            $('#all-<?php echo $module_name; ?>-table').parsley().destroy();

            if (country_id > 0)
            {
                $.ajax({
                    url: "<?php echo $base_url;?>get-state-selection-div.php",
                    type: "POST",
                    data: {
                        "country_id": country_id,
                        "form_id": form_id
                    },
                    dataType: 'json',
                    encode: true,

                    beforeSend: function ()
                    {
                        $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" />'});
                    },
                    success: function (data)
                    {
                        $.unblockUI();
                        if (data.status === 'success')
                        {

                            $('#' + form_id + '_state_selection_div').html(data.html_message);
                            $('#' + form_id + '_city_selection_div').html("");

                            $('#' + form_id + '_state_id').attr('data-parsley-required', 'true').select2();
                        }
                        else
                        {
                            $('#' + form_id + '_state_selection_div').html("");
                        }
                    }
                });
            }
            else
            {
                $('#' + form_id + '_state_selection_div').html("");
                $('#' + form_id + '_city_selection_div').html("");

                $('#all-<?php echo $module_name; ?>-table').parsley().destroy();

                if ($('#' + form_id + '_state_id').size() > 0)
                {
                    $('#' + form_id + '_state_id').attr('data-parsley-required', 'false');
                }
                if ($('#' + form_id + '_city_id').size() > 0)
                {
                    $('#' + form_id + '_city_id').attr('data-parsley-required', 'false');
                }
            }
            $('#all-<?php echo $module_name; ?>-table').parsley();
        }

        function get_city_selection(state_id, form_id)
        {
            $('#all-<?php echo $module_name; ?>-table').parsley().destroy();
            if (state_id > 0)
            {

                $.ajax({
                    url: "<?php echo $base_url;?>get-city-selection-div.php",
                    type: "POST",
                    data: {
                        "state_id": state_id,
                        "form_id": form_id
                    },
                    dataType: 'json',
                    encode: true,

                    beforeSend: function ()
                    {
                        $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" />'});
                    },
                    success: function (data)
                    {
                        $.unblockUI();

                        if (data.status == 'success')
                        {
                            $('#' + form_id + '_city_selection_div').html(data.html_message);
                            $('#' + form_id + '_city_id').attr('data-parsley-required', 'true').select2();
                        }
                        else
                        {
                            $('#' + form_id + '_city_selection_div').html("");
                        }
                    }
                });
            }
            else
            {
                $('#' + form_id + '_city_selection_div').html("");
                $('#' + form_id + '_city_id').attr('data-parsley-required', 'false');
            }

            $('#all-<?php echo $module_name; ?>-table').parsley();
        }


        function modal_user_cart(user_id)
        {
            $.ajax({
                url: "<?php echo $base_url;?>modal-user-cart.php",
                type: "POST",
                data: {
                    user_id: user_id
                },
                dataType: 'json',
                encode: true,
                success: function (data)
                {
                    if (data.status == 'success')
                    {
                        $('#modal_response_user_cart_div').html(data.html_message);
                        $("#modal_user_cart").modal("show");

                        $('#coupon_id').select2();
                        load_cart_data(user_id);

                        //  stop and start background body scroll when modal is open

                        $("body").css("overflow-y", "hidden");
                        $('#modal_user_cart').on('hidden.bs.modal', function ()
                        {
                            $("body").css("overflow-y", "scroll");
                        });

                        // Handle click on "Select all" control
                        $('#example-select-all').on('click', function ()
                        {
                            // Check/uncheck all checkboxes in the table
                            var rows = $('#all-modal-user-cart-table-data').DataTable().rows({'search': 'applied'}).nodes();
                            $(' input[type="checkbox"]', rows).prop('checked', this.checked);
                        });


                        //        // Handle click on checkbox to set state of "Select all" control
                        $('#all-modal-user-cart-table-data tbody').on('change', 'input[type="checkbox"]', function ()
                        {
                            // If checkbox is not checked
                            if (!this.checked)
                            {
                                var el = $('#example-select-all').get(0);
                                // If "Select all" control is checked and has 'indeterminate' property
                                if (el && el.checked && ('indeterminate' in el))
                                {
                                    // Set visual state of "Select all" control
                                    // as 'indeterminate'
                                    el.indeterminate = true;
                                }
                            }
                        });

                        $("#notify_user").click(function ()
                        {
                            var i = 0;
                            var arrayOfIds = $.map($(".single_select"), function (n, i)
                            {
                                if (n.checked)
                                    return n.value;
                            });
//            console.log(arrayOfIds);
                            if (arrayOfIds == '')
                            {
                                bootbox.alert("Please select products!");
                            }
                            else
                            {
                                var coupon_id = $('#coupon_id').val();
                                $.ajax({
                                    url: "<?php echo $base_url;?>ajax-notify-user.php",
                                    type: "POST",
                                    data: {
                                        user_cart_id_array: arrayOfIds,
                                        user_id: user_id,
                                        coupon_id: coupon_id
                                    },
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
                                            $("#modal_user_cart").modal("hide");
                                            $.notifyBar({cssClass: "success", html: data.html_message});
                                        }
                                        else
                                        {
                                            $.notifyBar({cssClass: "error", html: data.html_message});
                                        }
                                    }
                                });
                            }
                        });

                    }
                    else
                    {
                        $.notifyBar({cssClass: "error", html: data.html_message});
                    }
                }
            });
        }


        function load_cart_data(user_id)
        {
            var dataTable = $('#all-modal-user-cart-table-data').DataTable(
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
                        "url": "<?php echo $base_url; ?>all-modal-user-cart-table-data.php",
                        "dataType": "json",
                        "data": {user_id: user_id},
                        "dataSrc": function (json)
                        {
                            console.log(json);
                            return json.data;
                        },
                        error: function ()
                        {
                            $.notifyBar({cssClass: "error", html: "Error loading data from server."});
                        }
                    },
                    'columnDefs': [{
                        'targets': 0,
                        'searchable': false,
                        'orderable': false,
                        'className': 'dt-body-center',
                        'render': function (data, type, full, meta)
                        {
                            if (data)
                            {
//                                console.log(data);
                                return '<input type="checkbox" class="single_select" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                            }
                            else
                            {
                                return '';
                            }
                        }
                    }]
                });
        }

        $("#address_reset").click(function ()
        {
            $('select').select2('val', '');
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