<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($celebrity == 1)
{
	if($_POST)
	{
		$celebrity_images 	= Secure1($db_mysqli,$_POST['file_name2']);
		$celebrity_video 	= Secure1($db_mysqli,$_POST['file_name1']);
		$media_type 		= Secure1($db_mysqli,$_POST['media_type']);
		$created_on = get_current_date_time();
		if(isset($_POST['status']))
		{
			$status = 1;
		}
		else
		{
			$status = 0;
		}
		
		$insert_celebrity_images_query = "INSERT INTO celebrity_images (celebrity_id,media_type, celebrity_images, celebrity_video, created_on,status, is_deleted) VALUES ('$loggedin_user_id','$media_type','$celebrity_images', '$celebrity_video', '$created_on', '$status','0');";
		$result_insert_celebrity_images_query = mysqli_query($db_mysqli,$insert_celebrity_images_query);
		
		if($result_insert_celebrity_images_query)   
		{ 
			$return["html_message"] = 'Images/Video Added Successfully.';
			$return["status"] = "success";
			echo json_encode($return); 
			exit();
		}
		else 
		{
			$return["html_message"] = 'Some Error Occured While adding images/video';
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
	$return["html_message"] = 'Please login.';
	$return["status"] = "error";
	echo json_encode($return);
	exit();
}
?>