<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'a5t'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php get_part('templates/archive', get_post_format()); ?>
