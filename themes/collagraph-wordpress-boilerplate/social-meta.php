<?php if (is_front_page()): ?>
<meta name="description" content="<?php the_field('collagraph_search_engine_page_description'); ?>" />
    <link rel="canonical" href="<?php the_permalink(); ?>" />

    <meta property="article:publisher" content="<?php echo home_url(); ?>" />
    <meta property="article:published_time" content="<?php the_time('c'); ?>" />
    <meta property="article:modified_time" content="<?php the_modified_date('c'); ?>" />

    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?php the_permalink(); ?>" />
    <meta property="og:title" content="<?php the_title(); ?>" />
    <meta property="og:description" content="<?php the_field('collagraph_search_engine_page_description'); ?>" />
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/touch.png" />
    <meta property="og:locale" content="en_US" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php the_title(); ?>" />
    <meta name="twitter:description" content="<?php the_field('collagraph_search_engine_page_description'); ?>" />
    <meta name="twitter:site" content="@_collagraph" />
    <meta name="twitter:creator" content="@_collagraph" />
    <meta name="twitter:domain" content="<?php bloginfo('name'); ?>" />
    <meta name="twitter:image:src" content="<?php echo get_template_directory_uri(); ?>/img/touch.png" />
<?php endif; ?>