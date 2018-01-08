<?php
// Set prefix
$prefix = 'ccc';


/***********************************************/
/******************* General *******************/
/***********************************************/
$wp_customize->add_section( $prefix . '_contact_us' ,
    array(
        'title'         => __( 'Contact us Section', 'ccc' ),
        'description'   => __( 'Control various options for contact us section from front page.', 'ccc' ),
        'priority'      => ccc_get_section_position($prefix . '_contact_us'),
        'panel'         => 'homepage_customizer'
    )
);

$wp_customize->add_setting( $prefix . '_contact_tab', array(
        'transport'         => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
    )
);
$wp_customize->add_control(  new Epsilon_Control_Tab( $wp_customize,
    $prefix . '_contact_tab',
    array(
        'type'      => 'epsilon-tab',
        'section'   => $prefix . '_contact_us',
        'priority'  => 1,
        'buttons'   => array(
            array(
                'name' => __( 'General', 'ccc' ),
                'fields'    => ccc_create_contact_tab_sections(),
                'active' => true
                ),
            array(
                'name' => __( 'Details', 'ccc' ),
                'fields'    => array(
                    $prefix . '_contact_bar_facebook_url',
                    $prefix . '_contact_bar_twitter_url',
                    $prefix . '_contact_bar_linkedin_url',
                    $prefix . '_contact_bar_googlep_url',
                    $prefix . '_contact_bar_pinterest_url',
                    $prefix . '_contact_bar_instagram_url',
                    $prefix . '_contact_bar_youtube_url',
                    $prefix . '_contact_bar_vimeo_url',
                    $prefix . '_email',
                    $prefix . '_phone',
                    $prefix . '_address1',
                    $prefix . '_address2',
                    ),
                ),
            ),
    ) )
);


// Show this section
$wp_customize->add_setting( $prefix . '_contact_us_show',
    array(
        'sanitize_callback' => $prefix . '_sanitize_checkbox',
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(  new Epsilon_Control_Toggle( $wp_customize,
    $prefix . '_contact_us_show',
    array(
        'type'      => 'mte-toggle',
        'label'     => __( 'Show this section?', 'ccc' ),
        'section'   => $prefix . '_contact_us',
        'priority'  => 1
    ) )
);

// Title
$wp_customize->add_setting( $prefix .'_contact_us_general_title',
    array(
        'sanitize_callback' => 'ccc_sanitize_html',
        'default'           => __( 'Contact us', 'ccc' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_contact_us_general_title',
    array(
        'label'         => __( 'Title', 'ccc' ),
        'description'   => __( 'Add the title for this section.', 'ccc'),
        'section'       => $prefix . '_contact_us',
        'priority'      => 2
    )
);
$wp_customize->selective_refresh->add_partial( $prefix .'_contact_us_general_title', array(
    'selector' => '#contact-us .section-header h3',
) );

// Entry
if ( get_theme_mod( $prefix .'_contact_us_entry' ) ) {
    $wp_customize->add_setting( $prefix .'_contact_us_entry',
        array(
            'sanitize_callback' => 'wp_kses_post',
            'default'           => __( 'And we will get in touch as soon as possible.', 'ccc' ),
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( new Epsilon_Editor_Custom_Control(
        $wp_customize,
        $prefix .'_contact_us_entry',
        array(
            'label'         => __( 'Entry', 'ccc' ),
            'description'   => __( 'Add the content for this section.', 'ccc'),
            'section'       => $prefix . '_contact_us',
            'priority'      => 3,
            'type'          => 'textarea'
        ) )
    );
}elseif ( !defined( "ILLDY_COMPANION" ) ) {
    
    $wp_customize->add_setting(
        $prefix . '_contact_us_entry',
        array(
            'sanitize_callback' => 'esc_html',
            'default'           => '',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new CCC_Text_Custom_Control(
            $wp_customize, $prefix . '_contact_us_entry',
            array(
                'label'             => __( 'Install CCC Companion', 'ccc' ),
                'description'       => sprintf(__( 'In order to edit description please install <a href="%s" target="_blank">CCC Companion</a>', 'ccc' ), ccc_get_recommended_actions_url()),
                'section'           => $prefix . '_contact_us',
                'settings'          => $prefix . '_contact_us_entry',
                'priority'          => 3,
            )
        )
    );
    
}
$wp_customize->selective_refresh->add_partial( $prefix .'_contact_us_entry', array(
    'selector' => '#contact-us .section-header .section-description',
) );

// Address Title
$wp_customize->add_setting( $prefix .'_contact_us_general_address_title',
    array(
        'sanitize_callback' => 'ccc_sanitize_html',
        'default'           => __( 'Address', 'ccc' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_contact_us_general_address_title',
    array(
        'label'         => __( 'Address Title', 'ccc' ),
        'section'       => $prefix . '_contact_us',
        'priority'      => 4
    )
);
$wp_customize->selective_refresh->add_partial( $prefix .'_contact_us_general_address_title', array(
    'selector' => '#contact-us .section-content .row .col-sm-4 .box-left',
) );

// Customer Support Title
$wp_customize->add_setting( $prefix .'_contact_us_general_customer_support_title',
    array(
        'sanitize_callback' => 'ccc_sanitize_html',
        'default'           => __( 'Customer Support', 'ccc' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_contact_us_general_customer_support_title',
    array(
        'label'         => __( 'Customer Support Title', 'ccc' ),
        'section'       => $prefix . '_contact_us',
        'priority'      => 5
    )
);
$wp_customize->selective_refresh->add_partial( $prefix .'_contact_us_general_customer_support_title', array(
    'selector' => '#contact-us .section-content .row .col-sm-5 .box-left',
) );

// Contact Form 7
$wp_customize->add_setting( 'ccc_contact_us_general_contact_form_7',
    array(
        'sanitize_callback' => 'sanitize_key'
    )
);
$wp_customize->add_control( new CCC_CF7_Custom_Control(
    $wp_customize,
    'ccc_contact_us_general_contact_form_7',
        array(
            'label'             => __( 'Select the contact form you\'d like to display (powered by Contact Form 7)', 'ccc' ),
            'section'           => $prefix . '_contact_us',
            'priority'          => 6,
            'type'              => 'ccc_contact_form_7'
        )
    )
);

// Contact Form Creation
$wp_customize->add_setting(
    $prefix . '_contact_us_install_contact_form_7',
    array(
        'sanitize_callback' => 'esc_html',
        'default'           => '',
        'transport'         => 'refresh'
    )
);
$wp_customize->add_control(
    new CCC_Text_Custom_Control(
        $wp_customize, $prefix . '_contact_us_install_contact_form_7',
        array(
            'label'             => __( 'Contact Form Creation', 'ccc' ),
            'description'       => sprintf( '%s %s %s', __( 'Install', 'ccc' ), '<a href="https://wordpress.org/plugins/contact-form-7/" title="Contact Form 7" target="_blank">Contact Form 7</a>', __( 'and select a contact form to work this setting.', 'ccc' ) ),
            'section'           => $prefix .'_contact_us',
            'settings'          => $prefix . '_contact_us_install_contact_form_7',
            'priority'          => 7,
            'active_callback'   => 'ccc_is_not_active_contact_form_7'
        )
    )
);

$wp_customize->add_setting(
    $prefix . '_contact_us_create_contact_form_7',
    array(
        'sanitize_callback' => 'esc_html',
        'default'           => '',
        'transport'         => 'refresh'
    )
);
$wp_customize->add_control(
    new CCC_Text_Custom_Control(
        $wp_customize, $prefix . '_contact_us_create_contact_form_7',
        array(
            'label'             => __( 'Contact Form Creation', 'ccc' ),
            'description'       => sprintf( '%s %s', __( 'Create a contact form from ', 'ccc' ), '<a href="'.admin_url('admin.php?page=wpcf7-new').'" title="Contact Form 7" target="_blank">here</a>' ),
            'section'           => $prefix .'_contact_us',
            'settings'          => $prefix . '_contact_us_create_contact_form_7',
            'priority'          => 7,
            'active_callback'   => 'ccc_have_not_contact_form_7'
        )
    )
);


    /***********************************************/
    /************** Contact Details  ***************/
    /***********************************************/


    /* Facebook URL */
    $wp_customize->add_setting( 'ccc_contact_bar_facebook_url',
        array(
            'sanitize_callback'  => 'esc_url_raw',
            'default'            =>  esc_url_raw('#'),
            'transport'          => 'postMessage'
        )
    );

    $wp_customize->add_control( 'ccc_contact_bar_facebook_url',
        array(
            'label'          => __( 'Facebook URL', 'ccc' ),
            'section'        => $prefix.'_contact_us',
            'settings'       => 'ccc_contact_bar_facebook_url',
            'priority'       => 10
        )
    );

    $wp_customize->selective_refresh->add_partial( $prefix .'_contact_bar_facebook_url', array(
        'selector' => '#contact-us .contact-us-social',
        'render_callback' => $prefix .'_contact_us_social',
    ) );

    /* Twitter URL */
    $wp_customize->add_setting( $prefix.'_contact_bar_twitter_url',
        array(
            'sanitize_callback'  => 'esc_url_raw',
            'default'            =>  esc_url_raw('#'),
            'transport'          => 'postMessage'
        )
    );

    $wp_customize->add_control( $prefix.'_contact_bar_twitter_url',
        array(
            'label'          => __( 'Twitter URL', 'ccc' ),
            'section'        => $prefix.'_contact_us',
            'settings'       => $prefix.'_contact_bar_twitter_url',
            'priority'       => 10
        )
    );

    /* LinkedIN URL */
    $wp_customize->add_setting( $prefix.'_contact_bar_linkedin_url',
        array(
            'sanitize_callback'  => 'esc_url_raw',
            'default'            => esc_url_raw('#'),
            'transport'          => 'postMessage'
        )
    );

    $wp_customize->add_control( $prefix.'_contact_bar_linkedin_url',
        array(
            'label'          => __( 'LinkedIN URL', 'ccc' ),
            'section'        => $prefix.'_contact_us',
            'settings'       => $prefix.'_contact_bar_linkedin_url',
            'priority'       => 10
        )
    );

	/* Google+ URL */
	$wp_customize->add_setting( $prefix.'_contact_bar_googlep_url',
		array(
			'sanitize_callback'  => 'esc_url_raw',
			'default'            => esc_url_raw('#'),
			'transport'          => 'postMessage'
		)
	);

	$wp_customize->add_control( $prefix.'_contact_bar_googlep_url',
		array(
			'label'          => __( 'Google+ URL', 'ccc' ),
			'section'        => $prefix.'_contact_us',
			'settings'       => $prefix.'_contact_bar_googlep_url',
			'priority'       => 10
		)
	);

	/* Pinterest URL */
	$wp_customize->add_setting( $prefix.'_contact_bar_pinterest_url',
		array(
			'sanitize_callback'  => 'esc_url_raw',
			'default'            => esc_url_raw('#'),
			'transport'          => 'postMessage'
		)
	);

	$wp_customize->add_control( $prefix.'_contact_bar_pinterest_url',
		array(
			'label'          => __( 'Pinterest URL', 'ccc' ),
			'section'        => $prefix.'_contact_us',
			'settings'       => $prefix.'_contact_bar_pinterest_url',
			'priority'       => 10
		)
	);

	/* Instagram URL */
	$wp_customize->add_setting( $prefix.'_contact_bar_instagram_url',
		array(
			'sanitize_callback'  => 'esc_url_raw',
			'default'            => esc_url_raw('#'),
			'transport'          => 'postMessage'
		)
	);

	$wp_customize->add_control( $prefix.'_contact_bar_instagram_url',
		array(
			'label'          => __( 'Instagram URL', 'ccc' ),
			'section'        => $prefix.'_contact_us',
			'settings'       => $prefix.'_contact_bar_instagram_url',
			'priority'       => 10
		)
	);

	/* YouTube URL */
	$wp_customize->add_setting( $prefix.'_contact_bar_youtube_url',
		array(
			'sanitize_callback'  => 'esc_url_raw',
			'default'            => esc_url_raw('#'),
			'transport'          => 'postMessage'
		)
	);

	$wp_customize->add_control( $prefix.'_contact_bar_youtube_url',
		array(
			'label'          => __( 'YouTube URL', 'ccc' ),
			'section'        => $prefix.'_contact_us',
			'settings'       => $prefix.'_contact_bar_youtube_url',
			'priority'       => 10
		)
	);

	/* Vimeo URL */
	$wp_customize->add_setting( $prefix.'_contact_bar_vimeo_url',
		array(
			'sanitize_callback'  => 'esc_url_raw',
			'default'            => esc_url_raw('#'),
			'transport'          => 'postMessage'
		)
	);

	$wp_customize->add_control( $prefix.'_contact_bar_vimeo_url',
		array(
			'label'          => __( 'Vimeo URL', 'ccc' ),
			'section'        => $prefix.'_contact_us',
			'settings'       => $prefix.'_contact_bar_vimeo_url',
			'priority'       => 10
		)
	);



    /* email */
    $wp_customize->add_setting( $prefix.'_email',
        array(
            'sanitize_callback'  => 'sanitize_text_field',
            'default'            => __( 'contact@site.com', 'ccc' ),
            'transport'          => 'postMessage'
        )
    );

    $wp_customize->add_control( $prefix.'_email',
        array(
            'label'         => __( 'Email addr.', 'ccc' ),
            'section'       => $prefix.'_contact_us',
            'settings'      => $prefix.'_email',
            'priority'      => 10
        )
    );
    $wp_customize->selective_refresh->add_partial( $prefix .'_email', array(
        'selector' => '#contact-us .section-content .row .col-sm-5 .box-right span:first-child',
        'render_callback' => $prefix .'_email',
    ) );


    /* phone number */
    $wp_customize->add_setting( $prefix.'_phone',
        array(
            'sanitize_callback'  => 'ccc_sanitize_html',
            'default'            => __( '(555) 555-5555', 'ccc' ),
            'transport'          => 'postMessage'
        )
    );

    $wp_customize->add_control( $prefix.'_phone',
        array(
            'label'         => __( 'Phone number', 'ccc' ),
            'section'       => $prefix.'_contact_us',
            'settings'      => $prefix.'_phone',
            'priority'      => 12
        )
    );
    $wp_customize->selective_refresh->add_partial( $prefix .'_phone', array(
        'selector' => '#contact-us .section-content .row .col-sm-5 .box-right span:nth-child(2)',
    ) );

    // Address 1
    $wp_customize->add_setting(
        $prefix . '_address1',
        array(
            'sanitize_callback'  => 'ccc_sanitize_html',
            'default'            => __( 'Street 221B Baker Street, ', 'ccc' ),
            'transport'          => 'postMessage'
        )
    );

    $wp_customize->add_control(
        $prefix . '_address1',
        array(
            'label'         => __( 'Address 1', 'ccc' ),
            'section'       => $prefix . '_contact_us',
            'priority'      => 13
        )
    );
    $wp_customize->selective_refresh->add_partial( $prefix .'_address1', array(
        'selector' => '#contact-us .section-content .row .col-sm-4 .box-right span:first-child',
    ) );

    // Address 2
    $wp_customize->add_setting(
        $prefix . '_address2',
        array(
            'sanitize_callback'  => 'ccc_sanitize_html',
            'default'            => __( 'London, UK', 'ccc' ),
            'transport'          => 'postMessage'
        )
    );

    $wp_customize->add_control(
        $prefix . '_address2',
        array(
            'label'         => __( 'Address 2', 'ccc' ),
            'section'       => $prefix . '_contact_us',
            'priority'      => 13
        )
    );
    $wp_customize->selective_refresh->add_partial( $prefix .'_address2', array(
        'selector' => '#contact-us .section-content .row .col-sm-4 .box-right span:nth-child(2)',
        'render_callback' => $prefix .'_address2',
    ) );