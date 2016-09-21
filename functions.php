<?php

/**
 * Simple Blog functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Simple_Blog
 */
if (!function_exists('simpleblog_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function simpleblog_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Simple Blog, use a find and replace
         * to change 'simpleblog' to the name of your theme in all the template files.
         */
        load_theme_textdomain('simpleblog', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for custom logo.
         *
         */
        add_theme_support('custom-logo', array(
            'height' => 52,
            'width' => 52,
            'flex-height' => true,
        ));

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1200, 300, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'simpleblog'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('simpleblog_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));
    }

endif;
add_action('after_setup_theme', 'simpleblog_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function simpleblog_content_width() {
    $GLOBALS['content_width'] = apply_filters('simpleblog_content_width', 640);
}

add_action('after_setup_theme', 'simpleblog_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function simpleblog_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'simpleblog'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'simpleblog'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title text-uppercase">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'simpleblog_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function simpleblog_scripts() {

    wp_enqueue_style('simpleblog-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');

    wp_enqueue_style('simpleblog-style', get_stylesheet_uri());

    wp_enqueue_script('simpleblog-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    wp_enqueue_script('simplegblog-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'simpleblog_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';


/* Hide WP version strings from scripts and styles
 * @return string $src
 * @filter script_loader_src
 * @filter style_loader_src
 */
function simpleblog_remove_wp_version_strings( $src ) {
    global $wp_version;

    $query = [];
    parse_str(parse_url($src, PHP_URL_QUERY), $query);
    if (!empty($query['ver']) && $query['ver'] === $wp_version) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'simpleblog_remove_wp_version_strings');
add_filter('style_loader_src', 'simpleblog_remove_wp_version_strings');

/**
 * Remove <meta name="generator" content="WordPress x.x.x" /> from <head>
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Customize the excerpt read-more indicator
 */
function simpleblog_excerpt_more( $more ) {
    return " …";
}
add_filter('excerpt_more', 'simpleblog_excerpt_more' );




/**
 * Add a boostrap class to comment form's fields: author, email, url to
 * contain the elements to width: 100% when used e.g. on mobile devices
 * 
 * @see comment-template.php comment_form()
 */
function simpleblog_comment_form_fields( $fields ) {
    $fields['author'] = preg_replace( '/<input id="author"/' , '<input id="author" class="form-control" ', $fields['author'] );
    $fields['email'] = preg_replace( '/<input id="email"/' , '<input id="email" class="form-control" ', $fields['email'] );
    $fields['url'] = preg_replace( '/<input id="url"/' , '<input id="url" class="form-control" ', $fields['url'] );

    return $fields;
}
add_filter( 'comment_form_default_fields', 'simpleblog_comment_form_fields' );

