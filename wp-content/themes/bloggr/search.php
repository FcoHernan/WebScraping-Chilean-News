<?php
/**
 * The template for displaying search results pages.
 *
 * @package bloggr
 */

get_header(); ?>

<div class="grid grid-pad">
	<div class="col-9-12">
        <section id="primary" class="content-area page-search">
            <main id="main" class="site-main" role="main">
    
            <?php if ( have_posts() ) : ?>
    
                <header class="page-header">
                    <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'bloggr' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </header><!-- .page-header -->
    
    			
    		 	<div id="masonry-container">
                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
    
                    <?php
                    /**
                     * Run the loop for the search to output the results.
                     * If you want to overload this in a child theme then include a file
                     * called content-search.php and that will be used instead.
                     */
                    get_template_part( 'content', 'search' );
                    ?>
    
                <?php endwhile; ?>
    			</div>
                
                <?php bloggr_paging_nav(); ?>
    
            <?php else : ?>
    
                <?php get_template_part( 'content', 'none' ); ?>
    
            <?php endif; ?>
    
            </main><!-- #main -->
        </section><!-- #primary -->
	</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
