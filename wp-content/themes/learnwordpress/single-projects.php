<?php get_header(); ?>

    <div id="container">

        <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

            <div class="post" id="post-<?php the_ID(); ?>">

                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php the_title(); ?></a></h2>

                <div class="entry">

                    <?php the_content(); ?>


                </div>

            </div>

        <?php endwhile; ?>

            <div class="navigation">
                <?php previous_post_link('%link') ?> <?php next_post_link(' %link') ?>
            </div>

        <?php endif; ?>

    </div>

<?php get_footer(); ?>