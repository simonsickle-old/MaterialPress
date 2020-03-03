<?php
global $wp_query;
get_header(); ?>

<div class="container body-content">

    <div class="page-header">
        <div class="row">
            <div class="col-lg-12"><br></div>
        </div>
    </div>

    <div class="row">

    <?php get_sidebar( 'left' );

	    $post_classes = array("well");
            $left_sidebar_size = 0;
            $right_sidebar_size = 0;
            global $mp_settings;

            /* Get Right Sidebar size */
            if ($mp_settings['left_sidebar'] != 0)
                $left_sidebar_size = $mp_settings['left_sidebar_width'];

            /* Get Right Sidebar size */
            if ($mp_settings['right_sidebar'] != 0)
                $right_sidebar_size = $mp_settings['right_sidebar_width'];

            $main_content_size = 12 - ($right_sidebar_size + $left_sidebar_size);

            //if this was a search we display a page header with the results count. If there were no results we display the search form.
            if (is_search()) :

                 $total_results = $wp_query->found_posts;

                 echo "<h2 class='page-header'>" . sprintf( __('%s Search Results for "%s"','devdmbootstrap3'),  $total_results, get_search_query() ) . "</h2>";

                 if ($total_results == 0) :
                     get_search_form(true);
                 endif;

            endif;

        ?>

            <div class="col-lg-<?php echo $main_content_size; ?>">
            <?php // theloop
                if ( have_posts() ) : while ( have_posts() ) : the_post();

                    // single post
                    if ( is_single() ) : ?>

                        <div <?php post_class($post_classes); ?>>

                            <h2 class="page-header"><?php the_title() ;?></h2>

                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail(); ?>
                                <div class="clear"></div>
                            <?php endif; ?>
                            <?php the_content(); ?>
                            <?php wp_link_pages(); ?>
                            <?php get_template_part('template-part', 'postmeta'); ?>
                            <?php comments_template(); ?>
			            </div>
                    <?php
                    // list of posts
                    else : ?>
                       <div <?php post_class($post_classes); ?>>

                            <h2 class="page-header">
                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'devdmbootstrap3' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                            </h2>

                            <?php if ( has_post_thumbnail() ) : ?>
                               <?php the_post_thumbnail(); ?>
                                <div class="clear"></div>
                            <?php endif; ?>
                            <?php the_content(); ?>
                            <?php wp_link_pages(); ?>
                            <?php get_template_part('template-part', 'postmeta'); ?>
                            <?php  if ( comments_open() ) : ?>
                                   <div class="clear"></div>
                                  <p class="text-right">
                                      <a class="btn btn-success" href="<?php the_permalink(); ?>#comments">Leave A Comment <span class="ripple-wrapper"></span></a>
                                  </p>
                            <?php endif; ?>
                       </div>

                     <?php  endif; ?>

                <?php endwhile; ?>
                <?php posts_nav_link(); ?>
                <?php else: ?>

                    <?php get_404_template(); ?>

            <?php endif; ?>

			</div>

   <?php //get the right sidebar ?>
   <?php get_sidebar( 'right' ); ?>

</div> <!--row -->

</div> <!--body container-->

<?php get_footer(); ?>
