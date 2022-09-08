<?php
include('common/config.php');
include "common/check_login.php";
if ($admin == 1)
{
    $requestData = $_REQUEST;
//    echo $requestData;
    $columns = array(
        0 => 'id',
        1 => 'user_name',
        2 => 'email',
        3 => 'password',
        4 => 'mobile',
        5 => 'user_name',
        6 => 'status',
        7 => 'id'
    );

    $custom_query = "";
    $custom_filter = "is_deleted = '0'";

    if (Secure1($db_mysqli, $requestData['search_user_name']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_user_name']);
        $custom_filter .= " and name LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_mobile']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_mobile']);
        $custom_filter .= " and mobile LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_email']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_email']);
        $custom_filter .= " and email LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_status']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_status']);
        $custom_filter .= " and status = '" . $search_status . "'";
    }
    

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_branduser_query = "SELECT *  FROM brand_user where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $result_get_branduser_query = mysqli_query($db_mysqli, $get_branduser_query);

    $count_get_branduser_query = "SELECT * FROM brand_user where $custom_filter";
    $result_count_get_branduser_query = mysqli_query($db_mysqli, $count_get_branduser_query);
    $total_data = mysqli_num_rows($result_count_get_branduser_query);

    $all_branduser_data_array = array();
    while ($row_get_branduser_query = mysqli_fetch_assoc($result_get_branduser_query))
    {
        $all_branduser_data_array[] = $row_get_branduser_query;
    }
    
    $data = array();
    if (count($all_branduser_data_array) > 0)
    {
        foreach ($all_branduser_data_array as $all_branduser_data)
        {

            $row_id = $all_branduser_data['id'];
            $user_name = $all_branduser_data['user_name'];
            $email  = $all_branduser_data['email'];
            $password  = $all_branduser_data['password'];
            $mobile = $all_branduser_data['mobile'];
            $status = $all_branduser_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;
            $nestedData[] = $user_name;
            $nestedData[] = $email;
            $nestedData[] = $password;
            $nestedData[] = $mobile;
            if ($status == '1')
            {
                $nestedData[] = '<span class="label label-success">Active</span>';
            }
            else if($status == '2')
            {
                $nestedData[] = '<span class="label label-primary">Progress</span>';
            }
            else if($status == '3')
            {
                $nestedData[] = '<span class="label label-danger">Rejected</span>';
            }
            else if($status == '4')
            {
                $nestedData[] = '<span class="label label-dark">Block</span>';
            }
            else
            {
                $nestedData[] = '<span class="label label-warning">Inactive by '.$status_by.'</span>';
            }

            $nestedData[] = '
                <center>
                 <a href="' . $base_url . 'edit-brand/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-pencil5 text-primary"></i></a>
                    &nbsp;&nbsp;
                    <a onclick="delete_row(' . $row_id . ')" class="tooltip_class" title="Remove" data-popup="tooltip"><i class="icon-trash text-danger "></i></a>
                </center>';

            $data[] = $nestedData;
        }

//        }
    }
    else
    {
        $nestedData = array();
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