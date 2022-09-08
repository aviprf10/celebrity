<?php
include "common/config.php";
header('Content-type: application/json');

if(isset($_POST))
{
    $web_access_token 	= Secure1($db_mysqli,$_POST['web_access_token']);
    $celebrity_video 	= Secure1($db_mysqli,$_POST['file_name1']);
    $created_on   		= get_current_date_time();

    
    $update_celebrity_images_query = "update video_celebrity_history set video='$celebrity_video', updated_on='$created_on', is_uploaded='2' where web_access_token='$web_access_token'";
    $result_update_celebrity_images_query = mysqli_query($db_mysqli,$update_celebrity_images_query);
    $affected_rows = mysqli_affected_rows($db_mysqli);
    if($result_update_celebrity_images_query)
    {
        if ($affected_rows == 0)
        {
            $return["html_message"] = 'Nothing Updated by user.';
            $return["status"] = "success";
            echo json_encode($return);
            exit();
        }
        $return["html_message"] = 'Video Uploaded Successfully. please wait for approved by admin and brand';
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
    $return["html_message"] = 'Some Error Occured! Please try again.';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}

?>