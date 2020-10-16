<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'a5t'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_part('templates/content', get_post_format()); ?>
<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'a5t')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'a5t')); ?></li>
    </ul>
  </nav>
<?php endif; ?>

