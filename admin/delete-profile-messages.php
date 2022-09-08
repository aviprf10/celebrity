<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (($_POST))
    {
        //		$delete_id = Secure1($db_mysqli,$_POST['delete_id']);

        $delete_id_array = $_POST['delete_id_array'];
        if (is_array($delete_id_array))
        {
            $delete_id_list = implode(',', $delete_id_array);
        }
        else
        {
            $delete_id_list = $delete_id_array;
        }

        $all_celebrity_messages_data_array = array();
        $get_celebrity_messages_query = "select * from celebrity_messages where id IN ($delete_id_list) and is_deleted='0'";
        $result_get_celebrity_messages_query = mysqli_query($db_mysqli, $get_celebrity_messages_query);
        while ($row_get_celebrity_messages_query = mysqli_fetch_assoc($result_get_celebrity_messages_query))
        {
            $all_celebrity_messages_data_array[] = $row_get_celebrity_messages_query;
        }

        if (count($all_celebrity_messages_data_array) > 0)
        {
            $update_celebrity_messages_query = "UPDATE celebrity_messages
                                    SET is_deleted = '1'
                                    WHERE id IN ($delete_id_list)";
            $result_update_celebrity_messages_query = mysqli_query($db_mysqli, $update_celebrity_messages_query);
            if ($result_update_celebrity_messages_query)
            {
                $return["html_message"] = 'Messages Removed Successfully.';
                $return["status"] = "success";
                $return["update"] = 1;
                echo json_encode($return);
                exit();
            }
            else
            {
                $return["html_message"] = 'Some Error Occurred! Please try again.';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }
        }
        else
        {
            $return["html_message"] = 'Messages Does Not Exist.';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
    }
    else
    {
        $return["html_message"] = 'Some Error Occurred! Please try again.';
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