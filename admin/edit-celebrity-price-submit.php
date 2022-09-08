<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $edit_id = Secure1($db_mysqli, $_POST['edit_id']);
        $status = Secure1($db_mysqli, $_POST['status']);
        $celebrity_id = Secure1($db_mysqli, $_POST['celebrity_id']);

        if($status == 1)
        {
            $updatecategory_query = "update celebrity_price set status='0' where celebrity_id='$celebrity_id'";
            $result_updatecategory_query = mysqli_query($db_mysqli, $updatecategory_query);
        }
        
        
        $update_category_query = "update celebrity_price set status='$status' where id='$edit_id'";
        $result_update_category_query = mysqli_query($db_mysqli, $update_category_query);
        if ($result_update_category_query)
        {
            
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