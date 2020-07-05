<!doctype html>
<html class="no-js" lang="">
<?php

do_action('[template_redirect]');
global $wpdb;
$title = "Dashboard";
$url = get_stylesheet_directory_uri();


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
<!--                    <div class="col-lg-6 col-5 text-right">-->
<!--                        <a href="#" class="btn btn-sm btn-neutral">New</a>-->
<!--                        <a href="#" class="btn btn-sm btn-neutral">Filters</a>-->
<!--                    </div>-->
                </div>

                <div class="row">
                    <div class="col-lg-12 col-12">
                        <?php if(isset($_GET['success']) && $_GET['success'] == 'address' || $_GET['success'] == 'delete_address' || $_GET['success'] == 'save_address'){ ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin:20px;">
                                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                <?php switch($_GET['success']){
                                    case 'save_address':?>
                                        <span class="alert-text"><strong>Success!</strong> You successfully change the default address!</span>
                                     <?php   break;
                                    case 'delete_address':?>
                                        <span class="alert-text"><strong>Success!</strong> You successfully delete the address!</span>
                                        <?php   break;
                                    case 'address':
                                    ?>
                                <span class="alert-text"><strong>Success!</strong> You successfully add the new address!</span>
                                <?php
                                        break;
                                    default:
                                        break;
                                } ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-xl-3 col-md-6">

                        <div class="card card-stats">

                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Pending Payment</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo do_shortcode( '[dashboard_order_number order="wc-on-hold" ]' ); ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                            <i class="ni ni-active-40"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Preparing for shipment</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo do_shortcode( '[dashboard_order_number order="wc-processing"]' ); ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">

                                            <i class="ni ni-money-coins"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">On the way</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo do_shortcode( '[dashboard_order_number order="wc-arrival-shipment"]' ); ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                            <i class="ni ni-spaceship"></i>

                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Delivered</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo do_shortcode( '[dashboard_order_number order="wc-completed"]' ); ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                            <i class="ni ni-check-bold"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
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
                        <h3 class="mb-0">Announcement</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name"></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <div class="m-10">
                            <?php echo do_shortcode('[dashboard_announcement]'); ?>
                        </div>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        <div class="m-10">
                           Read More
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">My Address List</h3>
                            </div>
                            <div class="col text-right">
                                <a href="../add-delivery-address" class="btn btn-sm btn-primary"> Add Deliver Address</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Recipient's Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Country</th>
                                <th scope="col">Type</th>
                                <th scope="col">Default</th>
                                <th scope="col">	Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php echo do_shortcode('[dashboard_address_list]'); ?>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">

                <div class="card">

                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Address</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                    
                        <?php echo do_shortcode('[dashboard_us_address]'); ?>
                        <hr/>
                        <?php echo do_shortcode('[dashboard_default_address]'); ?>
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

?>
	<script>

	function makeDefaultAddress(sval)
{
	var x = confirm("Are you sure you want to change default Address?");
	if (x)
	{
        jQuery.ajax({
            type:"POST",
            url: "http://team661.com/wp-content/themes/advisor-dashboard/Class/dashboard-ajax.php",
            cache: false,
            data: {
                addID 	: sval,
                action  : 'defaultAddress'

            },
            success:function(data){
                data = data.trim();
                if(data == 'NOT') {


                }
                else if(data == 'Changed')
                {
                    window.location.href = "http://team661.com/consolidators/dashboard/?success=save_address";
                } else {
                    alert(data);
                    jQuery('#loadingDiv_address').hide();
                }
            }
        });
	}
	else {
		def_add_id = jQuery('#def_add_id').val();
		jQuery("input[name=defaultAddress][value="+def_add_id+"]").prop("checked",true);
		return false;
	}
}
function ConfirmDelete(addressID,del_delivery_add_hid)
{
	//alert(addressID);
  var x = confirm("Are you sure you want to delete?");
  if (x)
  {

	jQuery.ajax({
			type:"POST",
			url: "http://team661.com/wp-content/themes/advisor-dashboard/Class/dashboard-ajax.php",
      cache: false,
      data: {
      addID 	: addressID,
          action  : 'deleteUserDelAdd',
          _wpnonce : del_delivery_add_hid
  },
      success:function(data){
          data = data.trim();
          if(data == 'NOT') {


          }
          else if(data == 'Deleted')
          {
              window.location.href = "http://team661.com/consolidators/dashboard/?success=delete_address";

          } else {
              alert(data);
              jQuery('#loadingDiv_address').hide();
          }
      }
  });
  }
  else
    return false;
}

jQuery(document).ready(function($){



	//alert('test');
	var data_pass = {'action':'listUserDeliveryAddress'};
	var AdvertisementDataSource = new kendo.data.DataSource({
		transport: {
			read: {
				url: "http://team661.com/wp-admin/admin-ajax.php",
				type: "GET",
				dataType: "json",
				contentType: "application/json; charset=utf-8",
				cache: false,
				data: data_pass
			},
		},
		serverPaging: true,
		serverSorting: true,
		serverFiltering: true,
		pageSize: 5,
		schema: {
			data: "data",
			total: "total"
			/*model: {
				fields: {
--					delivery_address: { editable: false, nullable: false, type: "string" },
					country_nm: { editable: false, nullable: false, type: "string" },
					addressType: { editable: false, nullable: false, type: "string" },
					DEF_ADD: { editable: false, nullable: false, type: "string" },
					LINKS: { editable: false, nullable: false, type: "string" },
				}
			}*/
		}
	});
	var grid = $("#listData_address");
	grid.empty();
	console.log(AdvertisementDataSource);
	/*grid.kendoGrid({
		dataSource: AdvertisementDataSource,
		pageable: {
			refresh: true,
			pageSizes: [5, 10, 15],
			buttonCount: 5
		},
		sortable: false,
		filterable: false,
		columnMenu: false,
		columns: [
			{	field: "rec_name",
				title: "Recipient's Name",
				"width": "180px",
				encoded: false
			},
			{	field: "delivery_address",
				title: "Address",
				encoded: false,
				sortable: false,
				filterable: false
			},
			{	field: "country_nm",
				title: "Country",
				"width": "120px"
			},
			{	field: "addressType",
				title: "Type",
				"width": "110px"
			},
			{	field: "DEF_ADD",
				title: "Default",
				encoded: false,
				sortable: false,
				filterable: false,
				"width": "65px"
			},
			{	field: "LINKS",
				title: "Action",
				encoded: false,
				sortable: false,
				filterable: false,
				"width": "90px",
				"menu": false
			}
		],
		dataBound: function (e) {
			jQuery('#loadingDiv_address').hide();
			var _TotalRecords = this.dataSource.total();
			if (_TotalRecords > 0) {
				$("#listData_address").show();
			}
		}
	});*/
});
	</script>
    <!-- End Footer area-->
    <!-- jquery -->


</html>