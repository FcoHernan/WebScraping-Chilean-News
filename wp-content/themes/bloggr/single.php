<?php
/**
 * The template for displaying all single posts.
 *
 * @package bloggr
 */

get_header(); ?>

<div class="grid grid-pad">
	<div class="col-9-12">
        <div id="primary" class="content-area single-blog-post">
            <main id="main" class="site-main" role="main">
    
            <?php while ( have_posts() ) : the_post(); ?>
    
                <?php get_template_part( 'content', 'single' ); ?>
    
                <?php bloggr_post_nav(); ?>
    
                <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                ?>
    
            <?php endwhile; // end of the loop. ?>
    
            </main><!-- #main -->
        </div><!-- #primary -->
	</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
