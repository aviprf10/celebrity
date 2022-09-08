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

  $selected_address_id = Secure1($db_mysqli,$_POST['id']);
  $html_message='';
  if($selected_address_id!=00)
  {
    $check_user_address_data_array = array();
    $get_user_address_data = "select  uad.*,c.id as c_id,c.city_name,s.id as s_id,s.state_name,cy.id as cy_id,cy.country_name FROM user_address uad LEFT JOIN cities c on uad.city_id=c.id LEFT JOIN states s on uad.state_id=s.id LEFT JOIN country cy on uad.country_id=cy.id WHERE  uad.id = '$selected_address_id'  AND uad.user_id = '$loggedin_user_id'  AND uad.status = '1'  AND uad.is_deleted = '0'";
    $result_user_address_data = mysqli_query($db_mysqli,$get_user_address_data);
    while ($row_user_address_data = mysqli_fetch_assoc($result_user_address_data))
    {
      $check_user_address_data_array[] = $row_user_address_data;
    } 
    if(count($check_user_address_data_array)>0)
    {
      $user_address_data=$check_user_address_data_array[0];
      $html_message.='<br/>
      <div class="woocommerce">
         <div class="step-title"><h3 class="one_page_heading m-0">Shipping Address<a onclick="modal_edit_address('.$user_address_data['id'].')"><i
                  class="an an-edit-l" style="color:#ff0000; float: right;"></i></a></h3>
               </div><br/>
      <div  id="address_'.$user_address_data['id'].'">
        
        <div class="table-responsive">
            <table class="table" id="address_table">
            <tbody>
             <tr>
                <td><b>First Name:</b></td>
                <td id="checkout_order_sub_total">'.$user_address_data['first_name'].'</td>
                <input type="hidden" name="first_name" id="first_name" value="'.$user_address_data['first_name'].'">
            </tr>
            <tr>
                <td><b>Last Name:</b></td>
                <td id="checkout_order_saving_total">'.$user_address_data['last_name'].'</td>
                <input type="hidden" name="last_name" id="last_name" value="'.$user_address_data['last_name'].'">
            </tr>
             <tr>
                <td><b>company:</b></td>
                <td id="checkout_order_sub_total">'.$user_address_data['company'].'</td>
                <input type="hidden" name="company" id="company" value="'.$user_address_data['company'].'">
            </tr>
            <tr>
                <td><b>Mobile:</b></td>
                <td id="checkout_order_saving_total">'.$user_address_data['mobile'].'</td>
                <input type="hidden" name="mobile" id="mobile" value="'.$user_address_data['mobile'].'">
            </tr>
            <tr>
                <td><b>Address1:</b></td>
                <td id="checkout_order_sub_total">'.$user_address_data['address1'].'</td>
                <input type="hidden" name="address1" id="address1" value="'.$user_address_data['address1'].'">
            </tr>
            <tr>
                <td><b>Address2:</b></td>
                <td id="checkout_order_saving_total">'.$user_address_data['address2'].'</td>
            </tr>
            <tr>
                <td><b>Pincode:</b></td>
                <td id="checkout_discount_total">'.$user_address_data['pincode'].'</td>
                <input type="hidden" name="pincode" id="pincode" value="'.$user_address_data['pincode'].'">
            </tr>
            <tr>
                <td><b>City:</b></td>
                <td id="checkout_qty_discount_total">'.$user_address_data['city_name'].'</td>
                <input type="hidden" name="city_name" id="city_name" value="'.$user_address_data['city_name'].'">
            </tr>
            <tr>
                <td><b> State:</b></td>
                <td id="checkout_order_shipping">'.$user_address_data['state_name'].'</td>
                <input type="hidden" name="state_name" id="state_name" value="'.$user_address_data['state_name'].'">
            </tr>
            <tr>
                <td><b>Country:</b></td>
                <td id="checkout_final_order_total">'.$user_address_data['country_name'].'</td>
                <input type="hidden" name="country_name" id="country_name" value="'.$user_address_data['country_name'].'">
            </tr>
            </tbody>
        </table>
      </div>
      </div>';
    }
  }
  else
  {
    $html_message.='
    <div class="modal fade" id="shipping_address_model" role="dialog">
     <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" onclick="closeModel();" data-dismiss="modal" style="float:right;">&times;</button>
              <h4 class="modal-title">Create New Address</h4>
           </div>
           <div id="address_form_error_msg"></div>
           <form method="POST" id="address_form" role="form" data-parsley-validate>
              <div class="modal-body">
                 <div class="form-group row">
                   <div class="col-sm-6">
                      <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                        <label for="username">First Name <span class="required">*</span></label>
                        <input type="text" name="first_name"  id="first_name" placeholder="First Name" data-parsley-required="true"  class="woocommerce-Input woocommerce-Input--text input-text line-height-1" />
                      </p>
                   </div>
                   <div class="col-sm-6">
                      <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                        <label class="control-label" for="last_name">Last name <span class="asterisk-mark">*</span></label>
                        <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" data-parsley-required="true" />
                      </p>
                   </div>
                 </div>
                 <div class="form-group row">
                  <div class="col-sm-6">
                      <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                        <label class="control-label" for="mobile">Mobile <span class="asterisk-mark">*</span></label>
                        <input type="text" name="mobile" id="mobile" placeholder="Mobile" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" size="35" maxlength="10" minlength="10" data-parsley-required="true" />
                      </p>
                   </div>
                   <div class="col-md-6">
                     <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                        <label>Address1:  <span class="asterisk-mark">*</span></label>
                        <textarea  rows="2" name="address_form_address1" id="address_form_address1" type="text" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" placeholder="Address1" data-parsley-required="true" cols="38"></textarea>
                     </p>
                     </div>
                 </div>
                 <div class="form-group">
                    <div class="row">
                       <div class="col-md-6">
                        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                          <label>Address2: </label>
                          <textarea  rows="2" name="address_form_address2" id="address_form_address2" type="text" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" placeholder="Address2"  cols="38"></textarea>
                        </p>
                       </div>
                       <div class="col-md-6">
                          <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                          <label>Pincode:  <span class="asterisk-mark">*</span></label>
                          <input type="text" name="address_form_pincode" id="address_form_pincode" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" onkeypress = "return event.charCode >= 48 && event.charCode <= 57"  maxlength="6" minlength="6"   data-parsley-type="integer" data-parsley-required="true">
                          </p>
                       </div>
                    </div>
                 </div>
                 <div class="form-group">
                    <div class="row">
                       <div class="col-md-6">
                          <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                            <label>Country:  <span class="asterisk-mark">*</span></label>
                            <select name="address_form_country_id" id="address_form_country_id" data-placeholder="Select Country" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" data-parsley-required="true" onchange="get_state_selection(this.value,\'address_form\')">
                               <option value="">Select Country</option>
                               ';
                               if(count($country_data_array)>0)
                               {
                               foreach ($country_data_array as $country_data)
                               {  
                               $html_message.=
                               '
                               <option value="'.$country_data['id'].'">'.$country_data['country_name'].'</option>
                               ';
                               } 
                               } 
                               $html_message.=' 
                            </select>
                          </p>
                       </div>
                       <div id="address_form_state_selection_div" class="col-md-6"></div>
                    </div>
                 </div>
                 <div class="form-group">
                    <div class="row">
                        
                        <div id="address_form_city_selection_div" class="col-md-6"></div>
                    </div>
                </div>
                <div class="row">
                   <div class="col-sm-4">
                        <div class="customCheckbox clearfix">
                           <input name="is_billing_default" id="is_billing_default" value="1" type="hidden">
                        </div>         
                   </div>
                   <div class="col-sm-4">
                        <div class="customCheckbox clearfix">
                           <input  name="is_shipping_default" id="is_shipping_default" value="1" type="hidden">
                           <input type="hidden" name="company" id="company" value="aa"/>
                        </div>          
                   </div>
                </div>
              </div>
              <div class="modal-footer"><br><br>
                 <button type="submit" class="btn btn-theme">Submit</button>
                 <button type="button" class="btn btn-theme" onclick="closeModel();" data-dismiss="modal">Close</button>
              </div>
           </form>
        </div>
     </div>
    </div>
    ';
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