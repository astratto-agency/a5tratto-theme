<?php
/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Aggiorno il CSS nell’area amministratore
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

function admin_style()
{
    wp_enqueue_style('admin-styles', get_template_directory_uri() . '/assets/wp-admin.css');
    /*    wp_enqueue_script( 'admin-script', get_template_directory_uri().'/assets/wp-admin.js', array( 'jquery' ), '1.2.1' );*/
}

// Esegue la funzione admin_style() all’azione admin_enqueue_scripts di WP
add_action('admin_enqueue_scripts', 'admin_style');
/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Customizer admin menu bar
                    https://heera.it/customize-admin-menu-bar-in-wordpress
                    https://webriti.com/customizing-wordpress-admin-bar/
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

function add_my_own_logo($wp_admin_bar)
{
    $args = array(
        'id' => 'my-logo',
        'meta' => array('class' => 'my-logo', 'title' => 'logo')
    );
    $wp_admin_bar->add_node($args);
}

add_action('admin_bar_menu', 'add_my_own_logo', 1);


add_action('admin_menu', 'linked_url');
function linked_url()
{
    add_menu_page('linked_url', 'ASTRATTO', 'read', 'astratto_site', '', 'dashicons-format-chat', 1);
}

add_action('admin_menu', 'linkedurl_function');
function linkedurl_function()
{
    global $menu;
    $menu[1][2] = "https://www.astratto.agency";
}

function login_background_image()
{
    echo '<style type="text/css">
        body.login{ background: #0000E5!important; }
        .login #backtoblog a, 
        .login #nav a { color:#ffffff; }
</style>';
}

add_action('login_head', 'login_background_image');


function login_logo()
{ ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo-astratto-v2-w.png);
            background-size: 313px;
            height: 26px;
            width: 100%;
        }
    </style>
<?php }

add_action('login_enqueue_scripts', 'login_logo');


function login_logo_url_title()
{
    return 'https://www.astratto.agency';
}

add_filter('login_headerurl', 'login_logo_url_title');
