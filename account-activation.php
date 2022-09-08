<?php include "common/config.php";?>
<!DOCTYPE html>
<html lang="en-US" id="parallax_scrolling">
   <head>
      <title>Account Activation | <?php echo $company_title;?></title>
      <?php include "common/header-css.php";?>
   </head>
   <body class="page-template-default page page-id-8 cms-index-index cms-home-page woocommerce-account woocommerce-page cms-index-index inner-page" >
     <div id="loading">
         <center><img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading..."/></center>
      </div>
      <div id="main_site_div" style="display:none;">
        <div id="page" class="page catalog-category-view">
           <?php include "common/header.php";?>
           <div class="page-heading ">
              <div class="breadcrumbs">
              </div>
              <div class="page-title">
                 <h1 class="entry-title">
                    Account Activation
                 </h1>
              </div>
           </div>
           <div class="main-container col1-layout wow bounceInUp">
              <div class="container">
                 <div class="row">
                    <div class="col-main col-sm-12" id="content">
                       <div class="page-content">
                          <div class="woocommerce">
                             <div class="u-columns col1-set">
                                <div class="u-column1 col-1">
                                     <?php
                          $user_activation_id = $_REQUEST['id'];
                          if($user_activation_id != '')
                          {
                            $get_user_temp = "Select * FROM user_temp WHERE unique_key='$user_activation_id'";
                            $result_user_temp = mysqli_query($db_mysqli,$get_user_temp);
                            while ($row_user_temp = mysqli_fetch_assoc($result_user_temp))
                            {
                               $first_name = $row_user_temp['first_name'];
                               $last_name = $row_user_temp['last_name'];
                               $user_name = $first_name."-".$last_name;
                               $user_unique_slug = get_unique_slug1($db_mysqli, $user_name,'user','user_name');
                               $email = $row_user_temp['email'];
                               $password = $row_user_temp['password'];
                               $gender = $row_user_temp['gender'];
                               $mobile = $row_user_temp['mobile'];
                               $user_type = $row_user_temp['user_type'];
                               $status = $row_user_temp['status'];
                               $unique_key = $row_user_temp['unique_key'];
                               $ip_address = $row_user_temp['ip_address'];
                               //$created_on = $row_user_temp['created_on'];
                            }

                            if($status == 0)
                            {
                              $result_update_user_temp = mysqli_query($db_mysqli,"update user_temp set status='1' WHERE unique_key='$user_activation_id'");
                          
                              if($result_update_user_temp)
                              {
                                $registration_date= date("Y-m-d H:i:s");
                                $result_insert_user = mysqli_query($db_mysqli,"INSERT INTO `user`(`first_name`, `last_name`, `user_name`, `user_unique_slug`, `email`, `password`, `gender`, `mobile`, `user_type`, `status`,`unique_key`,`registration_date`,`ip_address`,`is_deleted`)  VALUES ('$first_name', '$last_name', '$user_name', '$user_unique_slug', '$email', '$password', '$gender', '$mobile', '2', '1','$unique_key','$registration_date','$ip_address','0')");
                                if($result_insert_user)
                                {
                                  ?>
                                  <div class="alert alert-success alert-dismissible"><i class="fa fa-exclamation-circle"></i> Account Activated Successfully! <br/> Please <b><a href="<?php echo $base_url;?>registration" id="login_link">click here</a></b> to login.</div>
                                  <?php
                                }
                              }
                              else
                              {
                                ?>
                               <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> This Link Is Expired! </div>
                                <?php
                              }
                            }
                            else
                            {
                              ?>
                             <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> This Link Is Expired! </div>
                              <?php
                            }
                          }
                          else
                          {
                            ?>
                           <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> This Link Is Expired! </div>  
                            <?php
                          }
                          ?>
                                </div>
                             </div>
                          </div>
                       </div>
                       <!-- .entry-content -->
                    </div>
                 </div>
              </div>
           </div>
           <?php include "common/footer.php";?>
        </div>
      </div>
        <?php include "common/common-mobile-menu.php";?>
      <?php include "common/footer-js.php";?>
   </body>
</html>