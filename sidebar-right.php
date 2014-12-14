<?php
    global $mp_settings;
    if ($mp_settings['right_sidebar'] != 0) : ?>
    <div class="col-lg-<?php echo $mp_settings['right_sidebar_width']; ?>">
        <?php //get the right sidebar
        dynamic_sidebar( 'Right Sidebar' ); ?>
    </div>
<?php endif; ?>