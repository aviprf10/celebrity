<?php
include('common/config.php');
include "common/check_login.php";
if ($admin == 1)
{
    $requestData = $_REQUEST;
    $columns = array(
        0 => 'id',
        1 => 'name',
        2 => 'code',
        3 => 'status',
        4 => 'id'
    );

    $custom_query = "";
    $custom_filter = "is_deleted = '0' ";

    if (Secure1($db_mysqli, $requestData['search_title1']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_title1']);
        $custom_filter .= " and name LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_title2']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_title2']);
        $custom_filter .= " and code LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_status']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_status']);
        $custom_filter .= " and status = '" . $search_status . "'";
    }

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_branch_query = "select * from branch where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $result_get_branch_query = mysqli_query($db_mysqli, $get_branch_query);

    $count_get_branch_query = "select id from branch where $custom_filter";
    $result_count_get_branch_query = mysqli_query($db_mysqli, $count_get_branch_query);
    $total_data = mysqli_num_rows($result_count_get_branch_query);

    $all_branch_data_array = array();
    while ($row_get_branch_query = mysqli_fetch_assoc($result_get_branch_query))
    {
        $all_branch_data_array[] = $row_get_branch_query;
    }

    $data = array();
    if (count($all_branch_data_array) > 0)
    {
        foreach ($all_branch_data_array as $all_branch_data)
        {
            $row_id = $all_branch_data['id'];
            $name = $all_branch_data['name'];
            $code = $all_branch_data['code'];
            $images = $all_branch_data['images'];
            $status = $all_branch_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;
            $nestedData[] = $name;
            $nestedData[] = $code;
            $nestedData[] = '<img src="'.$base_url_uploads.'branch-images/size_extra_small/'.$images.'" style="width:125px;">';
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
                    <a href="' . $base_url . 'edit-branch/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-pencil5 text-primary"></i></a>
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
                    <h4 class="no-margin text-semibold" style = "color: #999;"> No Records Found!</h4>
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