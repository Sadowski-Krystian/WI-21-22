<?php



function register_my_menus() {
	register_nav_menus(
	  array(
		'header-menu' => __( 'Header Menu' ),
		'footer-menu' => __( 'Footer Menu' )
	  )
	);
  }
  add_action( 'init', 'register_my_menus' );

    $defaults = array(
        'default-color'          => '',
        'default-image'          => '',
        'default-repeat'         => 'repeat',
        'default-position-x'     => 'left',
        'default-position-y'     => 'top',
        'default-size'           => 'auto',
        'default-attachment'     => 'scroll',
        'wp-head-callback'       => '_custom_background_cb',
        'admin-head-callback'    => '',
        'admin-preview-callback' => ''
    );
    add_theme_support( 'custom-background', $defaults );
/*
    $font = array(
        'default-color'         => '',
    );
*/
    function theme_prefix_setup() {
	
        add_theme_support( 'custom-logo', array(
            'default-image'         => '<?php echo get_template_directory_uri(); ?>/images/martin-vaculik-logo.svg',
            'height'                => 75,
            'width'                 => 75,
            'flex-width'            => true,
            'flex-height'           => true,
        ) );
    
    }
    add_action( 'after_setup_theme', 'theme_prefix_setup' );
    $args = array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    );
    add_theme_support( 'html5', $args );

    
      
    add_theme_support( 'automatic-feed-links' );
      function twentytwenty_sidebar_registration() {

        // Arguments used in all register_sidebar() calls.
        $shared_args = array(
            'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
            'after_title'   => '</h2>',
            'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
            'after_widget'  => '</div></div>',
        );
    
        // Footer #1.
        register_sidebar(
            array_merge(
                $shared_args,
                array(
                    'name'        => __( 'Footer', 'twentytwenty' ),
                    'id'          => 'sidebar-1',
                    'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'twentytwenty' ),
                )
            )
        );
    /*
        // Footer #2.
        register_sidebar(
            array_merge(
                $shared_args,
                array(
                    'name'        => __( 'Footer center', 'twentytwenty' ),
                    'id'          => 'sidebar-2',
                    'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'twentytwenty' ),
                )
            )
        );

        //Footer #3.
        register_sidebar(
            array_merge(
                $shared_args,
                array(
                    'name'        => __( 'Footer right', 'twentytwenty' ),
                    'id'          => 'sidebar-3',
                    'description' => __( 'Widgets in this area will be displayed in the therth column in the footer.', 'twentytwenty' ),
                )
            )
        );
*/
        //Header Slider

        register_sidebar(
            array_merge(
                $shared_args,
                array(
                    'name'        => __( 'Header Slider', 'twentytwenty' ),
                    'id'          => 'header-slider',
                    'description' => __( 'Widgets in this area will be displayed in the center of the header.', 'twentytwenty' ),
                    'default'     => '[smartslider3 slider="4"]',
                )
            )
        );
        
    
    }
    
    add_action( 'widgets_init', 'twentytwenty_sidebar_registration' );
/*
    function ShowAdminMessage(){
        include_once(ABSPATH.'wp-admin/includes/plugin.php');

        if(!is_plugin_active('ml-slider/ml-slider.php')){
            echo '<div id="allert" class="notice notice-warning">';
            echo '<p> This theme required you to install <a href="https://wordpress.org/plugins/ml-slider/">Meta Slider</a>';
            echo '</div>';
        }
    }

    add_action('admin_notices', 'ShowAdminMessage');
  */
  
  add_action('admin_notices', 'showAdminMessages');

function showAdminMessages()
{
    $plugin_messages = array();
    $aRequired_plugins = array();

    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    $aRequired_plugins = array(
                                array('name'=>'Smart Slider 3', 'download'=>'http://wordpress.org/plugins/smart-slider-3/', 'path'=>'smart-slider-3/smart-slider-3.php'),
                                
    );

    
    foreach($aRequired_plugins as $aPlugin){
        // Check if plugin exists
        if(!is_plugin_active( $aPlugin['path'] ))
        {
            $plugin_messages[] = 'This theme requires you to install the <b>'.$aPlugin['name'].'</b> plugin, download it from <a href="'.$aPlugin['download'].'"> here.</a>';
        }
    }

    if(count($plugin_messages) > 0)
    {
        echo '<div id="allert" class="notice notice-warning"><p> ';

            foreach($plugin_messages as $message)
            {
                echo ' '.$message.' <br> ';
            }

        echo '</p></div> ';
    }

}

/**
 * HEX Color sanitization callback.
 *
 * - Sanitization: hex_color
 * - Control: text, WP_Customize_Color_Control
 *
 * Note: sanitize_hex_color_no_hash() can also be used here, depending on whether
 * or not the hash prefix should be stored/retrieved with the hex color value.
 *
 * @see sanitize_hex_color() https://developer.wordpress.org/reference/functions/sanitize_hex_color/
 * @link sanitize_hex_color_no_hash() https://developer.wordpress.org/reference/functions/sanitize_hex_color_no_hash/
 *
 * @param string               $hex_color HEX color to sanitize.
 * @param WP_Customize_Setting $setting   Setting instance.
 * @return string The sanitized hex color if not null; otherwise, the setting default.
 */
function sk_sanitize_hex_color( $hex_color, $setting ) {
	// Sanitize $input as a hex value.
	$hex_color = sanitize_hex_color( $hex_color );

	// If $input is a valid hex value, return it; otherwise, return the default.
	return ( ! is_null( $hex_color ) ? $hex_color : $setting->default );
}

/**
 * Image sanitization callback.
 *
 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
 * send back the filename, otherwise, return the setting default.
 *
 * - Sanitization: image file extension
 * - Control: text, WP_Customize_Image_Control
 *
 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
 *
 * @param string               $image   Image filename.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The image filename if the extension is allowed; otherwise, the setting default.
 */
function sk_sanitize_image( $image, $setting ) {

	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
	$mimes = array(
		'jpg|jpeg|jpe' => 'image/jpeg',
		'gif'          => 'image/gif',
		'png'          => 'image/png',
		'bmp'          => 'image/bmp',
		'tif|tiff'     => 'image/tiff',
		'ico'          => 'image/x-icon'
	);

	// Return an array with file extension and mime_type.
	$file = wp_check_filetype( $image, $mimes );

	// If $image has a valid mime_type, return it; otherwise, return the default.
	return ( $file['ext'] ? $image : $setting->default );
}

/**
 * Checkbox sanitization callback.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function sk_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}


/**
 * Customizer: Add Sections
 *
 * This code adds a Section with multiple Settings and Controls to the Customizer
 *
 * @package   code-examples
 * @copyright Copyright (c) 2015, WordPress Theme Review Team
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 */


/**
 * Theme Options Customizer Implementation.
 *
 * Implement the Theme Customizer for Theme Settings.
 *
 * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 *
 * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
 */
function sk_register_theme_customizer( $wp_customize ) {

	/*
	 * Failsafe is safe
	 */
	if ( ! isset( $wp_customize ) ) {
		return;
	}


	/**
	 * Add Header Section for General Options.
	 *
	 * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
	 * @link $wp_customize->add_section() https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
	 */
	$wp_customize->add_section(
		// $id
		'sk_section_header',
		// $args
		array(
			'title'			=> __( 'Header Background', 'theme-slug' ),
			'description'	=> __( 'Set background color and/or background image for the header', 'theme-slug' ),
			'priority'		=> 9,
			'panel'			=> 'sk_panel_header'
		)
	);
	$wp_customize->add_section(
		// $id
		'sk_menu_colors',
		// $args
		array(
			'title'			=> __( 'Header Menu colors', 'theme-slug' ),
			'description'	=> __( 'Set menu colors for a menu header', 'theme-slug' ),
			'priority'		=> 9,
			'panel'			=> 'sk_panel_header'
		)
	);
    $wp_customize->add_section(
		// $id
		'sk_section_footer',
		// $args
		array(
			'title'			=> __( 'Footer Background', 'theme-slug' ),
			'description'	=> __( 'Set background color and/or background image for the footer', 'theme-slug' ),
			'priority'		=> 9,
			'panel'			=> 'sk_panel_footer'
		)
	);
	$wp_customize->add_section(
		// $id
		'sk_color_footer',
		// $args
		array(
			'title'			=> __( 'Footer menu color', 'theme-slug' ),
			'description'	=> __( 'Set color for footer menu', 'theme-slug' ),
			'priority'		=> 9,
			'panel'			=> 'sk_panel_footer'
		)
	);

	$wp_customize->add_section(
		//id
		'sk_footer_copyright',
		// $args 
        array(
            'title'			=> __( 'Footer copyright text', 'theme-slug' ),
			'description'	=> __( 'Set footer copyright text color', 'theme-slug' ),
			'priority'		=> 9,
			'panel'			=> 'sk_panel_footer'
        )
    );
	$wp_customize->add_panel( 
		//id
		'sk_panel_header',
		// $args
		array(
        'priority'       => 10,
        'title'          => __('Header Customize', 'theme-slug'),
        'description'    => __('Header settings for a theme', 'theme-slug'),
    ) );
	$wp_customize->add_panel( 
		//id
		'sk_panel_footer',
		// $args
		array(
        'priority'       => 10,
        'title'          => __('Footer Customize', 'theme-slug'),
        'description'    => __('Footer settings for a theme', 'theme-slug'),
    ) );


	/**
	 * Header Background Color setting.
	 *
	 * - Setting: Header Background Color
	 * - Control: WP_Customize_Color_Control
	 * - Sanitization: hex_color
	 *
	 * Uses a color wheel to configure the Header Background Color setting.
	 *
	 * @uses $wp_customize->add_setting() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_setting/
	 * @link $wp_customize->add_setting() https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
	 */
	$wp_customize->add_setting(
		// $id
		'header_background_color_setting',
		// $args
		array(
            'default'			=> '#000000',
			'sanitize_callback'	=> 'sk_sanitize_hex_color',
			'transport'			=> 'refresh'
		)
	);
    $wp_customize->add_setting(
		// $id
		'footer_background_color_setting',
		// $args
		array(
            'default'			=> '#000000',
			'sanitize_callback'	=> 'sk_sanitize_hex_color',
			'transport'			=> 'refresh'
		)
	);
	$wp_customize->add_setting(
		// $id
		'menu_active_color_setting',
		// $args
		array(
            'default'			=> '#ffff00',
			'sanitize_callback'	=> 'sk_sanitize_hex_color',
			'transport'			=> 'refresh'
		)
	);
	$wp_customize->add_setting(
		// $id
		'menu_no_active_color_setting',
		// $args
		array(
            'default'			=> '#ffffff',
			'sanitize_callback'	=> 'sk_sanitize_hex_color',
			'transport'			=> 'refresh'
		)
	);
	$wp_customize->add_setting(
		// $id
		'menu_active_color_footer_setting',
		// $args
		array(
            'default'			=> '#ffff00',
			'sanitize_callback'	=> 'sk_sanitize_hex_color',
			'transport'			=> 'refresh'
		)
	);
	$wp_customize->add_setting(
		// $id
		'menu_no_active_color_footer_setting',
		// $args
		array(
            'default'			=> '#ffffff',
			'sanitize_callback'	=> 'sk_sanitize_hex_color',
			'transport'			=> 'refresh'
		)
	);
	$wp_customize->add_setting(
		// $id
		'footer_font_color_setting',
		// $args
		array(
            'default'			=> '#ffffff',
			'sanitize_callback'	=> 'sk_sanitize_hex_color',
			'transport'			=> 'refresh'
		)
	);
	$wp_customize->add_setting(
		// $id
		'footer_copyright_setting',
		// $args
		array(
			'transport'			=> 'refresh',
			
		)
	);
	

	/**
	 * Header Background Image setting.
	 *
	 * - Setting: Header Background Image
	 * - Control: WP_Customize_Image_Control
	 * - Sanitization: image
	 *
	 * Uses the media manager to upload and select an image to be used as the header background image.
	 *
	 * @uses $wp_customize->add_setting() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_setting/
	 * @link $wp_customize->add_setting() https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
	 */
	$wp_customize->add_setting(
		// $id
		'header_background_image_setting',
		// $args
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'sk_sanitize_image',
			'transport'			=> 'refresh'
		)
	);

    $wp_customize->add_setting(
		// $id
		'footer_background_image_setting',
		// $args
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'sk_sanitize_image',
			'transport'			=> 'refresh'
		)
	);

	/**
	 * Display Header Backgroud Image Repeat setting.
	 *
	 * - Setting: Display Header Backgroud Image Repeat
	 * - Control: checkbox
	 * - Sanitization: checkbox
	 *
	 * Uses a checkbox to configure the display of the header background image repeat checkbox.
	 *
	 * @uses $wp_customize->add_setting() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_setting/
	 * @link $wp_customize->add_setting() https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
	 */
	$wp_customize->add_setting(
		// $id
		'header_background_image_repeat_setting',
		// $args
		array(
			'default'			=> true,
			'sanitize_callback'	=> 'sk_sanitize_checkbox',
			'transport'			=> 'refresh'
		)
	);
    $wp_customize->add_setting(
		// $id
		'footer_background_image_repeat_setting',
		// $args
		array(
			'default'			=> true,
			'sanitize_callback'	=> 'sk_sanitize_checkbox',
			'transport'			=> 'refresh'
		)
	);

	/**
	 * Display Header Backgroud Image Size setting.
	 *
	 * - Setting: Display Header Backgroud Image Size
	 * - Control: checkbox
	 * - Sanitization: checkbox
	 *
	 * Uses a checkbox to configure the display of the header background image repeat checkbox.
	 *
	 * @uses $wp_customize->add_setting() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_setting/
	 * @link $wp_customize->add_setting() https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
	 */
	$wp_customize->add_setting(
		// $id
		'header_background_image_size_setting',
		// $args
		array(
			'default'			=> false,
			'sanitize_callback'	=> 'sk_sanitize_checkbox',
			'transport'			=> 'refresh'
		)
	);
    $wp_customize->add_setting(
		// $id
		'footer_background_image_size_setting',
		// $args
		array(
			'default'			=> false,
			'sanitize_callback'	=> 'sk_sanitize_checkbox',
			'transport'			=> 'refresh'
		)
	);

	/**
	 * Core Color control.
	 *
	 * - Control: Color
	 * - Setting: Header Background Color
	 * - Sanitization: hex_color
	 *
	 * Register "WP_Customize_Color_Control" to be used to configure the Header Background Color setting.
	 *
	 * @uses $wp_customize->add_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_control/
	 * @link $wp_customize->add_control() https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
	 *
	 * @uses WP_Customize_Color_Control() https://developer.wordpress.org/reference/classes/wp_customize_color_control/
	 * @link WP_Customize_Color_Control() https://codex.wordpress.org/Class_Reference/WP_Customize_Color_Control
	 */
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			// $wp_customize object
			$wp_customize,
			// $id
			'header_background_color',
			// $args
			array(
				'settings'		=> 'header_background_color_setting',
				'section'		=> 'sk_section_header',
				'label'			=> __( 'Header Background Color', 'theme-slug' ),
				'description'	=> __( 'Select the background color for header.', 'theme-slug' ),
			)
		)
	);
    $wp_customize->add_control(
		new WP_Customize_Color_Control(
			// $wp_customize object
			$wp_customize,
			// $id
			'footer_background_color',
			// $args
			array(
				'settings'		=> 'footer_background_color_setting',
				'section'		=> 'sk_section_footer',
				'label'			=> __( 'Footer Background Color', 'theme-slug' ),
				'description'	=> __( 'Select the background color for footer.', 'theme-slug' ),
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			// $wp_customize object
			$wp_customize,
			// $id
			'menu_active_color',
			// $args
			array(
				'settings'		=> 'menu_active_color_setting',
				'section'		=> 'sk_menu_colors',
				'label'			=> __( 'Menu Active element color', 'theme-slug' ),
				'description'	=> __( 'Select the color for active and hover menu element.', 'theme-slug' ),
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			// $wp_customize object
			$wp_customize,
			// $id
			'menu_no_active_color',
			// $args
			array(
				'settings'		=> 'menu_no_active_color_setting',
				'section'		=> 'sk_menu_colors',
				'label'			=> __( 'Menu no active element color', 'theme-slug' ),
				'description'	=> __( 'Select the color for no active menu element.', 'theme-slug' ),
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			// $wp_customize object
			$wp_customize,
			// $id
			'footer_font_color',
			// $args
			array(
				'settings'		=> 'footer_font_color_setting',
				'section'		=> 'sk_footer_copyright',
				'label'			=> __( 'Copyright color setting', 'theme-slug' ),
				'description'	=> __( 'Select a color for Copyright.', 'theme-slug' ),
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			// $wp_customize object
			$wp_customize,
			// $id
			'menu_active_footer_color',
			// $args
			array(
				'settings'		=> 'menu_active_color_footer_setting',
				'section'		=> 'sk_color_footer',
				'label'			=> __( 'Menu no active element color', 'theme-slug' ),
				'description'	=> __( 'Select the color for no active menu element.', 'theme-slug' ),
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			// $wp_customize object
			$wp_customize,
			// $id
			'menu_no_active_footer_color',
			// $args
			array(
				'settings'		=> 'menu_no_active_color_footer_setting',
				'section'		=> 'sk_color_footer',
				'label'			=> __( 'Menu no active element color', 'theme-slug' ),
				'description'	=> __( 'Select the color for no active menu element.', 'theme-slug' ),
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			// $wp_customize object
			$wp_customize,
			// $id
			'footer_copyright',
			// $args
			array(
				'settings'		=> 'footer_copyright_setting',
				'section'		=> 'sk_footer_copyright',
				'label'			=> __( 'Footer Copyright', 'theme-slug' ),
				'description'	=> __( 'Set footer copyright. Default shortcode: [Copy], [Year], [Theme_Author], [Theme_Version]', 'theme-slug' ),
				'type'   		=> 'textarea',
				
			)
		)
	);




	
	/**
	 * Image Upload control.
	 *
	 * Control: Image Upload
	 * Setting: Header Background Image
	 * Sanitization: image
	 *
	 * Register "WP_Customize_Image_Control" to be used to configure the Header Background Image setting.
	 *
	 * @uses $wp_customize->add_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_control/
	 * @link $wp_customize->add_control() https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
	 *
	 * @uses WP_Customize_Image_Control() https://developer.wordpress.org/reference/classes/wp_customize_image_control/
	 * @link WP_Customize_Image_Control() https://codex.wordpress.org/Class_Reference/WP_Customize_Image_Control
	 */
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			// $wp_customize object
			$wp_customize,
			// $id
			'header_background_image',
			// $args
			array(
				'settings'		=> 'header_background_image_setting',
				'section'		=> 'sk_section_header',
				'label'			=> __( 'Header Background Image', 'theme-slug' ),
				'description'	=> __( 'Select the background image for header.', 'theme-slug' )
			)
		)
	);
    $wp_customize->add_control(
		new WP_Customize_Image_Control(
			// $wp_customize object
			$wp_customize,
			// $id
			'footer_background_image',
			// $args
			array(
				'settings'		=> 'footer_background_image_setting',
				'section'		=> 'sk_section_footer',
				'label'			=> __( 'Footer Background Image', 'theme-slug' ),
				'description'	=> __( 'Select the background image for footer.', 'theme-slug' )
			)
		)
	);

	/**
	 * Basic Checkbox control.
	 *
	 * - Control: Basic: Checkbox
	 * - Setting: Display Header Backgroud Image Repeat
	 * - Sanitization: checkbox
	 *
	 * Register the core "checkbox" control to be used to configure the Display Header Backgroud Image Repeat setting.
	 *
	 * @uses $wp_customize->add_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_control/
	 * @link $wp_customize->add_control() https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
	 */
	$wp_customize->add_control(
		// $id
		'header_background_image_repeat',
		// $args
		array(
			'settings'		=> 'header_background_image_repeat_setting',
			'section'		=> 'sk_section_header',
			'type'			=> 'checkbox',
			'label'			=> __( 'Background Repeat', 'theme-slug' ),
			'description'	=> __( 'Should the header background image repeat?', 'theme-slug' ),
		)
	);
    $wp_customize->add_control(
		// $id
		'footer_background_image_repeat',
		// $args
		array(
			'settings'		=> 'footer_background_image_repeat_setting',
			'section'		=> 'sk_section_footer',
			'type'			=> 'checkbox',
			'label'			=> __( 'Background Repeat', 'theme-slug' ),
			'description'	=> __( 'Should the footer background image repeat?', 'theme-slug' ),
		)
	);

	/**
	 * Basic Checkbox control.
	 *
	 * - Control: Basic: Checkbox
	 * - Setting: Display Header Backgroud Image Size
	 * - Sanitization: checkbox
	 *
	 * Register the core "checkbox" control to be used to configure the Display Header Backgroud Image Size setting.
	 *
	 * @uses $wp_customize->add_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_control/
	 * @link $wp_customize->add_control() https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
	 */
	$wp_customize->add_control(
		// $id
		'header_background_image_size',
		// $args
		array(
			'settings'		=> 'header_background_image_size_setting',
			'section'		=> 'sk_section_header',
			'type'			=> 'checkbox',
			'label'			=> __( 'Background Stretch', 'theme-slug' ),
			'description'	=> __( 'Should the header background image stretch in full?', 'theme-slug' ),
		)
	);
    $wp_customize->add_control(
		// $id
		'footer_background_image_size',
		// $args
		array(
			'settings'		=> 'footer_background_image_size_setting',
			'section'		=> 'sk_section_footer',
			'type'			=> 'checkbox',
			'label'			=> __( 'Background Stretch', 'theme-slug' ),
			'description'	=> __( 'Should the footer background image stretch in full?', 'theme-slug' ),
		)
	);


}

// Settings API options initilization and validation.
add_action( 'customize_register', 'sk_register_theme_customizer' );


/**
 * Registers the Theme Customizer Preview with WordPress.
 *
 * @package    sk
 * @since      0.3.0
 * @version    0.3.0
 */
/*
function sk_customizer_live_preview() {
	wp_enqueue_script(
		'sk-theme-customizer',
		get_stylesheet_directory_uri() . '/js/theme-customizer.js',
		array( 'customize-preview' ),
		'0.1.0',
		true
	);
} // end sk_customizer_live_preview
add_action( 'customize_preview_init', 'sk_customizer_live_preview' );
*/

/**
 * Writes the Header Background related controls' values out to the 'head' element of the document
 * by reading the value(s) from the theme mod value in the options table.
 */
function sk_customizer_css() {
	if ( ! get_theme_mod( 'header_background_color_setting' ) && '' === get_theme_mod( 'header_background_image_setting' ) && false === get_theme_mod( 'header_background_image_repeat_setting' ) && false === get_theme_mod( 'header_background_image_size_setting' ) ) {
		return;
	}
?>
	<style type="text/css">
		.site-header {
			<?php if ( get_theme_mod( 'header_background_color_setting' ) ) { ?>
			background-color: <?php echo get_theme_mod( 'header_background_color_setting' ); ?>;
			<?php } ?>

			<?php if ( get_theme_mod( 'header_background_image_setting' ) != '' ) { ?>
				background-image: url(<?php echo get_theme_mod( 'header_background_image_setting' ); ?>);
			<?php } ?>

			<?php if ( true === get_theme_mod( 'header_background_image_repeat_setting' ) ) { ?>
				background-repeat: repeat;
			<?php } ?>

			<?php if ( true === get_theme_mod( 'header_background_image_size_setting' ) ) { ?>
				background-size: cover;
			<?php } ?>
		}
	</style>
<?php
} // end sk_customizer_css

add_action( 'wp_head', 'sk_customizer_css');

function footer_sk_customizer_css() {
	if ( ! get_theme_mod( 'footer_background_color_setting' ) && '' === get_theme_mod( 'footer_background_image_setting' ) && false === get_theme_mod( 'footer_background_image_repeat_setting' ) && false === get_theme_mod( 'footer_background_image_size_setting' ) ) {
		return;
	}
?>
	<style type="text/css">
		.site-footer {
			<?php if ( get_theme_mod( 'footer_background_color_setting' ) ) { ?>
			background-color: <?php echo get_theme_mod( 'footer_background_color_setting' ); ?>;
			<?php } ?>

			<?php if ( get_theme_mod( 'footer_background_image_setting' ) != '' ) { ?>
				background-image: url(<?php echo get_theme_mod( 'footer_background_image_setting' ); ?>);
			<?php } ?>

			<?php if ( true === get_theme_mod( 'footer_background_image_repeat_setting' ) ) { ?>
				background-repeat: repeat;
			<?php } ?>

			<?php if ( true === get_theme_mod( 'footer_background_image_size_setting' ) ) { ?>
				background-size: cover;
			<?php } ?>
		}
	</style>
<?php
} // end sk_customizer_css

add_action( 'wp_footer', 'footer_sk_customizer_css');

function menu_sk_customizer_css() {
	if ( ! get_theme_mod( 'menu_active_color_setting' ) && ! get_theme_mod( 'menu_no_active_color_setting' )) {
		return;
	}
?>
	<style type="text/css">
		.menu-header ul .current_page_item a, .menu-header ul .current_page_item a:hover, .menu-header ul li a:hover{
			<?php if ( get_theme_mod( 'menu_active_color_setting' ) ) { ?>
			color: <?php echo get_theme_mod( 'menu_active_color_setting' ); ?>;
			<?php } ?>
		}

		.menu-header ul li a{
			<?php if ( get_theme_mod( 'menu_no_active_color_setting' ) ) { ?>
			color: <?php echo get_theme_mod( 'menu_no_active_color_setting' ); ?>;
			<?php } ?>
		}
	</style>
<?php
} // end sk_customizer_css

add_action( 'wp_head', 'menu_sk_customizer_css');

function footer_copyright_sk_customizer_css() {
	if ( ! get_theme_mod( 'footer_font_color_setting' )) {
		return;
	}
?>
	<style type="text/css">
		.copyright{
			<?php if ( get_theme_mod( 'footer_font_color_setting' ) ) { ?>
			color: <?php echo get_theme_mod( 'footer_font_color_setting' ); ?> !important;
			<?php } ?>
		}
	</style>
<?php
} // end sk_customizer_css

add_action( 'wp_footer', 'footer_copyright_sk_customizer_css');


function footer_menu_sk_customizer_css() {
	if ( ! get_theme_mod( 'menu_no_active_color_footer_setting' ) && ! get_theme_mod( 'menu_active_color_footer_setting' )) {
		return;
	}
?>
	<style type="text/css">
		.menu-footer ul .current_page_item a, .menu-footer ul .current_page_item a:hover, .menu-footer ul li a:hover{
			<?php if ( get_theme_mod( 'menu_active_color_footer_setting' ) ) { ?>
			color: <?php echo get_theme_mod( 'menu_active_color_footer_setting' ); ?>;
			<?php } ?>
		}

		.menu-footer ul li a{
			<?php if ( get_theme_mod( 'menu_no_active_color_footer_setting' ) ) { ?>
			color: <?php echo get_theme_mod( 'menu_no_active_color_footer_setting' ); ?>;
			<?php } ?>
		}
	</style>
<?php
} // end sk_customizer_css

add_action( 'wp_footer', 'footer_menu_sk_customizer_css');

/*
function footer_copyright_sk_customizer_css() {
	if ( ! get_theme_mod( 'footer_copyright_setting' )) {
		return;
	}
?>
	<style type="text/css">
		.copyright::after{
			<?php if ( get_theme_mod( 'footer_copyright_setting' ) ) { ?>
			content: "<?php echo get_theme_mod( 'footer_copyright_setting' ); ?>";
			<?php } ?>
		}
	</style>
<?php
} // end sk_customizer_css

add_action( 'wp_footer', 'footer_copyright_sk_customizer_css');
*/
function theme_author_shortcode() {
    $theme_name = 'theme'; // customize with your theme name
    $theme_data = get_theme_data( get_theme_root() . '/' . $theme_name . '/style.css' );
    return " ".$theme_data['Author']." ";

	
}

add_shortcode('Theme_Author', 'theme_author_shortcode');

function theme_version_shortcode() {
    $theme_name = 'theme'; // customize with your theme name
    $theme_data = get_theme_data( get_theme_root() . '/' . $theme_name . '/style.css' );
    return " ".$theme_data['Version']." ";
}

add_shortcode('Theme_Version', 'theme_version_shortcode');

function today_year(){
	$year = date('Y');

	return $year;
}
add_shortcode('Year', 'today_year');

function copyright_sing(){
	$copysing = "&copy; Copyright";

	return $copysing;
}
add_shortcode('Copy', 'copyright_sing');





function copyright(){
	$copyright_string = get_theme_mod( 'footer_copyright_setting' );
	$copyright_string = explode(" ", $copyright_string);
	
	for ($i=0; $i < sizeof($copyright_string); $i++) { 
		

		if(substr($copyright_string[$i], 0, 1) =='['){
			
			echo do_shortcode($copyright_string[$i]);
			echo '&nbsp;';
		}else{
			echo $copyright_string[$i]." ";
		}

		
	}
	
	

}

add_action('copy', 'copyright');

// Debug function (console log)

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
  
/*
public static function register( $wp_customize ) {

    $wp_customize->add_setting(
				'header_footer_background_color',
				array(
					'default'           => '#ffffff',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'refresh',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'header_footer_background_color',
					array(
						'label'   => __( 'Header &amp; Footer Background Color', 'twentytwenty' ),
						'section' => 'colors',
					)
				)
			);
}
    function twentytwenty_block_editor_settings() {

        // Block Editor Palette.
        $editor_color_palette = array(
            array(
                'name'  => __( 'Accent Color', 'twentytwenty' ),
                'slug'  => 'accent',
                'color' => twentytwenty_get_color_for_area( 'content', 'accent' ),
            ),
            array(
                'name'  => _x( 'Primary', 'color', 'twentytwenty' ),
                'slug'  => 'primary',
                'color' => twentytwenty_get_color_for_area( 'content', 'text' ),
            ),
            array(
                'name'  => _x( 'Secondary', 'color', 'twentytwenty' ),
                'slug'  => 'secondary',
                'color' => twentytwenty_get_color_for_area( 'content', 'secondary' ),
            ),
            array(
                'name'  => __( 'Subtle Background', 'twentytwenty' ),
                'slug'  => 'subtle-background',
                'color' => twentytwenty_get_color_for_area( 'content', 'borders' ),
            ),
        );
    
        // Add the background option.
        $background_color = get_theme_mod( 'background_color' );
        if ( ! $background_color ) {
            $background_color_arr = get_theme_support( 'custom-background' );
            $background_color     = $background_color_arr[0]['default-color'];
        }
        $editor_color_palette[] = array(
            'name'  => __( 'Background Color', 'twentytwenty' ),
            'slug'  => 'background',
            'color' => '#' . $background_color,
        );
    
        // If we have accent colors, add them to the block editor palette.
        if ( $editor_color_palette ) {
            add_theme_support( 'editor-color-palette', $editor_color_palette );
        }
    
        // Block Editor Font Sizes.
        add_theme_support(
            'editor-font-sizes',
            array(
                array(
                    'name'      => _x( 'Small', 'Name of the small font size in the block editor', 'twentytwenty' ),
                    'shortName' => _x( 'S', 'Short name of the small font size in the block editor.', 'twentytwenty' ),
                    'size'      => 18,
                    'slug'      => 'small',
                ),
                array(
                    'name'      => _x( 'Regular', 'Name of the regular font size in the block editor', 'twentytwenty' ),
                    'shortName' => _x( 'M', 'Short name of the regular font size in the block editor.', 'twentytwenty' ),
                    'size'      => 21,
                    'slug'      => 'normal',
                ),
                array(
                    'name'      => _x( 'Large', 'Name of the large font size in the block editor', 'twentytwenty' ),
                    'shortName' => _x( 'L', 'Short name of the large font size in the block editor.', 'twentytwenty' ),
                    'size'      => 26.25,
                    'slug'      => 'large',
                ),
                array(
                    'name'      => _x( 'Larger', 'Name of the larger font size in the block editor', 'twentytwenty' ),
                    'shortName' => _x( 'XL', 'Short name of the larger font size in the block editor.', 'twentytwenty' ),
                    'size'      => 32,
                    'slug'      => 'larger',
                ),
            )
        );
    
        add_theme_support( 'editor-styles' );
    
        // If we have a dark background color then add support for dark editor style.
        // We can determine if the background color is dark by checking if the text-color is white.
        if ( '#ffffff' === strtolower( twentytwenty_get_color_for_area( 'content', 'text' ) ) ) {
            add_theme_support( 'dark-editor-style' );
        }
    
    }
    add_action( 'after_setup_theme', 'twentytwenty_block_editor_settings' );
    function twentytwenty_get_color_for_area( $area = 'content', $context = 'text' ) {

        // Get the value from the theme-mod.
        $settings = get_theme_mod(
            'accent_accessible_colors',
            array(
                'content'       => array(
                    'text'      => '#000000',
                    'accent'    => '#cd2653',
                    'secondary' => '#6d6d6d',
                    'borders'   => '#dcd7ca',
                ),
                'header-footer' => array(
                    'text'      => '#000000',
                    'accent'    => '#cd2653',
                    'secondary' => '#6d6d6d',
                    'borders'   => '#dcd7ca',
                ),
            )
        );
    
        // If we have a value return it.
        if ( isset( $settings[ $area ] ) && isset( $settings[ $area ][ $context ] ) ) {
            return $settings[ $area ][ $context ];
        }
    
        // Return false if the option doesn't exist.
        return false;
    }*/
    // Register Theme Features
    /*
function custom_header()  {

	// Add theme support for Custom Header
	$header_args = array(
		'default-image'          => '',
		'width'                  => 0,
		'height'                 => 0,
		'flex-width'             => true,
		'flex-height'            => true,
		'uploads'                => true,
		'random-default'         => false,
		'header-text'            => true,
		'default-text-color'     => '',
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
		'video'                  => true,
		'video-active-callback'  => '',
	);
	add_theme_support( 'custom-header', $header_args );
}
add_action( 'after_setup_theme', 'custom_header' );*/

?>