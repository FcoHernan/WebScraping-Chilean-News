<?php
/**
 * bloggr functions and definitions
 *
 * @package bloggr
 */
 
/**
 * Theme updater 
 */ 
require_once('inc/wp-updates-theme.php'); 
new WPUpdatesThemeUpdater_1110( 'http://wp-updates.com/api/2/theme', basename( get_template_directory() ) ); 

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'bloggr_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bloggr_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on bloggr, use a find and replace
	 * to change 'bloggr' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'bloggr', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' ); 

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'small-thumb', 100, 100, true );
	add_image_size( 'small-rect', 200, 120, true );
	add_image_size( 'home-latest', 800, 420, true );
	add_image_size( 'masonry-image', 600 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'bloggr' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'quote',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'bloggr_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // bloggr_setup
add_action( 'after_setup_theme', 'bloggr_setup' );

/**
 * Load Google Fonts.
 */
function load_fonts() {
            wp_register_style('googleFonts', '//fonts.googleapis.com/css?family=Rajdhani:400,300,500,600,700');  
            wp_enqueue_style( 'googleFonts');
        }
    
    add_action('wp_print_styles', 'load_fonts');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function bloggr_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'bloggr' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Home Posts Sidebar Left', 'bloggr' ),
		'id'            => 'sidebar-home-left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">', 
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Home Posts Sidebar Right', 'bloggr' ),
		'id'            => 'sidebar-home-right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Home Sidebar', 'bloggr' ),
		'id'            => 'sidebar-home',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 1', 'bloggr' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 2', 'bloggr' ),
		'id'            => 'footer-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 3', 'bloggr' ),
		'id'            => 'footer-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	//Register the sidebar widgets   
	register_widget( 'bloggr_Video_Widget' ); 
	register_widget( 'bloggr_Contact_Info' );  
	register_widget( 'CategoryPosts' );  
	
}
add_action( 'widgets_init', 'bloggr_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bloggr_scripts() {
	wp_enqueue_style( 'bloggr-style', get_stylesheet_uri() );
	
	$headings_font = esc_html(get_theme_mod('headings_fonts'));
	$body_font = esc_html(get_theme_mod('body_fonts')); 
	
	if( $headings_font ) {
		wp_enqueue_style( 'bloggr-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );	
	} else {
		wp_enqueue_style( 'bloggr-rajdhani', '//fonts.googleapis.com/css?family=Rajdhani:400,300,500,600,700');  
	}	
	if( $body_font ) {
		wp_enqueue_style( 'bloggr-body-fonts', '//fonts.googleapis.com/css?family='. $body_font );	
	} else {
		wp_enqueue_style( 'bloggr-rajdhani-body', '//fonts.googleapis.com/css?family=Rajdhani:400,300,500,600,700'); 
	}
	
	wp_enqueue_style( 'bloggr-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );
	wp_enqueue_style( 'bloggr-push-menu', get_template_directory_uri() . '/css/jPushMenu.css' );
	
	if ( get_theme_mod('bloggr_animate') != 1 ) {
	wp_enqueue_style( 'bloggr-animations', get_template_directory_uri() . '/css/animations.css' );
	}  

	wp_enqueue_script( 'bloggr-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'bloggr-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	if( is_front_page() || is_archive() || is_home() ) { 
		
	wp_enqueue_script( 'bloggr-imagesLoaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), false, false );

	wp_enqueue_script( 'bloggr-masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array(), false, true );

	wp_enqueue_script( 'bloggr-masonryScript', get_template_directory_uri() . '/js/masonry-script.js', array(), false, true );
	
	} 
	
	wp_enqueue_script( 'bloggr-post-formats', get_template_directory_uri() . 'inc/js/post-formats.js', array('jquery'), false, true ); 


	wp_enqueue_script( 'bloggr-push-menu', get_template_directory_uri() . '/js/jPushMenu.js', array('jquery'), false, true );

	wp_enqueue_script( 'bloggr-scripts', get_template_directory_uri() . '/js/bloggr.scripts.js', array(), false, true );
	
	wp_enqueue_script( 'bloggr-placeholder', get_template_directory_uri() . '/js/jquery.placeholder.js', array('jquery'), false, true); 
 	wp_enqueue_script( 'bloggr-placeholdertext', get_template_directory_uri() . '/js/placeholdertext.js', array('jquery'), false, true); 

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bloggr_scripts' );

/**
 * Load html5shiv
 */
function bloggr_html5shiv() {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'bloggr_html5shiv' );

/**
 * Change the excerpt length
 */
function bloggr_excerpt_length( $length ) {
	
	$excerpt = get_theme_mod('exc_length', '100');
	return $excerpt; 

}

add_filter( 'excerpt_length', 'bloggr_excerpt_length', 999 );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Include additional custom admin panel features. 
 */
require get_template_directory() . '/panel/functions-admin.php';
require get_template_directory() . '/panel/theme-admin_page.php'; 

/**
 * Google Fonts  
 */
require get_template_directory() . '/inc/gfonts.php';

/**
 * register your custom widgets
 */ 
require get_template_directory() . "/widgets/contact-info.php";
require get_template_directory() . "/widgets/video-widget.php";
require get_template_directory() . "/widgets/cat-posts.php";


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php'; 
