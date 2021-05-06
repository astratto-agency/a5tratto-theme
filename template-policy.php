<!-- A_SETTINGS Impostazione pagina Template Page Policy -->
<?php
/*
Template Name: Template Page Policy
*/
?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_part('templates/page-policy'); ?>
<?php endwhile; ?>
