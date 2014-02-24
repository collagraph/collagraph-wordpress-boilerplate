<?php
get_template_part('header-html');

get_template_part('header');
?>

<section class="primary">
	<h1>Posts Regarding <?php echo single_cat_title('', false); ?></h1>

	<?php get_template_part('loop'); ?>

	<?php get_template_part('pagination'); ?>
</section><!-- primary -->

<?php get_sidebar(); ?>

<?php
get_template_part('footer');

get_template_part('footer-html');
?>