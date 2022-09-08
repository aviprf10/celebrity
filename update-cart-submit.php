<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if (isset($_POST))
{
    $product_id = Secure1($db_mysqli, $_POST['product_id']);
    $new_quantity = Secure1($db_mysqli, $_POST['product_quantity']);

    $product_data_array = array();
    $get_product_query = "select * from product p LEFT JOIN product_images pi on pi.product_id = p.id WHERE  p.id = '$product_id'  AND p.status = '1'  AND p.is_deleted = '0'";

    $result_product_data = mysqli_query($db_mysqli, $get_product_query);
    while ($row_product_data = mysqli_fetch_assoc($result_product_data))
    {
        $product_data_array[] = $row_product_data;
    }


    if (count($product_data_array) > 0)
    {
        $product_data = $product_data_array[0];
        if ($user == 1)
        {
            $check_cart_data_array = array();
            $get_user_cart_query = "select * FROM user_cart WHERE  user_id = '$loggedin_user_id' AND product_id = '$product_id'  ";
            $result_user_cart_data = mysqli_query($db_mysqli, $get_user_cart_query);
            while ($row_user_cart_data = mysqli_fetch_assoc($result_user_cart_data))
            {
                $check_cart_data_array[] = $row_user_cart_data;
            }

            if (count($check_cart_data_array) > 0)
            {
                $check_cart_data = $check_cart_data_array[0];
                if(1 > $new_quantity)
                {
                    $return["html_message"] = 'Min Product quantity should be '.$product_data['product_qty'] .'.';
                    $return["status"] = "error";
                    echo json_encode($return);
                    exit();
                }
                if($product_data['product_qty'] < $new_quantity)
                { 
                    $return["html_message"] = 'Max Product quantity should be '.$product_data['product_qty'].'.';
                    $return["status"] = "error";
                    echo json_encode($return);
                    exit();
                }
                if ($product_data['product_qty'] >= $new_quantity) 
                {
                    $new_quantity = Secure1($db_mysqli, $_POST['product_quantity']);
                }
                else if($product_data['product_qty'] < $new_quantity)
                {
                    $new_quantity = $product_data['product_qty'];
                    $return["html_message"] = 'No more quantity is available.';
                    $return["status"] = "error";
                    echo json_encode($return);
                    exit();
                }
                
                $product_price = $check_cart_data['price'];
                $is_coupon_apply = $check_cart_data['is_coupon_apply'];

                $coupon_amount = 0;
                if ($is_coupon_apply)
                {
                    $coupon_id = $check_cart_data['coupon_id'];
                    $coupon_data_array = array();
                    $get_coupon_query = "SELECT id, flat_amount, percentage, discount_type
                                    FROM coupon
                                    WHERE id = '$coupon_id' AND status = 1 AND is_deleted = 0;";

                    $result_coupon_data = mysqli_query($db_mysqli, $get_coupon_query);
                    while ($row_coupon_data = mysqli_fetch_assoc($result_coupon_data))
                    {
                        $coupon_data_array[] = $row_coupon_data;
                    }

                    $discount_type = $coupon_data_array[0]['discount_type'];
                    $added_amount = 0;
                    if ($discount_type == 0)
                    {
                        $percentage = $coupon_data_array[0]['percentage'];
                        $added_amount = $product_price * ($percentage / 100);
                    }
                    elseif ($discount_type == 1)
                    {
                        $flat_amount = $coupon_data_array[0]['flat_amount'];
                        $added_amount = $flat_amount;
                    }
                    $coupon_amount = round($added_amount * $new_quantity, 2);
                }


                $get_user_cart_query = "update user_cart SET `quantity`= '$new_quantity', coupon_amount='$coupon_amount' WHERE  user_id = '$loggedin_user_id' AND product_id = '$product_id'";
                $return_cart_data = mysqli_query($db_mysqli, $get_user_cart_query);

                if ($return_cart_data)
                {
                    include('common/cart.php');
                    $return["status"] = "success";
                    echo json_encode($return);
                    exit();
                }
                else
                {
                    $return["html_message"] = "Error occured while updating product quantity.";
                    $return["status"] = "error";
                    echo json_encode($return);
                    exit();
                }
            }
            else
            {
                $return["html_message"] = 'Product Does not exist in cart..!';
                $return["status"] = "error";
                echo json_encode($return);
            }
        }
        else
        {
            if (count($_SESSION['cart_' . $company_name_session]) > 0)
            {
                if(1 > $new_quantity)
                {
                    $return["html_message"] = 'Min Product quantity should be '.$product_data['product_qty'] .'.';
                    $return["status"] = "error";
                    echo json_encode($return);
                    exit();
                }
                if($product_data['product_qty'] < $new_quantity)
                { 
                    $return["html_message"] = 'Max Product quantity should be '.$product_data['product_qty'].'.';
                    $return["status"] = "error";
                    echo json_encode($return);
                    exit();
                }
                $all_order = $_SESSION['cart_' . $company_name_session];
                foreach ($all_order as $key1 => $value1)
                {
                    if ($product_id == $value1['product_id'])
                    {
                        if ($product_data['product_qty'] < $new_quantity)
                        {
                            $_SESSION['cart_' . $company_name_session][$key1]['quantity'] = $product_data['product_qty'];
                            $return["html_message"] = ' No more quantity is available.';
                            $return["status"] = "error";
                            echo json_encode($return);
                            exit();
                        }
                        else
                        {
                            $_SESSION['cart_' . $company_name_session][$key1]['quantity'] = $new_quantity;
                            include('common/cart.php');
                            $return["status"] = "success";
                            echo json_encode($return);
                            exit();
                        }
                    }
                }
            }
            else
            {
                $return["html_message"] = 'Product Does not exist in cart..!';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }
        }
    }
    else
    {
        $return["html_message"] = 'Product does not exist.';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }
}
else
{
    $return["html_message"] = ' Some Error Occured! Please try again.';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}
?>