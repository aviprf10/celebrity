<?php
include "common/config.php";
include "common/check_login.php";
if ($admin == 1)
{
    //error_reporting(-1);


    $requestData = $_REQUEST;
    $columns = array(
        0 => 'id',
        1 => 'user_name',
        2 => 'subject',
        3 => 'message',
        4 => 'created_on'
    );

    $custom_query = "";
    $custom_filter = "";

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_category_query = "select * from support_inquiry  $order_by LIMIT $limit_start,$limit_end";
    $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);

    $count_get_category_query = "select id from support_inquiry";
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
            $user_type = $all_category_table_data['user_type'];
            $subject = $all_category_table_data['subject'];
            $description = $all_category_table_data['description'];
            $created_on = date('d-m-Y', strtotime($all_category_table_data['created_on']));

            $nestedData = array();
            $nestedData[] = $row_id;
            $nestedData[] = $user_name;
            $nestedData[] = $user_type;
            $nestedData[] = $subject;
            $nestedData[] = $description;
            $nestedData[] = $created_on;
            
            $data[] = $nestedData;

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
