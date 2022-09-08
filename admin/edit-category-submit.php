<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $edit_id = Secure1($db_mysqli, $_POST['edit_id']);
        $category_name = Secure1($db_mysqli, $_POST['category_name']);
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

        
        $all_category_data_array = array();
        $get_category_query = "select * from category where id='$edit_id' and is_deleted='0'";
        $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);
        while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
        {
            $all_category_data_array[] = $row_get_category_query;
        }
        
        if (!empty($all_category_data_array))
        {
            if (isset($_POST['status']))
            {
                $status = 1;
            }
            else
            {
                $status = 0;
            }
            
            $all_category_title_data_array = array();
            $get_category_title_query = "select * from category where category_name='$category_name' AND id!='$edit_id' and is_deleted='0'";
            $result_get_category_title_query = mysqli_query($db_mysqli, $get_category_title_query);
            while ($row_get_category_title_query = mysqli_fetch_assoc($result_get_category_title_query))
            {
                $all_category_title_data_array[] = $row_get_category_title_query;
            }
            
            if (!empty($all_category_title_data_array))
            {
                $return["html_message"] = 'Category title already exist. Try Another!';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }

            
            
            $update_category_query = "update category set category_name='$category_name', category_images='$images', updated_on='$updated_on', meta_title='$meta_title', meta_keyword='$search_keywords', meta_description='$meta_description',
                              status='$status' where id='$edit_id'";
            $result_update_category_query = mysqli_query($db_mysqli, $update_category_query);
            $affected_rows = mysqli_affected_rows($db_mysqli);

            if ($result_update_category_query)
            {
                if ($affected_rows == 0)
                {
                    $return["html_message"] = 'Nothing Updated by user.';
                    $return["status"] = "success";
                    echo json_encode($return);
                    exit();
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
            $return["html_message"] = 'Category Does Not Exist.';
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