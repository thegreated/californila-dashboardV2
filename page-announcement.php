<html class="no-js" lang="">
<?php

if (!is_user_logged_in()) {
  $page = get_page_by_title('login');
	wp_redirect(get_permalink($page->ID));
  exit;
}
$url = get_stylesheet_directory_uri();
$args = array( 'post_type'   => 'address','post_status' => 'publish',"s" => 'Philippines');
$addressData = new WP_Query( $args );
global $wpdb;
 $title = "Dashboard"; 
$url = get_stylesheet_directory_uri();
require_once('template/header.php');

$args2 = array( 'post_type'   => 'announcement','post_status' => 'publish');
$announcement = new WP_Query( $args2 );



?>

<head>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.2.513/styles/kendo.default-v2.min.css" />
	<style>
	.error{
		color:red;
		margin:5px;
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
					<div class="sale-statistic-inner notika-shadow mg-tb-30">
						  <h3 class="m-b-0" style="font-size:20px;"> Important Announcements</h3>
						  <hr>
						   <div style="margin-left:10px">
								 <?php    if( $announcement->have_posts() ) :
											  while ($announcement->have_posts()) : $announcement->the_post();

									    the_content(); 
												
										?>
										
															
														<?php
													
													
													
											 endwhile;
												wp_reset_postdata();
													else :
														esc_html_e( 'No testimonials in the diving taxonomy!', 'text-domain' );
													endif;
									?>
						 </div>
					</div>
				</div>
			
        </div>
    </div>
</div>
  
  <?php require_once('template/footer.php');  ?>
      <?php require_once('template/user_javascript.php');  ?>


</div>