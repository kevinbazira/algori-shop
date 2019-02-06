<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Algori_Shop
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="divide50"></div>
<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			if ( '1' === $comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'algori-shop' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'algori-shop' ) ),
					number_format_i18n( $comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->
	
		<div class="divide30"></div>
		<?php echo algori_shop_get_the_comments_navigation(); ?>
		
		
		
		<ol class="comment-list commentlist">
			<?php
				wp_list_comments('type=comment&callback=algori_shop_comments_format');
			?>
		</ol><!-- .comment-list -->
		
		<div class="divide50"></div>
		
		<?php echo algori_shop_get_the_comments_navigation(); ?>
		<div class="divide50"></div>

		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'algori-shop' ); ?></p>
		<?php
		endif;

	endif; // Check for have_comments().

	comment_form(array(
		'title_reply' => __( 'Would you like to share your thoughts?', 'algori-shop' ),
		'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-submit" value="%4$s" />'
	));
	?>

</div><!-- #comments -->
