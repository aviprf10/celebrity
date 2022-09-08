<?php
include "common/config.php";
include "common/check_login.php";
if ($celebrity == 1)
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
    $custom_filter = "(p.status='0' or p.status='2') and p.celebrity_id='$loggedin_user_id'";

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
    if (Secure1($db_mysqli, $requestData['search_brand']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_brand']);
        $custom_filter .= " and b.brand_name = '" . $search_status . "'";
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

    $get_payment_query = "select p.*, u.user_name, c.user_name as celebrty_name, b.user_name as brand from payment_history p left join user u on p.user_id=u.id left join brand_user b on p.brand_id=b.id left join user c on p.celebrity_id=c.id where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $result_get_payment_query = mysqli_query($db_mysqli, $get_payment_query);

    $count_get_payment_query = "select * from payment_history p left join user u on p.user_id=u.id left join brand_user b on p.brand_id=b.id left join user c on p.celebrity_id=c.id  where $custom_filter";
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
            $celebrity_id = $all_payment_table_data['celebrity_id'];
            $user_name = $all_payment_table_data['user_name'];
            $celebrty_name = $all_payment_table_data['celebrty_name'];
            if($all_payment_table_data['brand'] !='')
            {
                $brand = $all_payment_table_data['brand'];
            }
            else 
            {
                $brand = '--';
            }
            

            $get_celebrity_details_query = "select * from celebrity_details where celebrity_id='$loggedin_user_id' and is_deleted='0'";
            $result_get_celebrity_details_query = mysqli_query($db_mysqli, $get_celebrity_details_query);
            while ($row_get_celebrity_details_query = mysqli_fetch_assoc($result_get_celebrity_details_query))
            {
                $edit_data_array[] = $row_get_celebrity_details_query;
            }

            $amount = $all_payment_table_data['amount']*$edit_data_array[0]['payment_percentage'];
            $mainamount = $amount/100;
            $main_amount  = $all_payment_table_data['amount']-$mainamount;

            $createdamount = $all_payment_table_data['created_amount']*$edit_data_array[0]['payment_percentage'];
            $createdmainamount = $createdamount/100;
            $createdmain_amount  = $all_payment_table_data['created_amount']-$createdmainamount;

            $created_amount = $createdmain_amount.'.00';
            $debit_amount = $all_payment_table_data['debit_amount'];
            $payment_type = $all_payment_table_data['payment_type'];
            $amount = $main_amount.'.00';
            $created_on = date('d-m-Y h:s:i', strtotime($all_payment_table_data['created_on']));
            $status = $all_payment_table_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;

           
            $nestedData[] = $user_name;
            $nestedData[] = $celebrty_name;
            $nestedData[] = $brand;
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
            else 
            {
                $nestedData[] = '<span class="label label-danger">Paid By Admin</span>';
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
