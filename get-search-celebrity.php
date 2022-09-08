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
      $userdetails_data_array = array();
      $get_userdetails_query = "select u.*, cp.price as celebrity_price from user u left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id  where u.user_name LIKE '%$search_value%' and u.status='1' and u.is_deleted='0' group by u.id  limit 5";
      $result_userdetails_data = mysqli_query($db_mysqli,$get_userdetails_query);
      while ($row_userdetails_data = mysqli_fetch_assoc($result_userdetails_data))
      {
         $userdetails_data_array[] = $row_userdetails_data;
      } 

      //print_r($userdetails_data_array); exit;
      if(empty($userdetails_data_array ==''))
      {
         
         $get_userdetails_query = "select u.*, cp.price as celebrity_price from brand_post bp left join brand_post_celebrty_list bpc on bpc.brand_post_id=bp.id left join user u on bpc.celebrity_id=u.id left join celebrity_details c on u.id=c.celebrity_id left join celebrity_price cp on u.id=cp.celebrity_id where bp.title LIKE '%$search_value%' and bp.status='1'and bp.is_deleted='0'group by u.id limit 5;";
         $result_userdetails_data = mysqli_query($db_mysqli,$get_userdetails_query);
         while ($row_userdetails_data = mysqli_fetch_assoc($result_userdetails_data))
         {
            $userdetails_data_array[] = $row_userdetails_data;
         } 
      }
     
      $search_html_message .= '<li>
                     <table class="table table-striped">
                        <tbody>';
      if(count($userdetails_data_array)>0)
      {
         foreach ($userdetails_data_array as $all_userdetails_table_data)
         {
     
            $userdetails_full_title = $all_userdetails_table_data['user_name'];
            $userdetails_title = $all_userdetails_table_data['user_name'];
            if(strlen($userdetails_title) >= 30)
            {
                $userdetails_title = substr($userdetails_title,0,30)."...";
            }


            $userdetails_image = $all_userdetails_table_data['profile_pic'];
            $userdetails_variant_price=$all_userdetails_table_data['celebrity_price'];
            $userdetails_variant_seo_url = $all_userdetails_table_data['user_unique_slug'];
            if($userdetails_image!='')
            {
               $userdetails_image=$cele_base_path_uploads."profile-pic/temp_file/".$userdetails_image;
            }
            else
            {
               $userdetails_image=$base_url_images."1.jpg";
            }


            $search_html_message .= '
               
               <tr>
                   <td class="text-left"> <a href="'.$base_url.'celebrity-details/'.$userdetails_variant_seo_url.'"><img  src="'.$userdetails_image.'" alt="'.$userdetails_title.' " title="'.$userdetails_full_title.' " class="img-thumbnail" style="width: 50px;"></a> </td>
                      <td class="text-left" style="vertical-align:top;">
                        <div style="margin-bottom:10px;"><a href="'.$base_url.'celebrity-details/'.$userdetails_variant_seo_url.'" title="'.$userdetails_full_title.'">'.$userdetails_title.'</a>
                        </div>
                        
                      </td>
                     <!--  <td class="text-left custom-price-td"  style="width: 20%;vertical-align:top;">'.$selected_currency_icon.''.$userdetails_variant_price.'</td>-->
                      
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