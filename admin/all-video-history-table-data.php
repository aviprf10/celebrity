<?php
include('common/config.php');
include "common/check_login.php";
if ($admin == 1)
{
    
    $requestData = $_REQUEST;
//    echo $requestData;
    $columns = array(
        0 => 'vch.id',
        1 => 'vch.video',
        2 => 'u.user_name',
        3 => 'bp.title',
        4 => 'b.brand_name',
        5 => 'vch.created_on',
        6 => 'u.id',
        7 => 'u.id',
        8 => 'u.id',
        9 => 'u.id'
    );

    $custom_query = "";
    $custom_filter = "u.is_deleted = '0'";

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_user_query = "SELECT  vch.*, u.user_name, b.user_name as brand_name  FROM video_celebrity_history vch LEFT JOIN user u on vch.celebrity_id = u.id left join brand_post bp on vch.brand_post_id=bp.id left join brand_user b on bp.added_by=b.id where $custom_filter $order_by LIMIT $limit_start,$limit_end";

    $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);

    $count_get_user_query = "SELECT  vch.*, u.user_name, b.user_name as brand_name FROM video_celebrity_history vch LEFT JOIN user u on vch.celebrity_id = u.id left join brand_post bp on vch.brand_post_id=bp.id left join brand_user b on bp.added_by=b.id where $custom_filter";
    $result_count_get_user_query = mysqli_query($db_mysqli, $count_get_user_query);
    $total_data = mysqli_num_rows($result_count_get_user_query);

    $all_user_data_array = array();
    while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
    {
        $all_user_data_array[] = $row_get_user_query;
    }
    
    $data = array();
    if (count($all_user_data_array) > 0)
    {
        foreach ($all_user_data_array as $all_user_data)
        {

            $row_id = $all_user_data['id'];
            $video = $all_user_data['video'];
            $user_name  = $all_user_data['user_name'];
            $title  = $all_user_data['title'];
            $brand_name = $all_user_data['brand_name'];
            $created_on = date('d-m-Y', strtotime($all_user_data['created_on']));
            $brand_apporved = $all_user_data['brand_apporved'];
            $admin_approved = $all_user_data['admin_approved'];
            

            $nestedData = array();
            $nestedData[] = $row_id;
            $nestedData[] = '<video width="320" height="240" controls>
                                <source src="'.$cele_base_path_uploads.'celebrity-video/'.$video.'" type="video/mp4">
                                <source src="movie.ogg" type="video/ogg">
                            </video>';
            $nestedData[] = $user_name;
            $nestedData[] = $title;
            $nestedData[] = $brand_name;
            $nestedData[] = $created_on;
            if($admin_approved == 1)
            {
                $nestedData[] = '<span class="label label-success">Active</span>';
            }
            else 
            {
                $nestedData[] = '<span class="label label-primary">Pending</span>';
            }
            if($brand_apporved == 1)
            {
                $nestedData[] = '<span class="label label-success">Active</span>';
            }
            else 
            {
                $nestedData[] = '<span class="label label-primary">Pending</span>';
            }
            $nestedData[] = '
                <center>
                 <a href="' . $base_url . 'edit-video-history/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-pencil5 text-primary"></i></a>
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