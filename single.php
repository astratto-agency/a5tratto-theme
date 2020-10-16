<!-- A_SETTINGS Impostazione pagina Template Single -->
<?php
/*
Template Name: Template Single
*/
?>
<?php while (have_posts()) : the_post(); ?>
	<?php get_part('templates/single'); ?>
<?php endwhile; ?>