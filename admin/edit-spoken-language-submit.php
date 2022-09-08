<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $edit_id = Secure1($db_mysqli, $_POST['edit_id']);
        $language_name = Secure1($db_mysqli, $_POST['language_name']);
        $updated_on = get_current_date_time();
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        
        $all_spoken_language_data_array = array();
        $get_spoken_language_query = "select * from spoken_language where id='$edit_id' and is_deleted='0'";
        $result_get_spoken_language_query = mysqli_query($db_mysqli, $get_spoken_language_query);
        while ($row_get_spoken_language_query = mysqli_fetch_assoc($result_get_spoken_language_query))
        {
            $all_spoken_language_data_array[] = $row_get_spoken_language_query;
        }
        
        if (!empty($all_spoken_language_data_array))
        {
            if (isset($_POST['status']))
            {
                $status = 1;
            }
            else
            {
                $status = 0;
            }
            
            $all_spoken_language_title_data_array = array();
            $get_spoken_language_title_query = "select * from spoken_language where language_name='$language_name' AND id!='$edit_id' and is_deleted='0'";
            $result_get_spoken_language_title_query = mysqli_query($db_mysqli, $get_spoken_language_title_query);
            while ($row_get_spoken_language_title_query = mysqli_fetch_assoc($result_get_spoken_language_title_query))
            {
                $all_spoken_language_title_data_array[] = $row_get_spoken_language_title_query;
            }
            
            if (!empty($all_spoken_language_title_data_array))
            {
                $return["html_message"] = 'Spoken Language title already exist. Try Another!';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }

            $update_spoken_language_query = "update spoken_language set language_name='$language_name', status='$status' where id='$edit_id'";
            $result_update_spoken_language_query = mysqli_query($db_mysqli, $update_spoken_language_query);
            $affected_rows = mysqli_affected_rows($db_mysqli);

            if ($result_update_spoken_language_query)
            {
                if ($affected_rows == 0)
                {
                    $return["html_message"] = 'Nothing Updated by user.';
                    $return["status"] = "success";
                    echo json_encode($return);
                    exit();
                }
                $return["html_message"] = 'Spoken Language Updated Successfully.';
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
            $return["html_message"] = 'Spoken_language Does Not Exist.';
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