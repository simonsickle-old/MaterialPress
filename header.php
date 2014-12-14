<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>" />
    <title><?php wp_title('&laquo;', true, 'right'); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>

    <!-- Let there be ripples (after jquery and other JS is loaded) -->
    <script>
	jQuery(function($) {
            $(document).ready(function() {
                $.material.init();
            });
        })
    </script>
</head>
<body <?php body_class(); ?>>
<?php get_template_part('template-part', 'head'); ?>
<?php get_template_part('template-part', 'topnav'); ?>