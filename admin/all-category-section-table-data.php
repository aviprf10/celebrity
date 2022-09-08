<?php
include('common/config.php');
include "common/check_login.php";
if ($admin == 1)
{
    $requestData = $_REQUEST;
//    echo $requestData;
    $columns = array(
        0 => 'id',
        1 => 'id',
        2 => 'id',
        
    );

    $custom_query = "";
    //$custom_filter = "c.is_deleted = '0'";

    // $limit_start = $requestData['start'];
    // $limit_end = $requestData['length'];
    // $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_categorysection_query = "SELECT * FROM display_category_wise_section";
    $result_get_categorysection_query = mysqli_query($db_mysqli, $get_categorysection_query);

    $count_get_categorysection_query = "SELECT * FROM display_category_wise_section";
    $result_count_get_categorysection_query = mysqli_query($db_mysqli, $count_get_categorysection_query);
    $total_data = mysqli_num_rows($result_count_get_categorysection_query);

    $all_categorysection_data_array = array();
    while ($row_get_categorysection_query = mysqli_fetch_assoc($result_get_categorysection_query))
    {
        $all_categorysection_data_array[] = $row_get_categorysection_query;
    }
    
    $data = array();
    if (count($all_categorysection_data_array) > 0)
    {
        foreach ($all_categorysection_data_array as $all_categorysection_data)
        {

            $row_id = $all_categorysection_data['id'];
            $category_id = $all_categorysection_data['category_id'];
            
            $all_category_data_array = array();
            $get_category_query = "SELECT * FROM category where id IN ($category_id)";
            $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);
            while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
            {
                $all_category_data_array[] = $row_get_category_query;
            }

            $name_arr='';
            foreach($all_category_data_array as $all_category_data)
            {
                $name_arr .= $all_category_data['category_name'].' ,';
            }
            $name = substr($name_arr, 0,-1);
            $nestedData = array();
            $nestedData[] = $row_id;
            $nestedData[] = $name;
           
            $nestedData[] = '
                <center>
                 <a href="' . $base_url . 'edit-category-section/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-pencil5 text-primary"></i></a>
                    &nbsp;&nbsp;
                   
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