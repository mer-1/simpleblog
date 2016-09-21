<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Simple_Blog
 */
get_header();
?>

<div id="main" class="col-sm-10 col-sm-offset-1">

    <?php
    while (have_posts()) : the_post();

        get_template_part('template-parts/content', 'single');

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>

        <nav>
            <ul class="pager">
                <?php
                // Bootstrap style pager: http://getbootstrap.com/components/#pagination-pager
                the_post_navigation(array(
                    
                    'next_text' => '<li class="next">'
                    . '<span class="meta-nav" aria-hidden="true">' . __('Next: ', 'simpleblog')
                    . '<span class="post-title">%title</span>'
                    . '</span></li>'
                    . '<span class="screen-reader-text">' . __('Next post:', 'simpleblog') . '</span> ',
                    
                    'prev_text' => '<li class="previous">'
                    . '<span class="meta-nav" aria-hidden="true">' . __('Previous: ', 'simpleblog')
                    . '<span class="post-title">%title</span>'
                    . '</span></li>'
                    . '<span class="screen-reader-text">' . __('Previous post:', 'simpleblog') . '</span> ',
                    
                ));
                ?>
            </ul>
        </nav>

        <?php
    endwhile; // End of the loop.
    ?>

</div><!-- #main -->

<div class="col-sm-8 col-sm-offset-2">
    <?php get_sidebar(); ?>
</div>

<?php
get_footer();
