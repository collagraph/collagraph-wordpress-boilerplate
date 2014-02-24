<article id="post-<?php the_ID(); ?>" <?php post_class('h-entry main reading'); ?>>
	<header>
        <?php
        global $picturefill;

        $picturefill = get_field('collagraph_representative_image');
        ?>

        <?php if ($picturefill && !is_search()  && !is_archive()): ?>
            <figure class="photo">
                <?php if (!is_single() && !is_page()): ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php endif; ?>
                    <?php get_template_part('picturefill'); ?>
                <?php if (!is_single() && !is_page()): ?>
                    </a>
                <?php endif; ?>
            </figure>
        <?php endif; // $picturefill && !is_search()  && !is_archive() ?>

		<?php if (is_archive() || is_front_page() || is_search()): ?>
			<h2 class="p-name">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="u-url"><?php the_title(); ?></a>
			</h2>
		<?php elseif (is_single() || is_page()): ?>
			<h1 class="p-name">
				<?php the_title(); ?>
			</h1>
		<?php else: ?>
			<h1 class="p-name">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="u-url"><?php the_title(); ?></a>
			</h1>
		<?php endif; // is_archive() || is_front_page() || is_search() ?>

		<time class="dt-published post-intro-meta" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('j F Y'); ?></time>
	</header>

	<?php if (is_archive() || is_front_page() || is_search() || is_home()): ?>
    	<section class="p-summary">
            <?php the_excerpt(); ?>
    	</section>
    <?php else : ?>
    	<section class="e-content">
            <?php the_content(); ?>
    	</section>
    <?php endif; // is_archive() || is_front_page() || is_search() || is_home() ?>

    <?php if (is_single()): ?>
        <?php get_template_part('share-links'); ?>
    <?php endif; // is_single() ?>

	<?php if (is_archive() || is_single() || is_search()): ?>
        <footer class="post-meta">
    		<?php $post_category = get_the_category(); ?>

    		<?php if ($post_category[0]->slug != "uncategorized" && has_category()): ?>
            	<div class="post-categories">
        			<h2>Categories:</h2>

                    <?php the_category(); ?>
        		</div>
    		<?php endif; // $post_category[0]->slug != "uncategorized" && has_category() ?>

    		<?php if (has_tag()): ?>
        		<div class="post-tags">
        			<h2>Tags:</h2>

        			<?php the_tags('<ul><li class="p-category">', '</li><li class="p-category">', '</li></ul>'); ?>
        		</div>
    		<?php endif; // has_tag() ?>
    	</footer><!-- post-meta -->
    <?php endif; // is_archive() || is_single() || is_search() ?>

	<?php if (is_single() && comments_open()): ?>
		<?php comments_template(); ?>
	<?php endif; // is_single() && comments_open() ?>
</article><!-- h-entry main reading -->