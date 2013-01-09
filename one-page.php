<?php
/**
 * Example plugin that can be included in the theme by using $scaleup_templates->apply( $post_id, 'one-page.php' )
 * in theme's functions.php file.
 * 
 * This example shows all sub pages of the page that it was applied to on 1 page.
 */
get_header(); ?>

    <div id="primary" class="site-content">
        <div id="content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php
                global $more;

                $more       = 1;
                $children   = new WP_Query( sprintf( 'post_parent=%s&post_type=page&order=ASC&orderby=menu_order', get_the_ID() ) );

                while ( $children->have_posts() ) {
                    $children->the_post();
                    get_template_part( 'content', get_post_format() );
                }
                wp_reset_postdata();

            endwhile; // end of the loop. ?>

        </div><!-- #content -->
    </div><!-- #primary -->

<?php get_sidebar() ?>
<?php get_footer() ?>