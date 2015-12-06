<?php
/**
 * @package bloggr
 */
?>
<div class="masonry-post">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
    	<div class="entry-meta">
		<?php bloggr_posted_on(); ?>
		</div><!-- .entry-meta -->
        <a href="<?php the_permalink(); ?>"> 
        <?php the_post_thumbnail('masonry-image'); ?>
        </a>
	</header><!-- .entry-header -->

	<div class="archive-entry-content">
    	<a href="<?php the_permalink(); ?>"> 
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </a>
		<?php
				if ( 'option2' == bloggr_sanitize_index_content( get_theme_mod( 'bloggr_post_content' ) ) ) : 
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bloggr' ) );
				else :
				the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bloggr' ) );
				endif; 
		?> 

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'bloggr' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php bloggr_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
</div>