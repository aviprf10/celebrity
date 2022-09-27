<?php
include "common/config.php";
include "common/check_login.php";
if ($brand == 1)
{
    //error_reporting(-1);

    
    $requestData = $_REQUEST;
    $columns = array(
        0 => 'bp.id',
        1 => 'bp.title',
        2 => 'bp.category_id',
        3 => 'bp.payment_status',
        4 => 'bp.price',
        5 => 'bp.validate_days',
        6 => 'bp.id',
    );

    $custom_query = "";
    $custom_filter = "bp.is_deleted= '0' and added_by='$loggedin_user_id' ";
    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

   echo $get_category_query = "select bp.*, c.category_name from brand_post bp left join category c on bp.category_id=c.id where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);

    $count_get_category_query = "select bp.*, c.category_name from brand_post bp left join category c on bp.category_id=c.id where $custom_filter";
    $result_count_get_category_query = mysqli_query($db_mysqli, $count_get_category_query);
    $total_data = mysqli_num_rows($result_count_get_category_query);

    $all_category_data_array = array();
    while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
    {
        $all_category_data_array[] = $row_get_category_query;
    }


    $data = array();
    $count = 1;
    if (count($all_category_data_array) > 0)
    {
        foreach ($all_category_data_array as $all_category_table_data)
        {
            $row_id = $all_category_table_data['id'];
            $title = $all_category_table_data['title'];
            $category_name = $all_category_table_data['category_name'];
            $payment_status = $all_category_table_data['payment_status'];
            $price = $all_category_table_data['price'];
            $validate_days = $all_category_table_data['validate_days'];
            $status = $all_category_table_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;
            $nestedData[] = $title;
            $nestedData[] = $category_name;
            $nestedData[] = $price;
            $nestedData[] = $validate_days.' days';
            if ($payment_status == 'Paid')
            {
                $nestedData[] = '<span class="btn btn-success" style="font-size: 9px; padding: 3px;">Paid</span>';
            }
            else
            {
                $nestedData[] = '<span class="btn btn-danger" style="font-size: 9px; padding: 3px;">Unpaid</span>';
            }
            if ($status == '1')
            {
                $nestedData[] = '<span class="btn btn-success" style="font-size: 9px; padding: 3px;">Active</span>';
            }
            else
            {
                $nestedData[] = '<span class="btn btn-danger" style="font-size: 9px; padding: 3px;">Inactive</span>';
            }

           

            $nestedData[] = '
                <center>
                    <a href="' . $base_url1 . 'edit-brand-post/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    &nbsp;&nbsp;
                    <a onclick="delete_row(' . $row_id . ')" class="tooltip_class" title="Remove" data-popup="tooltip" style="cursor:pointer"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </center>';

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
        $data[] = $nestedData;
    }
    $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($total_data), "recordsFiltered" => intval($total_data), "data" => $data);
    echo json_encode($json_data);
}
?>
