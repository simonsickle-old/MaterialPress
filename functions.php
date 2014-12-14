<?php

////////////////////////////////////////////////////////////////////
// Theme Information
////////////////////////////////////////////////////////////////////

    $themename = "MaterialPress";
    $developer_uri = "http://simonsickle.com";
    $shortname = "MP";
    $version = '0.1';
    //load_theme_textdomain( 'MaterialPress', get_template_directory() . '/languages' );

////////////////////////////////////////////////////////////////////
// include Theme-options.php for Admin Theme settings
////////////////////////////////////////////////////////////////////

   include 'theme-options.php';


////////////////////////////////////////////////////////////////////
// Enqueue Styles (normal style.css and bootstrap.css)
////////////////////////////////////////////////////////////////////
    function MaterialPress_theme_stylesheets()
    {
	// Bootstrap
        wp_register_style('bootstrap.min.css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1', 'all' );
        wp_enqueue_style( 'bootstrap.min.css');
        wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), array(), '1', 'all' );

        // Material CSS w/ fonts
        wp_register_style('material-wfont.min.css', get_template_directory_uri() . '/css/material-wfont.min.css', array(), '1', 'all' );
        wp_enqueue_style( 'material-wfont.min.css');
        wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), array(), '1', 'all' );

        // Material Ripples
        wp_register_style('ripples.min.css', get_template_directory_uri() . '/css/ripples.min.css', array(), '1', 'all' );
        wp_enqueue_style( 'ripples.min.css');
        wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), array(), '1', 'all' );
    }
    add_action('wp_enqueue_scripts', 'MaterialPress_theme_stylesheets');

//Editor Style
add_editor_style('css/editor-style.css');

////////////////////////////////////////////////////////////////////
// Register Bootstrap JS with jquery
////////////////////////////////////////////////////////////////////
    function MaterialPress_theme_js()
    {
        global $version;

        // Bootstrap JS
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js ',array( 'jquery' ),$version,false);

        // Material JS 
        wp_enqueue_script('material', get_template_directory_uri() . '/js/material.min.js ',array( 'jquery' ),$version,false);

        // Ripples JS
        wp_enqueue_script('ripples', get_template_directory_uri() . '/js/ripples.min.js ',array( 'jquery' ),$version,false);
    }
    add_action('wp_enqueue_scripts', 'MaterialPress_theme_js');




////////////////////////////////////////////////////////////////////
// Register Custom Navigation Walker include custom menu widget to use walkerclass
////////////////////////////////////////////////////////////////////

    require_once('lib/wp_bootstrap_navwalker.php');
    require_once('lib/bootstrap-custom-menu-widget.php');

////////////////////////////////////////////////////////////////////
// Register Menus
////////////////////////////////////////////////////////////////////

        register_nav_menus(
            array(
                'main_menu' => 'Main Menu',
                'footer_menu' => 'Footer Menu'
            )
        );

////////////////////////////////////////////////////////////////////
// Register the Sidebar(s)
////////////////////////////////////////////////////////////////////

        register_sidebar(
            array(
            'name' => 'Right Sidebar',
            'id' => 'right-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));

        register_sidebar(
            array(
            'name' => 'Left Sidebar',
            'id' => 'left-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));

////////////////////////////////////////////////////////////////////
// Register hook and action to set Main content area col-md- width based on sidebar declarations
////////////////////////////////////////////////////////////////////

add_action( 'devdmbootstrap3_main_content_width_hook', 'devdmbootstrap3_main_content_width_columns');

function devdmbootstrap3_main_content_width_columns () {

    global $dm_settings;

    $columns = '12';

    if ($dm_settings['right_sidebar'] != 0) {
        $columns = $columns - $dm_settings['right_sidebar_width'];
    }

    if ($dm_settings['left_sidebar'] != 0) {
        $columns = $columns - $dm_settings['left_sidebar_width'];
    }

    echo $columns;
}

function devdmbootstrap3_main_content_width() {
    do_action('devdmbootstrap3_main_content_width_hook');
}

////////////////////////////////////////////////////////////////////
// Add support for a featured image and the size
////////////////////////////////////////////////////////////////////

    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size(300,300, true);

////////////////////////////////////////////////////////////////////
// Adds RSS feed links to for posts and comments.
////////////////////////////////////////////////////////////////////

    add_theme_support( 'automatic-feed-links' );


////////////////////////////////////////////////////////////////////
// Set Content Width
////////////////////////////////////////////////////////////////////

if ( ! isset( $content_width ) ) $content_width = 800;

?>
