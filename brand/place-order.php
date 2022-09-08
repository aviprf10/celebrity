<?php
include "common/config.php";
include "common/check_login.php";
include 'common/common_code.php';
include "common/cart.php";
if ($brand == 1)
{
    if (isset($_POST))
    {
        $address_id = 0;
        $count = 0;
        if (count($cart_data_array1) > 0)
        {
            if ($_POST['address_id'] > 0)
            {
                $address_id = Secure1($db_mysqli, $_POST['address_id']);
                $user_address_data_array = array();
                $get_user_address_query = "select * from user_address where id='$address_id' and user_id='$loggedin_user_id' and status=1 and is_deleted=0";
                $result_user_address_data = mysqli_query($db_mysqli, $get_user_address_query);
                while ($row_user_address_data = mysqli_fetch_assoc($result_user_address_data))
                {
                    $user_address_data_array[] = $row_user_address_data;
                }

                /*$pincode_value = $user_address_data_array[0]['pincode'];
                $pincode_data_array = array();
                $get_pincode_query = "select pincode from pincode where pincode='$pincode_value' and status='1' and is_deleted='0'";
                $result_pincode_data = mysqli_query($db_mysqli,$get_pincode_query);

                while ($row_pincode_data = mysqli_fetch_assoc($result_pincode_data))
                {
                    $pincode_data_array[] = $row_pincode_data;
                }
                if (count($pincode_data_array) > 0)
                {*/
                    if (count($user_address_data_array) > 0)
                    {
                        $update_user_cart_query = "update user_cart set address_id='$address_id' where user_id='$loggedin_user_id'";
                        $return_update_cart_data = mysqli_query($db_mysqli, $update_user_cart_query);

                        if ($return_update_cart_data)
                        {
                            /*$pincode=$_POST['pincode'];
                            if($pincode=='422002')
                            {
                               $pincode_is_valid = 1;
                            }
                            else
                            {
                               include "pincode-validation.php";
                               $pincode_response_array = delhivery_pincode_api($pincode);
                               $pincode_is_valid = $pincode_response_array['pincode_is_valid'];
                               $Cod_Availabe = $pincode_response_array['Cod_Availabe'];
                            }*/


                            /*if(($_POST['mod_of_payment'] == '2' && $Cod_Availabe == 'N') || $pincode_is_valid == 0)
                            {
                               $pincode_response_array = array();
                               $pincode_response_array = bluedart_pincode_api($pincode);
                               $pincode_is_valid = $pincode_response_array['pincode_is_valid'];
                               $Cod_Availabe = $pincode_response_array['Cod_Availabe'];
                            }*/
                            $finalorderamount = $final_order_total - $local_shipping;

                            $pincode_is_valid = '1';
                            $Cod_Availabe = 'Y';
                            /*echo $pincode_is_valid;
                            echo $Cod_Availabe;*/

                            if ($_POST['mod_of_payment'] == '2')
                            {
                                /*if ($pincode_is_valid == '1' && $Cod_Availabe == 'Y' && $finalorderamount > '200')
                                {*/
                                    ?>
                                    <form id="payment_forms" method="POST" action="<?php echo $base_url; ?>checkout">
                                        <input type="hidden" id="mod_of_payment" name="mod_of_payment" value="2">
                                        <input type="hidden" id="address_id" name="address_id" value="<?php echo $address_id; ?>">
                                        <input type="submit" style="position: absolute; left: -9999px"/>
                                    </form>
                                    <script src="<?php echo $base_url; ?>admin/assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
                                    <script type="text/javascript">
                                        $(document).ready(function ()
                                        {
                                            $("#payment_forms").submit();
                                        });
                                    </script>
                                    <?php
                               /* }
                                else if ($finalorderamount < '200')
                                {

                                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'checkout/pr_error">';
                                }
                                else if ($pincode_is_valid == '0')
                                {
                                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'checkout/p_error">';
                                }
                                else if ($pincode_is_valid == '1' && $Cod_Availabe == 'N')
                                {
                                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'checkout/c_error">';
                                }*/
                            }
                            else
                            {

                                if (count($cart_data_array1) > 0)
                                {
                                    /*$all_order = $cart_data_array1;
                                    $total_price = 0;
                                    foreach($all_order as $all_order_data) // loop each product order
                                    {
                                      $total_price = $total_price+($all_order_data['price']*$all_order_data['quantity']);
                                      $orderAmount = round(($total_price)*$exchange_rate_country,2);
                                    }
                                    $orderAmount = $orderAmount-$temp_user_wallet_amount;
                                    */


                                    $formPostUrl = "https://checkout.razorpay.com/v1/checkout.js";
                                    //$secret_key = "rzp_live_5z6gkjhtu58QSe";
                                    $secret_key = "";
                                    $vanityUrl = "taptoobazar";
                                    $merchantTxnId = uniqid();
                                    //$orderAmount = 100;
                                    $orderAmount = $final_order_total . "00";
                                    $orderfinalamount = $final_order_total - $local_shipping;
                                    $currency = "INR";
                                    $data = $vanityUrl . $orderAmount . $merchantTxnId . $currency;
                                    $returnURL = $base_url . "checkout";
                                    $notifyUrl = $base_url . "checkout";
                                    $securitySignature = hash_hmac('sha1', $data, $secret_key);
                                    if ($pincode_is_valid == '1')
                                    {
                                        if ($orderfinalamount > 200)
                                        {
                                            ?>
                                            <form action="<?php echo $base_url; ?>checkout" method="POST">
                                                <script
                                                        src="<?php echo $formPostUrl; ?>"
                                                        data-key="<?php echo $secret_key; ?>"
                                                        data-amount="<?php echo $orderAmount; ?>"
                                                        data-buttontext="Pay with Razorpay"
                                                        data-name="<?php echo $merchantTxnId; ?>"
                                                        data-description="<?php echo $data; ?>"
                                                        data-image="<?php echo $loggedin_user_profile_pic_100; ?>"
                                                        data-prefill.name="<?php echo $loggedin_user_first_name; ?><?php echo $loggedin_user_last_name; ?>"
                                                        data-prefill.email="<?php echo $loggedin_user_email; ?>"
                                                        data-theme.color="#F37254"
                                                ></script>
                                                <input type="hidden" value="Hidden Element" name="hidden">
                                                <input type="hidden" id="merchantTxnId" name="merchantTxnId" value="<?php echo $merchantTxnId; ?>"/>
                                                <input type="hidden" id="orderAmount" name="orderAmount" value="<?php echo $orderAmount; ?>"/>
                                                <input type="hidden" id="currency" name="currency" value="<?php echo $currency; ?>"/>
                                                <input type="hidden" name="returnUrl" value="<?php echo $returnURL; ?>"/>
                                                <input type="hidden" id="notifyUrl" name="notifyUrl" value="<?php echo $notifyUrl; ?>"/>
                                                <input type="hidden" id="secSignature" name="secSignature" value="<?php echo $securitySignature; ?>"/>
                                            </form>
                                            <script src="<?php echo $base_url; ?>admin/assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
                                            <script type="text/javascript">
                                                $(document).ready(function ()
                                                {
                                                    $("#payment_form").submit();
                                                });
                                            </script>
                                            <?php
                                        }
                                        else
                                        {
                                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'checkout">';
                                        }
                                    }
                                    else
                                    {
                                        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'checkout/p_error">';
                                    }
                                }
                                else
                                {
                                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'checkout/n">';
                                }
                            }
                        }
                    }
                    else
                    {
                        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'checkout/n">';
                    }
                /*}
                else
                {
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'checkout/p_n_error">';
                }*/
            }
            else
            {
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'checkout/a_error">';
            }
        }
        else
        {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'checkout/n">';
        }
    }
    else
    {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'checkout">';
    }
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}  