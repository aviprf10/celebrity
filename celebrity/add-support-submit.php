<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($celebrity == 1)
{
   
    if (isset($_POST))
    {
       
        $user_name          = $loggedin_user_name;
        $user_type          = 'Celebrity';
        $subject            = Secure1($db_mysqli, $_POST['subject']);
        $description        = Secure1($db_mysqli, $_POST['description']);
        $created_on         = get_current_date_time();
        
        
        $insert_brandpost_query = "INSERT INTO support_inquiry (user_name, user_type, subject, description, created_on) 
        VALUES ('$user_name','$user_type','$subject','$description','$created_on')";
        $result_insert_brandpost_query = mysqli_query($db_mysqli, $insert_brandpost_query);

        $return["html_message"] = 'Message added successfully.';
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
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url1 . 'logout">';
}
?>