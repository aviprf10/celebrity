<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if(isset($_POST))
{
  $state_id = $_POST['state_id'];
  $city_data_array = array();
  $get_city_query = "select * from cities where state_id='$state_id' and status='1' and is_deleted='0'";
  $result_city_data = mysqli_query($db_mysqli,$get_city_query);
  while ($row_city_data = mysqli_fetch_assoc($result_city_data))
  {
    $city_data_array[] = $row_city_data;
  } 
  $html_message = '';
  if(count($city_data_array)>0)
  {
    $html_message='
    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
      <label for="username">City <span class="required">*</span></label>
     <select name="city_id" id="city_id" data-placeholder="Select City"  class="form-control select-search" data-parsley-required="true" style="width: 100%;">

      <option value="">Select City</option>';
      foreach ($city_data_array as $city_data)
      { 
        $city_id = $city_data['id'];
        $city_name = stripslashes($city_data['city_name']);
        $html_message .= '
        <option  value="'.$city_id.'">'.$city_name.'</option>';
      }

      $html_message .= '</select>
   </p>';
  }  
  $return["html_message"] = $html_message;
  $return["status"] = "success";
  echo json_encode($return);
}
else 
{
  $return["status"] = "error";
  echo json_encode($return);
}
?>