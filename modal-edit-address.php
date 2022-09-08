<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if(isset($_POST))
{
   
  $country_data_array = array();
  $get_country_data = "select  * FROM country WHERE  status = '1'  AND is_deleted = '0' ";
  $result_country_data = mysqli_query($db_mysqli,$get_country_data);
  while ($row_country_data = mysqli_fetch_assoc($result_country_data))
  {
    $country_data_array[] = $row_country_data;
  } 

  $edit_address_id = Secure1($db_mysqli,$_POST['id']);
  $html_message='';
  if($edit_address_id!=00)
  {
    $check_user_address_data_array = array();
    $get_user_address_data = "select  uad.*,c.id as c_id,c.city_name,s.id as s_id,s.state_name,cy.id as cy_id,cy.country_name FROM user_address uad LEFT JOIN cities c on uad.city_id=c.id LEFT JOIN states s on uad.state_id=s.id LEFT JOIN country cy on uad.country_id=cy.id WHERE  uad.id = '$edit_address_id'  AND uad.user_id = '$loggedin_user_id'  AND uad.status = '1'  AND uad.is_deleted = '0'";
    $result_user_address_data = mysqli_query($db_mysqli,$get_user_address_data);
    while ($row_user_address_data = mysqli_fetch_assoc($result_user_address_data))
    {
      $check_user_address_data_array[] = $row_user_address_data;
    } 
    if(count($check_user_address_data_array)>0)
    {
      $user_address_data=$check_user_address_data_array[0];
      $country_id=$user_address_data['country_id'];
      $state_id=$user_address_data['state_id'];
      $city_id=$user_address_data['city_id'];

      $all_state_data_array = array();
      $get_state_query = "select * from states where country_id=$country_id and is_deleted='0'";
      $result_get_state_query = mysqli_query($db_mysqli, $get_state_query);
      while ($row_get_state_query = mysqli_fetch_assoc($result_get_state_query))
      {
         $all_state_data_array[] = $row_get_state_query;
      }


      $all_city_data_array = array();
      $get_city_query = "select * from cities where state_id=$state_id and is_deleted='0'";
      $result_get_city_query = mysqli_query($db_mysqli, $get_city_query);
      while ($row_get_city_query = mysqli_fetch_assoc($result_get_city_query))
      {
         $all_city_data_array[] = $row_get_city_query;
      }

      $html_message.='
    <div class="modal fade" id="edit_address_model" role="dialog">
     <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" onclick="closeModel();" data-dismiss="modal" style="float:right;">&times;</button>
              <h4 class="modal-title">Edit Address</h4>
           </div>
           <div id="edit_address_form_error_msg"></div>
           <form method="POST" id="edit_address_form" role="form" data-parsley-validate>
              <div class="modal-body">
                 <div class="form-group row">
                   <div class="col-sm-6">
                    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                      <label class="control-label" for="first_name">First Name <span class="asterisk-mark">*</span></label>
                      <input type="hidden" name="edit_id"  id="edit_id" class="form-control"  value="'.$user_address_data['id'].'"/>
                      <input type="text" name="first_name"  id="first_name" placeholder="First Name" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" data-parsley-required="true"  value="'.$user_address_data['first_name'].'"/>
                    </p>
                   </div>
                   <div class="col-sm-6">
                    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                      <label class="control-label" for="last_name">Last name <span class="asterisk-mark">*</span></label>
                      <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" data-parsley-required="true"  value="'.$user_address_data['last_name'].'"/>
                    </p>
                   </div>
                 </div>
                 <div class="form-group row">
                   <div class="col-sm-6">
                    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                      <label class="control-label" for="company">Company</label>
                      <input type="text" name="company" id="company" placeholder="Company" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" value="'.$user_address_data['company'].'"/>
                    </p>
                   </div>
                   <div class="col-sm-6">
                    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                      <label class="control-label" for="mobile">Mobile <span class="asterisk-mark">*</span></label>
                      <input type="text" name="mobile" id="mobile" placeholder="Mobile" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" size="35" maxlength="10" minlength="10" data-parsley-required="true"  value="'.$user_address_data['mobile'].'"/>
                    </p>
                   </div>
                 </div>
                 <div class="form-group">
                    <div class="row">
                       <div class="col-md-6">
                        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                          <label>Address1:  <span class="asterisk-mark">*</span></label>
                          <textarea  rows="2" name="edit_address_form_address1" id="edit_address_form_address1" type="text" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" placeholder="Address1" data-parsley-required="true" cols="38">'.$user_address_data['address1'].'</textarea>
                        </p>
                       </div>
                       <div class="col-md-6">
                        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                          <label>Address2: </label>
                          <textarea  rows="2" name="edit_address_form_address2" id="edit_address_form_address2" type="text" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" placeholder="Address2"  cols="38">'.$user_address_data['address2'].'</textarea>
                        </p>
                       </div>
                    </div>
                 </div>
                 <div class="form-group">
                    <div class="row">
                       <div class="col-md-6">
                        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                          <label>Pincode:  <span class="asterisk-mark">*</span></label>
                          <input type="text" name="edit_address_form_pincode" id="edit_address_form_pincode" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" onkeypress = "return event.charCode >= 48 && event.charCode <= 57"  maxlength="6" minlength="6"   data-parsley-type="integer" data-parsley-required="true" value="'.$user_address_data['pincode'].'">
                        </p>
                       </div>
                       <div class="col-md-6">
                        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                          <label>Country:  <span class="asterisk-mark">*</span></label>
                          <select name="edit_address_form_country_id" id="edit_address_form_country_id" data-placeholder="Select Country" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" data-parsley-required="true" onchange="get_state_selection(this.value,\'edit_address_form\')">
                             <option value="">Select Country</option>
                             ';
                             if(count($country_data_array)>0)
                             {
                             foreach ($country_data_array as $country_data)
                             {  
                              if($country_id == $country_data['id'])
                              {
                                $selected = 'selected';
                              }
                              else
                              {
                                $selected = '';
                              }
                             $html_message.=
                             '
                             <option '.$selected.' value="'.$country_data['id'].'">'.$country_data['country_name'].'</option>
                             ';
                             } 
                             } 
                             $html_message.=' 
                          </select>
                        </p>
                       </div>
                    </div>
                 </div>
                 <div class="form-group">
                    <div class="row">
                      <div id="edit_address_form_state_selection_div" class="col-md-6">
                        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                         <label>State:  <span class="asterisk-mark">*</span></label>
                          <select name="edit_address_form_state_id" id="edit_address_form_state_id" data-placeholder="Select State" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" data-parsley-required="true" onchange="get_city_selection(this.value,\'edit_address_form\')">
                             <option value="">Select State</option>
                             ';
                             if(count($all_state_data_array)>0)
                             {
                             foreach ($all_state_data_array as $state_data)
                             {  
                             if($state_id == $state_data['id'])
                              {
                                $selected = 'selected';
                              }
                              else
                              {
                                $selected = '';
                              }
                             $html_message.=
                             '
                             <option '.$selected.' value="'.$state_data['id'].'">'.$state_data['state_name'].'</option>
                             ';
                             } 
                             } 
                             $html_message.=' 
                          </select>
                        </p>
                      </div>
                      <div id="edit_address_form_city_selection_div" class="col-md-6">
                        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                         <label>City:  <span class="asterisk-mark">*</span></label>
                          <select name="edit_address_form_city_id" id="edit_address_form_city_id" data-placeholder="Select City" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" data-parsley-required="true">
                             <option value="">Select City</option>
                             ';
                             if(count($all_city_data_array)>0)
                             {
                             foreach ($all_city_data_array as $city_data)
                             {  
                             if($city_id == $city_data['id'])
                              {
                                $selected = 'selected';
                              }
                              else
                              {
                                $selected = '';
                              }
                             $html_message.=
                             '
                             <option '.$selected.' value="'.$city_data['id'].'">'.$city_data['city_name'].'</option>
                             ';
                             } 
                             } 
                             $html_message.=' 
                          </select>
                        </p>
                      </div>
                    </div>
                </div>
                <div class="form-group row">
                   <div class="col-sm-4">
                      <div class="customCheckbox clearfix">
                        <input name="is_billing_default" id="is_billing_default" value="1" type="checkbox" ';
                        if($user_address_data['is_billing_default'] == '1')
                        {
                         $checked = 'checked';
                        } 
                        else
                        {
                         $checked = '';
                        }
                        $html_message.=' '.$checked.'>
                        <label for="is_billing_default">Billing Address</label>
                      </div>      
                   </div>
                   <div class="col-sm-4">
                      <div class="customCheckbox clearfix">
                        <input name="is_shipping_default" id="is_shipping_default" value="1" type="checkbox" ';
                        if($user_address_data['is_shipping_default'] == '1')
                        {
                         $checked = 'checked';
                        } 
                        else
                        {
                         $checked = '';
                        }
                        $html_message.=' '.$checked.'>
                        <label for="is_shipping_default">Shipping Address</label>
                      </div> 
                   </div>
                </div>
              </div>
              <div class="modal-footer">
                 <button type="submit" class="btn btn-theme">Submit</button>
                 <button type="button" class="btn btn-theme" onclick="closeModel();" data-dismiss="modal">Close</button>
              </div>
           </form>
        </div>
     </div>
    </div>
    ';
    }
  }
  
  $return["html_message"] = $html_message;
  $return["status"] = "success";
  echo json_encode($return);       
}
else 
{
  $return["html_message"] = 'Some Error Occured! Please try again.';
  $return["status"] = "error";
  echo json_encode($return);
}
?>