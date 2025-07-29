<?php
/**
 * Template for displaying search forms
 *
 * @package CreativeNewsletter
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>" style="max-width: 400px; margin: 0 auto;">
    <div class="search-form-wrapper" style="position: relative; display: flex; background: white; border-radius: 50px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
        <label for="search-field" class="screen-reader-text">
            <?php esc_html_e('Search for:', 'creative-newsletter'); ?>
        </label>
        <input type="search" 
               id="search-field" 
               class="search-field" 
               placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'creative-newsletter'); ?>" 
               value="<?php echo get_search_query(); ?>" 
               name="s" 
               style="flex: 1; padding: 15px 20px; border: none; background: transparent; font-size: 1rem; outline: none;" />
        <button type="submit" 
                class="search-submit" 
                style="background: #007cba; color: white; border: none; padding: 15px 25px; cursor: pointer; transition: background 0.3s ease;">
            <span class="screen-reader-text"><?php echo _x('Search', 'submit button', 'creative-newsletter'); ?></span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
            </svg>
        </button>
    </div>
</form>

<style>
.search-form .search-submit:hover {
    background: #005a87 !important;
}

@media (max-width: 768px) {
    .search-form {
        max-width: 100% !important;
        margin: 1rem 0 !important;
    }
    
    .search-form-wrapper {
        border-radius: 25px !important;
    }
    
    .search-field {
        font-size: 16px !important; /* Prevent zoom on iOS */
    }
}
</style>