<?php
get_template_part('header-html');

get_template_part('header');
?>

<section class="primary">
	<?php if (have_posts()): ?>
		<?php while (have_posts()): the_post(); ?>
			<?php get_template_part('content'); ?>

			<nav class="page-nav">
				<ul class="single-page-nav">
					<li class="page-next"><?php next_post_link('%link', 'Next Post: %title'); ?></li>

					<li class="page-previous"><?php previous_post_link('%link','Previous Post: %title'); ?></li>
				</ul>
			</nav><!-- page-nav -->
		<?php endwhile; // have_posts() ?>
	<?php else: ?>
		<h1>Sorry, nothing to display.</h1>
	<?php endif; // have_posts() ?>
</section><!-- primary -->

<?php get_sidebar(); ?>

<?php
get_template_part('footer');

get_template_part('footer-html');
?>