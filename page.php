<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php while (have_posts()) : the_post(); ?>

<?php endwhile; ?>
 <?php get_part('templates/page'); ?>