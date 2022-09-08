<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if (1 == 1)
{
    if ($_POST)
    {
        $occasion_id = Secure1($db_mysqli, $_POST['occasion_id']);
        $user_name = Secure1($db_mysqli, $_POST['user_name']);
        $servces_arr = explode('-', $_POST['services_id']);
        $services_id = $servces_arr[0];
        $get_celebrity_messages_query = "SELECT * from celebrity_messages WHERE id = '$occasion_id' and services_id = '$services_id' and status='1' and is_deleted='0'";
        $result_get_celebrity_messages_query = mysqli_query($db_mysqli, $get_celebrity_messages_query);
        $all_celebrity_messages_data_array = array();
        while ($row_get_celebrity_messages_query = mysqli_fetch_assoc($result_get_celebrity_messages_query))
        {
            $all_celebrity_messages_data_array[] = $row_get_celebrity_messages_query;
        }

        if(count($all_celebrity_messages_data_array) > 0)
        {
            $html_message = '<div class="col-md-12">
                <div class="form-group">
                    <label class="spr-form-label" for="nickname">'.ucfirst($user_name).' will read/write this as script for your requested service, so choose a template and while you edit/write be careful about your names, numbers and dates <span class="required">*</span></label>
                    <textarea class="form-control" name="user_message_'.$services_id.'" id="user_message_'.$services_id.'" rows="5" maxlength="300">'.$all_celebrity_messages_data_array[0]['celebrity_message'].'</textarea>
                    <input type="hidden" name="message_id_'.$services_id.'" id="message_id_'.$services_id.'" value="'.$all_celebrity_messages_data_array[0]['id'].'">
                    <span style="float:right; font-weight: 500;" id="textarea_feedback"></span><br>
                </div>
            </div>
            <hr style="border-top: 1px solid grey; margin:14px;">
            <span class="more-templates" style="float: right; font-size: 17px; cursor:pointer" onclick="getDisplaymessage();">Show more templates</span>';  

        }
        else 
        {
            $html_message = '<div class="col-md-12">
                <div class="form-group">
                    <label class="spr-form-label" for="nickname">'.ucfirst($user_name).' will read/write this as script for your requested service, so choose a template and while you edit/write be careful about your names, numbers and dates <span class="required">*</span></label>
                    <textarea class="form-control" name="user_message_'.$services_id.'" id="user_message_'.$services_id.'" rows="5" maxlength="300"></textarea>
                    <input type="hidden" name="message_id_'.$services_id.'" id="message_id_'.$services_id.'" value="'.$all_celebrity_messages_data_array[0]['id'].'">
                    <span style="float:right; font-weight: 500;" id="textarea_feedback"></span><br>
                </div>
            </div>
            <hr style="border-top: 1px solid grey; margin:14px;">
            <span class="more-templates" style="float: right; font-size: 17px; cursor:pointer" onclick="getDisplaymessage();">Show more templates</span>';  

        }
       
        $return["html_message"] = $html_message;
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
    $return["html_message"] = 'Please login.';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}
?>