<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($celebrity == 1)
{
   
    if (isset($_POST))
    {
        //$loggedin_user_id = Secure1($db_mysqli, $_POST['loggedin_user_id']);
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
        
      
        $full_description    = Secure1($db_mysqli, $_POST['full_description']);
        $meta_title          = Secure1($db_mysqli, $_POST['meta_title']);
        $arr_search_keywords = $_POST['search_keywords'];
        $search_keywords     = implode(',', $arr_search_keywords);
        $meta_description    = Secure1($db_mysqli, $_POST['meta_description']);
        $profile_pic         = Secure1($db_mysqli, $_POST['file_name1']);
        $follower_count         = Secure1($db_mysqli, $_POST['follower_count']);
        $brand_celebration_price         = Secure1($db_mysqli, $_POST['brand_celebration_price']);
        $is_pramotion = Secure1($db_mysqli, $_POST['is_pramotion']);
        if(empty($_POST['file_name1']))
        {
            $return["html_message"] = 'Profile pic can not be blank?';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
        $facebook_link       = $_POST['facebook_link'];
        $twitter_link        = $_POST['twitter_link'];
        $instagram_link      = $_POST['instagram_link'];
        $whatsapp_link       = $_POST['whatsapp_link'];
        $linkedin_link       = $_POST['linkedin_link'];
        $google_link         = $_POST['google_link'];
        $profile_link_url    = $_POST['profile_link_url'];
        $updated_on          = get_current_date_time();
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }


        $sub_sub_category_id = 0;
        
        $all_celebrity_details_data_array = array();
        $get_celebrity_details_query = "select * from celebrity_details where celebrity_id='$loggedin_user_id' and status='1' and is_deleted='0'";
        $result_get_celebrity_details_query = mysqli_query($db_mysqli, $get_celebrity_details_query);
        while ($row_get_celebrity_details_query = mysqli_fetch_assoc($result_get_celebrity_details_query)) {
            $all_celebrity_details_data_array[] = $row_get_celebrity_details_query;
        }

        if(count($all_celebrity_details_data_array) > 0)
        {
            $update_user_query = "update user set profile_pic='$profile_pic',facebook_link='$facebook_link',twitter_link='$twitter_link',instagram_link='$instagram_link',whatsapp_link='$whatsapp_link',linkedin_link='$linkedin_link',google_link='$google_link', profile_link_url='$profile_link_url' where id='$loggedin_user_id'";
            $result_update_user_query = mysqli_query($db_mysqli, $update_user_query);

            $update_celebrity_details_query = "update celebrity_details set 
            celebrity_id='$loggedin_user_id', category_id='$category_id',sub_category_id='$sub_category_id',sub_sub_category_id='$sub_sub_category_id',brand_celebration_price='$brand_celebration_price',follower_count='$follower_count', giftcat_id='$giftcat_id',giftsubcat_id='$giftsubcat_id',giftsubsubcat_id='$giftsubsubcat_id',full_description='$full_description', meta_title='$meta_title', meta_keyword='$search_keywords',language_spoken='$language_spoken', is_pramotion='$is_pramotion',
            meta_description='$meta_description', updated_on='$updated_on', status='$status' 
            where celebrity_id='$loggedin_user_id'";
            $result_update_celebrity_details_query = mysqli_query($db_mysqli, $update_celebrity_details_query);
            $affected_rows = mysqli_affected_rows($db_mysqli);
            $message = 'Details Updated Successfully.';;
        }
        else 
        {
            $update_user_query = "update user set profile_pic='$profile_pic',facebook_link='$facebook_link',twitter_link='$twitter_link',instagram_link='$instagram_link',whatsapp_link='$whatsapp_link',linkedin_link='$linkedin_link',google_link='$google_link', profile_link_url='$profile_link_url' where id='$loggedin_user_id'";
            $result_update_user_query = mysqli_query($db_mysqli, $update_user_query);
            
            $insert_celebrity_details_query = "INSERT INTO celebrity_details (celebrity_id,category_id,sub_category_id,sub_sub_category_id,giftcat_id,giftsubcat_id,giftsubsubcat_id,brand_celebration_price,follower_count,language_spoken,full_description,is_pramotion,meta_title,meta_keyword,meta_description, created_on, status) VALUES ('$loggedin_user_id','$category_id', '$sub_category_id','$sub_sub_category_id','$giftcat_id','$giftsubcat_id','$giftsubsubcat_id','$brand_celebration_price','$follower_count','$language_spoken','$full_description','$is_pramotion','$meta_title','$search_keywords','$meta_description','$updated_on','$status');";
            $result_insert_celebrity_details_query = mysqli_query($db_mysqli, $insert_celebrity_details_query);
            $message = 'Details Updated Successfully.';;
        }
        

        if($message)
        {
            $price_entry_list         = $_POST['price_entry_list'];
            $price_entry_list_array   = array_filter(explode(',', $price_entry_list));

            $get_celebrity_price_query = "select * from celebrity_price where celebrity_id='$loggedin_user_id'";
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
            
            
            if($price_entry_list)
            {
                $status=1;
                foreach ($price_entry_list_array as $price_entry_data)
                {
                    $old_price_entry_id      = $_POST["old_price_entry_id_$price_entry_data"];
                    $services_id             = $_POST["services_id_{$price_entry_data}"]; 
                    $celebrity_id            = $loggedin_user_id; 
                    $price                   = $_POST["price_{$price_entry_data}"]; 
                    $discount_type           = $_POST["disocunt_type_{$price_entry_data}"];  
                    $discount                = $_POST["discount_{$price_entry_data}"]; 

                    if($price !='')
                    {
                        $get_celebrityprice_query = "select * from celebrity_price where celebrity_id='$loggedin_user_id' and services_id='$services_id'";
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
                            
                            $celebrity_id       = $loggedin_user_id;
                            $update_celebrity_price_data = "UPDATE celebrity_price SET celebrity_id='".$celebrity_id."', services_id='".$services_id."',price='".$price."',discount_type='".$discount_type."',discount='".$discount."', status='$status' WHERE id=$old_price_entry_id";
                            $update_data = mysqli_query($db_mysqli,$update_celebrity_price_data);

                            $old_price_entry_id_array[] = $old_price_entry_id; 
                            $error = '';
                            $query_result = 1;
                        }
                        else
                        {
                            $get_celebrityprice_query = "select * from celebrity_price where celebrity_id='$loggedin_user_id' and services_id='$services_id'";
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
                            $celebrity_id          = $loggedin_user_id;
                            $insert_celebrity_price_data = "INSERT INTO celebrity_price(`services_id`, `celebrity_id`, `price`, `discount_type`, `discount`, `status`) VALUES('$services_id', '$celebrity_id','$price','$discount_type','$discount','$status')";
                            $insert_data = mysqli_query($db_mysqli,$insert_celebrity_price_data);
                            $error        = '';
                            $query_result = 1;
                        }
                    }
                    
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

                $return["html_message"] = $message ;
                $return["status"] = "success";
                $return["update"] = 1;
                echo json_encode($return);
                exit();
            }
            else
            {
                $return["html_message"] = 'Some Error Occured! Please try again.';
                $return["status"] = "error";
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