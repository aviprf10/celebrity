<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1) {
    if ($_POST) {

        $occasion_id = Secure1($db_mysqli, $_POST['occasion_id']);
        $services_id = Secure1($db_mysqli, $_POST['services_id']);
        $type = Secure1($db_mysqli, $_POST['type']);
        $celebrity_message = Secure1($db_mysqli, $_POST['celebrity_message']);
        $created_on = get_current_date_time();
        if (isset($_POST['status'])) {
            $status = 1;
        } else {
            $status = 0;
        }

        $all_celebrity_messages_data_array = array();
        $get_celebrity_messages_query = "select * from celebrity_messages where celebrity_message='$celebrity_message' AND services_id='$services_id' AND occasion_id='$occasion_id' and is_deleted='0'";
        $result_get_celebrity_messages_query = mysqli_query($db_mysqli, $get_celebrity_messages_query);
        while ($row_get_celebrity_messages_query = mysqli_fetch_assoc($result_get_celebrity_messages_query)) {
            $all_celebrity_messages_data_array[] = $row_get_celebrity_messages_query;
        }

        if (!empty($all_celebrity_messages_data_array)) {
            $return["html_message"] = 'Messages Already Exist. Try Another!';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        } else {

            $insert_celebrity_messages_query = "INSERT INTO celebrity_messages (services_id,occasion_id,type,celebrity_message,created_on,status) VALUES ('$services_id','$occasion_id', '$type','$celebrity_message','$created_on','$status');";
            $result_insert_celebrity_messages_query = mysqli_query($db_mysqli, $insert_celebrity_messages_query);
            if ($result_insert_celebrity_messages_query) {
                $return["html_message"] = 'Messages Added Successfully.';
                $return["status"] = "success";
                echo json_encode($return);
                exit();
            } else {
                $return["html_message"] = 'Some Error Occured While adding messages';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }
        }
    } else {
        $return["html_message"] = 'Some Error Occured! Please try again.';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }
} else {
    $return["html_message"] = 'Please login.';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}
?>