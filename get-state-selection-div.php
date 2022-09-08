<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if(isset($_POST))
{
  
  $country_id = $_POST['country_id'];

  $state_data_array = array();
  $get_state_query = "select * from states where country_id='$country_id' and status='1' and is_deleted='0'";
  $result_state_data = mysqli_query($db_mysqli,$get_state_query);

  while ($row_state_data = mysqli_fetch_assoc($result_state_data))
  {
    $state_data_array[] = $row_state_data;
  } 
  $html_message = '';
  if(count($state_data_array)>0)
  {

    $html_message='
    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
      <label for="username">State <span class="required">*</span></label>
     <select name="state_id" id="state_id" data-placeholder="Select State"  class="form-control select-search" data-parsley-required="true" onchange="get_city_selection(this.value)" style="width:100%;">

      <option value="">Select State</option>';
      foreach ($state_data_array as $state_data)
      { 
        $state_id = $state_data['id'];
        $state_name = stripslashes($state_data['state_name']);
        $html_message .= '
        <option  value="'.$state_id.'">'.$state_name.'</option>';
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