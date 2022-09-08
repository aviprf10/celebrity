<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        
        $celebrity_id       = Secure1($db_mysqli, $_POST['celebrity_id']);
        $amount          = Secure1($db_mysqli, $_POST['amount']);
        $created_on = get_current_date_time();
        
        $get_celebrtityquery = "SELECT * from payment_history WHERE celebrity_id =$celebrity_id order by id desc limit 1";
        $result_get_celebrtityquery = mysqli_query($db_mysqli, $get_celebrtityquery);
        $all_celebrtitydata_array = array();
        while ($row_get_celebrtityquery = mysqli_fetch_assoc($result_get_celebrtityquery))
        {
            $all_celebrtitydata_array[] = $row_get_celebrtityquery;
        }
        $user_id = $all_celebrtitydata_array[0]['user_id'];
        $totalamount = $all_celebrtitydata_array[0]['amount']-$amount;
        //print_r($totalamount); exit;

        $insert_category_query = "INSERT INTO payment_history (celebrity_id, user_id, debit_amount, amount, payment_type,created_on, updated_on, status) 
        VALUES ('$celebrity_id','$user_id','$amount','$totalamount','Dabit','$created_on','$created_on', '2')";
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