<html class="no-js" lang="">
<?php

do_action('[template_redirect]');

$title = "Packages";
$url = get_stylesheet_directory_uri();
global $wpdb;
if (isset( $_POST['action']) && 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-address-user' ) {
    if(is_numeric( $_POST['unit_cost'] )){
        $unit_cost = isset($_POST['unit_cost']) ? intval($_POST['unit_cost']) : 0;
        $status = $_POST['status'];
        $packages = $wpdb->get_results('SELECT id FROM '.$wpdb->prefix.'user_address WHERE user_id='.get_current_user_id().' AND default_address=1 ' );
        $id = $_GET['packages'];
        if($status == "Pick up" || $status == "" && !empty($packages)){

            update_post_meta($id,'package_list_address_id',  $packages[0]->id);
            update_post_meta($id,'package_list_status', 'Ready To Ship');
            update_post_meta($id,'package_list_cost', $unit_cost);

        }elseif(!empty($packages) && $status != "Pick up"){
            update_post_meta($id,'package_list_address_id',  $packages[0]->id);
            update_post_meta($id,'package_list_cost', $unit_cost);

        }
        $error = '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin:20px;">
                                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                                                        <span class="alert-text"><strong>Success!</strong>You successfully save the data</span>
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>';
    }else{
        $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin:20px;">
                                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                                                        <span class="alert-text"><strong>Error!</strong>Please enter a valid number!</span>
                                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>';
    }
}
?>

<!DOCTYPE html>
<html>
<?php

?>
<style>

    /*****************globals*************/


    img {
        max-width: 100%; }

    .preview {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column; }
    @media screen and (max-width: 996px) {
        .preview {
            margin-bottom: 20px; } }

    .preview-pic {
        -webkit-box-flex: 1;
        -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
        flex-grow: 1; }

    .preview-thumbnail.nav-tabs {
        border: none;
        margin-top: 15px; }
    .preview-thumbnail.nav-tabs li {
        width: 18%;
        margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
        max-width: 100%;
        display: block; }
    .preview-thumbnail.nav-tabs li a {
        padding: 0;
        margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
        margin-right: 0; }

    .tab-content {
        overflow: hidden; }
    .tab-content img {
        width: 100%;
        -webkit-animation-name: opacity;
        animation-name: opacity;
        -webkit-animation-duration: .3s;
        animation-duration: .3s; }

    .card {

        background: #eee;
        padding: 3em;
        line-height: 1.5em; }

    @media screen and (min-width: 997px) {
        .wrapper {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex; } }

    .details {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column; }

    .colors {
        -webkit-box-flex: 1;
        -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
        flex-grow: 1; }

    .product-title, .price, .sizes, .colors {
        text-transform: UPPERCASE;
        font-weight: bold; }

    .checked, .price span {
        color: #ff9f1a; }

    .product-title, .rating, .product-description, .price, .vote, .sizes {
        margin-bottom: 15px; }

    .product-title {
        margin-top: 0; }

    .size {
        margin-right: 10px; }
    .size:first-of-type {
        margin-left: 40px; }

    .color {
        display: inline-block;
        vertical-align: middle;
        margin-right: 10px;
        height: 2em;
        width: 2em;
        border-radius: 2px; }
    .color:first-of-type {
        margin-left: 20px; }

    .add-to-cart, .like {
        background: #ff9f1a;
        padding: 1.2em 1.5em;
        border: none;
        text-transform: UPPERCASE;
        font-weight: bold;
        color: #fff;
        -webkit-transition: background .3s ease;
        transition: background .3s ease; }
    .add-to-cart:hover, .like:hover {
        background: #b36800;
        color: #fff; }

    .not-available {
        text-align: center;
        line-height: 2em; }
    .not-available:before {
        font-family: fontawesome;
        content: "\f00d";
        color: #fff; }

    .orange {
        background: #ff9f1a; }

    .green {
        background: #85ad00; }

    .blue {
        background: #0076ad; }

    .tooltip-inner {
        padding: 1.3em; }

    @-webkit-keyframes opacity {
        0% {
            opacity: 0;
            -webkit-transform: scale(3);
            transform: scale(3); }
        100% {
            opacity: 1;
            -webkit-transform: scale(1);
            transform: scale(1); } }

    @keyframes opacity {
        0% {
            opacity: 0;
            -webkit-transform: scale(3);
            transform: scale(3); }
        100% {
            opacity: 1;
            -webkit-transform: scale(1);
            transform: scale(1); } }

    /*# sourceMappingURL=style.css.map */
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
                <div class="">
                    <!-- Card header -->
                    <form  method="POST" name="save_edit_address" >
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Package Details</h3>
                            </div>
                            <!-- Button trigger modal -->
                       
                            <div class="col text-right">

                                    <div class="btn_group">

                                        <?php wp_nonce_field( 'update-address-user' ) ?>
                                        <input name="action" type="hidden" id="action" value="update-address-user" />


                            </div>
                        </div>
                    </div>
                    <hr/>
                    <!-- Light table -->
                    <div class="table-responsive"   >
                        <div class="container">
                            <div class="">
                                <div class="container-fliud">
                                    <?php if(isset($error)){echo $error;} ?>
                                   <?php apply_filters('view_package',$_GET['packages']) ?>
                                </div>
                            </div>
                         </div>
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