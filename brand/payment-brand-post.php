<?php

include "common/config.php";
include "common/check_login.php";
include 'common/common_code.php';
if ($brand == 1)
{
    $get_brandpost_query = "select * from brand_post order by id desc limit 1";
    $result_get_brandpost_query = mysqli_query($db_mysqli, $get_brandpost_query);
    while ($row_get_brandpost_query = mysqli_fetch_assoc($result_get_brandpost_query))
    {
        $check_brandpost_data_array[] = $row_get_brandpost_query;
    }
    
    $last_id = $check_brandpost_data_array[0]['id'];

    $get_brandamt_query = "select sum(brand_cost) as total_amount from brand_post_celebrty_list where brand_post_id='$last_id'";
    $result_get_brandamt_query = mysqli_query($db_mysqli, $get_brandamt_query);
    while ($row_get_brandamt_query = mysqli_fetch_assoc($result_get_brandamt_query))
    {
        $check_brandamt_data_array[] = $row_get_brandamt_query;
    }

    $total_brand_cost   = $check_brandamt_data_array[0]['total_amount'];
    
    $formPostUrl = "https://secure.payu.in/_payment";//"https://test.payu.in/_payment"; //"https://secure.payu.in/_payment"; 
    $secret_key = "2mTBHI"; //"gtKFFx";//"2mTBHI"; 
    $salt= "hkLfpcVI6U4s60MBSut1JW0ihyWXYdhH";//"wia56q6O"; //"hkLfpcVI6U4s60MBSut1JW0ihyWXYdhH";
    $txnid = uniqid();
    $returnURL = $base_url1 . "view-brand-post/".$loggedin_user_id.'/'.$last_id;
    $notifyUrl = $base_url1 . "view-brand-post/".$loggedin_user_id.'/'.$last_id;
    $productinfo = "Shopping";
    $status = '1';
    $hashSequence = $secret_key.'|'.$txnid.'|'.$total_brand_cost.'|'.$productinfo.'|'.$loggedin_user_first_name.'|'.$loggedin_user_email.'|||||||||||'.$salt;
    $hash =  hash('sha512',$hashSequence);
 ?>
     <form action='<?php echo $formPostUrl; ?>' method='post' id="payment_form">
    <input type="hidden" name="key" value="<?php echo $secret_key; ?>" />
    <input type="hidden" name="salt" value="<?php echo $salt; ?>" />
    <input type="hidden" name="txnid" value="<?php echo $txnid; ?>" />
    <input type="hidden" name="productinfo" value="<?php echo $productinfo; ?>" />
    <input type="hidden" name="amount" value="<?php echo $total_brand_cost; ?>" />
    <input type="hidden" name="email" value="<?php echo $loggedin_user_email; ?>" />
    <input type="hidden" name="firstname" value="<?php echo $loggedin_user_first_name; ?>" />
    <input type="hidden" name="phone" value="<?php echo $loggedin_user_mobile; ?>"/>
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
?>