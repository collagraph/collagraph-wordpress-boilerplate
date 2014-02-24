<?php
get_template_part('header-html');

get_template_part('header');
?>

<section class="primary">
	<header>
	    <?php get_template_part('searchform'); ?>

		<h1>Search results for <em class="search-term">&ldquo;<?php echo get_search_query(); ?>&rdquo;</em></h1>
	</header>

	<?php get_template_part('loop'); ?>

	<?php get_template_part('pagination'); ?>
</section><!-- primary -->

<?php get_sidebar(); ?>

<?php
get_template_part('footer');

get_template_part('footer-html');
?>