<?php
/**
 * The template for displaying comments
 *
 * @package Creative_Newsletter
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h3 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    esc_html__('One thought on &ldquo;%1$s&rdquo;', 'creative-newsletter'),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(
                    esc_html(
                        _nx(
                            '%1$s thought on &ldquo;%2$s&rdquo;',
                            '%1$s thoughts on &ldquo;%2$s&rdquo;',
                            $comment_count,
                            'comments title',
                            'creative-newsletter'
                        )
                    ),
                    number_format_i18n($comment_count),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h3>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
                'callback'   => 'creative_newsletter_comment',
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation();

        if (!comments_open()) :
        ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'creative-newsletter'); ?></p>
        <?php
        endif;

    endif;

    comment_form(array(
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'  => '</h3>',
        'class_form'         => 'comment-form',
        'class_submit'       => 'btn btn-primary',
        'submit_button'      => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
        'comment_field'      => '<p class="comment-form-comment"><label for="comment">' . esc_html__('Comment', 'creative-newsletter') . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" placeholder="' . esc_attr__('Write your comment here...', 'creative-newsletter') . '"></textarea></p>',
        'fields'             => array(
            'author' => '<p class="comment-form-author"><label for="author">' . esc_html__('Name', 'creative-newsletter') . ' <span class="required">*</span></label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245" required="required" placeholder="' . esc_attr__('Your name', 'creative-newsletter') . '" /></p>',
            'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__('Email', 'creative-newsletter') . ' <span class="required">*</span></label><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes" required="required" placeholder="' . esc_attr__('Your email', 'creative-newsletter') . '" /></p>',
            'url'    => '<p class="comment-form-url"><label for="url">' . esc_html__('Website', 'creative-newsletter') . '</label><input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" maxlength="200" placeholder="' . esc_attr__('Your website (optional)', 'creative-newsletter') . '" /></p>',
        ),
    ));
    ?>
</div>

<?php
/**
 * Custom comment callback
 */
function creative_newsletter_comment($comment, $args, $depth) {
    if ('div' === $args['style']) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>">
    
    <?php if ('div' !== $args['style']) : ?>
        <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
    <?php endif; ?>
    
    <div class="comment-author vcard">
        <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
        
        <div class="comment-metadata">
            <?php printf('<cite class="fn">%s</cite>', get_comment_author_link()); ?>
            
            <div class="comment-meta commentmetadata">
                <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
                    <?php
                    printf(
                        esc_html__('%1$s at %2$s', 'creative-newsletter'),
                        get_comment_date(),
                        get_comment_time()
                    );
                    ?>
                </a>
                <?php edit_comment_link(esc_html__('(Edit)', 'creative-newsletter'), '  ', ''); ?>
            </div>
        </div>
    </div>
    
    <?php if ($comment->comment_approved == '0') : ?>
        <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'creative-newsletter'); ?></em>
        <br />
    <?php endif; ?>
    
    <div class="comment-content">
        <?php comment_text(); ?>
    </div>
    
    <div class="reply">
        <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
    </div>
    
    <?php if ('div' !== $args['style']) : ?>
        </div>
    <?php endif; ?>
    
    <?php
}
?>

<style>
/* Comments styles */
.comments-area {
    margin-top: 4rem;
    padding-top: 3rem;
    border-top: 1px solid #1a1a1a;
}

.comments-title {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 2rem;
    color: #ffffff;
}

.comment-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.comment-body {
    padding: 2rem;
    margin-bottom: 2rem;
    background-color: #111111;
    border-radius: 8px;
    border: 1px solid #1a1a1a;
}

.comment-author {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}

.comment-author img {
    border-radius: 50%;
    flex-shrink: 0;
}

.comment-metadata {
    flex: 1;
}

.comment-metadata .fn {
    font-weight: 600;
    color: #ffffff;
    font-style: normal;
}

.comment-meta {
    font-size: 0.9rem;
    color: #888888;
    margin-top: 0.25rem;
}

.comment-meta a {
    color: inherit;
    text-decoration: none;
}

.comment-meta a:hover {
    color: #aaaaaa;
}

.comment-content {
    color: #cccccc;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.comment-content p {
    color: inherit;
    margin-bottom: 1rem;
}

.comment-awaiting-moderation {
    color: #f59e0b;
    font-style: italic;
}

.reply a {
    color: #ffffff;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    padding: 0.5rem 1rem;
    background-color: #1a1a1a;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.reply a:hover {
    background-color: #333333;
    color: #ffffff;
}

/* Comment form styles */
.comment-form {
    margin-top: 3rem;
    padding: 2rem;
    background-color: #111111;
    border-radius: 8px;
    border: 1px solid #1a1a1a;
}

.comment-reply-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 2rem;
    color: #ffffff;
}

.comment-form p {
    margin-bottom: 1.5rem;
}

.comment-form label {
    display: block;
    margin-bottom: 0.5rem;
    color: #ffffff;
    font-weight: 500;
}

.required {
    color: #f59e0b;
}

.comment-form input[type="text"],
.comment-form input[type="email"],
.comment-form input[type="url"],
.comment-form textarea {
    width: 100%;
    padding: 1rem;
    border: 1px solid #333333;
    border-radius: 6px;
    background-color: #0a0a0a;
    color: #ffffff;
    font-size: 1rem;
    font-family: inherit;
    transition: border-color 0.2s ease;
}

.comment-form input[type="text"]:focus,
.comment-form input[type="email"]:focus,
.comment-form input[type="url"]:focus,
.comment-form textarea:focus {
    outline: none;
    border-color: #555555;
}

.comment-form textarea {
    min-height: 120px;
    resize: vertical;
}

.comment-form input::placeholder,
.comment-form textarea::placeholder {
    color: #666666;
}

.comment-form .btn {
    margin-top: 1rem;
}

/* Nested comments */
.comment-list .children {
    list-style: none;
    margin-left: 2rem;
    margin-top: 2rem;
}

.comment-list .children .comment-body {
    background-color: #0f0f0f;
    border: 1px solid #222222;
}

/* Navigation */
.comment-navigation {
    margin: 2rem 0;
    text-align: center;
}

.comment-navigation .nav-links {
    display: flex;
    justify-content: space-between;
    gap: 1rem;
}

.comment-navigation a {
    color: #ffffff;
    text-decoration: none;
    padding: 0.75rem 1.5rem;
    background-color: #111111;
    border: 1px solid #333333;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.comment-navigation a:hover {
    background-color: #333333;
    border-color: #555555;
}

.no-comments {
    color: #888888;
    font-style: italic;
    text-align: center;
    padding: 2rem;
}

@media (max-width: 768px) {
    .comment-form {
        padding: 1.5rem;
    }
    
    .comment-body {
        padding: 1.5rem;
    }
    
    .comment-list .children {
        margin-left: 1rem;
    }
    
    .comment-navigation .nav-links {
        flex-direction: column;
    }
}
</style>