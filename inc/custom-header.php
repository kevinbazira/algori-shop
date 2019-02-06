<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Algori_Shop
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses algori_shop_header_style()
 */
function algori_shop_custom_header_setup() {
	
	add_theme_support( 'custom-header', apply_filters( 'algori_shop_custom_header_args', array(
		'default-image'          => get_parent_theme_file_uri( '/style/images/default-header-image.jpg' ),
		'default-text-color'     => '000000',
		'width'                  => 1999,
		'height'                 => 999,
		'flex-height'            => true,
		'wp-head-callback'       => 'algori_shop_header_style',
	) ) );/*3936 x 2624*/
	
	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/style/images/default-header-image.jpg',
			'thumbnail_url' => '%s/style/images/default-header-image.jpg',
			'description'   => __( 'Default Header Image', 'algori-shop' ),
		),
	) );
	
}
add_action( 'after_setup_theme', 'algori_shop_custom_header_setup' );

if ( ! function_exists( 'algori_shop_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see algori_shop_custom_header_setup().
	 */
	function algori_shop_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
