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
            $occasion_id = Secure1($db_mysqli, $_POST['occasion_id']);
        }

        if(empty($_POST['type_id']))
        {
            $type_id = 1;
        }
        else 
        {
            $type_id = $_POST['type_id'];
        }
        
        

        $html_message ='';
        if($type_id ==1)
        {
            $servces_arr = explode('-', $_POST['services_id']);
            $services_id = $servces_arr[0];
            $services_name = $servces_arr[1];
            $price = $servces_arr[2];
            $celebrity_price_id = $servces_arr[3];
            $user_name = Secure1($db_mysqli, $_POST['user_name']);
            $user_id = Secure1($db_mysqli, $_POST['user_id']);
            $get_celebrity_messages_query = "SELECT * from celebrity_messages WHERE occasion_id = '$occasion_id' and services_id='$services_id' and type='$type_id' and status='1' and is_deleted='0'";
            $result_get_celebrity_messages_query = mysqli_query($db_mysqli, $get_celebrity_messages_query);
            $all_celebrity_messages_data_array = array();
            while ($row_get_celebrity_messages_query = mysqli_fetch_assoc($result_get_celebrity_messages_query))
            {
                $all_celebrity_messages_data_array[] = $row_get_celebrity_messages_query;
            }

            $occasion_data_array = array();
            $get_occasion_query = "select * from occasion where is_deleted='0'";
            $result_get_occasion_query = mysqli_query($db_mysqli, $get_occasion_query);
            while ($row_get_occasion_query = mysqli_fetch_assoc($result_get_occasion_query))
            {
                $occasion_data_array[] = $row_get_occasion_query;
            }

            $services_data_array = array();
            $get_services_query = "select * from services where is_deleted='0' and id='$services_id'";
            $result_get_services_query = mysqli_query($db_mysqli, $get_services_query);
            while ($row_get_services_query = mysqli_fetch_assoc($result_get_services_query))
            {
                $services_data_array[] = $row_get_services_query;
            }

            $html_message1 .= '<p>'.$services_data_array[0]['description'].'</p>';
            $html_message .= '
            <div class="product-description">
            <h3 style="margin: 0px;">Book a Video Call With '.$user_name.'</h3>
            <p style="margin-bottom:0px;">Awesome we are excited to make your moment special, please fill the form and we’ll roll.</p>
            <br>
            <p style="margin-bottom:10px;"><b>This video call message is for:</b></p>
            <div class="col-md-8">
                <div class="form-group">';
                    if($services_data_array[0]['is_myself'] == '1'){
                        $html_message .= '<a class="btn btn-primary" style="background-color: cornflowerblue; border-radius: 10px;" onclick="getfilter('.$services_id.',1)">MySelf</a>&nbsp;&nbsp;&nbsp;';
                    } 
                    
                    if($services_data_array[0]['is_someelse'] == '1'){
                        $html_message .= '<a class="btn btn-success" style="border-radius: 10px;" onclick="getfilter('.$services_id.',2)">Someone else</a>';
                    }
                $html_message .= '</div>
            </div> 
            <div class="col-md-8">
                <div class="form-group">
                    <label class="spr-form-label" for="nickname">Name <span class="required">*</span></label>
                    <input class="spr-form-input spr-form-input-text" data-parsley-required="true" type="text" name="name_'.$services_id.'" id="name_'.$services_id.'" placeholder="Enter Name">
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label class="spr-form-label" for="nickname">Instagram Id <span class="required">*</span></label>
                    <input class="spr-form-input spr-form-input-text" data-parsley-required="true" type="text" name="instagram_'.$services_id.'" id="instagram_'.$services_id.'" placeholder="Enter Instagram ID">
                </div>
            </div> 
            <div class="row">';
                if($services_data_array[0]['is_occasion'] == '1'){   
                    $html_message .= '<div class="col-md-6">
                    <div class="form-group">
                        <label class="spr-form-label" for="nickname">What is the occasion? <span class="required">*</span></label>
                        <select class="form-control" name="occasion_id_'.$services_id.'" id="occasion_id_'.$services_id.'" onchange="getMessage('.$services_id.',this.value)" data-parsley-required="true">';
                            foreach($occasion_data_array as $occasion_data){

                                $html_message .= '<option value="'.$occasion_data['id'].'">'.$occasion_data['occasion_title'].'</option>';
                            } 
                        $html_message .= '</select>
                    </div>
                </div> ';
                }
            if($services_data_array[0]['is_date'] == '1'){
                $html_message .= ' <div class="col-md-6">
                    <div class="form-group">
                        <label class="spr-form-label" for="nickname">Preferred date of video call? <span class="required">*</span></label>
                        <input class="spr-form-input spr-form-input-text" type="date" name="date_of_delevery_'.$services_id.'" id="date_of_delevery_'.$services_id.'" data-parsley-required="true">
                        <input type="hidden" name="celebrity_price_'.$services_id.'" id="celebrity_price_'.$services_id.'" value="'.$price.'">
                        <input type="hidden" name="celebrity_id_'.$services_id.'" value="'.$user_id.'">
                        <input type="hidden" name="request_for_'.$services_id.'" id="request_for_'.$services_id.'" value="'.$services_name.'">
                        <input type="hidden" name="celebrity_price_id_'.$services_id.'" id="celebrity_price_id_'.$services_id.'" value="'.$celebrity_price_id.'">
                        <input type="hidden" name="type_id_'.$services_id.'" id="type_id_'.$services_id.'" value="1">
                    </div>
                </div>'; 
                }   
                $html_message .= ' </div> ';
            if($services_data_array[0]['is_message'] == '1'){     
                $html_message .= '<div class="row">
                <p style="margin-bottom: 5px;"> Message<br>
                    <span style="color:red">Please select a template. (Not applicable for Brand, Social Work and Corporate messages) </span> 
                </p>
                    <div class="quote-wraper" id="occasionmessage_div"></div>
                    <div id="select_text"></div>
                </div>                    
            </div>';
            }
        }
        else 
        {
            
            $servces_arr = explode('-', $_POST['services_id']);
            $services_id = $servces_arr[0];
            $services_name = $servces_arr[1];
            $price = $servces_arr[2];
            $celebrity_price_id = $servces_arr[3];
            $user_name = Secure1($db_mysqli, $_POST['user_name']);
            $user_id = Secure1($db_mysqli, $_POST['user_id']);
            $get_celebrity_messages_query = "SELECT * from celebrity_messages WHERE occasion_id = '$occasion_id' and services_id='$services_id' and type='$type_id' and status='1' and is_deleted='0'";
            $result_get_celebrity_messages_query = mysqli_query($db_mysqli, $get_celebrity_messages_query);
            $all_celebrity_messages_data_array = array();
            while ($row_get_celebrity_messages_query = mysqli_fetch_assoc($result_get_celebrity_messages_query))
            {
                $all_celebrity_messages_data_array[] = $row_get_celebrity_messages_query;
            }

            $occasion_data_array = array();
            $get_occasion_query = "select * from occasion where is_deleted='0'";
            $result_get_occasion_query = mysqli_query($db_mysqli, $get_occasion_query);
            while ($row_get_occasion_query = mysqli_fetch_assoc($result_get_occasion_query))
            {
                $occasion_data_array[] = $row_get_occasion_query;
            }

            $services_data_array = array();
            $get_services_query = "select * from services where is_deleted='0' and id='$services_id'";
            $result_get_services_query = mysqli_query($db_mysqli, $get_services_query);
            while ($row_get_services_query = mysqli_fetch_assoc($result_get_services_query))
            {
                $services_data_array[] = $row_get_services_query;
            }
            $html_message1 .= '<p>'.$services_data_array[0]['description'].'</p>';
            $html_message .= '
            <div class="product-description">
            <h3 style="margin: 0px;">Book a Video Call With '.$user_name.'</h3>
            <p style="margin-bottom:0px;">Awesome we are excited to make your moment special, please fill the form and we’ll roll.</p>
            <br>
            <p style="margin-bottom:10px;"><b>This video call message is for:</b></p>
            <div class="col-md-8">
                <div class="form-group">';
                    if($services_data_array[0]['is_myself'] == '1'){
                        $html_message .= '<a class="btn btn-primary" style="background-color: cornflowerblue; border-radius: 10px;" onclick="getfilter('.$services_id.',1)">MySelf</a>&nbsp;&nbsp;&nbsp;';
                    }  
                    if($services_data_array[0]['is_someelse'] == '1'){  
                        $html_message .= '<a class="btn btn-success" style="border-radius: 10px;" onclick="getfilter('.$services_id.',2)">Someone else</a>';
                    }    
                $html_message .= ' </div>
            </div> 
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="spr-form-label" for="nickname">To <span class="required">*</span></label>
                        <input class="spr-form-input spr-form-input-text" data-parsley-required="true" type="text" name="name_'.$services_id.'" id="name_'.$services_id.'" placeholder="Enter Name">
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="spr-form-label" for="nickname">From <span class="required">*</span></label>
                        <input class="spr-form-input spr-form-input-text" data-parsley-required="true" type="text" name="from_name_'.$services_id.'" id="from_name_'.$services_id.'" placeholder="Enter Name">
                    </div>
                </div> 
            </div> 
            <div class="col-md-8">
                <div class="form-group">
                    <label class="spr-form-label" for="nickname">Instagram Id <span class="required">*</span></label>
                    <input class="spr-form-input spr-form-input-text" data-parsley-required="true" type="text" name="instagram_'.$services_id.'" id="instagram_'.$services_id.'" placeholder="Enter Instagram ID">
                </div>
            </div>    
            <div class="row">';
                if($services_data_array[0]['is_occasion'] == '1'){    
                    $html_message .= '<div class="col-md-6">
                    <div class="form-group">
                        <label class="spr-form-label" for="nickname">What is the occasion? <span class="required">*</span></label>
                        <select class="form-control" name="occasion_id_'.$services_id.'" id="occasion_id_'.$services_id.'" onchange="getMessage('.$services_id.',this.value)" data-parsley-required="true">';
                    
                            foreach($occasion_data_array as $occasion_data){

                                $html_message .= '<option value="'.$occasion_data['id'].'">'.$occasion_data['occasion_title'].'</option>';
                            } 
                        $html_message .= '</select>
                    </div>
                </div> ';
                }
                if($services_data_array[0]['is_date'] == '1'){ 
                    $html_message .= '<div class="col-md-6">
                    <div class="form-group">
                        <label class="spr-form-label" for="nickname">Preferred date of video call? <span class="required">*</span></label>
                        <input class="spr-form-input spr-form-input-text" type="date" name="date_of_delevery_'.$services_id.'" id="date_of_delevery_'.$services_id.'" data-parsley-required="true">
                        <input type="hidden" name="celebrity_price_'.$services_id.'" id="celebrity_price_'.$services_id.'" value="'.$price.'">
                        <input type="hidden" name="celebrity_id_'.$services_id.'" value="'.$user_id.'">
                        <input type="hidden" name="request_for_'.$services_id.'" id="request_for_'.$services_id.'" value="'.$services_name.'">
                        <input type="hidden" name="celebrity_price_id_'.$services_id.'" id="celebrity_price_id_'.$services_id.'" value="'.$celebrity_price_id.'">
                        <input type="hidden" name="type_id_'.$services_id.'" id="type_id_'.$services_id.'" value="2">
                    </div>
                </div> ';
                }   
            $html_message .= '</div>';
            if($services_data_array[0]['is_message'] == '1'){   
                $html_message .= '<div class="row">
            <p style="margin-bottom: 5px;"> Message<br>
            <span style="color:red">Please select a template. (Not applicable for Brand, Social Work and Corporate messages) </span> </p>
                    <div class="quote-wraper" id="occasionmessage_div"></div>
                    <div id="select_text"></div>
                </div>                    
            </div>';
            }
        }
        
        $return["html_message"] = $html_message;
        $return["html_message1"] = $html_message1;
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