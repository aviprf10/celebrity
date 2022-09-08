<?php

include "common/config.php";
include "common/check_login.php";
include 'common/common_code.php';
include "common/cart.php";
if ($user == 1)
{
    $count = 0;
    if (count($cart_data_array1) > 0)
    {
        
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
               
                foreach($cart_data_array1 as $all_order_data) // loop each product order
                {
                    $total_price = $all_order_data['price']-$all_order_data['discount'];
                    $user_id = $all_order_data['user_id'];
                    $celebrity_id = $all_order_data['celebrity_id'];
                    $amount = $total_price.'.00';
                }
                $get_user_query = "select * from user where status='1' and is_deleted='0' and id='$user_id'";
                $result_user_data = mysqli_query($db_mysqli,$get_user_query);
                while ($row_user_data = mysqli_fetch_assoc($result_user_data))
                {
                    $getuser_data_array[] = $row_user_data;
                } 
                
                $firstname=ucfirst($getuser_data_array[0]['first_name']);
                $last_name=$getuser_data_array[0]['last_name'];
                $email=$getuser_data_array[0]['email'];
                $mobile=$getuser_data_array[0]['mobile'];
                
                $formPostUrl = "https://test.payu.in/_payment"; //"https://secure.payu.in/_payment"; 
                $secret_key = "gtKFFx";//"2mTBHI"; 
                $vanityUrl = "celebrity";
                $salt= "wia56q6O"; //"hkLfpcVI6U4s60MBSut1JW0ihyWXYdhH";
                $txnid = uniqid();
                $returnURL = $base_url . "checkout/".$user_id.'/'.$celebrity_id;
                $notifyUrl = $base_url . "checkout/".$user_id.'/'.$celebrity_id;
                $productinfo = "Shopping";
                $status = '1';
                $hashSequence = $secret_key.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|||||||||||'.$salt;
                $hash =  hash('sha512',$hashSequence);
                
                ?>
                    <form action='<?php echo $formPostUrl; ?>' method='post' id="payment_form">
                    <input type="hidden" name="key" value="<?php echo $secret_key; ?>" />
                    <input type="hidden" name="salt" value="<?php echo $salt; ?>" />
                    <input type="hidden" name="txnid" value="<?php echo $txnid; ?>" />
                    <input type="hidden" name="productinfo" value="<?php echo $productinfo; ?>" />
                    <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
                    <input type="hidden" name="email" value="<?php echo $email; ?>" />
                    <input type="hidden" name="firstname" value="<?php echo $firstname; ?>" />
                    <input type="hidden" name="phone" value="<?php echo $mobile; ?>"/>
                    <input type="hidden" name="lastname" value="<?php echo $last_name; ?>" />
                    <input type="hidden" name="surl" value="<?php echo $returnURL; ?>" />
                    <input type="hidden" name="furl" value="<?php echo $notifyUrl; ?>" />
                    <input type="hidden" name="hash" value="<?php echo $hash; ?>" />
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
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'checkout/n">';
            }
        }
    }
    else
    {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'checkout/n">';
    }
}
else
{
    
    $count = 0;
    if (count($_SESSION['cart_data_array1']) > 0)
    {
        $cart_data_array1 = $_SESSION['cart_data_array1'];
        if (count($cart_data_array1) > 0)
        {
            foreach($cart_data_array1 as $all_order_data) // loop each product order
            {
                $total_price = $all_order_data['price']-$all_order_data['discount'];
                $user_id = $all_order_data['user_id'];
                $celebrity_id = $all_order_data['celebrity_id'];
                $amount = $total_price.'.00';
            }
            $get_user_query = "select * from user where status='1' and is_deleted='0' and id='$user_id'";
            $result_user_data = mysqli_query($db_mysqli,$get_user_query);
            while ($row_user_data = mysqli_fetch_assoc($result_user_data))
            {
                $getuser_data_array[] = $row_user_data;
            } 
            
            $firstname=ucfirst($getuser_data_array[0]['first_name']);
            $last_name=$getuser_data_array[0]['last_name'];
            $email=$getuser_data_array[0]['email'];
            $mobile=$getuser_data_array[0]['mobile'];
            
            $formPostUrl = "https://test.payu.in/_payment"; //"https://secure.payu.in/_payment"; 
            $secret_key = "gtKFFx";//"2mTBHI"; 
            $vanityUrl = "celebrity";
            $salt= "wia56q6O"; //"hkLfpcVI6U4s60MBSut1JW0ihyWXYdhH";
            $txnid = uniqid();
            $returnURL = $base_url . "checkout/".$user_id.'/'.$celebrity_id;
            $notifyUrl = $base_url . "checkout/".$user_id.'/'.$celebrity_id;
            $productinfo = "Shopping";
            $status = '1';
            $hashSequence = $secret_key.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|||||||||||'.$salt;
            $hash =  hash('sha512',$hashSequence);
            
            ?>
                <form action='<?php echo $formPostUrl; ?>' method='post' id="payment_form">
                <input type="hidden" name="key" value="<?php echo $secret_key; ?>" />
                <input type="hidden" name="salt" value="<?php echo $salt; ?>" />
                <input type="hidden" name="txnid" value="<?php echo $txnid; ?>" />
                <input type="hidden" name="productinfo" value="<?php echo $productinfo; ?>" />
                <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
                <input type="hidden" name="email" value="<?php echo $email; ?>" />
                <input type="hidden" name="firstname" value="<?php echo $firstname; ?>" />
                <input type="hidden" name="phone" value="<?php echo $mobile; ?>"/>
                <input type="hidden" name="lastname" value="<?php echo $last_name; ?>" />
                <input type="hidden" name="surl" value="<?php echo $returnURL; ?>" />
                <input type="hidden" name="furl" value="<?php echo $notifyUrl; ?>" />
                <input type="hidden" name="hash" value="<?php echo $hash; ?>" />
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
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'checkout/n">';
        }
    }
    else
    {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'checkout/n">';
    }
}  