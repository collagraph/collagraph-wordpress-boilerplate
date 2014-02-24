<?php
get_template_part('header-html');

get_template_part('header');
?>

<section class="primary">
    <?php
    $args = array(
        'post_type' => array('post'),
        'posts_per_page' => 1
    );

    $loop = new WP_Query($args);
    ?>

    <?php if ($loop->have_posts()): ?>
        <h1 class="index-title">Latest posts</h2>

        <?php while ($loop->have_posts()): $loop->the_post(); ?>
            <?php get_template_part('content') ?>
        <?php endwhile; // $loop->have_posts() ?>

        <?php
        $args = array(
            'post_type' => array('post'),
            'posts_per_page' => 2,
            'offset' => 1
       );

        $loop = new WP_Query($args);
        ?>

        <?php if ($loop->have_posts()): ?>
            <?php while ($loop->have_posts()): $loop->the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('h-entry post-sub-list'); ?>>
                    <h2 class="p-name">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="u-url"><?php the_title(); ?></a>
                    </h2>

                    <time class="dt-published" datetime="<?php the_time('F-j-Y'); ?>"><?php the_time('F j, Y'); ?></time>
                </article><!-- h-entry post-sub-list -->
            <?php endwhile; // $loop->have_posts() ?>

            <p><a class="to-list" href="/news" title="View more posts">View&nbsp;more&nbsp;posts&nbsp;&rarr;</a></p>
        <?php endif; // $loop->have_posts() ?>
    <?php else: ?>
        <h2>Sorry, nothing to display.</h2>
    <?php endif; // $loop->have_posts() ?>
</section><!-- primary -->

<?php get_sidebar(); ?>

<?php
get_template_part('footer');

get_template_part('footer-html');
?>