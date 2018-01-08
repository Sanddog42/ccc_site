<?php
// Set Panel ID
// Set panel_id


error_log("panel id is : $panel_id");


/***********************************************/
/********************* ABOUT  ******************/
/***********************************************/
$wp_customize->add_section( $panel_id,
    array(
        'priority'          => ccc_get_section_position($panel_id),
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => __( "$panel_title", 'ccc' ),
        'description'       => __( "Use this to customize the $column column container # $section for the home page. Remember that if you are editing the widgets for this container, go to the $column Column Sidebar in the Widget menu.", 'ccc' ),
        'panel'             => 'homepage_customizer'
    )
);

/***********************************************/
/******************* General *******************/
/***********************************************/


// Show this section
$wp_customize->add_setting( $panel_id . '_about_general_show',
    array(
        'sanitize_callback' => 'ccc_sanitize_checkbox',
        'default'           => 1,
    )
);
$wp_customize->add_control( new Epsilon_Control_Toggle( $wp_customize, 
    $panel_id . '_about_general_show',
    array(
        'type'      => 'mte-toggle',
        'label'     => __( 'Show this section?', 'ccc' ),
        'section'   => $panel_id,
        'priority'  => 1
    ) )
);

// Title
$wp_customize->add_setting( $panel_id .'_about_general_title',
    array(
        'sanitize_callback' => 'ccc_sanitize_html',
        'default'           => __( 'About', 'ccc' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $panel_id .'_about_general_title',
    array(
        'label'         => __( 'Title', 'ccc' ),
        'description'   => __( 'Add the title for this section.', 'ccc'),
        'section'       => $panel_id,
        'priority'      => 2
    )
);
$wp_customize->selective_refresh->add_partial( $panel_id .'_about_general_title', array(
    'selector' => '#about .section-header h3',
    'render_callback' => $panel_id .'_about_general_title',
) );

// Entry

    $wp_customize->add_setting( $panel_id .'_about_general_entry',
        array(
            'sanitize_callback' => 'wp_kses_post',
            'default'           => __( 'It is an amazing one-page theme with great features that offers an incredible experience. It is easy to install, make changes, adapt for your business. A modern design with clean lines and styling for a wide variety of content, exactly how a business design should be. You can add as many images as you want to the main header area and turn them into slider.', 'ccc' ),
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( new Epsilon_Editor_Custom_Control(
        $wp_customize,
        $panel_id .'_about_general_entry',
        array(
            'label'         => __( 'Entry', 'ccc' ),
            'description'   => __( 'Add the content for this section.', 'ccc'),
            'section'       => $panel_id,
            'priority'      => 3,
            'type'          => 'textarea'
        ) )
    );

$wp_customize->selective_refresh->add_partial( $panel_id .'_about_general_entry', array(
    'selector' => '#about .section-header .section-description',
    'render_callback' => $panel_id .'_about_general_entry',
) );

$wp_customize->add_setting( $panel_id .'_about_widget_button',
    array(
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
    )
);


$wp_customize->add_setting( $panel_id . '_about_tab', array(
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
    )
);
$wp_customize->add_control(  new Epsilon_Control_Tab( $wp_customize,
    $panel_id . '_about_tab',
    array(
        'type'      => 'epsilon-tab',
        'section'   => $panel_id,
        'buttons'   => array(
            array(
                'name' => __( 'Colors', 'ccc' ),
                'fields'    => array(
                    $panel_id . '_about_title_color',
                    $panel_id . '_about_descriptions_color',
                    $panel_id . '_about_general_color',
                    ),
                'active' => true
                ),
            array(
                'name' => __( 'Background', 'ccc' ),
                'fields'    => array(
                    $panel_id . '_about_general_image',
                    $panel_id . '_about_background_color',
                    $panel_id . '_about_use_gradient',
                    $panel_id . '_about_background_color_gradient',
                    $panel_id . '_about_background_size',
                    $panel_id . '_about_background_repeat',
                    $panel_id . '_about_background_opaque',
                    $panel_id . '_about_background_attachment',
                    $panel_id . '_about_background_position',
                    ),
                ),
            ),
    ) )
);

// Background Color
$wp_customize->add_setting( $panel_id . '_about_background_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#ffffff',
    'transport'         => 'postMessage',

) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $panel_id . '_about_background_color', array(
    'label'    => __( 'Background Color', 'ccc' ),
    'section'  => $panel_id,
    'settings' => $panel_id . '_about_background_color',
) ) );

$wp_customize->add_setting( $panel_id . '_about_use_gradient', array(
    'sanitize_callback' => 'ccc_sanitize_checkbox',
    'default'           => 0,
    'transport'         => 'postMessage',
) );

$wp_customize->add_control(  new Epsilon_Control_Toggle( $wp_customize, $panel_id . '_about_use_gradient', array(
    'type'        => 'mte-toggle',
    'label'       => __( 'Use Color Gradient', 'ccc' ),
    'section'     => $panel_id,
) ) );

$wp_customize->add_setting( $panel_id . '_about_background_color_gradient', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#ffffff',
    'transport'         => 'postMessage',

) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $panel_id . '_about_background_color_gradient', array(
    'label'    => __( 'Background Color Gradient', 'ccc' ),
    'section'  => $panel_id,
    'settings' => $panel_id . '_about_background_color_gradient',
) ) );

// Background Image
$wp_customize->add_setting( $panel_id . '_about_general_image', array(
    'sanitize_callback' => 'esc_url',
    'default'           => '',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $panel_id . '_about_general_image', array(
    'label'    => __( 'Background Image', 'ccc' ),
    'section'  => $panel_id,
    'settings' => $panel_id . '_about_general_image',
) ) );
$wp_customize->add_setting( $panel_id.'_about_background_position_x', array(
    'default'        => 'center',
    'sanitize_callback' => 'esc_html',
    'transport'         => 'postMessage',
) );
$wp_customize->add_setting( $panel_id.'_about_background_position_y', array(
    'default'        => 'center',
    'sanitize_callback' => 'esc_html',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, $panel_id.'_about_background_position', array(
    'label'    => __( 'Background Position', 'ccc' ),
    'section'  => $panel_id,
    'settings' => array(
        'x' => $panel_id.'_about_background_position_x',
        'y' => $panel_id.'_about_background_position_y',
    ),
) ) );
$wp_customize->add_setting( $panel_id . '_about_background_size', array(
    'default' => 'cover',
    'sanitize_callback' => 'ccc_sanitize_background_size',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( $panel_id . '_about_background_size', array(
    'label'      => __( 'Image Size', 'ccc' ),
    'section'    => $panel_id,
    'type'       => 'select',
    'choices'    => array(
        'auto'    => __( 'Original', 'ccc' ),
        'contain' => __( 'Fit to Screen', 'ccc' ),
        'cover'   => __( 'Fill Screen', 'ccc' ),
    ),
) );

$wp_customize->add_setting( $panel_id . '_about_background_repeat', array(
    'sanitize_callback' => 'ccc_sanitize_checkbox',
    'default'           => 0,
    'transport'         => 'postMessage',
) );

$wp_customize->add_control(  new Epsilon_Control_Toggle( $wp_customize, $panel_id . '_about_background_repeat', array(
    'type'        => 'mte-toggle',
    'label'       => __( 'Repeat Background Image', 'ccc' ),
    'section'     => $panel_id,
) ) );

$wp_customize->add_setting( $panel_id . '_about_background_opaque', array(
    'sanitize_callback' => 'ccc_sanitize_checkbox',
    'default'           => 0,
    'transport'         => 'postMessage',
) );

$wp_customize->add_control(  new Epsilon_Control_Toggle( $wp_customize, $panel_id . '_about_background_opaque', array(
    'type'        => 'mte-toggle',
    'label'       => __( 'Opaque Background', 'ccc' ),
    'section'     => $panel_id,
) ) );

$wp_customize->add_setting( $panel_id . '_about_background_attachment', array(
    'sanitize_callback' => 'ccc_sanitize_checkbox',
    'default'           => 0,
    'transport'         => 'postMessage',
) );

$wp_customize->add_control(  new Epsilon_Control_Toggle( $wp_customize, $panel_id . '_about_background_attachment', array(
    'type'        => 'mte-toggle',
    'label'       => __( 'Scroll with Page', 'ccc' ),
    'section'     => $panel_id,
) ) );


$wp_customize->add_setting( $panel_id . '_about_title_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#545454',
    'transport'         => 'postMessage',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $panel_id . '_about_title_color', array(
    'label'    => __( 'Title Color', 'ccc' ),
    'section'  => $panel_id,
    'settings' => $panel_id . '_about_title_color',
) ) );

$wp_customize->add_setting( $panel_id . '_about_descriptions_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#8c9597',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $panel_id . '_about_descriptions_color', array(
    'label'    => __( 'Description Color', 'ccc' ),
    'section'  => $panel_id,
    'settings' => $panel_id . '_about_descriptions_color',
) ) );