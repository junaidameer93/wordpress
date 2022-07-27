<?php
    get_header(); ?>

<div class="section">
    <div class="container">
        <div class="row">
            <?php
                global $wpdb;

                if (get_query_var('paged')) {
                    $paged = get_query_var('paged');
                } else if (get_query_var('page')) {
                    $paged = get_query_var('page');
                } else {
                    $paged = 1;
                }

                $temp = $wp_query;  // re-sets query
                $wp_query = null;   // re-sets query
                $args = array(
                    'post_type' => CPT_PROJECTS,
                    'orderby' => 'Date',
                    'order' => "DESC",
                    'post_status' => 'publish',
                    'posts_per_page' => '6',
                    'paged' => $paged,

                );
                // current page
                $wp_query = new WP_Query();
                $wp_query->query($args);
                $totalPage = $wp_query->max_num_pages;
                if ($wp_query->have_posts()) : ?>

            <div class="col-md-8">

                <div class="news-container">
                    <?php
                        // Start the Loop.
                        while ($wp_query->have_posts()) : $wp_query->the_post();
                            ?>
                            <div class="post" id="post-<?php the_ID(); ?>">

                                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php the_title(); ?></a></h2>
                                <figure class="col-md-12">
                                    <a href="<?= get_permalink() ?>"><?php the_post_thumbnail('large', array('class' => 'media-object img-responsive')); ?></a>
                                </figure>
                                <div class="entry">

                                    <?php the_content(); ?>

                                </div>

                            </div>
                        <?php endwhile; ?>
                    <nav>
                        <?php paginate();
                            $wp_query = null;
                            $wp_query = $temp; // Reset?>
                    </nav>

                </div>

                <?php
                    // If no content, include the "No posts found" template.
                    else :
                        //get_template_part( 'template-parts/content', 'none' );
                        echo "<p>No News found.</p>";

                    endif;
                    wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>
