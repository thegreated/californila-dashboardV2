<html class="no-js" lang="">
<?php

if (!is_user_logged_in()) {
    $page = get_page_by_title('login');
    wp_redirect(get_permalink($page->ID));
    exit;
}
$title = "Packages";
$url = get_stylesheet_directory_uri();
$args = array( 'post_type'   => 'address','post_status' => 'publish',"s" => 'Philippines');
$addressData = new WP_Query( $args );
global $wpdb;
$url = get_stylesheet_directory_uri();


$args2 = array( 'post_type'   => 'announcement','post_status' => 'publish');
$announcement = new WP_Query( $args2 );

if (isset( $_POST['action']) && 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-address-user' ) {
    $address_data =  isset( $_POST['address_data'] ) ? intval( $_POST['address_data'] ) : 0;
    $unit_cost = isset( $_POST['unit_cost'] ) ? intval( $_POST['unit_cost'] ) : 0;
    $idData = isset( $_POST['pa_id'] ) ? intval( $_POST['pa_id'] ) : 0;
    $defaults = array(
        'address_id' => (int)$address_data,
        'status'    => "Ready To Ship",
        'unit_cost' => (double)$unit_cost,


    );

    $wpdb->update('wp_3_packages',$defaults,array('id' => $idData ));
    //exit( var_dump( $wpdb->last_query ) );
}

?>

<!DOCTYPE html>
<html>
<?php
$title = "Dashboard";
?>
<style>
    body {
        font-family: Verdana, sans-serif;
        margin: 0;
    }

    * {
        box-sizing: border-box;
    }

    .row > .column {
        padding: 0 8px;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    .column {
        float: left;
        width: 25%;
    }


    /* The Close Button */
    .close {
        color: white;
        position: absolute;
        top: 10px;
        right: 25px;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #999;
        text-decoration: none;
        cursor: pointer;
    }

    .mySlides {
        display: none;
    }

    .cursor {
        cursor: pointer;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    img {
        margin-bottom: -4px;
    }

    .caption-container {
        text-align: center;
        background-color: black;
        padding: 2px 16px;
        color: white;
    }

    .demo {
        opacity: 0.6;
    }

    .active,
    .demo:hover {
        opacity: 1;
    }

    img.hover-shadow {
        transition: 0.3s;
    }

    .hover-shadow:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>
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
                                <li class="breadcrumb-item"><a href="#">Packages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Modify</li>
                            </ol>
                        </nav>

                    </div>

                </div>
            </div>
        </div>
    </div>
<style>

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 15px;
        display: flex;
    }

    /* Columns */
    .left-column {
        width: 65%;
        position: relative;
    }

    .right-column {
        width: 35%;
        margin-top: 60px;
    }


    /* Left Column */
    .left-column img {
        width: 100%;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .left-column img.active {
        opacity: 1;
    }


    /* Right Column */

    /* Product Description */
    .product-description {
        border-bottom: 1px solid #E1E8EE;
        margin-bottom: 20px;
    }
    .product-description span {
        font-size: 12px;
        color: #358ED7;
        letter-spacing: 1px;
        text-transform: uppercase;
        text-decoration: none;
    }
    .product-description h1 {
        font-weight: 300;
        font-size: 52px;
        color: #43484D;
        letter-spacing: -2px;
    }
    .product-description p {
        font-size: 16px;
        font-weight: 300;
        color: #86939E;
        line-height: 24px;
    }

    /* Product Configuration */
    .product-color span,
    .cable-config span {
        font-size: 14px;
        font-weight: 400;
        color: #86939E;
        margin-bottom: 20px;
        display: inline-block;
    }

    /* Product Color */
    .product-color {
        margin-bottom: 30px;
    }

    .color-choose div {
        display: inline-block;
    }

    .color-choose input[type="radio"] {
        display: none;
    }

    .color-choose input[type="radio"] + label span {
        display: inline-block;
        width: 40px;
        height: 40px;
        margin: -1px 4px 0 0;
        vertical-align: middle;
        cursor: pointer;
        border-radius: 50%;
    }

    .color-choose input[type="radio"] + label span {
        border: 2px solid #FFFFFF;
        box-shadow: 0 1px 3px 0 rgba(0,0,0,0.33);
    }

    .color-choose input[type="radio"]#red + label span {
        background-color: #C91524;
    }
    .color-choose input[type="radio"]#blue + label span {
        background-color: #314780;
    }
    .color-choose input[type="radio"]#black + label span {
        background-color: #323232;
    }

    .color-choose input[type="radio"]:checked + label span {
        background-image: url(images/check-icn.svg);
        background-repeat: no-repeat;
        background-position: center;
    }

    /* Cable Configuration */
    .cable-choose {
        margin-bottom: 20px;
    }

    .cable-choose button {
        border: 2px solid #E1E8EE;
        border-radius: 6px;
        padding: 13px 20px;
        font-size: 14px;
        color: #5E6977;
        background-color: #fff;
        cursor: pointer;
        transition: all .5s;
    }

    .cable-choose button:hover,
    .cable-choose button:active,
    .cable-choose button:focus {
        border: 2px solid #86939E;
        outline: none;
    }

    .cable-config {
        border-bottom: 1px solid #E1E8EE;
        margin-bottom: 20px;
    }

    .cable-config a {
        color: #358ED7;
        text-decoration: none;
        font-size: 12px;
        position: relative;
        margin: 10px 0;
        display: inline-block;
    }
    .cable-config a:before {
        content: "?";
        height: 15px;
        width: 15px;
        border-radius: 50%;
        border: 2px solid rgba(53, 142, 215, 0.5);
        display: inline-block;
        text-align: center;
        line-height: 16px;
        opacity: 0.5;
        margin-right: 5px;
    }

    /* Product Price */
    .product-price {
        display: flex;
        align-items: center;
    }

    .product-price span {
        font-size: 26px;
        font-weight: 300;
        color: #43474D;
        margin-right: 20px;
    }

    .cart-btn {
        display: inline-block;
        background-color: #7DC855;
        border-radius: 6px;
        font-size: 16px;
        color: #FFFFFF;
        text-decoration: none;
        padding: 12px 30px;
        transition: all .5s;
    }
    .cart-btn:hover {
        background-color: #64af3d;
    }

    /* Responsive */
    @media (max-width: 940px) {
        .container {
            flex-direction: column;
            margin-top: 60px;
        }

        .left-column,
        .right-column {
            width: 100%;
        }

        .left-column img {
            width: 300px;
            right: 0;
            top: -65px;
            left: initial;
        }
    }

    @media (max-width: 535px) {
        .left-column img {
            width: 220px;
            top: -85px;
        }
    }

</style>

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <form  method="POST" name="save_edit_address" >
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">My Address List</h3>
                            </div>
                            <!-- Button trigger modal -->
                       
                            <div class="col text-right">

                                    <div class="btn_group">

                                        <?php wp_nonce_field( 'update-address-user' ) ?>
                                        <input name="action" type="hidden" id="action" value="update-address-user" />
                                        <button class="btn btn-primary" name="loginuser"  type="submit"  >Update</button>
                                        <button class="btn btn-primary"  type="button" disabled>Refund</button>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Discard
                                        </button>
                                        <button  class="btn btn-primary"  type="button" disabled>Customer Service</button>

                            </div>
                        </div>
                    </div>
                    <hr/>
                    <!-- Light table -->
                    <div class="table-responsive" style="padding:10px 50px 0px 50px;">
                        <div class="left-column">
                            <img data-image="black" src="http://team661.com/consolidators/wp-content/themes/advisor-dashboard/assets/img/icons/black.png" alt="">
                            <img data-image="blue" src="http://team661.com/consolidators/wp-content/themes/advisor-dashboard/assets/img/icons/black.png" alt="">
                            <img data-image="red" class="active" src="http://team661.com/consolidators/wp-content/themes/advisor-dashboard/assets/img/icons/black.png" aglt="">
                        </div>


                        <!-- Right Column -->
                        <div class="right-column">

                            <!-- Product Description -->
                            <div class="product-description">
                                <span>Headphones</span>
                                <h1>Beats EP</h1>
                                <p>The preferred choice of a vast range of acclaimed DJs. Punchy, bass-focused sound and high isolation. Sturdy headband and on-ear cushions suitable for live performance</p>
                            </div>

                            <!-- Product Configuration -->
                            <div class="product-configuration">

                                <!-- Product Color -->
                                <div class="product-color">
                                    <span>Color</span>

                                    <div class="color-choose">
                                        <div>
                                            <input data-image="red" type="radio" id="red" name="color" value="red" checked>
                                            <label for="red"><span></span></label>
                                        </div>
                                        <div>
                                            <input data-image="blue" type="radio" id="blue" name="color" value="blue">
                                            <label for="blue"><span></span></label>
                                        </div>
                                        <div>
                                            <input data-image="black" type="radio" id="black" name="color" value="black">
                                            <label for="black"><span></span></label>
                                        </div>
                                    </div>

                                </div>

                                <!-- Cable Configuration -->
                                <div class="cable-config">
                                    <span>Cable configuration</span>

                                    <div class="cable-choose">
                                        <button>Straight</button>
                                        <button>Coiled</button>
                                        <button>Long-coiled</button>
                                    </div>

                                    <a href="#">How to configurate your headphones</a>
                                </div>
                            </div>

                            <!-- Product Pricing -->
                            <div class="product-price">
                                <span>148$</span>
                                <a href="#" class="cart-btn">Add to cart</a>
                            </div>
                        </div>
                        </main>

                    </div>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        <nav aria-label="...">

                        </nav>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Californila Discard Request form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div id="custom-radios-component" class="tab-pane tab-example-result fade show active" role="tabpanel" aria-labelledby="custom-radios-component-tab">
                        <h3> Please Discard : </h3>
                        <div class="custom-control custom-radio mb-3">
                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                            <label class="custom-control-label" for="customRadio1">Just The items that is damage or cannot ship. Please prepare the remaing item for shipment.</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                            <label class="custom-control-label" for="customRadio2">The entire package and its content.</label>
                        </div>
                        <br/>
                        <br/>
                        <h3> Special instruction  : </h3>
                        <div id="input-alternative-component" class="tab-pane tab-example-result fade show active" role="tabpanel" aria-labelledby="input-alternative-component-tab">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <div>
                            <p>I acknowledge that once i authorize Californila to discard my package.It will no longer be available for me to ship and will became the property of Californila ,
                            todo as they  see fit.</p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

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
<!-- Argon JS -->

</body>

</html>