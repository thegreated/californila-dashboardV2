<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */
do_action('[template_redirect]');
get_header('tracking');

?>


    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <form action="">
                        <div class="card-body">
                            <div id="tracking-plan">

                            </div>
                            <div   class="input-group mb-3 p-3">

                                    <input type="text" name="tacking_system" id="tacking_system" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" required>
                                    <div class="input-group-append">

                                        <input name="action" type="hidden" id="action" value="track-package" />
                                        <button class="btn btn-primary" type="button" id="button-track"><i class="ni ni-zoom-split-in"></i><span>Track now!</span></button>

                                    </div>

                            </div>
                            <div id="tracking-result">
                               
                            </div>



                        </div>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

    <!-- Footer -->
<?php
get_footer();


?>
<script>
    $(document).ready(function () {
        var tracking = getUrlParameter('tracking');
        if(tracking != undefined) {
            $.ajax({
                url: "http://team661.com/wp-content/themes/advisor-dashboard/Class/dashboard-ajax.php",
                type: "POST", //send it through get method
                data: {
                    tracking: tracking,
                    action: 'home_tracking_order',
                },
                success: function (data) {
                    $('#tracking-plan').html('');
                    $('#tracking-result').html('');
                    if (data == 'error') {
                        var error = ' <div class="alert alert-warning alert-dismissible fade show" role="alert">';
                        error += '    <span class="alert-icon"><i class="ni ni-fat-delete"></i></span>';
                        error += '        <span class="alert-text"><strong>Warning!</strong> The tracking code you enter is invalid, please check your recent email for verification.</span>';
                        error += '      <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                        error += '           <span aria-hidden="true">×</span> </button> </div>';
                        $('#tracking-plan').append(error);

                    } else {
                        jQuery('#tracking-result').html(data);

                    }
                },
                error: function (xhr) {
                    //Do Something to handle error
                }
            });
        }

        jQuery('#button-track').click(function (){
        jQuery.ajax({
            type: "POST",
            url: "http://team661.com/wp-content/themes/advisor-dashboard/Class/dashboard-ajax.php",
            cache: false,
            data: {
                tracking: $('#tacking_system').val(),
                action: 'home_tracking_order',
            },

            success: function (data) {
                $('#tracking-plan').html('');
                $('#tracking-result').html('');
                if(data=='error') {
                    var error = ' <div class="alert alert-warning alert-dismissible fade show" role="alert">';
                    error += '    <span class="alert-icon"><i class="ni ni-fat-delete"></i></span>';
                    error += '        <span class="alert-text"><strong>Warning!</strong> The tracking code you enter is invalid, please check your recent email for verification.</span>';
                    error += '      <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    error += '           <span aria-hidden="true">×</span> </button> </div>';

                    $('#tracking-plan').append(error);
                }else{
                        jQuery('#tracking-result').html(data);

                }

            }
        });
     });

         function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
        };

    });

</script>
