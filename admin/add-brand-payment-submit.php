<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        
        $brand_id      = Secure1($db_mysqli, $_POST['brand_id']);
        $amount        = Secure1($db_mysqli, $_POST['amount']);
        $created_on    = get_current_date_time();
        
        $get_celebrtityquery = "SELECT * from brand_payment_history WHERE brand_id =$brand_id order by id desc limit 1";
        $result_get_celebrtityquery = mysqli_query($db_mysqli, $get_celebrtityquery);
        $all_celebrtitydata_array = array();
        while ($row_get_celebrtityquery = mysqli_fetch_assoc($result_get_celebrtityquery))
        {
            $all_celebrtitydata_array[] = $row_get_celebrtityquery;
        }
        //$admin_id = $all_celebrtitydata_array[0]['admin_id'];
        $totalamount = $all_celebrtitydata_array[0]['amount']+$amount;
        //print_r($totalamount); exit;

        $insert_category_query = "INSERT INTO brand_payment_history (brand_id, admin_id, request_amount, amount, payment_type,created_on, updated_on, status) 
        VALUES ('$brand_id','1','$amount','$totalamount','Request','$created_on','$created_on', '0')";
        $result_insert_category_query = mysqli_query($db_mysqli, $insert_category_query);

        if ($result_insert_category_query)
        {
            $return["html_message"] = 'Pyament added successfully.';
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
        $return["html_message"] = 'Some Error Occured! Please try again.';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>