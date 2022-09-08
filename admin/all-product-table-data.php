<?php
include "common/config.php";
include "common/check_login.php";
if ($admin == 1)
{
    //error_reporting(-1);


    $requestData = $_REQUEST;
    $columns = array(
        0 => 'p.id',
        1 => 'p.category_id',
        2 => 'p.product_name',
        3 => 'p.sort_description',
        4 => 'p.status',
        5 => 'p.id',
    );

    $custom_query = "";
    $custom_filter = "p.is_deleted= '0' ";


    if (Secure1($db_mysqli, $requestData['search_category_title']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_category_title']);
        $custom_filter .= " and c.category_name LIKE '%" . $search_value . "%'";
    }

    
    if (Secure1($db_mysqli, $requestData['search_product_name']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_product_name']);
        $custom_filter .= " and p.product_name LIKE '%" . $search_value . "%'";
    }

    if (Secure1($db_mysqli, $requestData['search_product_description']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_product_description']);
        $custom_filter .= " and p.sort_description LIKE '%" . $search_value . "%'";
    }
    
    if (Secure1($db_mysqli, $requestData['search_status']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_status']);
        $custom_filter .= " and p.status = '" . $search_status . "'";
    }

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_product_query = "select p.*, c.category_name from product p  LEFT JOIN category c on p.category_id = c.id  where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $result_get_product_query = mysqli_query($db_mysqli, $get_product_query);

    $count_get_product_query = "select * from product p  LEFT JOIN category c on p.category_id = c.id  where $custom_filter";
    $result_count_get_product_query = mysqli_query($db_mysqli, $count_get_product_query);
    $total_data = mysqli_num_rows($result_count_get_product_query);

    $all_product_data_array = array();
    while ($row_get_product_query = mysqli_fetch_assoc($result_get_product_query))
    {
        $all_product_data_array[] = $row_get_product_query;
    }


    $data = array();
    $count = 1;
    if (!empty($all_product_data_array))
    {
        foreach ($all_product_data_array as $all_product_table_data)
        {
            $row_id = $all_product_table_data['id'];
            $category_name = $all_product_table_data['category_name'];
            $product_name = $all_product_table_data['product_name'];
            $sort_description = $all_product_table_data['sort_description'];
            $status = $all_product_table_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;

           
            $nestedData[] = $category_name;
            $nestedData[] = $product_name;
            $nestedData[] = $sort_description;
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
                    <a href="' . $base_url . 'edit-product/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-pencil5 text-primary"></i></a>
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
