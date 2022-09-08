<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($user == 1)
{
	if(isset($_POST))
	{
		$old_password =  Secure1($db_mysqli,$_POST['old_password']);
		$new_password = Secure1($db_mysqli,$_POST['new_password']);
		$repeat_password = Secure1($db_mysqli,$_POST['repeat_password']);

		if($new_password == $repeat_password)
		{
			$user_data_array = array();
			$user_data_query = "select * from user where id='$loggedin_user_id'";
	        $result_user_data = mysqli_query($db_mysqli,$user_data_query);
	        while ($row_user_data = mysqli_fetch_assoc($result_user_data))
		    {
		    	$user_data_array[] = $row_user_data;
		    } 
			if(count($user_data_array)>0)
			{
				if($user_data_array[0]['password'] == $old_password)
				{
					if($old_password != $new_password)
					{
						$password = $new_password;
						$updated_on = date('Y-m-d H:i:s');

						$user_data_query = "update user set password='$password', updated_on='$updated_on' where id='$loggedin_user_id'";
	        			$user_data = mysqli_query($db_mysqli,$user_data_query);
						
						if(isset($user_data) && $user_data == 1)    
						{   
							$return["html_message"] = 'Password details updated successfully.';
							$return["status"] = "success";
							echo json_encode($return);
						}
						else if(isset($user_data) && $user_data == 0)    
						{   
							$return["html_message"] = 'Nothing to update';
							$return["status"] = "success";
							echo json_encode($return);
						}
						else 
						{
							$return["html_message"] = 'Some Error Occured! Please try again.';
							$return["status"] = "error";
							echo json_encode($return);
						}
					}
					else
					{
						$return["html_message"] = 'Old password and new password are same.';
						$return["status"] = "error";
						echo json_encode($return);
					}
				}
				else
				{
					$return["html_message"] = 'Old password does not match.';
					$return["status"] = "error";
					echo json_encode($return);
				}
			}	
			else
			{
				$return["html_message"] = 'No user found.';
				$return["status"] = "error";
				echo json_encode($return);
			}
		}
		else
		{
			$return["html_message"] = 'New password & repeat password does not match.';
			$return["status"] = "error";
			echo json_encode($return);
		}	
	}
	else 
	{
		$return["html_message"] = 'Some Error Occured! Please try again.';
		$return["status"] = "error";
		echo json_encode($return);
	}
}
else
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$base_url.'logout">';
}
?>