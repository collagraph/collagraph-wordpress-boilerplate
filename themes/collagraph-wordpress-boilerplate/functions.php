<?php

/* -------------------------------------------------------------------------------
 * actions, filters, options, shortcodes
 * -------------------------------------------------------------------------------*/

// add actions
add_action('init', 'collagraph_header_scripts'); // add custom scripts to wp_head
// add_action('wp_print_scripts', 'collagraph_conditional_scripts'); // add conditional page scripts
add_action('get_header', 'collagraph_enable_threaded_comments'); // enable threaded comments
add_action('wp_enqueue_scripts', 'collagraph_styles'); // add theme stylesheet
add_action('init', 'collagraph_register_menu'); // add collagraph menu
add_action('init', 'collagraph_create_post_type'); // add our collagraph custom post type
add_action('widgets_init', 'collagraph_remove_recent_comments_style'); // remove inline recent comment styles from wp_head()
add_action('init', 'collagraph_wp_pagination'); // add our collagraph pagination
add_action( 'admin_menu' , 'collagraph_remove_meta_boxes' ); // remove unwated meta boxes
add_action('acf/register_fields', 'collagraph_register_fields'); // register custom fields
add_action( 'login_head', 'collagraph_login_head' ); // custom image for login page (112px * 334px)
add_action('init', 'collagraph_disable_rich_editing'); // remove visual editor
add_action('admin_notices', 'collagraph_hide_update_notice_to_all_but_admin_users', 1); // hide admin alerts from non-administrator users
add_action('admin_menu', 'collagraph_remove_admin_menu_items'); // remove unwanted dashboard menu items

// remove actions
remove_action('wp_head', 'feed_links_extra', 3); // display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // display the links to the general feeds: post and comment feed
remove_action('wp_head', 'rsd_link'); // display the link to the really simple discovery service endpoint, edituri link
remove_action('wp_head', 'wlwmanifest_link'); // display the link to the windows live writer manifest file
remove_action('wp_head', 'index_rel_link'); // index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post
remove_action('wp_head', 'wp_generator'); // display the xhtml generator that is generated on the wp_head hook, wp version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// add filters
add_filter('avatar_defaults', 'collagraph_gravatar'); // custom gravatar in settings > discussion
add_filter('body_class', 'collagraph_add_slug_to_body_class'); // add slug to body class (starkers build)
add_filter('widget_text', 'collagraph_do_shortcode'); // allow shortcodes in dynamic sidebar
add_filter('widget_text', 'collagraph_shortcode_unautop'); // remove <p> tags in dynamic sidebars (better!)
add_filter('wp_nav_menu_args', 'collagraph_wp_nav_menu_args'); // remove surrounding <div> from wp navigation
add_filter('nav_menu_css_class', 'collagraph_css_attributes_filter', 100, 1); // remove navigation <li> injected classes (commented out by default)
add_filter('nav_menu_item_id', 'collagraph_css_attributes_filter', 100, 1); // remove navigation <li> injected id (commented out by default)
add_filter('page_css_class', 'collagraph_css_attributes_filter', 100, 1); // remove navigation <li> page id's (commented out by default)
add_filter('the_category', 'collagraph_remove_category_rel_from_category_list'); // remove invalid rel attribute
add_filter('the_excerpt', 'collagraph_shortcode_unautop'); // remove auto <p> tags in excerpt (manual excerpts only)
// add_filter('the_excerpt', 'collagraph_do_shortcode'); // allows shortcodes to be executed in excerpt (manual excerpts only)
add_filter('excerpt_more', 'collagraph_view_article'); // add 'view article' button instead of [...] for excerpts
add_filter('style_loader_tag', 'collagraph_style_remove'); // remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'collagraph_remove_thumbnail_dimensions', 10); // remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'collagraph_remove_thumbnail_dimensions', 10); // remove width and height dynamic attributes to post images
add_filter('next_post_link', 'collagraph_next_post_link_attributes'); // add class to next post links
add_filter('previous_post_link', 'collagraph_previous_post_link_attributes'); // add class to prev post links
add_filter('login_headerurl', 'collagraph_logo_url'); // change login image link
add_filter('login_headertitle', 'collagraph_logo_url_title'); // change login image title text
add_filter('admin_footer_text', 'collagraph_custom_footer_admin'); // custom wordpress footer
add_filter('attachment_fields_to_edit', 'collagraph_remove_media_upload_fields', 10000, 2); // remove default image sizes from the media uploader

// remove filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from the excerpt altogether

// update options
update_option('image_default_link_type', 'none'); // remove link wrappers from images

// add shortcodes
add_shortcode('collagraph_shortcode_demo', 'collagraph_shortcode_demo'); // you can place [collagraph_shortcode_demo] in pages, posts now
add_shortcode('collagraph_shortcode_demo_2', 'collagraph_shortcode_demo_2'); // place [collagraph_shortcode_demo_2] in pages, posts now

/* -------------------------------------------------------------------------------
 * scripts
 * -------------------------------------------------------------------------------*/

// load header scripts
function collagraph_header_scripts() {
    if (!is_admin()):
        wp_deregister_script('jquery'); // deregister wordpress jquery
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js', array(), '1.9.1'); // google cdn
        wp_enqueue_script('jquery'); // enque

        wp_register_script('modernizr', 'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(), '2.6.2'); // cdn
        wp_enqueue_script('modernizr'); // enque
    endif; // !is_admin()
}

// load conditional scripts
function collagraph_conditional_scripts() {
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // conditional scripts
        wp_enqueue_script('scriptname'); // enque
    }
}

// load collagraph styles
function collagraph_styles() {
    wp_register_style('collagraph', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('collagraph');
}

/* -------------------------------------------------------------------------------
 * theme support
 * -------------------------------------------------------------------------------*/

if (function_exists('add_theme_support')):
    // add menu support
    add_theme_support('menus');

    // images
    add_image_size('l', 1600, '', true);
    add_image_size('m', 1200, '', true);
    add_image_size('s', 800, '', true);

    // featured images
    add_image_size('featured-l', 1200, 900, true);
    add_image_size('featured-m', 800, 600, true);
    add_image_size('featured-s', 600, 450, true);

    // other images
    add_image_size('thumbnail', 200, '', true);

    // rss
    add_theme_support('automatic-feed-links'); // enables post and comment rss feed links to head
endif; // function_exists('add_theme_support')

add_filter('jpeg_quality', create_function('', 'return 80;'));

/* -------------------------------------------------------------------------------
 * navigation
 * -------------------------------------------------------------------------------*/

function collagraph_nav($footer_nav) {
    wp_nav_menu(
        array(
            'theme_location' => 'header-menu',
            'menu' => '',
            'container' => 'div',
            'container_class' => '{menu slug}-container',
            'container_id' => '',
            'menu_class' => 'menu',
            'menu_id' => '',
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'items_wrap' => '<ul>%3$s</ul>',
            'depth' => 0,
            'walker' => ''
        )
    );
}

// register collagraph navigation
function collagraph_register_menu() {
    register_nav_menus(
        array(// using array to specify more menus if needed
            'menu-header' => 'Header Menu', // main navigation
            'menu-sidebar' => 'Sidebar Menu', // sidebar navigation
            'menu-extra' => 'Extra Menu' // extra navigation
        )
  );
}

// remove the <div> surrounding the dynamic navigation to cleanup markup
function collagraph_wp_nav_menu_args($args = '') {
    $args['container'] = false;
    return $args;
}

// remove injected classes, ids and page ids from navigation <li> items
function collagraph_css_attributes_filter($var) {
    return is_array($var) ? array(): '';
}

/* -------------------------------------------------------------------------------
 * sidebar widgets
 * -------------------------------------------------------------------------------*/

// if dynamic sidebar exists
if (function_exists('register_sidebar')):
    register_sidebar(
        array(
            'name' => 'Custom Widget Area',
            'description' => 'Description for this widget-area ...',
            'id' => 'custom-widget-area',
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>'
      )
  );
endif; // function_exists('register_sidebar')

/* -------------------------------------------------------------------------------
 * comments
 * -------------------------------------------------------------------------------*/

// remove wp_head() injected recent comment styles
function collagraph_remove_recent_comments_style() {
    global $wp_widget_factory;

    remove_action('wp_head',
        array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style'
        )
    );
}

// remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function collagraph_remove_thumbnail_dimensions($html) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// custom gravatar in settings > discussion
function collagraph_gravatar($avatar_defaults) {
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Gravatar";
    return $avatar_defaults;
}

// threaded comments
function collagraph_enable_threaded_comments() {
    if (!is_admin()):
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)):
            wp_enqueue_script('comment-reply');
        endif; // is_singular() AND comments_open() AND (get_option('thread_comments') == 1)
    endif; // !is_admin()
}

// custom comments callback
function collagraph_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']):
        $tag = 'div';
        $add_below = 'comment';
    else:
        $tag = 'li';
        $add_below = 'div-comment';
    endif; // 'div' == $args['style'] ?>

    <!-- starting < for html tag (li or div) in next line will not pass linter -->
    <<?php echo $tag ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID(); ?>">

    <?php if ('div' != $args['style']): ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; // 'div' != $args['style'] ?>

    <div class="comment-author vcard">
        <?php
            if ($args['avatar_size'] != 0):
                echo get_avatar($comment, $args['180']);
            endif; // $args['avatar_size'] != 0
        ?>

        <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()); ?>
    </div>

    <?php if ($comment->comment_approved == '0'): ?>
        <em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em>

        <br />
    <?php endif; // $comment->comment_approved == '0' ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>">
        <?php
            printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'), '  ', '');
        ?>
    </div>

    <?php comment_text(); ?>

    <div class="reply">
       <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
    </div>

    <?php if ('div' != $args['style']): ?>
       </div>
    <?php endif; // 'div' != $args['style'] ?>
<?php }

/* -------------------------------------------------------------------------------
 * the_slug
 * -------------------------------------------------------------------------------*/

// the_slug()
function the_slug($id=null){
    echo apply_filters('the_slug', get_the_slug($id));
}

// get_the_slug()
function get_the_slug($id=null) {
    if(empty($id)):
        global $post;

        if(empty($post)):
            return ''; // No global $post var available.
        endif;

        $id = $post->ID;
    endif; // empty($id)

  $slug = basename(get_permalink($id));
  return $slug;
}

// add page slug to body class
function collagraph_add_slug_to_body_class($classes) {
    global $post;

    if (is_home()):
        $key = array_search('blog', $classes);

        if ($key > -1):
            unset($classes[$key]);
        endif; // $key > -1
    elseif (is_page()):
        $classes[] = sanitize_html_class($post->post_name);
    elseif (is_singular()):
        $classes[] = sanitize_html_class($post->post_name);
    endif; // is_home()

    return $classes;
}

/* -------------------------------------------------------------------------------
 *  pagination
 * -------------------------------------------------------------------------------*/

// pagination for paged posts
function collagraph_wp_pagination() {
    global $wp_query;
    $big = 9999999;

    echo paginate_links(
        array(
            'base' => str_replace($big, '%#%', get_pagenum_link($big)),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages
        )
    );
}

// add class to next post links
function collagraph_next_post_link_attributes($output) {
    $code = 'class="icon-next-project"';
    return str_replace('<a href=', '<a ' . $code . ' href=', $output);
}

// add class to prev post links
function collagraph_previous_post_link_attributes($output) {
    $code = 'class="icon-previous-project"';
    return str_replace('<a href=', '<a ' . $code . ' href=', $output);
}

// remove invalid rel attribute values in the categorylist
function collagraph_remove_category_rel_from_category_list($the_list) {
    return str_replace('rel="category tag"', 'rel="tag"', $the_list);
}

/* -------------------------------------------------------------------------------
 * excerpts
 * -------------------------------------------------------------------------------*/

// custom excerpt length for index page
function collagraph_wp_index($length) {
    return 20;
}

// custom excerpt length for post
function collagraph_wp_custom_post($length) {
    return 40;
}

// create the custom excerpts callback
function collagraph_wp_excerpt($length_callback = '', $more_callback = '') {
    global $post;

    if (function_exists($length_callback)):
        add_filter('excerpt_length', $length_callback);
    endif; // $length_callback

    if (function_exists($more_callback)):
        add_filter('excerpt_more', $more_callback);
    endif; // $more_callback

    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// custom view article link to post
function collagraph_view_article() {
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">Read&nbsp;more&nbsp;&rarr;</a>';
}

// remove 'text/css' from our enqueued stylesheet
function collagraph_style_remove($tag) {
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

/* -------------------------------------------------------------------------------
 * shortcodes
 * -------------------------------------------------------------------------------*/

// shortcode demo with nested capability
function collagraph_shortcode_demo($atts, $content = null) {
    return '<div class="shortcode-demo">' . collagraph_do_shortcode($content) . '</div>';
}

// shortcode demo with simple <h2> tag
function collagraph_shortcode_demo_2($atts, $content = null) {
    return '<h2>' . $content . '</h2>';
}

/* -------------------------------------------------------------------------------
 * custom post types
 * -------------------------------------------------------------------------------*/

function collagraph_create_post_type() {
    register_taxonomy_for_object_type('post_tag', 'collagraph');
    register_taxonomy_for_object_type('category', 'collagraph');

    // custom_post
    register_post_type('custom_post',
        array(
            'labels' => array(
                'name' => 'Custom Posts',
                'singular_name' => 'Custom Post',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Custom POst',
                'edit' => 'Edit',
                'edit_item' => 'Edit Custom Post',
                'new_item' => 'New Custom Post',
                'view' => 'View Custom Post',
                'view_item' => 'View Custom Post',
                'search_items' => 'Search Custom Posts',
                'not_found' => 'No Custom Posts found.',
                'not_found_in_trash' => 'No Custom Posts found in Trash.'
            ),
            'rewrite' => array(
                'slug' => 'custom-posts'
            ),
            'public' => true,
            'hierarchical' => true,
            'has_archive' => true,
            'supports' => array(
                'title'//,
                // 'editor',
                // 'excerpt',
                // 'thumbnail'
            ),
            'can_export' => true,
            'taxonomies' => array(
                'post_tag',
                'category'
            )
        )
    );
}

// remove unwated meta boxes
function collagraph_remove_meta_boxes() {
    // custom_post
    remove_meta_box('postexcerpt', 'custom_post', 'normal');
    remove_meta_box('trackbacksdiv', 'custom_post', 'normal');
    remove_meta_box('postcustom', 'custom_post', 'normal');
    remove_meta_box('commentstatusdiv', 'custom_post', 'normal');
    remove_meta_box('commentsdiv', 'custom_post', 'normal');
    remove_meta_box('authordiv', 'custom_post', 'normal');
    remove_meta_box('slugdiv', 'custom_post', 'normal');
    remove_meta_box('postimagediv', 'custom_post', 'normal');
    remove_meta_box('trackbacksdiv', 'custom_post', 'normal');

    //page
    remove_meta_box('trackbacksdiv', 'page', 'normal');
    remove_meta_box('postcustom', 'page', 'normal');
    remove_meta_box('commentstatusdiv', 'page', 'normal');
    remove_meta_box('commentsdiv', 'page', 'normal');
    remove_meta_box('authordiv', 'page', 'normal');
    remove_meta_box('slugdiv', 'page', 'normal');
    remove_meta_box('postimagediv', 'page', 'normal');
    remove_meta_box('trackbacksdiv', 'page', 'normal');
}

/* -------------------------------------------------------------------------------
 *  custom fields
 * -------------------------------------------------------------------------------*/

// register custom fields
function collagraph_register_fields() {
    include_once('fields/markdown_textarea-v4.php');
}

/* -------------------------------------------------------------------------------
 * custom login page
 * -------------------------------------------------------------------------------*/

// custom image for login page (112px * 334px)
function collagraph_login_head() {
    echo "
        <style>
            body.login #login h1 a {
                background: url('" . get_bloginfo('template_url')."/img/login.png') no-repeat scroll center top transparent;
                height: 112px;
                width: 320px;
                background-size: contain;
            }
        </style>
    ";
}

// change login image link
function collagraph_logo_url() {
    return get_bloginfo('url');
}

// change login image title text
function collagraph_logo_url_title() {
    return get_bloginfo('name');
}

/* -------------------------------------------------------------------------------
 * dashboard customisation
 * -------------------------------------------------------------------------------*/

// custom wordpress footer
function collagraph_custom_footer_admin () {
    echo '<a href="http://collagraph.com.au" title="Visit the Collagraph website.">Website by Collagraph</a>';
}

// hide admin alerts from non-administrator users
function collagraph_hide_update_notice_to_all_but_admin_users() {
    if (!current_user_can('update_core')) {
        remove_action('admin_notices', 3);
    }
}

// remove unwanted dashboard menu items
function collagraph_remove_admin_menu_items() {
    $remove_menu_items = array(__('Comments'),__('Feedback'));
    global $menu;
    end ($menu);
    while (prev($menu)){
        $item = explode(' ',$menu[key($menu)][0]);
        if(in_array($item[0] != NULL?$item[0]:"" , $remove_menu_items)){
        unset($menu[key($menu)]);}
    }
}

// remove visual editor
function collagraph_disable_rich_editing() {
    $current_user = wp_get_current_user();

    $isRichEditing = $current_user->get('rich_editing');

    if ($isRichEditing) {
        update_user_meta($current_user->ID, 'rich_editing', 'false');
    }
}

// remove default image sizes from the media uploader
function collagraph_remove_media_upload_fields($form_fields, $post) {
    unset($form_fields['image-size']);
    unset($form_fields['post_content']);
    unset($form_fields['url']);
    unset($form_fields['image_url']);
    unset($form_fields['align']);
    return $form_fields;
}

// increase media uploader upload limit
ini_set('upload_max_size', '64M');
ini_set('post_max_size', '64M');
ini_set('max_execution_time', '300');

?>