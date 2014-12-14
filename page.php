<?php get_header();

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
?>

<!-- start content container -->
<div class="container body-content">

    <div class="page-header">
        <div class="row">
            <div class="col-lg-12"><br></div>
        </div>
    </div>

    <div class="row">

    <?php //left sidebar ?>
    <?php get_sidebar( 'left' ); ?>

    <div class="col-lg-<?php echo $main_content_size; ?>">

        <div class="well post">

        <?php // theloop
        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <h2 class="page-header"><?php the_title() ;?></h2>
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
            <?php comments_template(); ?>

        <?php endwhile; ?>
        <?php else: ?>

            <?php get_404_template(); ?>

        <?php endif; ?>
        </div>

    </div>

    <?php //get the right sidebar ?>
    <?php get_sidebar( 'right' ); ?>

</div>
<!-- end content container -->

<?php get_footer(); ?>