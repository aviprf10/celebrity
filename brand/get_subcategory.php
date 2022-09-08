<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');

if ($brand == 1)
{
    if ($_POST)
    {
        
        $html_message = '';
        $html_messages ='';
        $category_id = Secure1($db_mysqli, $_POST['category_id']);
        if($category_id !='')
        { 
             $get_sub_category_query = 'SELECT * from sub_category WHERE CONCAT(",", `category_id`, ",") REGEXP ",('.$category_id.')," and is_deleted=0';
            $result_get_sub_category_query = mysqli_query($db_mysqli, $get_sub_category_query);
            $all_sub_category_data_array = array();
            while ($row_get_sub_category_query = mysqli_fetch_assoc($result_get_sub_category_query))
            {
                $all_sub_category_data_array[] = $row_get_sub_category_query;
            }
            
           
            if(count($all_sub_category_data_array) > 0)
            {
                $html_message .= ' <div class="form-group">
                    <label>Select Sub Category : </label>
                        <select class="select-search form-control" id="sub_category_id"  multiple="multiple" name="sub_category_id[]" placeholder="Select a Sub Category..." onchange="get_celebritydetails();">
                          ';
                foreach ($all_sub_category_data_array as $all_sub_category_data)
                {
                    $html_message .= '<option value="' . $all_sub_category_data['id'] . '">' . $all_sub_category_data['sub_category_name'] . '</option>';
                }

                $html_message .= '
                        </select>
                    </div>';
                $all_celebritydetails_data_array = array();
                $get_celebritydetails_query = "SELECT * from celebrity_details cd left join user u on u.id=cd.celebrity_id WHERE cd.category_id IN($category_id) and u.is_deleted=0 group by u.id";
                $result_get_celebritydetails_query = mysqli_query($db_mysqli, $get_celebritydetails_query);
                while ($row_get_celebritydetails_query = mysqli_fetch_assoc($result_get_celebritydetails_query))
                {
                    $all_celebritydetails_data_array[] = $row_get_celebritydetails_query;
                }

                if(count($all_celebritydetails_data_array) > 0)
                {
                    
                    $html_messages .='<div class="col-md-12">
                                <table width="100%" border="1">
                                    <th style="text-align: center; padding: 8px;"></th>
                                    <th style="text-align: center; padding: 8px;">Sr. No.</th>
                                    <th style="text-align: center; padding: 8px;">Profile Pic</th>
                                    <th style="text-align: center; padding: 8px;">Name</th>
                                    <th style="text-align: center; padding: 8px;">Category</th>
                                    <th style="text-align: center; padding: 8px;">Instagram</th>
                                    <th style="text-align: center; padding: 8px;">Collaboration Brand Cost</th>
                                    <th style="text-align: center; padding: 8px;">Our Brand Cost</th>';
                    $i=1;  
                    foreach($all_celebritydetails_data_array as $all_celebritydetailsdata)
                    {
                        
                        $all_category_data_array = array();
                        $category = $all_celebritydetailsdata['category_id'];
                        $get_category_query = "SELECT * FROM category WHERE id IN($category) and is_deleted='0'";
                        $result_get_category_query = mysqli_query($db_mysqli, $get_category_query);
                        while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
                        {
                            $all_category_data_array[] = $row_get_category_query;
                        }
                    
                        $cate_arr = array();
                        $cate_idarr = array();
                        foreach($all_category_data_array as $all_category_data)
                        {
                            $cate_arr[]= $all_category_data['category_name'];
                            $cate_idarr[]= $all_category_data['id'];
                        }
                        $category_name = implode(",",$cate_arr);;
                        $categoryID = implode(",",$cate_idarr);;
                        $n = $all_celebritydetailsdata['follower_count']; 
                        if ($n < 900) {
                        // Default
                            $n_format = number_format($n);
                        } else if ($n < 900000) {
                        // Thausand
                        $n_format = number_format($n / 1000, $precision). 'K';
                        } else if ($n < 900000000) {
                        // Million
                        $n_format = number_format($n / 1000000, $precision). 'M';
                        } else if ($n < 900000000000) {
                        // Billion
                        $n_format = number_format($n / 1000000000, $precision). 'B';
                        } else {
                            // Trillion
                            $n_format = number_format($n / 1000000000000, $precision). 'T';
                        }
                    
                        $profile_pic = $cele_base_path_uploads.'profile-pic/temp_file/'.$all_celebritydetailsdata['profile_pic'];
                        $html_messages .='
                        <tr>
                            <td style="text-align: center; padding:8px;"><input type="checkbox" name="is_checked['.$i.']" id="is_checked_'.$i.'" onchange="getValue(this.value)" value="'.$i.'"></td>
                            <td style="text-align: center;">'.$i.'</td>
                            <td style="text-align: center;"><img src="'.$profile_pic.'" style="width:80px; padding: 10px;"></td>
                            <td style="text-align: center; padding:8px;">'.$all_celebritydetailsdata['user_name'].'('.$n_format.')</td>
                            <td style="text-align: center; padding:8px;">'.$category_name.'</td>
                            <td style="text-align: center; padding:8px;"><a href="'.$all_celebritydetailsdata['instagram_link'].'" target="_blank">'.$all_celebritydetailsdata['instagram_link'].'</td>
                            <td style="text-align: center; padding:8px;">'.$all_celebritydetailsdata['brand_celebration_price'].'</td>
                            <td style="text-align: center; padding:8px;"><input type="text" name="brand_cost['.$i.']" id="brand_cost_'.$i.'" placeholder="Our Brand Cost" class="form-control"></td>
                            <input type="hidden" name="celebrity_id['.$i.']" value="'.$all_celebritydetailsdata['celebrity_id'].'">
                            <input type="hidden" name="profile_pic['.$i.']"value="'.$all_celebritydetailsdata['profile_pic'].'">
                            <input type="hidden" name="name['.$i.']" value="'.$all_celebritydetailsdata['user_name'].'">
                            <input type="hidden" name="celebritycategory_id['.$i.']" value="'.$categoryID.'">
                            <input type="hidden" name="insta_id['.$i.']" value="'.$all_celebritydetailsdata['instagram_link'].'">
                            <input type="hidden" name="celebrity_brand_cost['.$i.']" id="celebrity_brand_cost_'.$i.'" value="'.$all_celebritydetailsdata['brand_celebration_price'].'">
                        </tr>';
                        $i++;
                        
                    }
                    $html_messages.='</table></div>';
                }

            }        


            $return["html_message"] = $html_message;
            $return["html_messages"] = $html_messages;
            $return["status"] = "success";
            echo json_encode($return);
            exit();
        }

        $return["html_message"] = $html_message;
        $return["html_messages"] = $html_messages;
        $return["status"] = "success";
        echo json_encode($return);
        exit();
        
    }
    else
    {
        $return["html_message"] = 'Some Error Occured! Please try again.';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }
}
else
{
    $return["html_message"] = 'Please login.';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}
?>