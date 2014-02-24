<?php global $picturefill; ?>

<?php
    // regular images
    $l_image = $picturefill['sizes']['l'];
    $m_image = $picturefill['sizes']['m'];
    $s_image = $picturefill['sizes']['s'];

    // representative images of a specific aspect ratio
    /*
    // check heights against pre-defined heights in functions.php
    if ($picturefill['sizes']['rep-l-height'] == 900):
        $l_image = $picturefill['sizes']['rep-l'];
        $m_image = $picturefill['sizes']['rep-m'];
        $s_image = $picturefill['sizes']['rep-s'];
    elseif ($picturefill['sizes']['rep-m-height'] == 600):
        $l_image = $picturefill['sizes']['rep-m'];
        $m_image = $picturefill['sizes']['rep-m'];
        $s_image = $picturefill['sizes']['rep-s'];
    else:
        $l_image = $picturefill['sizes']['rep-s'];
        $m_image = $picturefill['sizes']['rep-s'];
        $s_image = $picturefill['sizes']['rep-s'];
    endif;
    */
?>

<span data-picture data-alt="<?php the_title(); ?>">
    <!-- default image -->
    <span data-src="<?php echo $s_image; ?>"></span>

    <!-- media query -->
    <span data-src="<?php echo $s_image; ?>" data-media="(min-width: 1280px)"></span>

    <!-- retina media query -->
    <span data-src="<?php echo $s_image; ?>" data-media="(min-width: 800px) and (-webkit-min-device-pixel-ratio:2), (min-width: 800px) and (min--moz-device-pixel-ratio:2), (min-width: 800px) and (-o-min-device-pixel-ratio:2/1), (min-width: 800px) and (min-device-pixel-ratio:2), (min-width: 800px) and (min-resolution:192dpi), (min-width: 800px) and (min-resolution:2dppx)"></span>

    <!-- fallback for non-js browsers -->
    <noscript><img src="<?php echo $s_image; ?>" alt="<?php the_title(); ?>"></noscript>
</span>