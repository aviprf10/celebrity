<?php
function send_email($email_array)
{

   $cancel_order_date='';
   $cancel_order_reason='';
   $company_title = 'Welcome::Celebrity';
   $from_email = 'demo@seoprism.in';
   $contact_mobile = "+91 1234567890";
   $selected_currency_text = 'Rs.';
   $base_url='http://localhost/celebrity/';
   $email_images=$base_url.'email_images/';

   $total_mail = 1;
   $send_email = 0; 
   $user_name = $email_array['user_name'];
   $receiver_email= $email_array['email'];
   $email_type= $email_array['email_type'];
   /*$social_media_link_array = $email_array['social_media_link'];
   	if(count($social_media_link_array)>0)
	{
   		foreach ($social_media_link_array as $social_media_link) 
		{
			$facebook_link = $social_media_link['facebook_link'];
			$google_plus_link = $social_media_link['google_plus_link'];
			$instagram_link = $social_media_link['instagram_link'];
			$pintrest_link = $social_media_link['pinterest_link'];
			$youtube_link = $social_media_link['youtube_link'];
			$twitter_link = $social_media_link['twitter_link'];
		}
	}*/
	$facebook_link = '#';
   	$twitter_link = '#';
   	$pintrest_link = '#';
   	$instagram_link = '#';
   	$linkdin_link = '#';
	
	
    $mail = new PHPMailer\PHPMailer\PHPMailer();
	//$mail->SMTPDebug = 3;
	$mail->Host = 'smtp.hostinger.com';
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->Username = 'demo@seoprism.in';
	$mail->Password = 'Rajat123@@';
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;
	$mail->CharSet = 'UTF-8';
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);
	$mail->setFrom($from_email, $company_title);
	$mail->addAddress($receiver_email, $user_name);
	$mail->addReplyTo($from_email, $company_title);
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');
	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);  
	
                
	$email_body = '';
	$send_email = 0;

	$email_header = 
	'<!DOCTYPE html>
		<html lang="en">
		   	<head>
		      <meta charset="utf-8"/>
		      <title></title>
		   	</head>
		   	<body>
				<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperTable">
				   <tbody>
				      <tr>
				         <td align="center" valign="top">
				            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="logoTable" style="">
				               <tbody>
				                  <tr>
				                     <td align="center" valign="middle" style="padding-top:40px;padding-bottom:40px"><a href="#" style="text-decoration:none"><img alt="" border="0"  src="'.$email_images.'logo.png" style="height:auto;display:block" width="180"></a></td>
				                  </tr>
				               </tbody>
				            </table>
				         </td>
				      </tr>
				   </tbody>
				</table>';
	 
				$email_body = '';
				$email_footer = 
						'<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperTable" >
							<tbody>
							   <tr>
							      <td align="center" valign="top" class="footerCell">
							         <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
							            <tbody>
							               <tr>
							                  <td height="20" style="font-size:1px;line-height:1px;">&nbsp;</td>
							               </tr>
							            </tbody>
							         </table>
							      </td>
							   </tr>
							   <tr>
							      <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
							   </tr>
							</tbody>
						</table>
				</body>
			</html>';


	if($email_type == 1) // send otp
	{
		$send_email = 1;
		$otp_number = $email_array['generate_otp'];
		//$subject = "Password Reset Link";
		$mail->Subject = "Verification OTP Number";
		$email_body .= 
		'<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
		<tbody>
		   <tr>
		      <td align="center" valign="top" style="padding-right:10px;padding-left:10px" id="bodyCell">
		         <!--[if (gte mso 9)|(IE)]>
		         <table border=0 cellpadding=0 cellspacing=0 width=600 style=width:600px align=center>
		            <tr>
		               <td align=center valign=top>
		                  <![endif]-->
		                  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperTable" style="max-width:600px">
		                     <tbody>
                        <tr>
                           <td align="center" valign="top">
                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="oneColumn" style="background-color: rgb(255, 255, 255); box-shadow: rgb(216, 216, 216) 0px 0px 10px;">
                                 <tbody>
                                    <tr>
                                       <td style="background-color:#e9570e;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="imgHero" style="padding-bottom: 40px;"><a href="#" style="text-decoration:none"><img alt="" border="0"  src="'.$email_images.'account-password-reset.png" style="margin-top: 20px;width:auto;max-width:600px;height:auto;display:block" width="600"></a></td>
                                    </tr>
                                     <tr>
                                    
                                       <td align="center" valign="top" class="title" style="padding-bottom:5px;padding-left:20px;padding-right:20px">
                                          <h2 class="bigTitle"  style="color:#313131;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:26px;font-weight:600;font-style:normal;letter-spacing:normal;line-height:34px;text-align:center;padding:0;margin:0">OTP</h2>
                                       </td
                                    <tr>
                                       <td align="center" valign="top" class="description" style="padding-bottom:40px;padding-left:20px;padding-right:20px">
                                          <p class="midText"  style="color:#919191;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:22px;text-align:center;padding:0;margin:0">Your otp number is '.$otp_number.'
		                               </td>
                                    </tr>
                                    <tr>
                                       <td style="font-size:1px;line-height:1px" height="10">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
                                 <tbody>
                                    <tr>
                                       <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <!--[if (gte mso 9)|(IE)]><![endif]-->
               </td>
            </tr>
            </tbody>
         </table>';
    }
	else if($email_type == 2) // Registeration Done Email
	{
		$send_email = 1;
		$login_email = $email_array['email'];
		$user_name = $email_array['user_name'];
		$unique_key = $email_array['unique_key'];

		$mail->Subject = "Welcome To ".$company_title."";
		$email_body .= 
		'<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
		<tbody>
		   <tr>
		      <td align="center" valign="top" style="padding-right:10px;padding-left:10px" id="bodyCell">
		         <!--[if (gte mso 9)|(IE)]>
		         <table border=0 cellpadding=0 cellspacing=0 width=600 style=width:600px align=center>
		            <tr>
		               <td align=center valign=top>
		                  <![endif]-->
		                  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperTable" style="max-width:600px">
		                     <tbody>
		                        <tr>
		                           <td align="center" valign="top">
		                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="oneColumn" style="background-color: rgb(255, 255, 255); box-shadow: rgb(216, 216, 216) 0px 0px 10px;">
		                                 <tbody>
		                                    <tr>
		                                       <td style="background-color:#08c;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
		                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="imgHero" style="padding-bottom: 40px;"><a href="#" style="text-decoration:none"><img alt="" border="0" src="'.$email_images.'user-welcome.png" style="margin-top: 20px;width:auto;max-width:600px;height:auto;display:block" width="600"></a></td>
                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="title" style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;">
                                          <h2 class="bigTitle" style="color:#313131;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:26px;font-weight:600;font-style:normal;letter-spacing:normal;line-height:34px;text-align:center;padding:0;margin:0">Welcome!</h2>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="subTitle" style="padding-bottom: 20px; padding-left: 20px; padding-right: 20px;">
                                          <h4 class="midTitle"  style="color:#919191;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:26px;text-align:center;padding:0;margin:0">You have successfully registration on '.$company_title.'</h4>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="description" style="padding-bottom:40px;padding-left:20px;padding-right:20px">
                                          <p class="midText"  style="color:#919191;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:22px;text-align:center;padding:0;margin:0">Thank you for joining with '.$company_title.', We have more than a 6 million Readers Each Month, keeping you up to date with what is going on in the world.</p>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="btnCard" style="padding-bottom:40px;padding-left:20px;padding-right:20px">
                                          <table border="0" cellpadding="0" cellspacing="0" align="center">
                                             <tbody>
                                                <tr>
                                                   <td align="center" class="postButton" style="background-color:#08c;border-radius:2px"><a href="'.$base_url.'" style="color:#fff !important;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:12px;font-weight:600;letter-spacing:1px;line-height:20px;text-transform:uppercase;text-decoration:none;display:block;padding-top:10px;padding-bottom:10px;padding-left:25px;padding-right:25px;" target="_blank">Explore Now</a></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td style="font-size:1px;line-height:1px" height="10">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
                                 <tbody>
                                    <tr>
                                       <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <!--[if (gte mso 9)|(IE)]><![endif]-->
               </td>
            </tr>
            </tbody>
         </table>';
	}
	else if($email_type == 3) // Order Done Mail
	{
		$send_email = 1;
		$buyer_name = $email_array['buyer_name'];
		$shipper_name = $email_array['shipper_name'];
		$order_id = $email_array['order_id'];
		$order_date_time = $email_array['order_date_time'];
		$order_date_time = date('d-M H:i:s',strtotime($order_date_time));
		$date_of_delevery = $email_array['date_of_delevery'];
		$user_message = $email_array['user_message'];
		$request_for = $email_array['request_for'];
		$price = $email_array['price'];

		$mail->Subject = "New Order";
		$email_body .= 
		'<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
		<tbody>
		   <tr>
		      <td align="center" valign="top" style="padding-right:10px;padding-left:10px" id="bodyCell">
		         <!--[if (gte mso 9)|(IE)]>
		         <table border=0 cellpadding=0 cellspacing=0 width=600 style=width:600px align=center>
		            <tr>
		               <td align=center valign=top>
		                  <![endif]-->
		                  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperTable" style="max-width:600px">
		                     <tbody>
		                        <tr>
		                           <td align="center" valign="top">
		                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="oneColumn" style="background-color: rgb(255, 255, 255); box-shadow: rgb(216, 216, 216) 0px 0px 10px;">
		                                 <tbody>
		                                    <tr>
		                                       <td style="background-color:#08c;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
		                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="imgHero" style="padding-bottom: 40px;"><a href="#" style="text-decoration:none"><img alt="" border="0" src="'.$email_images.'user-welcome.png" style="margin-top: 20px;width:auto;max-width:600px;height:auto;display:block" width="600"></a></td>
                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="title" style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;">
                                          <h2 class="bigTitle" style="color:#313131;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:26px;font-weight:600;font-style:normal;letter-spacing:normal;line-height:34px;text-align:center;padding:0;margin:0">Welcome!</h2>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="subTitle" style="padding-bottom: 20px; padding-left: 20px; padding-right: 20px;">
                                          <h4 class="midTitle"  style="color:#919191;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:26px;text-align:center;padding:0;margin:0">You have successfully registration on '.$company_title.'</h4>
                                       </td>
                                    </tr>
									<tr>
		                           		<td cellpadding="10" align="left" class="editable" style="padding:10px;color: rgb(35, 35, 35); font-size: 16px; font-family: Raleway, sans-serif, Arial; font-weight: bold; line-height: 1; outline: none; outline-offset: 2px;" data-selector="td.editable" contenteditable="false">Hi '.$buyer_name.'!</td>
			                        </tr>
									<tr>
			                           <td cellpadding="10" align="left" class="editable" style="padding:10px;color: rgb(35, 35, 35); font-size: 14px; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.3; outline: none; outline-offset: 2px;" data-selector="td.editable" contenteditable="false"> 
			                           		Your order has been successfully placed and we will ship it soon. You will receive a separate email once your order ships.
			                           		
			                           </td>
			                        </tr>
									<tr>
										<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: 600; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false">Order No. : '.$order_id.' </td>
									</tr>
									<tr>
										<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Order Date :</b>'.$order_date_time.'</td>
									</tr>
									<tr>
										<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Order Delevery Date :</b>'.$date_of_delevery.'</td>
									</tr>
									<tr>
										<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Order Message :</b>'.$user_message.'</td>
									</tr>
									<tr>
										<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Order Type :</b>'.$request_for.'</td>
									</tr>
									<tr>
										<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Order Price :</b>'.$selected_currency_icon. $price.'</td>
									</tr>
                                    <tr>
                                       <td align="center" valign="top" class="btnCard" style="padding-bottom:40px;padding-left:20px;padding-right:20px">
                                          <table border="0" cellpadding="0" cellspacing="0" align="center">
                                             <tbody>
                                                <tr>
                                                   <td align="center" class="postButton" style="background-color:#08c;border-radius:2px"></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td style="font-size:1px;line-height:1px" height="10">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
                                 <tbody>
                                    <tr>
                                       <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <!--[if (gte mso 9)|(IE)]><![endif]-->
               </td>
            </tr>
            </tbody>
         </table>';
	}
	else if($email_type == 4) // Order Done Mail
	{
		$send_email = 1;
		$buyer_name = $email_array['buyer_name'];
		$user_name = $email_array['user_name'];
		$shipper_name = $email_array['shipper_name'];
		$order_id = $email_array['order_id'];
		$order_date_time = $email_array['order_date_time'];
		$order_date_time = date('d-M H:i:s',strtotime($order_date_time));
		$date_of_delevery = $email_array['date_of_delevery'];
		$user_message = $email_array['user_message'];
		$request_for = $email_array['request_for'];
		$price = $email_array['price'];
		$instagramid = $email_array['instagramid'];

		$mail->Subject = "New Order Request";
		$email_body .= 
		'<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
		<tbody>
		   <tr>
		      <td align="center" valign="top" style="padding-right:10px;padding-left:10px" id="bodyCell">
		         <!--[if (gte mso 9)|(IE)]>
		         <table border=0 cellpadding=0 cellspacing=0 width=600 style=width:600px align=center>
		            <tr>
		               <td align=center valign=top>
		                  <![endif]-->
		                  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperTable" style="max-width:600px">
		                     <tbody>
		                        <tr>
		                           <td align="center" valign="top">
		                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="oneColumn" style="background-color: rgb(255, 255, 255); box-shadow: rgb(216, 216, 216) 0px 0px 10px;">
		                                 <tbody>
		                                    <tr>
		                                       <td style="background-color:#08c;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
		                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="imgHero" style="padding-bottom: 40px;"><a href="#" style="text-decoration:none"><img alt="" border="0" src="'.$email_images.'user-welcome.png" style="margin-top: 20px;width:auto;max-width:600px;height:auto;display:block" width="600"></a></td>
                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="title" style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;">
                                          <h2 class="bigTitle" style="color:#313131;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:26px;font-weight:600;font-style:normal;letter-spacing:normal;line-height:34px;text-align:center;padding:0;margin:0">Welcome!</h2>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="subTitle" style="padding-bottom: 20px; padding-left: 20px; padding-right: 20px;">
                                          <h4 class="midTitle"  style="color:#919191;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:18px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:26px;text-align:center;padding:0;margin:0">You have successfully registration on '.$company_title.'</h4>
                                       </td>
                                    </tr>
									<tr>
		                           		<td cellpadding="10" align="left" class="editable" style="padding:10px;color: rgb(35, 35, 35); font-size: 16px; font-family: Raleway, sans-serif, Arial; font-weight: bold; line-height: 1; outline: none; outline-offset: 2px;" data-selector="td.editable" contenteditable="false">Hi '.$user_name.'!</td>
			                        </tr>
									<tr>
			                           <td cellpadding="10" align="left" class="editable" style="padding:10px;color: rgb(35, 35, 35); font-size: 14px; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.3; outline: none; outline-offset: 2px;" data-selector="td.editable" contenteditable="false"> 
			                           		User place have a new order request please check. 
			                           		
			                           </td>
			                        </tr>
									<tr>
										<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: 600; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false">Order No. : '.$order_id.' </td>
									</tr>
									<tr>
										<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Order Date :</b>'.$order_date_time.'</td>
									</tr>
									<tr>
										<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Order Delevery Date :</b>'.$date_of_delevery.'</td>
									</tr>
									<tr>
		                           		<td cellpadding="10" align="left" class="editable" style="padding:10px;color: rgb(35, 35, 35); font-size: 16px; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1; outline: none; outline-offset: 2px;" data-selector="td.editable" contenteditable="false"><b>Buyer Name :</b>'.$buyer_name.'!</td>
			                        </tr>
									<tr>
		                           		<td cellpadding="10" align="left" class="editable" style="padding:10px;color: rgb(35, 35, 35); font-size: 16px; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1; outline: none; outline-offset: 2px;" data-selector="td.editable" contenteditable="false"><b>Buyer Instagram ID :</b>'.$instagramid.'!</td>
			                        </tr>
									<tr>
										<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Order Message :</b>'.$user_message.'</td>
									</tr>
									<tr>
										<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Order Type :</b>'.$request_for.'</td>
									</tr>
									<tr>
										<td class="editable" style="font-size: 14px; color: rgb(35, 35, 35); text-align: left; font-family: Raleway, sans-serif, Arial; font-weight: normal; line-height: 1.4; outline: none; outline-offset: 2px; padding-left: 14px;" data-selector="td.editable" contenteditable="false"><b>Order Price :</b> ₹'.$price.'</td>
									</tr>
                                    <tr>
                                       <td align="center" valign="top" class="btnCard" style="padding-bottom:40px;padding-left:20px;padding-right:20px">
                                          <table border="0" cellpadding="0" cellspacing="0" align="center">
                                             <tbody>
                                                <tr>
                                                   <td align="center" class="postButton" style="background-color:#08c;border-radius:2px"></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td style="font-size:1px;line-height:1px" height="10">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
                                 <tbody>
                                    <tr>
                                       <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <!--[if (gte mso 9)|(IE)]><![endif]-->
               </td>
            </tr>
            </tbody>
         </table>';
	}
	if($email_type == 5) // send otp
	{
		$send_email = 1;
		$otp_number = $email_array['generate_otp'];
		//$subject = "Password Reset Link";
		$mail->Subject = "Verification OTP Number";
		$email_body .= 
		'<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
		<tbody>
		   <tr>
		      <td align="center" valign="top" style="padding-right:10px;padding-left:10px" id="bodyCell">
		         <!--[if (gte mso 9)|(IE)]>
		         <table border=0 cellpadding=0 cellspacing=0 width=600 style=width:600px align=center>
		            <tr>
		               <td align=center valign=top>
		                  <![endif]-->
		                  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperTable" style="max-width:600px">
		                     <tbody>
                        <tr>
                           <td align="center" valign="top">
                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="oneColumn" style="background-color: rgb(255, 255, 255); box-shadow: rgb(216, 216, 216) 0px 0px 10px;">
                                 <tbody>
                                    <tr>
                                       <td style="background-color:#e9570e;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                       <td align="center" valign="top" class="imgHero" style="padding-bottom: 40px;"><a href="#" style="text-decoration:none"><img alt="" border="0"  src="'.$email_images.'account-password-reset.png" style="margin-top: 20px;width:auto;max-width:600px;height:auto;display:block" width="600"></a></td>
                                    </tr>
                                     <tr>
                                    
                                       <td align="center" valign="top" class="title" style="padding-bottom:5px;padding-left:20px;padding-right:20px">
                                          <h2 class="bigTitle"  style="color:#313131;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:26px;font-weight:600;font-style:normal;letter-spacing:normal;line-height:34px;text-align:center;padding:0;margin:0">OTP</h2>
                                       </td
                                    <tr>
                                       <td align="center" valign="top" class="description" style="padding-bottom:40px;padding-left:20px;padding-right:20px">
                                          <p class="midText"  style="color:#919191;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:22px;text-align:center;padding:0;margin:0">Your otp number is '.$otp_number.'
		                               </td>
                                    </tr>
                                    <tr>
                                       <td style="font-size:1px;line-height:1px" height="10">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                              <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
                                 <tbody>
                                    <tr>
                                       <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <!--[if (gte mso 9)|(IE)]><![endif]-->
               </td>
            </tr>
            </tbody>
         </table>';
    }

	if($send_email == 1)
	{
		//$mail->Body =  $email_body;
		$mail->Body    =  $email_header.$email_body.$email_footer;
		
   		if($mail->send()) 
   		{
   			return 1;
   			exit();
   		} 
   		else 
   		{
   			return 0;
   			exit();
   		}
	}
	return 0;
	exit();
   
}
?>