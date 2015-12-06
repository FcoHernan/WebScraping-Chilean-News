<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package bloggr
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php if ( get_theme_mod('site_favicon') ) : ?>
	<link rel="shortcut icon" href="<?php echo esc_url(get_theme_mod('site_favicon')); ?>" />
<?php endif; ?>
<?php if ( get_theme_mod('apple_touch_144') ) : ?>
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url(get_theme_mod('apple_touch_144')); ?>" />
<?php endif; ?>
<?php if ( get_theme_mod('apple_touch_114') ) : ?>
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url(get_theme_mod('apple_touch_114')); ?>" />
<?php endif; ?>
<?php if ( get_theme_mod('apple_touch_72') ) : ?>
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url(get_theme_mod('apple_touch_72')); ?>" />
<?php endif; ?>
<?php if ( get_theme_mod('apple_touch_57') ) : ?>
	<link rel="apple-touch-icon" href="<?php echo esc_url(get_theme_mod('apple_touch_57')); ?>" />
<?php endif; ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'bloggr' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
    	<div class="grid grid-pad no-top header-overflow">
                <div class="site-branding">
                    
                <?php if ( get_theme_mod( 'bloggr_logo' ) ) : ?>    
    				<div class="site-logo"> 
       					<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'bloggr_logo' ) ); ?>' <?php if ( get_theme_mod( 'logo_size' ) ) : ?>width="<?php echo get_theme_mod( 'logo_size' ); ?>"<?php endif; ?> alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a> 
    				</div><!-- site-logo -->
				<?php else : ?>
    				<hgroup> 
       					<h1 class='site-title'><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><?php bloginfo( 'name' ); ?></a></h1>
    				</hgroup>
				<?php endif; ?>
                    
                </div><!-- .site-branding -->
        
        		<div class="navigation-container">
                	<nav id="site-navigation" class="main-navigation" role="navigation">
                    	<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
                	</nav><!-- #site-navigation --> 
                    <button class="toggle-menu menu-right push-body">Menu <i class="fa fa-bars"></i></button>
   
                </div><!-- navigation-container -->
                
                <?php if( get_theme_mod( 'active_social' ) == '') : ?>
                <div class="header-social-container hide-on-mobile">
                				<?php if ( get_theme_mod( 'bloggr_fb' ) ) : ?>
                                	<li>
                                    <a href="<?php echo get_theme_mod( 'bloggr_fb' ); ?>">
                                    <i class="fa fa-facebook"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'bloggr_twitter' ) ) : ?>
                                	<li>
                                    <a href="<?php echo get_theme_mod( 'bloggr_twitter' ); ?>">
                                    <i class="fa fa-twitter"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'bloggr_linked' ) ) : ?>
                                	<li>
                                    <a href="<?php echo get_theme_mod( 'bloggr_linked' ); ?>">
                                    <i class="fa fa-linkedin"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'bloggr_google' ) ) : ?>
                                	<li>
                                    <a href="<?php echo get_theme_mod( 'bloggr_google' ); ?>">
                                    <i class="fa fa-google-plus"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'bloggr_instagram' ) ) : ?>
                                	<li>
                                    <a href="<?php echo get_theme_mod( 'bloggr_instagram' ); ?>">
                                    <i class="fa fa-instagram"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'bloggr_flickr' ) ) : ?>
                                	<li>
                                    <a href="<?php echo get_theme_mod( 'bloggr_flickr' ); ?>">
                                    <i class="fa fa-flickr"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'bloggr_pinterest' ) ) : ?>
                                	<li>
                                    <a href="<?php echo get_theme_mod( 'bloggr_pinterest' ); ?>">
                                    <i class="fa fa-pinterest"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'bloggr_youtube' ) ) : ?>
                                	<li>
                                    <a href="<?php echo get_theme_mod( 'bloggr_youtube' ); ?>">
                                    <i class="fa fa-youtube"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'bloggr_vimeo' ) ) : ?>
                                	<li>
                                    <a href="<?php echo get_theme_mod( 'bloggr_vimeo' ); ?>">
                                    <i class="fa fa-vimeo-square"></i>
                                    </a>
                                    </li> 
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'bloggr_tumblr' ) ) : ?>
                                	<li>
                                    <a href="<?php echo get_theme_mod( 'bloggr_tumblr' ); ?>">
                                    <i class="fa fa-tumblr"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'bloggr_dribbble' ) ) : ?>
                                	<li>
                                    <a href="<?php echo get_theme_mod( 'bloggr_dribbble' ); ?>">
                                    <i class="fa fa-dribbble"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'bloggr_rss' ) ) : ?>
                                	<li>
                                    <a href="<?php echo get_theme_mod( 'bloggr_rss' ); ?>"> 
                                    <i class="fa fa-rss"></i>
                                    </a>
                                    </li>   
								<?php endif; ?> 
                </div>
                 	 	<?php else : ?>  
					<?php endif; ?>
                <?php // end if ?> 
                
        </div><!-- grid -->
	</header><!-- #masthead -->
    
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right">
        <h3>Menu</h3>
        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</nav>

	<div id="content" class="site-content">
