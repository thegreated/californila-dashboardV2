<!doctype html>
<html class="no-js" lang="">
<?php

if (!is_user_logged_in()) {
  $page = get_page_by_title('login');
	wp_redirect(get_permalink($page->ID));
  exit;
}
global $wpdb;
 $title = "Dashboard"; 
$url = get_stylesheet_directory_uri();
require_once('template/header.php');
$args = array( 'post_type'   => 'address','post_status' => 'publish',"s" => 'Unites States');
$full_address = new WP_Query( $args );
$args2 = array( 'post_type'   => 'announcement','post_status' => 'publish');
$announcement = new WP_Query( $args2 );


$current_user = wp_get_current_user();

//get user order from woocommerce
$args_pending = array('customer_id' => $current_user->ID,'orderby' => 'date', 'order' => 'DESC','status' => 'Pending Payment'  );

//$args_pending = array('customer_id' => $current_user->ID,'orderby' => 'date', 'order' => 'DESC', 'status' => 'Shipping In Progress'  );

//get all orders
$customer = wp_get_current_user();
// Get all customer orders
function get_count_dashboard($views){
    $customer_orders = get_posts(array(
        'numberposts' => -1,
        'meta_key' => '_customer_user',
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_value' => get_current_user_id(),
        'post_type' => wc_get_order_types(),
        'post_status' => array_keys(wc_get_order_statuses()), 'post_status' => array($views),
    ));
    $count_pending = 0;
    $Order_Array = []; //
    foreach ($customer_orders as $customer_order) {
        $orderq = wc_get_order($customer_order);
        $Order_Array[] = [
            "ID" => $orderq->get_id(),
            "Value" => $orderq->get_total(),
            "Date" => $orderq->get_date_created()->date_i18n('Y-m-d'),
        ];
        $count_pending++;

    }
    return $count_pending;
}

function get_order_dashboard(){
    $customer_orders = get_posts(array(
        'numberposts' => -1,
        'meta_key' => '_customer_user',
        'orderby' => 'date',
        'order' => 'DESC',
        'numberposts' => 5,
        'meta_value' => get_current_user_id(),
        'post_type' => wc_get_order_types(),
        'post_status' => array_keys(wc_get_order_statuses()), 
    ));
    $count_pending = 0;
    $Order_Array = []; //
    foreach ($customer_orders as $customer_order) {
        $orderq = wc_get_order($customer_order);
        $Order_Array[] = [
            "ID" => $orderq->get_id(),
            "Value" => $orderq->get_total(),
            "Date" => $orderq->get_date_created()->date_i18n('Y-m-d'),      
            "Status" => $orderq->get_status(),
        ];
        $count_pending++;

    }
    return $Order_Array;
}

    
  //  echo get_current_user_id();



/* Get user info. */
global $current_user, $wp_roles;
//get_currentuserinfo(); //deprecated since 3.1

/* Load the registration file. */
//require_once( ABSPATH . WPINC . '/registration.php' ); //deprecated since 3.1
$error = array();    

/* If profile was saved, update profile. */
if (isset( $_POST['action']) && 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

    /* Update user password. */
    // if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
    //     if ( $_POST['pass1'] == $_POST['pass2'] )
    //         wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
    //     else
    //         $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
    // }

    /* Update user information. */
  //  if ( !empty( $_POST['url'] ) )
    //    wp_update_user( array( 'ID' => $current_user->ID, 'user_url' => esc_url( $_POST['url'] ) ) );
    if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] )))
            $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
        elseif(email_exists(esc_attr( $_POST['email'] )))
            $error[] = __('This email is already used by another user.  try a different one.', 'profile');
        else{
            wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
        }
    }

    if ( !empty( $_POST['first-name'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
    if ( !empty( $_POST['last-name'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
 //   if ( !empty( $_POST['description'] ) )
      //  update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );

    /* Redirect so the page will show updated info.*/
  
  /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
    if ( count($error) == 0 ) {
        //action hook for plugins and extra fields saving
        do_action('edit_user_profile_update', $current_user->ID);
        $success_edit_profile = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Success</h3> 
            You successfully edit your profile information. 
        </div>';
       // wp_redirect( get_permalink() );
        
       // exit;
    }
}

function my_print_error(){

  

    if($wpdb->last_error !== '') :

        $str   = htmlspecialchars( $wpdb->last_result, ENT_QUOTES );
        $query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );

        print "<div id='error'>
        <p class='wpdberror'><strong>WordPress database error:</strong> [$str]<br />
        <code>$query</code></p>
        </div>";

    endif;

}

?>
<style>
.preparing_shipment
{
    background-color:#7460ee;   
}
.pending_payment
{
    background-color:#009efb;   
}
.on_the_way
{
    background-color:#55ce63;   
}
.delivered
{
    background-color:#ffbc34;
}

.dropdown-content a:hover {background-color: #ddd;}

	.dropdown:hover .dropdown-content {  visibility: visible;
	  opacity: 1; }

	.dropdown:hover .dropbtn {background-color: #00c292;}
	.dropbtn {
	  background-color: #00c292;
	  color: white;
	  padding: 16px;
	  font-size: 16px;
	  border: none;
	}

	.dropdown {
	  position: relative;
	  display: inline-block;
	}

	.dropdown-content {
	 
	  position: absolute;
	  font-size:20px;
	  background-color: #f1f1f1;
	  min-width: 160px;
	  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	  z-index: 1;	
	  list-style: none;
	  opacity: 0;
	  visibility: hidden;
	  -webkit-transition: opacity 600ms, visibility 600ms;
	  transition: opacity 600ms, visibility 600ms;
	}

	.dropdown-content a {
		font-size:20px;
	  color: black;
	  padding: 12px 16px;
	  text-decoration: none;
	  display: block;
}

@media screen and (max-width: 800px) {
	.dropdown {
		display:none;
	}
}
</style>
<head>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.2.513/styles/kendo.default-v2.min.css" />

</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Start Header Top Area -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area">
                       <h3 style="color:white;margin-top:5px"> Californila Dashboard</h3>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                            <!-- <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-search"></i></span></a>
                                <div role="menu" class="dropdown-menu search-dd animated flipInX">
                                    <div class="search-input">
                                        <i class="notika-icon notika-left-arrow"></i>
                                        <input type="text" />
                                    </div>
                                </div>
                            </li> -->
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropbtn" style="text-transform: capitalize;"><small> <?=$current_user->first_name;?></small></a>
								<div class="dropdown-content">
									<a href="#">My Account</a>
									<a href="#">My Order</a>
									 <a href="./logout"  class="nav-link dropdown-toggle"><small>Logout</small></a>
								  </div>
                               
                            </li>
        
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li><a data-toggle="collapse" data-target="#Charts" href="#">Dashboard</a>
                               
                                </li>
                              
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li class="active"><a data-toggle="tab" href="../dashboard"><strong> Dashboard </strong></a>
                        </li>
						<li class="active"><a data-toggle="tab" href="#Home">My Package</a>
                        </li>
						<li class="active"><a data-toggle="tab" href="#Home">Sent Package</a>
                        </li>
						<li class="active"><a data-toggle="tab" href="#Home">Odds -ons</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Menu area End-->
    <!-- Start Status area -->
    <div class="container">
        <?php if(isset($success_edit_profile)){

                echo $success_edit_profile;
                  }
                  
            ?>
               <?php if ( count($error) > 0 ) echo '<div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Error</h3> 
                  '. implode("<br />", $error).'
        </div>';
               
               '<p class="error">' . implode("<br />", $error) . '</p>'; ?>
    </div>

    
    <?php //echo count($orders); ?>
    <div class="notika-status-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" >
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30" style="background-color:#009efb;color:white;">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter"  style="color:white"><?=get_count_dashboard('wc-on-hold')?></span></h2>
                            <p  style="color:white">Pending payment</p>
                        </div>
                        <!-- <div class="sparkline-bar-stats2">1,4,8,3,5,6,4,8,3,3,9,5</div> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                   

                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30" style="background-color:#7460ee;color:white;">
                        <div class="website-traffic-ctn" >
                        <?php
                      
                        // print_r(count($pending ));?>
                            <h2><span class="counter"  style="color:white"><?=get_count_dashboard('wc-processing')?></span></h2>
                            <p  style="color:white">Preparing for shipment</p>
                        </div>
                        <!-- <div class="sparkline-bar-stats1">9,4,8,6,5,6,4,8,3,5,9,5</div> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30" style="background-color:#55ce63;color:white;">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter"  style="color:white"><?=get_count_dashboard('wc-arrival-shipment')?></span></h2>
                            <p  style="color:white">On the way</p>
                        </div>
                        <!-- <div class="sparkline-bar-stats3">4,2,8,2,5,6,3,8,3,5,9,5</div> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30" style="background-color:#ffbc34;color:white;">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter"  style="color:white"><?=get_count_dashboard('wc-completed')?></span></h2>
                            <p  style="color:white">Delivered</p>
                        </div>
                        <!-- <div class="sparkline-bar-stats4">2,4,8,4,5,7,4,7,3,5,7,5</div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Status area-->
    <!-- Start Sale Statistic area-->
    <div class="sale-statistic-area">
        <div class="container">
            <div class="row">
               <?php ?>
                <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">

                    <div class="statistic-right-area notika-shadow mg-tb-30 sm-res-mg-t-0">
                        <img src="<?=$url?>/includes/images/profile.jpg" width="150" class="img-circle " style="margin:30px" />
                        <div class="text text-center"> <h4><?=$current_user->user_firstname?> <?=$current_user->user_lastname?></h4>
                            <p><?=$current_user->user_email?></p>
                        </div>
                         <hr style="width:100%">

                        <div class="">
                            <div class="past-statistic-ctn text text-center">
                                <h3 >Customer id</h3>
                                <p><?=$current_user->ID?></p>
                            </div>
                        </div>

               
 
    <ul>
 

       
                        

                    </div>
                </div>
				<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
					<div class="sale-statistic-inner notika-shadow mg-tb-30">
						  <h3 class="m-b-0" style="font-size:20px;"> Important Announcements</h3>
						  <hr/>
						   <div style="margin-left:10px">
						 <?php    if( $announcement->have_posts() ) :
											  while ($announcement->have_posts()) : $announcement->the_post();

									    the_excerpt();
												
										?>
										
															
														<?php
													
													
													
											 endwhile;
												wp_reset_postdata();
													else :
														esc_html_e( 'No testimonials in the diving taxonomy!', 'text-domain' );
													endif;
									?>
						 <br/>
						 <hr/>
						 <a href ="../announcement"> <u>Read More</u> </a>
						 </div>
					</div>
				</div>
				<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
						<div class="sale-statistic-inner notika-shadow ">
							  <h3 class="m-b-0" style="font-size:20px;">Address</h3>
							  <hr/>
							   <div style="margin-left:10px">
							   	<div class="row">
									<div class="col-md-6 ">
							   <?php    if( $full_address->have_posts() ) :
											while( $full_address->have_posts() ) :
												$full_address->the_post();
												$image  = get_post_meta( get_the_ID(), 'addressList_image_flag', true );
												$country  = get_post_meta( get_the_ID(), 'addressList_shop_country', true );
												$address  = get_post_meta( get_the_ID(), 'addressList_shop_address', true );
												$name  = get_post_meta( get_the_ID(), 'addressList_shop_name', true );

										
												
										?>
										
															<div class="past-statistic-an">
																
																<br/>
																<div class="past-statistic-ctn" style="border:1px solid black;padding:15px">
																<div class="text-center" style="margin-bottom:20px;color:#009efb"><strong>US WAREHOUSE </strong> </div>
																   <table>
																	   <tr>
																		   <td style="padding:5px;">
																		   <img src="<?=$image ?>" width="25px">
																		   </td>
																		   <td>
																			<b><?=the_title()?></b>
																		   </td>
																	   </tr>
																   </table> 
																</hr/>
																   <div> <?=$name?><br/> <?=$address?> <br/> <?=$country?>
																   </div>
																</div>
															</div>
															<?php
													
													endwhile;
													wp_reset_postdata();
													else :
														esc_html_e( 'No testimonials in the diving taxonomy!', 'text-domain' );
													endif;
													?>     
									</div>
									<div class="col-md-6">

										<div class="past-statistic-an">
											
											<br/>
											<div class="past-statistic-ctn" style="border:1px solid black;padding:15px">
											<div class="text-center" style="margin-bottom:20px;color:#009efb"><strong>Your Default Delivery Address </strong> </div>
											   <table>
												   <tr>
													   <td style="padding:5px;">
													   <img src="" width="25px">
													   </td>
													   <td>
														<?php

												$id = get_current_user_id();
												$default_address = $wpdb->get_results( "SELECT * FROM wp_3_user_address WHERE user_id=".$id." AND default_address=1");
												
												foreach ( $default_address as $add )   {
													if($add->type == "Home Delivery"){

?>
														
															   <div> <?=$add->first_name?><?=$add->last_name?> <br/>
																<?=$add->address_name?>  <?=$add->delivery_address?> <?=$add->states?>  <?=$address->city?> <?=$add->zipcode?>
															  </div>

												
												<?php
													}else{ 
													$content_post = get_post($add->post_id); 
													$address_full  = get_post_meta( $add->post_id, 'addressList_shop_address', true );
													$country  = get_post_meta( $add->post_id, 'addressList_shop_country', true );
													//var_dump($content_post);
										?>
	

																<div> <?=$add->first_name?>  <?=$add->last_name	?><br/>
															<?=$address_full?> <?=$country?>
															  </div>

												<?php }
												}
														?>
													   </td>
												   </tr>
											   </table> 
											</hr/>
											   <div> <br/> <br/> 
											   </div>
											</div>
										</div>
		
									</div>
									<div class="col-md-12" style="margin-top:20px">
										<div class="panel-group">
										  <div class="panel panel-default"> 
											<div class="panel-heading">
											  <h4 class="panel-title">
												<a data-toggle="collapse" href="#collapse1">My Address List</a>
											  </h4>
											</div>
											<div id="collapse1" class="panel-collapse collapse">
											  <div class="panel-body">
											  <!--Table-->
<table id="tablePreview" class="table table-hover table-striped table-bordered table-sm">
<!--Table head-->
  <thead>
    <tr>
      <th>Recipient's Name</th>
      <th>Address</th>
      <th>Country</th>
      <th>Type</th>
      <th>Default</th>
      <th>Action</th>

    </tr>
  </thead>
  <!--Table head-->
  <!--Table body-->
  <tbody>
  
 	<?php

	$user_address = $wpdb->get_results( "SELECT ad.default_address , ad.id, ad.post_id, ad.first_name,ad.last_name,ad.address_name,ad.delivery_address,ad.states,ad.zipcode,ad.type,co.name FROM wp_3_user_address as ad INNER JOIN  wp_3_countrylist as co ON co.id = ad.country_id WHERE ad.user_id=".get_current_user_id());
		
		foreach ( $user_address as $address )   {
			if($address->type == "Home Delivery"){?>
			
			<tr>
			  <th scope="row"><?=$address->first_name?>  <?=$address->last_name	?></th>
			  <td><?=$address->address_name?>  <?=$address->delivery_address?> <?=$address->states?>  <?=$address->city?> <?=$address->zipcode?></td>
			  <td><?=$address->name?> </td>
			  <td><?=$address->type?> </td>
			  <td> <label><input type="radio" id="defaultAddress" name="defaultAddress" value="<?=$address->id?>" onclick="javascript:makeDefaultAddress('<?=$address->id?>');"  <?php if($address->default_address) { echo 'checked'; }?>><span class="lbl padding-8"></span></label> </td>
			  <td><input type="button" class="btn btn-danger"  onclick="javascript:ConfirmDelete('<?=$address->id?>','test');" value="delete" /></td>		  
			</tr>
		<?php 
		
			}else{ 
			$content_post = get_post($address->post_id); 
			$address_full  = get_post_meta( $address->post_id, 'addressList_shop_address', true );
			$country  = get_post_meta( $address->post_id, 'addressList_shop_country', true );
			//var_dump($content_post);
?>
			<tr>
			  <th scope="row"><?=$address->first_name?>  <?=$address->last_name	?></th>
			  <td><?=$address_full?></td>
			  <td> <?=$country?></td>
			  <td><?=$address->type?> </td>
			  <td> <label><input type="radio" id="defaultAddress" name="defaultAddress" value="<?=$address->id?>" onclick="javascript:makeDefaultAddress('<?=$address->id?>');" <?php if($address->default_address) { echo 'checked'; }?>><span class="lbl padding-8"></span></label> </td>
			 <td><input type="button" class="btn btn-danger"   onclick="javascript:ConfirmDelete('<?=$address->id?>', 'test');" value="delete" /></td>  
			</tr>

		<?php }
		} ?>
  </tbody>
  <!--Table body-->
</table>
<!--Table-->
											  </div>
											  <div class="panel-footer">< Prev | Next > </div>
											</div>
										  </div>
										</div>
									</div>
								
							</div>
								<a href="./delivery-address-form/" style="background-color:#009efb;padding:10px;color:white;"> Add Deliver Address </a>
					</div>
					
				</div>
				<!--<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
					<div class="sale-statistic-inner notika-shadow mg-tb-30">
						  <h3 class="m-b-0" style="font-size:20px;"> Important Announcements</h3>
						  <hr/>
						   <div style="margin-left:10px">
						  <?php
						  
						  $sample  = "Please be advised that effective immediately, we will no longer accept CASH payments upon delivery. Cash payments will still be available for customers who will PICK UP package/s at our local office in Quezon City. This is to notify as well that we will NOT allow delivery of package for UNPAID invoices; we will still continue to provide notifications for unpaid invoices via email. Other payment options - Credit Card, PayPal, bank deposits (via BDO). Should you wish to deposit or transfer payment via our BDO account, please contact our hotline at 8-7152646 so we can provide bank details. Once payment has been made (bank deposit), please furnish us a copy or proof payment via our Facebook account (Kango Express Philippines), Viber (0917-5088822), Instagram (kangoexpressph).US Warehouse Will Be Closed on December 25th in observance of Christmas Day and January 1st 2020. No couriers will be delivering packages that day nor will any updates be made to packages.";
						 echo wp_trim_words( $sample , 90 ) ?>
						 <br/>
						 <hr/>
						 <a href ="#"> <u>Read More</u> </a>
						 </div>
					</div>
				</div>
				</div>-->
				
				
				
				<!--
                <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
                    <div class="sale-statistic-inner notika-shadow mg-tb-30">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">My Package</a></li>
                            <li><a data-toggle="tab" href="#menu1">My recepient Address</a></li>
                            <li><a data-toggle="tab" href="#menu2">My Account</a></li>
                          </ul>
                        
                        <div class="tab-content" style="padding:30px">
                            <div id="home" class="tab-pane fade in active">
                                <div class="card">
                                    <div class="card-body bg-light">
                                        <div class="row">
                                            <div class="col-6">
                                                <h2 class="m-b-0">Recent Package List</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                     
                                                <tr>
                                                    <th>Package ID</th>
                                                    <th>Date Order</th>
                                                   
                                                    <th>Status</th>

                                                </tr>
                                            </thead>
                                            <thbody>
                                       
                                            <?php $pachage = get_order_dashboard(); 
                                                foreach($pachage as $pak){
                                                $class = '';
                                                switch($pak['Status'])
                                                {
                                                    case 'arrival-shipment':
                                                      $class = 'on_the_way';
                                                      $status = 'On the way';
                                                    break;
                                                    case 'on-hold' :
                                                      $class = 'pending_payment';
                                                      $status = 'Pending payment';
                                                     break;
                                                    case 'processing' :
                                                        $class = 'preparing_shipment';
                                                        $status = 'Preparing for shipment';
                                                    break;
                                                    default:
                                                        $class = 'delivered';
                                                        $status = 'Delivered';
                                                    break;


                                                }

                                            ?>
                                                 <tr>
                                                 <td><a href="../my-account/view-order/<?=$pak['ID']?>/" target="_blank"><?=$pak['ID']?> </a></td>
                                                 <td><?=$pak['Date']?></td>
                                             
                                                 <td><span class="<?=$class?>" style="padding:10px;color:white; text-transform: uppercase;font-size:10px"><strong> <?=$status;?> </strong> </span></td>
                                                 </tr>
                                            <?php 
                                                }
                                            ?>
                                         
                                                
                                            
                                            </tbody>
                                        </table>
                                        <a href="#" class="btn btn-info"> View all </a>
                                    </div>
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body bg-light">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h2 class="m-b-0">Address List</h2>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <tbody>
                                                </tbody><thead>
                                                    <tr><th>Full Name</th>
                                                    <th>Address</th>
                                                    <th>Country</th>
                                                    <td>Action</td>
                                                </tr></thead>
                                                <tbody><tr>
                                                    <td><span>ed</span> <span>ward</span></td>
                                                    <td><span>manila</span> , <span>nav</span>, <span>5800</span>,</td>
                                                    <td><span>PH</span></td>
                                                    <td>
                                                        
                                                         <span><i>This
                                                                is your default address</i></span>
                                                </td></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body bg-light">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h2 class="m-b-0">Account details</h2>
                                                 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                        <form class="edit-account" method="Post" action="<?php the_permalink(); ?>" >
                                            <div class="row ">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label for="first-name"><?php _e('First Name', 'profile'); ?></label>
                                                        <input class="text-input form-control form-control-line" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" required="required" />
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                             <label for="last-name"><?php _e('Last Name', 'profile'); ?></label>
                                                           <input class="text-input form-control form-control-line" name="last-name" type="text" id="last-name" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>"  required="required"  />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                         <label for="email"><?php _e('E-mail *', 'profile'); ?></label>
                                                        <input class="text-input form-control form-control-line" name="email" type="email" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>"  required="required"  />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <hr/> -->
                                            <!-- <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-md-10">Current Password :</label>
                                                        <input type="password" class="form-control form-control-line" name="streetAddressNo" required="required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label for="pass1"><?php _e('Password *', 'profile'); ?> </label>
                                                    <input class="text-input  form-control form-control-line" name="pass1" type="password" id="pass1" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label for="pass2"><?php _e('Repeat Password *', 'profile'); ?></label>
                                                    <input class="text-input  form-control form-control-line" name="pass2" type="password" id="pass2" />
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <div class="col-sm-10">
                                                <?php echo $referer; ?>
                                                <input name="updateuser" type="submit" id="updateuser" class="submit btn btn-info"  value="<?php _e('Update', 'profile'); ?>" />
                                                <?php wp_nonce_field( 'update-user' ) ?>
                                                <input name="action" type="hidden" id="action" value="update-user" />
                                                </div>
                                            </div>
                                            </form>
                                            <?php do_action( 'woocommerce_after_edit_account_form' ); ?>
                                                                            </div>-->
                                    </div>
                                </div>
                            </div>
                          </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- End Sale Statistic area-->
    <div class="notika-email-post-area">
        <div class="container">
           
        </div>
    </div>
    <!-- Start Email Statistic area-->
    <?php require_once('template/footer.php');  ?>
    <!-- Start Footer area-->
    <?php require_once('template/javascript.php');  ?>
	    <script src="https://kendo.cdn.telerik.com/2020.2.513/js/jquery.min.js"></script>
    
    
    <script src="https://kendo.cdn.telerik.com/2020.2.513/js/kendo.all.min.js"></script>
	<script>

	function makeDefaultAddress(sval)
{
	var x = confirm("Are you sure you want to change default Address?");
	if (x)
	{
		var selectedRdoVal = $('input:radio[name=defaultAddress]:checked').val();
		jQuery('#loadingDiv').show();
		jQuery.ajax({
			type:"POST",
				url: "http://team661.com/wp-content/themes/advisor-dashboard/Class/dashboard-ajax.php",
			cache: false,
			data: {
					addID 		: selectedRdoVal,
					action  	: 'defaultAddress',
				},
			success:function(data){
				data = data.trim();
				console.log(data);
				if(data == 'Changed')
				{
						alert("Successfully update the default address");
						location.reload();
				}
				else
					alert(data);
			},
				error:function(data){
					alert(data); //===Show Error Message====
				}
		});
	}
	else {
		def_add_id = jQuery('#def_add_id').val();
		jQuery("input[name=defaultAddress][value="+def_add_id+"]").prop("checked",true);
		return false;
	}
}
function ConfirmDelete(addressID,del_delivery_add_hid)
{
	//alert(addressID);
  var x = confirm("Are you sure you want to delete?");
  if (x)
  {

	jQuery.ajax({
			type:"POST",
			url: "http://team661.com/wp-content/themes/advisor-dashboard/Class/dashboard-ajax.php",
			cache: false,
			data: {
					addID 	: addressID,
					action  : 'deleteUserDelAdd',
					_wpnonce : del_delivery_add_hid
				},
			success:function(data){
				data = data.trim();
				if(data == 'NOT') {
			
					
				}
				else if(data == 'Deleted')
				{
						alert("Successfully delete the address");
						location.reload();
				} else {
					alert(data);
					jQuery('#loadingDiv_address').hide();
				}
			}
		});
  }
  else
    return false;
}
	
jQuery(document).ready(function($){ 



	//alert('test');
	var data_pass = {'action':'listUserDeliveryAddress'};
	var AdvertisementDataSource = new kendo.data.DataSource({
		transport: {
			read: {
				url: "http://team661.com/wp-admin/admin-ajax.php",
				type: "GET",
				dataType: "json",
				contentType: "application/json; charset=utf-8",
				cache: false,
				data: data_pass 
			},
		},
		serverPaging: true,
		serverSorting: true,
		serverFiltering: true,
		pageSize: 5,
		schema: {
			data: "data",
			total: "total"
			/*model: {
				fields: {
--					delivery_address: { editable: false, nullable: false, type: "string" },
					country_nm: { editable: false, nullable: false, type: "string" },
					addressType: { editable: false, nullable: false, type: "string" },
					DEF_ADD: { editable: false, nullable: false, type: "string" },
					LINKS: { editable: false, nullable: false, type: "string" },
				}
			}*/
		}
	});
	var grid = $("#listData_address");
	grid.empty();
	console.log(AdvertisementDataSource);
	/*grid.kendoGrid({
		dataSource: AdvertisementDataSource,
		pageable: {
			refresh: true,
			pageSizes: [5, 10, 15],
			buttonCount: 5
		},
		sortable: false,
		filterable: false,
		columnMenu: false,
		columns: [
			{	field: "rec_name",
				title: "Recipient's Name",
				"width": "180px",
				encoded: false
			},
			{	field: "delivery_address",
				title: "Address",
				encoded: false,
				sortable: false, 
				filterable: false
			},
			{	field: "country_nm",
				title: "Country",
				"width": "120px"
			},
			{	field: "addressType",
				title: "Type",
				"width": "110px"
			},
			{	field: "DEF_ADD",
				title: "Default",
				encoded: false,
				sortable: false,
				filterable: false,
				"width": "65px"
			},
			{	field: "LINKS",
				title: "Action",
				encoded: false,
				sortable: false,
				filterable: false,
				"width": "90px",
				"menu": false
			}
		],
		dataBound: function (e) {
			jQuery('#loadingDiv_address').hide();
			var _TotalRecords = this.dataSource.total();
			if (_TotalRecords > 0) {
				$("#listData_address").show();
			}
		}
	});*/
});
	</script>
    <!-- End Footer area-->
    <!-- jquery -->


</html>