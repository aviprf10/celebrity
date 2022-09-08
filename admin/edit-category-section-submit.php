<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $edit_id = Secure1($db_mysqli, $_POST['edit_id']);

        if(!empty($_POST['category_id']))
        {
            $cate_data = '';
            foreach($_POST['category_id'] as $catvalue)
            {
                $cate_data .=$catvalue.',';
            }
            $category_id = substr($cate_data, 0,-1);
        }
        
        if(count($_POST['category_id']) > 6)
        {
            $return["html_message"] = 'Home page display category section limit only 6.';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }

        $update_user_query = "update display_category_wise_section set category_id='$category_id' where id='$edit_id'";
        $result_update_user_query = mysqli_query($db_mysqli, $update_user_query);
        if ($result_update_user_query)
        {
            $return["html_message"] = 'Updated Successfully!';;
            $return["status"] = "success";
            $return["update"] = 1;
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