<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Simple_Blog
 */
?>
    </div><!-- row -->
</div><!-- container -->

<footer role="contentinfo" class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-4">
                <div class="site-info">
                    <p class="copyright text-muted">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        <?php printf(esc_html__('Theme: %1$s by %2$s', 'simpleblog'), 'simpleblog', '<a href="/" rel="designer" _target="blank">Author Name</a>'); ?>
                    </p>
                    <p class="copyright text-muted">Copyright &copy; <?php echo date("Y"); ?></p>
                </div><!-- .site-info -->
            </div>
        </div><!-- row -->
    </div><!-- container -->
</footer>

<?php wp_footer(); ?>

</body>
</html>
