<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($celebrity == 1)
{
	if(isset($_POST))
	{
		$edit_id 			= Secure1($db_mysqli,$_POST['edit_id']);
		$celebrity_images 	= Secure1($db_mysqli,$_POST['file_name2']);
		$celebrity_video 	= Secure1($db_mysqli,$_POST['file_name1']);
		$media_type 		= Secure1($db_mysqli,$_POST['media_type']);
		$created_on   		= get_current_date_time();

		if(isset($_POST['status']))
		{
			$status = 1;
		}
		else
		{
			$status = 0;
		}
		
		$update_celebrity_images_query = "update celebrity_images set celebrity_video='$celebrity_video',celebrity_images='$celebrity_images', media_type='$media_type',status='$status', updated_on='$created_on' where id='$edit_id'";
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
			$return["html_message"] = 'Images/Video Updated Successfully.';
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
}
else
{
	$return["html_message"] = 'Please login.';
	$return["status"] = "error";
	echo json_encode($return);
	exit();
}
?>