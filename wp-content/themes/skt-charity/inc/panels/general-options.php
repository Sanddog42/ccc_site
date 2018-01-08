<?php
// Set Panel ID
$panel_id = 'ccc_panel_general';

// Set prefix
$prefix = 'ccc';


// Change panel for Static Front Page
$site_title        = $wp_customize->get_section( 'static_front_page' );
$site_title->panel = $panel_id;

// Change Logo section
$site_logo              = $wp_customize->get_control( 'custom_logo' );
$site_logo->description = __( 'The site logo is used as a graphical representation of your company name. Recommended size: 105 (width) x 75 (height) pixels(px).', 'ccc' );
$site_logo->label       = __( 'Site logo', 'ccc' );
$site_logo->section     = $prefix . '_general_logo_section';
$site_logo->priority    = 1;

// Change site icon section
$site_icon           = $wp_customize->get_control( 'site_icon' );
$site_icon->section  = $prefix . '_general_logo_section';
$site_icon->priority = 2;




/***********************************************/
/************** GENERAL OPTIONS  ***************/
/***********************************************/


$wp_customize->add_panel( $panel_id, array(
	'priority'       => 1,
	'capability'     => 'edit_theme_options',
	'theme_supports' => '',
	'title'          => __( 'General Options', 'ccc' ),
	'description'    => __( 'You can change the site layout in this area as well as your contact details (the ones displayed in the header & footer) ', 'ccc' ),
) );

/***********************************************/
/****************** Preloader  *****************/
/***********************************************/

$wp_customize->add_section( $prefix . '_preloader_section', array(
	'title'    => __( 'Preloader', 'ccc' ),
	'priority' => 1,
	'panel'    => $panel_id,
) );

// Enable the preloader?
$wp_customize->add_setting( $prefix . '_preloader_enable', array(
	'sanitize_callback' => $prefix . '_value_checkbox_helper',
	'default'           => 1,
) );
$wp_customize->add_control(  new Epsilon_Control_Toggle( $wp_customize, $prefix . '_preloader_enable', array(
	'type'     => 'mte-toggle',
	'label'    => __( 'Enable the site preloader?', 'ccc' ),
	'section'  => $prefix . '_preloader_section',
	'priority' => 1,
) ) );

// Background Color
$wp_customize->add_setting( $prefix . '_preloader_background_color', array(
	'sanitize_callback' => 'sanitize_hex_color',
	'default'           => '#ffffff',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_preloader_background_color', array(
	'label'       => __( 'Preloader background color', 'ccc' ),
	'description' => __( 'Controls the background color for the container where the preloader is diplayed on', 'ccc' ),
	'section'     => $prefix . '_preloader_section',
	'settings'    => $prefix . '_preloader_background_color',
	'priority'    => 2,
) ) );

// Primary Color
$wp_customize->add_setting( $prefix . '_preloader_primary_color', array(
	'sanitize_callback' => 'sanitize_hex_color',
	'default'           => '#f1d204',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_preloader_primary_color', array(
	'label'       => __( 'Preloader primary color', 'ccc' ),
	'description' => __( 'Controls the color of the loading bar & of the percentage.', 'ccc' ),
	'section'     => $prefix . '_preloader_section',
	'settings'    => $prefix . '_preloader_primary_color',
	'priority'    => 3,
) ) );

// Secondly Color
$wp_customize->add_setting( $prefix . '_preloader_secondly_color', array(
	'sanitize_callback' => 'sanitize_hex_color',
	'default'           => '#ffffff',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_preloader_secondly_color', array(
	'label'       => __( 'Preloader secondary color', 'ccc' ),
	'description' => __( 'Controls the color outline of the preloader (the border)', 'ccc' ),
	'section'     => $prefix . '_preloader_section',
	'settings'    => $prefix . '_preloader_secondly_color',
	'priority'    => 4,
) ) );

/***********************************************/
/*********** Logo section  ************/
/***********************************************/

$wp_customize->add_section( $prefix . '_general_logo_section', array(
	'title'    => __( 'Logo', 'ccc' ),
	'priority' => 2,
	'panel'    => $panel_id,
) );

/***********************************************/
/*********** General Site Settings  ************/
/***********************************************/
$wp_customize->selective_refresh->add_partial( 'custom_logo', array(
    'selector' => '#header .col-sm-2 a:not(.header-logo)',
    'render_callback' => $prefix .'_custom_logo',
) );

/* Company text logo */
$wp_customize->add_setting( $prefix . '_text_logo', array(
	'sanitize_callback' => 'ccc_sanitize_html',
	'default'           => __( 'CCC', 'ccc' ),
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( $prefix . '_text_logo', array(
	'label'       => __( 'Text logo (company name)', 'ccc' ),
	'description' => __( 'This field is best used when you don\'t have an image logo or simply prefer using a text as your logo / company name.', 'ccc' ),
	'section'     => $prefix . '_general_logo_section',
	'priority'    => 2,
) );
$wp_customize->selective_refresh->add_partial( $prefix .'_text_logo', array(
    'selector' => '#header a.header-logo',
) );



/***********************************************/
/************** Footer Details  ***************/
/***********************************************/
$wp_customize->add_section( $prefix . '_general_footer_section', array(
	'title'       => __( 'Copyright', 'ccc' ),
	'description' => __( 'From this section, you\'ll be able to alter the footer settings. Manage your copyright message as well as the logo shown in the footer of the theme.', 'ccc' ),
	'priority'    => 4,
	'panel'       => $panel_id,
) );

/* Footer Copyright */
$wp_customize->add_setting( $prefix . '_footer_copyright', array(
	'sanitize_callback' => 'ccc_sanitize_html',
	'default'           => __( '&copy; Copyright 2016. All Rights Reserved.', 'ccc' ),
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( $prefix . '_footer_copyright', array(
	'label'       => __( 'Footer Copyright', 'ccc' ),
	'description' => __( 'Use this to display your company copyright message.', 'ccc' ),
	'section'     => $prefix . '_general_footer_section',
	'priority'    => 2,
) );

$wp_customize->selective_refresh->add_partial( $prefix .'_footer_copyright', array(
    'selector' => '#footer .bottom-copyright',
) );

