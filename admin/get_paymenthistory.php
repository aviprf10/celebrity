<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if ($_POST)
    {
        $celebrity_id = Secure1($db_mysqli, $_POST['celebrity_id']);
        
        $get_celebrtityquery = "SELECT * from payment_history WHERE celebrity_id =$celebrity_id";
        $result_get_celebrtityquery = mysqli_query($db_mysqli, $get_celebrtityquery);
        $all_celebrtitydata_array = array();
        while ($row_get_celebrtityquery = mysqli_fetch_assoc($result_get_celebrtityquery))
        {
            $all_celebrtitydata_array[] = $row_get_celebrtityquery;
        }

        $get_celebritydetailsquery = "SELECT * from celebrity_details WHERE celebrity_id =$celebrity_id and is_deleted='0'";
        $result_get_celebritydetailsquery = mysqli_query($db_mysqli, $get_celebritydetailsquery);
        $all_celebritydetailsdata_array = array();
        while ($row_get_celebritydetailsquery = mysqli_fetch_assoc($result_get_celebritydetailsquery))
        {
            $all_celebritydetailsdata_array[] = $row_get_celebritydetailsquery;
        }

        $html_message='';
        $html_message .= '
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Cut of Payment Percentage : </label>
                            <input type="text" class="form-control" value="'.$all_celebritydetailsdata_array[0]['payment_percentage'].'" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-12"> 
                    <table class="table table-striped table-hover table-checkable dataTable no-footer ">
                    <thead>
                    <tr>
                        <th>Payment Type</th>
                        <th>Credit Amt</th>
                        <th>Debit Amt</th>
                        <th>Amount</th>
                        <th>Created</th>
                    </tr>
                    </thead>
                    <thead style="background: #fff">
                    ';

        foreach($all_celebrtitydata_array as $all_celebrtitydata)
        {
            $amountpr = $all_celebrtitydata['amount']*$all_celebritydetailsdata_array[0]['payment_percentage'];
            $mainamount = $amountpr/100;
            $main_amount  = $all_celebrtitydata['amount']-$mainamount;

            $html_message .= '<tr>
                        <td>'.$all_celebrtitydata['payment_type'].'</td>
                        <td>'.$all_celebrtitydata['created_amount'].'</td>
                        <td>'.$all_celebrtitydata['debit_amount'].'</td>
                        <td>'.$main_amount.'</td>
                        <td>'.date('d-m-Y h:i:s', strtotime($all_celebrtitydata['created_on'])).'</td>

                    </tr>';
        }
        $html_message .= '</thead></div>';
        $html_message .='
            <div class="col-md-4">
                <div class="form-group">
                    <label>Cridit Celebrity Amount : </label>
                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Cridit Amount in Celebrity acount">
                </div>    
            </div>
        ';
        $return["html_message"] = $html_message;
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
    $return["html_message"] = 'Please login.';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}
?>