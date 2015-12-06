<?php
/**
Template Name: Home Page
 *
 * @package bloggr
 */

get_header(); ?>

<section id="home-blog">
	<div class="grid grid-pad">
    
    	<?php if( get_theme_mod( 'active_newest' ) == '') : ?> 
    	
        <div class="col-2-12 hide-on-mobile">
        	<div class="home-featured">

            	<?php if ( get_theme_mod( 'trending_icon' ) ) : ?>
                	<i class="fa <?php echo get_theme_mod( 'trending_icon' ); ?>"></i>
            	<?php endif; ?>
            
				<?php if ( is_active_sidebar('sidebar-home-left') ) : ?> 
					<?php dynamic_sidebar('sidebar-home-left'); ?> 
            	<?php endif; ?> 
			
            </div><!-- home-featured -->
		</div><!-- col-2-12 -->
        
        <?php endif; ?>
		<?php // end if ?> 
        
        <?php if( get_theme_mod( 'active_newest' ) == '') : ?> 
        
        <div class="col-7-12">
        	<div class="home-latest">
            
            <?php if ( get_theme_mod( 'newest_text' ) ) : ?>
        		<h3 class="home-latest-overview">
                	<?php if ( get_theme_mod( 'newest_icon' ) ) : ?>
                		<i class="fa <?php echo get_theme_mod( 'newest_icon' ); ?>"></i>
                	<?php endif; ?> 
				
					<?php echo get_theme_mod( 'newest_text' ); ?> 
                </h3><!-- home-latest-overview -->
			<?php endif; ?> 
            
			<?php query_posts( array ( 'post_type' => 'post', 'posts_per_page' => 1 ) );
                
            	while ( have_posts() ) : the_post(); 
				
						if ( has_post_format( 'aside' )) { get_template_part( 'content', 'aside' ); } 
						
						elseif ( has_post_format( 'image' )) { get_template_part( 'content', 'image' ); } 
						
						elseif ( has_post_format( 'quote' )) { get_template_part( 'content', 'quote' ); } 
						
						elseif ( has_post_format( 'link' )) { get_template_part( 'content', 'link' ); } 
					
						else 
				
				?> 
                
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('home-latest'); ?></a>
                    <div class="home-latest-content">
                    <span class="latest-date"><?php the_date(); ?></span>
                    <h2 class="home-latest-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php $content = get_the_content(); $trimmed_content = wp_trim_words( $content, 35, '<a href="'. get_permalink() .'"> ...Read More</a>' ); echo $trimmed_content; ?>
                    </div>
                    <footer class="entry-footer">
						<?php bloggr_entry_footer(); ?>
					</footer><!-- .entry-footer -->
				</article><!-- #post-## -->
                    
			<?php endwhile; // end of the loop. ?> 
            </div>
            
            <div id="masonry-container" class="home-masonry">
            <?php query_posts( array ( 'post_type' => 'post', 'offset' => 1 ) );
                
            	while ( have_posts() ) : the_post(); 
				
						if ( has_post_format( 'aside' )) { get_template_part( 'content', 'aside' ); } 
						
						elseif ( has_post_format( 'image' )) { get_template_part( 'content', 'image' ); } 
						
						elseif ( has_post_format( 'quote' )) { get_template_part( 'content', 'quote' ); } 
						
						elseif ( has_post_format( 'link' )) { get_template_part( 'content', 'link' ); } 
					
						else 
						
						get_template_part( 'content', get_post_format() );
				
				?> 
                
              
                    
			<?php endwhile; // end of the loop. ?> 
            
            </div><!-- home-latest -->
		</div><!-- col-7-12 --> 
        
        <?php endif; ?>
		<?php // end if ?> 
        
        <?php if( get_theme_mod( 'active_featured' ) == '') : ?>
        
		<div class="col-3-12">
        	<div class="home-featured">
    
                	<?php if ( get_theme_mod( 'featured_icon' ) ) : ?>
                		<i class="fa <?php echo get_theme_mod( 'featured_icon' ); ?>"></i>
                	<?php endif; ?>
                    
                     <?php if ( is_active_sidebar('sidebar-home-right') ) : ?> 
						<?php dynamic_sidebar('sidebar-home-right'); ?> 
            		<?php endif; ?> 
             
            </div><!-- home-featured -->
  
            <div class="home-sidebar">
            	<?php dynamic_sidebar('sidebar-home'); ?>
            </div><!-- home-sidebar -->
		</div><!-- col-3-12 --> 
         
        <?php endif; ?> 
		<?php // end if ?> 
                
      </div><!-- grid --> 
</section>	      


<?php get_footer(); ?>
