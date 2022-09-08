<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    
    if (isset($_POST))
    {
        $category_id         = Secure1($db_mysqli, $_POST['category_id']);
        $product_name        = Secure1($db_mysqli, $_POST['product_name']);
        $sort_description        = Secure1($db_mysqli, $_POST['sort_description']);
        $product_price           = Secure1($db_mysqli, $_POST['product_price']);
        $product_spacial_price   = Secure1($db_mysqli, $_POST['product_spacial_price']);
        $full_description    = htmlentities($_POST['full_description']);
        $meta_title          = Secure1($db_mysqli, $_POST['meta_title']);
        $arr_search_keywords = $_POST['search_keywords'];
        $search_keywords     = implode(',', $arr_search_keywords);
        $meta_description    = Secure1($db_mysqli, $_POST['meta_description']);
        $created_on          = get_current_date_time();
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        if (isset($_POST['show_in_home']))
        {
            $show_in_home = 1;
        }
        else
        {
            $show_in_home = 0;
        }
        $sub_category_id = 0;
        $sub_sub_category_id = 0;
        $check_product_name_data_array = array();
        $get_product_name_query = "select * from product where product_name='$product_name' and category_id='$category_id'  and is_deleted='0'";
        $result_get_product_name_query = mysqli_query($db_mysqli, $get_product_name_query);
        while ($row_get_product_name_query = mysqli_fetch_assoc($result_get_product_name_query))
        {
            $check_product_name_data_array[] = $row_get_product_name_query;
        }

        if (!empty($check_product_name_data_array))
        {
            $return["html_message"] = 'Product already exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
        
        $product_unique_slug = '';
        $product_unique_slug = get_unique_slug1($db_mysqli, $product_name, 'product', 'product_name');
        
      $insert_product_query = "INSERT INTO product 
       (category_id, product_name, product_unique_slug, 
       sort_description, full_description,meta_title, meta_keyword, 
       meta_description, show_in_home, created_on, status, is_deleted)  VALUES ('$category_id', '$product_name', '$product_unique_slug', '$sort_description',
       '$full_description','$meta_title','$search_keywords',
       '$meta_description',  '$show_in_home','$created_on','$status', '0');";
        $result_insert_product_query = mysqli_query($db_mysqli, $insert_product_query);
        $product_id = mysqli_insert_id($db_mysqli);
        if ($result_insert_product_query)
        {
            $return["html_message"] = 'Product added successfully.';
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