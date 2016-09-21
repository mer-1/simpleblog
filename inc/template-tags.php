<?php

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Simple_Blog
 */
if (!function_exists('simpleblog_posted_on')) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function simpleblog_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf($time_string, esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_attr(get_the_modified_date('c')), esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
                esc_html_x('%s', 'post date', 'simpleblog'), '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        $byline = sprintf(
                esc_html_x('%s', 'post author', 'simpleblog'), '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>' .
        '<span class="posted-on">' . $posted_on . '</span><span class="byline">' .
        '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> '
        . $byline . '</span> ';

        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html(', '));
            if ($categories_list && simpleblog_categorized_blog()) {
                printf('<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>'
                        . '<span class="cat-links">' . esc_html__('Posted in %1$s', 'simpleblog') . '</span>', $categories_list); 
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html__(', ', 'simpleblog'));
            if ($tags_list) {
                printf('<span class="glyphicon glyphicon-tags" aria-hidden="true"></span>'
                        . '<span class="tags-links">' . esc_html__('Tagged %1$s', 'simpleblog') . '</span>', $tags_list); 
            }
        }
    }

endif;

if (!function_exists('simpleblog_entry_footer')) :

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function simpleblog_entry_footer() {
        if (!is_single() && !post_password_required() && ( comments_open() || get_comments_number() )) {
            echo '<span class="comments-link">';
            /* translators: %s: post title */
            comments_popup_link(sprintf(wp_kses(__('<span class="label label-default">Leave a Comment</span><span class="screen-reader-text"> on %s</span>', 'simpleblog'), array('span' => array('class' => array()))), get_the_title()));
            echo '</span> ';
        }

        edit_post_link(
            sprintf(
                    /* translators: %s: Name of current post */
                    esc_html__('Edit %s', 'simpleblog'), the_title('<span class="screen-reader-text">"', '"</span>', false)
            ), '<span class="edit-link btn btn-default">', '</span>'
        );
    }

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function simpleblog_categorized_blog() {
    if (false === ( $all_the_cool_cats = get_transient('simpleblog_categories') )) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(array(
            'fields' => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number' => 2,
        ));

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('simpleblog_categories', $all_the_cool_cats);
    }

    if ($all_the_cool_cats > 1) {
        // This blog has more than 1 category so simpleblog_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so simpleblog_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in simpleblog_categorized_blog.
 */
function simpleblog_category_transient_flusher() {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient('simpleblog_categories');
}

add_action('edit_category', 'simpleblog_category_transient_flusher');
add_action('save_post', 'simpleblog_category_transient_flusher');


/*
 * Add bootstrap classes to comments
 * 
 * @see comments.php 
 * @see https://developer.wordpress.org/reference/classes/walker_comment/html5_comment/
 */
 function simpleblog_comment($comment, $args, $depth) {
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty($args['has_children']) ? 'parent media comment-body' : 'media comment-body', $comment); ?>>
        <div class="comment-author vcard pull-left">
            <?php if (0 != $args['avatar_size']) {
                echo get_avatar($comment, $args['avatar_size'], '', '', array( 'class' => 'media-object') ); 
            } ?>
        </div>

        <div class="media-body">
            <h4 class="media-heading">
                <?php printf(__('%s'), sprintf('<b class="fn">%s</b>', get_comment_author_link($comment))); ?>
                <small>
                    <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>">
                        <time datetime="<?php comment_time('c'); ?>">
                            <?php
                            /* translators: 1: comment date, 2: comment time */
                            printf(__('%1$s %2$s'), get_comment_date('', $comment), get_comment_time());
                            ?>
                        </time>
                    </a>
                    <?php edit_comment_link(__('Edit'), '<span class="edit-link label label-info">', '</span>'); ?>
                </small>
            </h4>
        
            <?php if ('0' == $comment->comment_approved) : ?>
                <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.'); ?></p>
            <?php endif; ?>

            <div class="comment-content">
                <?php comment_text(); ?>
            </div><!-- .comment-content -->
        
            <?php
            comment_reply_link(array_merge($args, array(
                'add_below' => 'div-comment',
                'depth' => $depth,
                'max_depth' => $args['max_depth'],
                'before' => '<div class="comment-reply-button btn btn-default">',
                'after' => '</div>'
            )));
            ?>
        </div><!-- media-body -->
    <?php
 }

 
 /**
 * Add bootstrap classes to posts_navigation()
 */
 function simpleblog_the_posts_navigation() {
     // Previous/next page navigation.
    $str = get_the_posts_pagination(array(
        'prev_text' => __('<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>', 'simpleblog'),
        'next_text' => __('<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>', 'simpleblog'),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'simpleblog') . ' </span>',
        'type' => 'list'
    ));

    // Add boostrap style pagination
    $str = preg_replace('/pagination/', '', $str);
    $str = preg_replace("/ul class='page-numbers'/", 'ul class="pagination pagination-lg"', $str);
    echo $str;
 }
 
 