<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

if ( ! defined( 'ABSPATH' ) ) exit;
$post = Timber::query_post();
$context = Timber::get_context();

/* A_SETTINGS Assegnazione dei template  */
$templates = array( 'archive.twig', 'index.twig' );

/* A_SETTINGS Assegnazione del numero di paginazione di post per pagina */
$paginazione = 2;

/* A_SETTINGS Elaborazione dell'impaginato impostare il numero successivo qui '%/page/([0-3]+)%' in base al valore assegnato nella paginazione */
preg_match('%/page/([0-3]+)%', $_SERVER['REQUEST_URI'], $matches );
if ( get_query_var( 'paged' ) ) {
    $paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
    $paged = get_query_var( 'page' );
} else {
    $paged = isset( $matches[1] ) ? $matches[1] : 1;
}
if (!isset($paged) || !$paged) {
    $paged = 1;
}

/*  A_SETTINGS TERM QUERY elaboro query base per term */
$context['term'] = $term = new Timber\Term(get_queried_object_id());

/* A_SETTINGS Smistamento delle impaginazioni ai relativi template di pagina */
$context['title'] = 'Archive';
if ( is_day() ) {
    /* A_SETTINGS day  */
    $context['title'] = 'Archive: ' . get_the_date('D M Y'); // Update title
} else if ( is_month() ) {
    /* A_SETTINGS month  */
    $context['title'] = 'Archive: ' . get_the_date('M Y'); // Update title
} else if ( is_year() ) {
    /* A_SETTINGS year  */
    $context['title'] = 'Archive: ' . get_the_date('Y'); // Update title
} else if ( is_tag() ) {
    /* A_SETTINGS tag  */
    $context['title'] = single_tag_title('', false); // Update title
    array_unshift($templates, 'tag-' . $term->slug . '.twig', 'tag.twig'); // Update templates
} else if ( is_category() ) {
    /* A_SETTINGS category  */
    $context['title'] = single_cat_title('Title Category', false); // Update title
    array_unshift($templates, 'category-' . $term->slug . '.twig', 'categoy.twig');// Update templates
} else if ( is_tax() ) {
    /* A_SETTINGS taxonomy  */
    $context['title'] = single_cat_title('', false); // Update title
    array_unshift($templates, 'taxonomy-' . $term->slug . '.twig', 'taxonomy.twig'); // Update templates
} else if ( is_post_type_archive() ) {
    /* A_SETTINGS archive  */
    $context['title'] = post_type_archive_title('', false); // Update title
    array_unshift($templates, 'archive-' . get_post_type() . '.twig'); // Update templates
}

/*  A_SETTINGS Assegno tutte le variabili di ACF a Twig
    in caso avessi necessità puoi sostituire il valore $post con l'ID della pagina */
$fields = get_field_objects( $post );
if( $fields ):
    foreach( $fields as $field ):
        $name_id = $field['name'];
        $value_id = $field['value'];
        $context[$name_id] = $value_id;
    endforeach;
endif;

/*  A_SETTINGS QUERY elaboro query base */
$args = array(
    /* Nome del post-type */
    'post_type'             => get_post_type(),
    /* Numero post per pagina ( -1 = tutti ) */
    'posts_per_page'        => $paginazione,
    /* Elaboro paginato */
    'paged'                 => $paged,
);
/*  Assegno a wp_query gli argomenti da cercare e passo i valori a Twig */
$context['posts'] = $wp_query = new Timber\PostQuery($args);

/* Gestisco la numerazione della pagine e i corrispettivi valori trovati */
$context['found_posts' ] = $wp_query->found_posts;
$context['startpost'] = $startpost = 1;
$context['startpost'] = $startpost =  $paginazione*($paged - 1)+1;
$context['endpost']   = $endpost =  ($paginazione*$paged < $wp_query->found_posts ? $paginazione*$paged : $wp_query->found_posts);

/* Elaboro template a Twig */
Timber::render( $templates, $context );



