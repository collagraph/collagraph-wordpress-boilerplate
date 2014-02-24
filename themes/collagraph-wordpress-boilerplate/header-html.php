<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if IE 9]><html <?php language_attributes(); ?> class="no-js lt-ie10"><![endif]-->
<!--[if gt IE 9]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' –'; } ?> <?php bloginfo('name'); ?></title>

        <meta name="viewport" content="width=device-width,initial-scale=1.0">

<?php get_template_part('social-meta'); ?>

        <link href="http://www.google-analytics.com" rel="dns-prefetch">

        <link href="<?php echo get_template_directory_uri(); ?>/img/favicon.png" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/touch.png" rel="apple-touch-icon-precomposed">

        <script>
            /* grunticon Stylesheet Loader | https://github.com/filamentgroup/grunticon | (c) 2012 Scott Jehl, Filament Group, Inc. | MIT license. */
            window.grunticon=function(e){if(e&&3===e.length){var t=window,n=!(!t.document.createElementNS||!t.document.createElementNS("http://www.w3.org/2000/svg","svg").createSVGRect||!document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#Image","1.1")||window.opera&&-1===navigator.userAgent.indexOf("Chrome")),o=function(o){var r=t.document.createElement("link"),a=t.document.getElementsByTagName("script")[0];r.rel="stylesheet",r.href=e[o&&n?0:o?1:2],a.parentNode.insertBefore(r,a)},r=new t.Image;r.onerror=function(){o(!1)},r.onload=function(){o(1===r.width&&1===r.height)},r.src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=="}};
            grunticon(["<?php echo get_template_directory_uri(); ?>/img/icons/build/icons.data.svg.min.css", "<?php echo get_template_directory_uri(); ?>/img/icons/build/icons.data.png.min.css", "<?php echo get_template_directory_uri(); ?>/img/icons/build/icons.fallback.min.css"]);
        </script>

        <noscript>
            <link href="<?php echo get_template_directory_uri(); ?>/img/icons/build/icons.fallback.min.css" rel="stylesheet" />
        </noscript>

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>