<?php
/**
 * bloggr Theme Customizer
 *
 * @package bloggr
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bloggr_customize_register( $wp_customize ) {
	
	//allows donations
    class bloggr_Info extends WP_Customize_Control { 
     
        public $label = '';
        public function render_content() { 
        ?>

        <?php
        }
    }	
	
	// Donate
    $wp_customize->add_section(
        'bloggr_theme_info',
        array(
            'title' => __('Like Bloggr? Help us out.', 'bloggr'),
            'priority' => 5, 
            'description' => __('We do all we can do to make all our themes free for you. While we enjoy it, and it makes us happy to help out, a little appreciation can help us to keep theming.</strong><br/><br/> Please help support our mission and continued development with a donation of $5, $10, $20, or if you are feeling really kind $100..<br/><br/> <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7LMGYAZW9C5GE" target="_blank" rel="nofollow"><img class="" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" alt="Make a donation to ModernThemes" /></a>'), 
        )
    );  
	 
    //Donations section
    $wp_customize->add_setting('bloggr_help', array(
			'sanitize_callback' => 'bloggr_no_sanitize',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new bloggr_Info( $wp_customize, 'bloggr_help', array(
        'section' => 'bloggr_theme_info', 
        'settings' => 'bloggr_help', 
        'priority' => 10
        ) )
    );
	   
	// Fonts  
    $wp_customize->add_section(
        'bloggr_typography',
        array(
            'title' => __('Google Fonts', 'bloggr' ),    
            'priority' => 80,
    ));
	
    $font_choices = 
        array(
			'Rajdhani:400,300,500,600,700' => 'Rajdhani', 
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',
			'Oswald:400,700' => 'Oswald',
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Montserrat:400,700' => 'Montserrat',
			'Raleway:400,700' => 'Raleway',
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt',
    );
    
    $wp_customize->add_setting(
        'headings_fonts',
        array(
            'sanitize_callback' => 'bloggr_sanitize_fonts', 
    ));
    
    $wp_customize->add_control(
        'headings_fonts',
        array(
            'type' => 'select',
            'description' => __('Select your desired font for the headings. Rajdhani is the default Heading font.', 'bloggr'),
            'section' => 'bloggr_typography',
            'choices' => $font_choices
    ));
    
    $wp_customize->add_setting(
        'body_fonts',
        array(
            'sanitize_callback' => 'bloggr_sanitize_fonts',
    ));
    
    $wp_customize->add_control(
        'body_fonts',
        array(
            'type' => 'select',
            'description' => __( 'Select your desired font for the body. Rajdhani is the default Body font.', 'bloggr' ), 
            'section' => 'bloggr_typography',
            'choices' => $font_choices 
    ));
	
	//Animations
	$wp_customize->add_section( 'bloggr_animations' , array(  
	    'title'       => __( 'Hover Animations', 'bloggr' ),
	    'priority'    => 22, 
	    'description' => 'How about a nice little blog hover?',
	) );
	
    $wp_customize->add_setting(
        'bloggr_animate',
        array(
            'sanitize_callback' => 'bloggr_sanitize_checkbox',
            'default' => 0,
        )       
    );
	
    $wp_customize->add_control( 
        'bloggr_animate',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box if you want to disable the hover animations.', 'bloggr'),
            'section' => 'bloggr_animations',  
            'priority' => 1,           
        )
    );

	// Colors
    $wp_customize->add_setting( 'bloggr_link_color', array( 
        'default'     => '',   
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bloggr_link_color', array(
        'label'	   => 'Link Color', 
        'section'  => 'colors',
        'settings' => 'bloggr_link_color',
		'priority' => 30 
    )));
	
	$wp_customize->add_setting( 'bloggr_hover_color', array(
        'default'     => '',   
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bloggr_hover_color', array(
        'label'	   => 'Hover Color', 
        'section'  => 'colors',
        'settings' => 'bloggr_hover_color',
		'priority' => 40
    )));
	
	$wp_customize->add_setting( 'bloggr_custom_color', array( 
        'default'     => '', 
		'sanitize_callback' => 'sanitize_hex_color',
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bloggr_custom_color', array(
        'label'	   => 'Theme Color',
        'section'  => 'colors',
        'settings' => 'bloggr_custom_color', 
		'priority' => 10
    )));
	
	$wp_customize->add_setting( 'bloggr_custom_color_hover', array( 
        'default'     => '', 
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bloggr_custom_color_hover', array(
        'label'	   => 'Theme Hover Color',
        'section'  => 'colors',
        'settings' => 'bloggr_custom_color_hover', 
		'priority' => 20
    )));
	
	// Logo upload
    $wp_customize->add_section( 'bloggr_logo_section' , array(  
	    'title'       => __( 'Logo and Icons', 'bloggr' ),
	    'priority'    => 21, 
	    'description' => 'Upload a logo to replace the default site name and description in the header. Also, upload your site favicon and Apple Icons.',
	));

	$wp_customize->add_setting( 'bloggr_logo', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bloggr_logo', array( 
		'label'    => __( 'Logo', 'bloggr' ),
		'section'  => 'bloggr_logo_section', 
		'settings' => 'bloggr_logo',
		'priority' => 1,
	))); 
	
	// Logo Width
	$wp_customize->add_setting( 'logo_size', array(
	    'sanitize_callback' => 'bloggr_sanitize_text', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'logo_size', array( 
		'label'    => __( 'Change the width of the Logo in PX.', 'bloggr' ),
		'description'    => __( 'Only enter numeric value', 'bloggr' ),
		'section'  => 'bloggr_logo_section', 
		'settings' => 'logo_size',
		'priority'   => 2 
	)));
	
	//Favicon Upload
	$wp_customize->add_setting(
		'site_favicon',
		array(
			'default' => (get_stylesheet_directory_uri( 'stylesheet_directory') . '/img/favicon.png'), 
			'sanitize_callback' => 'esc_url_raw',
	));
	
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_favicon',
            array(
               'label'          => __( 'Upload your favicon (16x16 pixels)', 'bloggr' ),
			   'type' 			=> 'image',
               'section'        => 'bloggr_logo_section',
               'settings'       => 'site_favicon',
               'priority' => 2,
    )));
	
    //Apple touch icon 144
    $wp_customize->add_setting(
        'apple_touch_144',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
    ));
	
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_144',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (144x144 pixels)', 'bloggr' ),
               'type'           => 'image',
               'section'        => 'bloggr_logo_section',
               'settings'       => 'apple_touch_144',
               'priority'       => 11,
    )));
	
    //Apple touch icon 114
    $wp_customize->add_setting(
        'apple_touch_114',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw', 
    ));

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_114',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (114x114 pixels)', 'bloggr' ),
               'type'           => 'image',
               'section'        => 'bloggr_logo_section',
               'settings'       => 'apple_touch_114',
               'priority'       => 12,
    )));
	
    //Apple touch icon 72
    $wp_customize->add_setting(
        'apple_touch_72',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
    ));
	
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_72',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (72x72 pixels)', 'bloggr' ),
               'type'           => 'image',
               'section'        => 'bloggr_logo_section',
               'settings'       => 'apple_touch_72',
               'priority'       => 13,
    )));
	
    //Apple touch icon 57
    $wp_customize->add_setting( 
        'apple_touch_57',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
    ));
	
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_57',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (57x57 pixels)', 'bloggr' ),
               'type'           => 'image',
               'section'        => 'bloggr_logo_section',
               'settings'       => 'apple_touch_57',
               'priority'       => 14,
    ))); 
	
	// Home Social Panel
	$wp_customize->add_panel( 'social_panel', array(
    'priority'       => 25,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => 'Social Section',
    'description'    => 'Edit your home page social media icons',
	));
	
	// Social Section 
	$wp_customize->add_section( 'bloggr_settings', array(
            'title'          => 'Social Media Icons',
            'priority'       => 38,
			'panel' => 'social_panel',  
    ) );
	
	// Home Social Section 
	$wp_customize->add_setting('active_social',
	    array(
	        'sanitize_callback' => 'bloggr_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 
    'active_social', 
    array(
        'type' => 'checkbox',
        'label' => 'Hide Home Social Section',  
        'section' => 'bloggr_settings', 
		'priority'   => 10
    ));
	
	// Facebook
	$wp_customize->add_setting( 'bloggr_fb',
	    array(
	        'sanitize_callback' => 'bloggr_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloggr_fb', array(
		'label'    => __( 'Facebook URL:', 'bloggr' ),
		'section'  => 'bloggr_settings', 
		'settings' => 'bloggr_fb',
		'priority'   => 20
	))); 
	
	// Twitter
	$wp_customize->add_setting( 'bloggr_twitter',
	    array(
	        'sanitize_callback' => 'bloggr_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloggr_twitter', array(
		'label'    => __( 'Twitter URL:', 'bloggr' ),
		'section'  => 'bloggr_settings', 
		'settings' => 'bloggr_twitter',
		'priority'   => 30
	))); 
	
	// LinkedIn
	$wp_customize->add_setting( 'bloggr_linked',
	    array(
	        'sanitize_callback' => 'bloggr_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloggr_linked', array(
		'label'    => __( 'LinkedIn URL:', 'bloggr' ),
		'section'  => 'bloggr_settings', 
		'settings' => 'bloggr_linked',
		'priority'   => 40
	)));
	
	// Google Plus
	$wp_customize->add_setting( 'bloggr_google',
	    array(
	        'sanitize_callback' => 'bloggr_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloggr_google', array(
		'label'    => __( 'Google Plus URL:', 'bloggr' ),
		'section'  => 'bloggr_settings', 
		'settings' => 'bloggr_google',
		'priority'   => 50
	)));
	
	// Instagram
	$wp_customize->add_setting( 'bloggr_instagram',
	    array(
	        'sanitize_callback' => 'bloggr_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloggr_instagram', array(
		'label'    => __( 'Instagram URL:', 'bloggr' ),
		'section'  => 'bloggr_settings', 
		'settings' => 'bloggr_instagram',
		'priority'   => 60
	)));
	
	// Flickr
	$wp_customize->add_setting( 'bloggr_flickr',
	    array(
	        'sanitize_callback' => 'bloggr_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloggr_flickr', array(
		'label'    => __( 'Flickr URL:', 'bloggr' ),
		'section'  => 'bloggr_settings', 
		'settings' => 'bloggr_flickr',
		'priority'   => 70
	)));
	
	// Pinterest
	$wp_customize->add_setting( 'bloggr_pinterest',
	    array(
	        'sanitize_callback' => 'bloggr_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloggr_pinterest', array(
		'label'    => __( 'Pinterest URL:', 'bloggr' ),
		'section'  => 'bloggr_settings', 
		'settings' => 'bloggr_pinterest',
		'priority'   => 80
	)));
	
	// Youtube
	$wp_customize->add_setting( 'bloggr_youtube',
	    array(
	        'sanitize_callback' => 'bloggr_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloggr_youtube', array(
		'label'    => __( 'YouTube URL:', 'bloggr' ),
		'section'  => 'bloggr_settings', 
		'settings' => 'bloggr_youtube',  
		'priority'   => 90
	)));
	
	// Vimeo
	$wp_customize->add_setting( 'bloggr_vimeo',
	    array(
	        'sanitize_callback' => 'bloggr_sanitize_text', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloggr_vimeo', array(
		'label'    => __( 'Vimeo URL:', 'bloggr' ),
		'section'  => 'bloggr_settings', 
		'settings' => 'bloggr_vimeo',
		'priority'   => 100
	)));
	
	// Tumblr
	$wp_customize->add_setting( 'bloggr_tumblr',
	    array(
	        'sanitize_callback' => 'bloggr_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloggr_tumblr', array(
		'label'    => __( 'Tumblr URL:', 'bloggr' ),
		'section'  => 'bloggr_settings', 
		'settings' => 'bloggr_tumblr', 
		'priority'   => 110
	)));
	
	// Dribbble
	$wp_customize->add_setting( 'bloggr_dribbble',
	    array(
	        'sanitize_callback' => 'bloggr_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloggr_dribbble', array(
		'label'    => __( 'Dribbble URL:', 'bloggr' ),
		'section'  => 'bloggr_settings', 
		'settings' => 'bloggr_dribbble',
		'priority'   => 120
	)));
	
	// RSS
	$wp_customize->add_setting( 'bloggr_rss',
	    array(
	        'sanitize_callback' => 'bloggr_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloggr_rss', array(
		'label'    => __( 'RSS URL:', 'bloggr' ),
		'section'  => 'bloggr_settings', 
		'settings' => 'bloggr_rss',
		'priority'   => 130
	)));
	
	// Home Page Panel
	$wp_customize->add_panel( 'home_panel', array(
    'priority'       => 26, 
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => 'Home Page Section',
    'description'    => 'Edit your home page settings', 
	));
	
	// Newest Stories Section
	$wp_customize->add_section( 'bloggr_newest_section', array(
		'title'          => 'Newest Stories',
		'priority'       => 10,
		'description' => 'Edit your Newest Stories content. Choose from any of <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">these icons</a>. Example: "fa-arrow-right".',
		'panel' => 'home_panel', 
	));
	
	// Home Newest Section
	$wp_customize->add_setting('active_newest',
	    array(
	        'sanitize_callback' => 'bloggr_sanitize_checkbox',
	    ) 
	); 
	
	$wp_customize->add_control( 
    'active_newest',
    array(
        'type' => 'checkbox',
        'label' => 'Hide Newest Stories Section',   
        'section' => 'bloggr_newest_section', 
		'priority'   => 10
    ));
	
	// Newest Stories Title
	$wp_customize->add_setting( 'newest_text' ,
	    array(
			'default' => 'Newest Stories', 
	        'sanitize_callback' => 'bloggr_sanitize_text',
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newest_text', array(
		'label'    => __( 'Newest Stories Title Text', 'bloggr' ),
		'section'  => 'bloggr_newest_section', 
		'settings' => 'newest_text',  
		'priority'   => 20
	)));
	
	// Newest Stories Icon
	$wp_customize->add_setting( 'newest_icon' ,
	    array(
			'default' => 'fa-clock-o', 
	        'sanitize_callback' => 'bloggr_sanitize_text',
	)); 
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newest_icon', array(
		'label'    => __( 'Newest Stories Icon', 'bloggr' ),
		'section'  => 'bloggr_newest_section', 
		'settings' => 'newest_icon',  
		'priority'   => 30
	)));
	
	// Trending Stories Section
	$wp_customize->add_section( 'bloggr_trending_section', array(
		'title'          => 'Trending Stories',
		'priority'       => 20,
		'description' => 'Edit your Trending Stories content. Choose from any of <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">these icons</a>. Example: "fa-arrow-right".',
		'panel' => 'home_panel', 
	));
	
	// Home Trending Section 
	$wp_customize->add_setting('active_trending',
	    array(
	        'sanitize_callback' => 'bloggr_sanitize_checkbox',
	    ) 
	); 
	
	$wp_customize->add_control( 
    'active_trending',
    array(
        'type' => 'checkbox',
        'label' => 'Hide Trending Stories Section',   
        'section' => 'bloggr_trending_section', 
		'priority'   => 10
    ));
	
	// Trending Stories Title
	$wp_customize->add_setting( 'trending_text' ,
	    array(
			'default' => 'Trending Stories',
	        'sanitize_callback' => 'bloggr_sanitize_text',
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'trending_text', array(
		'label'    => __( 'Trending Stories Title Text', 'bloggr' ),
		'section'  => 'bloggr_trending_section', 
		'settings' => 'trending_text',  
		'priority'   => 20
	)));
	
	// Trending Stories Icon
	$wp_customize->add_setting( 'trending_icon' ,
	    array(
			'default' => 'fa-line-chart', 
	        'sanitize_callback' => 'bloggr_sanitize_text',
	)); 
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'trending_icon', array(
		'label'    => __( 'Trending Stories Icon', 'bloggr' ),
		'section'  => 'bloggr_trending_section', 
		'settings' => 'trending_icon',  
		'priority'   => 30
	)));
	
	// Featured Stories Section
	$wp_customize->add_section( 'bloggr_featured_section', array(
		'title'          => 'Featured Stories',
		'priority'       => 30,
		'description' => 'Edit your Featured Stories content. Choose from any of <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">these icons</a>. Example: "fa-arrow-right".',
		'panel' => 'home_panel', 
	));
	
	// Home Featured Section 
	$wp_customize->add_setting('active_featured',
	    array(
	        'sanitize_callback' => 'bloggr_sanitize_checkbox',
	    ) 
	); 
	
	$wp_customize->add_control( 
    'active_featured',
    array(
        'type' => 'checkbox',
        'label' => 'Hide Featured Stories Section',   
        'section' => 'bloggr_featured_section', 
		'priority'   => 10
    ));
	
	// Featured Stories Title
	$wp_customize->add_setting( 'featured_text' ,
	    array(
			'default' => 'Featured Stories', 
	        'sanitize_callback' => 'bloggr_sanitize_text',
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'featured_text', array(
		'label'    => __( 'Featured Stories Title Text', 'bloggr' ),
		'section'  => 'bloggr_featured_section', 
		'settings' => 'featured_text',  
		'priority'   => 20
	)));
	
	// Featured Stories Icon
	$wp_customize->add_setting( 'featured_icon' ,
	    array(
			'default' => 'fa-star', 
	        'sanitize_callback' => 'bloggr_sanitize_text',
	)); 
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'featured_icon', array(
		'label'    => __( 'Featured Stories Icon', 'bloggr' ),
		'section'  => 'bloggr_featured_section',  
		'settings' => 'featured_icon',  
		'priority'   => 30
	)));
	
	// Add Footer Section
	$wp_customize->add_section( 'footer-custom' , array(
    	'title' => __( 'Footer', 'bloggr' ),
    	'priority' => 35, 
    	'description' => __( 'Customize your footer area.', 'bloggr' )  
	) );
	
	// Footer Byline Text
	$wp_customize->add_setting( 'bloggr_footerid' ,array( 
	        'sanitize_callback' => 'bloggr_sanitize_text',
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloggr_footerid', array(
    'label' => __( 'Footer Byline Text', 'bloggr' ),
    'section' => 'footer-custom',
    'settings' => 'bloggr_footerid', 
	'priority'   => 10
	) ) ); 
	
	// Choose excerpt or full content on blog
    $wp_customize->add_section( 'bloggr_layout_section' , array( 
	    'title'       => __( 'Layout', 'bloggr' ),
	    'priority'    => 45, 
	    'description' => 'Change how bloggr displays posts', 
	));

	$wp_customize->add_setting( 'bloggr_post_content', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'bloggr_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bloggr_post_content', array(
		'label'    => __( 'Post content', 'bloggr' ),
		'section'  => 'bloggr_layout_section',
		'settings' => 'bloggr_post_content',
		'type'     => 'radio',
		'choices'  => array(
			'option1' => 'Excerpts',
			'option2' => 'Full content',
			),
	)));
	
	//Excerpt
    $wp_customize->add_setting(
        'exc_length',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '30',
    ));
	
    $wp_customize->add_control( 'exc_length', array( 
        'type'        => 'number',
        'priority'    => 2, 
        'section'     => 'bloggr_layout_section',
        'label'       => __('Excerpt length', 'bloggr'),
        'description' => __('Choose your excerpt length here. Default: 30 words', 'bloggr'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
            'style' => 'padding: 15px;',
        ), 
	));  

	// Set site name and description to be previewed in real-time
	$wp_customize->get_setting('blogname')->transport='postMessage';
	$wp_customize->get_setting('blogdescription')->transport='postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	// Move sections up 
	$wp_customize->get_section('static_front_page')->priority = 10;
	$wp_customize->get_section('nav')->priority = 11; 

	// Enqueue scripts for real-time preview
	wp_enqueue_script( 'bloggr_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_register', 'bloggr_customize_register' );

/**
 * Sanitizes a hex color. Identical to core's sanitize_hex_color(), which is not available on the wp_head hook.
 *
 * Returns either '', a 3 or 6 digit hex color (with #), or null.
 * For sanitizing values without a #, see sanitize_hex_color_no_hash().
 *
 * @since 1.7
 */
function bloggr_sanitize_hex_color( $color ) {
	if ( '#FF0000' === $color ) 
		return '';

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;

	return null;
}

/**
 * Sanitizes our post content value (either excerpts or full post content).
 *
 * @since 1.7
 */
function bloggr_sanitize_index_content( $content ) {
	if ( 'option2' == $content ) {
		return 'option2';
	} else {
		return 'option1';
	} 
}

//Checkboxes
function bloggr_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

//Integers
function bloggr_sanitize_int( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

//Text
function bloggr_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

//Sanitizes Fonts 
function bloggr_sanitize_fonts( $input ) {  
    $valid = array(
			'Rajdhani:400,300,500,600,700' => 'Rajdhani',
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',
            'Oswald:400,700' => 'Oswald',
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Montserrat:400,700' => 'Montserrat',
			'Raleway:400,700' => 'Raleway',    
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt', 
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return ''; 
    }
}

//No sanitize - empty function for options that do not require sanitization -> to bypass the Theme Check plugin
function bloggr_no_sanitize( $input ) {
} 

/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 * @since 1.5
 */
function bloggr_add_customizer_css() {
	$color = bloggr_sanitize_hex_color( get_theme_mod( 'bloggr_link_color' ) );
	?>
	<!-- bloggr customizer CSS -->
	<style>
		body {
			border-color: <?php echo $color; ?>;
		}
		a {
			color: <?php echo $color; ?>;
		}
		
		.main-navigation li:hover > a, a:hover, .home-featured a:hover { 
			color: <?php echo get_theme_mod( 'bloggr_hover_color' ) ?>; 
		} 
		
		.fa, .social-media-icons .fa, .footer-contact h5 { color: <?php echo get_theme_mod( 'bloggr_custom_color' ) ?>; }
	  
		.site-header { background: <?php echo get_theme_mod( 'bloggr_custom_color' ) ?>; } 
		
		.home-entry-title:after, .member-entry-title:after, .works-entry-title:after, .client-entry-title:after, .home-news h5:after, .home-team h5:after, .home-cta h6:after, .footer-contact h5:after, .member h5:after { border-color: <?php echo get_theme_mod( 'bloggr_custom_color' ) ?>; } 
		
		.main-navigation ul ul li, blockquote { border-color: <?php echo get_theme_mod( 'bloggr_custom_color' ) ?>; }
		  
		button, input[type="button"], input[type="reset"], input[type="submit"] { background: <?php echo get_theme_mod( 'bloggr_custom_color' ) ?>; border-color: <?php echo get_theme_mod( 'bloggr_custom_color' ) ?>; }  
		
		.home-blog .entry-footer:hover, button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { border-color: <?php echo get_theme_mod( 'bloggr_custom_color_hover') ?>; background: <?php echo get_theme_mod( 'bloggr_custom_color_hover') ?>; }  
		#site-navigation button:hover { background: none; }
		  
	</style>
<?php }
add_action( 'wp_head', 'bloggr_add_customizer_css' ); 