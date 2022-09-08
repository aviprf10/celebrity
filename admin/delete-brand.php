<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($admin == 1)
{
	if(($_POST))
	{
		$delete_id = Secure1($db_mysqli,$_POST['delete_id']);
		
		$all_brand_user_data_array = array();
		$get_brand_user_query = "select * from brand_user where id='$delete_id' and is_deleted='0'";
		$result_get_brand_user_query = mysqli_query($db_mysqli,$get_brand_user_query);
		while ($row_get_brand_user_query = mysqli_fetch_assoc($result_get_brand_user_query))
		{
			$all_brand_user_data_array[] = $row_get_brand_user_query;
		}

		if(count($all_brand_user_data_array) > 0)
		{
			
			$update_brand_user_query = "update brand_user set is_deleted='1' where id='$delete_id'";
			$result_update_brand_user_query = mysqli_query($db_mysqli,$update_brand_user_query);
			if($result_update_brand_user_query)
			{  
				$return["html_message"] = 'Brand Removed Successfully.';
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
			$return["html_message"] = 'Brand_user address Does Not Exist.';
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