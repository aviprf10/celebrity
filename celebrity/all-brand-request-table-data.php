<?php
include "common/config.php";
include "common/check_login.php";
if ($celebrity == 1)
{
    $requestData = $_REQUEST;
    $columns = array(
        0 => 'bpc.id',
        1 => 'bp.title',
        2 => 'bp.sort_description',
        3 => 'bp.price',
        4 => 'bp.validate_days',
        5 => 'bp.status',
        6 => 'bpc.id',
    );

    $custom_query = "";
    $custom_filter = "bpc.celebrity_id='$loggedin_user_id'";
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

    if (Secure1($db_mysqli, $requestData['search_title']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_title']);
        $custom_filter .= " and bp.title LIKE '%" . $search_value . "%'";
    }
    
    if (Secure1($db_mysqli, $requestData['search_status']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_status']);
        $custom_filter .= " and status = '" . $search_status . "'";
    }

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_brandequest_query = "select bpc.*, bir.request_type as request_type, bp.title, bp.sort_description, bp.price, bp.validate_days from brand_post_celebrty_list bpc left join brand_post bp on bpc.brand_post_id=bp.id left join brand_inquery_response bir on bir.brand_id=bpc.brand_post_id where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $result_get_brandequest_query = mysqli_query($db_mysqli, $get_brandequest_query);

    $count_get_brandequest_query = "select bpc.*  from brand_post_celebrty_list bpc left join brand_post bp on bpc.brand_post_id=bp.id where $custom_filter";
    $result_count_get_brandequest_query = mysqli_query($db_mysqli, $count_get_brandequest_query);
    $total_data = mysqli_num_rows($result_count_get_brandequest_query);

    $all_brandequest_data_array = array();
    while ($row_get_brandequest_query = mysqli_fetch_assoc($result_get_brandequest_query))
    {
        $all_brandequest_data_array[] = $row_get_brandequest_query;
    }


    $data = array();
    $count = 1;
    if (count($all_brandequest_data_array) > 0)
    {
        foreach ($all_brandequest_data_array as $all_brandequest_table_data)
        {
            $row_id = $all_brandequest_table_data['id'];
            $title = $all_brandequest_table_data['title'];
            $sort_description = $all_brandequest_table_data['sort_description'];
            $price = $all_brandequest_table_data['price'];
            $validate_days = $all_brandequest_table_data['validate_days'];
            $request_type = $all_brandequest_table_data['request_type'];

            $nestedData = array();
            $nestedData[] = $row_id;
             $nestedData[] = $title;
            $nestedData[] = $sort_description;
            $nestedData[] = $price;
            $nestedData[] = $validate_days;
            if ($request_type == 'Accept')
            {
                $nestedData[] = '<span class="label label-success">Accept</span>';
            }
            else if($request_type == '')
            {
                $nestedData[] = '<span class="label label-primary">Pendding</span>';
            }
            else
            {
                $nestedData[] = '<span class="label label-danger">Reject</span>';
            }

            $nestedData[] = '
                <center>
                    <a href="' . $base_url . 'brand-request-details/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-eye text-primary"></i></a>
                    &nbsp;&nbsp;
                   
                </center>';
                //<a onclick="delete_row(' . $row_id . ')" class="tooltip_class" title="Remove" data-popup="tooltip"><i class="icon-trash text-danger "></i></a >

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
        $data[] = $nestedData;
    }
    $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($total_data), "recordsFiltered" => intval($total_data), "data" => $data);
    echo json_encode($json_data);
}
?>
