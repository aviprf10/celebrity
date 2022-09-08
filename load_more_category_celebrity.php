<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
$lazy_loading_catalog = 1;
include "common/common_code.php";
$sort_by = '0';
$sort_by1 = '0';
$sort_by2 = '0';
$minprice = $_POST['min_price'];
$maxprice = $_POST['max_price'];
if(isset($_POST['sort_by']))
{
   $sort_by = $_POST['sort_by'];
}

if(isset($_POST['sort_by1']))
{
   $sort_by1 = $_POST['sort_by1'];
}

if(isset($_POST['sort_by2']))
{
   $sort_by2 = $_POST['sort_by2'];
}

if(isset($_POST['sort_byservices1']))
{
   $sort_byservices = $_POST['sort_byservices1'];
}

if(isset($_POST['sort_byservices2']))
{
   $sort_byservices = $_POST['sort_byservices2'];
}

if(isset($_POST['sort_byservices3']))
{
   $sort_byservices = $_POST['sort_byservices3'];
}

if(isset($_POST['sort_byservices4']))
{
   $sort_byservices = $_POST['sort_byservices4'];
}

if(isset($_POST['sort_byservices5']))
{
   $sort_byservices = $_POST['sort_byservices5'];
}

if(isset($_POST['sort_byservices6']))
{
   $sort_byservices = $_POST['sort_byservices6'];
}

if(isset($_POST['sort_byservices7']))
{
   $sort_byservices = $_POST['sort_byservices7'];
}

if(isset($_POST['sort_byservices8']))
{
   $sort_byservices = $_POST['sort_byservices8'];
}

if(isset($_POST['sort_byservices9']))
{
   $sort_byservices = $_POST['sort_byservices9'];
}

if(isset($_POST['sort_byservices10']))
{
   $sort_byservices = $_POST['sort_byservices10'];
}

if(isset($_POST['sort_byservices11']))
{
   $sort_byservices = $_POST['sort_byservices11'];
}

if(isset($_POST['sort_byservices12']))
{
   $sort_byservices = $_POST['sort_byservices12'];
}

if(isset($_POST['sort_byservices13']))
{
   $sort_byservices = $_POST['sort_byservices13'];
}

if(isset($_POST['sort_byservices14']))
{
   $sort_byservices = $_POST['sort_byservices14'];
}

if(isset($_POST['sort_byservices15']))
{
   $sort_byservices = $_POST['sort_byservices15'];
}

if(isset($_POST['sort_byservices16']))
{
   $sort_byservices = $_POST['sort_byservices16'];
}

if(isset($_POST['sort_byservices17']))
{
   $sort_byservices = $_POST['sort_byservices17'];
}

if(isset($_POST['sort_byservices18']))
{
   $sort_byservices = $_POST['sort_byservices18'];
}

if(isset($_POST['sort_byservices19']))
{
   $sort_byservices = $_POST['sort_byservices19'];
}

if(isset($_POST['sort_byservices20']))
{
   $sort_byservices = $_POST['sort_byservices20'];
}

if(isset($_POST['sort_byservices21']))
{
   $sort_byservices = $_POST['sort_byservices21'];
}

if(isset($_POST['sort_byservices22']))
{
   $sort_byservices = $_POST['sort_byservices22'];
}

if(isset($_POST['sort_byservices23']))
{
   $sort_byservices = $_POST['sort_byservices23'];
}

if(isset($_POST['sort_byservices24']))
{
   $sort_byservices = $_POST['sort_byservices24'];
}

if(isset($_POST['sort_byservices25']))
{
   $sort_byservices = $_POST['sort_byservices25'];
}

if(isset($_POST['sort_byservices26']))
{
   $sort_byservices = $_POST['sort_byservices26'];
}

if(isset($_POST['sort_byservices27']))
{
   $sort_byservices = $_POST['sort_byservices27'];
}

if(isset($_POST['sort_byservices28']))
{
   $sort_byservices = $_POST['sort_byservices28'];
}

if(isset($_POST['sort_byservices29']))
{
   $sort_byservices = $_POST['sort_byservices29'];
}

if(isset($_POST['sort_byservices30']))
{
   $sort_byservices = $_POST['sort_byservices30'];
}

if(isset($_POST['category_title']))
{
   $category_title = $_POST['category_title'];

   $usercategory_data_array = array();
   $get_usercategory_query = "select * from category where category_unique_slug = '$category_title'  and is_deleted='0'";
   $result_get_usercategory_query = mysqli_query($db_mysqli, $get_usercategory_query);
   while ($row_get_usercategory_query = mysqli_fetch_assoc($result_get_usercategory_query))
   {
      $usercategory_data_array[] = $row_get_usercategory_query;
   }
   
   if(count($usercategory_data_array) > 0)
   {
      $catgory_id = $usercategory_data_array[0]['id'];
      $cate_id = 'and CONCAT(",", c.category_id, ",") REGEXP ",('.$category_id.'),"';
   }
   else 
   {
      $usergiftsubsubcate_data_array = array();
      $get_usergiftsubsubcate_query = "select gss.*, g.gift_name, gs.giftsubcate_name from gift_subsubcate gss left join gift_subcat gs on gss.giftsubcat_id=gs.id left join gift_cat g on gss.gift_id=g.id where gss.giftsubsubcate_slug = '$category_title'  and gss.is_deleted='0'";
      $result_get_usergiftsubsubcate_query = mysqli_query($db_mysqli, $get_usergiftsubsubcate_query);
      while ($row_get_usergiftsubsubcate_query = mysqli_fetch_assoc($result_get_usergiftsubsubcate_query))
      {
         $usergiftsubsubcate_data_array[] = $row_get_usergiftsubsubcate_query;
      } 

      $giftsubsub_id = $usergiftsubsubcate_data_array[0]['id'];

      $cate_id = 'and CONCAT(",", c.giftsubsubcat_id, ",") REGEXP ",('.$giftsubsub_id.'),"';
   }

}


if($minprice == '')
{ 
  
   $sort_by_title = '';
   $sort_by_asc_dsc = '';
   $filter_data = '';
   $order_condition = '';
   if($sort_by == 1)
   {
       
      $totalorder_data_array = array();
      $get_totalorder_query = "SELECT celebrity_id, COUNT(celebrity_id) as total  FROM user_order GROUP BY celebrity_id  HAVING COUNT(celebrity_id) > 1  ORDER BY celebrity_id DESC "; 
      $result_get_totalorder_query = mysqli_query($db_mysqli, $get_totalorder_query);
      while ($row_get_totalorder_query = mysqli_fetch_assoc($result_get_totalorder_query))
      {
         $totalorder_data_array[] = $row_get_totalorder_query;
      }

      $celebrtid = '';
      foreach($totalorder_data_array as $totalorder_data)
      {
        
         $celebrtdata .=$totalorder_data['celebrity_id'].',';
      }

      $celebrity_id = substr($celebrtdata, 0, -1);
      if(!empty($celebrity_id))
      {  
         $filter_data .= " and u.id IN($celebrity_id) ";
      }
      
   }

   if($sort_byservices !='')
   {
      $filter_data .= " and cp.services_id='$sort_byservices' ";
   }
  
   if($sort_by1 == 2)
   {  
      $sort_by_title = 'cp.discount_price';
      $sort_by_asc_dsc = 'ASC';
   }
   
   if($sort_by2 == 3)
   { 
      $sort_by_title = 'cp.discount_price';
      $sort_by_asc_dsc = 'DESC';
   }
  
   if($sort_by_title != '')
   {
      $order_condition = "order by $sort_by_title $sort_by_asc_dsc ";
   }
   
   $celebrity_list_data_array = array();
   $get_celebrity_list_query = 'select u.*, cp.price as celebrity_price, cp.discount_price,cp.status as price_status,cp.discount_type, cp.discount from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where u.status="1" and u.is_deleted="0" and u.user_type="2" '.$cate_id.' '.$filter_data.'  group by u.id '.$order_condition.''; 
   $result_get_celebrity_list_query = mysqli_query($db_mysqli, $get_celebrity_list_query);
   while ($row_get_celebrity_list_query = mysqli_fetch_assoc($result_get_celebrity_list_query))
   {
      $celebrity_list_data_array[] = $row_get_celebrity_list_query;
   } 
}
else 
{
   $celebrity_list_data_array = array();
   $get_celebrity_list_query = 'select u.*, cp.price as celebrity_price, cp.status as price_status, cp.discount_type, cp.discount from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where u.status="1" and u.is_deleted="0" and u.user_type="2" '.$cate_id.' and  cp.discount_price BETWEEN '.$minprice.' and '.$maxprice.' group by u.id';
   $result_get_celebrity_list_query = mysqli_query($db_mysqli, $get_celebrity_list_query);
   $total_data = mysqli_num_rows($result_get_celebrity_list_query);
   while ($row_get_celebrity_list_query = mysqli_fetch_assoc($result_get_celebrity_list_query))
   {
      $celebrity_list_data_array[] = $row_get_celebrity_list_query;
   } 
}

if(count($celebrity_list_data_array)>0)
{

   $all_celebritys_div = '';
   foreach ($celebrity_list_data_array as $celebrity_data)
   {
      $last_id = $last_id + 1;
      $current_celebrity_id = $celebrity_data['id'];

      $celebrity_price = $celebrity_data['celebrity_price'];
      $celebrity_image1 = $celebrity_data['profile_pic'];
      
      if($celebrity_image1 != '')
      {
         $celebrity_image1 = $cele_base_path_uploads."profile-pic/size_450/".$celebrity_image1;
      }
      else
      {
         $celebrity_image1 = $base_url_images."/1.jpg";
      }
      if($celebrity_data['price_status'] == 1)
      {
         if ($celebrity_data["discount_type"] == 'percentage')
         {
            $discount = $celebrity_data['celebrity_price']*$celebrity_data["discount"];
            $total_discountt = $discount/100;
            $total_discount = $celebrityprice_data['celebrity_price']-$total_discountt;
         }
         else if($celebrity_data["discount_type"] == 'price')
         {
            $total_discount = $celebrity_data['celebrity_price']-$celebrity_data["discount"];
         }
      }
      else 
      {
         $total_discount = 'Comming Soon';
      }



      $all_celebritys_div .= '<div class="col-6 col-sm-6 col-md-4 col-lg-3 item" style="display:block">
      <div class="product-image">
          <a href="'.$base_url.'celebrity-details/'.$celebrity_data['user_unique_slug'].'" class="product-img" title="'. $celebrity_data['user_name'].'">
            <img  src="'.$celebrity_image1.'" alt="'.$celebrity_data['user_name'].'" title="'.$celebrity_data['user_name'].'"> 
            </a>
          <div class="button-set style0 d-none d-md-block">
              <ul>
                  <li><a class="btn-icon btn cartIcon pro-quickshop-popup" onclick="add_to_cart('.$celebrity_data['id'].')"  aria-controls="pro-quickshop1"><i class="icon an an-cart-l"></i> <span class="tooltip-label top">Add to Cart</span></a></li>
                  <li><a class="btn-icon" onclick="book_cart('.$celebrity_data['id'].')"><i class="icon an an-search-l"></i> <span class="tooltip-label top">Book Now</span></a></li>
                  <li><a class="btn-icon wishlist add-to-wishlist" onclick="add_to_wishlist('.$celebrity_data['id'].')"><i class="icon an an-heart-l"></i> <span class="tooltip-label top">Add To Wishlist</span></a></li>
              </ul>
          </div>
      </div>
      <div class="product-details text-center">
          <div class="product-name text-uppercase">
              <a href="'.$base_url.'celebrity-details/'.$celebrity_data['user_unique_slug'].'">'.$celebrity_data['user_name'].'</a>
          </div>
          <div class="product-price">
              <span class="old-price">'.$selected_currency_icon.' '.$celebrity_data['celebrity_price'].'</span>
              <span class="price">'.$selected_currency_icon.' '.$total_discount.'</span>
          </div>
      </div>
  </div>';
   }


  if ($last_id != 0) 
  {   
    $return["all_celebritys_div"] = $all_celebritys_div;
    $return["last_id"] = $last_id;
    $return["load_more_last_id"] = '<script type="text/javascript">var last_id = '.$last_id.';var no_more_data = 0; </script>';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
  }

} 
else
{
  $all_celebritys_div = '
  <div style="clear:both"></div>
   <center>
  <h6><i class="fa fa-thumbs-down" title="No Data Found" style="font-size:30px"></i></h6>
  <h4>No Data Found!</h4>
  </center>';
  $all_celebritys_div1 = '
  <div style="clear:both"></div>
  <center>
   <h6><i class="fa fa-thumbs-down" title="No Data Found" style="font-size:30px"></i></h6>
   <h4>No Data Found!</h4>
  </center>';    
  $return["all_celebritys_div"] = $all_celebritys_div;
  $return["last_id"] = $last_id;
  $return["load_more_last_id"] = '<script type="text/javascript"> var no_more_data = 1;</script>';
  $return["status"] = "error";
  echo json_encode($return);
  exit();
}
?>