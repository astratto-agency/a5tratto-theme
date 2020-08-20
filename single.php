<?php while (have_posts()) : the_post(); ?>
	<?php get_part('templates/single'); ?>
<?php endwhile; ?>