<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
	if(isset($_POST))
	{
		$edit_id = Secure1($db_mysqli,$_POST['edit_id']);

		$all_celebrity_messages_data_array = array();
		$get_celebrity_messages_query = "select * from celebrity_messages where id='$edit_id' and is_deleted='0'";
		$result_get_celebrity_messages_query = mysqli_query($db_mysqli,$get_celebrity_messages_query);
		while ($row_get_celebrity_messages_query = mysqli_fetch_assoc($result_get_celebrity_messages_query))
		{
			$all_celebrity_messages_data_array[] = $row_get_celebrity_messages_query;
		}

		if(count($all_celebrity_messages_data_array) > 0)
		{

			$occasion_id = Secure1($db_mysqli,$_POST['occasion_id']);
			$services_id = Secure1($db_mysqli,$_POST['services_id']);
			$type = Secure1($db_mysqli,$_POST['type']);
			$celebrity_message = Secure1($db_mysqli,$_POST['celebrity_message']);
			$updated_on = get_current_date_time();
			
			$check_celebrity_messages_data_array = array();
			$check_celebrity_messages_query = "select * from celebrity_messages where celebrity_message='$celebrity_message' AND services_id='$services_id' AND occasion_id='$occasion_id' AND id!='$edit_id' and is_deleted='0'";
			$result_check_celebrity_messages_query = mysqli_query($db_mysqli,$check_celebrity_messages_query);
			while ($row_check_celebrity_messages_query = mysqli_fetch_assoc($result_check_celebrity_messages_query))
			{
				$check_celebrity_messages_data_array[] = $row_check_celebrity_messages_query;
			}

			if (count($check_celebrity_messages_data_array) > 0)
			{
				$return["html_message"] = 'Messages already exist in selected cities.';
				$return["status"] = "error";
				echo json_encode($return);
				exit();
			}

			if(isset($_POST['status']))
			{
				$status = 1;
			}
			else
			{
				$status = 0;
			}
			
			$update_celebrity_messages_query = "update celebrity_messages set occasion_id='$occasion_id',services_id='$services_id', type='$type', celebrity_message='$celebrity_message',status='$status',updated_on='$updated_on' where id='$edit_id'";
			$result_update_celebrity_messages_query = mysqli_query($db_mysqli,$update_celebrity_messages_query);
			$affected_rows = mysqli_affected_rows($db_mysqli);
			
			if($result_update_celebrity_messages_query)
			{
				if ($affected_rows == 0)
				{
					$return["html_message"] = 'Nothing Updated by user.';
					$return["status"] = "success";
					echo json_encode($return);
					exit();
				}
				$return["html_message"] = 'Messages Updated Successfully.';
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
			$return["html_message"] = 'Messages Does Not Exist.';
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