<?php
include "common/config.php";
include "common/check_login.php";
if ($admin == 1)
{
    //error_reporting(-1);


    $requestData = $_REQUEST;
    $columns = array(
        0 => 'p.id',
        1 => 'u.user_name',
        2 => 'c.user_name',
        3 => 'b.brand_name',
        4 => 'p.created_amount',
        5 => 'p.debit_amount',
        6 => 'p.amount',
        7 => 'p.id',
        8 => 'p.id',
        9 => 'p.d',
    );

    $custom_query = "";
    $custom_filter = "p.status='0' or p.status='1' or p.status='2'  or p.status='3'";

    if (Secure1($db_mysqli, $requestData['search_user']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_user']);
        $custom_filter .= " and u.user_name LIKE '%" . $search_value . "%'";
    }
    
    if (Secure1($db_mysqli, $requestData['search_celebrity']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_celebrity']);
        $custom_filter .= " and c.user_name = '" . $search_status . "'";
    }

    if (Secure1($db_mysqli, $requestData['search_credit_amt']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_credit_amt']);
        $custom_filter .= " and p.created_amount = '" . $search_status . "'";
    }
    if (Secure1($db_mysqli, $requestData['search_debit_amt']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_debit_amt']);
        $custom_filter .= " and p.debit_amount = '" . $search_status . "'";
    }
    if (Secure1($db_mysqli, $requestData['search_amount']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_amount']);
        $custom_filter .= " and p.amount = '" . $search_status . "'";
    }

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_payment_query = "select p.*, u.user_name, c.user_name as celebrty_name from payment_history p left join user u on p.user_id=u.id left join user c on p.celebrity_id=c.id where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $result_get_payment_query = mysqli_query($db_mysqli, $get_payment_query);

    $count_get_payment_query = "select p.*, u.user_name, c.user_name as celebrty_name from payment_history p left join user u on p.user_id=u.id left join user c on p.celebrity_id=c.id where $custom_filter";
    $result_count_get_payment_query = mysqli_query($db_mysqli, $count_get_payment_query);
    $total_data = mysqli_num_rows($result_count_get_payment_query);

    $all_payment_data_array = array();
    while ($row_get_payment_query = mysqli_fetch_assoc($result_get_payment_query))
    {
        $all_payment_data_array[] = $row_get_payment_query;
    }


    $data = array();
    $count = 1;
    if (count($all_payment_data_array) > 0)
    {
        foreach ($all_payment_data_array as $all_payment_table_data)
        {
            $row_id = $all_payment_table_data['id'];
            $user_name = $all_payment_table_data['user_name'];
            $celebrty_name = $all_payment_table_data['celebrty_name'];
            $created_amount = $all_payment_table_data['created_amount'];
            $debit_amount = $all_payment_table_data['debit_amount'];
            $payment_type = $all_payment_table_data['payment_type'];
            $amount = $all_payment_table_data['amount'];
            $created_on = date('d-m-Y h:s:i', strtotime($all_payment_table_data['created_on']));
            $status = $all_payment_table_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;

           
            $nestedData[] = $user_name;
            $nestedData[] = $celebrty_name;
            $nestedData[] = $payment_type;
            $nestedData[] = $created_amount;
            $nestedData[] = $debit_amount;
            $nestedData[] = $amount;
            $nestedData[] = $created_on;
            if ($status == '0')
            {
                $nestedData[] = '<span class="label label-success">Paid By User</span>';
            }
            else if ($status == '1')
            {
                $nestedData[] = '<span class="label label-primary">Paid By Brand</span>';
            }
            else  if ($status == '3')
            {
                $nestedData[] = '<span class="label label-danger">Brand Request Amount</span>';
            }
            else 
            {
                $nestedData[] = '<span class="label label-wrong">Paid By Admin</span>';
            }

            $data[] = $nestedData;
//         $count=$count+1;
        }
    }
    else
    {
        $nestedData = array();
        $nestedData[] = '';
        $nestedData[] = '';
        $nestedData[] = '';
        $nestedData[] = '';
        $nestedData[] = '';
        $nestedData[] = '
            <td valign = "top" colspan = "4" class="dataTables_empty">
                <center>
                    <h6><i style = "font-size: 60px;    color: #999;" class="  icon-warning22"></i></h6>
                    <h4 class="no-margin text-semibold" style = "    color: #999;"> No Records Found!</h4>
                </center>
            </td>';
        $nestedData[] = '';
        $nestedData[] = '';
        $nestedData[] = '';
        $nestedData[] = '';
        $data[] = $nestedData;
    }
    $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($total_data), "recordsFiltered" => intval($total_data), "data" => $data);
    echo json_encode($json_data);
}
?>
