<?php
include "common/config.php";    
include "common/check_login.php";
include "common/common_code.php";
$title = $_GET['title'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Signin | Signup  | <?php echo $company_title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:keyword" content="<?php echo $meta_keyword;?>" />
    <meta property="og:title" content="<?php echo $company_title;?>" />
     <meta property="og:description" content="<?php echo $meta_description;?>" />
    <meta name="robots" content="noindex, follow" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="32x32" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="<?php echo $base_url_images; ?>fevicon.png" />
    <meta name="msapplication-TileImage" content="<?php echo $base_url_images; ?>fevicon.png" />
    <?php include "common/header-css.php";?>
</head>
<body class="login-page">
   <?php include 'common/header.php';?>
   <div id="page-content">   
      <!--Collection Banner-->
      <div class="collection-header">
         <div class="collection-hero">
            <div class="collection-hero__image"></div>
            <div class="collection-hero__title-wrapper container">
                  <h1 class="collection-hero__title">Login</h1>
                  <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="index.html" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Login</span></div>
            </div>
         </div>
      </div>
      <!--End Collection Banner-->

      <!--Container-->
      <div class="container">
         <!--Main Content-->
         <div class="login-register pt-2 pt-lg-5">
            <div class="row">
                  <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4 mb-md-0">
                     <div class="inner">
                        <form method="POST" id="login_form" role="form" data-parsley-validate>	
                              <h3 class="h4 text-uppercase">LOGIN|SIGNIN CUSTOMERS</h3>
                              <p>If you have an account with us, please log in.</p>
                              <div class="row">
                                 <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                          <label for="CustomerEmail" class="d-none">Email Id or Mobile No <span class="required">*</span></label>
                                          <input type="text" name="login_id" id="login_id" placeholder="E-Mail or Mobile" data-parsley-required="true"/>
                                          <input type="hidden"  name="login_id_session" id="login_id_session" value="<?php echo $_SESSION['wishlist_current_page_'.$company_name_session];?>" data-parsley-required="true"/>
                                    </div>
                                 </div>
                                 <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                          <label for="CustomerPassword" class="d-none">Password <span class="required">*</span></label>
                                          <input placeholder="Password"  type="password" name="password" id="password" data-parsley-required="true" />                        	
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="text-left col-12 col-sm-12 col-md-12 col-lg-12">
                                    <p class="d-flex-center">
                                          <input type="submit" class="btn rounded me-auto" value="Sign In">
                                          <!-- <a href="forgot-password.html">Forgot your password?</a> -->
                                    </p>
                                 </div>
                              </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                     <div class="inner">
                        <h3 class="h4 text-uppercase">NEW CUSTOMER?</h3>
                        <p>If you have no an account with us, please sign up.</p>
                        <form method="POST" id="registration_form" data-parsley-validate class="form-horizontal">
                           <div class="row mb-6">
                              <div class="col">
                                 <div class="form-outline">
                                    <label class="form-label" for="form6Example1">First name</label>
                                    <input type="text" name="first_name" id="first_name" placeholder="First Name" data-parsley-required="true" class="form-control" />
                                 </div>
                              </div>
                              <div class="col">
                                 <div class="form-outline">
                                    <label class="form-label" for="form6Example2">Last name</label>
                                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" data-parsley-required="true" class="form-control" />
                                 
                                 </div>
                              </div>
                           </div><br>
                           <div class="form-outline mb-4">
                              <label class="form-label" for="form6Example5">Email</label>
                              <input type="email" name="email" id="email" placeholder="E-Mail" data-parsley-required="true" class="form-control" style=" width: 68%;float: left;" />
                              <span class="help-inline" id="generate_otp_button_div"><input type="button" onclick="get_generate_mobile_otp()" class="btn btn-primary btn-block mb-4" name="register" value="Send OTP" style="margin-left: 10px; width:30%;"></span>

                              <span class="help-inline" id="resend_otp_button_div" style="display: none;"><input type="button" onclick="get_generate_mobile_otp()"  style=" width: 29%;   margin-left: 15px;" class="btn btn-primary btn-block mb-4" name="resend" value="Resend OTP"></span>
                              <span id="mobile_verification_status"> </span>
                           </div>
                           <div id="otp_verify_div" style="display:none; margin-bottom: 15px;">
                              <div class="get-insuracne-two__input-box">
                                 <input type="text" style=" width: 68%;float: left;" class="form-control unicase-form-control text-input" placeholder="OTP No" name="input_otp" id="input_otp" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  autocomplete="off">
                                 <span class="help-inline" style="margin:0px;">
                                 <input type="button" onclick="get_verify_mobile_otp()" class="btn btn-primary btn-block mb-4" style="margin-left: 14px; width: 29%;" name="resend" value="Verify" />
                                 </span>  
                              </div>
                           </div>
                           <div class="row mb-6">
                              <div class="col">
                                 <div class="form-outline">
                                    <label class="form-label" for="form6Example1">Password</label>
                                    <input type="password" name="password" id="password"  placeholder="Password" maxlength="30" minlength="6"  data-parsley-required="true" class="form-control" />
                                 </div>
                              </div>
                              <div class="col">
                                 <div class="form-outline">
                                    <label class="form-label" for="form6Example2">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password"  placeholder="Confirm Password" maxlength="30" minlength="6"  data-parsley-required="true" class="form-control" />
                                 
                                 </div>
                              </div>
                           </div>
                           <div class="form-outline mb-4">
                              <label class="form-label" for="form6Example6">Mobile</label>
                              <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" data-parsley-required="true" maxlength="10" minlength="10" />
                           </div>
                           <div class="form-outline mb-4">
                              <label class="form-label" for="form6Example6">Instagram USERNAME or URL</label>
                              <input type="text" name="insta_id" id="insta_id" class="form-control" placeholder="Instagram USERNAME or URL" data-parsley-required="true"/>
                           </div>
                           <div class="row mb-6">
                              <div class="col">
                                 <div class="form-outline">
                                    <?php
                                    $country_data_array = array();
                                    $get_country_data = "select  * FROM country WHERE  status = '1'  AND is_deleted = '0' ";
                                    $result_country_data = mysqli_query($db_mysqli,$get_country_data);
                                    while ($row_country_data = mysqli_fetch_assoc($result_country_data))
                                    {
                                       $country_data_array[] = $row_country_data;
                                    } 
                                    ?>
                                    <label>Country:  <span class="asterisk-mark">*</span></label>
                                    <select name="country_id" id="country_id" data-placeholder="Select Country" class="form-control" data-parsley-required="true" onchange="get_state_selection(this.value)">
                                       <option value="">Select Country</option>
                                       <?php 
                                       if(count($country_data_array)>0)
                                       {
                                          foreach ($country_data_array as $country_data)
                                          {  
                                    ?>
                                          <option value="<?php echo $country_data['id'];?>"><?php echo $country_data['country_name'];?></option>
                                       <?php 
                                          } 
                                       } 
                                       ?>
                                    </select>
                                 </div>
                              </div> 
                              <div class="col">
                                 <div class="form-outline" id="state_selection_div">
                                    
                                 </div>
                              </div>         
                           </div> <br>
                           <div class="row mb-6">
                              <div class="col">
                                 <div class="form-outline" id="city_selection_div">
                                    
                                 </div>
                              </div>         
                           </div>   <br>
                           <div class="form-outline mb-4">
                              <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                    <label for="gender">Gender<span class="required">*</span> </label>
                                    <label>
                                       <input type="radio" name="gender" id="gender" value="male" data-parsley-multiple="gender" checked> Male &nbsp; &nbsp; &nbsp;
                                       
                                       <input type="radio" name="gender" id="gender" value="female" data-parsley-multiple="gender"> Female
                                    </label>
                              </p>
                              
                           </div>
                           <!-- Submit button -->
                           <button type="submit" class="btn btn-primary btn-block mb-4">Sign Up</button>
                     </form>
                     </div>
                  </div>
            </div>
         </div>
         <!--End Main Content-->
      </div>
      <!--End Container-->
</div>
    <?php include 'common/footer.php';?>
    <?php include 'common/footer-js.php';?>
    <script>
      var form_id = '';
      function get_state_selection(country_id)
      {
         $.ajax({
            url: "<?php echo $base_url;?>get-state-selection-div.php",
            type: "POST",
            data: {"country_id": country_id},
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
                     $('#state_selection_div').html(data.html_message);
                     $('#city_selection_div').html("");
                     $('#state_id').attr('data-parsley-required', 'true');
               }
               else
               {
                     $('#state_selection_div').html("");
                     $('#state_id').attr('data-parsley-required', 'false');
               }
            },
            error: function ()
            {
               $.unblockUI();
               $('#city_selection_div').html("");
               $('#state_selection_div').html("");
            }
         });
      }

      function get_city_selection(state_id)
      {
         if (state_id > 0)
         {
               $.ajax({
                  url: "<?php echo $base_url;?>get-city-selection-div.php",
                  type: "POST",
                  data: {"state_id": state_id},
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
                           $('#city_selection_div').html(data.html_message);
                           $('#city_id').attr('data-parsley-required', 'true');
                     }
                     else
                     {
                           $('#city_selection_div').html("");
                     }
                  },
                  error: function ()
                  {
                     $.unblockUI();
                     $('#city_selection_div').html("");
                  }
               });
         }
         else
         {
               $('#city_selection_div').html("");
         }
      }
    </script>
    <script type="text/javascript">
      function get_generate_mobile_otp()
      {
         var email = $('#email').val();
         var hide_modal = 0;
         if(email == "") 
         {
               $.growl.error({ title: "Error", message: "Please enter valid email."});
         }
         else 
         {    

               $('#generate_otp').attr("enabled","true");
               $.ajax(
               {
                  url      : "<?php echo $base_url; ?>get-generate-otp.php",
                  type     : "POST",
                  data    : {"email":email}, 
                  dataType: 'json', 
                  encode  : true,
                  beforeSend: function(){
                     $.blockUI({ message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>' });
                  },
                  success:function(data)
                  {
                     $.unblockUI();
                     
                     if(data.status == 'success')
                     {
                        $('#generate_otp_button_div').css({"display":"none"});
                        $('#resend_otp_button_div').css({"display":"block"});
                        //timer_count();
                        $('#mobile_verification_status').html("");
                        $('#otp_verify_div').css({"display":"block"});
                        $.growl.notice({ title:"Success",message: data.html_message });
                        //$.notifyBar({ cssClass: "Success", html: data.html_message});
                        //$('#input_otp').val(data.generate_otp);
                        //$('select').select2();
                     }
                     else if(data.status == 'error')
                     {
                        $('#generate_otp_button_div').css({"display":"none"});
                        $('#resend_otp_button_div').css({"display":"block"}); 
                        $.growl.error({ title:"Error",message: data.html_message });
                        //$.notifyBar({ cssClass: "error", html: data.html_message});
                     }
                  },
                  error: function (error) 
                  {
                     $.unblockUI();
                     $.growl.error({ title:"Error",message:"Error occured: Please try again!" });
                     //$.notifyBar({ cssClass: "error", html: "Error occured: Please try again!"});
                  }
               });
         }   
      }
      function get_verify_mobile_otp()
      {
         var input_otp = $('#input_otp').val();
         //var mobile = $('#mobile').val();
         var email = $('#email').val();
         
         $.ajax(
         {
               url      : "<?php echo $base_url; ?>get-verify-otp.php",
               type     : "POST",
               data    : {"input_otp":input_otp,"email":email}, 
               dataType: 'json', 
               encode  : true,
               beforeSend: function(){
                  $.blockUI({ message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>' });
               },
               success:function(data)
               {
               $.unblockUI();
               
               if(data.status == 'success')
               {
                     $('#generate_otp_div').css({"display":"none"});
                     $('#otp_verify_div').css({"display":"none"});
                     //$('#mobile').attr('readonly',true);
                     $('.btn-register').attr('disabled',false);
                     $('.btn-step').attr('disabled',false);
                     $('#resend_otp_button_div').css({"display":"none"});

                     
                     $('#mobile_verification_status').html(data.mobile_verification_status);
                     $('#mobile_verification_status').css({"color":"green",'font-size': '15px','width':'100px'});
                     $.growl.notice({ title:"Success",message: data.html_message });
                     //$.notifyBar({ cssClass: "Success", html: data.html_message});
                     //$('select').select2();
               }
               else
               {
                     $.growl.error({ title:"Error",message: data.html_message });
                     //$.notifyBar({ cssClass: "error", html: data.html_message});

                     $('#mobile_verification_status').html(data.mobile_verification_status);
                     $('#mobile_verification_status').css({"color":"#d40511",'font-size': '15px','width':'100px'});
                     
               }
               },
               error: function (error) 
               {
                  $.unblockUI();
                     $.growl.error({ title:"Error",message:"Error occured: Please try again!"});
                     //$.notifyBar({ cssClass: "error", html: "Error occured: Please try again!"});

               }
         });
      }
    </script>
    </body>    
</html>      