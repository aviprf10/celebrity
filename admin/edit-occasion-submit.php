<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $edit_id = Secure1($db_mysqli, $_POST['edit_id']);
        $occasion_title = Secure1($db_mysqli, $_POST['occasion_title']);
        $updated_on = get_current_date_time();
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        
        $all_occasion_data_array = array();
        $get_occasion_query = "select * from occasion where id='$edit_id' and is_deleted='0'";
        $result_get_occasion_query = mysqli_query($db_mysqli, $get_occasion_query);
        while ($row_get_occasion_query = mysqli_fetch_assoc($result_get_occasion_query))
        {
            $all_occasion_data_array[] = $row_get_occasion_query;
        }
        
        if (!empty($all_occasion_data_array))
        {
            if (isset($_POST['status']))
            {
                $status = 1;
            }
            else
            {
                $status = 0;
            }
            
            $all_occasion_title_data_array = array();
            $get_occasion_title_query = "select * from occasion where occasion_title='$occasion_title' AND id!='$edit_id' and is_deleted='0'";
            $result_get_occasion_title_query = mysqli_query($db_mysqli, $get_occasion_title_query);
            while ($row_get_occasion_title_query = mysqli_fetch_assoc($result_get_occasion_title_query))
            {
                $all_occasion_title_data_array[] = $row_get_occasion_title_query;
            }
            
            if (!empty($all_occasion_title_data_array))
            {
                $return["html_message"] = 'Occasion title already exist. Try Another!';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }

            
            
            $update_occasion_query = "update occasion set occasion_title='$occasion_title',  status='$status' where id='$edit_id'";
            $result_update_occasion_query = mysqli_query($db_mysqli, $update_occasion_query);
            $affected_rows = mysqli_affected_rows($db_mysqli);

            if ($result_update_occasion_query)
            {
                if ($affected_rows == 0)
                {
                    $return["html_message"] = 'Nothing Updated by user.';
                    $return["status"] = "success";
                    echo json_encode($return);
                    exit();
                }
                $return["html_message"] = 'Occasion Updated Successfully.';
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
            $return["html_message"] = 'Occasion Does Not Exist.';
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