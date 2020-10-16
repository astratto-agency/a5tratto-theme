<!-- A_SETTINGS Impostazione pagina Template Home -->
<?php
/*
Template Name: Template Home 
*/
?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_part('templates/home'); ?>
<?php endwhile; ?>
