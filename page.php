<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php while (have_posts()) : the_post(); ?>

<?php endwhile; ?>
<?php
global $post;
get_part('templates/page', $post->post_slug); ?>