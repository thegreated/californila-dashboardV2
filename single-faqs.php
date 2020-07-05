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

get_header('page');
?>




    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">

                <div class="card bg-secondary border-0 mb-0">

                    <div class="card card-stats">

                        <!-- Card body -->

                            <div class="card-body">

                                <div class="container">


                                    <div class="row">
                                        <div class="col-md-4">



                                            <ul class="list-group" style="border:0px">
                                                <?php

                                                $categories = get_categories();
                                                foreach($categories as $category) {
                                                    
                                                    if($category->name  != "Uncategorized"){
                                                            echo '   <li class="list-group-item"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                                                    }
                                                }
                                                ?>

                                            </ul>
                                        </div>
                                        <div class="col-md-8">
                                            <div id="accordion">
                                                <?php if (have_posts()) : while (have_posts()) : the_post();
                                                    global $post;

                                                ?>
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#<?=$post->post_name;?>" aria-expanded="true" aria-controls="<?=$post->post_name;?>">
                                                                <?php the_title(); ?>
                                                            </button>
                                                        </h5>
                                                    </div>

                                                    <div id="<?=$post->post_name;?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <?php the_content(); ?> </div>
                                                    </div>
                                                </div>
                                                <?php endwhile; endif; ?>

                                        </div>

                                    </div>
                                </div>




                            </div>



                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
<?php
get_footer();