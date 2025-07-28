<?php
/**
 * Search form template
 *
 * @package Creative_Newsletter_Pro
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="screen-reader-text" for="search-field"><?php esc_html_e('Search for:', 'creative-newsletter-pro'); ?></label>
    <input type="search" 
           id="search-field" 
           class="search-field" 
           placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'creative-newsletter-pro'); ?>" 
           value="<?php echo get_search_query(); ?>" 
           name="s" 
           style="padding: 10px 15px; border: 1px solid #d1d5db; border-radius: 6px; width: 100%; font-size: 1rem;" />
    <button type="submit" 
            class="search-submit btn btn-primary" 
            style="margin-top: 1rem; width: 100%;">
        <?php echo esc_html_x('Search', 'submit button', 'creative-newsletter-pro'); ?>
    </button>
</form>