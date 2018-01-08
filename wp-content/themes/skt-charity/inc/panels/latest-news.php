<?php

// Set prefix
$prefix = 'ccc';

/***********************************************/
/******************* General *******************/
/***********************************************/
$wp_customize->add_section( $prefix . '_latest_news_general' ,
    array(
        'title'         => __( 'Latest News Section', 'ccc' ),
        'description'   => __( 'Control various options for latest news section from front page.', 'ccc' ),
        'priority'      => ccc_get_section_position($prefix . '_latest_news_general'),
        'panel' 	    => 'homepage_customizer'
    )
);

// Show this section
$wp_customize->add_setting( $prefix . '_latest_news_general_show',
    array(
        'sanitize_callback' => $prefix . '_sanitize_checkbox',
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( new Epsilon_Control_Toggle( $wp_customize,
    $prefix . '_latest_news_general_show',
    array(
        'type'      => 'mte-toggle',
        'label'     => __( 'Show this section?', 'ccc' ),
        'section'   => $prefix . '_latest_news_general',
        'priority'  => 1
    ) )
);

// Title
$wp_customize->add_setting( $prefix .'_latest_news_general_title',
    array(
        'sanitize_callback' => 'ccc_sanitize_html',
        'default'           => __( 'Latest News', 'ccc' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_latest_news_general_title',
    array(
        'label'         => __( 'Title', 'ccc' ),
        'description'   => __( 'Add the title for this section.', 'ccc'),
        'section'       => $prefix . '_latest_news_general',
        'priority'      => 2
    )
);
$wp_customize->selective_refresh->add_partial( $prefix .'_latest_news_general_title', array(
    'selector' => '#latest-news .section-header h3',
) );

// Entry
if ( get_theme_mod( $prefix .'_latest_news_general_entry' ) ) {
    $wp_customize->add_setting( $prefix .'_latest_news_general_entry',
        array(
            'sanitize_callback' => 'wp_kses_post',
            'default'           => __( 'If you are interested in the latest articles in the industry, take a sneak peek at our blog. You have nothing to loose!', 'ccc' ),
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(  new Epsilon_Editor_Custom_Control(
        $wp_customize,
        $prefix .'_latest_news_general_entry',
        array(
            'label'         => __( 'Entry', 'ccc' ),
            'description'   => __( 'Add the content for this section.', 'ccc'),
            'section'       => $prefix . '_latest_news_general',
            'priority'      => 3,
        ) )
    );
}elseif ( !defined( "ILLDY_COMPANION" ) ) {
    
    $wp_customize->add_setting(
        $prefix . '_latest_news_general_entry',
        array(
            'sanitize_callback' => 'esc_html',
            'default'           => '',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new CCC_Text_Custom_Control(
            $wp_customize, $prefix . '_latest_news_general_entry',
            array(
                'label'             => __( 'Install CCC Companion', 'ccc' ),
                'description'       => sprintf(__( 'In order to edit description please install <a href="%s" target="_blank">CCC Companion</a>', 'ccc' ), ccc_get_recommended_actions_url()),
                'section'           => $panel_id,
                'settings'          => $prefix . '_latest_news_general_text',
                'priority'          => 3,
            )
        )
    );
    
}
$wp_customize->selective_refresh->add_partial( $prefix .'_latest_news_general_entry', array(
    'selector' => '#latest-news .section-header .section-description',
) );

// Button Text
$wp_customize->add_setting( $prefix .'_latest_news_button_text',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'See blog', 'ccc' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_latest_news_button_text',
    array(
        'label'         => __( 'Button Text', 'ccc' ),
        'description'   => __( 'Add the button text for this section.', 'ccc'),
        'section'       => $prefix . '_latest_news_general',
        'priority'      => 4
    )
);
$wp_customize->selective_refresh->add_partial( $prefix .'_latest_news_button_text', array(
    'selector' => '#latest-news .latest-news-button',
) );


// Number of posts
$wp_customize->add_setting( $prefix .'_latest_news_number_of_posts',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 3,
    )
);

$wp_customize->add_control( new Epsilon_Control_Slider(
    $wp_customize,
    $prefix .'_latest_news_number_of_posts',
    array(
        'label'       => esc_html__( 'Number of posts', 'ccc' ),
        'description' => esc_html__( 'Add the number of posts to show in this section.', 'ccc'),
        'choices'     => array(
            'min'  => 3,
            'max'  => 9,
            'step' => 3,
        ),
        'section'       => $prefix . '_latest_news_general',
        'priority'      => 5
    )
)
);

$wp_customize->add_setting( $prefix .'_latest_news_words_number',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 20,
    )
);

$wp_customize->add_control( new Epsilon_Control_Slider(
    $wp_customize,
    $prefix .'_latest_news_words_number',
    array(
        'label'       => esc_html__( 'Number of words in post entry', 'ccc' ),
        'choices'     => array(
            'min'  => 20,
            'max'  => 100,
            'step' => 10,
        ),
        'section'       => $prefix . '_latest_news_general',
        'priority'      => 6
    )
)
);

// Colors
// Colors & Backgrounds
$wp_customize->add_setting( $prefix . '_latest_news_tab', array(
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
    )
);
$wp_customize->add_control(  new Epsilon_Control_Tab( $wp_customize,
    $prefix . '_latest_news_tab',
    array(
        'type'      => 'epsilon-tab',
        'section'   => $prefix . '_latest_news_general',
        'buttons'   => array(
            array(
                'name' => __( 'Colors', 'ccc' ),
                'fields'    => array(
                    $prefix . '_latest_news_title_color',
                    $prefix . '_latest_news_descriptions_color',
                    $prefix . '_latest_news_general_color',
                    $prefix . '_latest_news_button_background',
                    $prefix . '_latest_news_second_button_background',
                    $prefix . '_latest_news_button_background_hover',
                    $prefix . '_latest_news_button_color',
                    $prefix . '_latest_news_post_bakground_color',
                    $prefix . '_latest_news_post_text_color',
                    $prefix . '_latest_news_post_text_hover_color',
                    $prefix . '_latest_news_post_content_color',
                    $prefix . '_latest_news_post_button_color',
                    $prefix . '_latest_news_post_button_hover_color',
                    ),
                'active' => true
                ),
            array(
                'name' => __( 'Backgrounds', 'ccc' ),
                'fields'    => array(
                    $prefix . '_latest_news_general_image',
                    $prefix . '_latest_news_background_size',
                    $prefix . '_latest_news_background_repeat',
                    $prefix . '_latest_news_background_attachment',
                    $prefix . '_latest_news_background_position',
                    ),
                ),
            ),
    ) )
);

// Background Image
$wp_customize->add_setting( $prefix . '_latest_news_general_image', array(
    'sanitize_callback' => 'esc_url',
    'default'           => '',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix . '_latest_news_general_image', array(
    'label'    => __( 'Background Image', 'ccc' ),
    'section'  => $prefix . '_latest_news_general',
    'settings' => $prefix . '_latest_news_general_image',
) ) );
$wp_customize->add_setting( $prefix.'_latest_news_background_position_x', array(
    'default'        => 'center',
    'sanitize_callback' => 'esc_html',
    'transport'         => 'postMessage',
) );
$wp_customize->add_setting( $prefix.'_latest_news_background_position_y', array(
    'default'        => 'center',
    'sanitize_callback' => 'esc_html',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, $prefix.'_latest_news_background_position', array(
    'label'    => __( 'Background Position', 'ccc' ),
    'section'  => $prefix . '_latest_news_general',
    'settings' => array(
        'x' => $prefix.'_latest_news_background_position_x',
        'y' => $prefix.'_latest_news_background_position_y',
    ),
) ) );
$wp_customize->add_setting( $prefix . '_latest_news_background_size', array(
    'default' => 'cover',
    'sanitize_callback' => 'ccc_sanitize_background_size',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( $prefix . '_latest_news_background_size', array(
    'label'      => __( 'Image Size', 'ccc' ),
    'section'    => $prefix . '_latest_news_general',
    'type'       => 'select',
    'choices'    => array(
        'auto'    => __( 'Original', 'ccc' ),
        'contain' => __( 'Fit to Screen', 'ccc' ),
        'cover'   => __( 'Fill Screen', 'ccc' ),
    ),
) );

$wp_customize->add_setting( $prefix . '_latest_news_background_repeat', array(
    'sanitize_callback' => $prefix . '_sanitize_checkbox',
    'default'           => 0,
    'transport'         => 'postMessage',
) );

$wp_customize->add_control(  new Epsilon_Control_Toggle( $wp_customize, $prefix . '_latest_news_background_repeat', array(
    'type'        => 'mte-toggle',
    'label'       => __( 'Repeat Background Image', 'ccc' ),
    'section'     => $prefix . '_latest_news_general',
) ) );

$wp_customize->add_setting( $prefix . '_latest_news_background_attachment', array(
    'sanitize_callback' => $prefix . '_sanitize_checkbox',
    'default'           => 0,
    'transport'         => 'postMessage',
) );

$wp_customize->add_control(  new Epsilon_Control_Toggle( $wp_customize, $prefix . '_latest_news_background_attachment', array(
    'type'        => 'mte-toggle',
    'label'       => __( 'Scroll with Page', 'ccc' ),
    'section'     => $prefix . '_latest_news_general',
) ) );


// Background Color
$wp_customize->add_setting( $prefix . '_latest_news_general_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#222f36',
    'transport'         => 'postMessage',

) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_latest_news_general_color', array(
    'label'    => __( 'Background Color', 'ccc' ),
    'section'  => $prefix . '_latest_news_general',
    'settings' => $prefix . '_latest_news_general_color',
) ) );
$wp_customize->add_setting( $prefix . '_latest_news_title_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#fff',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_latest_news_title_color', array(
    'label'    => __( 'Title Color', 'ccc' ),
    'section'  => $prefix . '_latest_news_general',
    'settings' => $prefix . '_latest_news_title_color',
) ) );

$wp_customize->add_setting( $prefix . '_latest_news_descriptions_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#fff',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_latest_news_descriptions_color', array(
    'label'    => __( 'Description Color', 'ccc' ),
    'section'  => $prefix . '_latest_news_general',
    'settings' => $prefix . '_latest_news_descriptions_color',
) ) );

$wp_customize->add_setting( $prefix . '_latest_news_button_background', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#f1d204',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_latest_news_button_background', array(
    'label'    => __( 'Blog Button Background Color', 'ccc' ),
    'section'  => $prefix . '_latest_news_general',
    'settings' => $prefix . '_latest_news_button_background',
) ) );

$wp_customize->add_setting( $prefix . '_latest_news_button_background_hover', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#6a4d8a',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_latest_news_button_background_hover', array(
    'label'    => __( 'Blog Button Hover Background Color', 'ccc' ),
    'section'  => $prefix . '_latest_news_general',
    'settings' => $prefix . '_latest_news_button_background_hover',
) ) );

// Colors


$wp_customize->add_setting( $prefix . '_latest_news_button_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#fff',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_latest_news_button_color', array(
    'label'    => __( 'Blog Button Text Color', 'ccc' ),
    'section'  => $prefix . '_latest_news_general',
    'settings' => $prefix . '_latest_news_button_color',
) ) );

$wp_customize->add_setting( $prefix . '_latest_news_post_bakground_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#fff',
    'transport'         => 'postMessage',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_latest_news_post_bakground_color', array(
    'label'    => __( 'Post Box Background Color', 'ccc' ),
    'section'  => $prefix . '_latest_news_general',
    'settings' => $prefix . '_latest_news_post_bakground_color',
) ) );

$wp_customize->add_setting( $prefix . '_latest_news_post_text_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#5e5e5e',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_latest_news_post_text_color', array(
    'label'    => __( 'Post Title Color', 'ccc' ),
    'section'  => $prefix . '_latest_news_general',
    'settings' => $prefix . '_latest_news_post_text_color',
) ) );

$wp_customize->add_setting( $prefix . '_latest_news_post_text_hover_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#f1d204',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_latest_news_post_text_hover_color', array(
    'label'    => __( 'Post Title Hover Color', 'ccc' ),
    'section'  => $prefix . '_latest_news_general',
    'settings' => $prefix . '_latest_news_post_text_hover_color',
) ) );

$wp_customize->add_setting( $prefix . '_latest_news_post_content_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#8c9597',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_latest_news_post_content_color', array(
    'label'    => __( 'Post Content Color', 'ccc' ),
    'section'  => $prefix . '_latest_news_general',
    'settings' => $prefix . '_latest_news_post_content_color',
) ) );

$wp_customize->add_setting( $prefix . '_latest_news_post_button_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#f1d204',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_latest_news_post_button_color', array(
    'label'    => __( 'Blog Button Background Color', 'ccc' ),
    'section'  => $prefix . '_latest_news_general',
    'settings' => $prefix . '_latest_news_post_button_color',
) ) );

$wp_customize->add_setting( $prefix . '_latest_news_post_button_hover_color', array(
    'sanitize_callback' => 'sanitize_hex_color',
    'default'           => '#6a4d8a',
    'transport'         => 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $prefix . '_latest_news_post_button_hover_color', array(
    'label'    => __( 'Blog Button Hover Background Color', 'ccc' ),
    'section'  => $prefix . '_latest_news_general',
    'settings' => $prefix . '_latest_news_post_button_hover_color',
) ) );