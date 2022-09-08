<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
       
        $edit_id = Secure1($db_mysqli, $_POST['edit_id']);

        $user_type  = Secure1($db_mysqli, $_POST['user_type']);
        $first_name = Secure1($db_mysqli, $_POST['first_name']);
        $last_name  = Secure1($db_mysqli, $_POST['last_name']);
        $email      = Secure1($db_mysqli, $_POST['email']);
        $gender     = Secure1($db_mysqli, $_POST['gender']);
        $mobile     = Secure1($db_mysqli, $_POST['mobile']);
        $password     = Secure1($db_mysqli, $_POST['password']);
        $payment_percentage     = Secure1($db_mysqli, $_POST['payment_percentage']);
        $date_of_birthday   = Secure1($db_mysqli, $_POST['date_of_birthday']);
        $user_name       = $first_name.' '. $last_name;
        $updated_on   = get_current_date_time();
        $facebook_link   = $_POST['facebook_link'];
        $twitter_link   = $_POST['twitter_link'];
        $instagram_link   = $_POST['instagram_link'];
        $whatsapp_link   = $_POST['whatsapp_link'];
        $linkedin_link   = $_POST['linkedin_link'];
        $google_link   = $_POST['google_link'];
        $profile_link_url   = $_POST['profile_link_url'];
        $follower_count         = Secure1($db_mysqli, $_POST['follower_count']);
        $brand_celebration_price         = Secure1($db_mysqli, $_POST['brand_celebration_price']);
        $is_pramotion = Secure1($db_mysqli, $_POST['is_pramotion']);
        if(!empty($_POST['category_id']))
        {
            $cate_data = '';
            foreach($_POST['category_id'] as $catvalue)
            {
                $cate_data .=$catvalue.',';
            }
            $category_id = substr($cate_data, 0,-1);
        }
        if(!empty($_POST['sub_category_id']))
        {
            $subcate_data = '';
            foreach($_POST['sub_category_id'] as $scatvalue)
            {
                $subcate_data .=$scatvalue.',';
            }
            $sub_category_id = substr($subcate_data, 0,-1);
        }
    
        if(!empty($_POST['giftcat_id']))
        {
            $giftcat_data = '';
            foreach($_POST['giftcat_id'] as $gscatvalue)
            {
                $giftcat_data .=$gscatvalue.',';
            }
            $giftcat_id = substr($giftcat_data, 0,-1);
        }
        if(!empty($_POST['giftsubcat_id']))
        {
            $giftscat_data = '';
            foreach($_POST['giftsubcat_id'] as $gsscatvalue)
            {
                $giftscat_data .=$gsscatvalue.',';
            }
            $giftsubcat_id = substr($giftscat_data, 0,-1);
        }
        
        if(!empty($_POST['giftsubsubcat_id']))
        {
            $giftsscat_data = '';
            foreach($_POST['giftsubsubcat_id'] as $gsscatvalue)
            {
                $giftsscat_data .=$gsscatvalue.',';
            }
            $giftsubsubcat_id = substr($giftsscat_data, 0,-1);
        }

        if(!empty($_POST['language_spoken']))
        {
            $languagespoken_data = '';
            foreach($_POST['language_spoken'] as $languagespokenvalue)
            {
                $languagespoken_data .=$languagespokenvalue.',';
            }
            $language_spoken = substr($languagespoken_data, 0,-1);
        }
        $date = date('dmyhsi');
        $user_unique_slug = '';
        $user_unique_slug = get_unique_slug1($db_mysqli, $user_name, 'user', 'user_name');
        $full_description    = Secure1($db_mysqli, $_POST['full_description']);
        $meta_title          = Secure1($db_mysqli, $_POST['meta_title']);
        $arr_search_keywords = $_POST['search_keywords'];
        $search_keywords     = implode(',', $arr_search_keywords);
        $meta_description    = Secure1($db_mysqli, $_POST['meta_description']);
        $logge_user_name 	 = str_replace('-', '_', $user_unique_slug);
        // if(empty($_POST['file_name1']))
        // {
        //     $return["html_message"] = 'Profile pic can not be blank?';
        //     $return["status"] = "error";
        //     echo json_encode($return);
        //     exit();
        // }
        $old_imagesname  = '../celebrity/uploads/profile-pic/temp_file/'.$_POST['file_name1'];
        $old_imagesname1 = '../celebrity/uploads/profile-pic/size_450/'.$_POST['file_name1'];
        $old_imagesname2 = '../celebrity/uploads/profile-pic/size_100/'.$_POST['file_name1'];
        $imge_arr = explode('.',$_POST['file_name1']);
        $new_imagesname = '../celebrity/uploads/profile-pic/temp_file/'.$logge_user_name.'_'.$edit_id.'_'.$date.'.'.$imge_arr[1];
        $new_imagesname1 = '../celebrity/uploads/profile-pic/size_450/'.$logge_user_name.'_'.$edit_id.'_'.$date.'.'.$imge_arr[1];
        $new_imagesname2 = '../celebrity/uploads/profile-pic/size_100/'.$logge_user_name.'_'.$edit_id.'_'.$date.'.'.$imge_arr[1];
        rename($old_imagesname ,$new_imagesname); 
        rename($old_imagesname1 ,$new_imagesname1); 
        rename($old_imagesname2 ,$new_imagesname2);   
        $profile_pic =  $logge_user_name.'_'.$edit_id.'_'.$date.'.'.$imge_arr[1];
        if ($_POST['status'] == 0)
        {
            $status = 0;
            $status_by = 'Admin';
        }
        else 
        {
            $status = $_POST['status'];
            $status_by = '';
        }
        

        $check_user_email_data_array = array();
        $check_user_email_query = "select * from user where email='$email' AND id!='$edit_id'";
        $result_check_user_email_query = mysqli_query($db_mysqli, $check_user_email_query);
        while ($row_check_user_email_query = mysqli_fetch_assoc($result_check_user_email_query))
        {
            $check_user_email_data_array[] = $row_check_user_email_query;
        }

        if (count($check_user_email_data_array) > 0)
        {
            $return["html_message"] = 'Email Already Exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }

        $check_user_mobile_data_array = array();
        $check_user_mobile_query = "select * from user where mobile='$mobile' AND id!='$edit_id'";
        $result_check_user_mobile_query = mysqli_query($db_mysqli, $check_user_mobile_query);
        while ($row_check_user_mobile_query = mysqli_fetch_assoc($result_check_user_mobile_query))
        {
            $check_user_mobile_data_array[] = $row_check_user_mobile_query;
        }

        if (count($check_user_mobile_data_array) > 0)
        {
            $return["html_message"] = 'Mobile Number Already Exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }

        $update_user_query = "update user set first_name='$first_name',last_name='$last_name',user_name='$user_name', user_unique_slug='$user_unique_slug',email='$email',password='$password',gender='$gender',mobile='$mobile', dob='$date_of_birthday',profile_pic='$profile_pic',user_type='$user_type',status='$status',status_by='$status_by',facebook_link='$facebook_link',twitter_link='$twitter_link',instagram_link='$instagram_link',whatsapp_link='$whatsapp_link',linkedin_link='$linkedin_link',google_link='$google_link', profile_link_url='$profile_link_url' where id='$edit_id'";
        $result_update_user_query = mysqli_query($db_mysqli, $update_user_query);

        $affected_rows = mysqli_affected_rows($db_mysqli);
        if ($result_update_user_query)
        {
            $celebritydetails_data_array = array();
            $get_celebritydetails_query = "select * from celebrity_details where celebrity_id='$edit_id' and is_deleted='0'";
            $result_get_celebritydetails_query = mysqli_query($db_mysqli, $get_celebritydetails_query);
            while ($row_get_celebritydetails_query = mysqli_fetch_assoc($result_get_celebritydetails_query))
            {
                $celebritydetails_data_array[] = $row_get_celebritydetails_query;
            }

            if(count($celebritydetails_data_array) > 0)
            {
                $update_celebrity_details_query = "update celebrity_details set 
                celebrity_id='$edit_id', category_id='$category_id',sub_category_id='$sub_category_id',sub_sub_category_id='$sub_sub_category_id',giftcat_id='$giftcat_id',giftsubcat_id='$giftsubcat_id',giftsubsubcat_id='$giftsubsubcat_id',follower_count='$follower_count', brand_celebration_price='$brand_celebration_price', full_description='$full_description', meta_title='$meta_title', meta_keyword='$search_keywords',language_spoken='$language_spoken',payment_percentage='$payment_percentage', is_pramotion='$is_pramotion',meta_description='$meta_description', updated_on='$updated_on', status='$status' 
                where celebrity_id='$edit_id'";
                $result_update_celebrity_details_query = mysqli_query($db_mysqli, $update_celebrity_details_query);
                $affected_row = mysqli_affected_rows($db_mysqli);
                $price_entry_list         = $_POST['price_entry_list'];
                $price_entry_list_array   = array_filter(explode(',', $price_entry_list));

                $get_celebrity_price_query = "select * from celebrity_price where celebrity_id='$edit_id'";
                $result_get_celebrity_price_query = mysqli_query($db_mysqli,$get_celebrity_price_query);
                $celebrity_price_data = array();
                $price_entry_old_id = array();
                $old_price_entry_id_array = array();
                while ($row_get_celebrity_price_query = mysqli_fetch_assoc($result_get_celebrity_price_query))
                {
                    $celebrity_price_data[] = $row_get_celebrity_price_query;
                }
                foreach($celebrity_price_data as $celebrity_price)
                { 
                    $price_entry_old_id[] = $celebrity_price['id'];   
                }
                
                
                if($price_entry_list && $affected_row>0)
                {
                    $status = 1;
                    foreach ($price_entry_list_array as $price_entry_data)
                    {
                        $old_price_entry_id      = $_POST["old_price_entry_id_$price_entry_data"];
                        $services_id             = $_POST["services_id_{$price_entry_data}"]; 
                        $celebrity_id            = $edit_id; 
                        $price                   = $_POST["price_{$price_entry_data}"]; 
                        $discount_type           = $_POST["disocunt_type_{$price_entry_data}"];  
                        $discount                = $_POST["discount_{$price_entry_data}"];
                        
                        if($price !='')
                        {
                            $get_celebrityprice_query = "select * from celebrity_price where celebrity_id='$celebrity_id' and services_id='$services_id'";
                            $result_get_celebrityprice_query = mysqli_query($db_mysqli, $get_celebrityprice_query);
                            while ($row_get_celebrityprice_query = mysqli_fetch_assoc($result_get_celebrityprice_query))
                            {
                                $celebrityprice_data_array[] = $row_get_celebrityprice_query;
                            }               
                            if(count($celebrityprice_data_array) > 1)
                            {
                                $status=0;
                            }
                            if ($old_price_entry_id != '')
                            {
                                if($discount_type == 'percentage')
                                {
                                    $discountt = $price*$discount;
                                    $total_discountt = $discountt/100;
                                    $total_discount = $price - $total_discountt;
                                    
                                }
                                else if($discount_type == 'price')
                                {
                                    $total_discount = $price - $discount;
                                }
                                
                                if($price <= $total_discount || $total_discount < 0)
                                {
                                    $return["html_message"] = 'Discount should not greater and equal in price please try again?';
                                    $return["status"] = "error";
                                    echo json_encode($return);
                                    exit();
                                }
                                
                                $celebrity_id       = $edit_id;
                                $update_celebrity_price_data = "UPDATE celebrity_price SET celebrity_id='".$celebrity_id."', services_id='".$services_id."',price='".$price."',discount_type='".$discount_type."',discount='".$discount."', discount_price='$total_discount', status='$status' WHERE id=$old_price_entry_id";
                                $update_data = mysqli_query($db_mysqli,$update_celebrity_price_data);

                                $old_price_entry_id_array[] = $old_price_entry_id; 
                                $error        = '';
                                $query_result = 1;
                            }
                            else
                            {
                                $get_celebrityprice_query = "select * from celebrity_price where celebrity_id='$celebrity_id' and services_id='$services_id'";
                                $result_get_celebrityprice_query = mysqli_query($db_mysqli, $get_celebrityprice_query);
                                while ($row_get_celebrityprice_query = mysqli_fetch_assoc($result_get_celebrityprice_query))
                                {
                                    $celebrityprice_data_array[] = $row_get_celebrityprice_query;
                                }               
                                if(count($celebrityprice_data_array) > 1)
                                {
                                    $status=0;
                                }
                                if($discount_type == 'percentage')
                                {
                                    $discountt = $price*$discount;
                                    $total_discountt = $discountt/100;
                                    $total_discount = $price - $total_discountt;
                                    
                                }
                                else if($discount_type == 'price')
                                {
                                    $total_discount = $price - $discount;
                                }
                                
                                if($price <= $total_discount || $total_discount < 0)
                                {
                                    $return["html_message"] = 'Discount should not greater and equal in price please try again?';
                                    $return["status"] = "error";
                                    echo json_encode($return);
                                    exit();
                                }
                                $celebrity_id          = $edit_id;
                                $insert_celebrity_price_data = "INSERT INTO celebrity_price(`services_id`, `celebrity_id`, `price`, `discount_type`, `discount`,`discount_price`, `status`) VALUES('$services_id', '$celebrity_id','$price','$discount_type','$discount', '$total_discount', '$status')";
                                $insert_data = mysqli_query($db_mysqli,$insert_celebrity_price_data);
                                $error        = '';
                                $query_result = 1;
                            }
                        }
                        
                        $i++;
                    }

                    if (count($price_entry_old_id) > 0)
                    {
                        foreach ($price_entry_old_id as $price_entry_old)
                        {

                            if (!in_array($price_entry_old, $old_price_entry_id_array))
                            {
                                $delete_celebrity_price_data = "DELETE FROM `celebrity_price` WHERE id=$price_entry_old";
                                $delete_data = mysqli_query($db_mysqli,$delete_celebrity_price_data);
                                $error        = '';
                                $query_result = 1;
                            }
                        }
                    }
                    
                }
            }
            else 
            {
                $insert_userdetails_query = "insert into celebrity_details (`celebrity_id`, `category_id`, `sub_category_id`, `sub_sub_category_id`, `giftcat_id`, `giftsubcat_id`, `giftsubsubcat_id`,`follower_count`, `brand_celebration_price`,`payment_percentage`,`is_pramotion`,`full_description`, `language_spoken`, `meta_title`, `meta_keyword`, `meta_description`, `created_on`, `status`, `is_deleted`) values('$edit_id','$category_id','$sub_category_id','0','$giftcat_id','$giftsubcat_id','$giftsubsubcat_id','$follower_count','$brand_celebration_price','$payment_percentage','$is_pramotion','$full_description','$language_spoken','$meta_title','$search_keywords','$meta_description','$updated_on','$status','0')";
                $result_userdetails_query = mysqli_query($db_mysqli, $insert_userdetails_query);
                $affected_row = mysqli_affected_rows($db_mysqli);
                $price_entry_list         = $_POST['price_entry_list'];
                $price_entry_list_array   = array_filter(explode(',', $price_entry_list));

                if($price_entry_list)
                {
                    $status=1;
                    foreach ($price_entry_list_array as $price_entry_data)
                    {
                        $services_id          = $_POST["services_id_{$price_entry_data}"];
                        $celebrity_id         = $celebrity_id;
                        $price                = $_POST["price_{$price_entry_data}"];
                        $discount_type        = $_POST["disocunt_type_{$price_entry_data}"];  
                        $discount             = $_POST["discount_{$price_entry_data}"]; 

                        if($price !='')
                        {
                            $get_celebrityprice_query = "select * from celebrity_price where celebrity_id='$celebrity_id' and services_id='$services_id'";
                            $result_get_celebrityprice_query = mysqli_query($db_mysqli, $get_celebrityprice_query);
                            while ($row_get_celebrityprice_query = mysqli_fetch_assoc($result_get_celebrityprice_query))
                            {
                                $celebrityprice_data_array[] = $row_get_celebrityprice_query;
                            }               
                            if(count($celebrityprice_data_array) > 1)
                            {
                                $status=0;
                            }
                            if($discount_type == 'percentage')
                            {
                                $discountt = $price*$discount;
                                $total_discountt = $discountt/100;
                                $total_discount = $price - $total_discountt;
                                
                            }
                            else if($discount_type == 'price')
                            {
                                $total_discount = $price - $discount;
                            }
                            
                            if($price <= $total_discount || $total_discount < 0)
                            {
                                $delete_user_data = "DELETE FROM `user` WHERE id=$celebrity_id";
                                $deleteuser = mysqli_query($db_mysqli,$delete_user_data);

                                $delete_celebritydetail_data = "DELETE FROM `celebrity_details` WHERE celebrity_id=$edit_id";
                                $deletecelebritydetail= mysqli_query($db_mysqli,$delete_celebritydetail_data);

                                $return["html_message"] = 'Discount should not greater and equal in price please try again?';
                                $return["status"] = "error";
                                echo json_encode($return);
                                exit();
                            }

                            $insert_celebrity_price_data = "INSERT INTO celebrity_price(`services_id`, `celebrity_id`, `price`, `discount_type`, `discount`,`discount_price`,`status`) VALUES('$services_id', '$edit_id','$price','$discount_type','$discount','$total_discount', '$status')";
                            $insert_data = mysqli_query($db_mysqli,$insert_celebrity_price_data);
                        }
                        
                    }
                }
            }
            if ($affected_rows == 0)
            {
                $return["html_message"] = 'Nothing Updated by celebrity.';
                $return["status"] = "success";
                echo json_encode($return);
                exit();
            }
            else
            {
                $return["html_message"] = 'Celebrity Updated Successfully!';;
                $return["status"] = "success";
                $return["update"] = 1;
                echo json_encode($return);
                exit();
            }
        }

    }
    else
    {
        $return["html_message"] = 'Some Error Occured! Please try again.';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }
}
else
{
    $return["html_message"] = 'Please login.';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}
?>