<?php if ( has_nav_menu( 'main_menu' ) ) : ?>

<div class="container">
    <nav class="navbar navbar-default navbar-fixed-top sticky">
      <div class="container">
        <div class="navbar-header">
            <a href="<?php echo get_bloginfo('url'); ?>" class="navbar-brand">Home</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <?php
                wp_nav_menu( array(
                        'theme_location'    => 'main_menu',
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => 'navbar-collapse collapse',
                        'menu_class'        => 'nav navbar-nav',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker())
                );
            ?>
        </div>
      </div>
    </nav>
</div>

 

<?php endif; ?>