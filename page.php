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

get_header('default');
?>


    <link rel="stylesheet" id="jsticket-admincss-css" href="http://team661.com/consolidators/wp-content/plugins/js-support-ticket/includes/css/admincss.css?ver=5.4.2" media="all">


    <div class="container mt--8 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">

            <div class="card bg-secondary border-0 mb-0">

                <div class="card card-stats">

                    <!-- Card body -->

                    <div class="card-body">

                        <div class="container">



                                        <?php if (have_posts()) : while (have_posts()) : the_post();
                                           the_content();

                                            ?>


                                        <?php endwhile; endif; ?>






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
