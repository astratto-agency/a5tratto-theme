<!-- A_SETTINGS Impostazione pagina Template Page -->
<?php
/*
Template Name: Template Page
*/
?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_part('templates/page'); ?>
<?php endwhile; ?>
