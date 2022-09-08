<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {

        $language_name       = Secure1($db_mysqli, $_POST['language_name']);
        $created_on = get_current_date_time();
        if (isset($_POST['status']))
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }

        
        $get_spoken_language_title_query = "select * from spoken_language where language_name='$language_name' and is_deleted='0'";
        $result_get_spoken_language_title_query = mysqli_query($db_mysqli, $get_spoken_language_title_query);
        while ($row_get_spoken_language_title_query = mysqli_fetch_assoc($result_get_spoken_language_title_query))
        {
            $check_spoken_language_title_data_array[] = $row_get_spoken_language_title_query;
        }
        
        if (!empty($check_spoken_language_title_data_array))
        {
            $return["html_message"] = 'Spoken Language title already exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
        
        $spoken_language_unique_slug = '';
        $spoken_language_unique_slug = get_unique_slug1($db_mysqli, $language_name, 'spoken_language', 'language_name');

        $insert_spoken_language_query = "INSERT INTO spoken_language (language_name, created_on, status, is_deleted) 
        VALUES ('$language_name', '$created_on','$status', '0')";
        $result_insert_spoken_language_query = mysqli_query($db_mysqli, $insert_spoken_language_query);

        if ($result_insert_spoken_language_query)
        {
            $return["html_message"] = 'Spoken Language added successfully.';
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