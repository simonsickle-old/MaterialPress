<?php
    global $mp_settings;
    if ($mp_settings['left_sidebar'] != 0) : ?>
    <div class="col-lg-<?php echo $mp_settings['left_sidebar_width']; ?>">
        <?php dynamic_sidebar( 'Left Sidebar' ); ?>
    </div>
<?php endif; ?>