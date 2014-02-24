<?php
get_template_part('header-html');

get_template_part('header');
?>

<?php if (have_posts()): ?>
	<?php while (have_posts()): the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('primary h-entry main reading'); ?>>
			<h1 class="entry-title p-name"><?php the_title(); ?></h1>

			<section class="entry-content e-content">
				<?php the_content(); ?>

				<?php // comments_template('', true); // remove if you don't want comments ?>
			</section>
		</article>
	<?php endwhile; // have_posts() ?>
<?php else: ?>
	<h1>Nothing to display.</h1>
<?php endif; // have_posts() ?>

<?php get_sidebar(); ?>

<?php
get_template_part('footer');

get_template_part('footer-html');
?>