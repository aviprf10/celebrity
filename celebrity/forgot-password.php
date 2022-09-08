<?php include('common/config.php');
//error_reporting(0);

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
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <div class="content"> <!-- content Start -->
                <form method="POST" id="forgot_password_form" data-parsley-validate>
                    <div class="panel panel-body login-form">
                        <div id="response_msg"></div>
                        <div class="text-center">
                            <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
                            <h5 class="content-group">Password recovery
                                <small class="display-block">We'll send you instructions in email</small>
                            </h5>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="email" name="email" class="form-control" placeholder="Your email" data-type="email" data-parsley-required="true">
                            <div class="form-control-feedback">
                                <i class="icon-mail5 text-muted" style="margin-left: -15px"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-success btn-block">Reset password <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>
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
        $('#forgot_password_form').parsley();
        $('#forgot_password_form').on('submit', function (e)
        {
            e.preventDefault();
            var f = $(this);
            f.parsley().validate();
            if (f.parsley().isValid())
            {
                $.ajax(
                    {
                        url: "<?php echo $base_url;?>forgot-password-submit.php",
                        type: "POST",
                        data: $('#forgot_password_form').serialize(),
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
                                $('#forgot_password_form').trigger("reset");
                                $('#forgot_password_form').parsley().destroy();
                                $('#response_msg').html(data.html_message);
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

