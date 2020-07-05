<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-config.php' );
	$action = $_POST['action'];

	global $wpdb;
	switch($action){
	
	case 'defaultAddress':
		try {
			$addressid =  $_POST['addID'];
			$id = get_current_user_id();
			$wpdb->query($wpdb->prepare("UPDATE wp_3_user_address SET default_address=0 WHERE user_id=$id"));
			$wpdb->query($wpdb->prepare("UPDATE wp_3_user_address SET default_address=1 WHERE id=$addressid"));
			echo 'Changed';
			
		}	
		catch(Exception $e) {
		  echo 'Message: ' .$e->getMessage();
		}
	break;
	case 'deleteUserDelAdd':
			$addressid =  $_POST['addID'];
			$id = get_current_user_id();
			$wpdb->delete( 'wp_3_user_address', array( 'id' => $addressid ) );
			echo 'Deleted';
	break;
	case 'listInboxAblConPack':
		$id  = get_current_user_id();
		$items = $wpdb->get_results( 'SELECT id,warehouse_id,date_received,merchant_order,unit_cost,resized_dimention_weight,address_id,status,shipment_id FROM wp_3_packages WHERE user_id='.$id );
        $add = $wpdb->get_results( 'SELECT adds.address_name, adds.delivery_address, adds.states, adds.city,adds.city,adds.zipcode , c.name FROM wp_3_user_address as adds INNER JOIN wp_3_countrylist as c ON adds.country_id = c.id   WHERE adds.user_id='.$id .' AND '.'adds.default_address = 1' );

        $counter = 0;
		foreach ($items as $result) {

			$title = $wpdb->get_results( 'SELECT post_title FROM wp_3_posts WHERE ID='.$result->warehouse_id );
			$items[$counter]->warehouse_name = $title[0]->post_title;
			if($items->address_id == '') {
                $items[$counter]->address_full = $add[0]->address_name . '  ' . $add[0]->delivery_address . ' ' . $add[0]->states . ' ' . $add[0]->city . ' ' . $add[0]->zipcode . ' ' . $add[0]->name;
            }
			$counter++;
		}
		
		echo json_encode($items);
	break;
	
	case 'get_warehouse':
		$warehouse_id = $_POST['wareHouseId'];

		echo $warehouse_id;
		
	break;

        case 'get_price_item':

           $id = $_POST['item_id']  ;
            $products_query = $wpdb->get_results( "
                                SELECT  p.ID AS id,
                                        p.post_title AS name,
                                        Max(CASE WHEN pm.meta_key = '_price' AND  p.ID = pm.post_id THEN pm.meta_value END) AS price
                                FROM    wp_3_posts p
                                        INNER JOIN wp_3_postmeta pm
                                            ON p.ID = pm.post_id
                                WHERE   p.ID = ".$id."
                                        AND p.post_type = 'product_variation' 
                                        AND p.post_status = 'publish' 
                                        AND p.post_parent != 0 
                                       
                                        
                                GROUP BY p.ID
                                ORDER BY p.ID DESC;
                                
                            " );
            $meta_value = get_current_user_id();
            $packages = $wpdb->get_results('SELECT post_id FROM wp_3_postmeta WHERE meta_key="package_list_user_id" AND meta_value="'.$meta_value.'"  ORDER BY  meta_id DESC' );

            $warehouse_charges = 0;

            foreach ($packages as $package) {
                $status = $wpdb->get_results('SELECT meta_value FROM wp_3_postmeta WHERE meta_key="package_list_status" AND post_id='.$package->post_id );

                if($status[0]->meta_value == "Schedule To Ship" ) {
                    $datetime_format =  $wpdb->get_results('SELECT meta_value FROM wp_3_postmeta WHERE meta_key="package_list_datetime" AND post_id='.$package->post_id );
                    $datetime = date("F j, Y, g:i a", $datetime_format[0]->meta_value);
                    $warehouse_days = get_num_of_date($datetime);
                    $qty = $wpdb->get_results('SELECT meta_value FROM wp_3_postmeta WHERE meta_key="package_list_quantity" AND post_id='.$package->post_id );

                    $warehouse_charges += get_warehouse_charges_updated($warehouse_days) * (int) $qty[0]->meta_value;
                }

            }

            $total =number_format(floatval($products_query[0]->price + $warehouse_charges),2);

            $itemPrice = number_format(floatval($products_query[0]->price),2);
            $warehouse_charges = number_format(floatval($warehouse_charges),2);
           




            $body  .='  <tr><td>'.$products_query[0]->name.'</td><td>P'.$itemPrice.'</td></tr>';
             $body  .='               <tr>';
               $body  .='                   <td>Warehouse Charges:</td><td>P'.$warehouse_charges.'</td>';
              $body  .='                </tr><tr><td>Additionam fees:</td><td>P0.00</td></tr>';
             $body  .='                 <tr >';
               $body  .='              </tr>';
               $body  .='               <tr>';
              $body  .='                    <td>Total</td>';
             $body  .='                     <td><strong style="font-size:20px">P'.$total.'</strong></td>';
             $body  .='                 </tr>';


           echo $body;





            break;
        case 'reset_schedule':
            global $wpdb;
            $id = get_current_user_id();
            $items = $wpdb->get_results( 'SELECT * FROM wp_3_packages WHERE user_id='.$id.' AND status = "Schedule To Ship" ' );
            $wpdb->update( 'wp_3_packages',array('shipment_id' => '' , 'status' => 'Ready To Ship'), array( 'user_id' => $id, 'status' => 'Schedule To Ship' ));
            $shipment_id = $items[0]->shipment_id;
            $wpdb->delete( 'wp_3_shipment_schedule', array( 'id' => $shipment_id ) );
            delete_user_meta($id,'shipment_schedule_id');


            echo 'success';
            break;
        case 'save_product_suggestion':
            $product = $_POST['suggestion'];
            $shipment_data = explode(",",$product);
          //  echo var_dump($shipment_data[1]);
            $wpdb->update( 'wp_3_shipment_schedule',array('product_suggestion' => $shipment_data[0]), array( 'id' => (int)$shipment_data[1] ));




            $user = get_user_by( 'ID', $shipment_data[2]);
            include  (__DIR__ . '/path/to/wp-load,php');
            $to = $user->user_email;
            $subject = 'Package box has been set by the warehouse manager';
            $body = 'Hi Good day <br/><br/>';
            $body .= 'Your Package has has been set by the warehouse manager. You can now pay the box to continue transaction <br/> <br/> <hr/><br/> ';
            $body .= 'Login and visit this link to continue. <a href="http://team661.com/consolidators/purchase/"> Click here</a>';
            $headers = array('Content-Type: text/html; charset=UTF-8');
            wp_mail( $to, $subject, $body, $headers );





            echo 'Successfully save the data';
            break;
        case 'home_tracking_order':
              $tracking_id = $_POST['tracking'];
              $sql=  'SELECT * FROM  wp_3_shipment_schedule ';
              $sql.=  ' WHERE tracking_code = "'.$tracking_id.'"';
              $items = $wpdb->get_results($sql);

            if(empty($items)){
                echo 'error25';
                exit;
            }
         //   $steps = $wpdb->get_results('SELECT * FROM wp_3_order_status_ WHERE order_id= '.$items[0]->order_id);

         //   if(empty($steps)) {
         //       echo 'error';
          //      exit;
         //   }


            $query = $wpdb->get_results("SELECT * FROM wp_3_posts WHERE ID =".$items[0]->order_id);
          //  echo $query[0]->post_status;

            $processing = []; $ship = [];$transit = []; $received_manila = []; $out_for_delivery = [] ;$delivered = [];
           // echo $order->get_status();
           // echo $query[0]->post_status;
                $date_time = $query[0]->post_modified;
                if($query[0]->post_status == "wc-on-hold"){
                    $processing['class'] = 'is-complete';
                    $processing['date'] =  'Payment on: '.$query[0]->post_modified;
                }if($query[0]->post_status  == "wc-processing"){
                    $ship['class'] = 'is-complete';
                      $processing['class'] = 'is-complete';
                    $ship['date'] =  'Ship on: '.$query[0]->post_modified;
                }if($query[0]->post_status == "wc-pending"){
                $ship['class'] = 'is-complete';
                $processing['class'] = 'is-complete';
                    $transit['class'] = 'is-complete';
                    $transit['date'] =  'Transit on: '.$query[0]->post_modified;
                }
                if($query[0]->post_status == "wc-received-manila"){
                    $ship['class'] = 'is-complete';
                    $processing['class'] = 'is-complete';
                    $transit['class'] = 'is-complete';
                    $received_manila['class'] = 'is-complete';
                    $received_manila['date'] = 'Received on: '.$query[0]->post_modified;
                }
                if($query[0]->post_status  == "wc-delivery"){
                    $ship['class'] = 'is-complete';
                    $processing['class'] = 'is-complete';
                    $transit['class'] = 'is-complete';
                    $received_manila['class'] = 'is-complete';
                    $out_for_delivery['class'] = 'is-complete';
                    $out_for_delivery['date'] = 'Pick up on: '.$query[0]->post_modified;
                }
                if($query[0]->post_status  == "wc-completed"){
                    $ship['class'] = 'is-complete';
                    $processing['class'] = 'is-complete';
                    $transit['class'] = 'is-complete';
                    $received_manila['class'] = 'is-complete';
                    $out_for_delivery['class'] = 'is-complete';
                    $delivered['class'] = 'is-complete';
                    $delivered['date'] =  'Delivered on: '.$query[0]->post_modified;
                }




             echo '<ul class="progress-tracker progress-tracker--text">';
            echo '                       <li class="progress-step '.$processing['class'].'">';
            echo '                            <div class="progress-marker" ></div>';
            echo '                             <div class="progress-text">';
            echo '                                 <h4 class="progress-title">  <i class="ni ni-box-2"></i> <span>Processing</span></h4>';
            echo '                                <small class="text text-muted">'.$processing['date'].'</small>';
            echo '                            </div>';
            echo '                        </li>';
           echo '                           <li class="progress-step '.$ship['class'].'">';
           echo '                               <div class="progress-marker"></div>';
           echo '                               <div class="progress-text">';
           echo '                                   <h4 class="progress-title"> <i class="ni ni-spaceship"></i> <span>Ship</span></h4>';
           echo '                                   <small class="text text-muted">'.$ship['date'].'</small>';
           echo '                              </div>';
           echo '                            </li>';
           echo '                           <li class="progress-step '.$transit['class'].'">';
          echo '                               <div class="progress-marker"></div>';
           echo '                               <div class="progress-text">';
          echo '                                    <h4 class="progress-title"> <i class="ni ni-vector"></i> <span>Transit</span></h4>';
          echo '                                    <small class="text text-muted">'.$transit['date'].'</small>';
          echo '                                </div>';
          echo '                            </li>';
          echo '                            <li class="progress-step '.$received_manila['class'].'" >';
          echo '                                <div class="progress-marker"></div>';
          echo '                                <div class="progress-text">';
         echo '                                     <h4 class="progress-title"> <i class="ni ni-shop"></i> <span>Received Manila</span></h4>';
          echo '                                   <small class="text text-muted"> '.$received_manila['date'].'</small>';
          echo '                                </div>';
         echo '                              </li>';
            echo '                            <li class="progress-step '.$out_for_delivery['class'].'">';
         echo '                                <div class="progress-marker"></div>';
         echo '                                <div class="progress-text">';
         echo '                                    <h4 class="progress-title"> <i class="ni ni-delivery-fast"></i> <span>Out for delivery</span></h4>';
         echo '                                    <small class="text text-muted">'.$out_for_delivery['date'].'</small>';
         echo '                                </div>';
         echo '                           </li>';
            echo '                            <li class="progress-step '.$delivered['class'].'">';
         echo '                                <div class="progress-marker"></div>';
         echo '                                <div class="progress-text">';
        echo '                                 <h4 class="progress-title"> <i class="ni ni-check-bold"></i> <span>Delivered</span></h4>';
         echo '                                    <small class="text text-muted">'.$delivered['date'].'</small>';
         echo '                                </div>';
        echo '                             </li>';
         echo '                        </ul>';

            break;


        case 'change_status':
            $statusData = str_replace(' ', '', $_POST['status']);
            $page = $_POST['page'];
            if($page == 1)
                $package = "Consolidator";
            else
                $package = "Personal Shopper";

            $order_id = $_POST['order_id'];
             $status = "";
             if($statusData == "2") {
                 $status = "Ready To Ship";
             }


            $update = $wpdb->query('UPDATE wp_3_postmeta SET meta_value = "'.$status.'" WHERE post_id = '.$order_id.'  AND  meta_key= "package_list_status"');
            $update = $wpdb->query('UPDATE wp_3_postmeta SET meta_value = "'.$package.'" WHERE post_id = '.$order_id.'  AND  meta_key= "package_list_type"');
            echo $order_id;
            break;


	default:

	
	break;


	}

    function get_additional_charges(){
        global $wpdb;
        $id = get_current_user_id();
        $items = $wpdb->get_results( 'SELECT * FROM wp_3_packages WHERE user_id='.$id.' AND status = "Schedule To Ship" ' );

        $warehouse_charges = 0;

        foreach ($items as $result) {
            $warehouse_days = get_num_of_date( $result->date_received);
            $warehouse_charges += get_warehouse_charges($warehouse_days,$result->resized_dimention_weight);
        }
        return $warehouse_charges;
    }

    function get_warehouse_charges($days,$weight){
        $days = (int)$days;
        $weight = floatval($weight);
        $max_weight = 33; //kg
        $charge = 0;
        // 31-60days
        if($days >= 31 && $days <= 60){

            if($weight < $max_weight)

                return  floatval(1 * $days);
            else
                return   floatval(1.5 * $days);
        }
        // 61-90 days
        else if($days >= 61 && $days <= 90 ){

            if($weight < $max_weight)
                return  floatval(2 * $days);
            else
                return  floatval(3 * $days);

        }
        // 91 days or greater than
        else if($days >= 91){

            if($weight < $max_weight)
                return  floatval( 3 * $days);
            else
                return floatval(6 * $days);
        }

        return $charge;


    }

    function get_num_of_date($date_received){
        date_default_timezone_set('America/Chicago');
        $now = time(); // or your date as well
        $your_date = strtotime($date_received);
        $datediff = $now - $your_date;

        return round($datediff / (60 * 60 * 24));

    }

     function get_warehouse_charges_updated($days){
    $days = (int)$days;

    $charge = 0;
    // 31-60days
    if($days >= 31 && $days <= 60){
        return  floatval(50.32 );
    }
    // 61-90 days
    else if($days >= 61 && $days <= 90 ){

        return  floatval(100.65 );

    }
    // 91 days or greater than
    else if($days >= 91){
        return  floatval( 150.97 );
    }
    return $charge;


}
	
	



	
