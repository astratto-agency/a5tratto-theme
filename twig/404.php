<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render( '404.twig', $context );
