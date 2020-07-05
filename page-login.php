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
            <div class="col-lg-5 col-md-4">
                <?php if(isset($_GET['errors']) && $_GET['errors'] == 'privacy' ) { ?>
                <div class="alert alert-warning" role="alert">
                    <strong>Error!</strong> You need to login first to visit this page!
                </div>
                <?php } ?>

                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent">
                        <div class="text-muted text-center">Sign in your account.</div>
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
                        <a href="http://team661.com/consolidators/registration/" class="text-light"><small>Create new account</small></a>
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