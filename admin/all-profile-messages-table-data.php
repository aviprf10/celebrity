<?php
include('common/config.php');
include "common/check_login.php";
if ($admin == 1)
{
    $requestData = $_REQUEST;
    $columns = array(
        0 => 'm.id',
        1 => 'm.occasion_id',
        2 => 'm.celebrity_message',
        4 => 'm.status',
        5 => 'm.id'
    );

    $custom_query = "";
    $custom_filter = "m.is_deleted = '0'";

    if (Secure1($db_mysqli, $requestData['search_title']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_title']);
        $custom_filter .= " and o.occasion_title LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_messages']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_messages']);
        $custom_filter .= " and m.celebrity_message LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_status']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_status']);
        $custom_filter .= " and m.status = '" . $search_status . "'";
    }

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

//	$get_celebrity_messages_query = "select * from celebrity_messages where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $get_celebrity_messages_query = "SELECT m.*,o.occasion_title FROM celebrity_messages m LEFT JOIN occasion o on m.occasion_id=o.id
                    where $custom_filter $order_by LIMIT $limit_start,$limit_end";

    $result_get_celebrity_messages_query = mysqli_query($db_mysqli, $get_celebrity_messages_query);

//    print_r($result_get_celebrity_messages_query);
//    exit();
    $count_get_celebrity_messages_query = "SELECT
                    m.*,o.occasion_title FROM celebrity_messages m LEFT JOIN occasion o on m.occasion_id=o.id
                     where $custom_filter";
    $result_count_get_celebrity_messages_query = mysqli_query($db_mysqli, $count_get_celebrity_messages_query);
    $total_data = mysqli_num_rows($result_count_get_celebrity_messages_query);

    $all_celebrity_messages_data_array = array();
    while ($row_get_celebrity_messages_query = mysqli_fetch_assoc($result_get_celebrity_messages_query))
    {
        $all_celebrity_messages_data_array[] = $row_get_celebrity_messages_query;
    }

    $data = array();
    if (count($all_celebrity_messages_data_array) > 0)
    {
        foreach ($all_celebrity_messages_data_array as $all_celebrity_messages_data)
        {
            $row_id = $all_celebrity_messages_data['id'];
            $occasion_title = $all_celebrity_messages_data['occasion_title'];
            $celebrity_message = $all_celebrity_messages_data['celebrity_message'];
            $status = $all_celebrity_messages_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;
            $nestedData[] = $occasion_title;
            $nestedData[] = $celebrity_message;
            
            if ($status == '1')
            {
                $nestedData[] = '<span class="label label-success">Active</span>';
            }
            else
            {
                $nestedData[] = '<span class="label label-danger">Inactive</span>';
            }
            
            $nestedData[] = '
                <center>
                    <a href="' . $base_url . 'edit-profile-messages/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-pencil5 text-primary"></i></a>
                    &nbsp;&nbsp;
                    <a onclick="delete_rows(' . $row_id . ')" class="tooltip_class" title="Remove" data-popup="tooltip"><i class="icon-trash text-danger "></i></a>
                </center>';
            $data[] = $nestedData;
        }
    }
    else
    {
        $nestedData = array();
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