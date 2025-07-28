<?php
/**
 * Template part for displaying a sidebar
 *
 * @package Creative_Newsletter_Pro
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="sidebar">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside><!-- #secondary -->