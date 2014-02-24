<form class="search-form" method="get" action="<?php echo home_url(); ?>" role="search">
    <?php if (is_search()): ?>
        <input class="search-input" type="search" name="s" placeholder="Enter search text here" value="<?php echo get_search_query(); ?>">
    <?php else: ?>
        <input class="search-input" type="search" name="s" placeholder="Enter search text here">
    <?php endif; // is_search() ?>

    <button class="search-submit get-content" type="submit" role="button">Search</button>
</form>