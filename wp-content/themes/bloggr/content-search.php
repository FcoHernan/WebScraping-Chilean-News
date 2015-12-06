<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
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
		<?php $content = get_the_content(); $trimmed_content = wp_trim_words( $content, 100, '<a href="'. get_permalink() .'"> ...Read More</a>' ); echo $trimmed_content; ?>

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