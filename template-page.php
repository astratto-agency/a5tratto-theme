<!-- A_SETTINGS Impostazione pagina Template Page -->
<?php
/*
Template Name: Template Page
*/
?>
<?php while (have_posts()) : the_post(); ?>
    <?php
    global $post;
    get_part('templates/page', $post->post_slug); ?>
<?php endwhile; ?>
