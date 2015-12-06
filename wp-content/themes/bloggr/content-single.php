<?php
/**
 * @package bloggr
 */
?>

<span class="single-post-category"><?php the_category(); ?></span>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
    	<div class="entry-meta">
		<?php bloggr_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <?php the_post_thumbnail(); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
    	<div class="author-information">
        	<?php echo get_avatar( get_the_author_meta('email'), get_the_author() ); ?> 
        	<h5><?php the_author(); ?></h5>
            <p><?php the_date(); ?></p>
            <?php the_category(); ?>
        </div>
    
    	<div class="content-information">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'bloggr' ),
				'after'  => '</div>',
			) );
		?>
        </div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php bloggr_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
