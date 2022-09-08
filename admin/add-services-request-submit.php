<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {

        $services_name = Secure1($db_mysqli, $_POST['services_name']);
        $created_on = get_current_date_time();
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        
        $get_services_title_query = "select * from services_request where services_name='$services_name' and is_deleted='0'";
        $result_get_services_title_query = mysqli_query($db_mysqli, $get_services_title_query);
        while ($row_get_services_title_query = mysqli_fetch_assoc($result_get_services_title_query))
        {
            $check_services_title_data_array[] = $row_get_services_title_query;
        }
        
        if (!empty($check_services_title_data_array))
        {
            $return["html_message"] = 'Services request title already exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
        
  
        $insert_services_query = "INSERT INTO services_request (services_name, celebrity_id,created_on, status, is_deleted) 
        VALUES ('$services_name', '$loggedin_user_id','$created_on','$status', '0')";
        $result_insert_services_query = mysqli_query($db_mysqli, $insert_services_query);

        if ($result_insert_services_query)
        {
            $return["html_message"] = 'Services request added successfully.';
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