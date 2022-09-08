<?php
include "common/config.php";
include "common/check_login.php";
if ($admin == 1)
{
    //error_reporting(-1);


    $requestData = $_REQUEST;
    $columns = array(
        0 => 'id',
        1 => 'services_name',
        2 => 'status',
        3 => 'id',
    );

    $custom_query = "";
    $custom_filter = "is_deleted= '0' ";
//   if(!empty($requestData['search']['value']))
//   {
//      $query_string = strtolower($requestData['search']['value']);
//      if($query_string == 'active')
//      {
//         $custom_filter .= " and status = '1'";
//      }
//      else if($query_string == 'inactive')
//      {
//         $custom_filter .= " and status = '0'";
//      }
//      else
//      {
//         $custom_filter .= " and (services_name LIKE '%".$query_string."%' or services_code LIKE '%".$query_string."%')";
//      }
//   }

    if (Secure1($db_mysqli, $requestData['search_category_title']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_category_title']);
        $custom_filter .= " and services_name LIKE '%" . $search_value . "%'";
    }
    
    if (Secure1($db_mysqli, $requestData['search_status']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_status']);
        $custom_filter .= " and status = '" . $search_status . "'";
    }

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_services_query = "select * from services where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $result_get_services_query = mysqli_query($db_mysqli, $get_services_query);

    $count_get_services_query = "select id from services where $custom_filter";
    $result_count_get_services_query = mysqli_query($db_mysqli, $count_get_services_query);
    $total_data = mysqli_num_rows($result_count_get_services_query);

    $all_services_data_array = array();
    while ($row_get_services_query = mysqli_fetch_assoc($result_get_services_query))
    {
        $all_services_data_array[] = $row_get_services_query;
    }


    $data = array();
    $count = 1;
    if (count($all_services_data_array) > 0)
    {
        foreach ($all_services_data_array as $all_services_table_data)
        {
            $row_id = $all_services_table_data['id'];
            $services_name = $all_services_table_data['services_name'];
            $status = $all_services_table_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;

           
            $nestedData[] = $services_name;
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
                    <a href="' . $base_url . 'edit-services/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-pencil5 text-primary"></i></a>
                    &nbsp;&nbsp;
                    <a onclick="delete_row(' . $row_id . ')" class="tooltip_class" title="Remove" data-popup="tooltip"><i class="icon-trash text-danger "></i></a>
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
        $nestedData[] = '
            <td valign = "top" colspan = "4" class="dataTables_empty">
                <center>
                    <h6><i style = "font-size: 60px;    color: #999;" class="  icon-warning22"></i></h6>
                    <h4 class="no-margin text-semibold" style = "    color: #999;"> No Records Found!</h4>
                </center>
            </td>';
        $nestedData[] = '';
        $nestedData[] = '';
        $data[] = $nestedData;
    }
    $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($total_data), "recordsFiltered" => intval($total_data), "data" => $data);
    echo json_encode($json_data);
}
?>
