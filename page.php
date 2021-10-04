<?php if (!defined('ABSPATH')) exit; ?>
<?php while (have_posts()) : the_post(); ?>

<?php endwhile; ?>
<?php
global $post;
// echo get_template_directory_uri().'/twig/page-'. $post->post_name.'.php';

if (file_exists(get_template_directory_uri() . '/twig/page-' . $post->post_name . '.php')) {
    echo 'temaplate slug page';
    get_part('templates/page-' . $post->post_name);
} else {
    echo 'temaplate page';
    get_part('templates/page');
}
?>