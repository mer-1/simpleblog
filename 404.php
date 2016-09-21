<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Simple_Blog
 */
get_header();
?>

<div id="main" class="col-sm-6 col-sm-offset-2">

    <section class="error-404 not-found">
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'simpleblog'); ?></h1>
        </header><!-- .page-header -->

        <div class="page-content">
            <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'simpleblog'); ?></p>
            <?php get_search_form(); ?>
         </div><!-- .page-content -->
    </section><!-- .error-404 -->    
</div><!-- #main -->

<div class="col-sm-4"></div>

<div class="col-sm-6">
    <?php
    
    the_widget('WP_Widget_Recent_Posts');
    
    ?>
</div>

<div class="col-sm-6">
    <?php
    
    // Only show the widget if site has multiple categories.
    if (simpleblog_categorized_blog()) :
        ?>

        <div class="widget widget_categories">
            <h2 class="widget-title"><?php esc_html_e('Most Used Categories', 'simpleblog'); ?></h2>
            <ul>
                <?php
                wp_list_categories(array(
                    'orderby' => 'count',
                    'order' => 'DESC',
                    'show_count' => 1,
                    'title_li' => '',
                    'number' => 10,
                ));
                ?>
            </ul>
        </div><!-- .widget -->

        <?php
    endif;
    ?>
        
</div>

<div class="col-sm-6">
    <?php
    /* translators: %1$s: smiley */
    $archive_content = '<p>' . sprintf(esc_html__('Try looking in the monthly archives. %1$s', 'simpleblog'), convert_smilies(':)')) . '</p>';
    the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content");
    
    ?>
</div>

<div class="col-sm-6">
    <?php
    the_widget('WP_Widget_Tag_Cloud');
    ?>
</div>   



<?php
get_footer();
