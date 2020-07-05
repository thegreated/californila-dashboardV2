
<?php

do_action('[template_redirect]');


$title = "Packages";
$url = get_stylesheet_directory_uri();
$args = array( 'post_type'   => 'address','post_status' => 'publish',"s" => 'Philippines');
$addressData = new WP_Query( $args );

$url = get_stylesheet_directory_uri();
require_once('template/header.php');

$args2 = array( 'post_type'   => 'announcement','post_status' => 'publish');

$announcement = new WP_Query( $args2 );


if(isset($_GET['success']) && $_GET['success'] == 'schedule_package'){
    $schedule_package = ' <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin:20px;">';
    $schedule_package .= '           <span class="alert-icon"><i class="ni ni-like-2"></i></span>';
    $schedule_package .= '             <span class="alert-text"><strong>Success!</strong> Your package is schedule to ship select the box to continue </span>';
    $schedule_package .= '             <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    $schedule_package .= '                 <span aria-hidden="true">×</span>';
    $schedule_package .= '             </button>';
    $schedule_package .= '         </div>';
}if(isset($_GET['errors']) && $_GET['errors'] == 'date_invalid' || $_GET['errors'] == 'date_invalid_data'){
    if($_GET['errors'] ==  'date_invalid_data');
    $error = "You enter invalid format of date please";
    if($_GET['errors'] ==  'date_invalid');
    $error = "You enter the date that is already past. Please enter a valid date.";

    $schedule_package = ' <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin:20px;">';
    $schedule_package .= '           <span class="alert-icon"><i class="ni ni-like-2"></i></span>';
    $schedule_package .= '             <span class="alert-text"><strong>Error!</strong>'.$error.' </span>';
    $schedule_package .= '             <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    $schedule_package .= '                 <span aria-hidden="true">×</span>';
    $schedule_package .= '             </button>';
    $schedule_package .= '         </div>';

}

?>


<!DOCTYPE html>
<html>
<?php
$title = "Packages Consolidators";
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
                    <div class="col-lg-6 col-5 text-right">
                        <a href="../packages/" class="btn btn-sm btn-neutral">Consolidator <?php apply_filters('user_package_budge','Consolidator') ;?></a>
                        <a href="../packages-personal-shopper" class="btn btn-sm btn-neutral">Personal Shopper<?php apply_filters('user_package_budge','Personal Shopper') ;?></a>
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
                    <?php if(isset($_GET['success']) && $_GET['success'] == 'schedule_package' || isset($_GET['errors']) && $_GET['errors'] == 'date_invalid'){
                        if(isset($schedule_package))
                            echo $schedule_package;

                    } ?>

                    <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Services Packages</h3>
                            </div>

                            <div class="col text-right">
                                <span href="#" class="badge " style="background-color:#ff989e">Some Input Required</span>
                                <span href="#" class="badge " style="background-color:#ffff7d">Available To Ship</span>
                                <span href="#" class="badge " style="background-color:#98f669">Schedule To Ship</span>
                            </div>

                        </div>
                    </div>

                    <?php
                    echo do_shortcode( '[get_packages order="Consolidator"]');
                    ?>



                    <!-- Light table -->

                    <!-- Card footer -->

                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">

                            <?php echo  do_action('package_button_data');
                            $shipment_id = get_user_meta($id,'shipment_schedule_id',true);
                            echo $shipment_id;
                            ?>
                        </div>


                            <div class="col text-right">
                               <!-- <span class="badge badge-pill badge-warning">P <?php echo do_shortcode('[get_total_data_warehouse_chargs]'); ?> - warehouse charges</span> -->
                                <span class="badge badge-info"><i class="ni ni-bag-17"></i> Package need Pay to proceed</span>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <!--- reserv package -->
            <div class="col">
                <div class="card">
              

                    <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Standby Package</h3>
                            </div>


                        </div>
                    </div>

                    <?php
                    echo do_shortcode( '[get_packages_standby order=""]');
                    ?>
                    <!-- Light table -->

                    <!-- Card footer -->

                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">

                            </div>


                            <div class="col text-right">

                              
                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <!--- close reserv package -->

            <!-- modal-->
                <div class="modal fade" id="shipment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Shipment Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Date :</label>
                                            <?php $myDate = date('m/d/Y', strtotime(' +2 day'));?>
                                            <input class="form-control datepicker" name="date_shipped" placeholder="Select date" type="text" value="<?=$myDate?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Type :</label> <small class="" style="color:red">
                                                <a href="../faq">What is this?</a></small>
                                                <select class="form-control" name="type" id="exampleFormControlSelect1">
                                                <option value="Air Cargo">Air Cargo</option>
                                                <option value="Sea Cargo">Sea Cargo</option>
                                            </select>
                                        </div>
                                        <small class="text-muted"> Please review the packages before saving changes on this process.</small>
                                    </div>
                                </div>
                                <div class="modal-footer">

                                    <?php wp_nonce_field( 'add-shipment-schedule' ) ?>
                                    <input name="action" type="hidden" id="action" value="add-shipment-schedule" />
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" id="submit_data" class="btn btn-primary" >Save changes</button>


                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            <!-- close modal -->
            <!-- Modal -->
            <div class="modal fade" id="reset_shipment_valid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Reset Schedule Authentication</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           Are you sure you want to reschedule the list of packages this will  <strong>permanently delete the schedule</strong> and reset the packages status to <strong>Ready to ship</strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form method="POST" name="reset-schedule-user">
                                <?php wp_nonce_field( 'reset-schedule-user' ) ?>
                                <input name="action" type="hidden" id="action" value="reset-schedule-user" />
                            <button type="submit"  class="btn btn-primary">Yes I understand</button>
                            </form>
                        </div>
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
<script src="<?=$url?>/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Argon JS -->
<script src="<?=$url?>/assets/js/argon.js?v=1.2.0"></script>
</body>

</html>

	<script>
        function change_to_reserve(sval,status,page) {

            var x = confirm("Are you sure this will take package to the Standby package?");
            if (x) {

                jQuery.ajax({
                    type: "POST",
                    url: "http://team661.com/wp-content/themes/advisor-dashboard/Class/dashboard-ajax.php",
                    cache: false,
                    data: {
                        order_id: sval,
                        status : status,
                        page : page,
                        action: 'change_status',
                    },
                    success: function (data) {
                        
                        location.reload();
                    }
                });

            }
        }

        function reset_schedule(sval)
        {
            var question = confirm("Are you sure you want to add product. This will clear your schedule data");
            if (question)
            {
                jQuery.ajax({
                    type: "POST",
                    url: "http://team661.com/wp-content/themes/advisor-dashboard/Class/dashboard-ajax.php",
                    cache: false,
                    data: {
                        action: 'reset_schedule',
                    },
                    success: function (data) {;
                        location.reload();
                    }
                });


            }
        }
        $('#submit_data').click(function(){
            $('#shipment_modal').hide();
        });

		$(document).ready(function () {

		    $('#selected_package').click(function(){
                var checked = []
                $("input[name='list_package[]']:checked").each(function ()
                {
                    checked.push(parseInt($(this).val()));
                });
                if( checked.length != 0){
                    $('#shipment_modal').modal('show');
                }
                return false;
            });

			wareHouseId = '';
			jQuery.ajax({
				type:"POST",
					url: "http://team661.com/wp-content/themes/advisor-dashboard/Class/dashboard-ajax.php",
				cache: false,
				data: {
						wareHouseId : '',
						action  	: 'listInboxAblConPack',
					},
				success:function(data){

				var myObject = JSON.parse( data );
				var package = '';

					  $.each(myObject, function(i, item) {

					      switch (item.status) {
                              case 'Schedule To Ship':
                                  background = '#98f669';

                                  break;
                              case 'Ready To Ship':
                                  background = '#ffff7d';
                                  break;
                              default:
                                  background = '#ff989e';
                                  break;

                          }
						package += '<tr style="background-color:'+background+'">';
                          if(item.status == 'Ready To Ship' && item.shipment_id == '') {
                              package += '<td> <input type="checkbox" name="list_package[]" value="' + item.id + '" /> </td>';

                          }else if(item.shipment_id  != ''){
                              package += '<td>   <span class="badge badge-info"><i class="ni ni-bag-17"></i> </span> </td>';
                          }else{
                              package += '<td></td>';
                          }
						package += '<td> '+item.date_received+' </td>';
						package += '<td>'+item.warehouse_name+'</td>';

						package += '<td> '+item.merchant_order+' </td>';
						package += '<td> P'+item.unit_cost+' </td>';
						package += '<td> '+item.resized_dimention_weight+' kg </td>';
						package += '<td> '+item.address_full+' </td>';
						package += '<td> '+item.status+' </td>';
						package += '<td> <a href="../view-package/?packages='+item.id+'" class="btn btn-icon btn-primary" type="button"><span class="btn-inner--icon"><i class="ni ni-settings-gear-65"></i></span></a>'+
                            '</td>';
						package += '</tr>';
					  });

					var tr = $('#body_package').append(package);

				},
					error:function(data){
						alert(data); //===Show Error Message====
				}
			});


          
                $(':checkbox:checked').each(function(i){
                    val[i] = $(this).val();
                    alert(val[i]);
                });

		});

	</script>


