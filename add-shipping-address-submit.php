<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if($user == 1)
{
	$address_html_message='';
	$select_address_dropdown_html='';
	if(isset($_POST))
	{
    $first_name=Secure1($db_mysqli,$_POST['first_name']);
    $last_name=Secure1($db_mysqli,$_POST['last_name']);
    $company=Secure1($db_mysqli,$_POST['company']);
    $mobile=Secure1($db_mysqli,$_POST['mobile']);
    $address1=Secure1($db_mysqli,$_POST['address_form_address1']);
    $address2=Secure1($db_mysqli,$_POST['address_form_address2']);
    $pincode=Secure1($db_mysqli,$_POST['address_form_pincode']);
    $country_id=Secure1($db_mysqli,$_POST['address_form_country_id']);
    $state_id=Secure1($db_mysqli,$_POST['address_form_state_id']);
    $city_id=Secure1($db_mysqli,$_POST['address_form_city_id']);
    $is_billing_default=Secure1($db_mysqli,$_POST['is_billing_default']);
    $is_shipping_default=Secure1($db_mysqli,$_POST['is_shipping_default']);
    $status = '1';
    $insert_user_address_query = "INSERT INTO user_address (user_id, first_name, last_name, company, mobile, address1, address2, pincode, country_id, state_id, city_id,is_billing_default,is_shipping_default,status, is_deleted) VALUES ('$loggedin_user_id', '$first_name', '$last_name','$company', '$mobile','$address1', '$address2', '$pincode', '$country_id', '$state_id', '$city_id','$is_billing_default', '$is_shipping_default', '$status', '0');";
    $return_user_address_data = mysqli_query($db_mysqli,$insert_user_address_query);

    if($return_user_address_data == 1)    
    {     
			//$user_address_insert_id=$return_user_address_data['insert_id'];
			$user_address_insert_id=mysqli_insert_id($db_mysqli);
			$user_address_data_array = array();
            $get_user_address_data = "select  uad.*,c.id as c_id,c.city_name,s.id as s_id,s.state_name,cy.id as cy_id,cy.country_name FROM user_address uad LEFT JOIN cities c on uad.city_id=c.id LEFT JOIN states s on uad.state_id=s.id LEFT JOIN country cy on uad.country_id=cy.id WHERE uad.user_id = '$loggedin_user_id'  AND uad.status = '1'  AND uad.is_deleted = '0'";
            $result_user_address_data = mysqli_query($db_mysqli,$get_user_address_data);
            while ($row_user_address_data = mysqli_fetch_assoc($result_user_address_data))
            {
            $user_address_data_array[] = $row_user_address_data;
            }

			if(count($user_address_data_array)>0)
			{

			       $select_address_dropdown_html.=
						'<div class="row">
                           <div class="col-sm-12">
                            <label>Select Address:<span class="asterisk-mark">*</span></label>
                            <select name="address_id" id="address_id" data-placeholder="Select Address" class="woocommerce-Input woocommerce-Input--text input-text line-height-1" data-parsley-required="true" onchange="select_shipping_address(this.value)">
                                <option value="">Select Address</option>
                                <option value="00">Create New Address</option>';

                                   if(count($user_address_data_array)>0)
                                   {  
                                      foreach ($user_address_data_array as $user_address_data)
                                      {  


                          $select_address_dropdown_html.='
           							<option value="'.$user_address_data['id'].'"'; 
           							if($user_address_data['id'] == $user_address_insert_id)
                                      	{ 
                                      		$select_address_dropdown_html.='selected';
                                      	} 
                       	$select_address_dropdown_html.=
                       	'>'.$user_address_data['address1'].' - '.$user_address_data['pincode'].'</option>';
                                                  }
                                               }
            				    $select_address_dropdown_html.='</select>
                        </div>
                    </div><div style="clear:both"></div><br>';

               foreach ($user_address_data_array as $user_address_data) 
               {
               	if($user_address_data['id']==$user_address_insert_id)
               	{
			            $address_html_message.=' <br/>
                  <div class="woocommerce">
                     <div class="step-title"><h3 class="one_page_heading m-0">Shipping Address<a onclick="modal_edit_address('.$user_address_data['id'].')"><i
                              class="pull-right fa fa-pencil" style="color:#ed6663;"></i></a></h3>
                           </div><br />
                  <div  id="address_'.$user_address_data['id'].'" >
                  
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
			}
			$return["address_html_message"]=$address_html_message;
			$return["select_address_dropdown_html"]=$select_address_dropdown_html;
			$return["html_message"] = 'Address added successfully.';
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