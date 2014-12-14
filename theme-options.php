<?php

load_theme_textdomain( 'MaterialPress', get_template_directory() . '/languages' );

/* Add submenu to Appearance */
function mp_theme_options_menu() {
    add_theme_page( 'MaterialPress', 'MaterialPress', 'manage_options', 'MaterialPress-theme-options', 'MaterialPress_theme_options' );
}
add_action( 'admin_menu', 'mp_theme_options_menu' );

////////////////////////////////////////////////////////////////////
// Add admin.css enqueue
////////////////////////////////////////////////////////////////////

    function mp_theme_style() {
        wp_enqueue_style('mp-theme', get_template_directory_uri() . '/css/admin.css');
    }
    add_action('admin_enqueue_scripts', 'mp_theme_style');

////////////////////////////////////////////////////////////////////
// Custom background theme support
////////////////////////////////////////////////////////////////////

    $defaults = array(
        'default-color'          => '',
        'default-image'          => '',
        'wp-head-callback'       => '_custom_background_cb',
        'admin-head-callback'    => '',
        'admin-preview-callback' => ''
    );
    add_theme_support( 'custom-background', $defaults );

////////////////////////////////////////////////////////////////////
// Custom header theme support
////////////////////////////////////////////////////////////////////

    register_default_headers( array(
        'wheel' => array(
            'url' => '%s/img/deafaultlogo.png',
            'thumbnail_url' => '%s/img/deafaultlogo.png',
            'description' => __( 'Your Business Name', 'devdmbootstrap' )
        ))

    );

    $defaults = array(
        'default-image'          => get_template_directory_uri() . '/img/deafaultlogo.png',
        'width'                  => 300,
        'height'                 => 100,
        'flex-height'            => true,
        'flex-width'             => true,
        'default-text-color'     => '000',
        'header-text'            => true,
        'uploads'                => true,
        'wp-head-callback'       => '',
        'admin-head-callback'    => '',
        'admin-preview-callback' => 'mp_admin_header_image',
    );
    add_theme_support( 'custom-header', $defaults );

    function mp_admin_header_image() { ?>

        <div id="headimg">
            <?php
            $color = get_header_textcolor();
            $image = get_header_image();

            if ( $color && $color != 'blank' ) :
                $style = ' style="color:#' . $color . '"';
            else :
                $style = ' style="display:none"';
            endif;
            ?>


            <?php if ( $image ) : ?>
                <img src="<?php echo esc_url( $image ); ?>" alt="" />
            <?php endif; ?>
            <div class="mp_header_name_desc">
            <h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
            <div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>

            </div>
        </div>

    <?php }

    function custom_header_text_color () {
        if ( get_header_textcolor() != 'blank' ) { ?>
            <style>
               .custom-header-text-color { color: #<?php echo get_header_textcolor(); ?> }
            </style>
    <?php }
    }

    add_action ('wp_head', 'custom_header_text_color');

////////////////////////////////////////////////////////////////////
// Register our settings options (the options we want to use)
////////////////////////////////////////////////////////////////////

    $mp_options = array(
        'author_credits' => true,
	'user_comments' => true,
        'right_sidebar' => true,
        'right_sidebar_width' => 3,
        'left_sidebar' => false,
        'left_sidebar_width' => 3,
        'show_header' => true,
        'show_postmeta' => true
    );

    $mp_sidebar_sizes = array(
        '1' => array (
            'value' => '1',
            'label' => '1'
        ),
        '2' => array (
            'value' => '2',
            'label' => '2'
        ),
        '3' => array (
            'value' => '3',
            'label' => '3'
        ),
        '4' => array (
            'value' => '4',
            'label' => '4'
        ),
        '5' => array (
            'value' => '5',
            'label' => '5'
        )

    );

    function mp_register_settings() {
        register_setting( 'mp_theme_options', 'mp_options', 'mp_validate_options' );
    }

    add_action ('admin_init', 'mp_register_settings');
    $mp_settings = get_option( 'mp_options', $mp_options );


////////////////////////////////////////////////////////////////////
// Validate Options
////////////////////////////////////////////////////////////////////

    function mp_validate_options( $input ) {

        global $mp_options, $mp_sidebar_sizes;

        $settings = get_option( 'mp_options', $mp_options );

        $prev = $settings['right_sidebar_width'];
        if ( !array_key_exists( $input['right_sidebar_width'], $mp_sidebar_sizes ) ) {
            $input['right_sidebar_width'] = $prev;
        }

        $prev = $settings['left_sidebar_width'];
        if ( !array_key_exists( $input['left_sidebar_width'], $mp_sidebar_sizes ) ) {
            $input['left_sidebar_width'] = $prev;
        }

        if ( ! isset( $input['author_credits'] ) ) {
            $input['author_credits'] = null;
        } else {
            $input['author_credits'] = ( $input['author_credits'] == 1 ? 1 : 0 );
        }

	if ( ! isset( $input['user_comments'] ) ) {
            $input['user_comments'] = null;
        } else {
            $input['user_comments'] = ( $input['user_comments'] == 1 ? 1 : 0 );
        }

        if ( ! isset( $input['show_header'] ) ) {
            $input['show_header'] = null;
        } else {
            $input['show_header'] = ( $input['show_header'] == 1 ? 1 : 0 );
        }

        if ( ! isset( $input['right_sidebar'] ) ) {
            $input['right_sidebar'] = null;
        } else {
            $input['right_sidebar'] = ( $input['right_sidebar'] == 1 ? 1 : 0 );
        }

        if ( ! isset( $input['left_sidebar'] ) ) {
            $input['left_sidebar'] = null;
        } else {
            $input['left_sidebar'] = ( $input['left_sidebar'] == 1 ? 1 : 0 );
        }

        if ( ! isset( $input['show_postmeta'] ) ) {
            $input['show_postmeta'] = null;
        } else {
            $input['show_postmeta'] = ( $input['show_postmeta'] == 1 ? 1 : 0 );
        }

        return $input;
    }

////////////////////////////////////////////////////////////////////
// Display Options Page
////////////////////////////////////////////////////////////////////

    function MaterialPress_theme_options() {

    if ( !current_user_can( 'manage_options' ) )  {
        wp_die('You do not have sufficient permissions to access this page.');
    }

        //get our global options
        global $mp_options, $mp_sidebar_sizes, $developer_uri;

        //get our logo
        $logo = get_template_directory_uri() . '/img/logo.png'; ?>

        <div class="wrap">

        

            <div class="icon32" id="icon-options-general"></div>

            <h2><a href="<?php echo $developer_uri ?>" target="_blank">MaterialPress</a></h2>

               <?php

               if ( ! isset( $_REQUEST['settings-updated'] ) )

                   $_REQUEST['settings-updated'] = false;

               ?>

               <?php if ( false !== $_REQUEST['settings-updated'] ) : ?>

               <div class='saved'><p><strong><?php _e('Options Saved!','MaterialPress') ;?></strong></p></div>

               <?php endif; ?>

            <form action="options.php" method="post">

                <?php
                    $settings = get_option( 'mp_options', $mp_options );
                    settings_fields( 'mp_theme_options' );
                ?>

                <table cellpadding='10'>

                    <tr valign="top"><th scope="row"><?php _e('Right Sidebar','MaterialPress') ;?></th>
                        <td>
                            <input type="checkbox" id="right_sidebar" name="mp_options[right_sidebar]" value="1" <?php checked( true, $settings['right_sidebar'] ); ?> />
                            <label for="right_sidebar"><?php _e('Show the Right Sidebar','MaterialPress') ;?></label>
                        </td>
                    </tr>

                    <tr valign="top"><th scope="row"><?php _e('Right Sidebar Size','MaterialPress') ;?></th>
                        <td>
                    <?php foreach( $mp_sidebar_sizes as $sizes ) : ?>
                        <input type="radio" id="<?php echo $sizes['value']; ?>" name="mp_options[right_sidebar_width]" value="<?php echo esc_attr($sizes['value']); ?>" <?php checked( $settings['right_sidebar_width'], $sizes['value'] ); ?> />
                        <label for="<?php echo $sizes['value']; ?>"><?php echo $sizes['label']; ?></label><br />
                    <?php endforeach; ?>
                        </td>
                    </tr>

                    <tr valign="top"><th scope="row"><?php _e('Left Side Bar','MaterialPress') ;?></th>
                        <td>
                            <input type="checkbox" id="left_sidebar" name="mp_options[left_sidebar]" value="1" <?php checked( true, $settings['left_sidebar'] ); ?> />
                            <label for="left_sidebar"><?php _e('Show the Left Sidebar','MaterialPress') ;?></label>
                        </td>
                    </tr>

                    <tr valign="top"><th scope="row"><?php _e('Left Sidebar Size','MaterialPress') ;?></th>
                        <td>
                            <?php foreach( $mp_sidebar_sizes as $sizes ) : ?>
                                <input type="radio" id="<?php echo $sizes['value']; ?>" name="mp_options[left_sidebar_width]" value="<?php echo esc_attr($sizes['value']); ?>" <?php checked( $settings['left_sidebar_width'], $sizes['value'] ); ?> />
                                <label for="<?php echo $sizes['value']; ?>"><?php echo $sizes['label']; ?></label><br />
                            <?php endforeach; ?>
                        </td>
                    </tr>

                    <tr valign="top"><th scope="row"><?php _e('Show Header','MaterialPress') ;?></th>
                        <td>
                            <input type="checkbox" id="show_header" name="mp_options[show_header]" value="1" <?php checked( true, $settings['show_header'] ); ?> />
                            <label for="show_header"><?php _e('Show The Main Header in the Template (logo/sitename/etc.)','MaterialPress') ;?></label>
                        </td>
                    </tr>

                    <tr valign="top"><th scope="row"><?php _e('Show Post Meta','MaterialPress') ;?></th>
                        <td>
                            <input type="checkbox" id="show_postmeta" name="mp_options[show_postmeta]" value="1" <?php checked( true, $settings['show_postmeta'] ); ?> />
                            <label for="show_postmeta"><?php _e('Show Post Meta data (author, category, date created)','MaterialPress') ;?></label>
                        </td>
                    </tr>

                    <tr valign="top"><th scope="row"><?php _e('Give Simon His Credit?','MaterialPress') ;?></th>
                        <td>
                            <input type="checkbox" id="author_credits" name="mp_options[author_credits]" value="1" <?php checked( true, $settings['author_credits'] ); ?> />
                            <label for="author_credits"><?php _e('Show me some love and keep a link to SimonSickle.com in your footer.','MaterialPress') ;?></label>
                        </td>
                    </tr>

                    <tr valign="top"><th scope="row"><?php _e('Enable User Comments?','MaterialPress') ;?></th>
                        <td>
                            <input type="checkbox" id="user_comments" name="mp_options[user_comments]" value="1" <?php checked( true, $settings['user_comments'] ); ?> />
                            <label for="user_comments"><?php _e('If checked, comments will be shown on all pages/posts.','MaterialPress') ;?></label>
                        </td>
                    </tr>

                </table>

                <p class="submit">
                    <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes','MaterialPress'); ?>" />
                </p>

            </form>

        </div>
<?php

}
?>