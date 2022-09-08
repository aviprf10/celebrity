<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
//        print_r( $_POST);
//        exit();
        $gift_name       = Secure1($db_mysqli, $_POST['gift_name']);
        $meta_title          = Secure1($db_mysqli, $_POST['meta_title']);
        $arr_search_keywords = $_POST['search_keywords'];
        $search_keywords     = implode(',', $arr_search_keywords);
        $meta_description    = Secure1($db_mysqli, $_POST['meta_description']);
        $images = Secure1($db_mysqli,$_POST['file_name1']);
        $created_on = get_current_date_time();
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        
        $get_gift_cat_title_query = "select * from gift_cat where gift_name='$gift_name' and is_deleted='0'";
        $result_get_gift_cat_title_query = mysqli_query($db_mysqli, $get_gift_cat_title_query);
        while ($row_get_gift_cat_title_query = mysqli_fetch_assoc($result_get_gift_cat_title_query))
        {
            $check_gift_cat_title_data_array[] = $row_get_gift_cat_title_query;
        }
        
        if (!empty($check_gift_cat_title_data_array))
        {
            $return["html_message"] = 'Gift category already exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
        
        $gift_cat_unique_slug = '';
        $gift_cat_unique_slug = get_unique_slug1($db_mysqli, $gift_name, 'gift_cat', 'gift_name');

        $insert_gift_cat_query = "INSERT INTO gift_cat (gift_name, gift_slug, gift_images,meta_title, meta_keyword, meta_description, created_on, status, is_deleted) 
        VALUES ('$gift_name','$gift_cat_unique_slug','$images','$meta_title','$search_keywords','$meta_description', '$created_on','$status', '0')";
        $result_insert_gift_cat_query = mysqli_query($db_mysqli, $insert_gift_cat_query);

        if ($result_insert_gift_cat_query)
        {
            $return["html_message"] = 'Gift Category added successfully.';
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
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>