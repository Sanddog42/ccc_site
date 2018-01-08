<?php

$version = rand (1, 1000) . "." . rand (1, 1000);

/**
 * SKT Charity Theme Customizer
 *
 * @package SKT Charity
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function skt_charity_customize_register( $wp_customize ) {
	
	//Add a class for titles
    class skt_charity_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
	
	class WP_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';
 
    public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
        <?php
    }
}
		// Custom Controls
		require_once get_template_directory() . '/inc/custom-controls.php';
		require_once get_template_directory() . '/inc/custom-section.php';
		require_once get_template_directory() . '/inc/control-epsilon-color-scheme.php';
		
		$wp_customize->register_control_type( 'Epsilon_Control_Tab' );
		$wp_customize->register_control_type( 'Epsilon_Control_Button' );
		$wp_customize->register_section_type( 'CCC_Customize_Section_Pro' );
		$wp_customize->remove_section('header_image');
		$wp_customize->remove_section('background_image');
		$wp_customize->remove_section('colors');




	//$wp_customize->get_section('site_identity')->priority = "1";


/*
	
	$wp_customize->add_setting('color_scheme',array(
			'default'	=> '#844a21',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => __('Color Scheme','skt-charity'),			
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);



*/
	// ##################### Front Page sections panel



	$wp_customize->add_panel( 'homepage_customizer', array(
	    'priority'       => 10,
	    'title'          => esc_html__( 'Home Page Content', 'skt-charity' ),
	    'description'	 => esc_html__( 'Drag & drop to reorder homepage sections', 'skt-charity' ),
	) );

/*

$section = $wp_customize->get_section('static_front_page');
$section->panel = "homepage_customizer";
$section->priority = ccc_get_section_position('static_front_page');*/


		//end three column part

	
	
	$wp_customize->add_section('social_sec',array(
			'title'	=> __('Social Settings','skt-charity'),				
			'priority'		=> null
	));
	
	$wp_customize->add_setting('fb_link',array(
			'default'	=> '#facebook',
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control('fb_link',array(
			'label'	=> __('Add facebook link here','skt-charity'),
			'section'	=> 'social_sec',
			'setting'	=> 'fb_link'
	));	
	$wp_customize->add_setting('twitt_link',array(
			'default'	=> '#twitter',
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('twitt_link',array(
			'label'	=> __('Add twitter link here','skt-charity'),
			'section'	=> 'social_sec',
			'setting'	=> 'twitt_link'
	));
	$wp_customize->add_setting('gplus_link',array(
			'default'	=> '#gplus',
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('gplus_link',array(
			'label'	=> __('Add google plus link here','skt-charity'),
			'section'	=> 'social_sec',
			'setting'	=> 'gplus_link'
	));
	$wp_customize->add_setting('linked_link',array(
			'default'	=> '#linkedin',
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('linked_link',array(
			'label'	=> __('Add linkedin link here','skt-charity'),
			'section'	=> 'social_sec',
			'setting'	=> 'linked_link'
	));

	$wp_customize->add_section('footer_area',array(
			'title'	=> __('Footer Area','skt-charity'),
			'priority'	=> null,
			'description'	=> __('','skt-charity')
	));
	
	$wp_customize->add_setting('contact_title',array(
			'default'	=> __('Contact Info','skt-charity'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('contact_title',array(
			'label'	=> __('Add title for our contact','skt-charity'),
			'section'	=> 'footer_area',
			'setting'	=> 'contact_title'
	));	
	
	$wp_customize->add_setting('about_title',array(
			'default'	=> __('About Charity','skt-charity'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('about_title',array(
			'label'	=> __('Add title for about charity','skt-charity'),
			'section'	=> 'footer_area',
			'setting'	=> 'about_title'
	));
	
	$wp_customize->add_setting('about_description',array(
			'default'	=> __('Donec ut ex ac nulla pellentesque mollis in a enim. Praesent placerat sapien mauris, vitae sodales tellus venenatis ac. Suspendisse suscipit velit id ultricies auctor. Egestas et erat a, vehicula interdum augue Donec ut ex ac nulla pellentesque mollis in a enim. Praesent placerat sapien mauris.','skt-charity'),
			'sanitize_callback'	=> 'wp_htmledit_pre'
	));
	
	$wp_customize->add_control(	new WP_Customize_Textarea_Control( $wp_customize,'about_description', array(	
			'label'	=> __('Add description for about us','skt-charity'),
			'section'	=> 'footer_area',
			'setting'	=> 'about_description'
	)) );
	
	$wp_customize->add_setting('sunday_hours',array(
			'default'	=> __('8:00am-10:00pm','skt-charity'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_setting('monday_hours',array(
			'default'	=> __('8:00am-10:00pm','skt-charity'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_setting('tuesday_hours',array(
			'default'	=> __('8:00am-10:00pm','skt-charity'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_setting('wednesday_hours',array(
			'default'	=> __('8:00am-10:00pm','skt-charity'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_setting('thursday_hours',array(
			'default'	=> __('8:00am-10:00pm','skt-charity'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_setting('friday_hours',array(
			'default'	=> __('8:00am-10:00pm','skt-charity'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_setting('saturday_hours',array(
			'default'	=> __('8:00am-10:00pm','skt-charity'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));

	
	$wp_customize->add_control('sunday_hours',array(
			'label'	=> __('Sunday Hours','skt-charity'),
			'section'	=> 'footer_area',
			'setting'	=> 'sunday_hours'
	));	

	$wp_customize->add_control('monday_hours',array(
			'label'	=> __('Monday Hours','skt-charity'),
			'section'	=> 'footer_area',
			'setting'	=> 'monday_hours'
	));	
	$wp_customize->add_control('tuesday_hours',array(
			'label'	=> __('Tuesday Hours','skt-charity'),
			'section'	=> 'footer_area',
			'setting'	=> 'Tuesday_hours'
	));	
	$wp_customize->add_control('wednesday_hours',array(
			'label'	=> __('Wednesday Hours','skt-charity'),
			'section'	=> 'footer_area',
			'setting'	=> 'wednesday_hours'
	));	
	$wp_customize->add_control('thursday_hours',array(
			'label'	=> __('Thursday Hours','skt-charity'),
			'section'	=> 'footer_area',
			'setting'	=> 'thursday_hours'
	));	
	
	$wp_customize->add_control('friday_hours',array(
			'label'	=> __('Friday Hours','skt-charity'),
			'section'	=> 'footer_area',
			'setting'	=> 'friday_hours'
	));	
	
	$wp_customize->add_control('saturday_hours',array(
			'label'	=> __('Saturday Hours','skt-charity'),
			'section'	=> 'footer_area',
			'setting'	=> 'saturday_hours'
	));	
	
		
	
	$wp_customize->add_setting('contact_add',array(
			'default'	=> __('1600 Amphitheatre Parkway Mountain View, CA 94043','skt-charity'),
			'sanitize_callback'	=> 'wp_htmledit_pre'
	));
	
	$wp_customize->add_control(	new WP_Customize_Textarea_Control( $wp_customize, 'contact_add', array(
				'label'	=> __('Add contact address here','skt-charity'),
				'section'	=> 'footer_area',
				'setting'	=> 'contact_add'
			)
		)
	);
	$wp_customize->add_setting('contact_no',array(
			'default'	=> __('+123 456 7890','skt-charity'),
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('contact_no',array(
			'label'	=> __('Add contact number here.','skt-charity'),
			'section'	=> 'footer_area',
			'setting'	=> 'contact_no'
	));
	$wp_customize->add_setting('contact_mail',array(
			'default'	=> 'contact@company.com',
			'sanitize_callback'	=> 'sanitize_email'
	));
	
	$wp_customize->add_control('contact_mail',array(
			'label'	=> __('Add you email here','skt-charity'),
			'section'	=> 'footer_area',
			'setting'	=> 'contact_mail'
	));	
	
	
	$wp_customize->add_section('header_info',array(
			'title'	=> __('Header Info','skt-charity'),
			'description'	=> __('Add phone number and address','skt-charity'),
			'priority'	=> 9
	));	
	
	$wp_customize->add_setting('header_message',array(
			'default'	=> __('A space where all can seek wisdom, serenity, courage and joy.','skt-charity'),
			'sanitize_callback'	=> 'wp_htmledit_pre'
	));
	
	$wp_customize->add_control(	new WP_Customize_Textarea_Control( $wp_customize, 'header_message', array(
				'label'	=> __('Add short message header','skt-charity'),
				'section'	=> 'header_info',
				'setting'	=> 'header_message'
			)
		)
	);
	
	$wp_customize->add_setting('donate_link',array(
			'default'	=> '#',
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('donate_link',array(
			'label'	=> __('Add link for header donate button','skt-charity'),
			'section'	=> 'header_info',
			'setting'	=> 'donate_link'
	));

	// About
	// General Options
	$column = 1;
	$section = 1;
	$panel_id = "ccc_" . $column ."_column_" . $section;
	$panel_title = "$column Column Section # $section";
	//require_once get_template_directory() . '/inc/panels/general-options.php';
	require get_template_directory() . '/inc/panels/column-section.php';

	$column = 1;
	$section = 2;
	$panel_id = "ccc_" . $column ."_column_" . $section;
	$panel_title = "$column Column Section # $section";
	//require_once get_template_directory() . '/inc/panels/general-options.php';
	require get_template_directory() . '/inc/panels/column-section.php';

	$column = 3;
	$section = 1;
	$panel_id = "ccc_" . $column ."_column_" . $section;
	$panel_title = "$column Column Section # $section";
	//require_once get_template_directory() . '/inc/panels/general-options.php';
	require get_template_directory() . '/inc/panels/column-section.php';

	$column = 3;
	$section = 2;
	$panel_id = "ccc_" . $column ."_column_" . $section;
	$panel_title = "$column Column Section # $section";
	//require_once get_template_directory() . '/inc/panels/general-options.php';
	require get_template_directory() . '/inc/panels/column-section.php';

	$column = 5;
	$section = 1;
	$panel_id = "ccc_" . $column ."_column_" . $section;
	$panel_title = "$column Column Section # $section";
	//require_once get_template_directory() . '/inc/panels/general-options.php';
	require get_template_directory() . '/inc/panels/column-section.php';

	$column = 5;
	$section = 2;
	$panel_id = "ccc_" . $column ."_column_" . $section;
	$panel_title = "$column Column Section # $section";
	//require_once get_template_directory() . '/inc/panels/general-options.php';
	require get_template_directory() . '/inc/panels/column-section.php';

	$column = 1;
	$section = 1;
	$panel_id = "ccc_carousel_1";
	$panel_title = "Carousel 1";
	//require_once get_template_directory() . '/inc/panels/general-options.php';
	require get_template_directory() . '/inc/panels/column-section.php';

	$column = 1;
	$section = 2;
	$panel_id = "ccc_carousel_2";
	$panel_title = "Carousel 2";
	//require_once get_template_directory() . '/inc/panels/general-options.php';
	require get_template_directory() . '/inc/panels/column-section.php';


}
add_action( 'customize_register', 'skt_charity_customize_register' );

add_action( 'wp_ajax_ccc_order_sections', 'ccc_order_sections' );

function ccc_order_sections() {

	error_log('in the order of sections');

	if ( isset($_POST['sections']) ) {
		
		set_theme_mod( 'ccc_frontpage_sections', $_POST['sections'] );
		echo 'succes';

	}

	wp_die(); // this is required to terminate immediately and return a proper response
}

if ( ! function_exists( 'ccc_get_sections_position' ) ) {
	function ccc_get_sections_position() {
		$defaults = array(
				'ccc_5_column_1',
				'ccc_5_column_2',
				'ccc_3_column_1',
				'ccc_3_column_2',
				'ccc_1_column_1',
				'ccc_1_column_2',
				'ccc_carousel_1',
				'ccc_carousel_2'
			);
		$sections = get_theme_mod( 'ccc_frontpage_sections', $defaults );
		return $sections;
	}
}

if ( ! function_exists( 'ccc_get_section_position' ) ) {
	function ccc_get_section_position( $key ) {
		$sections = ccc_get_sections_position();
		$position = array_search( $key, $sections );
		$return = ($position+1)*10;
		return $return;
	}
}

function ccc_sanitize_background_repeat( $value, $setting ) {
	if ( ! in_array( $value, array( 'repeat-x', 'repeat-y', 'repeat', 'no-repeat' ) ) ) {
		return new WP_Error( 'invalid_value', __( 'Invalid value for background repeat.', 'ccc' ) );
	}
	return $value;
}

function ccc_sanitize_background_preset( $value, $setting ) {
 	if ( ! in_array( $value, array( 'default', 'fill', 'fit', 'repeat', 'custom' ), true ) ) {
		return new WP_Error( 'invalid_value', __( 'Invalid value for background size.', 'ccc' ) );
	}

	return $value;
}

function ccc_sanitize_background_size( $value, $setting ) {
	if ( ! in_array( $value, array( 'auto', 'contain', 'cover' ), true ) ) {
		return new WP_Error( 'invalid_value', __( 'Invalid value for background size.', 'ccc' ) );
	}
	return $value;
}

//Integer
function skt_charity_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

function skt_charity_custom_css(){
		?>
        	<style type="text/css"> 
					a, .blog_lists h2 a:hover,
					#sidebar ul li a:hover,								
					.cols-4 ul li a:hover, .cols-4 ul li.current_page_item a,					
					.phone-no strong,					
					.sitenav ul li a:hover, .sitenav ul li.current_page_item a,					
					.logo h1 span,
					.headertop .left a:hover,
					.services-wrap .one_third h4,
					.cols-4 h5 span,
					.welcomewrap h2 span,
					.one_four_page:hover h4 a,
					.one_four_page:hover a.more,
					.blog_lists h3 a:hover			
					{ color:<?php echo esc_attr(get_theme_mod('color_scheme','#844a21', 'skt-charity')); ?>;}
					 
					
					.pagination ul li .current, .pagination ul li a:hover, 
					#commentform input#submit:hover,					
					.nivo-controlNav a.active,				
					h3.widget-title,				
					.wpcf7 input[type='submit'],
					.headertop .right a,
					.services-wrap .one_third:hover,
					.widget-right,
					a.ReadMore,
					.donatebtn:hover, .search-form input[type='submit'], .current
					{ background-color:<?php echo esc_attr(get_theme_mod('color_scheme','#844a21', 'skt-charity')); ?>;}
					
						
					.headerxx									
					{ border-color:<?php echo esc_attr(get_theme_mod('color_scheme','#844a21', 'skt-charity')); ?>;}
					
			</style> 
<?php   
}
         

if ( ! function_exists( 'ccc_get_sections_position' ) ) {
	function ccc_get_sections_position() {
		$defaults = array(
				'ccc_3_column_1',
				'ccc_3_column_2',
				'ccc_5_column_1',
				'ccc_5_column_2',
				'ccc_carousel_1',
				'ccc_carousel_2'
			);
		$sections = get_theme_mod( 'ccc_frontpage_sections', $defaults );
		return $sections;
	}
}

if ( ! function_exists( 'ccc_get_section_position' ) ) {
	function ccc_get_section_position( $key ) {
		$sections = ccc_get_sections_position();
		$position = array_search( $key, $sections );
		$return = ($position+1)*10;
		return $return;
	}
}

if ( ! function_exists( 'ccc_customizer_css_load' ) ) {
	function ccc_customizer_css_load() {
		$version = rand (1, 1000) . "." . rand (1, 1000);
		error_log("observe mario here, version is " . $version);
		wp_enqueue_style( 'ccc-customizer-css', get_template_directory_uri() . '/inc/assets/css/ccc-customizer.css' , array(), $version);
	}

	add_action( 'customize_controls_print_styles', 'ccc_customizer_css_load' );
}


/**
 *  Customizer Live Preview
 */
if ( ! function_exists( 'ccc_customizer_live_preview' ) ) {
	add_action( 'customize_preview_init', 'ccc_customizer_live_preview' );

	function ccc_customizer_live_preview() {
		$version = rand (1, 1000) . "." . rand (1, 1000);
		wp_enqueue_script( 'skt_charity_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), $version, true );
		wp_enqueue_script( 'ccc-handlebars', get_template_directory_uri() . '/inc/assets/js/handlebars.js', array(), '1.0', true );
		wp_enqueue_script( 'ccc-customizer-live-preview', get_template_directory_uri() . '/inc/assets/js/ccc-customizer-live-preview.js', array( 'customize-preview' ), $version, true );

		wp_localize_script( 'ccc-customizer-live-preview', 'WPUrls', array(
			'siteurl' => get_option( 'siteurl' ),
			'theme'   => get_template_directory_uri(),
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		) );

	}

}



// Wp Editor
class Epsilon_Editor_Scripts {
    /**
     * Enqueue scripts/styles.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public static function enqueue() {
        if ( ! class_exists( '_WP_Editors' ) ) {
            require(ABSPATH . WPINC . '/class-wp-editor.php');
        }
        add_action( 'customize_controls_print_footer_scripts', array( __CLASS__, 'enqueue_editor' ),  2 );
        add_action( 'customize_controls_print_footer_scripts', array( '_WP_Editors', 'editor_js' ), 50 );
        add_action( 'customize_controls_print_footer_scripts', array( '_WP_Editors', 'enqueue_scripts' ), 1 );
    }
    public  static function enqueue_editor(){
        if( ! isset( $GLOBALS['__wp_mce_editor__'] ) || ! $GLOBALS['__wp_mce_editor__'] ) {
            $GLOBALS['__wp_mce_editor__'] = true;
            ?>
            <script id="_wp-mce-editor-tpl" type="text/html">
                <?php wp_editor('', '__wp_mce_editor__'); ?>
            </script>
            <?php
        }
    }
}
add_action( 'customize_controls_enqueue_scripts', array( 'Epsilon_Editor_Scripts', 'enqueue' ), 95 );


if ( ! function_exists( 'ccc_customizer_js_load' ) ) {
	function ccc_customizer_js_load() {
		wp_enqueue_style( 'plugin-install' );
		wp_enqueue_script( 'plugin-install' );
		wp_enqueue_script( 'updates' );
		wp_localize_script( 'updates', '_wpUpdatesItemCounts', array(
			'totals'  => wp_get_update_data(),
		) );
		wp_add_inline_script( 'plugin-install', 'var pagenow = "plugin-install";' );
		wp_enqueue_script( 'ccc-customizer', get_template_directory_uri() . '/inc/assets/js/ccc-customizer.js', array( 'customize-controls' ), '1.0', true );

		$CCCCustomizer = array();
		$CCCCustomizer['sections'] = ccc_get_sections_position();
		$CCCCustomizer['ajax_url'] = admin_url( 'admin-ajax.php' );
		$CCCCustomizer['template_directory'] = get_template_directory_uri();

		wp_localize_script( 'ccc-customizer', 'CCCCustomizer', $CCCCustomizer );

	}

	add_action( 'customize_controls_enqueue_scripts', 'ccc_customizer_js_load', 99 );
}
/**
 *  Sanitize Radio Buttons
 */
if ( ! function_exists( 'ccc_sanitize_radio_buttons' ) ) {
	function ccc_sanitize_radio_buttons( $input, $setting ) {
		global $wp_customize;

		$control = $wp_customize->get_control( $setting->id );

		if ( array_key_exists( $input, $control->choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}
}

if ( ! function_exists( 'ccc_sanitize_checkbox' ) ) {
	/**
	 * Function to sanitize checkboxes
	 *
	 * @param $value
	 *
	 * @return int
	 */
	function ccc_sanitize_checkbox( $value ) {
		if ( $value == 1 ) {
			return 1;
		} else {
			return 0;
		}
	}
}


/**
 *  Sanitize HTML
 */
if ( ! function_exists( 'ccc_sanitize_html' ) ) {
	function ccc_sanitize_html( $input ) {
		$input = force_balance_tags( $input );

		$allowed_html = array(
			'a'      => array(
				'href'  => array(),
				'title' => array(),
			),
			'br'     => array(),
			'em'     => array(),
			'img'    => array(
				'alt'    => array(),
				'src'    => array(),
				'srcset' => array(),
				'title'  => array(),
			),
			'strong' => array(),
		);
		$output       = wp_kses( $input, $allowed_html );

		return $output;
	}
}

/**
 *  Sanitize Select
 */
if ( ! function_exists( 'ccc_sanitize_select' ) ) {
	function ccc_sanitize_select( $input ) {
		if ( is_numeric( $input ) ) {
			return intval( $input );
		}
	}
}

if ( ! function_exists( 'ccc_about_general_title' ) ) {
	function ccc_about_general_title() {
		return get_theme_mode( 'ccc_about_general_title' );
	}
}

if ( ! function_exists( 'ccc_about_general_entry' ) ) {
	function ccc_about_general_entry() {
		return get_theme_mode( 'ccc_about_general_entry' );
	}
}

if ( ! function_exists( 'ccc_contact_us_general_title' ) ) {
	function ccc_contact_us_general_title() {
		return get_theme_mode( 'ccc_contact_us_general_title' );
	}
}

if ( ! function_exists( 'ccc_contact_us_general_text' ) ) {
	function ccc_contact_us_general_text() {
		return get_theme_mode( 'ccc_contact_us_general_text' );
	}
}

if ( ! function_exists( 'ccc_contact_us_general_address_title' ) ) {
	function ccc_contact_us_general_address_title() {
		return get_theme_mode( 'ccc_contact_us_general_address_title' );
	}
}

if ( ! function_exists( 'ccc_contact_us_general_customer_support_title' ) ) {
	function ccc_contact_us_general_customer_support_title() {
		return get_theme_mode( 'ccc_contact_us_general_customer_support_title' );
	}
}

if ( ! function_exists( 'ccc_address2' ) ) {
	function ccc_address2() {
		return get_theme_mode( 'ccc_address2' );
	}
}

if ( ! function_exists( 'ccc_address1' ) ) {
	function ccc_address1() {
		return get_theme_mode( 'ccc_address1' );
	}
}

if ( ! function_exists( 'ccc_phone' ) ) {
	function ccc_phone() {
		return get_theme_mode( 'ccc_phone' );
	}
}

if ( ! function_exists( 'ccc_email' ) ) {
	function ccc_email() {
		return get_theme_mode( 'ccc_email' );
	}
}

if ( ! function_exists( 'ccc_footer_copyright' ) ) {
	function ccc_footer_copyright() {
		return get_theme_mode( 'ccc_footer_copyright' );
	}
}



// New
if ( ! function_exists( 'ccc_img_footer_logo' ) ) {
	function ccc_img_footer_logo() {
		$img_footer_logo   = get_theme_mod( 'ccc_img_footer_logo' );
		if ( $img_footer_logo ) {
			$html = '<img src="'.esc_url( $img_footer_logo ).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'" title="'.esc_attr( get_bloginfo( 'name' ) ).'" />';
		}else{
			$html = '';
		}
		
		return $html;
	}
}

