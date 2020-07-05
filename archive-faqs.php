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
                                                <?php 
                                         
                                                global $paged;
                                                $curpage = $paged ? $paged : 1;
                                                $args = array(
                                                    'post_type' => 'faqs',
                                                    'orderby' => 'post_date',
                                                    'paged'          => get_query_var('paged', 1),
                                                    'posts_per_page' => 1
                                                );
                                                $query = new WP_Query($args);
                                                if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
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
                                                <?php 
                                                endwhile;
                                        
                                                echo '<nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                  <li class="page-item disabled">
                                                    <a class="page-link" href="'.get_pagenum_link(($curpage-1 > 0 ? $curpage-1 : 1)).'" tabindex="-1">
                                                      <i class="fa fa-angle-left"></i>
                                                      <span class="sr-only">Previous</span>
                                                    </a>
                                                  </li>
                                                 ';
                                                 for($i=1;$i<=$query->max_num_pages;$i++)
                                                 echo '
                                                  <li class="page-item '.($i == $curpage ? 'active ' : '').'"><a class="page-link" href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
                                                  echo '
                                                  <li class="page-item">
                                                    <a class="page-link" href="'.get_pagenum_link(($curpage+1 <= $query->max_num_pages ? $curpage+1 : $query->max_num_pages)).'">
                                                      <i class="fa fa-angle-right"></i>
                                                      <span class="sr-only">Next</span>
                                                    </a>
                                                  </li>
                                                </ul>
                                              </nav>';
                                                wp_reset_postdata();
                                            endif;
                                                 ?>
                                                <?php 
                                                ?>
                                             

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