<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
	if($_POST)
	{
		$name = Secure1($db_mysqli,$_POST['name']);
		$description = Secure1($db_mysqli,$_POST['description']);
		$images = Secure1($db_mysqli,$_POST['file_name1']);
		$created_on = get_current_date_time();
		if(isset($_POST['status']))
		{
			$status = 1;
		}
		else
		{
			$status = 0;
		}
		
		$all_testimonial_data_array = array();
		$get_testimonial_query = "select * from testimonial where name='$name' and  is_deleted='0'";
		$result_get_testimonial_query = mysqli_query($db_mysqli,$get_testimonial_query);
		while ($row_get_testimonial_query = mysqli_fetch_assoc($result_get_testimonial_query))
		{
			$all_testimonial_data_array[] = $row_get_testimonial_query;
		}

		if(count($all_testimonial_data_array)>0)
		{
			$return["html_message"] = 'Testimonial Already Exist. Try Another!';
			$return["status"] = "error";
			echo json_encode($return);
			exit();
		}
		else
		{
			
			$insert_testimonial_query = "INSERT INTO testimonial (name,description, images,created_on,status, is_deleted) VALUES ('$name','$description','$images', '$created_on', '$status','0');";
			$result_insert_testimonial_query = mysqli_query($db_mysqli,$insert_testimonial_query);
			
			if($result_insert_testimonial_query)   
			{ 
				$return["html_message"] = 'Testimonial Added Successfully.';
				$return["status"] = "success";
				echo json_encode($return); 
				exit();
			}
			else 
			{
				$return["html_message"] = 'Some Error Occured While adding Testimonial';
				$return["status"] = "error";
				echo json_encode($return);
				exit();
			} 
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