<?php

/*-----------------------------------------------------------------------------------*/
/*  A5T-Framework core
/*-----------------------------------------------------------------------------------*/

/**
 * A5T-Framework includes
 *
 * The $a5t_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 */

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
);

if (get_theme_mod('a5t_setting_comments')) {
  $a5t_includes[] = 'core/no-comments.php';
}

if (file_exists('vendor/autoload.php')) {
  $a5t_includes[] =  'vendor/autoload.php';
}

// Aggiorno il CSS nell’area amministratore
function admin_style() {
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/wp-admin.css');
/*    wp_enqueue_script( 'admin-script', get_template_directory_uri().'/assets/wp-admin.js', array( 'jquery' ), '1.2.1' );*/
}
// Esegue la funzione admin_style() all’azione admin_enqueue_scripts di WP
add_action('admin_enqueue_scripts', 'admin_style');



function remove_wp_logo( $wp_admin_bar ){
    $wp_admin_bar->remove_node( 'wp-logo' );
}
add_action( 'admin_bar_menu', 'remove_wp_logo', 100 );


function add_my_own_logo( $wp_admin_bar ) {
    $args = array(
        'id'    => 'my-logo',
        'meta'  => array( 'class' => 'my-logo', 'title' => 'logo' )
    );
    $wp_admin_bar->add_node( $args );
}
add_action( 'admin_bar_menu', 'add_my_own_logo', 1 );



foreach ($a5t_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'a5t'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

add_filter( 'timber/context', 'add_to_context' );

function add_to_context( $context ) {
    // $context['slider'] = get_field('slider');
    $context['home']            = site_url();
    $context['menu']            = new Timber\Menu('primary-menu');
    $context['content']         = get_the_content();
    $context['title']           = get_the_title();
    $context['post_class']	    = get_post_class()[0];
    $context['time']			= get_the_time('c');
    $context['date']		    = get_the_date();
    $context['author_url']	    = get_author_posts_url(get_the_author_meta('ID'));
    $context['author']		    = get_the_author();
    $context['urltema']		    = get_template_directory_uri();
    $context['imgpage']		    = get_the_post_thumbnail_url();
    $context['urlpage']		    = get_page_link();
    $context['intro']    = get_the_excerpt();
    $context['footer_col_1']    = Timber::get_widgets('footer_col_1');
    $context['footer_col_2']    = Timber::get_widgets('footer_col_2');
    $context['footer_col_3']    = Timber::get_widgets('footer_col_3');
    $context['footer_col_4']    = Timber::get_widgets('footer_col_4');
    $context['footer_bottom']   = Timber::get_widgets('footer_bottom');
    $context['sidebar_primary']   = Timber::get_widgets('sidebar_primary');
    $context['pre_footer']   = Timber::get_widgets('pre_footer');
    $context['main_container']           = get_theme_mod("a5t_setting_main_container");
    $context['setting_intestazione']           = get_theme_mod("a5t_setting_intestazione");
    $context['setting_piva']           = get_theme_mod("a5t_setting_piva");
    $context['setting_indirizzo']           = get_theme_mod("a5t_setting_indirizzo");
    $context['setting_telefono']           = get_theme_mod("a5t_setting_telefono");
    $context['setting_mail']           = get_theme_mod("a5t_setting_mail");

    if ( function_exists( 'yoast_breadcrumb' ) ) {
        $context['breadcrumbs'] = yoast_breadcrumb('<div id="breadcrumbs" class="breadcrumb center mb-50">','</div>', false );
    }
    // $context['menu_pricipale'] = new Timber\Menu( 'menu-principale' );
    // $context['menuu'] = new \Timber\Menu( 'primary-menu' );
    // $context['menu'] = new \Timber\Menu( 'primary-menu' );
    // $context['menu_servizi'] = new \Timber\Menu( 'Servizi' );
    // $context['menu'] = new \Timber\Menu( 'primary-menu' );
    // $context['menu_servizi'] = new \Timber\Menu( 'Servizi' );
    return $context;
}

/* toglie icona wp in backend

add_filter( 'timber/context', 'add_to_context' );

if (get_theme_mod('a5t_adv_adminbar')) {
  show_admin_bar(false);
}


*/


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
/*function custom_posts_per_page( $query ) {

if ( $query->is_archive('batterie') ) {
set_query_var('posts_per_page', 1);
}
}
add_action( 'pre_get_posts', 'custom_posts_per_page' );*/




if( !is_admin() ){
    add_action( 'pre_get_posts',  'set_per_page'  );
}
function set_per_page( $query ) {
    global $wp_the_query;
    if($query->is_post_type_archive('portfolio')&&($query === $wp_the_query)){
        $query->set( 'posts_per_page', 1);
    }
    return $query;
}