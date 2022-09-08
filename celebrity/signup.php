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
    <title><?php echo $company_title; ?> - Signup</title>
    <?php include('common/header-css.php'); ?>
    <style>
        .rounded-round {
            border-radius: 100px!important;
        }
        .border-3 {
            border: 3px solid;
        }
        .p-3 {
            padding: 3.25rem!important;
        }
        .mb-3, .my-3 {
            margin-bottom: 1.25rem!important;
        }

        .mt-1, .my-1 {
            margin-top: 2.3125rem!important;
        }
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            text-align: -webkit-center;
        }
    </style>
</head>

<body style="background:url(assets/images/bggg.jpeg), no-repeat; background-size: cover;">

<?php include('common/header.php'); ?>

<!-- Page container -->
<div class="page-container" >
    <div class="page-content">
        <div class="content-wrapper">
            <div class="content d-flex justify-content-center align-items-center"> <!-- content Start -->
                <form method="POST" id="signup_form" data-parsley-validate>
                    <div class="row">
                    	<div class="col-lg-6 offset-lg-3" style="float:unset; background: #fff;  border-radius: 4px;  box-shadow: 5px 5px 5px 5px #0d0d0d14;">
							<div class="card mb-0">
								<div class="card-body">
									<div class="text-center mb-3">
										<i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1" style="margin-bottom:0px !important"></i>
										<h5 class="mb-0">Create account</h5>
										<span class="d-block text-muted">All fields are required</span>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-group-feedback form-group-feedback-right">
												<input type="text" name="first_name" class="form-control" placeholder="First name" data-parsley-required="true">
												<div class="form-control-feedback">
													<i class="icon-user-check text-muted"></i>
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group form-group-feedback form-group-feedback-right">
												<input type="text" name="last_name" class="form-control" placeholder="Last name" data-parsley-required="true">
												<div class="form-control-feedback">
													<i class="icon-user-check text-muted"></i>
												</div>
											</div>
										</div>
									</div>
                                    <div class="row">
										<div class="col-md-6">
											<div class="form-group form-group-feedback form-group-feedback-right">
												<input type="email" name="email" class="form-control" placeholder="Your email" data-parsley-required="true">
												<div class="form-control-feedback">
													<i class="icon-mention text-muted"></i>
												</div>
											</div>
										</div>
                                        <div class="col-md-6">
											<div class="form-group form-group-feedback form-group-feedback-right">
												<input type="password" name="password" class="form-control" placeholder="Create password" data-parsley-required="true">
												<div class="form-control-feedback">
													<i class="icon-user-lock text-muted"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-group-feedback form-group-feedback-right">
												<input type="password" name="confirm_password" class="form-control" placeholder="Repeat password" data-parsley-required="true">
												<div class="form-control-feedback">
													<i class="icon-user-lock text-muted"></i>
												</div>
											</div>
										</div>
                                        <div class="col-md-6">
											<div class="form-group form-group-feedback form-group-feedback-right">
												<select class="form-control select2"  name="gender" data-parsley-required="true">
                                                    <option value="">Select Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
											</div>
										</div>
									</div>
                                    <div class="row">
										<div class="col-md-6">
											<div class="form-group form-group-feedback form-group-feedback-right">
												<input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="mobile" data-parsley-type="number" placeholder="Mobile" maxlength="10" data-parsley-required="true">
												<div class="form-control-feedback">
													<i class="icon-mobile text-muted"></i>
												</div>
											</div>
										</div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-feedback form-group-feedback-right">
												<input type="text" class="form-control pickadate-accessibility"  name="date_of_birthday" id="date_of_birthday" data-parsley-required="true"  placeholder="Date of birth">
												<div class="form-control-feedback">
													<i class="icon-calendar22 mr-2"></i>
												</div>
											</div>
										</div>
									</div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-feedback form-group-feedback-right">
												<input type="text" class="form-control"  name="social_media" id="social_media" data-parsley-required="true"  placeholder="Enter Social Media Url">
												<div class="form-control-feedback">
													<i class="icon-search4 text-muted"></i>
												</div>
											</div>
										</div>
                                    </div>    
									
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button type="submit" class="btn bg-<?php echo $theme_color; ?> btn-block">Sign Up <i class="icon-user-plus position-right"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <a href="<?php echo $base_url ?>login" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></a>
                                            </div>
                                        </div>
                                    </div><br><br>
								</div>
							</div>
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

        $('#date_of_birthday').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD-MM-YYYY'
            }
        }).val('');

        $('#signup_form').parsley();
        $('#signup_form').on('submit', function (e)
        {
            e.preventDefault();
            var f = $(this);
            f.parsley().validate();
            if (f.parsley().isValid())
            {
                $.ajax(
                    {
                        url: "<?php echo $base_url;?>signup-submit.php",
                        type: "POST",
                        data: $('#signup_form').serialize(),
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
                                $('#signup_form').trigger("reset");
                                //$('#response_msg').html(data.html_message);
                                $.notifyBar({cssClass: "success", html: data.html_message});
                                setTimeout(function ()
                                {
                                    window.top.location="<?php echo $base_url; ?>profile-details";
                                }, 2000);
                            }
                            else
                            {
                               $.notifyBar({cssClass: "error", html: data.html_message});
                                //$('#response_msg').html(data.html_message);
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

