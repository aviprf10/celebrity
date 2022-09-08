<?php
include "common/config.php";
include "common/check_login.php";
if ($celebrity == 1)
{
    //error_reporting(-1);


    $requestData = $_REQUEST;
    $columns = array(
        0 => 'cp.id',
        1 => 'u.user_name',
        2 => 's.service_name',
        3 => 'cp.price',
        4 => 'cp.discount_type',
        5 => 'cp.discount',
        6 => 'cp.discount_price',
        7 => 'cp.status',
        8 => 'cp.id',
    );

    $custom_query = "";
    $custom_filter = "u.is_deleted= '0' and cp.celebrity_id='$loggedin_user_id' ";

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_category_query = "select cp.*, u.user_name, s.services_name from celebrity_price cp left join services s on cp.services_id=s.id left join user u on cp.celebrity_id=u.id where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);

    $count_get_category_query = "select cp.*, u.user_name, s.services_name from celebrity_price cp left join services s on cp.services_id=s.id left join user u on cp.celebrity_id=u.id where $custom_filter";
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
            $user_name = $all_category_table_data['user_name'];
            $services_name = $all_category_table_data['services_name'];
            $price = $all_category_table_data['price'];
            $discount_type = $all_category_table_data['discount_type'];
            $discount = $all_category_table_data['discount'];
            $discount_price = $all_category_table_data['discount_price'];
            $status = $all_category_table_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;

           
            $nestedData[] = $user_name;
            $nestedData[] = $services_name;
            $nestedData[] = $price;
            $nestedData[] = $discount_type;
            $nestedData[] = $discount;
            $nestedData[] = $discount_price;
            if ($status == '1')
            {
                $nestedData[] = '<span class="label label-success">Approved</span>';
            }
            else
            {
                $nestedData[] = '<span class="label label-danger">Pendding</span>';
            }

            // $nestedData[] = '
            //     <center>
            //         <a href="' . $base_url . 'edit-celebrity-price/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-pencil5 text-primary"></i></a>
            //         &nbsp;&nbsp;
            //         <a onclick="delete_row(' . $row_id . ')" class="tooltip_class" title="Remove" data-popup="tooltip"><i class="icon-trash text-danger "></i></a>
            //     </center>';

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
        $nestedData[] = '';
        $data[] = $nestedData;
    }
    $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($total_data), "recordsFiltered" => intval($total_data), "data" => $data);
    echo json_encode($json_data);
}
?>
