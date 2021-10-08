<!-- A_SETTINGS Impostazione pagina Template Page -->
<?php
/*
Template Name: Template Page
*/
?>
<?php while (have_posts()) : the_post(); ?>
    <?php
    global $post;
    // echo get_template_directory_uri().'/twig/page-'. $post->post_name.'.php';

    if (file_exists(get_template_directory_uri() . '/twig/page-' . $post->post_name . '.php')) {
        // echo 'temaplate slug page';
        get_part('templates/page-' . $post->post_name);
    } else {
        // echo 'temaplate page';
        get_part('templates/page');
    }
    ?>
<?php endwhile; ?>
