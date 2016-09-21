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
        <?php the_title(sprintf('<h1><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h1>'); ?>
        <hr>
        <div class="entry-meta">
            <small><?php simpleblog_posted_on(); ?></small>
        </div><!-- .entry-meta -->
        <hr>

        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail index-page-thumbnail">
                <a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark">
                    <?php the_post_thumbnail(); ?>
                </a>
            </div><!-- .post-thumbnail -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_excerpt(); ?>
    </div><!-- .entry-content -->
    
    <div class="continue-reading">
        <button type="button" class="btn btn-default">
            <a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark">
                <?php
                printf(
                        /* Translators: %s = Name of the current post. */
                        wp_kses(__('Continue reading %s', 'simpleblog'), array('span' => array('class' => array()))), the_title('<span class="screen-reader-text">"', '"</span>', false)
                );
                ?>
            </a>
        </button>
    </div>
</article><!-- #post-## -->
