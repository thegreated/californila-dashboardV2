
<?php

do_action('[template_redirect]');

$url = get_stylesheet_directory_uri();
global $wpdb;
$title = "Dashboard";
require_once('template/header.php');

?>

<!DOCTYPE html>
<html>
<?php
$title = "Dashboard";
?>
<head>
    <?php require_once('template/header.php'); ?>

    <style>
        .woocommerce-error{
            padding:30px;
            background-color: #ff989e;
            border-radius: 10px;
            background: #ff989e;
        }
        .woocommerce{
            padding:0px;margin:0px;
        }
        .woocommerce .woocommerce-info{
            padding: 20px;
            background-color:#eeee;
        }
        #customer_details{
            padding:20px;
        }
        #customer_details div   {
            max-width: 100%;

        }
        #customer_details div .woocommerce-billing-fields h3{

            margin:0;padding:10px 0px 50px 0px;font-size:20px;
        }

        #customer_details div .woocommerce-billing-fields .woocommerce-billing-fields__field-wrapper p label{
            width: 40%;
        }
        #customer_details div .woocommerce-billing-fields .woocommerce-billing-fields__field-wrapper p span input , select , textarea
        {
            width: 70%;
            padding: 6px 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            }
        form {
            font-size: .875rem;

            transition: all .15s ease-in-out;
        }
        #order_review_heading{
            padding:20px;
            background-color: #eeeeee;
        }
        #order_review{
            padding:20px;
            border:1px solid #eeeeee;
        }
        #order_review table tbody tr td{
            padding:15px;
        }
        #order_review table thead tr th{
            padding:15px;
        }
        #order_review table tfoot tr th{
            padding:15px;
        }
        #order_review table{


        }
        #payment ul{
            padding:20px;
            list-style-type: none;
        }
        #payment ul li{

        }
        #place_order{
            color: #fff;
            border-color: #2dce89;
            background-color: #2dce89;
            box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
            font-size: .875rem;
            position: relative;
            transition: all .15s ease;
            letter-spacing: .025em;
            text-transform: none;
            will-change: transform;
            font-size: .875rem;
            font-weight: 600;
            line-height: 1.5;
            display: inline-block;
            padding: .625rem 1.25rem;
            cursor: pointer;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            text-align: center;
            vertical-align: middle;
            color: #525f7f;
            border: 1px solid transparent;
            border-radius: .25rem;

        }
        .form-row {
            display: block;
        }
        #order_comments_field label{
            display:none;
        }
        .about_paypal{
            padding:5px;
        }
</style>

    <?php if(isset($_GET['key']) ){ ?>
    <style>
        .woocommerce{
            padding:20px;margin:0px;
        }
        .woocommerce-order-details{
            padding:10px;
        }
        .woocommerce-customer-details{
            padding:10px;
        }
    </style>
    <?php } ?>
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
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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


                    <!-- Light table -->
                    <div class="table-responsive" style="padding:20px;">

                    <?php  echo do_shortcode('[woocommerce_checkout]') ?>

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

<!-- Argon JS -->

</body>

</html>
<script>

</script>

