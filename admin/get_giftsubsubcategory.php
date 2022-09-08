<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if ($_POST)
    {
        $giftsubcat_id = Secure1($db_mysqli, $_POST['giftsubcat_id']);
        
        $get_gift_subsubcate_query = "SELECT * from gift_subsubcate WHERE giftsubcat_id IN ($giftsubcat_id) and is_deleted='0'";
        $result_get_gift_subsubcate_query = mysqli_query($db_mysqli, $get_gift_subsubcate_query);
        $all_gift_subsubcate_data_array = array();
        while ($row_get_gift_subsubcate_query = mysqli_fetch_assoc($result_get_gift_subsubcate_query))
        {
            $all_gift_subsubcate_data_array[] = $row_get_gift_subsubcate_query;
        }

        $html_message = ' <div class="form-group">
            <label>Select Gift Sub Subcategory :</label>
                <select class="select-search form-control" id="giftsubsubcat_id"  multiple="multiple" name="giftsubsubcat_id[]" data-placeholder="Select a Gift Sub Subcategory...">
                    <option></option>';
        foreach ($all_gift_subsubcate_data_array as $all_gift_subsubcate_data)
        {
            $html_message .= '<option value="' . $all_gift_subsubcate_data['id'] . '">' . $all_gift_subsubcate_data['giftsubsubcate_name'] . '</option>';
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