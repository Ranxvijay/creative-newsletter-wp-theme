<?php
/**
 * The template for displaying comments
 *
 * @package CreativeNewsletter
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area" style="margin-top: 3rem; padding: 2rem; background: #f8f9fa; border-radius: 15px;">

    <?php if (have_comments()) : ?>
        <h3 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ('1' === $comments_number) {
                printf(_x('One thought on &ldquo;%s&rdquo;', 'comments title', 'creative-newsletter'), get_the_title());
            } else {
                printf(
                    _nx(
                        '%1$s thought on &ldquo;%2$s&rdquo;',
                        '%1$s thoughts on &ldquo;%2$s&rdquo;',
                        $comments_number,
                        'comments title',
                        'creative-newsletter'
                    ),
                    number_format_i18n($comments_number),
                    get_the_title()
                );
            }
            ?>
        </h3>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list" style="list-style: none; padding: 0;">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 60,
                'callback'    => 'creative_newsletter_comment_callback',
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open()) :
            ?>
            <p class="no-comments" style="text-align: center; color: #666; font-style: italic;">
                <?php esc_html_e('Comments are closed.', 'creative-newsletter'); ?>
            </p>
            <?php
        endif;

    endif; // Check for have_comments().

    comment_form(array(
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'  => '</h3>',
        'class_form'         => 'comment-form',
        'class_submit'       => 'btn',
    ));
    ?>

</div><!-- #comments -->

<?php
/**
 * Custom comment callback function
 */
function creative_newsletter_comment_callback($comment, $args, $depth) {
    if ('div' === $args['style']) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>" style="margin-bottom: 2rem; padding: 1.5rem; background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        
        <div class="comment-author vcard" style="display: flex; align-items: center; margin-bottom: 1rem;">
            <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size'], '', '', array('style' => 'border-radius: 50%; margin-right: 1rem;')); ?>
            
            <div class="comment-metadata">
                <cite class="fn" style="font-weight: 600; color: #333;">
                    <?php comment_author_link(); ?>
                </cite>
                
                <div class="comment-meta commentmetadata" style="font-size: 0.9rem; color: #666;">
                    <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>" style="color: #666; text-decoration: none;">
                        <?php printf(__('%1$s at %2$s', 'creative-newsletter'), get_comment_date(), get_comment_time()); ?>
                    </a>
                    <?php edit_comment_link(__('(Edit)', 'creative-newsletter'), '  ', ''); ?>
                </div>
            </div>
        </div>

        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation" style="color: #f0ad4e; font-style: italic;">
                <?php esc_html_e('Your comment is awaiting moderation.', 'creative-newsletter'); ?>
            </em>
            <br />
        <?php endif; ?>

        <div id="div-comment-<?php comment_ID(); ?>" class="comment-content" style="line-height: 1.6; color: #555;">
            <?php comment_text(); ?>
        </div>

        <div class="reply" style="margin-top: 1rem;">
            <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('Reply', 'creative-newsletter'), 'class' => 'btn btn-secondary'))); ?>
        </div>
    </<?php echo $tag; ?>>
    <?php
}