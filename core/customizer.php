<?php

function a5t_customize_register( $wp_customize )
{

// GENERAL SETTINGS    
$wp_customize->add_section('a5t_framework_general_settings', array(
	'title'    => __('General settings', 'a5t_framework'),
	'priority' => 120,
));
	
	
	// GOOGLE MAPS API
	$wp_customize->add_setting( 'a5t_setting_maps', array(
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'a5t_setting_maps', array(
	  'type' => 'text',
	  'section' => 'a5t_framework_general_settings', // Add a default or your own section
	  'label' => __( 'GMaps API KEY' ),
	));
	// Fontawesome
	$wp_customize->add_setting( 'a5t_setting_fa', array(
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'a5t_setting_fa', array(
	  'type' => 'checkbox',
	  'section' => 'a5t_framework_general_settings', // Add a default or your own section
	  'label' => __( 'Fontawesome' ),
	));
	// Animate CSS
	$wp_customize->add_setting( 'a5t_setting_animate', array(
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'a5t_setting_animate', array(
	  'type' => 'checkbox',
	  'section' => 'a5t_framework_general_settings', // Add a default or your own section
	  'label' => __( 'Animate CSS' ),
	));
	// Hover CSS
	$wp_customize->add_setting( 'a5t_setting_hover', array(
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'a5t_setting_hover', array(
	  'type' => 'checkbox',
	  'section' => 'a5t_framework_general_settings', // Add a default or your own section
	  'label' => __( 'Hover CSS' ),
	));
    // magic_mouse CSS
    $wp_customize->add_setting( 'a5t_setting_magic_mouse', array(
        'capability' => 'edit_theme_options',
    ) );
    $wp_customize->add_control( 'a5t_setting_magic_mouse', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings', // Add a default or your own section
        'label' => __( 'magic_mouse CSS' ),
    ));
    // nprogress CSS
    $wp_customize->add_setting( 'a5t_setting_nprogress', array(
        'capability' => 'edit_theme_options',
    ) );
    $wp_customize->add_control( 'a5t_setting_nprogress', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings', // Add a default or your own section
        'label' => __( 'nprogress CSS' ),
    ));
    // butter_js CSS
    $wp_customize->add_setting( 'a5t_setting_butter_js', array(
        'capability' => 'edit_theme_options',
    ) );
    $wp_customize->add_control( 'a5t_setting_butter_js', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings', // Add a default or your own section
        'label' => __( 'butter_js CSS' ),
    ));
    // owl_carousel CSS
    $wp_customize->add_setting( 'a5t_setting_owl_carousel', array(
        'capability' => 'edit_theme_options',
    ) );
    $wp_customize->add_control( 'a5t_setting_owl_carousel', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings', // Add a default or your own section
        'label' => __( 'owl_carousel CSS' ),
    ));
	// Cookies
	$wp_customize->add_setting( 'a5t_setting_cookies', array(
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'a5t_setting_cookies', array(
	  'type' => 'checkbox',
	  'section' => 'a5t_framework_general_settings', // Add a default or your own section
	  'label' => __( 'Cookies' ),
	));
	// Disable Comments
	$wp_customize->add_setting( 'a5t_setting_comments', array(
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'a5t_setting_comments', array(
	  'type' => 'checkbox',
	  'section' => 'a5t_framework_general_settings', // Add a default or your own section
	  'label' => __( 'Disable comments' ),
	));
	// Bootstrap
	$wp_customize->add_setting( 'a5t_setting_bootstrap', array(
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'a5t_setting_bootstrap', array(
	  'type' => 'checkbox',
	  'section' => 'a5t_framework_general_settings', // Add a default or your own section
	  'label' => __( 'Activate Bootstrap 4' ),
	));
    // Container / Fluid
    $wp_customize->add_setting( 'a5t_setting_main_container', array(
        'capability' => 'edit_theme_options',
    ) );
    $wp_customize->add_control( 'a5t_setting_main_container', array(
        'type' => 'select',
        'section' => 'a5t_framework_general_settings', // Add a default or your own section
        'label' => __( 'Main Container' ),
        'description' => __( 'Scegli la tipologia di container' ),
        'choices' => array(
            'container' => __( 'Section Boxed ( container )' ),
            'container-fluid' => __( 'Section Full Width ( container-fluid )' ),
        ),
    ) );
// TRACKING SETTINGS    
$wp_customize->add_section('a5t_framework_tracking_settings', array(
	'title'    => __('Tracking settings', 'a5t_framework'),
	'priority' => 120,
));

	// ANALYTICS
	$wp_customize->add_setting( 'a5t_setting_analytics', array(
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'a5t_setting_analytics', array(
	  'type' => 'text',
	  'section' => 'a5t_framework_tracking_settings', // Add a default or your own section
	  'label' => __( 'Google Analytics UID' ),
	));

    // GOOGLE TAG
    $wp_customize->add_setting( 'a5t_setting_gtag', array(
        'capability' => 'edit_theme_options',
    ) );
    $wp_customize->add_control( 'a5t_setting_gtag', array(
        'type' => 'text',
        'section' => 'a5t_framework_tracking_settings', // Add a default or your own section
        'label' => __( 'Google Tag ID' ),
    ));

    // HOTJAR
	$wp_customize->add_setting( 'a5t_setting_hotjar', array(
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'a5t_setting_hotjar', array(
	  'type' => 'text',
	  'section' => 'a5t_framework_tracking_settings', // Add a default or your own section
	  'label' => __( 'Hotjar ID' ),
	));


// COOKIES SETTINGS    
$wp_customize->add_section('a5t_framework_cookies_settings', array(
	'title'    => __('Cookies settings', 'a5t_framework'),
	'priority' => 120,
));	
	
	// Privacy Message
	$wp_customize->add_setting( 'a5t_setting_pri_msg', array(
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'a5t_setting_pri_msg', array(
	  'type' => 'textarea',
	  'section' => 'a5t_framework_cookies_settings', // Add a default or your own section
	  'label' => __( 'Privacy Policy message' ),
	));

	// Privacy close text
	$wp_customize->add_setting( 'a5t_setting_pri_close', array(
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'a5t_setting_pri_close', array(
	  'type' => 'text',
	  'section' => 'a5t_framework_cookies_settings', // Add a default or your own section
	  'label' => __( 'Close button message' ),
	));

	// Privacy title
	$wp_customize->add_setting( 'a5t_setting_pri_title', array(
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'a5t_setting_pri_title', array(
	  'type' => 'text',
	  'section' => 'a5t_framework_cookies_settings', // Add a default or your own section
	  'label' => __( 'Privacy Policy title' ),
	));

	// Privacy url
	$wp_customize->add_setting( 'a5t_setting_pri_url', array(
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'a5t_setting_pri_url', array(
	  'type' => 'dropdown-pages',
	  'section' => 'a5t_framework_cookies_settings', // Add a default or your own section
	  'label' => __( 'Privacy Policy URL' ),
	));

// ADVANCED SETTINGS    
$wp_customize->add_section('a5t_framework_advanced_settings', array(
	'title'    => __('Advanced settings', 'a5t_framework'),
	'priority' => 120,
));	

		// Privacy Message
	$wp_customize->add_setting( 'a5t_adv_twig', array(
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'a5t_adv_twig', array(
	  'type' => 'checkbox',
	  'section' => 'a5t_framework_advanced_settings', // Add a default or your own section
	  'label' => __( 'Twig' ),
	));



	$wp_customize->add_setting( 'a5t_adv_adminbar', array(
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( 'a5t_adv_adminbar', array(
	  'type' => 'checkbox',
	  'section' => 'a5t_framework_advanced_settings', // Add a default or your own section
	  'label' => __( 'Hide Admin Bar' ),
	));



// COOKIES SETTINGS
    $wp_customize->add_section('a5t_framework_theme_fileds', array(
        'title'    => __('Theme Fields', 'a5t_framework'),
        'priority' => 120,
    ));
    // Intestazione Principale
    $wp_customize->add_setting( 'a5t_setting_intestazione', array(
        'capability' => 'edit_theme_options',
    ) );
    $wp_customize->add_control( 'a5t_setting_intestazione', array(
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds', // Add a default or your own section
        'label' => __( 'Intestazione' ),
    ));
    // P. IVA Principale
    $wp_customize->add_setting( 'a5t_setting_piva', array(
        'capability' => 'edit_theme_options',
    ) );
    $wp_customize->add_control( 'a5t_setting_piva', array(
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds', // Add a default or your own section
        'label' => __( 'P. IVA' ),
    ));
    // Indirizzo Principale
    $wp_customize->add_setting( 'a5t_setting_indirizzo', array(
        'capability' => 'edit_theme_options',
    ) );
    $wp_customize->add_control( 'a5t_setting_indirizzo', array(
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds', // Add a default or your own section
        'label' => __( 'Indirizzo' ),
    ));
    // Telefono Pricipale
    $wp_customize->add_setting( 'a5t_setting_telefono', array(
        'capability' => 'edit_theme_options',
    ) );
    $wp_customize->add_control( 'a5t_setting_telefono', array(
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds', // Add a default or your own section
        'label' => __( 'Telefono' ),
    ));
    // Mail Principale
    $wp_customize->add_setting( 'a5t_setting_mail', array(
        'capability' => 'edit_theme_options',
    ) );
    $wp_customize->add_control( 'a5t_setting_mail', array(
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds', // Add a default or your own section
        'label' => __( 'Mail' ),
    ));







}
add_action( 'customize_register', 'a5t_customize_register' );