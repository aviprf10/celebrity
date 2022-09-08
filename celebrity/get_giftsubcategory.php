<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($celebrity == 1)
{
    if ($_POST)
    {
        $giftcate_id = Secure1($db_mysqli, $_POST['giftcat_id']);
        
        $get_gift_subcat_query = "SELECT * from gift_subcat WHERE giftcate_id IN($giftcate_id) and is_deleted='0'";
        $result_get_gift_subcat_query = mysqli_query($db_mysqli, $get_gift_subcat_query);
        $all_gift_subcat_data_array = array();
        while ($row_get_gift_subcat_query = mysqli_fetch_assoc($result_get_gift_subcat_query))
        {
            $all_gift_subcat_data_array[] = $row_get_gift_subcat_query;
        }

        $html_message = ' <div class="form-group">
            <label>Select Gift Sub Category : <span class="text-danger">*</span></label>
                <select class="select-search form-control" id="giftsubcat_id" name="giftsubcat_id[]"  multiple="multiple" data-placeholder="Select a Gift sub Category..." onchange="get_giftsubsubcategory();">
                    <option></option>';
        foreach ($all_gift_subcat_data_array as $all_gift_subcat_data)
        {
            $html_message .= '<option value="' . $all_gift_subcat_data['id'] . '">' . $all_gift_subcat_data['giftsubcate_name'] . '</option>';
        }

        $html_message .= '
                 </select>
             </div>';


        $return["html_message"] = $html_message;
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