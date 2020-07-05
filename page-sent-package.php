
<?php

do_action('[template_redirect]');

$url = get_stylesheet_directory_uri();
$args = array( 'post_type'   => 'address','post_status' => 'publish',"s" => 'Philippines');
$addressData = new WP_Query( $args );

$url = get_stylesheet_directory_uri();
require_once('template/header.php');

$args2 = array( 'post_type'   => 'announcement','post_status' => 'publish');

$announcement = new WP_Query( $args2 );

?>


<!DOCTYPE html>
<html>
<?php
$title = "Sent Package";
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

                    </div>

                </div>
            </div>
        </div>
    </div>

    <form method="POST" >
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <div class="row">

                <div class="col">
                    <div class="card">
                        <?php if(isset($_GET['success']) && $_GET['success'] == 'schedule_package'){ ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin:20px;">
                                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                <span class="alert-text"><strong>Success!</strong> Your package is schedule to ship select the box to continue </span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        <?php } ?>
                        <?php $home_url = home_url(); ?>
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Sent Packages</h3>
                                </div>
                                <div class="col text-right">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-secondary  <?php if(!isset($_GET['search'])) echo 'active'; ?>"> 
                                    <a href="<?=$home_url?>/sent-package/"> <div name="options1" id="option1" > Processing</a></div>
                                    </label>
                                    <label class="btn btn-secondary  <?php if(isset($_GET['search']) && $_GET['search'] == 'ship' ) echo 'active'; ?>">
                                    <a href="<?=$home_url?>/sent-package/?search=ship"> <div name="options2" id="option2"> Ship</a> </div>
                                    </label>
                                    <label class="btn btn-secondary  <?php if(isset($_GET['search']) && $_GET['search'] == 'transit' ) echo 'active'; ?>">
                                    <a href="<?=$home_url?>/sent-package/?search=transit"> <div name="options3" id="option3" > Transit</a></div>
                                    </label>
                                    <label class="btn btn-secondary <?php if(isset($_GET['search']) && $_GET['search'] == 'received-manila' ) echo 'active'; ?>">
                                    <a href="<?=$home_url?>/sent-package/?search=received-manila"> <div name="options4" id="option3" > Received Manila</a></div>
                                    </label>
                                    <label class="btn btn-secondary <?php if(isset($_GET['search']) && $_GET['search'] == 'out-for-delivery' ) echo 'active'; ?>">
                                    <a href="<?=$home_url?>/sent-package/?search=out-for-delivery"> <div name="options5" id="option3" > Out for Delivery</a></div>
                                    </label>
                                    <label class="btn btn-secondary <?php if(isset($_GET['search']) && $_GET['search'] == 'delivered' ) echo 'active'; ?>">
                                    <a href="<?=$home_url?>/sent-package/?search=delivered">  <div name="options" id="option3" > Delivered</a></div>
                                    </label>
                                </div>
                                </div>
                            </div>
                        </div>
          

                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>

                                <th scope="col">Date Modified</th>

                                <th scope="col">Number of Package</th>

                              
                                <th scope="col">Tracking code</th>
                                <th scope="col">Deliverty Addres</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody id="">

                            <?php
                            if(isset($_GET['search'])){
                                switch($_GET['search']){
                                    case 'ship':
                                        echo do_shortcode('[shipment_sent status="processing"]');
                                    break;
                                    case 'transit':
                                        echo do_shortcode('[shipment_sent status="transit"]');
                                    break;
                                    case 'received-manila':
                                        echo do_shortcode('[shipment_sent status="received-manila"]');
                                    break;
                                    case 'out-for-delivery':
                                        echo do_shortcode('[shipment_sent status="delivery"]');
                                    break;
                                    case 'delivered':
                                        echo do_shortcode('[shipment_sent status="completed"]');
                                    break;
                                    default :
                                        //processing
                                         echo do_shortcode('[shipment_sent status="on-hold"]');
                                    break;
                                     
                                }
                            }else{
                                //processing
                                echo do_shortcode('[shipment_sent status="on-hold"]');
                            }
                            ?>
                            </tbody>
                        </table>


                    </div>
                </div>

            </div>


            <!-- Dark table -->
            <!-- Footer -->
            <?php require_once('template/footer.php'); ?>
        </div>

    </form>

</div>
<?php require_once('template/modal-list.php'); ?>


<!-- Argon Scripts -->
<!-- Core -->

<script src="<?=$url?>/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?=$url?>/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?=$url?>/assets/vendor/js-cookie/js.cookie.js"></script>
<script src="<?=$url?>/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?=$url?>/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<script src="<?=$url?>/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Argon JS -->

</body>

</html>

<script>

</script>


