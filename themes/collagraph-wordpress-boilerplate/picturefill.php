<?php global $picturefill; ?>

<?php
    // regular images
    $l = $picturefill['sizes']['l'];
    $m = $picturefill['sizes']['m'];
    $s = $picturefill['sizes']['s'];

    // representative images of a specific aspect ratio
    /*
    // check heights against pre-defined heights in functions.php
    if ($picturefill['sizes']['representative-l-height'] == 900):
        $l = $picturefill['sizes']['representative-l'];
        $m = $picturefill['sizes']['representative-m'];
        $s = $picturefill['sizes']['representative-s'];
    elseif ($picturefill['sizes']['representative-m-height'] == 600):
        $l = $picturefill['sizes']['representative-m'];
        $m = $picturefill['sizes']['representative-m'];
        $s = $picturefill['sizes']['representative-s'];
    else:
        $l = $picturefill['sizes']['representative-s'];
        $m = $picturefill['sizes']['representative-s'];
        $s = $picturefill['sizes']['representative-s'];
    endif;
    */
?>

<span data-picture data-alt="<?php the_title(); ?>">
    <!-- default image -->
    <span data-src="<?php echo $s; ?>"></span>

    <!-- media query -->
    <span data-src="<?php echo $s; ?>" data-media="(min-width: 1280px)"></span>

    <!-- retina media query -->
    <span data-src="<?php echo $s; ?>" data-media="(min-width: 800px) and (-webkit-min-device-pixel-ratio:2), (min-width: 800px) and (min--moz-device-pixel-ratio:2), (min-width: 800px) and (-o-min-device-pixel-ratio:2/1), (min-width: 800px) and (min-device-pixel-ratio:2), (min-width: 800px) and (min-resolution:192dpi), (min-width: 800px) and (min-resolution:2dppx)"></span>

    <!-- fallback for non-js browsers -->
    <noscript><img src="<?php echo $s; ?>" alt="<?php the_title(); ?>"></noscript>
</span>