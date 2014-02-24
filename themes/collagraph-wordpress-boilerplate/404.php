<?php
get_template_part('header-html');

get_template_part('header');
?>

<section class="primary reading">
	<h1>Page not found</h1>

	<p>Sorry, we couldn't find what you were looking for.</p>

	<p><strong><a href="<?php echo home_url(); ?>" title="Return to the home page">Return to the home page.</a></strong></p>
</section><!-- primary reading -->

<?php get_sidebar(); ?>

<?php
get_template_part('footer');

get_template_part('footer-html');
?>