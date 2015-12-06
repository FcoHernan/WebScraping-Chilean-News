<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package bloggr
 */

get_header(); ?>

<div class="grid grid-pad">
	<div class="col-9-12">
        <div id="primary" class="content-area single-post">
            <main id="main" class="site-main" role="main">
    
            <?php if ( have_posts() ) : ?>
    
                <header class="page-header">
                    <?php
                        the_archive_title( '<h1 class="page-title">', '</h1>' );
                        the_archive_description( '<div class="taxonomy-description">', '</div>' );
                    ?>
                </header><!-- .page-header -->
    
    			<div id="masonry-container">
                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
    
                    <?php
                        	
						if ( has_post_format( 'aside' )) { get_template_part( 'content', 'aside' ); } 
						
						elseif ( has_post_format( 'image' )) { get_template_part( 'content', 'image' ); } 
						
						elseif ( has_post_format( 'quote' )) { get_template_part( 'content', 'quote' ); } 
						
						elseif ( has_post_format( 'link' )) { get_template_part( 'content', 'link' ); } 
					
						else 
						
                        get_template_part( 'content', get_post_format() );
                    ?>
    
                <?php endwhile; ?>
    			</div>
                <?php bloggr_paging_nav(); ?>
    
            <?php else : ?>
    
                <?php get_template_part( 'content', 'none' ); ?>
    
            <?php endif; ?>
    
            </main><!-- #main -->
        </div><!-- #primary -->
	</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
