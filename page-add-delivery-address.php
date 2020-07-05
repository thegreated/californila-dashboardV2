
<?php

do_action('[template_redirect]');
$url = get_stylesheet_directory_uri();
global $wpdb;
$title = "Address";
$url = get_stylesheet_directory_uri();

if (isset( $_POST['action']) && 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'add-address' ) {

    $table_name = $wpdb->prefix . "user_address";
    $wpdb->insert($table_name,array(
        'first_name' => $_POST['new_address_fname'],
        'last_name' => $_POST['new_address_lname'],
        'address_name' => $_POST['new_address'],
        'company' => $_POST['new_company'],
        'delivery_address' => $_POST['new_deliver_address'],
        'delivery_address_two' => $_POST['new_deliver_address_two'],
        'states' => $_POST['new_state'],
        'city' => $_POST['new_city'],
        'zipcode' => $_POST['new_zipcode'],
        'primary_phone_id' => (int)$_POST['new_primary_code'],
        'primary_phone' => (int)$_POST['new_primary_phone'],
        'second_phone_id' => (int)$_POST['new_secodary_code'],
        'second_phone' => (int)$_POST['new_secodary_phone'],
        'type' => $_POST['new_type'],
        'country_id' =>   'Philippines' ,   //static
        'user_id' => get_current_user_id(),
        'date'  => date("F j, Y, g:i a"),
        'default_address' => 0
    ));
    if($wpdb->last_error !== '') :

        my_print_error();

    endif;


}


function my_print_error(){

    global $wpdb;

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

<!DOCTYPE html>
<html>
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
                <img src="<?=$url?>/assets/img/brand/californila-logo.png" class="navbar-brand-img" alt="...">
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
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name"></th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>

                    <!-- Light table -->
                    <div class="table-responsive" style="padding:10px 50px 0px 50px;">
                        <?php   if (!empty($errors )) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin:20px;">
                                <span class="alert-icon"><!--<i class="ni ni-like-2"></i> --></span>
                                <span class="alert-text">	<?php	echo  implode("<br />", $errors); ?></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        <?php } ?>

                        <form id="form_home_validate" method="POST" name="save_new_address" novalidate="novalidate">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="inputFirstname">First name *</label>
                                    <input type="text" class="form-control" name="new_address_fname" value="<?php if(isset($_POST['new_address_fname'])){ echo $_POST['new_address_fname'];} ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputLastname">Last name *</label>
                                    <input type="text" class="form-control" name="new_address_lname" value="<?php if(isset($_POST['new_address_lname'])){ echo $_POST['new_address_lname'];} ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="inputAddressLine1">Address Name *</label>
                                    <input type="text" class="form-control" name="new_address"  value="<?php if(isset($_POST['new_address'])){ echo $_POST['new_address'];} ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputAddressLine2">Company</label>
                                    <input type="text" class="form-control" name="new_company"  value="<?php if(isset($_POST['new_company'])){ echo $_POST['new_company'];} ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="inputContactNumber">Delivery Address *</label>
                                    <input type="text" class="form-control" name="new_deliver_address"   value="<?php if(isset($_POST['new_deliver_address'])){ echo $_POST['new_deliver_address'];} ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputWebsite">Delivery Address 2 </label>
                                    <input type="text" class="form-control" name="new_deliver_address_two"   value="<?php if(isset($_POST['new_deliver_address_two'])){ echo $_POST['new_deliver_address_two'];} ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="inputWebsite">State *</label>
                                    <input type="text" class="form-control" name="new_state"   value="<?php if(isset($_POST['new_state'])){ echo $_POST['new_state'];} ?>">
                                </div>
                                <div class="col-sm-3">
                                    <label for="inputState">City*</label>
                                    <input type="text" class="form-control" name="new_city"   value="<?php if(isset($_POST['new_city'])){ echo $_POST['new_city'];} ?>">
                                </div>
                                <div class="col-sm-3">
                                    <label for="inputPostalCode">Zip Code*</label>
                                    <input type="number" class="form-control" name="new_zipcode"   value="<?php if(isset($_POST['new_zipcode'])){ echo $_POST['new_zipcode'];} ?>">
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
                                    <input type="number" class="form-control" name="new_primary_phone"  value="<?php if(isset($_POST['new_primary_phone'])){ echo $_POST['new_primary_phone'];} ?>">
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
                                    <input type="number" class="form-control" name="new_secodary_phone" value="<?php if(isset($_POST['new_secodary_phone'])){ echo $_POST['new_secodary_phone'];} ?>">
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
<script src="<?=$url?>/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?=$url?>/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?=$url?>/assets/vendor/js-cookie/js.cookie.js"></script>
<script src="<?=$url?>/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?=$url?>/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Argon JS -->
<script src="<?=$url?>/assets/js/argon.js?v=1.2.0"></script>
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

