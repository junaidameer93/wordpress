<?php
get_header(); ?>

<div class="section">
	<div class="container">
		<div class="row">
            <?php
			global $wpdb;
			$args = array(
				'post_type' => 'projects',
				'orderby' => 'Date',
				'order' => "DESC",
				'post_status' => 'publish',
				'posts_per_page' => '6'

			);
			// current page
			$args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
			$data = new WP_Query( $args );
			if ( $data->have_posts() ) : ?>

			<div class="col-md-8">

				<div class="news-container">
					<?php
					// Start the Loop.
                        while ( $data->have_posts() ) : $data->the_post();
                        ?>
						<div class="post" id="post-<?php the_ID(); ?>">

                            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <?php the_title(); ?></a></h2>
                            <figure class="col-md-12">
                                <a href="<?=get_permalink()?>"><?php the_post_thumbnail('large',array( 'class' => 'media-object img-responsive' ));?></a>
                            </figure>
                            <div class="entry">

                                <?php the_content(); ?>


                            </div>

                        </div>
					<?php endwhile;

					wp_reset_postdata();
					?>


				</div>

				<?php
				// Previous/next page navigation.
				the_posts_pagination( array(
					'prev_text'          => '<button>privous</button>',
					'next_text'          => '<button>next</button>',
					'screen_reader_text' => '&nbsp;',
					'before_page_number' => '',
					'mid_size'    => 3,
				) );
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
