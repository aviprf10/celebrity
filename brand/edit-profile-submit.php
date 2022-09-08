<?php
   include "common/config.php";
   include "common/check_login.php";
   header('Content-type: application/json');
   if($brand == 1)
   {
   	if(isset($_POST))
   	{
   		$name = Secure1($db_mysqli,$_POST['name']);
   		$mobile =  Secure1($db_mysqli,$_POST['mobile']);
   		$email =  Secure1($db_mysqli,$_POST['email']);
         $profile_pic     = Secure1($db_mysqli,$_POST['file_name1']);
   		$updated_on = date('Y-m-d H:i:s');
         
         $get_mobile_array = array();
         $get_mobile_query = "select * from brand_user where id!='$loggedin_user_id' and mobile='$mobile' and is_deleted='0'";
         $result_get_mobile_query = mysqli_query($db_mysqli, $get_mobile_query);
         while ($row_get_mobile_query = mysqli_fetch_assoc($result_get_mobile_query))
         {
            $get_mobile_array[] = $row_get_mobile_query;
         }
         if(count($get_mobile_array)>0)
         {
            $return["html_message"] = 'Mobile number already exist.';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
         }

   		$user_data_query = "update brand_user set name='$name', user_name='$name',mobile='$mobile',  profile_pic='$profile_pic', updated_on='$updated_on' where id='$loggedin_user_id'";
         $user_data = mysqli_query($db_mysqli,$user_data_query);
           
   		if(isset($user_data) && $user_data == 1)    
   		{   
   			$_SESSION['name_'.$company_name_session] = Secure1($db_mysqli,$_POST['first_name']);
   			$temp_user_name=$_SESSION['name_'.$company_name_session];
            $loggedin_user_name=$_SESSION['name_'.$company_name_session];
            
   			/*if(Secure1($_POST['file_name1']) != 'default_profile.jpg')
   			{
   				$_SESSION['profile_pic_100'.$company_name_session] = $base_url_uploads."profile_pic/size_100/".Secure1($db_mysqli,$_POST['file_name1']);
   				$_SESSION['profile_pic_450'.$company_name_session] = $base_url_uploads."profile_pic/size_450/".Secure1($db_mysqli,$_POST['file_name1']);
   			}*/
   
   			$return["html_message"] = 'Profile details updated successfully.';
            $return["status"] = "success";
   			$return["user_name"] = $temp_user_name;
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
   		$return["html_message"] = 'Some Error Occured! Please try again2.';
   		$return["status"] = "error";
   		echo json_encode($return);
   	}
   }
   else
   {
   	echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$base_url.'logout">';
   }
   ?>