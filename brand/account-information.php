<?php
include "common/config.php";    
include "common/check_login.php";
include "common/common_code.php";
if($brand == 1)
{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Account Information | <?php echo $company_title;?></title>
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
</head>
<body class="category-page category-empty">
    <?php include 'common/header.php';?>
    <div id="page-content">
        <!--Collection Banner-->
        <div class="collection-header">
            <div class="collection-hero">
                <div class="collection-hero__image"></div>
                <div class="collection-hero__title-wrapper container">
                    <h1 class="collection-hero__title">Account Information</h1>
                    <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="<?php echo $base_url; ?>" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Account Information</span></div>
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
                           <h2>Account Information</h2>
                           <br/>
                           <div class="row m-t-30">
                              <form method="POST" id="edit_profile_form" data-parsley-validate class="form-horizontal">
                                 <div class="row">
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label class="form-label" for="form6Example1">Name</label>
                                             <input type="text" name="name" id="name" value="<?php echo $user_data['name'];?>" placeholder=" Name" data-parsley-required="true" class="form-control" />
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label class="form-label" for="form6Example5">Email</label>
                                             <input type="email" name="email" id="email" placeholder="E-Mail" value="<?php echo $user_data['email'];?>" data-parsley-required="true" class="form-control" />
                                          </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label class="form-label" for="form6Example6">Mobile</label>
                                          <input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo $user_data['mobile'];?>" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" data-parsley-required="true" maxlength="10" minlength="10" />
                                       </div>
                                    </div>   
                                 </div>   
                                 <div class="form-outline mb-4">
                                       <label class="text-left">Profile Pic 
                                       (450x450 : Max 2 MB) </label>
                                       <?php $i = 1; ?>
                                       <div  style="height: 150px;margin-left:15px;margin-top: 15px;">
                                          <div id="upload<?php echo $i; ?>"
                                             style="width: 103px;height: 100px;padding: 0px;"
                                             class="">
                                             <ul class="" id="files<?php echo $i; ?>"
                                             style="width: auto;padding: 0px;margin:0px;height: 103px;border: 1px solid #dedede;">
                                             <?php
                                                   $image_name = $user_data['profile_pic'];
                                                   
                                                      if ($image_name != '')
                                                      {
                                                         ?>
                                             <img src="<?php echo $brand_base_path_uploads; ?>profile-pic/size_100/<?php echo $image_name; ?>"
                                                   style="margin-bottom:20px;width: 103px;height: 100px;    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);">
                                             <div style="clear:both"></div>
                                             <a class="" style="cursor:pointer"
                                                   onclick="delete_upload(<?php echo $i; ?>)">
                                                   <i class="icon icon-subtract"></i>
                                                   <div style="clear:both"></div>
                                                   DELETE
                                             </a>
                                             <?php
                                                   }
                                                   else
                                                   {
                                                         ?>
                                             <center>
                                                   <i class="fa fa-user"
                                                      style="font-size: 20px;margin-top: 20px;"></i>
                                                   <div style="clear:both"></div>
                                                   ADD <br/> PHOTOS
                                             </center>
                                             <?php
                                                   }
                                                   ?>
                                             </ul>
                                             <input type="hidden"
                                             name="file_name<?php echo $i; ?>"
                                             id="file_name<?php echo $i; ?>" value="<?php echo $image_name; ?>">
                                             <div id="status<?php echo $i; ?>"></div>
                                          </div>
                                       </div>
                                 </div>
                                 <div class="form-outline mb-4">
                                       <button type="submit" class="btn btn-primary btn-block" style="width: 25%; float: left; margin-right: 16px;"> <a style="color: #fff;" href="<?php echo $base_url;?>account-dashboard" type="button">Back</a></button>
                                       <button type="submit" class="btn btn-primary btn-block" style="width: 25%;">Submit</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                    </div>
                    <!-- End Tab panes -->
                </div>
            </div>
            <!--End Main Content-->
        </div>
        <!--End Container-->
    </div> 
   <br><br> 
    <?php include 'common/footer.php';?>
    <?php include 'common/footer-js.php';?>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>admin/assets/css-upload/styles.css"/>
      <script type="text/javascript" src="<?php echo $base_url; ?>admin/assets/js-upload/ajaxupload.3.5.js"></script>
      <script>
         $(document).ready(function ()
          {
             <?php
            for($i = 1;$i <= 1;$i++){ ?>
            var file_name;
            $(function ()
            {
               var btnUpload = $('#upload<?php echo $i; ?>');
               var status = $('#status<?php echo $i; ?>');
               new AjaxUpload(btnUpload, {
                     action: '<?php echo $base_url1; ?>upload-profilepic-image.php',
                     name: 'uploadfile',
                     onSubmit: function (file, ext)
                     {
                        if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext)))
                        {
                           $('#status<?php echo $i; ?>').html('<p style="color:#d05165;margin-left:10px">Only JPG, JPEG, PNG or GIF files are allowed.</p>');
                           $('#files<?php echo $i; ?>').html('<center><i class="icon-plus-circle2" style="font-size: 20px;margin-top: 20px;"></i><div style="clear:both"></div>ADD <br/> PHOTOS </center>');
                           return false;
                        }
                        document.getElementById('files<?php echo $i; ?>').innerHTML = '<center><img src="<?php echo $base_url_images?>loading.gif" style="width:30px;margin-top:35px"></center>';
                     },
                     onComplete: function (file, response)
                     {
                        var file_name_split = response.split("$$");
                        file = file_name_split[1];
                        file1 = file_name_split[0];
            
                        if (file1 === "success")
                        {
                           document.getElementById('file_name<?php echo $i; ?>').value = file;
                           $('<li></li>').add('#files<?php echo $i; ?>').html('<img src="<?php echo $brand_base_path_uploads; ?>profile-pic/size_100/' + file + '" style="margin-bottom:20px;width:100%;height: 100%"  alt="" /><div style="clear:both"></div><a class="" style="cursor:pointor" onclick="delete_upload(<?php echo $i;?>)"><i class="icon icon-subtract"></i><div style="clear:both"></div>DELETE</a>').addClass('success');
                           $('#status<?php echo $i; ?>').html("");
                        }
                        else if (response == 'size_error')
                        {
                           $('#status<?php echo $i; ?>').html('<p style="color:#d05165;margin-left:10px">Please upload image with max size 2MB.</p>');
                           $('#files<?php echo $i; ?>').html('<center><i class="fa fa-user" style="font-size: 20px;margin-top: 20px;"></i><div style="clear:both"></div>ADD <br/> PHOTOS </center>');
                           return false;
                        }
                        else
                        {
                           $('<li></li>').add('#files<?php echo $i; ?>').text(file).addClass('error');
                        }
                     }
               });
            });
          <?php
            }
            ?>
          });
         function delete_upload(delete_file_id)
         {
               $('#files' + delete_file_id).html('<center style="margin-top: 20px;"><i class="icon-plus-circle2"></i><div style="clear:both"></div>ADD <br/> PHOTOS </center>');
               $('#file_name' + delete_file_id).val("");
         }
      </script>
    </body>    
</html>   
<?php 
} 
else
{
   echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$base_url.'registration">';
}
?>    