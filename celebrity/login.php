<?php include('common/config.php');
error_reporting(0);

$theme_color = 'slate';         // This will be the default color before login,  change this color according to user display settings
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $company_title; ?> - Login</title>
    <?php include('common/header-css.php'); ?>
</head>

<body class="login-container" style="background:url(assets/images/bggg.jpeg), no-repeat; background-size: cover;">

<?php include('common/header.php'); ?>

<!-- Page container -->
<div class="page-container" >
    <div class="page-content">
        <div class="content-wrapper">
            <div class="content"> <!-- content Start -->
                <form method="POST" id="login_form" data-parsley-validate>
                    <div class="panel panel-body login-form">
                        <div id="response_msg"></div>
                        <div class="text-center">
                            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-user-lock"></i></div>
                            <h5 class="content-group">Login to your account </h5>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email" data-parsley-required="true">
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password" data-parsley-required="true">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn bg-<?php echo $theme_color; ?> btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
                            <a href="<?php echo $base_url ?>signup" class="btn btn-primary btn-block">Sign up <i class="icon-user-plus position-right"></i></a>
                        </div>

                        <div class="text-center">
                            <a href="<?php echo $base_url;?>forgot-password">Forgot password?</a>
                        </div>
                    </div>
                </form>
                <!-- /simple login form -->

                <?php include('common/footer.php'); ?>
            </div> <!-- content ent -->
        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

<script src="<?php echo $base_url_js; ?>plugins/parsley/parsley.min.js"></script>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $('#login_form').parsley();
        $('#login_form').on('submit', function (e)
        {
            e.preventDefault();
            var f = $(this);
            f.parsley().validate();
            if (f.parsley().isValid())
            {
                $.ajax(
                    {
                        url: "<?php echo $base_url;?>login-submit.php",
                        type: "POST",
                        data: $('#login_form').serialize(),
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
                                if (data.page != '')
                                {
                                    window.location.href = '<?php echo $base_url;?>' + data.page;
                                    $('#response_msg').html(data.html_message);
                                }
                                else
                                {
                                    //$('#login_form').trigger("reset");
                                    //$('#response_msg').html(data.html_message);
                                }
                            }
                            else
                            {
//                                $.notifyBar({cssClass: "error", html: data.html_message});
                                $('#response_msg').html(data.html_message);
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

