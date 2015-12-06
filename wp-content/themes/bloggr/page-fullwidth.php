<?php
/**
Template Name: Full-Width Page
 *
 * @package bloggr
 */

get_header(); ?>

<div class="grid grid-pad">
	<div class="col-1-1">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
    
                <?php while ( have_posts() ) : the_post(); ?>
    
                    <?php get_template_part( 'content', 'page' ); ?>
    
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
</div>
<?php get_footer(); ?>
