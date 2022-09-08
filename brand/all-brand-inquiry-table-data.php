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
        2 => 'u.user_name',
        3 => 'u.email',
        4 => 'bir.request_type',
        5 => 'bpc.brand_cost',
        6 => 'bpc.celebrity_brand_cost',
    );

    $custom_query = "";
    $custom_filter = "bp.is_deleted= '0' ";
    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_category_query = "select * from brand_inquery_response bir LEFT join brand_post bp on bir.brand_id=bp.id LEFT JOIN brand_post_celebrty_list bpc on bir.celebrity_id=bpc.celebrity_id left join user u on bir.celebrity_id=u.id  where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);

    $count_get_category_query = "select * from brand_inquery_response bir LEFT join brand_post bp on bir.brand_id=bp.id LEFT JOIN brand_post_celebrty_list bpc on bir.celebrity_id=bpc.celebrity_id left join user u on bir.celebrity_id=u.id where $custom_filter";
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
            $name = $all_category_table_data['name'];
            $email = $all_category_table_data['email'];
            $request_type = $all_category_table_data['request_type'];
            $celebrity_brand_cost = $all_category_table_data['celebrity_brand_cost'];
            $brand_cost = $all_category_table_data['brand_cost'];
            

            $nestedData = array();
            $nestedData[] = $row_id;

            $nestedData[] = $title;
            $nestedData[] = $name;
            $nestedData[] = '<a href="mailto:'.$email.'" style="color:blue;">'.$email.'</a>';
            $nestedData[] = $request_type;
            $nestedData[] = $selected_currency_icon.$brand_cost;
            $nestedData[] = $selected_currency_icon.$celebrity_brand_cost;
            

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
