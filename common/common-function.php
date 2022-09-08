<script type="text/javascript" src="<?php echo $base_url_js;?>plugins/parsley/parsley.min.js"></script>
<script type="text/javascript">
$(document).ready(function ()
{    
    $("#cart").click(function (e)
    {
        if($('.top-cart-content').is(':visible'))
        {
            $('.top-cart-content').css("display", "none");
        }
        else
        {
            $('.top-cart-content').css("display", "block");
        }
        open_cart_drawer();
        filter_product();
    });

    $("#slider-range").slider({
        range: true,
        min: 1,
        max: 100000,
        values: [1, 100000],
        slide: function (event, ui) {
            $("#amount").val("₹" + ui.values[0] + " - ₹" + ui.values[1]);
            $("#min_amount").val(ui.values[0]);
            $("#max_amount").val(ui.values[1]);
            $('#all_products_div').html("");
            $('#all_products_div1').html("");
            last_id = 0;
            filter_product();
        }
    });
    $("#amount").val("₹" + $("#slider-range").slider("values", 0) + " - ₹" + $("#slider-range").slider("values", 1));


}); 



function filter_product()
{
    var min_price_filter = $('#min_amount').val();
    var max_price_filter = $('#max_amount').val();
    var discount_checkbox = $("input[name='discount_checkbox']:checked").val();
    var sort_by_filter = $("input[id='sort_by_filter']:checked").val();
    var sort_by_filter1 = $("input[id='sort_by_filter1']:checked").val();
    var sort_by_filter2 = $("input[id='sort_by_filter2']:checked").val();
    var sort_by_filter_service1 = $("input[id='sort_by_filter_service1']:checked").val();
    var sort_by_filter_service2 = $("input[id='sort_by_filter_service2']:checked").val();
    var sort_by_filter_service3 = $("input[id='sort_by_filter_service3']:checked").val();
    var sort_by_filter_service4 = $("input[id='sort_by_filter_service4']:checked").val();
    var sort_by_filter_service5 = $("input[id='sort_by_filter_service5']:checked").val();
    var sort_by_filter_service6 = $("input[id='sort_by_filter_service6']:checked").val();
    var sort_by_filter_service7 = $("input[id='sort_by_filter_service7']:checked").val();
    var sort_by_filter_service8 = $("input[id='sort_by_filter_service8']:checked").val();
    var sort_by_filter_service9 = $("input[id='sort_by_filter_service9']:checked").val();
    var sort_by_filter_service10 = $("input[id='sort_by_filter_service10']:checked").val();
    var sort_by_filter_service11 = $("input[id='sort_by_filter_service11']:checked").val();
    var sort_by_filter_service12 = $("input[id='sort_by_filter_service12']:checked").val();
    var sort_by_filter_service13 = $("input[id='sort_by_filter_service13']:checked").val();
    var sort_by_filter_service14 = $("input[id='sort_by_filter_service14']:checked").val();
    var sort_by_filter_service15 = $("input[id='sort_by_filter_service15']:checked").val();
    var sort_by_filter_service16 = $("input[id='sort_by_filter_service16']:checked").val();
    var sort_by_filter_service17 = $("input[id='sort_by_filter_service17']:checked").val();
    var sort_by_filter_service18 = $("input[id='sort_by_filter_service18']:checked").val();
    var sort_by_filter_service19 = $("input[id='sort_by_filter_service19']:checked").val();
    var sort_by_filter_service20 = $("input[id='sort_by_filter_service20']:checked").val();
    var sort_by_filter_service21 = $("input[id='sort_by_filter_service21']:checked").val();
    var sort_by_filter_service22 = $("input[id='sort_by_filter_service22']:checked").val();
    var sort_by_filter_service23 = $("input[id='sort_by_filter_service23']:checked").val();
    var sort_by_filter_service24 = $("input[id='sort_by_filter_service24']:checked").val();
    var sort_by_filter_service25 = $("input[id='sort_by_filter_service25']:checked").val();
    var sort_by_filter_service26 = $("input[id='sort_by_filter_service26']:checked").val();
    var sort_by_filter_service27 = $("input[id='sort_by_filter_service27']:checked").val();
    var sort_by_filter_service28 = $("input[id='sort_by_filter_service28']:checked").val();
    var sort_by_filter_service29 = $("input[id='sort_by_filter_service29']:checked").val();
    var sort_by_filter_service30 = $("input[id='sort_by_filter_service30']:checked").val();
    var q = $('#search_query').val();
    var view_type = $('#view_type_value').val();
    //var view_type = 1;
    //var category_slug = '<?php echo $category_slug; ?>';
    var last_id = 0;
    var search_url = '';
    var limit = 12;
    
    if (min_price_filter != '')
    {
        if (search_url == '')
        {
            search_url += 'min_price=' + min_price_filter;
        }
        else
        {
            search_url += '&min_price=' + min_price_filter;
        }
    }
    if (max_price_filter != '')
    {
        if (search_url == '')
        {
            search_url += 'max_price=' + max_price_filter;
        }
        else
        {
            search_url += '&max_price=' + max_price_filter;
        }
    }
    if (discount_checkbox != null)
    {
        if (search_url == '')
        {
            search_url += 'discount=' + discount_checkbox;
        }
        else
        {
            search_url += '&discount=' + discount_checkbox;
        }
    }
    if (q != '')
    {
        if (search_url == '')
        {
            search_url += 'q=' + q;
        }
        else
        {
            search_url += '&q=' + q;
        }
    }
    if (view_type != '')
    {
        if (search_url == '')
        {
            search_url += 'view_type=' + view_type;
        }
        else
        {
            search_url += '&view_type=' + view_type;
        }
    }
    var category_title = $('#category_title').val();
    $.ajax(
    {
        url: '<?php echo $base_url;?>load_more_category_celebrity.php',
        type: 'POST',
        data: {
            min_price: min_price_filter,
            max_price: max_price_filter,
            sort_by: sort_by_filter,
            sort_by1: sort_by_filter1,
            sort_by2: sort_by_filter2,
            sort_byservices1: sort_by_filter_service1,
            sort_byservices2: sort_by_filter_service2,
            sort_byservices3: sort_by_filter_service3,
            sort_byservices4: sort_by_filter_service4,
            sort_byservices5: sort_by_filter_service5,
            sort_byservices6: sort_by_filter_service6,
            sort_byservices7: sort_by_filter_service7,
            sort_byservices8: sort_by_filter_service8,
            sort_byservices9: sort_by_filter_service9,
            sort_byservices10: sort_by_filter_service10,
            sort_byservices11: sort_by_filter_service11,
            sort_byservices12: sort_by_filter_service12,
            sort_byservices13: sort_by_filter_service13,
            sort_byservices14: sort_by_filter_service14,
            sort_byservices15: sort_by_filter_service15,
            sort_byservices16: sort_by_filter_service16,
            sort_byservices17: sort_by_filter_service17,
            sort_byservices18: sort_by_filter_service18,
            sort_byservices19: sort_by_filter_service19,
            sort_byservices20: sort_by_filter_service20,
            sort_byservices21: sort_by_filter_service21,
            sort_byservices22: sort_by_filter_service22,
            sort_byservices23: sort_by_filter_service23,
            sort_byservices24: sort_by_filter_service24,
            sort_byservices25: sort_by_filter_service25,
            sort_byservices26: sort_by_filter_service26,
            sort_byservices27: sort_by_filter_service27,
            sort_byservices28: sort_by_filter_service28,
            sort_byservices29: sort_by_filter_service29,
            sort_byservices30: sort_by_filter_service30,
            category_title:category_title
        },
        dataType: 'json',
        encode: true,
        // beforeSend: function ()
        // {
        //     $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
        // },
        success: function (data)
        {
            //$.unblockUI();
            $('#celebritys_div').hide();
            $('#loader').hide();
            $('#load_more_last_id').html(data.load_more_last_id);
            $('#all_celebritys_div').html(data.all_celebritys_div);
        
            is_loading = false;
        },
        error: function (error)
        {
            //$.unblockUI();
            $('#loader').hide();
            is_loading = false;
        }

    });
}

$("#search_value").keyup(function ()
{
    search_product();
    if($("#search_value").val() != '')
    {
        $('#web_section_header_search').css("opacity","1");
    }
    else
    {
        $('#web_section_header_search').css("opacity","0");
    }
});

$("#search_product_result_ul").css("display", "none");
function search_product()
{
    var search_value = $("#search_value").val();
    if (search_value != '')
    {
        $.ajax({
            url: "<?php echo $base_url;?>get-search-celebrity.php",
            type: "POST",
            data: {"search_value": search_value},
            dataType: 'json',
            encode: true,
            beforeSend: function ()
            {
                //$.blockUI({ message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>' });
            },
            success: function (data)
            {
                //$.unblockUI();
                if (data.status == 'success')
                {
                    $('#search_div').css("display", "block");
                    $("#search_product_result_ul").css("display", "block");
                    $('#SearchContainer').html(data.search_html_message);
                }
                else
                {
                    $('#SearchContainer').html(data.search_html_message);
                }
            }
        });
    }
    else
    {
        $("#search_product_result_ul").css("display", "none");
    }
}

$(document).ready(function ()
{
    $('#add_to_cart_form').parsley();
    $('#add_to_cart_form').on('submit', function (e)
    {
        e.preventDefault();
        var f = $(this);
        f.parsley().validate();
        if (f.parsley().isValid())
        {
            $.ajax(
                {
                    url: "<?php echo $base_url; ?>add-to-cart-submit.php",
                    type: "POST",
                    data: $('#add_to_cart_form').serialize(),
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
                            $("#header_cart_total_count").html(data.total_cart_celebrity);
                            $("#header_cart_total_amount").html('<?php echo $selected_currency_icon; ?> ' + data.total_cart_amount);
                            $.growl.notice({ title:"Success",message: data.html_message });
                        }
                        else
                        {
                            $.growl.error({ title:"Error",message: data.html_message });
                        }
                    },
                    error: function (data, errorThrown)
                    {
                        $.unblockUI();
                        $.growl.error({ title:"Error",message: "Error Loading data from server." });
                    }

                });
        }
        else
        {
            e.preventDefault();
        }
    });
});

function add_to_cart(celebrity_id)
{
    var add_to_cart_valid = 'add_to_cart';
    if (celebrity_id != '')
    {
        var formData =
            {
                'celebrity_id': celebrity_id,
                'add_to_cart_valid': add_to_cart_valid,
            };
        $.ajax({
            url: "<?php echo $base_url;?>add-to-cart-submit.php",
            type: "POST",
            data: formData,
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
                    $("#header_cart_total_count").html(data.total_cart_celebrity);
                    $("#header_cart_total_amount").html('<?php echo $selected_currency_icon; ?> ' + data.total_cart_amount);
                    $.growl.notice({ title:"Success",message: data.html_message });
                    //$.notifyBar({cssClass: "success", html: data.html_message});
                }
                else
                {
                    $.growl.error({ title:"Error",message: data.html_message });
                    //$.notifyBar({cssClass: "error", html: data.html_message});
                }
            },
            error: function (error)
            {
                $.growl.error({ title:"Error",message: "Error Loading data from server." });
                //$.notifyBar({cssClass: "error", html: "Error Loading data from server."});
            }
        });
    }
    else
    {
        $.growl.error({ title:"Error",message: "Please Enter Valid Quantity..!!" });
        //$.notifyBar({cssClass: "error", html: "Please Enter Valid Quantity..!!"});
    }
}

function book_cart(celebrity_id)
{
    var add_to_cart_valid = 'add_to_cart';
    if (celebrity_id != '')
    {
        var formData =
            {
                'celebrity_id': celebrity_id,
                'add_to_cart_valid': add_to_cart_valid,
            };
        $.ajax({
            url: "<?php echo $base_url;?>add-to-cart-submit.php",
            type: "POST",
            data: formData,
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
                    $("#header_cart_total_count").html(data.total_cart_celebrity);
                    $("#header_cart_total_amount").html('<?php echo $selected_currency_icon; ?> ' + data.total_cart_amount);
                    $.growl.notice({ title:"Success",message: data.html_message });
                    setTimeout(function ()
                    {
                        window.location.href = '<?php echo $base_url ?>checkout';
                    }, 1000);
                    //$.notifyBar({cssClass: "success", html: data.html_message});
                }
                else
                {
                    $.growl.error({ title:"Error",message: data.html_message });
                    //$.notifyBar({cssClass: "error", html: data.html_message});
                }
            },
            error: function (error)
            {
                $.growl.error({ title:"Error",message: "Error Loading data from server." });
                //$.notifyBar({cssClass: "error", html: "Error Loading data from server."});
            }
        });
    }
    else
    {
        $.growl.error({ title:"Error",message: "Please Enter Valid Quantity..!!" });
        //$.notifyBar({cssClass: "error", html: "Please Enter Valid Quantity..!!"});
    }
}

function add_to_wishlist(celebrity_id)
{
    <?php if($user == 1)
    {?>
        var formData =
            {
                'celebrity_id': celebrity_id
            };
        $.ajax(
            {
                url: "<?php echo $base_url;?>add-to-wishlist-submit.php",
                type: "POST",
                data: formData,
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


                        if (data.delete == 1)
                        {
                            if (window.location.pathname.split('/').pop() == 'my-wishlist')
                            {
                                $('#row_' + celebrity_id).remove();
                                if(data.wishlist_count == 0)
                                {
                                    $('#wishlist_table').html('<br><center><h6><i class="fa fa-thumbs-down" title="No Data found" style="font-size:26px"></i></h6><h4>No Data Found!</h4></center><br> ');
                                }
                            }
                            //$('#wishlist_' + celebrity_id).css({"background": "#ffffff"});
                            //$('#wishlist_' + celebrity_id).css({"border-color": "#252932"});
                            $('#wishlist_' + celebrity_id).css({"color": "#252932"});
                            //extra based on theme
                            
                                //$('#wishlist_1' + celebrity_id).css({"background": "#ffffff"});
                                //$('#wishlist_1' + celebrity_id).css({"border-color": "#252932"});
                                $('#wishlist_1' + celebrity_id).css({"color": "#252932"});
                            

                        }
                        else if (data.add == 1)
                        {
                            //$('#wishlist_' + celebrity_id).css({"background": "#ffffff"});
                            //$('#wishlist_' + celebrity_id).css({"border-color": "#ff0000"});
                            $('#wishlist_' + celebrity_id).css({"color": "#ff0000"});
                            

                                    //$('#wishlist_1' + celebrity_id).css({"background": "#ffffff"});
                                //$('#wishlist_1' + celebrity_id).css({"border-color": "#ff0000"});
                                $('#wishlist_1' + celebrity_id).css({"color": "#ff0000"});
                            
                        }
                        $.growl.notice({ title:"Success",message: data.html_message });
                        //$.notifyBar({cssClass: "success", html: data.html_message});
                        
                    }
                    else
                    {
                        $.growl.error({ title:"Error",message: data.html_message });
                        //$.notifyBar({cssClass: "error", html: data.html_message});
                    }
                },
                error: function (error)
                {
                    $.growl.error({ title:"Error",message: "Error Loading data from server." });
                    //$.notifyBar({cssClass: "error", html: "Error Loading data from server."});
                }
            });
        
    <?php  }
    else
        {
            $_SESSION['wishlist_current_page_'.$company_name_session] = $current_page; 
        ?>
        window.location.href = '<?php echo $base_url;?>registration';
    <?php } ?>
}

$("#area_reset").click(function ()
{
    $('select').select2('val', ' ');
    $('#add_to_cart_form').parsley().destroy();
});

$("#cart_box,#header_cart_container").mouseleave(function (e)
{
    e.stopPropagation();
    $('#cart_block').removeClass('open');
});
$("#header_cart_container").mouseenter(function (e)
{
    e.stopPropagation();
    $('#cart_block').addClass('open');
});

function open_cart_drawer()
{
    $.ajax(
        {
            url: "<?php echo $base_url;?>get-cart-items.php",
            type: "POST",
            data: {ID: '1'},
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
                    $('#minicart-drawer').css('display','block');
                    $('#minicart-drawer').removeClass('minicart-right-drawer modal right fade');
                    $('#minicart-drawer').addClass('minicart-right-drawer modal right fade show');
                    $('#header_cart_container').html(data.cart_html_message);
                }
                else
                {
                    $('#header_cart_container').html(data.cart_html_message);
                }
            },
            error: function (error)
            {
                $.growl.error({ title:"Error",message: "Error Loading data from server." });
                //$.notifyBar({cssClass: "error", html: "Error Loading data from server."});
            }
        });
}

function remove_from_cart(celebrity_id)
{
    var formData =
        {
            'celebrity_id': celebrity_id,
        };
    $.ajax(
    {
        url: "<?php echo $base_url;?>remove-from-cart-submit.php",
        type: "POST",
        data: formData,
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
                if (window.location.pathname.split('/').pop() == 'cart')
                {
                    $('#row_' + celebrity_id + '_' + celebrity_id).remove();
                    $("#cart_page_sub_total").html('<?php echo $selected_currency_icon; ?> ' + data.total_cart_amount);
                    $("#cart_page_grand_total").html('<?php echo $selected_currency_icon; ?> ' + data.total_cart_amount);
                    if (data.total_cart_celebrity == 0)
                    {
                        $("#cart_page_main_div").html('<center><img src="<?php echo $base_url_images;?>empty-cart.png"></center>');

                    }
                }

                $("#header_cart_total_count").html(data.total_cart_celebrity);
                $("#header_cart_total_amount").html('<?php echo $selected_currency_icon; ?> ' + data.total_cart_amount);
                open_cart_drawer();
                $.growl.notice({ title:"Success",message: data.html_message });
                //$.notifyBar({cssClass: "success", html: data.html_message});
                if (window.location.pathname.split('/').pop() == 'checkout')
                {
                    setTimeout(function ()
                    {
                        location.reload();
                    }, 2000);
                }

            }
            else
            {
                $.growl.error({ title:"Error",message: data.html_message });
                //$.notifyBar({cssClass: "error", html: data.html_message});
            }
        },
        error: function (error)
        {
            $.growl.error({ title:"Error",message: "Error Loading data from server." });
            //$.notifyBar({cssClass: "error", html: "Error Loading data from server."});
        }
    });
}

$('#login_form').parsley();
$('#login_form').on('submit', function (e)
{
    e.preventDefault();
    var f = $(this);
    f.parsley().validate();
    if (f.parsley().isValid())
    {
        $.ajax({
            url: "<?php echo $base_url;?>login-submit.php",
            type: "POST",
            data: $('#login_form').serialize(),
            dataType: 'json',
            encode: true,
            beforeSend: function ()
            {
                $.blockUI({message: '<img src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
            },
            success: function (data)
            {
                $.unblockUI();
                if (data.status == 'success')
                {
                    if (data.page != '')
                    {
                        window.location.href = '<?php echo $base_url;?>' + data.page;
                    }
                    else
                    {
                        $('#login_form').trigger("reset");
                        $.growl.notice({ title:"Success",message: data.html_message });
                        $('#login_form').parsley().destroy();   
                    }
                }
                else
                {
                    $.growl.error({ title:"Error",message: data.html_message });
                }
            },
            error: function ()
            {
                $.unblockUI();
                $.growl.error({ title:"Error",message: "Error fetching data from server." });
            }
        });
    }
    else
    {
        e.preventDefault();
    }
});

$('#registration_form').parsley();
$('#registration_form').on('submit', function (e)
{
    e.preventDefault();
    var f = $(this);
    f.parsley().validate();
    if (f.parsley().isValid())
    {
        $.ajax({
            url: "<?php echo $base_url;?>signup-submit.php",
            type: "POST",
            data: $('#registration_form').serialize(),
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
                    $('#registration_form').trigger("reset");
                    $.growl.notice({ title:"success",message: data.html_message });
                    $('#registration_form').parsley().destroy();
                    setTimeout(function ()
                    {
                        window.top.location="<?php echo $base_url; ?>account-dashboard";
                    }, 2000);
                }
                else
                {
                    //$('#registration_form_response_msg').html(data.html_message);
                    $.growl.error({ title:"Error",message: data.html_message });
                    //$.notifyBar({cssClass: "error", html: data.html_message});
                }
            },
            error: function ()
            {
                $.unblockUI();
                $.growl.error({ title:"Error",message: "Error fetching data from server." });
                //$.notifyBar({cssClass: "error", html: "Error fetching data from server."});
            }
        });
    }
    else
    {
        e.preventDefault();
    }
});

$('#forgot_password_form').parsley();
$('#forgot_password_form').on('submit', function (e)
{
    e.preventDefault();
    var f = $(this);
    f.parsley().validate();
    if (f.parsley().isValid())
    {
        $.ajax({
            url: "<?php echo $base_url;?>forgot-password-submit.php",
            type: "POST",
            data: $('#forgot_password_form').serialize(),
            dataType: 'json',
            encode: true,
            beforeSend: function ()
            {
                $.blockUI({message: '<img src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
            },
            success: function (data)
            {
                $.unblockUI();
                if (data.status == 'success')
                {
                    $('#forgot_password_form').trigger("reset");
                    $.growl.notice({ title:"Success",message: data.html_message });
                    $('#forgot_password_form').parsley().destroy();

                }
                else
                {
                    $.growl.error({ title:"Error",message: data.html_message });
                }
            },
            error: function ()
            {
                $.unblockUI();
                $.growl.error({ title:"Error",message: "Error fetching data from server." });
            }
        });
    }
    else
    {
        e.preventDefault();
    }
});

$('#reset_password_form').parsley();
$('#reset_password_form').on('submit', function (e)
{
    e.preventDefault();
    var f = $(this);
    f.parsley().validate();
    if (f.parsley().isValid())
    {
        $.ajax({
            url: "<?php echo $base_url;?>reset-password-submit.php",
            type: "POST",
            data: $('#reset_password_form').serialize(),
            dataType: 'json',
            encode: true,
            beforeSend: function ()
            {
                $.blockUI({message: '<img src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
            },
            success: function (data)
            {
                $.unblockUI();
                if (data.status == 'success')
                {
                    $.growl.notice({ title:"Success",message: data.html_message });
                    setTimeout(function ()
                    {
                        window.location.href = "<?php echo $base_url; ?>";
                    }, 2000);
                }
                else
                {
                    $.growl.error({ title:"Error",message: data.html_message });
                }
            },
            error: function ()
            {
                $.unblockUI();
                $.growl.error({ title:"Error",message: "Error fetching data from server." });
            }
        });
    }
    else
    {
        e.preventDefault();
    }
});

<?php
if($current_page == "account-information.php")
{
?>
$('#edit_profile_form').parsley();
$('#edit_profile_form').on('submit', function (e)
{
    e.preventDefault();
    var f = $(this);
    f.parsley().validate();
    if (f.parsley().isValid())
    {
        $.ajax(
            {
                url: "<?php echo $base_url;?>edit-profile-submit.php",
                type: "POST",
                data: $('#edit_profile_form').serialize(),
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
                        $.growl.notice({ title:"Success",message: data.html_message });
                        //$.notifyBar({cssClass: "success", html: data.html_message});
                        $('#top_user_name').html(data.user_name);

                    }
                    else
                    {
                        $.growl.error({ title:"Error",message: data.html_message });
                        //$.notifyBar({cssClass: "error", html: data.html_message});
                    }
                },
                error: function ()
                {
                    $.unblockUI();
                    $.growl.error({ title:"Error",message: "Error fetching data from server." });
                    //$.notifyBar({cssClass: "error", html: "Error fetching data from server."});
                }
            });
    }
    else
    {
        e.preventDefault();
    }
});
<?php
}
else if($current_page == "edit-password.php" )
{
?>
$('#password_form').parsley();
$('#password_form').on('submit', function (e)
{
    e.preventDefault();
    var f = $(this);
    f.parsley().validate();
    if (f.parsley().isValid())
    {
        $.ajax(
            {
                url: "<?php echo $base_url;?>edit-password-submit.php",
                type: "POST",
                data: $('#password_form').serialize(),
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
                        $('#password_form').trigger("reset");
                        $.growl.notice({ title:"Success",message: data.html_message });
                        //$.notifyBar({cssClass: "success", html: data.html_message});
                        $('#password_form').parsley().destroy();
                    }
                    else
                    {
                        $.growl.error({ title:"Error",message: data.html_message });
                        //$.notifyBar({cssClass: "error", html: data.html_message});
                    }
                },
                error: function ()
                {
                    $.unblockUI();
                    $.growl.error({ title:"Error",message: "Error fetching data from server." });
                    //$.notifyBar({cssClass: "error", html: "Error fetching data from server."});
                }
            });
    }
    else
    {
        e.preventDefault();
    }
});
<?php
}?>
<?php 
if($current_page == "cart.php")
{
?>
function update_cart(product_id, product_quantity, old_value)
{
    var formData =
        {
            'product_id': product_id,
            'product_quantity': product_quantity
        };
    $.ajax(
        {
            url: "<?php echo $base_url;?>update-cart-submit.php",
            type: "POST",
            data: formData,
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
                    //$.notifyBar({ cssClass: "success", html: data.html_message});
                    window.location.href = "<?php echo $base_url;?>cart";
                }
                else
                {
                    $.growl.error({ title:"Error",message: data.html_message });
                    //$.notifyBar({cssClass: "error", html: data.html_message});
                    $("#quantity_" + product_id).val(old_value);
                }
            },
            error: function (error)
            {
                $.growl.error({ title:"Error",message: "Error Loading data from server." });
                //$.notifyBar({cssClass: "error", html: "Error Loading data from server."});
            }
        });
}
<?php
}
if($current_page == "checkout.php")
{
?>
$('#shipping_address_model_div').on("hide.bs.modal", function() {
  $('#address_id option').prop('selected', function() {
      $('#address_id option').removeAttr('selected');
      $("#address_id option[value='001']").attr("selected", "selected");
  });
})


function modal_edit_address(edit_address_id)
{
    if (edit_address_id != '')
    {
        var UrlToPass = '&id=' + edit_address_id;
        $.ajax(
            {
                url: "<?php echo $base_url;?>modal-edit-address.php",
                type: "POST",
                data: UrlToPass,
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

                        //$('#selected_address_div').html('');
                        $('#edit_address_model_div').html(data.html_message);
                        $('#edit_address_model').modal('show');

                        $('#edit_address_form').on('submit', function (e)
                        {
                            e.preventDefault();
                            var f = $(this);
                            f.parsley().validate();
                            if (f.parsley().isValid())
                            {
                                $.ajax(
                                    {
                                        url: "<?php echo $base_url;?>edit-address-submit.php",
                                        type: "POST",
                                        data: $('#edit_address_form').serialize(),
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
                                                $('#edit_address_model').modal('hide');
                                                $('#selected_address_div').html(data.address_html_message);
                                                $('#select_address_dropdown_div').html(data.select_address_dropdown_html);
                                                $('#address_form_error_msg').html(data.html_message);
                                            }
                                            else
                                            {
                                                $('#address_form_error_msg').html(data.html_message);
                                                //$.notifyBar({ cssClass: "error", html: data.html_message});
                                            }
                                        },
                                        error: function (error)
                                        {
                                            $.growl.error({ title:"Error",message: "Error Loading data from server." });
                                            //$.notifyBar({cssClass: "error", html: "Error Loading data from server."});
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
                        $.growl.error({ title:"Error",message: data.html_message });
                        //$.notifyBar({cssClass: "error", html: data.html_message});
                    }
                },
                error: function (error)
                {
                    $.growl.error({ title:"Error",message: "Error Loading data from server." });
                    //$.notifyBar({cssClass: "error", html: "Error Loading data from server."});
                }
            });
    }
    else
    {
        $.growl.error({ title:"Error",message: "Please Select Address." });
        $('#selected_address_div').html('');
        //$.notifyBar({cssClass: "error", html: 'Please Select Address.'});
    }
}
function coupon_code_submit()
{
    var coupon_code = $("#coupon_code").val();
    var coupon_applied = $("#coupon_applied").val();
    var address_id = $("#address_id").val();
    /*if (coupon_code != '')
     {*/
    var formData =
        {
            'coupon_code': coupon_code,
            'coupon_applied': coupon_applied,
            'address_id': address_id,
        };
        $.ajax(
        {
            url: "<?php echo $base_url;?>coupon-form-submit.php",
            type: "POST",
            data: formData,
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
                    $("#coupon_code").val('');
                    //$('#coupon_form').trigger("reset");
                    //$('#contact_response_msg').html(data.html_message);
                    $.growl.notice({ title:"Success",message: data.html_message });
                    //$.notifyBar({cssClass: "success", html: data.html_message});
                    //$('#coupon_form').parsley().destroy();
                    setTimeout(function ()
                    {
                        location.reload();
                    }, 3000);
                }
                else
                {
                    $.growl.error({ title:"Error",message: data.html_message });
                    //$.notifyBar({cssClass: "error", html: data.html_message});
                }
            },
            error: function ()
            {
                $.unblockUI();
                $.growl.error({ title:"Error",message: "Error Loading data from server." });
                //$.notifyBar({cssClass: "error", html: "Error fetching data from server."});
            }
        });
    // }
    // else
    // {
    //  $.notifyBar({cssClass: "error", html: "Please Enter Coupon code..!"});
    // }

}
<?php
}
if($current_page == "my-order.php")
{
?>
function cancel_order_dialog(order_id)
{
    if (order_id != '')
    {
        $.ajax(
            {
                url: "<?php echo $base_url;?>cancel-order-dialog.php",
                type: "POST",
                data: {"order_id": order_id},
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
                        $('#cancel_order_modal_div').html(data.html_message);
                        $("#cancel_order_modal").modal("show");

                        $('#cancel_order_form').parsley().destroy();
                        $('#cancel_order_form').parsley();
                        $('#cancel_order_message').attr('data-parsley-required', 'true');

                        $('#cancel_order_form').on('submit', function (e)
                        {
                            e.preventDefault();
                            var f = $(this);
                            f.parsley().validate();
                            if (f.parsley().isValid())
                            {
                                $.ajax(
                                    {
                                        url: "<?php echo $base_url;?>cancel-order-submit.php",
                                        type: "POST",
                                        data: $('#cancel_order_form').serialize(),
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
                                                $.growl.notice({ title:"Success",message: data.html_message });
                                                //$.notifyBar({cssClass: "success", html: data.html_message});
                                                $('#cancel_order_button_div_' + data.order_id).html("");
                                                $('#cancel_order_form').trigger("reset");
                                                $("#cancel_order_modal").modal("hide");
                                                $('#my_order_status_' + data.order_id).html('<span class="label label-inverse" style="padding: 3px;color:#fff;background-color: #2a2a2a;">Cancelled</span>');
                                            }
                                            else
                                            {
                                                $.growl.error({ title:"Error",message: data.html_message });
                                                //$.notifyBar({cssClass: "error", html: data.html_message});
                                            }
                                        },
                                        error: function (error)
                                        {
                                            $.growl.error({ title:"Error",message: "Error Loading data from server." });
                                            //$.notifyBar({cssClass: "error", html: "Error Loading data from server."});
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
                        $.growl.error({ title:"Error",message: data.html_message });
                        //$.notifyBar({cssClass: "error", html: data.html_message});
                    }
                },
                error: function (error)
                {
                    $.growl.error({ title:"Error",message: "Error Loading data from server." });
                    //$.notifyBar({cssClass: "error", html: "Error Loading data from server."});
                }
            });
    }
    else
    {
        $.growl.error({ title:"Error",message: "Some Error Occured! Please try again." });
        //$.notifyBar({cssClass: "error", html: 'Some Error Occured! Please try again.'});
    }
}
<?php
}
?>

</script> 