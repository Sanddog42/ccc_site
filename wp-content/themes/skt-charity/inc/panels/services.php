<?php
// Set Panel ID
$panel_id = 'ccc_panel_services';

// Set prefix
$prefix = 'ccc';

/***********************************************/
/****************** SERVICES  ******************/
/***********************************************/
$wp_customize->add_section( $panel_id, array(
		'priority'       => ccc_get_section_position($panel_id),
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Services Section', 'ccc' ),
		'description'    => __( 'Control various options for services section from front page.', 'ccc' ),
		'panel'			 => 'homepage_customizer'
	) );

/***********************************************/
/******************* General *******************/
/***********************************************/


// Show this section
$wp_customize->add_setting( $prefix . '_services_general_show', array(
		'sanitize_callback' => $prefix . '_sanitize_checkbox',
		'default'           => 1,
		'transport'         => 'postMessage',
	) );
$wp_customize->add_control( new Epsilon_Control_Toggle( $wp_customize, $prefix . '_services_general_show', array(
		'type'     => 'mte-toggle',
		'label'    => __( 'Show this section?', 'ccc' ),
		'section'  => $panel_id,
		'priority' => 1,
	) ) );

// Title
$wp_customize->add_setting( $prefix . '_services_general_title', array(
		'sanitize_callback' => 'ccc_sanitize_html',
		'default'           => __( 'Services', 'ccc' ),
		'transport'         => 'postMessage',
	) );
$wp_customize->add_control( $prefix . '_services_general_title', array(
		'label'       => __( 'Title', 'ccc' ),
		'description' => __( 'Add the title for this section.', 'ccc' ),
		'section'     => $panel_id,
		'priority'    => 2,
	) );
$wp_customize->selective_refresh->add_partial( $prefix .'_services_general_title', array(
    'selector' => '#services .section-header h3',
) );

// Entry
if ( get_theme_mod( $prefix . '_services_general_entry' ) ) {

	$wp_customize->add_setting( $prefix . '_services_general_entry', array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'In order to help you grow your business, our carefully selected experts can advise you in in the following areas:', 'ccc' ),
			'transport'         => 'postMessage',
		) );
	$wp_customize->add_control(  new Epsilon_Editor_Custom_Control(
        	$wp_customize, $prefix . '_services_general_entry', array(
			'label'       => __( 'Entry', 'ccc' ),
			'description' => __( 'Add the content for this section.', 'ccc' ),
			'section'     => $panel_id,
			'priority'    => 3,
		) ) );
	$wp_customize->selective_refresh->add_partial( $prefix .'_services_general_entry', array(
	    'selector' => '#services .section-header .section-description',
	) );

}elseif ( !defined( "ILLDY_COMPANION" ) ) {
    
    $wp_customize->add_setting(
        $prefix . '_services_entry_text',
        array(
            'sanitize_callback' => 'esc_html',
            'default'           => '',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new CCC_Text_Custom_Control(
            $wp_customize, $prefix . '_services_entry_text',
            array(
                'label'             => __( 'Install CCC Companion', 'ccc' ),
                'description'       => sprintf(__( 'In order to edit description please install <a href="%s" target="_blank">CCC Companion</a>', 'ccc' ), ccc_get_recommended_actions_url()),
                'section'           => $panel_id,
                'settings'          => $prefix . '_services_entry_text',
                'priority'          => 3,
            )
        )
    );
}
$wp_customize->add_setting( $prefix .'_services_widget_button',
    array(
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
    )
);
$wp_customize->add_control(
    new Epsilon_Control_Button(
        $wp_customize,
        $prefix .'_services_widget_button',
        array(
            'text'         => __( 'Add & Edit Services', 'ccc' ),
            'section_id'    => 'sidebar-widgets-front-page-services-sidebar',
            'icon'          => 'dashicons-plus',
            'section'       => $panel_id,
            'priority'      => 5
        )
    )
);


$wp_customize->add_setting( $prefix . '_services_tab', array(
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(  new Epsilon_Control_Tab( $wp_customize,
    $prefix . '_services_tab',
    array(
        'type'      => 'epsilon-tab',
        'section'   => $panel_id,
        'buttons'   => array(
            array(
                'name' => __( 'Colors', 'ccc' ),
                'fields'    => array(
                    $prefix . '_services_title_color',
                    $prefix . '_services_descriptions_color',
                    $prefix . '_services_general_color',
                    ),
                'active' => true
                ),
            array(
                'name' => __( 'Backgrounds', 'ccc' ),
                'fields'    => array(
                    $prefix . '_services_general_image',
                    $prefix . '_services_background_size',
                    $prefix . '_services_background_repeat',
                    $prefix . '_services_background_attachment',
                    $prefix . '_services_background_position',
                    ),
                ),
            ),
    ) )
);

// Background Image
$wp_customize->add_setting( $prefix . '_services_general_image', array(
    'sanitize_callback' => 'esc_url',
    'default'           => '',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix . '_services_general_image', array(
    'label'    => __( 'Background Image', 'ccc' ),
    'section'  => $panel_id,
    'settings' => $prefix . '_services_general_image',
) ) );
$wp_customize->add_setting( $prefix.'_services_background_position_x', array(
    'default'        => 'center',
    'sanitize_callback' => 'esc_html',
    'transport'         => 'postMessage',
) );
$wp_customize->add_setting( $prefix.'_services_background_position_y', array(
    'default'        => 'center',
    'sanitize_callback' => 'esc_html',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, $prefix.'_services_background_position', array(
    'label'    => __( 'Background Position', 'ccc' ),
    'section'  => $panel_id,
    'settings' => array(
        'x' => $prefix.'_services_background_position_x',
        'y' => $prefix.'_services_background_position_y',
    ),
) ) );
$wp_customize->add_setting( $prefix . '_services_background_size', array(
    'default' => 'cover',
    'sanitize_callback' => 'ccc_sanitize_background_size',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( $prefix . '_services_background_size', array(
    'label'      => __( 'Image Size', 'ccc' ),
    'section'    => $panel_id,
    'type'       => 'select',
    'choices'    => array(
        'auto'    => __( 'Original', 'ccc' ),
        'contain' => __( 'Fit to Screen', 'ccc' ),
        'cover'   => __( 'Fill Screen', 'ccc' ),
    ),
) );

$wp_customize->add_setting( $prefix . '_services_background_repeat', array(
    'sanitize_callback' => $prefix . '_sanitize_checkbox',
    'default'           => 0,
    'transport'         => 'postMessage',
) );

$wp_customize->add_control(  new Epsilon_Control_Toggle( $wp_customize, $prefix . '_services_background_repeat', array(
    'type'        => 'mte-toggle',
    'label'       => __( 'Repeat Background Image', 'ccc' ),
    'section'     => $panel_id,
) ) );

$wp_customize->add_setting( $prefix . '_services_background_attachment', array(
    'sanitize_callback' => $prefix . '_sanitize_checkbox',
    'default'           => 0,
    'transport'         => 'postMessage',
) );

$wp_customize->add_control(  new Epsilon_Control_Toggle( $wp_customize, $prefix . '_services_background_attachment', array(
    'type'        => 'mte-toggle',
    'label'       => __( 'Scroll with Page', 'ccc' ),
    'section'     => $panel_id,
) ) );

$wp_customize->add_setting( $prefix . '_services_general_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#fff',
    'transport'         => 'postMessage',

) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_services_general_color', array(
    'label'    => __( 'Background Color', 'ccc' ),
    'section'  => $panel_id,
    'settings' => $prefix . '_services_general_color',
) ) );

$wp_customize->add_setting( $prefix . '_services_title_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#545454',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_services_title_color', array(
    'label'    => __( 'Title Color', 'ccc' ),
    'section'  => $panel_id,
    'settings' => $prefix . '_services_title_color',
) ) );

$wp_customize->add_setting( $prefix . '_services_descriptions_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#8c9597',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_services_descriptions_color', array(
    'label'    => __( 'Description Color', 'ccc' ),
    'section'  => $panel_id,
    'settings' => $prefix . '_services_descriptions_color',
) ) );