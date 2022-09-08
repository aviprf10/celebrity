<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $edit_id = Secure1($db_mysqli, $_POST['edit_id']);
        $gift_name = Secure1($db_mysqli, $_POST['gift_name']);
        $meta_title          = Secure1($db_mysqli, $_POST['meta_title']);
        $arr_search_keywords = $_POST['search_keywords'];
        $search_keywords     = implode(',', $arr_search_keywords);
        $meta_description    = Secure1($db_mysqli, $_POST['meta_description']);
        $images = Secure1($db_mysqli,$_POST['file_name1']);
        $updated_on = get_current_date_time();
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        
        $all_gift_cat_data_array = array();
        $get_gift_cat_query = "select * from gift_cat where id='$edit_id' and is_deleted='0'";
        $result_get_gift_cat_query = mysqli_query($db_mysqli, $get_gift_cat_query);
        while ($row_get_gift_cat_query = mysqli_fetch_assoc($result_get_gift_cat_query))
        {
            $all_gift_cat_data_array[] = $row_get_gift_cat_query;
        }
        
        if (!empty($all_gift_cat_data_array))
        {
            if (isset($_POST['status']))
            {
                $status = 1;
            }
            else
            {
                $status = 0;
            }
            
            $all_gift_cat_title_data_array = array();
            $get_gift_cat_title_query = "select * from gift_cat where gift_name='$gift_name' AND id!='$edit_id' and is_deleted='0'";
            $result_get_gift_cat_title_query = mysqli_query($db_mysqli, $get_gift_cat_title_query);
            while ($row_get_gift_cat_title_query = mysqli_fetch_assoc($result_get_gift_cat_title_query))
            {
                $all_gift_cat_title_data_array[] = $row_get_gift_cat_title_query;
            }
            
            if (!empty($all_gift_cat_title_data_array))
            {
                $return["html_message"] = 'Gift Category already exist. Try Another!';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }

            
            
            $update_gift_cat_query = "update gift_cat set gift_name='$gift_name', gift_images='$images', updated_on='$updated_on', meta_title='$meta_title', meta_keyword='$search_keywords', meta_description='$meta_description',
                              status='$status' where id='$edit_id'";
            $result_update_gift_cat_query = mysqli_query($db_mysqli, $update_gift_cat_query);
            $affected_rows = mysqli_affected_rows($db_mysqli);

            if ($result_update_gift_cat_query)
            {
                if ($affected_rows == 0)
                {
                    $return["html_message"] = 'Nothing Updated by user.';
                    $return["status"] = "success";
                    echo json_encode($return);
                    exit();
                }
                $return["html_message"] = 'Gift Category Updated Successfully.';
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
            $return["html_message"] = 'Gift Category Does Not Exist.';
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