<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $edit_id            = Secure1($db_mysqli, $_POST['edit_id']);
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
        $updated_on = get_current_date_time();
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        
        $get_brandpost_title_query = "select * from brand_post where title='$brand_name' and id!='$edit_id' and is_deleted='0'";
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
        
        
        $update_category_query = "update brand_post set title='$brand_name', category_id='$category_id', sub_category_id='$sub_category_id',sort_description='$sort_description',full_description='$full_description',price='$price',validate_days='$validate_days', updated_on='$updated_on', status='$status' where id='$edit_id'";
        $result_update_category_query = mysqli_query($db_mysqli, $update_category_query);
        $affected_rows = mysqli_affected_rows($db_mysqli);

        if ($result_update_category_query)
        {
            $update_deletecelebrty_query = "DELETE FROM brand_post_celebrty_list WHERE  brand_post_id='$edit_id'";
			$result_update_deletecelebrty_query = mysqli_query($db_mysqli,$update_deletecelebrty_query);
            $is_checked = $_POST['is_checked'];
            foreach($is_checked as $key=>$value)
            {
                
                $ischecked = $_POST['is_checked'][$key];
                $brand_cost = $_POST['brand_cost'][$key];
                $celebrity_id = $_POST['celebrity_id'][$key];
                $profile_pic = $_POST['profile_pic'][$key];
                $name = $_POST['name'][$key];
                $celebritycategory_id = $_POST['celebritycategory_id'][$key];
                $insta_id = $_POST['insta_id'][$key];
                $celebrity_brand_cost = $_POST['celebrity_brand_cost'][$key];
                
              echo  $insert_brandpostdetials_query = "INSERT INTO brand_post_celebrty_list (is_checked, brand_post_id, celebrity_id, profile_pic, name, category_id, insta_id, celebrity_brand_cost, brand_cost) 
                 VALUES ('$ischecked','$edit_id','$celebrity_id','$profile_pic','$name','$category_id', '$insta_id','$celebrity_brand_cost','$brand_cost')";
                 $result_insert_brandpostdetials_query = mysqli_query($db_mysqli, $insert_brandpostdetials_query);
            }

            $return["html_message"] = 'Category Updated Successfully.';
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