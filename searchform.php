<?php
/**
 * The template for displaying search form
 *
 * @package Creative_Newsletter
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="search-field-<?php echo uniqid(); ?>" class="screen-reader-text">
        <?php esc_html_e('Search for:', 'creative-newsletter'); ?>
    </label>
    
    <div class="search-form-wrapper">
        <input 
            type="search" 
            id="search-field-<?php echo uniqid(); ?>" 
            class="search-field" 
            placeholder="<?php echo esc_attr_x('Search posts...', 'placeholder', 'creative-newsletter'); ?>" 
            value="<?php echo get_search_query(); ?>" 
            name="s" 
            required
        />
        
        <button type="submit" class="search-submit">
            <span class="screen-reader-text"><?php esc_html_e('Search', 'creative-newsletter'); ?></span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 21L16.514 16.506M19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
</form>

<style>
/* Search form styles */
.search-form {
    max-width: 400px;
    margin: 2rem auto;
}

.search-form-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    background-color: #111111;
    border: 1px solid #333333;
    border-radius: 8px;
    overflow: hidden;
    transition: border-color 0.2s ease;
}

.search-form-wrapper:focus-within {
    border-color: #555555;
}

.search-field {
    flex: 1;
    padding: 1rem 1.5rem;
    border: none;
    background: transparent;
    color: #ffffff;
    font-size: 1rem;
    outline: none;
}

.search-field::placeholder {
    color: #666666;
}

.search-submit {
    padding: 1rem 1.5rem;
    border: none;
    background: transparent;
    color: #888888;
    cursor: pointer;
    transition: color 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-submit:hover {
    color: #ffffff;
}

.search-submit svg {
    width: 20px;
    height: 20px;
}

@media (max-width: 768px) {
    .search-form {
        max-width: 100%;
        margin: 1rem 0;
    }
    
    .search-field {
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
    }
    
    .search-submit {
        padding: 0.75rem 1rem;
    }
}
</style>