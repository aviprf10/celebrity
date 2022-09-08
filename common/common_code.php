<?php
$celebrity_details_data_array = array();
$get_celebrity_details_query = "select * from celebrity_details where is_deleted='0'";
$result_get_celebrity_details_query = mysqli_query($db_mysqli, $get_celebrity_details_query);
while ($row_get_celebrity_details_query = mysqli_fetch_assoc($result_get_celebrity_details_query))
{
    $celebrity_details_data_array[] = $row_get_celebrity_details_query;
}
$celebritydetails_data = array();
$array_uni=array();
foreach($celebrity_details_data_array as $celebrity_details_data)
{
    $celebritydetails_data = array_merge($celebritydetails_data, explode(",", $celebrity_details_data['category_id']));
    $celebritydetailssub_data = array_merge($celebritydetails_data, explode(",", $celebrity_details_data['sub_category_id']));
}

$uniquePids = array_unique($celebritydetails_data);
$categ_id = implode(',',array_values(array_unique($uniquePids)));

$uniquePSBids = array_unique($celebritydetailssub_data);
$subcateg_id = implode(',',array_values(array_unique($uniquePSBids)));

$category_data_array = array();
$get_category_query = "SELECT * FROM `category` where is_deleted='0'and id IN($categ_id)";
$result_get_category_query = mysqli_query($db_mysqli, $get_category_query);
while ($row_get_category_query = mysqli_fetch_assoc($result_get_category_query))
{
    $category_data_array[] = $row_get_category_query;
}

$gift_cat_data_array = array();
$get_gift_cat_query = "select * from gift_cat where is_deleted='0' order by id asc";
$result_get_gift_cat_query = mysqli_query($db_mysqli, $get_gift_cat_query);
while ($row_get_gift_cat_query = mysqli_fetch_assoc($result_get_gift_cat_query))
{
    $gift_cat_data_array[] = $row_get_gift_cat_query;
}
?>
<?php 
if($current_page == 'index.php')
{
    $homebanner_data_array = array();
    $get_homebanner_query = "select * from home_banner where is_deleted='0' order by id desc";
    $result_get_homebanner_query = mysqli_query($db_mysqli, $get_homebanner_query);
    while ($row_get_homebanner_query = mysqli_fetch_assoc($result_get_homebanner_query))
    {
        $homebanner_data_array[] = $row_get_homebanner_query;
    }
  
    $giftsubsubcate_data_array = array();
    $get_giftsubsubcate_query = "select * from gift_subsubcate where is_deleted='0' and status='1'";
    $result_get_giftsubsubcate_query = mysqli_query($db_mysqli, $get_giftsubsubcate_query);
    while ($row_get_giftsubsubcate_query = mysqli_fetch_assoc($result_get_giftsubsubcate_query))
    {
        $giftsubsubcate_data_array[] = $row_get_giftsubsubcate_query;
    }

}
else if($current_page == 'celebrity-list.php')
{
    $total_data = 0;
    $title = $_GET['title'];
   
    if(empty($title))
    {
        $user_list_data_array = array();
        $get_user_list_query = "select u.*, cp.price as celebrity_price, cp.status as price_status,cp.discount_type, cp.discount from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where u.status='1' and u.is_deleted='0' and u.user_type='2' and cp.price > '0' group by u.id";
        $result_get_user_list_query = mysqli_query($db_mysqli, $get_user_list_query);
        $total_data = mysqli_num_rows($result_get_user_list_query);
        while ($row_get_user_list_query = mysqli_fetch_assoc($result_get_user_list_query))
        {
            $user_list_data_array[] = $row_get_user_list_query;
        } 
    }
    $usercategory_data_array = array();
    $get_usercategory_query = "select * from category where category_unique_slug = '$title'  and is_deleted='0'";
    $result_get_usercategory_query = mysqli_query($db_mysqli, $get_usercategory_query);
    while ($row_get_usercategory_query = mysqli_fetch_assoc($result_get_usercategory_query))
    {
        $usercategory_data_array[] = $row_get_usercategory_query;
    } 
    
    if(count($usercategory_data_array) > 0)
    {
        $category_id = $usercategory_data_array[0]['id']; 
        $category_name = $usercategory_data_array[0]['category_name']; 
        $category_unique_slug = $usercategory_data_array[0]['category_unique_slug'];     
        $title = $usercategory_data_array[0]['meta_title']; 
        $meta_keyword = $usercategory_data_array[0]['meta_keyword']; 
        $meta_description = $usercategory_data_array[0]['meta_description'];  
        
        $user_list_data_array = array();
        $get_user_list_query = 'select u.*, cp.price as celebrity_price, cp.status as price_status, cp.discount_type, cp.discount from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where CONCAT(",", c.category_id, ",") REGEXP ",('.$category_id.')," and u.status="1" and u.is_deleted="0" and u.user_type="2" and cp.price > "0" group by u.id';
        $result_get_user_list_query = mysqli_query($db_mysqli, $get_user_list_query);
        $total_data = mysqli_num_rows($result_get_user_list_query);
        while ($row_get_user_list_query = mysqli_fetch_assoc($result_get_user_list_query))
        {
            $user_list_data_array[] = $row_get_user_list_query;
        } 
    }

    $subcategory_data_array = array();
    $get_subcategory_query = "select sc.*, c.category_name from sub_category sc left join category c on c.id=sc.category_id where sc.sub_category_unique_slug='$title' and sc.is_deleted='0'";
    $result_get_subcategory_query = mysqli_query($db_mysqli, $get_subcategory_query);
    while ($row_get_subcategory_query = mysqli_fetch_assoc($result_get_subcategory_query))
    {
        $subcategory_data_array[] = $row_get_subcategory_query;
    } 
   
    if(count($subcategory_data_array) > 0)
    {
        $subcategory_id = $subcategory_data_array[0]['id'];
        $category_id = $subcategory_data_array[0]['category_id'];
        $category_name = $subcategory_data_array[0]['category_name']; 
        $sub_category_name = $subcategory_data_array[0]['sub_category_name']; 
        $category_unique_slug = $subcategory_data_array[0]['sub_category_unique_slug'];  
        $title = $subcategory_data_array[0]['meta_title']; 
        $meta_keyword = $subcategory_data_array[0]['meta_keyword']; 
        $meta_description = $subcategory_data_array[0]['meta_description']; 
        
        $user_list_data_array = array();
        $get_user_list_query = 'select u.*, cp.price as celebrity_price, cp.status as price_status, cp.discount_type, cp.discount from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where CONCAT(",", c.sub_category_id, ",") REGEXP ",('.$subcategory_id.'),"  and u.status="1" and u.is_deleted="0" and u.user_type="2" and cp.price > "0" group by u.id';
        $result_get_user_list_query = mysqli_query($db_mysqli, $get_user_list_query);
        $total_data = mysqli_num_rows($result_get_user_list_query);
        while ($row_get_user_list_query = mysqli_fetch_assoc($result_get_user_list_query))
        {
            $user_list_data_array[] = $row_get_user_list_query;
        } 
    }

    
} 
else if($current_page == 'gifting.php')
{
    $total_data = 0;
    $title_arr = explode('-', $_GET['title']);
    $title = $title_arr[4];
    if(isset($title_arr[5]))
    {
        $title = $title_arr[4].'-'.$title_arr[5];
    }
  
    if(empty($title))
    {
        $user_list_data_array = array();
        $get_user_list_query = "select u.*, cp.price as celebrity_price, cp.status as price_status, cp.discount_type, cp.discount from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where u.status='1' and u.is_deleted='0' and u.user_type='2' and cp.price > '0' group by u.id";
        $result_get_user_list_query = mysqli_query($db_mysqli, $get_user_list_query);
        $total_data = mysqli_num_rows($result_get_user_list_query);
        while ($row_get_user_list_query = mysqli_fetch_assoc($result_get_user_list_query))
        {
            $user_list_data_array[] = $row_get_user_list_query;
        } 
    }

    $usergiftcate_data_array = array();
    $get_usergiftcate_query = "select * from gift_cat where gift_slug = '$title'  and is_deleted='0'";
    $result_get_usergiftcate_query = mysqli_query($db_mysqli, $get_usergiftcate_query);
    while ($row_get_usergiftcate_query = mysqli_fetch_assoc($result_get_usergiftcate_query))
    {
        $usergiftcate_data_array[] = $row_get_usergiftcate_query;
    }

    if(count($usergiftcate_data_array) > 0)
    {
        $id = $usergiftcate_data_array[0]['id'];
        $gift_name = $usergiftcate_data_array[0]['gift_name']; 
        $gift_slug = $usergiftcate_data_array[0]['gift_slug'];     
        $title = $usergiftcate_data_array[0]['meta_title']; 
        $meta_keyword = $usergiftcate_data_array[0]['meta_keyword']; 
        $meta_description = $usergiftcate_data_array[0]['meta_description'];  
        
        $user_list_data_array = array();
        $get_user_list_query = 'select u.*, cp.price as celebrity_price, cp.status as price_status, cp.discount_type, cp.discount from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where CONCAT(",", c.giftcat_id, ",") REGEXP ",('.$id.'),"  and u.status="1" and u.is_deleted="0" and u.user_type="2" and cp.price > "0" group by u.id';
        $result_get_user_list_query = mysqli_query($db_mysqli, $get_user_list_query);
        $total_data = mysqli_num_rows($result_get_user_list_query);
        while ($row_get_user_list_query = mysqli_fetch_assoc($result_get_user_list_query))
        {
            $user_list_data_array[] = $row_get_user_list_query;
        } 
    }


    $usergiftsubcate_data_array = array();
    $get_usergiftsubcate_query = "select * from gift_subcat where giftsubcate_slug = '$title'  and is_deleted='0'";
    $result_get_usergiftsubcate_query = mysqli_query($db_mysqli, $get_usergiftsubcate_query);
    while ($row_get_usergiftsubcate_query = mysqli_fetch_assoc($result_get_usergiftsubcate_query))
    {
        $usergiftsubcate_data_array[] = $row_get_usergiftsubcate_query;
    }

    if(count($usergiftsubcate_data_array) > 0)
    {
        $id = $usergiftsubcate_data_array[0]['id'];
        $gift_name = $usergiftsubcate_data_array[0]['giftsubcate_name']; 
        $gift_slug = $usergiftsubcate_data_array[0]['giftsubcate_slug'];     
        $title = $usergiftsubcate_data_array[0]['meta_title']; 
        $meta_keyword = $usergiftsubcate_data_array[0]['meta_keyword']; 
        $meta_description = $usergiftsubcate_data_array[0]['meta_description'];  
        
        $user_list_data_array = array();
        $get_user_list_query = 'select u.*, cp.price as celebrity_price, cp.status as price_status, cp.discount_type, cp.discount from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where CONCAT(",", c.giftsubcat_id, ",") REGEXP ",('.$id.'),"  and u.status="1" and u.is_deleted="0" and u.user_type="2" and cp.price > "0" group by u.id';
        $result_get_user_list_query = mysqli_query($db_mysqli, $get_user_list_query);
        $total_data = mysqli_num_rows($result_get_user_list_query);
        while ($row_get_user_list_query = mysqli_fetch_assoc($result_get_user_list_query))
        {
            $user_list_data_array[] = $row_get_user_list_query;
        } 
    }

    $usergiftsubsubcate_data_array = array();
    $get_usergiftsubsubcate_query = "select * from gift_subsubcate where giftsubsubcate_slug = '$title'  and is_deleted='0'";
    $result_get_usergiftsubsubcate_query = mysqli_query($db_mysqli, $get_usergiftsubsubcate_query);
    while ($row_get_usergiftsubsubcate_query = mysqli_fetch_assoc($result_get_usergiftsubsubcate_query))
    {
        $usergiftsubsubcate_data_array[] = $row_get_usergiftsubsubcate_query;
    } 
    
    if(count($usergiftsubsubcate_data_array) > 0)
    {
        $id = $usergiftsubsubcate_data_array[0]['id'];
        $gift_name = $usergiftsubsubcate_data_array[0]['giftsubcate_name'];
        $gift_slug = $usergiftsubsubcate_data_array[0]['giftsubsubcate_slug'];     
        $title = $usergiftsubsubcate_data_array[0]['meta_title']; 
        $meta_keyword = $usergiftsubsubcate_data_array[0]['meta_keyword']; 
        $meta_description = $usergiftsubsubcate_data_array[0]['meta_description'];  
        
        $user_list_data_array = array();
        $get_user_list_query = 'select u.*, cp.price as celebrity_price, cp.status as price_status, cp.discount_type, cp.discount from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where CONCAT(",", c.giftsubsubcat_id, ",") REGEXP ",('.$id.'),"  and u.status="1" and u.is_deleted="0" and u.user_type="2" and cp.price > "0" group by u.id';
        $result_get_user_list_query = mysqli_query($db_mysqli, $get_user_list_query);
        $total_data = mysqli_num_rows($result_get_user_list_query);
        while ($row_get_user_list_query = mysqli_fetch_assoc($result_get_user_list_query))
        {
            $user_list_data_array[] = $row_get_user_list_query;
        } 
    }
    
} 
else if ($current_page == 'celebrity-details.php')
{
    $celebrity_unique_slug = Secure1($db_mysqli, $_GET['title']);
    $celebrity_details_data_array = array();
    $get_celebrity_details_query = "select u.*,c.category_id,c.sub_category_id,c.giftcat_id,c.giftsubcat_id,c.giftsubsubcat_id,c.full_description,c.meta_title,c.meta_keyword,c.meta_description,c.language_spoken, c.is_pramotion from user u left join celebrity_details c on c.celebrity_id=u.id  where u.user_unique_slug = '$celebrity_unique_slug' and u.is_deleted=0 and u.user_type='2'";
    $res_get_celebrity_details_query = mysqli_query($db_mysqli, $get_celebrity_details_query);
    while ($row_celebrity_details = mysqli_fetch_assoc($res_get_celebrity_details_query))
    {
        $celebrity_details_data_array[] = $row_celebrity_details;
    }

    $celebrity_id = $celebrity_details_data_array[0]['id'];
    $category_id = $celebrity_details_data_array[0]['category_id'];
    $sub_category_id = $celebrity_details_data_array[0]['sub_category_id'];
    $image_celebrity_data_array = array();
    $image_get_celebrity_query = "select * from celebrity_images where is_deleted='0' and celebrity_id='$celebrity_id'";
    $image_result_get_celebrity_query = mysqli_query($db_mysqli, $image_get_celebrity_query);
    while ($image_row_get_celebrity_query = mysqli_fetch_assoc($image_result_get_celebrity_query))
    {
        $image_celebrity_data_array[] = $image_row_get_celebrity_query;
    }

    $image_celebrityprice_data_array = array();
    $image_get_celebrityprice_query = "select * from celebrity_price where celebrity_id='$celebrity_id'";
    $image_result_get_celebrityprice_query = mysqli_query($db_mysqli, $image_get_celebrityprice_query);
    while ($image_row_get_celebrityprice_query = mysqli_fetch_assoc($image_result_get_celebrityprice_query))
    {
        $image_celebrityprice_data_array[] = $image_row_get_celebrityprice_query;
    }   


    $celebritycategory_data_array = array();
    $get_celebritycategory_query = "select * from category where id IN($category_id)  and is_deleted='0'";
    $result_get_celebritycategory_query = mysqli_query($db_mysqli, $get_celebritycategory_query);
    while ($row_get_celebritycategory_query = mysqli_fetch_assoc($result_get_celebritycategory_query))
    {
        $celebritycategory_data_array[] = $row_get_celebritycategory_query;
    } 
    

    $detailsubcategory_data_array = array();
    $get_detailsubcategory_query = "select * from sub_category where id IN($sub_category_id) and is_deleted='0'";
    $result_get_detailsubcategory_query = mysqli_query($db_mysqli, $get_detailsubcategory_query);
    while ($row_get_detailsubcategory_query = mysqli_fetch_assoc($result_get_detailsubcategory_query))
    {
        $detailsubcategory_data_array[] = $row_get_detailsubcategory_query;
    }
    
    $occasion_data_array = array();
    $get_occasion_query = "select * from occasion where is_deleted='0'";
    $result_get_occasion_query = mysqli_query($db_mysqli, $get_occasion_query);
    while ($row_get_occasion_query = mysqli_fetch_assoc($result_get_occasion_query))
    {
        $occasion_data_array[] = $row_get_occasion_query;
    }

    $celebrityprice_data_array = array();
    $get_celebrityprice_query = "select s.*, cp.price, cp.status as price_status, cp.discount_type, cp.discount, cp.id as celebrity_price_id from services s left join celebrity_price cp on cp.services_id=s.id  where s.is_deleted='0' and  cp.celebrity_id='$celebrity_id' and cp.price > '0'";
    $result_get_celebrityprice_query = mysqli_query($db_mysqli, $get_celebrityprice_query);
    while ($row_get_celebrityprice_query = mysqli_fetch_assoc($result_get_celebrityprice_query))
    {
        $celebrityprice_data_array[] = $row_get_celebrityprice_query;
    }
    
    $celebrity_details = $celebrity_details_data_array[0];

} 
else if (($current_page == 'my-account.php') || ($current_page == 'account-information.php') || ($current_page == 'newsletter-subscription.php') || ($current_page == 'checkout.php') || ($current_page == 'address-book.php') || ($current_page == 'add-new-address.php') || ($current_page == 'edit-address.php'))
{
   
    /* account setting content start here */
    $user_data_array = array();
    $get_user_query = "select * from user where id= '$loggedin_user_id' and status='1' and is_deleted='0'";
    $result_user_data = mysqli_query($db_mysqli, $get_user_query);
    while ($row_user_data = mysqli_fetch_assoc($result_user_data))
    {
        $user_data_array[] = $row_user_data;
        $user_data = $user_data_array[0];
    }
    
    $country_data_array = array();
    $get_country_query = "SELECT * FROM country WHERE is_deleted='0'";
    $result_country_data = mysqli_query($db_mysqli, $get_country_query);
    while ($row_country_data = mysqli_fetch_assoc($result_country_data))
    {
        $country_data_array[] = $row_country_data;
    }

     $user_address_data_array = array();
     $get_user_address_query = "select uad.*,c.id as c_id,c.city_name,s.id as s_id,s.state_name,cy.id as cy_id,cy.country_name FROM user_address uad LEFT JOIN cities c on uad.city_id=c.id LEFT JOIN states s on uad.state_id=s.id LEFT JOIN country cy on uad.country_id=cy.id WHERE uad.user_id = '$loggedin_user_id' AND uad.status = '1' AND uad.is_deleted = '0'";
     $result_user_address_data = mysqli_query($db_mysqli, $get_user_address_query);
     while ($row_user_address_data = mysqli_fetch_assoc($result_user_address_data))
     {
         $user_address_data_array[] = $row_user_address_data;
     }
    
     if ($current_page == 'edit-address.php')
     {
         $user_address_id = $_GET['id'];
         if ($user_address_id != '')
         {
             $edit_data_array = array();
             $get_user_address_query = "select * from user_address where id='$user_address_id' and is_deleted='0'";
             $result_get_user_address_query = mysqli_query($db_mysqli, $get_user_address_query);
             while ($row_get_user_address_query = mysqli_fetch_assoc($result_get_user_address_query))
             {
                 $edit_data_array[] = $row_get_user_address_query;
             }

             $country_id = $edit_data_array[0]['country_id'];
             $state_id = $edit_data_array[0]['state_id'];
             $city_id = $edit_data_array[0]['city_id'];


             $all_state_data_array = array();
             $get_state_query = "select * from states where country_id=$country_id and is_deleted='0'";
             $result_get_state_query = mysqli_query($db_mysqli, $get_state_query);
             while ($row_get_state_query = mysqli_fetch_assoc($result_get_state_query))
             {
                 $all_state_data_array[] = $row_get_state_query;
             }


             $all_city_data_array = array();
             $get_city_query = "select * from cities where state_id=$state_id and is_deleted='0'";
             $result_get_city_query = mysqli_query($db_mysqli, $get_city_query);
             while ($row_get_city_query = mysqli_fetch_assoc($result_get_city_query))
             {
                 $all_city_data_array[] = $row_get_city_query;
             }
         }
     }
} 
if ($current_page == 'my-wishlist.php')
{
    /* wishlist content start here */
    $wishlist_data_array = array();
    $get_user_wishlist_query = "select * FROM user_wishlist  WHERE user_id = '$loggedin_user_id'  LIMIT $pageLimit , $setLimit";
    $result_user_wishlist_data = mysqli_query($db_mysqli, $get_user_wishlist_query);
    while ($row_user_wishlist_data = mysqli_fetch_assoc($result_user_wishlist_data))
    {
        $wishlist_data_array[] = $row_user_wishlist_data;
    }
    /* wishlist content end here */
}
else if ($current_page == 'my-order.php')
{
    $filter_condition = '';
    $filter_condition = "where u_o.user_id='$loggedin_user_id' and u_o.is_deleted=0";
    $group_condition = "group by u_o.order_id";
    $order_condition = "order by u_o.id desc";
    $order_data_array = array();
    $order_query = "SELECT
                      u_o.*,
                      (SELECT SUM(price)
                       FROM user_order u_o1
                       WHERE u_o1.order_id = u_o.order_id) AS total_price,
                      (SELECT count(*)
                       FROM user_order u_o1
                       WHERE u_o1.order_id = u_o.order_id) AS total_celebrity,
                      group_concat(order_status)  AS order_status_list
                    FROM user_order u_o LEFT JOIN celebrity_details c ON u_o.id = c.celebrity_id
                       $filter_condition $group_condition $order_condition limit $pageLimit,$setLimit";

    $res_order_data = mysqli_query($db_mysqli, $order_query);
    while ($row_order_data = mysqli_fetch_assoc($res_order_data))
    {
        $order_data_array[] = $row_order_data;
    }
}
else if ($current_page == 'view-order.php')
{
    $celebrity_data_array = array();
    if (isset($_GET['order_id']))
    {
        $is_returnable = 0;
        $return_period = 0;
        if (count($master_settings_data_array) > 0)
        {
            $is_returnable = $master_settings_data_array[0]['is_returnable'];
            $return_period = $master_settings_data_array[0]['return_period'];
        }
        $order_id = Secure1($db_mysqli, $_GET['order_id']);
        $get_celebrity_query = "SELECT
                     u_o.*,
                     u_o_a.first_name as user_fname,
                     u_o_a.last_name as user_lname,
                     u_o_a.mobile as user_mobile,
                     u_o_a.address1,
                     u_o_a.address2,
                     u_o_a.pincode,
                     u_o_a.city,
                     u_o_a.state,
                     u_o_a.country
                   FROM user_order u_o
                     LEFT JOIN user_order_address u_o_a ON u_o.order_address_id = u_o_a.id
                   WHERE u_o.order_id = '$order_id' AND u_o.user_id = '$loggedin_user_id' ";
        $result_celebrity_data = mysqli_query($db_mysqli, $get_celebrity_query);
        while ($row_celebrity_data = mysqli_fetch_assoc($result_celebrity_data))
        {
            $celebrity_data_array[] = $row_celebrity_data;
        }


        if (count($celebrity_data_array) > 0)
        {
            if ($is_returnable == 1 && $return_period > 0)
            {
                $return_option_available = 0;
                foreach ($celebrity_data_array as $celebrity_data)
                {
                    $order_status = $celebrity_data['order_status'];
                    $return_status = $celebrity_data['return_status'];
                    $is_returnable = $celebrity_data['is_returnable'];
                    $return_till_date = $celebrity_data['return_till_date'];

                    if ($order_status != 7 && $order_status == 6 && $is_returnable == '1' && $return_till_date >= date('Y-m-d'))
                    {
                        $return_option_available = 1;
                    }

                    if ($order_status == 7 && $return_status == 1)
                    {
                        $return_option_available = 1;
                    }
                }
            }
        }
    }
}
else if ($current_page == 'return-order.php')
{
    
}
/*all cms page code*/  
if($current_page=='about-us.php' || $current_page=='privacy-policy.php' || $current_page=='terms-and-condition.php' || $current_page=='return-policy.php'  || $current_page == 'disclaimer.php')
{
  $current_page_id='';
  if($current_page=='about-us.php')
  {
    $current_page_id=1;
  }
  else if($current_page=='return-policy.php')
  {
    $current_page_id=2;
  }
  else if($current_page=='disclaimer.php')
  {
    $current_page_id=3;
  }
  else if($current_page=='privacy-policy.php')
  {
    $current_page_id=4;
  }
  else if($current_page=='terms-and-condition.php')
  {
    $current_page_id=5;
  }

  $page_data_array = array();
  $get_page_data = "select * from cms_page where id='$current_page_id' and status='1' and is_deleted='0'";
  $result_page_data = mysqli_query($db_mysqli,$get_page_data);
  while ($row_page_data = mysqli_fetch_assoc($result_page_data))
  {
    $page_data_array[] = $row_page_data;
  } 

  $image_name = '';
  $page_title = '';
  $image_link = '';
  $page_content = '';
  if(count($page_data_array)>0)
  {
    $page_data=$page_data_array[0];
    $cms_page_id = $page_data['id'];
    $image_name = $page_data['image_name'];
    $page_title = $page_data['main_title'];
    $image_link = $page_data['image_link'];
    $page_content = $page_data['page_content'];
    $page_meta_title = $page_data['meta_title'];
    $page_meta_description = $page_data['meta_description'];
    $page_meta_keywords = $page_data['search_keywords'];
  }
}
include "common/cart.php";
?>