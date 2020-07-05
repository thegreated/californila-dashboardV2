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
require_once('template/header.php');

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

<head>

    <style>
        .error{
            color:red;
            margin:5px;
        }
        .btn_default{
            background-color:#009efb;padding:10px;color:white;
            background-color: #009efb;
            padding: 10px;
            color: white;

        }
        .btn_group{
            margin-top:10px;
        }
    </style>


</head>

<body>

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
                <?php require_once('template/dahboard_menu.php'); ?>
            </div>
        </div>
    </div>
</div>

<div class="notika-status-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4-sm-4 col-xs-4"  style="padding:0;margin:0">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30" style="background-color:#fcb2b6">
                    <p style="margin:0">Package Required to action</p>

                </div>
            </div>
            <div class="col-lg-4 col-md-4-sm-4 col-xs-4" style="padding:0;;margin:0">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30" style="background-color:#ffff7d;">
                    <p style="margin:0">Package available to ship</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4-sm-4 col-xs-4" style="padding:0;e;margin:0">
                <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30" style="background-color:#e2f4d9;">
                    <p style="margin:0">Package Schedule to ship</p>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Status area-->



<div class="container py-5 mb-10 pb-10">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-10">
            <form  method="POST" name="save_edit_address" >

                <div class="sale-statistic-inner notika-shadow">
                    <h3 class="m-b-0" style="font-size:20px;">Packages Details</h3>
                    <hr>
                    <table class="table table-bordered" id="my-table" style="width:100%">
                        <thead  style="background-color:#00c292">
                        <tr>

                            <th>ID</th>
                            <th>Date Received</th>
                            <th>Merchant</th>
                            <th>Warehouse</th>
                            <th>Weight</th>
                            <th>Volume</th>
                            <th>Tracking # Package</th>
                            <th>Cost</th>
                            <th>Service type</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody id="body_package">
                        <tr>
                        <?php if(isset($_GET['packages'])){
                            $id  = get_current_user_id();
                          //  echo 'SELECT * FROM wp_3_packages WHERE user_id='.$id .' AND id='.$_GET['packages'];
                            $items = $wpdb->get_results( 'SELECT * FROM wp_3_packages WHERE user_id='.$id .' AND id='.$_GET['packages'] );
                            $title = $wpdb->get_results( 'SELECT ID, post_title FROM wp_3_posts WHERE ID='.$items->warehouse_id ); // var_dump($items);

                           echo '<td>'. $items[0]->id.'</td>';
                            echo '<td>'. $items[0]->date_received.'</td>';
                            echo '<td></td>';
                            echo '<td>'. $title [0]->name.'</td>';
                            echo '<td>'. $items[0]->resized_dimention_weight.'</td>';
                            echo '<td></td>';
                            echo '<td></td>';
                            echo '<td>'. $items[0]->unit_cost.'</td>';
                            echo '<td>'. $items[0]->service_type.'</td>';
                            echo '<td>'. $items[0]->status.'</td>';
                    }
                        ?>
                        </tr>

                        </tbody>

                   </table>
                    <hr/>
                    <style>
                        .row div{
                            padding:10px;
                        }
                    </style>
                    <div class="row">
                        <div class="col-sm-4">Merchant Order</div>
                        <div class="col-sm-6"><?= $items[0]->merchant_order?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">Resized Dimention</div>
                        <div class="col-sm-6">
                            <table class="table table-bordered" id="my-table" style="width:100%">
                                <thead  style="background-color:#00c292">
                                <th>Lenght</th>
                                <th>Width</th>
                                <th>Height</th>
                                <th>Weight</th>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?=$items[0]->resized_dimention_lenght?>cm</td>
                                        <td><?=$items[0]->resized_dimention_height?>cm</td>
                                        <td><?=$items[0]->resized_dimention_width?>cm</td>
                                        <td><?=$items[0]->resized_dimention_weight?>kg</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">Reduction</div>
                        <div class="col-sm-6"><?= $items[0]->reduction?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">Packing List Enclosed</div>
                        <div class="col-sm-6"><?= $items[0]->enclosure?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">Service Type</div>
                        <div class="col-sm-6"><?= $items[0]->service_type?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">Delivery Address</div>
                        <div class="col-sm-4">
                            <input type="hidden" value="<?=$items[0]->id?>" name="pa_id" />

                        <select class="form-control" name="address_data">
                            <?php $add02 = $wpdb->get_results( 'SELECT  * FROM wp_3_user_address WHERE id='.$items[0]->address_id);

                           // if ($add02->type == "Home Delivery")
                            if(!empty($add02) && $add02[0]->delivery_address == ''){
                                echo '<option value="'.$row->id.'">Pick up > Californila Philippines</option>';
                            }else {
                                echo '<option value="' . $add02[0]->id . '">' . $add02[0]->address_name . '  ' . $add02[0]->delivery_address . ' ' . $add02[0]->states . ' ' . $add02[0]->city . ' ' . $add02[0]->zipcode . ' ' . $add02[0]->name . '</option>';
                            }
                          //  else
                             //   echo '<option value="'.$add02->id.'">Pick up > Californila Philippines</option>';
                            ?>

                            <?php
                            $add = $wpdb->get_results( 'SELECT adds.id, adds.address_name, adds.delivery_address, adds.states, adds.city,adds.city,adds.zipcode , adds.type , c.name FROM wp_3_user_address as adds INNER JOIN wp_3_countrylist as c ON adds.country_id = c.id   WHERE adds.user_id='.$id );


                            foreach($add as $row) {

                                if ($row->type == "Home Delivery")
                                    echo '<option value="'.$row->id.'">' . $row->address_name . '  ' . $row->delivery_address . ' ' . $row->states . ' ' . $row->city . ' ' . $row->zipcode . ' ' . $row->name . '</option>';
                                else
                                    echo '<option value="'.$row->id.'">Pick up > Californila Philippines</option>';

                            }
                            ?>
                        </select>
                        </div>
                        <div class="col-sm-4">

                            <a href="./delivery-address-form/" style="background-color:#009efb;padding:10px;color:white;"> Add Deliver Address </a>
                        </div>
                    </div>
                    <table class="table table-bordered" id="my-table" style="width:100%;" >
                        <thead style="background-color:#00c292">
                        <th>Quantity</th>
                        <th>Description</th>
                        <th>Classification</th>
                        <th>Unit Cost</th>
                        <th>Total </th>

                        </thead>
                        <tbody>
                        <tr>
                            <td><?=$items[0]->qty?></td>
                            <td><?=$items[0]->description?></td>
                            <td><?=$items[0]->classification?></td>
                            <td><input class="form-control" name="unit_cost" type="text" value="<?=$items[0]->unit_cost?>" /></td>
                            <td>P<?=$items[0]->unit_cost?></td>
                        </tr>
                        </tbody>
                    </table>



                </div>
                <div class="btn_group">
                    <?php wp_nonce_field( 'update-address-user' ) ?>
                    <input name="action" type="hidden" id="action" value="update-address-user" />
                <button class="btn btn-primary" name="loginuser"  type="submit"  >Update</button>
                <button class="btn btn-primary"  type="button" disabled>Refund/Forwading Request</button>
                <button class="btn btn-primary"  type="button" disabled>Discard</button>
                <button  class="btn btn-primary"  type="button" disabled>Contact Customer Service</button>
                </div>
             </form>

        </div>

    </div>
</div>
</div>
</body>
<?php require_once('template/footer.php');  ?>
<?php require_once('template/user_javascript.php');  ?>

<script>




</script>



</div>