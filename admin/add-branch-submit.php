<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
	if($_POST)
	{
		$name = Secure1($db_mysqli,$_POST['name']);
		$code = Secure1($db_mysqli,$_POST['code']);
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
		
		$all_branch_data_array = array();
		$get_branch_query = "select * from branch where name='$name' and  is_deleted='0'";
		$result_get_branch_query = mysqli_query($db_mysqli,$get_branch_query);
		while ($row_get_branch_query = mysqli_fetch_assoc($result_get_branch_query))
		{
			$all_branch_data_array[] = $row_get_branch_query;
		}

		if(count($all_branch_data_array)>0)
		{
			$return["html_message"] = 'branch Already Exist. Try Another!';
			$return["status"] = "error";
			echo json_encode($return);
			exit();
		}
		else
		{
			
			$insert_branch_query = "INSERT INTO branch (name,code, images,created_on,status, is_deleted) VALUES ('$name','$code','$images', '$created_on', '$status','0');";
			$result_insert_branch_query = mysqli_query($db_mysqli,$insert_branch_query);
			
			if($result_insert_branch_query)   
			{ 
				$return["html_message"] = 'Branch Added Successfully.';
				$return["status"] = "success";
				echo json_encode($return); 
				exit();
			}
			else 
			{
				$return["html_message"] = 'Some Error Occured While adding Branch';
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