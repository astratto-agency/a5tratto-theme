<?php
/*
Template Name: Template Home 
*/
?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_part('templates/content-home'); ?>
<?php endwhile; ?>
