<?php
include('common/resize_image.php');
include "common/config.php";
include "common/check_login.php";
if ($celebrity == 1)
{
	$temp_location  = 'uploads/celebrity-images/temp_file/';
	$size_location1 = 'uploads/celebrity-images/size_extra_small/';
	$size_location2 = 'uploads/celebrity-images/size_small/';
	$size_location3 = 'uploads/celebrity-images/size_medium/';
	$size_location4 = 'uploads/celebrity-images/size_large/';
	//$size_location5 = 'uploads/associte-partner/size_extra_large/';

	$source_image_path = $temp_location . basename($_FILES['uploadfile']['name']); 
	
	$ext = pathinfo($source_image_path, PATHINFO_EXTENSION);
	$date = date('dmyhsi');
	$destination_file_name  = $logge_user_name.'_'.$loggedin_user_id.'_'.$date.".".$ext;
	 
	$file_size =  ($_FILES['uploadfile']['size'])/(1024*1024);
	if($file_size>10)
	{
		echo "size_error";
		exit();
	}
	$source_image_path = $temp_location.$destination_file_name;	 
	if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $source_image_path)) 
	{
		
		resize_image($source_image_path, 50,50, $destination_file_name,$size_location1,75);
		resize_image($source_image_path, 105,126, $destination_file_name,$size_location2,75);
		resize_image($source_image_path, 220,220, $destination_file_name,$size_location3,75);
		resize_image($source_image_path, 800,960, $destination_file_name,$size_location4,75);
		//resize_image_without_background($source_image_path, 1000,1000, $destination_file_name,$size_location5,75);
		echo "success"."$$".$destination_file_name; 
	} 
	else 
	{
		echo "error";
	}
}
else
{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$base_url.'logout">';
}
?>