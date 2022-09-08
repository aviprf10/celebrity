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
        $occasion_title = Secure1($db_mysqli, $_POST['occasion_title']);
        $created_on = get_current_date_time();
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        
        $get_occasion_title_query = "select * from occasion where occasion_title='$occasion_title' and is_deleted='0'";
        $result_get_occasion_title_query = mysqli_query($db_mysqli, $get_occasion_title_query);
        while ($row_get_occasion_title_query = mysqli_fetch_assoc($result_get_occasion_title_query))
        {
            $check_occasion_title_data_array[] = $row_get_occasion_title_query;
        }
        
        if (!empty($check_occasion_title_data_array))
        {
            $return["html_message"] = 'Occasion title already exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
        
        $insert_occasion_query = "INSERT INTO occasion (occasion_title, created_on, status, is_deleted) 
        VALUES ('$occasion_title', '$created_on','$status', '0')";
        $result_insert_occasion_query = mysqli_query($db_mysqli, $insert_occasion_query);

        if ($result_insert_occasion_query)
        {
            $return["html_message"] = 'Occasion added successfully.';
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