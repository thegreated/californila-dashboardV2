
<?php

do_action('[template_redirect]');

$url = get_stylesheet_directory_uri();
$args = array( 'post_type'   => 'address','post_status' => 'publish',"s" => 'Philippines');
$addressData = new WP_Query( $args );
global $wpdb;
$url = get_stylesheet_directory_uri();

function get_num_of_date($date_received){
    date_default_timezone_set('America/Chicago');
    $now = time(); // or your date as well
    $your_date = strtotime($date_received);
    $datediff = $now - $your_date;

    return round($datediff / (60 * 60 * 24));
}
//get_warehouse_charges
if (isset( $_POST['action']) && 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'save_charges' ) {
    if(isset($_POST['package_data']) && $_POST['package_data'] != '')
    {
         $product_id =   $_POST['package_data'] ;
         $qty = 1;
          global $woocommerce;
         $woocommerce->cart->empty_cart();
         $woocommerce->cart->add_to_cart($product_id,$qty);
        if ( !function_exists( 'wc_get_checkout_url' ) ) {
            require_once '/includes/wc-core-functions.php';
        }

        $result = wc_get_checkout_url();
        echo '<script type="text/javascript"> window.location = "'.$result.'" </script>';
        exit;



    }else{
        $error_save = "You need to choose box that you want to ship!";

    }


}

$havemeta = get_user_meta( get_current_user_id()    , 'shipment_schedule_id', false );
$style = "pointer-events: none;opacity: 0.4;";

if ($havemeta != []) {
   $items = $wpdb->get_results('SELECT * FROM 	wp_3_shipment_schedule WHERE id=' . $havemeta[0]);
    if($items[0]->product_suggestion != ''){
        $style = "";
    }else{
        $error_product = '<div class="alert alert-info" role="alert" style="margin:10px"> <strong>Information:!</strong> Please wait while the warehouse staff review your package for box suggestion! </div>';
    }
}
?>

<!DOCTYPE html>
<html>
<?php
$title = "Purchase";
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
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Package</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Purchase</li>
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

            <div class="col-8">

                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Purchase</h3>
                        <?php if(isset($error_product) && $error_product != '')
                                echo $error_product;

                            ?>
                    </div>
                    <?php if(isset($error_save) && $error_save != ''){ ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin:20px;">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text"><strong>Error!</strong> <?=$error_save?> </span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    <?php } ?>
                    <hr style="margin:0px;padding:0px">
                    <form method="POST" style=" <?=$style?>">
                    <!-- Light table -->
                    <div class="table-responsive" style="padding:10px 50px 0px 50px;">
                        <?php

                        global $wpdb;
                        $items = $wpdb->get_results( 'SELECT * FROM wp_3_shipment_schedule WHERE id='.$havemeta[0] );
                     
                        $products_query = $wpdb->get_results( "
                                SELECT  p.ID AS id,
                                        p.post_title AS name,
                                        Max(CASE WHEN pm.meta_key = '_price' AND  p.ID = pm.post_id THEN pm.meta_value END) AS price
                                FROM    {$wpdb->prefix}posts p
                                        INNER JOIN {$wpdb->prefix}postmeta pm
                                            ON p.ID = pm.post_id
                                WHERE   p.ID = ".$items[0]->product_suggestion."
                                        AND p.post_type = 'product_variation'
                                        AND p.post_status = 'publish'
                                        AND p.post_parent != 0
                                      
                                        
                                GROUP BY p.ID
                                ORDER BY p.ID ASC;
                                
                            " );


                        // Testing raw output

                       echo '<div class="form-group">
                        <label for="example-number-input" class="form-control-label">Select the Box you want to ship</label>
                      <select class="form-control" id="package_data" name="package_data">
                    <option value="">Select Package</option>';
                      foreach($products_query as $product){?>
                          <option value="<?=$product->id?>"><?=$product->name ?></option>
                      <?php }
                      echo ' </select> </div>';
                      //  $products_query = $wpdb->get_results( " SELECT * FROM  {$wpdb->prefix}posts WHERE post_type= 'product_variation';");
                        //echo '<pre>'; print_r( $products_query ); echo '</pre>';
                        ?>
                <hr/>
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Date Received</th>
                                <th scope="col">Warehouse</th>

                                <th scope="col">Merchant</th>
                                <th scope="col">Value</th>
                                <th scope="col">Weight</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Days</th>

                            </tr>
                            </thead>
                            <tbody id="">
                            <p>List of Packages inside the box</p>
                            <?php
                            echo do_shortcode('[purchase_table_data]');



                            ?>

                            </tbody>

                        </table>
                        <table class="table align-items-center table-flush">
                            <tr>
                                <td>Total Package: <strong><?php echo do_shortcode('[admin_total_shipment shipment="'.$havemeta[0].'"]')?></strong> </td>
                                <td>Total Weight: <strong><?php echo do_shortcode('[purchase_total_lbs shipment="'.$havemeta[0].'"]')?>lbs</strong> <a href="../faq">What is this?</a> </td>
                                <td>Total Package Value: <strong>$<?php echo do_shortcode('[purchase_total_cost shipment="'.$havemeta[0].'"]')?> </td>
                            </tr>
                        </table>


                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        <nav aria-label="...">
                            <?php wp_nonce_field( 'save_charges' ) ?>
                            <input name="action" type="hidden" id="action" value="save_charges" />
                            <button type="submit" class="btn btn-success" name="save_charges">Checkout</button>
                        </nav>
                    </div>
                    </form>

                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Purchase</h3>
                    </div>


                    <!-- Light table -->
                    <div class="table-responsive">

                        <table class="table rate-list"><thead>
                            <th>Charged</th>
                            <th>Rate</th>
                            </thead>
                            <tbody id="receipt_details">


                            </tbody>

                        </table>
                        <hr style="padding:0;margin:0">
                        <div style="padding:20px;">
                            <td>

                            </td>
                        </div>


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



<!-- Argon Scripts -->
<!-- Core -->
<script src="<?=$url?>/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?=$url?>/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?=$url?>/assets/vendor/js-cookie/js.cookie.js"></script>
<script src="<?=$url?>/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?=$url?>/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>

<script>
    $(document).ready(function () {

        $('#package_data').on('change', function() {
            if( this.value != '') {
                jQuery.ajax({
                    type: "POST",
                    url: "http://team661.com/wp-content/themes/advisor-dashboard/Class/dashboard-ajax.php",
                    cache: false,
                    data: {
                        item_id: this.value,
                        action: 'get_price_item',
                    },
                    success: function (data) {
                        $('#receipt_details').html(data);
                    },
                    error: function (data) {
                        alert(data); //===Show Error Message====
                    }

                });
            }

        });


    });


</script>
</body>

</html>

