
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
    });
}); 
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
                    url: "<?php echo $base_url1; ?>add-to-cart-submit.php",
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
            url: "<?php echo $base_url1;?>add-to-cart-submit.php",
            type: "POST",
            data: formData,
            dataType: 'json',
            encode: true,
            beforeSend: function ()
            {
                $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url1?>loading.gif" alt="Loading.."/>'});
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
            url: "<?php echo $base_url1;?>add-to-cart-submit.php",
            type: "POST",
            data: formData,
            dataType: 'json',
            encode: true,
            beforeSend: function ()
            {
                $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url1?>loading.gif" alt="Loading.."/>'});
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
                        window.location.href = '<?php echo $base_url1 ?>checkout';
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
                url: "<?php echo $base_url1;?>add-to-wishlist-submit.php",
                type: "POST",
                data: formData,
                dataType: 'json',
                encode: true,
                beforeSend: function ()
                {
                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url1?>loading.gif" alt="Loading.."/>'});
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
        window.location.href = '<?php echo $base_url1;?>registration';
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
            url: "<?php echo $base_url1;?>get-cart-items.php",
            type: "POST",
            data: {ID: '1'},
            dataType: 'json',
            encode: true,
            beforeSend: function ()
            {
                $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url1?>loading.gif" alt="Loading.."/>'});
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
        url: "<?php echo $base_url1;?>remove-from-cart-submit.php",
        type: "POST",
        data: formData,
        dataType: 'json',
        encode: true,
        beforeSend: function ()
        {
            $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url1?>loading.gif" alt="Loading.."/>'});
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
                        $("#cart_page_main_div").html('<center><img src="<?php echo $base_url1?>empty-cart.png"></center>');

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
            url: "<?php echo $base_url1;?>login-submit.php",
            type: "POST",
            data: $('#login_form').serialize(),
            dataType: 'json',
            encode: true,
            beforeSend: function ()
            {
                $.blockUI({message: '<img src="<?php echo $base_url1?>loading.gif" alt="Loading.."/>'});
            },
            success: function (data)
            {
                $.unblockUI();
                if (data.status == 'success')
                {
                    if (data.page != '')
                    {
                        window.location.href = '<?php echo $base_url1;?>' + data.page;
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
            url: "<?php echo $base_url1;?>signup-submit.php",
            type: "POST",
            data: $('#registration_form').serialize(),
            dataType: 'json',
            encode: true,
            beforeSend: function ()
            {
                $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url1;?>loading.gif" alt="Loading.."/>'});
            },
            success: function (data)
            {
                
                $.unblockUI();
                if (data.status == 'success')
                {
                    $.growl.notice({ title:"success",message: data.html_message });
                    setTimeout(function ()
                    {
                        window.top.location="<?php echo $base_url1; ?>";
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

$('#forgot_password_form').parsley();
$('#forgot_password_form').on('submit', function (e)
{
    e.preventDefault();
    var f = $(this);
    f.parsley().validate();
    if (f.parsley().isValid())
    {
        $.ajax({
            url: "<?php echo $base_url1;?>forgot-password-submit.php",
            type: "POST",
            data: $('#forgot_password_form').serialize(),
            dataType: 'json',
            encode: true,
            beforeSend: function ()
            {
                $.blockUI({message: '<img src="<?php echo $base_url1?>loading.gif" alt="Loading.."/>'});
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
            url: "<?php echo $base_url1;?>reset-password-submit.php",
            type: "POST",
            data: $('#reset_password_form').serialize(),
            dataType: 'json',
            encode: true,
            beforeSend: function ()
            {
                $.blockUI({message: '<img src="<?php echo $base_url1?>loading.gif" alt="Loading.."/>'});
            },
            success: function (data)
            {
                $.unblockUI();
                if (data.status == 'success')
                {
                    $.growl.notice({ title:"Success",message: data.html_message });
                    setTimeout(function ()
                    {
                        window.location.href = "<?php echo $base_url1; ?>";
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
                url: "<?php echo $base_url1;?>edit-profile-submit.php",
                type: "POST",
                data: $('#edit_profile_form').serialize(),
                dataType: 'json',
                encode: true,
                beforeSend: function ()
                {
                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url1?>loading.gif" alt="Loading.."/>'});
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
                url: "<?php echo $base_url1;?>edit-password-submit.php",
                type: "POST",
                data: $('#password_form').serialize(),
                dataType: 'json',
                encode: true,
                beforeSend: function ()
                {
                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url1?>loading.gif" alt="Loading.."/>'});
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
            url: "<?php echo $base_url1;?>update-cart-submit.php",
            type: "POST",
            data: formData,
            dataType: 'json',
            encode: true,
            beforeSend: function ()
            {
                $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url1?>loading.gif" alt="Loading.."/>'});
            },
            success: function (data)
            {
                $.unblockUI();
                if (data.status == 'success')
                {
                    //$.notifyBar({ cssClass: "success", html: data.html_message});
                    window.location.href = "<?php echo $base_url1;?>cart";
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
                url: "<?php echo $base_url1;?>modal-edit-address.php",
                type: "POST",
                data: UrlToPass,
                dataType: 'json',
                encode: true,
                beforeSend: function ()
                {
                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url1?>loading.gif" alt="Loading.."/>'});
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
                                        url: "<?php echo $base_url1;?>edit-address-submit.php",
                                        type: "POST",
                                        data: $('#edit_address_form').serialize(),
                                        dataType: 'json',
                                        encode: true,
                                        beforeSend: function ()
                                        {
                                            $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url1?>loading.gif" alt="Loading.."/>'});
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
            url: "<?php echo $base_url1;?>coupon-form-submit.php",
            type: "POST",
            data: formData,
            dataType: 'json',
            encode: true,
            beforeSend: function ()
            {
                $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url1?>loading.gif" alt="Loading.."/>'});
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
                url: "<?php echo $base_url1;?>cancel-order-dialog.php",
                type: "POST",
                data: {"order_id": order_id},
                dataType: 'json',
                encode: true,
                beforeSend: function ()
                {
                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url1?>loading.gif" alt="Loading.."/>'});
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
                                        url: "<?php echo $base_url1;?>cancel-order-submit.php",
                                        type: "POST",
                                        data: $('#cancel_order_form').serialize(),
                                        dataType: 'json',
                                        encode: true,
                                        beforeSend: function ()
                                        {
                                            $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url1?>loading.gif" alt="Loading.."/>'});
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