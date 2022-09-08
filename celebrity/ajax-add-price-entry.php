<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($celebrity == 1)
{
  if (isset($_POST['index_no']) && $_POST['index_no'] != '')
  {
    $all_services_data_array = array();
    $get_services_query = "SELECT * FROM services WHERE is_deleted='0'";
    $result_get_services_query = mysqli_query($db_mysqli, $get_services_query);
    while ($row_get_services_query = mysqli_fetch_assoc($result_get_services_query))
    {
        $all_services_data_array[] = $row_get_services_query;
    }

      $index_no = $_POST['index_no'];
      $html_message = '';
      $html_message .= ' 
          <div  class="row" style=" margin-top:10px;" id="price_entry_div_'.$index_no .'">
              <div class="col-md-3" id="inputedu">
              <input type="hidden" name="old_price_entry_id_'.$index_no .'" id="old_price_entry_id_'.$index_no .'" value="">
              <label for="price" style="color:#000">Select Service : </label> 
               <select class="select-search form-control" id="services_id_'.$index_no .'"
                    name="services_id_'.$index_no .'" data-placeholder="Select a Services...">
                <option value=""> select Services</option>';
                foreach ($all_services_data_array as $all_services_data)
                {
                    $html_message .= '<option value="'.$all_services_data['id'].'">'.$all_services_data['services_name'].'</option>';
                }    
                $html_message .= '</select>    
            </div>
            <div class="col-md-3">
                <label for="price" style="color:#000">Price : </label>
                <input type="text" name="price_'.$index_no .'" id="price_'.$index_no .'" class="form-control" placeholder="Price" min="100">
            </div> 
            <div class="col-md-3">
                <label for="price" style="color:#000">Discount Type : </label>
                <select class="form-control" name="disocunt_type_'.$index_no .'" id="disocunt_type_'.$index_no .'">
                    <option value="">Select Discount Type</option>
                    <option value="price">Price</option>
                    <option value="percentage">Percentage</option>
                </select>    
            </div> 
            <div class="col-md-2">
                <label for="price" style="color:#000">Discount : </label>
                <input type="text" class="form-control" id="discount_'.$index_no .'"  name="discount_'.$index_no .'" placeholder="Enter Discount">
            </div> 
             <div class="col-md-1"  id="addbotton">
                <a onclick="add_price_entry('.$index_no .')" style="cursor: pointer; float:left;">
                    <img src="'.$base_url_images.'plus.png" style="margin-top:32px;">
                </a> &nbsp;&nbsp;&nbsp;
                <a onclick="remove_price_entry('.$index_no .')" style="cursor: pointer;">
                    <img src="'.$base_url_images.'minus.png" style="margin-top:32px;">
                </a>
             </div>   
          </div>';
      $return["html_message"] = $html_message;
      $return["status"] = "success";
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
   echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$base_url.'">';
}  
?>