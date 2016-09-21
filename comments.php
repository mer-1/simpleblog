<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Simple_Blog
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    // You can start editing here -- including this comment!
    if (have_comments()) :
        ?>
        <h2 class="page-header">
            <?php printf( esc_html__('Comments (%1$s)', 'simpleblog'), get_comments_number() ); ?>
        </h2>

        <ol class="media-list">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'callback' => 'simpleblog_comment'
            ));
            ?>
        </ol><!-- .comment-list -->

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through?  ?>
            <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'simpleblog'); ?></h2>
                <ul class="pager">
                    <li class="previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'simpleblog')); ?></li>
                    <li class="next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'simpleblog')); ?></li>
                </ul><!-- .nav-links -->
            </nav><!-- #comment-nav-below -->
            <?php
        endif; // Check for comment navigation.

    endif; // Check for have_comments().
    
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'simpleblog'); ?></p>
        <?php
    endif;

      
    if ( comments_open() ) :  ?>
        <div class="well">
            <?php
            comment_form( array(
                'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-primary" value="%4$s" />',
                'comment_field' =>  '<p class="comment-form-comment">'
                                    . '<label for="comment">Comment</label>'
                                    . '<textarea id="comment" class="form-control" name="comment" rows="8" maxlength="65525" aria-required="true" required="required"></textarea></p>'
            ));
            /*
             * Note: 
             * $fields['author'], $fields['email'], $fields['url'] get an additional boostrap class .form-control 
             * in functions.php : simpleblog_comment_form_fields( $fields )
             */
            ?>
        </div>
    <?php endif; ?>    
        

</div><!-- #comments -->
