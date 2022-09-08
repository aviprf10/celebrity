<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
	if(isset($_POST))
	{
		$edit_id = Secure1($db_mysqli,$_POST['edit_id']);


		$all_testimonial_data_array = array();
		$get_testimonial_query = "select * from testimonial where id='$edit_id' and is_deleted='0'";
		$result_get_testimonial_query = mysqli_query($db_mysqli,$get_testimonial_query);
		while ($row_get_testimonial_query = mysqli_fetch_assoc($result_get_testimonial_query))
		{
			$all_testimonial_data_array[] = $row_get_testimonial_query;
		}

		if(count($all_testimonial_data_array) > 0)
		{

			$name      	  = Secure1($db_mysqli,$_POST['name']);
			$description  = Secure1($db_mysqli,$_POST['description']);
			$images 	  = Secure1($db_mysqli,$_POST['file_name1']);
			$created_on   = get_current_date_time();

			$check_testimonial_data_array = array();
			$check_testimonial_query = "select * from testimonial where name='$name' AND id != '$edit_id' and is_deleted='0'";
			$result_check_testimonial_query = mysqli_query($db_mysqli,$check_testimonial_query);
			while ($row_check_testimonial_query = mysqli_fetch_assoc($result_check_testimonial_query))
			{
				$check_testimonial_data_array[] = $row_check_testimonial_query;
			}

			if (count($check_testimonial_data_array) > 0)
			{
				$return["html_message"] = 'Testimonial already exist. Try another!';
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
			
			$update_testimonial_query = "update testimonial set name='$name',description='$description', images='$images', status='$status', updated_on='$created_on' where id='$edit_id'";
			$result_update_testimonial_query = mysqli_query($db_mysqli,$update_testimonial_query);

			$affected_rows = mysqli_affected_rows($db_mysqli);

			if($result_update_testimonial_query)
			{
				if ($affected_rows == 0)
				{
					$return["html_message"] = 'Nothing Updated by user.';
					$return["status"] = "success";
					echo json_encode($return);
					exit();
				}
				$return["html_message"] = 'Testimonial Updated Successfully.';
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
			$return["html_message"] = 'Testimonial Does Not Exist.';
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