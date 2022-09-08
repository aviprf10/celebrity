<?php 
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
$search_html_message='';
if(isset($_POST))
{
   $search_value = $_POST['search_value'];
   if($search_value != "")
   {
      $product_data_array = array();
      $get_product_query = "select p.*, pim.product_small_images from product p LEFT JOIN product_images pim on pim.product_id=p.id where p.product_name LIKE '%$search_value%' and p.status='1' and p.is_deleted='0' limit 5";
      $result_product_data = mysqli_query($db_mysqli,$get_product_query);

      while ($row_product_data = mysqli_fetch_assoc($result_product_data))
      {
         $product_data_array[] = $row_product_data;
      } 
      $search_html_message .= '<li>
                     <table class="table table-striped">
                        <tbody>';
      if(count($product_data_array)>0)
      {
         foreach ($product_data_array as $all_product_table_data)
         {
     
            $product_full_title = $all_product_table_data['product_name'];
            $product_title = $all_product_table_data['product_name'];
            if(strlen($product_title) >= 30)
            {
                $product_title = substr($product_title,0,30)."...";
            }


            $product_image = $all_product_table_data['product_small_images'];
            $product_variant_price=$all_product_table_data['product_price'];
            $product_variant_seo_url = $all_product_table_data['product_unique_slug'];
            if($product_image!='')
            {
               $product_image=$base_url_uploads."product-small-images/temp_file/".$product_image;
            }
            else
            {
               $product_image=$base_url_images."1.png";
            }


            $search_html_message .= '
               
               <tr>
                   <td class="text-center"> <a href="'.$base_url.'product-details/'.$product_variant_seo_url.'"><img  src="'.$product_image.'" alt="'.$product_title.' " title="'.$product_full_title.' " class="img-thumbnail" style="width: 50px;"></a> </td>
                      <td class="text-left" style="vertical-align:top;">
                        <div style="margin-bottom:10px;"><a href="'.$base_url.'product-details/'.$product_variant_seo_url.'" title="'.$product_full_title.'">'.$product_title.'</a>
                        </div>
                        
                      </td>
                      <td class="text-left custom-price-td"  style="width: 20%;vertical-align:top;">'.$selected_currency_icon.''.$product_variant_price.'</td>
                      
                     </tr>

               ';
         }
      }
      else{
         $search_html_message .= '
         <li style="padding: 7px 0 7px 0px;min-width:300px;">
            <center>No results Found</center>
         </li>';
      }
       $search_html_message .= '</tbody>
                     </table>
                  </li>';
   }
}
$return["status"] = "success";
$return["search_html_message"] = $search_html_message;
echo json_encode($return);
?>