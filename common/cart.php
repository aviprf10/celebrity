<?php
$total_cart_celebrity_id = 0;
$order_total_amount = 0;
$save_total_amount = 0;
$is_coupon_apply = 0;
$discount = 0;
$total_discount = 0;
$total_qty_wise_discount = 0;
$temp_user_wallet_amount = 0;
$final_order_total = 0;
$celebrity_id_total_quantity = 0;
$cart_celebrity_id_array = array();
$cart_celebrity_id_variant_id_array = array();
$local_shipping=0;
// $master_settings_data_array = array();
// $master_settings_query = "select * from master_settings where id='1'";
// $result_master_settings_data = mysqli_query($db_mysqli,$master_settings_query);
// while ($row_master_settings_data = mysqli_fetch_assoc($result_master_settings_data))
// {
//     $master_settings_data_array[] = $row_master_settings_data;
//     if($current_page != 'cart')
//     {
//         $local_shipping=$row_master_settings_data['local_shipping'];
//     }
// }
if($user == 1)
{  
    $cart_celebrity_id_array = array();
    $cart_celebrity_id_variant_id_array = array();

    $cart_data_array = array();
    $get_user_cart_query = "select * from user_cart where user_id='$loggedin_user_id'";
    $result_user_cart_data = mysqli_query($db_mysqli, $get_user_cart_query);
    while ($row_user_cart_data = mysqli_fetch_assoc($result_user_cart_data))
    {
        $cart_data_array[] = $row_user_cart_data;
    }
    foreach ($cart_data_array as $cart_data)
    {
        if ($cart_data['celebrity_id'] > 0)
        {
            if (!in_array($cart_data['celebrity_id'], $cart_celebrity_id_array))
            {
                $cart_celebrity_id_array[] = $cart_data['celebrity_id'];
            }
        }
    }

    $cart_celebrity_id_array1 = implode(",", $cart_celebrity_id_array);

    $cart_celebrity_id_data_array = array();
    $cart_all_celebrity_id_data_array = array();
    if (count($cart_celebrity_id_array) > 0)
    {
        $cart_celebrity_id_data_array = array();
        $get_cart_celebrity_id_query = "select u.*,c.category_id,c.sub_category_id,c.giftcat_id,c.giftsubcat_id,c.giftsubsubcat_id,c.full_description,c.meta_title,c.meta_keyword,c.meta_description,c.language_spoken from user u LEFT JOIN celebrity_details c on c.celebrity_id = u.id where u.id IN ($cart_celebrity_id_array1)";
        $result_cart_celebrity_id_data = mysqli_query($db_mysqli, $get_cart_celebrity_id_query);
        while ($row_cart_celebrity_id_data = mysqli_fetch_assoc($result_cart_celebrity_id_data))
        {
            $cart_celebrity_id_data_array[] = $row_cart_celebrity_id_data;
        }
        if(count($cart_celebrity_id_data_array) > 0)
        {
            foreach ($cart_celebrity_id_data_array as $cart_celebrity_id_data)
            {
                $cart_all_celebrity_id_data_array[$cart_celebrity_id_data['id']] = $cart_celebrity_id_data;

                if ($cart_celebrity_id_data['status'] != '1' || $cart_celebrity_id_data['is_deleted'] == '1' || $cart_celebrity_id_data['quantity'] == '0')
                {
                    $celebrity_id = $cart_celebrity_id_data['id'];
                    $return_cart_data = array();
                    $user_cart_query = "delete from user_cart where celebrity_id='$celebrity_id' and user_id='$loggedin_user_id'";
                    $return_cart_data = mysqli_query($db_mysqli, $user_cart_query);
                }
            }
        }
    }


    $cart_data_array1 = array();
    $temp_cart_data_array = array();
    $get_temp_cart_query = "select * from user_cart where user_id = '$loggedin_user_id'";
    $result_temp_cart_data = mysqli_query($db_mysqli, $get_temp_cart_query);
    while ($row_temp_cart_data = mysqli_fetch_assoc($result_temp_cart_data))
    {
        $temp_cart_data_array[] = $row_temp_cart_data;
    }

    $temp_cart_data_array1 = array();
    
    foreach ($temp_cart_data_array as $temp_cart_data)
    {
       
        $temp_cart_data_array1 = array();
        $celebrity_id = $temp_cart_data['celebrity_id'];
        $temp_cart_data_array1["id"] = $temp_cart_data['id'];
        $temp_cart_data_array1["user_id"] = $temp_cart_data['user_id'];
        $temp_cart_data_array1["celebrity_id"] = $temp_cart_data['celebrity_id'];
        $temp_cart_data_array1["name"] = $temp_cart_data['name'];
        $temp_cart_data_array1['from_name'] = $temp_cart_data['from_name'];
        $temp_cart_data_array1['type'] = $temp_cart_data['type'];
        $temp_cart_data_array1["profile_pic"] = $temp_cart_data['profile_pic'];
        $temp_cart_data_array1["occasion_id"] = $temp_cart_data['occasion_id'];
        $temp_cart_data_array1["date_of_delevery"] = $temp_cart_data['date_of_delevery'];
        $temp_cart_data_array1["price"] = $temp_cart_data['price'];
        $temp_cart_data_array1['instagramid'] = $temp_cart_data['instagramid'];
        $temp_cart_data_array1["quantity"] = 1;
        $user_data_array = array();
        $get_user_query = "select * from user where status='1' and is_deleted='0' and id='$celebrity_id'";
        $result_user_data = mysqli_query($db_mysqli,$get_user_query);
        while ($row_user_data = mysqli_fetch_assoc($result_user_data))
        {
            $user_data_array[] = $row_user_data;
        } 
        $user_name = $user_data_array[0]['user_name'];
        $profile_pic = $user_data_array[0]['profile_pic'];
        $user_unique_slug = $user_data_array[0]['user_unique_slug'];


        $temp_cart_data_array1["profile_pic"] = $profile_pic;
        $temp_cart_data_array1["user_message"] = $temp_cart_data['user_message'];
        $temp_cart_data_array1["message_id"] = $temp_cart_data['message_id'];
        $temp_cart_data_array1["address_id"] = $temp_cart_data['address_id'];
        $temp_cart_data_array1["request_for"] = $temp_cart_data['request_for'];
        $temp_cart_data_array1["discount_type"] = $temp_cart_data['discount_type'];
        $temp_cart_data_array1["discount"] = $temp_cart_data['discount'];
        $temp_cart_data_array1["services_id"] = $temp_cart_data['services_id'];
        $temp_cart_data_array1["celebrity_price_id"] = $temp_cart_data['celebrity_price_id'];
        $cart_data_array1[$temp_cart_data['celebrity_id']] = $temp_cart_data_array1;
        
        $save_total_amount += ($temp_cart_data_array1["mrp"] - $temp_cart_data_array1["price"]) * $temp_cart_data_array1["quantity"];
        $order_total_amount += $temp_cart_data_array1["quantity"] * $temp_cart_data_array1["price"];
        
        if ($temp_cart_data_array1["discount_type"] == 'percentage')
        {
            $discount = $order_total_amount*$temp_cart_data_array1["discount"];
            $total_discount += $discount/100;
        }
        else if($temp_cart_data_array1["discount_type"] == 'price')
        {
            $total_discount += $temp_cart_data_array1["discount"];
        }
        
        $celebrity_id_total_quantity += $temp_cart_data_array1["quantity"];
    }

    $final_order_total = $order_total_amount - $total_discount;
    $final_order_total+= $local_shipping;
    if (count($temp_cart_data_array1) > 0)
    {
        $_SESSION['total_user_cart_data_' . $company_name_session] = count($temp_cart_data_array);
        $_SESSION['order_total_amount_' . $company_name_session] = $order_total_amount;
        $_SESSION['save_total_amount_' . $company_name_session] = $save_total_amount;
        $_SESSION['final_order_total_' . $company_name_session] = $final_order_total;
    }
    else
    {
        $_SESSION['total_user_cart_data_' . $company_name_session] = 0;
        $_SESSION['order_total_amount_' . $company_name_session] = 0;
        $_SESSION['save_total_amount_' . $company_name_session] = 0;
        $_SESSION['final_order_total_' . $company_name_session] = 0;
    }
    $total_cart_celebrity = $_SESSION['total_user_cart_data_' . $company_name_session];
}
else
{
    $cart_celebrity_id_array = array();
    $cart_celebrity_id_variant_id_array = array();
    $cart_data_array = $_SESSION['cart_' . $company_name_session];
    foreach ($cart_data_array as $cart_data)
    {
        if ($cart_data['celebrity_id'] > 0)
        {
            if (!in_array($cart_data['celebrity_id'], $cart_celebrity_id_array))
            {
                $cart_celebrity_id_array[] = $cart_data['celebrity_id'];
            }

        }
        $save_total_amount += $cart_data['price'] * $cart_data['quantity'];
        $order_total_amount += $cart_data['quantity'] * $cart_data['price'];
        $final_order_total += $cart_data['quantity'] * $cart_data['price'];
    }
    $final_order_total+= $local_shipping;


    $cart_celebrity_id_array1 = implode(",", $cart_celebrity_id_array);
    $cart_celebrity_id_data_array = array();
    $cart_all_celebrity_id_data_array = array();
    if (count($cart_celebrity_id_array) > 0)
    {
        $cart_celebrity_id_data_array = array();
        $get_cart_celebrity_id_query = "select * from user u LEFT JOIN celebrity_details cd on cd.celebrity_id = u.id where u.id IN ($cart_celebrity_id_array1)";

        $result_cart_celebrity_id_data = mysqli_query($db_mysqli, $get_cart_celebrity_id_query);
        while ($row_cart_celebrity_id_data = mysqli_fetch_assoc($result_cart_celebrity_id_data))
        {
            $cart_celebrity_id_data_array[] = $row_cart_celebrity_id_data;
        }

        foreach ($cart_celebrity_id_data_array as $cart_celebrity_id_data)
        {
            $cart_all_celebrity_id_data_array[$cart_celebrity_id_data['id']] = $cart_celebrity_id_data;
            if ($cart_celebrity_id_data['status'] != '1' || $cart_celebrity_id_data['is_deleted'] == '1' || $cart_celebrity_id_data['quantity'] == '0')
            {
                $save_total_amount -= ($cart_celebrity_id_data['price']) * $cart_celebrity_id_data['quantity'];
                $order_total_amount -= $cart_celebrity_id_data['quantity'] * $cart_celebrity_id_data['price'];

                
                if ($cart_celebrity_id_data["discount_type"] == 'percentage')
                {
                    $discount = $order_total_amount*$cart_celebrity_id_data["discount"];
                    $total_discount += $discount/100;
                }
                else if($cart_celebrity_id_data["discount_type"] == 'price')
                {
                    $total_discount += $cart_celebrity_id_data["discount"];
                }
                $final_order_total -= $order_total_amount - $total_discount;
                unset($_SESSION['cart_' . $company_name_session][$cart_celebrity_id_data['id']]);
            }
        }
    }

    if ($_SESSION['cart_' . $company_name_session])
    {
        $total_cart_celebrity_id = count($_SESSION['cart_' . $company_name_session]);
        $_SESSION['total_user_cart_data_' . $company_name_session] = $total_cart_celebrity_id;
        $_SESSION['order_total_amount_' . $company_name_session] = $order_total_amount;
        $_SESSION['save_total_amount_' . $company_name_session] = $save_total_amount;
        $_SESSION['final_order_total_' . $company_name_session] = $final_order_total;
    }
    else
    {
        $_SESSION['total_user_cart_data_' . $company_name_session] = 0;
        $_SESSION['cart_' . $company_name_session] = array();
        $_SESSION['order_total_amount_' . $company_name_session] = 0;
        $_SESSION['save_total_amount_' . $company_name_session] = 0;
        $_SESSION['final_order_total_' . $company_name_session] = 0;
    }
    $total_cart_celebrity = $_SESSION['total_user_cart_data_' . $company_name_session];
}
?>