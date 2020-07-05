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

get_header();
?>


    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent">
                        <div class="text-muted text-center">Register your account.</div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>



                            <?php the_content(); ?>


                        <?php endwhile; endif; ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="http://team661.com/consolidators/forgot-password/" class="text-light"><small>Forgot password?</small></a>
                    </div>
                    <div class="col-6 text-right">
                        <a href="http://team661.com/consolidators/login/" class="text-light"><small>Sign in</small></a>
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
    var wppbRecaptchaCallback = function() {
        if( typeof window.wppbRecaptchaCallbackExecuted == "undefined" ){//see if we executed this before
            jQuery(".wppb-recaptcha-element").each(function(){
                recID = grecaptcha.render( jQuery(this).attr("id"), {
                    "sitekey" : "6Lc186YZAAAAAMG4zeW3TWTyjHBbIwoxbF9F5cIP",
                    "error-callback": wppbRecaptchaInitializationError,

                });
            });
            window.wppbRecaptchaCallbackExecuted = true;//we use this to make sure we only run the callback once
        }
    };

    /* the callback function for when the captcha does not load propperly, maybe network problem or wrong keys  */
    function wppbRecaptchaInitializationError(){
        window.wppbRecaptchaInitError = true;
        //add a captcha field so we do not just let the form submit if we do not have a captcha response
        jQuery( ".wppb-recaptcha-element" ).after('<input type="hidden" id="wppb_recaptcha_load_error" name="wppb_recaptcha_load_error" value="7ae7cdcaad" />');
    }

    /* compatibility with other plugins that may include recaptcha with an onload callback. if their script loads first then our callback will not execute so call it explicitly  */
    jQuery( window ).on( "load", function() {
        wppbRecaptchaCallback();
    });
</script><script src="https://www.google.com/recaptcha/api.js?onload=wppbRecaptchaCallback&render=explicit&hl=en" async defer></script><script type='text/javascript' src='http://team661.com/wp-content/plugins/profile-builder/assets/js/script-front-end.js?ver=3.1.8'></script>
