<?php

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS A5T-Framework CORE
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::::::::::     * A_SETTINGS A5T-Framework includes
                    The $a5t_includes array determines the code library included in your theme.
                    Add or remove files to the array as needed. Supports child theme overrides.
                    Please note that missing files will produce a fatal error.
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

$a5t_includes = array(
    'core/plugins.php',                           // Plugins
    'core/init.php',                              // Initial theme setup and constants
    'core/utils.php',                             // Utilities
    'core/wrapper.php',                           // Theme wrapper class
    'core/config.php',                            // Configuration
    'core/activation.php',                        // Theme activation
    'core/nav.php',                               // Custom nav modifications
    'core/scripts.php',                           // Scripts and stylesheets
    'core/write.php',                             // Writing something on files
    'core/extras.php',                            // Custom functions
    'core/customizer.php',                        // Customize your layout
    'core/security.php',                          // Some security utils
    'core/admin-customizer.php',                  // Admin customize
);

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Setting Comment
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

if (get_theme_mod('a5t_setting_comments')) {
    $a5t_includes[] = 'core/no-comments.php';
}

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Autoload
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

if (file_exists('vendor/autoload.php')) {
    $a5t_includes[] = 'vendor/autoload.php';
}


/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Speed test
                    https://wordpress.stackexchange.com/questions/155072/get-option-vs-get-theme-mod-why-is-one-slower
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

/*add_action('wp', 'My_Test');
function My_Test()
{
    var_dump(microtime(true));
    for ($i = 1; $i < 100; $i++) {
        get_option('blogdescription');
    }
    var_dump(microtime(true));
    for ($i = 1; $i < 100; $i++) {
        get_theme_mod('blogdescription');
    }
    var_dump(microtime(true));
    exit;
}*/

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS ?????????
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

foreach ($a5t_includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'a5t'), $file), E_USER_ERROR);
    }

    require_once $filepath;
}
unset($file, $filepath);

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS CONTEXT
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
add_filter('timber/context', 'add_to_context');

function add_to_context($context)
{

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Site
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $context['home'] = site_url();

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Logo
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $custom_logo_id = get_theme_mod('custom_logo');
    $custom_logo_url = wp_get_attachment_image_src($custom_logo_id, 'full');
    $context['custom_logo_url'] = $custom_logo_url;

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Menu
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $context['primary_menu'] = new Timber\Menu('Primary Navigation');
    // $context['footer_menu'] = new Timber\Menu('Footer Navigation 1');

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Theme Dir
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $context['tema_url'] = get_template_directory_uri();
    $context['urltema'] = get_template_directory_uri();

    $context['template_directory_uri'] = get_template_directory_uri();
    $context['stylesheet_directory_uri'] = get_stylesheet_directory_uri();

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Post
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/


    $context['post_title'] = get_the_title();

    $context['title'] = get_the_title();
    $context['the_title'] = get_the_title();

    if (is_page() || is_single()) {

        $context['post_class'] = get_post_class()[0];

        $context['content'] = get_the_content();
        $context['the_content'] = get_the_content();

        $context['urlpage'] = get_page_link();
        $context['page_link'] = get_page_link();
    }

    $context['imgpage'] = get_the_post_thumbnail_url();
    $context['post_image'] = get_the_post_thumbnail_url();

    $context['intro'] = get_the_excerpt();
    $context['the_excerpt'] = get_the_excerpt();


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Placeholder
    ::::::::::::::      https://source.unsplash.com/

    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $context['placeholder'] = 'https://source.unsplash.com/';

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Time & Data
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $context['time'] = get_the_time('c');
    $context['date'] = get_the_date();

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS User
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $context['author_url'] = get_author_posts_url(get_the_author_meta('ID'));
    $context['author'] = get_the_author();

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS User WooCommerce Memberships
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

        $context['memberships'] = $memberships = wc_memberships_get_user_active_memberships(get_current_user_id());
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Footer
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $context['pre_footer'] = Timber::get_widgets('pre_footer');
    $context['footer_col_1'] = Timber::get_widgets('footer_col_1');
    $context['footer_col_2'] = Timber::get_widgets('footer_col_2');
    $context['footer_col_3'] = Timber::get_widgets('footer_col_3');
    $context['footer_col_4'] = Timber::get_widgets('footer_col_4');
    $context['footer_bottom'] = Timber::get_widgets('footer_bottom');

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Sidebar
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $context['sidebar_primary'] = Timber::get_widgets('sidebar_primary');

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Slide
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $context['slider'] = get_field('slider');


    $context['main_container'] = get_theme_mod("a5t_setting_main_container");

    $context['a5t_setting_gototop'] = get_theme_mod("a5t_setting_gototop");
    $context['a5t_setting_butter'] = get_theme_mod("a5t_setting_butter");
    $context['a5t_setting_magic_mouse'] = get_theme_mod("a5t_setting_magic_mouse");

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Google Fonts
                        // Attiva Google Fonts per ogni riga fonts.google.com
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    /*    $a5t_setting_google_fonts = get_theme_mod("a5t_setting_google_fonts");
        $google_fonts = explode("\n", $a5t_setting_google_fonts);
        $google_fonts = array_filter($google_fonts, 'trim'); // remove any extra \r characters left behind



        Sgoogle_fonts[] rows = textArea.getText().split("\n");
        $a5t_setting_google_fonts
        $context['a5t_setting_google_fonts'] =*/


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Setting
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    // intestazioni
    $context['setting_intestazione'] = get_theme_mod('a5t_setting_intestazione');
    $context['setting_piva'] = get_theme_mod('a5t_setting_piva');
    $context['setting_rea'] = get_theme_mod('a5t_setting_rea');
    $context['setting_cap_soc'] = get_theme_mod('a5t_setting_cap_soc');
    // indirizzo
    $context['setting_indirizzo_1'] = get_theme_mod('a5t_setting_indirizzo_1');
    $context['setting_indirizzo_2'] = get_theme_mod('a5t_setting_indirizzo_2');
    $context['setting_indirizzo_3'] = get_theme_mod('a5t_setting_indirizzo_3');
    // tel
    $context['setting_tel_1'] = get_theme_mod('a5t_setting_tel_1');
    $context['setting_tel_2'] = get_theme_mod('a5t_setting_tel_2');
    $context['setting_tel_3'] = get_theme_mod('a5t_setting_tel_3');
    $context['setting_fax'] = get_theme_mod('a5t_setting_fax');
    // mail
    $context['setting_mail_1'] = get_theme_mod('a5t_setting_mail_1');
    $context['setting_mail_2'] = get_theme_mod('a5t_setting_mail_2');
    $context['setting_mail_3'] = get_theme_mod('a5t_setting_mail_3');
    // social
    $context['setting_facebook'] = get_theme_mod('a5t_setting_facebook');
    $context['setting_linkedin'] = get_theme_mod('a5t_setting_linkedin');
    $context['setting_instagram'] = get_theme_mod('a5t_setting_instagram');


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS If Plugin is active
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    /*if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        echo 'WooCommerce is active.';
    } else {
        echo 'WooCommerce is not Active.';
    }*/


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS WooCommerce
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

        if (WC()->cart->get_cart_contents_count() == 0) {
            $context['carrello'] = '';
        } else {
            $context['carrello'] = '1';
        }

    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Google Maps
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $gmaps_api_key = get_theme_mod('a5t_setting_maps');
    $context['google_maps_api'] = 'https://maps.googleapis.com/maps/api/js?key=' . $gmaps_api_key . '&amp;sensor=false&callback=initMap';


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Yoast
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) || is_plugin_active( 'wordpress-seo-premium/wp-seo-premium.php' ) ) {

        $id = get_the_ID();

        $post = get_post($id, ARRAY_A);
        $yoast_title = get_post_meta($id, '_yoast_wpseo_title', true);
        $yoast_desc = get_post_meta($id, '_yoast_wpseo_metadesc', true);

        $metatitle_val = wpseo_replace_vars($yoast_title, $post);
        $metatitle_val = apply_filters('wpseo_title', $metatitle_val);

        $metadesc_val = wpseo_replace_vars($yoast_desc, $post);
        $metadesc_val = apply_filters('wpseo_metadesc', $metadesc_val);

        $context['metatitle'] = $metatitle_val;

        $context['metadesc'] = $metadesc_val;

        if (function_exists('yoast_breadcrumb')) {
            $context['breadcrumbs'] = yoast_breadcrumb('<div id="breadcrumbs" class="breadcrumb center mb-50">', '</div>', false);
        }

    }


    /*
   $custom_logo_id = get_theme_mod( 'custom_logo' );
   $context['logo'] = wp_get_attachment_image_src( $custom_logo_id , 'full' );
   */

// $context['menu_pricipale'] = new Timber\Menu( 'menu-principale' );
// $context['menuu'] = new \Timber\Menu( 'primary-menu' );
// $context['menu'] = new \Timber\Menu( 'primary-menu' );
// $context['menu_servizi'] = new \Timber\Menu( 'Servizi' );
// $context['menu'] = new \Timber\Menu( 'primary-menu' );
// $context['menu_servizi'] = new \Timber\Menu( 'Servizi' );


    return $context;
}

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS SEO Yoast priprity low
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

function move_yoast_below_acf()
{
    return 'low';
}

add_filter('wpseo_metabox_prio', 'move_yoast_below_acf');

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Allow excertp in page
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

add_post_type_support('page', 'excerpt');


// Method 1: Filter.
function my_acf_google_map_api($api)
{
    $api['key'] = get_theme_mod('a5t_setting_maps');
    return $api;
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

// Method 2: Setting.
function my_acf_init()
{
    acf_update_setting('google_api_key', get_theme_mod('a5t_setting_maps'));
}

add_action('acf/init', 'my_acf_init');


/**
 * Wordpress has a known bug with the posts_per_page value and overriding it using
 * query_posts. The result is that although the number of allowed posts_per_page
 * is abided by on the first page, subsequent pages give a 404 error and act as if
 * there are no more custom post type posts to show and thus gives a 404 error.
 *
 * This fix is a nicer alternative to setting the blog pages show at most value in the
 * WP Admin reading options screen to a low value like 1.
 *
 *
 *
 */
/*function custom_posts_per_page($query)
{

    if ($query->is_archive('batterie')) {
        set_query_var('posts_per_page', 1);
    }
}

add_action('pre_get_posts', 'custom_posts_per_page');


if (!is_admin()) {
    add_action('pre_get_posts', 'set_per_page');
}
function set_per_page($query)
{
    global $wp_the_query;
    if ($query->is_post_type_archive('portfolio') && ($query === $wp_the_query)) {
        $query->set('posts_per_page', 1);
    }
    return $query;
}*/


/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Create post form CF7
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

/*function save_posted_data($posted_data)
{
    $form_id = WPCF7_ContactForm::get_current();
    if ($form_id->id == 'ID_FORM') {
        $args = array(
            'post_type' => 'richieste',
            'post_taxonomy' => 'in-attesa',
            'post_title' => $posted_data['referentenome'],
            'post_content' => $posted_data['note'],
            'post_status' => 'private',
            'post_author' => $posted_data['userid'],
        );
        $post_id = wp_insert_post($args);
        if (!is_wp_error($post_id)) {
            $my_post = array(
                'ID' => $post_id,
                'post_slug' => $post_id,
                'post_title' => $posted_data['nomeviaggio'] . " - " . $posted_data['idviaggio'] . " - Rif. " . $posted_data['primoospitenome'] . " " . $posted_data['primoospitecognome']
            );
            wp_update_post($my_post);
            wp_set_object_terms($post_id, 'in-attesa', 'stati');
            wp_set_post_tags($post_id, $posted_data['concessionariatag']);
            if (isset($posted_data['concessionaria'])) {
                update_post_meta($post_id, 'concessionaria_nome', $posted_data['concessionaria']);
            }
            return $posted_data;
        }
    }
}

add_filter('wpcf7_posted_data', 'save_posted_data');*/


//Remove the default search var and add a custom one
add_filter('init', function () {
    global $wp;

    $wp->add_query_var('search_query');
    $wp->remove_query_var('s');
});

add_filter('request', function ($request) {
    if (isset($_REQUEST['search_query'])) {
        $request['s'] = $_REQUEST['search_query'];
    }

    return $request;
});


/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS WOOOCOMMERCE
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/


if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Conditional function detecting if the current user has an active subscription
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    function has_active_subscription($user_id = null)
    {
        // if the user_id is not set in function argument we get the current user ID
        if (null == $user_id)
            $user_id = get_current_user_id();

        // Get all active subscrptions for a user ID
        $active_subscriptions = get_posts(array(
            'numberposts' => -1,
            'meta_key' => '_customer_user',
            'meta_value' => $user_id,
            'post_type' => 'shop_subscription', // Subscription post type
            'post_status' => 'wcm-active', // Active subscription
        ));
        // if user has an active subscription
        if (!empty($active_subscriptions)) return true;
        else return false;
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Conditionally checking and adding your subscription when a product is added to cart
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    add_action('woocommerce_add_to_cart', 'add_subscription_to_cart', 10, 6);
    function add_subscription_to_cart($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data)
    {

        // Here define your subscription product
        $subscription_id = '559';
        $found = false;

        if (is_admin() || has_active_subscription() || $product_id == $subscription_id) return;  // exit

        // Checking if subscription is already in cart
        foreach (WC()->cart->get_cart() as $cart_item) {
            if ($cart_item['product_id'] == $subscription_id) {
                $found = true;
                break;
            }
        }
        // if subscription is not found, we add it
        if (!$found)
            WC()->cart->add_to_cart($subscription_id);
    }


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Add custom checkout field: woocommerce_review_order_before_submit
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    add_action('woocommerce_review_order_before_submit', 'my_custom_checkout_field_condizioni_generali');

    function my_custom_checkout_field_condizioni_generali()
    {
        echo '<div id="my_custom_checkout_field_condizioni_generali" class="col-12">';

        woocommerce_form_field('my_field_name_condizioni_generali', array(
            'type' => 'checkbox',
            'class' => array('input-checkbox'),
            'label' => __('Accetto termi e condizioni generali ( sendsrl.it/tec )'),
            'required' => true,
        ), WC()->checkout->get_value('my_field_name_condizioni_generali'));
        echo '</div> ';
    }

    add_action('woocommerce_review_order_before_submit', 'my_custom_checkout_field_privacy_policy');
    function my_custom_checkout_field_privacy_policy()
    {
        echo '<div id="my_custom_checkout_field_privacy_policy" class="col-12">';

        woocommerce_form_field('my_field_name_privacy_policy', array(
            'type' => 'checkbox',
            'class' => array('input-checkbox'),
            'label' => __('Dichiaro di aver preso visione della Privacy Policy ( sendsrl.it/tec )'),
            'required' => true,
        ), WC()->checkout->get_value('my_field_name_privacy_policy'));
        echo '</div> ';
    }

    add_action('woocommerce_review_order_before_submit', 'my_custom_checkout_field_informazioni_commerciali');
    function my_custom_checkout_field_informazioni_commerciali()
    {
        echo '<div id="my_custom_checkout_field_informazioni_commerciali" class="col-12">';

        woocommerce_form_field('my_field_name_informazioni_commerciali', array(
            'type' => 'checkbox',
            'class' => array('input-checkbox'),
            'label' => __('Acconsento a ricevere informazioni commerciali'),
        ), WC()->checkout->get_value('my_field_name_informazioni_commerciali'));
        echo '</div> ';
    }

    add_action('woocommerce_review_order_before_submit', 'my_custom_checkout_field_dati_terzi');
    function my_custom_checkout_field_dati_terzi()
    {
        echo '<div id="my_custom_checkout_field_dati_terzi" class="col-12">';

        woocommerce_form_field('my_field_name_dati_terzi', array(
            'type' => 'checkbox',
            'class' => array('input-checkbox'),
            'label' => __('Acconsento il trasferiemnto di dati a terzi'),
        ), WC()->checkout->get_value('my_field_name_dati_terzi'));
        echo '</div>';
    }


// Save the custom checkout field in the order meta, when checkbox has been checked
    add_action('woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta', 10, 1);
    function custom_checkout_field_update_order_meta($order_id)
    {

        // if ( ! empty( $_POST['my_field_name'] ) )
        // update_post_meta( $order_id, 'my_field_name', $_POST['my_field_name'] );
        if (!empty($_POST['my_field_name_condizioni_generali']))
            update_post_meta($order_id, 'my_field_name_condizioni_generali', $_POST['my_field_name_condizioni_generali']);
        if (!empty($_POST['my_field_name_privacy_policy']))
            update_post_meta($order_id, 'my_field_name_privacy_policy', $_POST['my_field_name_privacy_policy']);
        if (!empty($_POST['my_field_name_informazioni_commerciali']))
            update_post_meta($order_id, 'my_field_name_informazioni_commerciali', $_POST['my_field_name_informazioni_commerciali']);
        if (!empty($_POST['my_field_name_dati_terzi']))
            update_post_meta($order_id, 'my_field_name_dati_terzi', $_POST['my_field_name_dati_terzi']);
    }

// Display the custom field result on the order edit page (backend) when checkbox has been checked
    add_action('woocommerce_admin_order_data_after_billing_address', 'display_custom_field_on_order_edit_pages', 10, 1);
    function display_custom_field_on_order_edit_pages($order)
    {
        $my_field_name = get_post_meta($order->get_id(), 'my_field_name', true);
        $my_field_name_condizioni_generali = get_post_meta($order->get_id(), 'my_field_name_condizioni_generali', true);
        $my_field_name_privacy_policy = get_post_meta($order->get_id(), 'my_field_name_privacy_policy', true);
        $my_field_name_informazioni_commerciali = get_post_meta($order->get_id(), 'my_field_name_informazioni_commerciali', true);
        $my_field_name_dati_terzi = get_post_meta($order->get_id(), 'my_field_name_dati_terzi', true);
        if ($my_field_name_condizioni_generali == 1)
            echo '<p><strong>Accetto termi e condizioni generali ( sendsrl.it/tec ): </strong> <span style="color:red;">Abilitiato</span></p><br>';
        if ($my_field_name_privacy_policy == 1)
            echo '<p><strong>Dichiaro di aver preso visione della Privacy Policy ( sendsrl.it/tec ): </strong> <span style="color:red;">Abilitiato</span></p><br>';
        if ($my_field_name_informazioni_commerciali == 1)
            echo '<p><strong>Acconsento a ricevere informazioni commerciali: </strong> <span style="color:red;">Abilitiato</span></p><br>';
        if ($my_field_name_dati_terzi == 1)
            echo '<p><strong>Acconsento il trasferiemnto di dati a terzi: </strong> <span style="color:red;">Abilitiato</span></p><br>';
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Inseriemnto del Prezzo Totale se disponibile nel Prodotto
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/


    function show_sku_in_cart_items($item_name, $cart_item, $cart_item_key)
    {
        // The WC_Product object
        $product = $cart_item['data'];

        // Get the  SKU
        $prezzo_totale = $product->get_meta('prezzo_totale');
        $prezzo_scontato = $product->get_meta('prezzo_scontato');

        if ($prezzo_scontato) {
            $prezzo_effettivo = $prezzo_scontato;
        } else {
            $prezzo_effettivo = $prezzo_totale;
        }
        // When SKU doesn't exist
        if (empty($prezzo_totale))
            return $item_name;

        // Add SKU before
        if (is_cart()) {
            $item_name = '<b>Acconto </b><br>' . $item_name . '<br><small class="product-prezzo_totale">' . ' ( Totale del viaggio: ' . $prezzo_effettivo . ' €)</small><br>';
        } else {
            $item_name = '<b>Acconto </b><br>' . $item_name . '<br><small class="product-prezzo_totale">' . ' ( Totale del viaggio: ' . $prezzo_effettivo . ' €)</small><br>';
        }

        return $item_name;
    }

    add_filter('woocommerce_cart_item_name', 'show_sku_in_cart_items', 99, 3);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Remove image zoom product
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    function remove_image_zoom_support()
    {
        /* remove image zoom hover */
        remove_theme_support('wc-product-gallery-zoom');
        /* remuve image zoom galley*/
        remove_theme_support('wc-product-gallery-lightbox');
    }

    add_action('wp', 'remove_image_zoom_support', 100);

    add_filter('woocommerce_single_product_image_thumbnail_html', 'wc_remove_link_on_thumbnails');

    function wc_remove_link_on_thumbnails($html)
    {
        return strip_tags($html, '<img>');
    }


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Rename product data tabs
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    add_filter('woocommerce_product_tabs', 'woo_rename_tabs', 98);
    function woo_rename_tabs($tabs)
    {

        $tabs['description']['title'] = __('More Information');        // Rename the description tab
        $tabs['additional_information']['title'] = __('Product Data');    // Rename the additional information tab

        return $tabs;

    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Utility function to get the childs array from a parent product category
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/


    function get_the_childs($product_category)
    {
        $taxonomy = 'product_cat';
        $parent = get_term_by('slug', sanitize_title($product_category), $taxonomy);
        return get_term_children($parent->term_id, $taxonomy);
    }


// Changing the add to cart button text
    add_filter('woocommerce_product_single_add_to_cart_text', 'product_cat_single_add_to_cart_button_text', 20, 1);
    function product_cat_single_add_to_cart_button_text($text)
    {
        global $product;
        if (has_term(get_the_childs('Viaggi'), 'product_cat', $product->get_id()))
            $text = __('PRENOTA ORA', 'woocommerce');
        elseif (has_term(get_the_childs('Membership'), 'product_cat', $product->get_id()))
            $text = __('ENTRA NELLA COMMUNITY', 'woocommerce');

        return $text;
    }


}


