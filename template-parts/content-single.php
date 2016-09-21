<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Simple_Blog
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        <hr>
        <div class="entry-meta">
            <small><?php simpleblog_posted_on(); ?></small>
        </div><!-- .entry-meta -->
        <hr>

        <?php if ( has_excerpt() ) : ?>
            <div class="lead"><?php the_excerpt(); ?></div>
        <?php endif; ?>
        
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'simpleblog') . '</span>',
            'after' => '</div>',
            'link_before' => '<button type="button" class="btn btn-default">',
            'link_after' => '</button>',
            'pagelink' => '<span class="screen-reader-text">' . __('Page', 'simpleblog') . ' </span>%',
            'separator' => '<span class="screen-reader-text">, </span>',
        ));
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php simpleblog_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
