<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($brand == 1)
{
   
    if (isset($_POST))
    {
       
        $brand_name         = Secure1($db_mysqli, $_POST['brand_name']);
        $sort_description   = Secure1($db_mysqli, $_POST['sort_description']);
        $full_description   = htmlentities($_POST['full_description']);
        $price              = Secure1($db_mysqli, $_POST['price']);
        $validate_days      = Secure1($db_mysqli, $_POST['validate_days']);
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
        $created_on = get_current_date_time();
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

      
        $get_brandpost_title_query = "select * from brand_post where title='$brand_name' and is_deleted='0'";
        $result_get_brandpost_title_query = mysqli_query($db_mysqli, $get_brandpost_title_query);
        while ($row_get_brandpost_title_query = mysqli_fetch_assoc($result_get_brandpost_title_query))
        {
            $check_brandpost_title_data_array[] = $row_get_brandpost_title_query;
        }
        
        if (!empty($check_brandpost_title_data_array))
        {
            $return["html_message"] = 'Brand title already exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
        
        
        $insert_brandpost_query = "INSERT INTO brand_post (title, category_id, sub_category_id,sort_description, full_description, price, validate_days, created_on, added_by, status, is_deleted) 
        VALUES ('$brand_name','$category_id','$sub_category_id','$sort_description','$full_description','$price', '$validate_days','$created_on','$loggedin_user_id','$status', '0')";
        $result_insert_brandpost_query = mysqli_query($db_mysqli, $insert_brandpost_query);
        $last_id = mysqli_insert_id($db_mysqli);
        if($result_insert_brandpost_query)
        {
            $is_checked = $_POST['is_checked'];
           
            foreach($is_checked as $key=>$value)
            {
                
                $ischecked = '1';
                $brand_cost = $_POST['brand_cost'][$key];
                $celebrity_id = $_POST['celebrity_id'][$key];
                $profile_pic = $_POST['profile_pic'][$key];
                $name = $_POST['name'][$key];
                $celebritycategory_id = $_POST['celebritycategory_id'][$key];
                $insta_id = $_POST['insta_id'][$key];
                $celebrity_brand_cost = $_POST['celebrity_brand_cost'][$key];
                
                $insert_brandpostdetials_query = "INSERT INTO brand_post_celebrty_list (is_checked, brand_post_id, celebrity_id, profile_pic, name, category_id, insta_id, celebrity_brand_cost, brand_cost) 
                 VALUES ('$ischecked','$last_id','$celebrity_id','$profile_pic','$name','$category_id', '$insta_id','$celebrity_brand_cost','$brand_cost')";
                 $result_insert_brandpostdetials_query = mysqli_query($db_mysqli, $insert_brandpostdetials_query);

                $get_user_query = "select * from user where id='$celebrity_id' and is_deleted='0'";
                $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
                while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
                {
                    $check_user_data_array[] = $row_get_user_query;
                }
                $email_array = array();
                $email_array['email'] = $check_user_data_array[0]['email'];
                $email_array['user_name'] = $name;
                $email_array['description'] = $sort_description;
                $email_array['validate_day'] = $validate_days;
                $email_array['brand_name'] = $brand_name;
                $email_array['price'] = $price;
                $email_array['email_type'] = 3;
                $email_sent_response = send_email($email_array);
            }
            $return["html_message"] = 'Brand Post added successfully.';
            $return["status"] = "success";
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
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url1 . 'logout">';
}
?>