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

    $movieartist_data_array = array();
    $get_movieartist_query = "select * from celebrity_details where is_deleted='0' and category_id IN(1) and status='1' order by id desc limit 6";
    $result_get_movieartist_query = mysqli_query($db_mysqli, $get_movieartist_query);
    while ($row_get_movieartist_query = mysqli_fetch_assoc($result_get_movieartist_query))
    {
        $movieartist_data_array[] = $row_get_movieartist_query;
    }

    $influencers_data_array = array();
    $get_influencers_query = "select * from celebrity_details where is_deleted='0' and category_id IN(2) and status='1' order by id desc limit 6";
    $result_get_influencers_query = mysqli_query($db_mysqli, $get_influencers_query);
    while ($row_get_influencers_query = mysqli_fetch_assoc($result_get_influencers_query))
    {
        $influencers_data_array[] = $row_get_influencers_query;
    }

    $music_data_array = array();
    $get_music_query = "select * from celebrity_details where is_deleted='0' and category_id IN(7) and status='1' order by id desc limit 6";
    $result_get_music_query = mysqli_query($db_mysqli, $get_music_query);
    while ($row_get_music_query = mysqli_fetch_assoc($result_get_music_query))
    {
        $music_data_array[] = $row_get_music_query;
    }

    $models_data_array = array();
    $get_models_query = "select * from celebrity_details where is_deleted='0' and category_id IN(4) and status='1' order by id desc limit 6";
    $result_get_models_query = mysqli_query($db_mysqli, $get_models_query);
    while ($row_get_models_query = mysqli_fetch_assoc($result_get_models_query))
    {
        $models_data_array[] = $row_get_models_query;
    }

    $athletes_data_array = array();
    $get_athletes_query = "select * from celebrity_details where is_deleted='0' and category_id IN(3) and status='1' order by id desc limit 6";
    $result_get_athletes_query = mysqli_query($db_mysqli, $get_athletes_query);
    while ($row_get_athletes_query = mysqli_fetch_assoc($result_get_athletes_query))
    {
        $athletes_data_array[] = $row_get_athletes_query;
    }

    $tvartist_data_array = array();
    $get_tvartist_query = "select * from celebrity_details where is_deleted='0' and category_id IN(6) and status='1' order by id desc limit 6";
    $result_get_tvartist_query = mysqli_query($db_mysqli, $get_tvartist_query);
    while ($row_get_tvartist_query = mysqli_fetch_assoc($result_get_tvartist_query))
    {
        $tvartist_data_array[] = $row_get_tvartist_query;
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
        $get_user_list_query = "select u.*, cp.price as celebrity_price from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where u.status='1' and u.is_deleted='0'";
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
        $get_user_list_query = "select u.*, cp.price as celebrity_price from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where c.category_id IN($category_id)  and u.status='1' and u.is_deleted='0'";
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
        $get_user_list_query = "select u.*, cp.price as celebrity_price from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where c.sub_category_id IN($subcategory_id) and u.status='1' and u.is_deleted='0'";
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
  
    if(empty($title))
    {
        $user_list_data_array = array();
        $get_user_list_query = "select u.*, cp.price as celebrity_price from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where u.status='1' and u.is_deleted='0'";
        $result_get_user_list_query = mysqli_query($db_mysqli, $get_user_list_query);
        $total_data = mysqli_num_rows($result_get_user_list_query);
        while ($row_get_user_list_query = mysqli_fetch_assoc($result_get_user_list_query))
        {
            $user_list_data_array[] = $row_get_user_list_query;
        } 
    }

    $usergiftsubsubcate_data_array = array();
    $get_usergiftsubsubcate_query = "select gss.*, g.gift_name, gs.giftsubcate_name from gift_subsubcate gss left join gift_subcat gs on gss.giftsubcat_id=gs.id left join gift_cat g on gss.gift_id=g.id where gss.giftsubsubcate_slug = '$title'  and gss.is_deleted='0'";
    $result_get_usergiftsubsubcate_query = mysqli_query($db_mysqli, $get_usergiftsubsubcate_query);
    while ($row_get_usergiftsubsubcate_query = mysqli_fetch_assoc($result_get_usergiftsubsubcate_query))
    {
        $usergiftsubsubcate_data_array[] = $row_get_usergiftsubsubcate_query;
    } 
    
    if(count($usergiftsubsubcate_data_array) > 0)
    {
        $giftsubsubcate_id = $usergiftsubsubcate_data_array[0]['id']; 
        $gift_name = $usergiftsubsubcate_data_array[0]['gift_name'];
        $giftsubcate_name = $usergiftsubsubcate_data_array[0]['giftsubcate_name'];
        $giftsubsubcate_name = $usergiftsubsubcate_data_array[0]['giftsubsubcate_name']; 
        $giftsubsubcate_slug = $usergiftsubsubcate_data_array[0]['giftsubsubcate_slug'];     
        $title = $usergiftsubsubcate_data_array[0]['meta_title']; 
        $meta_keyword = $usergiftsubsubcate_data_array[0]['meta_keyword']; 
        $meta_description = $usergiftsubsubcate_data_array[0]['meta_description'];  
        
        $user_list_data_array = array();
        $get_user_list_query = "select u.*, cp.price as celebrity_price from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where c.giftsubsubcat_id IN($giftsubsubcate_id)  and u.status='1' and u.is_deleted='0'";
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
    $get_celebrity_details_query = "select u.*,c.category_id,c.sub_category_id,c.giftcat_id,c.giftsubcat_id,c.giftsubsubcat_id,c.full_description,c.meta_title,c.meta_keyword,c.meta_description,c.language_spoken from user u left join celebrity_details c on c.celebrity_id=u.id  where u.user_unique_slug = '$celebrity_unique_slug' and u.is_deleted=0";
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
    $get_celebrityprice_query = "select s.*, cp.price, cp.discount_type, cp.discount, cp.id as celebrity_price_id from services s left join celebrity_price cp on cp.services_id=s.id  where s.is_deleted='0' and  cp.celebrity_id='$celebrity_id'";
    $result_get_celebrityprice_query = mysqli_query($db_mysqli, $get_celebrityprice_query);
    while ($row_get_celebrityprice_query = mysqli_fetch_assoc($result_get_celebrityprice_query))
    {
        $celebrityprice_data_array[] = $row_get_celebrityprice_query;
    }
    
    $celebrity_details = $celebrity_details_data_array[0];

} 
else if (($current_page == 'my-account.php') || ($current_page == 'account-information.php'))
{
   
    $user_data_array = array();
    $get_user_query = "select * from brand_user where id= '$loggedin_user_id' and status='1' and is_deleted='0'";
    $result_user_data = mysqli_query($db_mysqli, $get_user_query);
    while ($row_user_data = mysqli_fetch_assoc($result_user_data))
    {
        $user_data_array[] = $row_user_data;
        $user_data = $user_data_array[0];
    }
     
} 
?>