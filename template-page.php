<?php
/*
Template Name: Template Content Page
*/
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_part('templates/content-page'); ?>
<?php endwhile; ?>
