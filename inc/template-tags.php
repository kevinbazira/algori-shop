<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Algori_Shop
 */

if ( ! function_exists( 'algori_shop_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function algori_shop_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'algori-shop' ) );
			if ( $tags_list ) {
				/* list of tags. <div class="meta tags">*/
				echo '<span class="tags-links meta tags">' . $tags_list . '</span>' ; // WPCS: XSS OK.
			}
			
		}
	}
endif;

if ( ! function_exists( 'algori_shop_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in a <figure class="icon-overlay medium icn-link main"> and anchor elements on index views, or a <figure class="main post-thumbnail">
 * element when on single views.
 */
function algori_shop_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>
	
	<figure class="main post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</figure><!-- .post-thumbnail -->

	<?php else : ?>
	<figure class="icon-overlay medium icn-link main">
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
				the_post_thumbnail( 'post-thumbnail', array(
					'alt' => the_title_attribute( array(
						'echo' => false,
					) ),
				) );
			?>
		</a>
	</figure><!-- .icon-overlay .medium .icn-link -->
	<?php endif; // End is_singular().
}
endif;


if ( ! function_exists( 'algori_shop_post_date' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time with format 'j F Y' i.e DD MM YYYY.
	 */
	function algori_shop_post_date() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date( 'j F Y' ) ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date( 'j F Y' ) )
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'; /* post date. */

		echo '<span class="posted-on date">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'algori_shop_post_category' ) ) :
	/**
	 * Prints comma seperated post categories for pages.
	 */
	function algori_shop_post_category() {
		
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'algori-shop' ) );
			if ( $categories_list ) {
				/* list of categories. */
				echo '<span class="cat-links">' . $categories_list . '</span>' ; // WPCS: XSS OK.
			}
		}

	}
endif;

if ( ! function_exists( 'algori_shop_posted_author' ) ) :
	/**
	 * Prints HTML with meta information for the current post author.
	 */
	function algori_shop_posted_author() {
		/* post author. */
		$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
		

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'algori_shop_post_comments_count' ) ) :
	/**
	 * Prints count of post comments.
	 */
	function algori_shop_post_comments_count() {
		
		if( ! post_password_required() && ( comments_open() || get_comments_number() ) ){
			
			$post_comments_count_number = get_comments_number();
		
			$post_comments_count = sprintf( 
				/* translators: 1: comment count number */
				esc_html( _nx( '%1$s Comment ', '%1$s Comments ', $post_comments_count_number, 'comment count number', 'algori-shop' ) ),
				number_format_i18n( $post_comments_count_number )
			);
		
			echo '<span class="comments-link comments-count-meta"> <a href="' . esc_url( get_permalink().'#comments') . '"> ' . $post_comments_count . '</a> </span>'; // WPCS: XSS OK.
		
		}
		
	}
endif;

if ( ! function_exists( 'algori_shop_post_edit_link' ) ) :
	/**
	 * Prints post edit link.
	 */
	function algori_shop_post_edit_link() {
		
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit Post <span class="screen-reader-text">%s</span>', 'algori-shop' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);

	}
endif;
