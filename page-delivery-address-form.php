
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

?>

<!DOCTYPE html>
<html>
<?php
$title = "Dashboard";
?>
<head>
    <?php require_once('template/header.php'); ?>
</head>

<body>
<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="<?=$url?>/assets/img/brand/mainlogo2.png" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <?php require_once('template/menu.php'); ?>
        </div>
    </div>
</nav>
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav -->
    <?php require_once('template/navigation.php'); ?>
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0"><?=$title ?></h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Address</li>
                            </ol>
                        </nav>

                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Add Address</h3>
                    </div>

                    <hr/>
                    <!-- Light table -->
                    <div class="table-responsive" style="padding:10px 50px 0px 50px;">

                        <form id="form_home_validate" method="POST" name="save_new_address" novalidate="novalidate">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="inputFirstname">First name *</label>
                                    <input type="text" class="form-control" name="new_address_fname">
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputLastname">Last name *</label>
                                    <input type="text" class="form-control" name="new_address_lname">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="inputAddressLine1">Address Name *</label>
                                    <input type="text" class="form-control" name="new_address">
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputAddressLine2">Company</label>
                                    <input type="text" class="form-control" name="new_company">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="inputContactNumber">Delivery Address *</label>
                                    <input type="text" class="form-control" name="new_deliver_address">
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputWebsite">Delivery Address2 *</label>
                                    <input type="text" class="form-control" name="new_deliver_address_two">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="inputWebsite">State *</label>
                                    <input type="text" class="form-control" name="new_state">
                                </div>
                                <div class="col-sm-3">
                                    <label for="inputState">City*</label>
                                    <input type="text" class="form-control" name="new_city">
                                </div>
                                <div class="col-sm-3">
                                    <label for="inputPostalCode">Zip Code*</label>
                                    <input type="number" class="form-control" name="new_zipcode">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="inputAddressLine1">Primary Phone Code*</label>

                                    <select class="form-control" name="new_primary_code">

                                        <option value="3">PHILIPPINES(6392)</option>

                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputAddressLine2">Primary Phone*</label>
                                    <input type="number" class="form-control" name="new_primary_phone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="inputContactNumber">Secondary Phone Code</label>

                                    <select class="form-control" name="new_secodary_code">

                                        <option value="">PHILIPPINES(6392)</option>

                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputWebsite">Secondary Phone</label>
                                    <input type="number" class="form-control" name="new_secodary_phone">
                                </div>
                            </div>
                            <input type="hidden" id="_wpnonce" name="_wpnonce" value="2e14f432ce"><input type="hidden" name="_wp_http_referer" value="/consolidators/delivery-address-form/">						 <input name="action" type="hidden" id="action" value="add-address">
                            <input type="hidden" class="form-control" name="new_type" value="Home Delivery">
                            <button type="submit" name="loginuser" class="btn btn-primary px-4 float-right">Save</button>
                        </form>

                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        <nav aria-label="...">

                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dark table -->
        <!-- Footer -->
        <?php require_once('template/footer.php'); ?>
    </div>


</div>
<?php require_once('template/modal-list.php'); ?>

<!-- Argon Scripts -->
<!-- Core -->
<script src="assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/js-cookie/js.cookie.js"></script>
<script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Argon JS -->
<script src="assets/js/argon.js?v=1.2.0"></script>
</body>

</html>
<script>
jQuery(document).ready(function($){ 

	  $("input[name=delivery_type]").on( "change", function() {
         var value = $(this).val();
		switch(value){
			case "home":
			$(".home_address").css("display", "block");
			$(".pickup_address").css("display", "none");
			break;
			default:
			$(".home_address").css("display", "none");
			$(".pickup_address").css("display", "block");
			break;
			
		}
			
       
    } );
});
</script>

