<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if (1 == 1)
{
    if ($_POST)
    {
        if(empty($_POST['occasion_id']))
        {
            $occasion_id = 1; 
        }
        else 
        {
            $occasion_id =$_POST['occasion_id'];
        } 
        
        if(empty($_POST['type_id']))
        {
            $type_id = 1; 
        }
        else 
        {
            $type_id =$_POST['type_id'];
        } 
        $servces_arr = explode('-', $_POST['services_id']);
        $services_id = $servces_arr[0];
        $get_celebrity_messages_query = "SELECT * from celebrity_messages WHERE occasion_id = '$occasion_id' and services_id='$services_id' and type='$type_id' and status='1' and is_deleted='0'";
        $result_get_celebrity_messages_query = mysqli_query($db_mysqli, $get_celebrity_messages_query);
        $all_celebrity_messages_data_array = array();
        while ($row_get_celebrity_messages_query = mysqli_fetch_assoc($result_get_celebrity_messages_query))
        {
            $all_celebrity_messages_data_array[] = $row_get_celebrity_messages_query;
        }


        $html_message = '<div class="items">';
        if(count($all_celebrity_messages_data_array) > 0){
            foreach ($all_celebrity_messages_data_array as $all_celebrity_messages_data)
            {
                $html_message .= '<div class="card">
                                    <div class="card-body" style="width: 100%;  position: relative; border: 1px solid rgba(0,0,0,.125)!important; border-radius: 14px; box-shadow: 0 -8px 22px 0 rgb(0 0 0 / 10%)!important; background-color: #fff!important; margin: 0;">
                                    <p style="height: 270px!important;"> '.$all_celebrity_messages_data['celebrity_message'].'</p>
                                    <hr style="border-top: 1px solid grey;">
                                    <span class="choose-one" style="position: absolute; bottom: 2%; right: 0;left: 17px; width: 131px; cursor: pointer;" onclick="getDisplaytextbox('.$all_celebrity_messages_data['id'].');">Choose this one</span>
                                    </div>
                                </div>';               
            }
        }
        else{
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
        $html_message.='</div>';
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