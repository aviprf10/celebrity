<?php
include "common/config.php";
include "common/check_login.php";

if (isset($_POST))
{
    $temp_location = 'uploads/celebrity-video/';
    $source_doc_path = $temp_location . basename($_FILES['uploadfile']['name']);
    $destination_file_name = basename($_FILES['uploadfile']['name']);

    $ext = pathinfo($source_doc_path, PATHINFO_EXTENSION);
    $date = date('dmyhsi');
    $destination_file_name = $date.'.'.$ext;
    $file_size =  ($_FILES['uploadfile']['size'])/(1024*1024);
    if($file_size>12)
    {
        echo "size_error";
        exit();
    }
    
    if (file_exists($source_doc_path))
    {
        $source_doc_path = $destination_file_name;
    }
    $source_doc_path = $destination_file_name;


    if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $temp_location . $source_doc_path))
    {
        echo "success" . "$$" . $destination_file_name;
    }
    else
    {
        echo "error";
    }
}
else
{
    echo "error";
}
?>