<html class="no-js" lang="">
<?php

do_action('[template_redirect]');
$url = get_stylesheet_directory_uri();
$args = array( 'post_type'   => 'address','post_status' => 'publish',"s" => 'Philippines');
$addressData = new WP_Query( $args );
global $wpdb;
$title = "Dashboard | Orders"; 
$url = get_stylesheet_directory_uri();
require_once('template/header.php');

?>

<head>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.2.513/styles/kendo.default-v2.min.css" />
	<style>
	.error{
		color:red;
		margin:5px;
	}
	.purchase-list-page__tabs-container {
    overflow: hidden;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
}
	.purchase-list-page__tab {
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    font-size: 1rem;
    line-height: 1.1875rem;
    padding: 1rem 0;
    color: rgba(0,0,0,.8);
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    -moz-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -moz-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -moz-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
}
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

	</style>
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
                            <li class="nav-item">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle" style="text-transform: capitalize;"><small> <?=$current_user->first_name;?></small></a>
                               
                            </li>
                            <li class="nav-item">
                                <a href="./logout"  class="nav-link dropdown-toggle"><small>Logout</small></a>
                               
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
                        <li class="active"><a data-toggle="tab" href="../dashboard""><strong> Dashboard </strong></a>
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

<div class="container py-5">
    <div class="row">
      <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
			<div class="sale-statistic-inner notika-shadow mg-tb-0">
				   <div style="margin-left:10px;">
						<div class="purchase-list-page__tabs-container">
							<div class="purchase-list-page__tab"><span class="purchase-list-page__tab-label"> <a href='../orders/'>All</a></span></div>
							<div class="purchase-list-page__tab"><span class="purchase-list-page__tab-label"><a href='../orders/?status=1'>To Pay <?php echo do_shortcode( '[dashboard_order_number order="wc-on-hold" orders_page= "true"]'); ?></a></span></div>
							<div class="purchase-list-page__tab"><span class="purchase-list-page__tab-label"><a href='../orders/?status=2'>To Ship <?php echo do_shortcode( '[dashboard_order_number order="wc-processing" orders_page= "true"]' ); ?></a></span></div>
							<div class="purchase-list-page__tab"><span class="purchase-list-page__tab-label"><a href='../orders/?status=3'>On the way <?php echo do_shortcode( '[dashboard_order_number order="wc-arrival-shipment" orders_page= "true"]' ); ?></a></span></div>
							<div class="purchase-list-page__tab"><span class="purchase-list-page__tab-label"><a href='../orders/?status=4'>Delivered <?php echo do_shortcode( '[dashboard_order_number order="wc-completed" orders_page= "true"]' ); ?></a></span></div>
						</div>
				 </div>
			</div>
		</div>
		 <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12" style="margin-top:10px">
			 <div class="sale-statistic-inner notika-shadow mg-tb-0">
				<div id="home" class="tab-pane fade in active">
					<div class="card">
					
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
						 
									<tr>
										<th>Package ID</th>
										<th>Date Order</th>						   
										<th>Status</th>

									</tr>
								</thead>
								<tbody>
								
									<?php 
									if(isset($_GET['status'])){
										switch($_GET['status']){
											case "1":
									
											echo do_shortcode('[orders_modified order="wc-on-hold"]');
											break;
											case "2":
											echo do_shortcode('[orders_modified order="wc-processing"]');
											break;
											case "3":
											echo do_shortcode('[orders_modified order="wc-arrival-shipment"]');
											break;
											default:
											echo do_shortcode('[orders_modified order="wc-completed"]');
											break;
											
									
										}
									}else{
										echo do_shortcode('[orders_all]');
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
		</div>
		</div>
			
        </div>
    </div>
</div>
  
  <?php require_once('template/footer.php');  ?>
      <?php require_once('template/user_javascript.php');  ?>


</div>
</body>