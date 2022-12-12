<!-- A_SETTINGS Impostazione pagina Template Woocommerce -->
<?php
/*
Template Name: Template Woocommerce
*/
?>
<?php echo'Template Name: Template Woocommerce';  ?>
<?php while (have_posts()) : the_post(); ?>
    <?php get_part('templates/woocommerce'); ?>
<?php endwhile; ?>