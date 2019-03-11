<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Algori_Shop
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function algori_shop_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'algori_shop_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function algori_shop_woocommerce_scripts() {
	
	// Add custom WooCommerce CSS
	wp_enqueue_style( 'algori-shop-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );
	
	// Add custom WooCommerce font
	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'algori-shop-woocommerce-style', $inline_font );
	
}
add_action( 'wp_enqueue_scripts', 'algori_shop_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function algori_shop_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'algori_shop_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function algori_shop_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'algori_shop_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function algori_shop_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'algori_shop_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function algori_shop_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'algori_shop_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function algori_shop_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'algori_shop_woocommerce_related_products_args' );

if ( ! function_exists( 'algori_shop_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function algori_shop_woocommerce_product_columns_wrapper() {
		$columns = algori_shop_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'algori_shop_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'algori_shop_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function algori_shop_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'algori_shop_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'algori_shop_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function algori_shop_woocommerce_wrapper_before() {
		?>
			<?php if(!is_front_page()): // Only show this if not on settings > front page?>
			<div class="offset"></div>
			<?php endif; ?>
			
			<div id="primary" class="content-area">
				 
				 <?php if(!is_front_page()): // Only show this if not on settings > front page?>
				 
				 <div class="gradient-wrapper page-title">
					<div class="container inner">
					
					  
					  <span class="pull-left">
						<?php the_title( '<h1>', '</h1>' ); ?>
					  </span>
					  
					  
					  <span class="pull-right">
					  <?php echo esc_html( woocommerce_breadcrumb() );  ?>
					  </span>
					  
					</div>
				  </div>
				  
				<?php endif; ?>
				  
				 <div class="light-wrapper">
					<div class="container inner">
					  <div class="row">
						<main id="main" class="site-main <?php echo ( ! is_active_sidebar( 'sidebar-1' ) ) ? 'col-sm-12' : 'col-sm-9' ; ?> content">
						  
							
							
							 
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'algori_shop_woocommerce_wrapper_before' );

if ( ! function_exists( 'algori_shop_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function algori_shop_woocommerce_wrapper_after() {
			?>
						  
						</main><!-- #main -->
						
						
						<?php get_sidebar(); ?>
						<!-- /col-sm-4 .sidebar --> 
						
						
					  </div>
					  <!-- /row --> 
					</div>
					<!-- /container --> 
				  </div>
				  <!-- /light-wrapper -->
			
			</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'algori_shop_woocommerce_wrapper_after' );


/**
 * Remove default WooCommerce hooks in content-product.php 
 */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

if ( ! function_exists( 'algori_shop_woocommerce_before_shop_loop_item' ) ) {
	/**
	 * Before item Content.
	 *
	 * Match the theme markup.
	 *
	 * @return void
	 */
	function algori_shop_woocommerce_before_shop_loop_item() {
		
		global $product;
		
		$product_link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
		
		
		
		?>
			<?php woocommerce_show_product_loop_sale_flash(); ?>
		<figure class="icon-overlay medium icn-more"> 
			<a href="<?php echo esc_url( $product_link ); ?>" class="fancybox-media" >
				<?php woocommerce_template_loop_product_thumbnail(); ?>
			</a>
		</figure>
		<div class="image-caption">
			<h3><a href="<?php echo esc_url( $product_link ); ?>"> <?php algori_shop_woocommerce_template_loop_product_title(); ?> </a></h3>
			<?php woocommerce_template_loop_rating(); ?>
			<?php woocommerce_template_loop_price(); ?>
			<?php woocommerce_template_loop_add_to_cart(); ?>
		</div>
	
							 
			<?php
	}
}
add_action( 'woocommerce_before_shop_loop_item', 'algori_shop_woocommerce_before_shop_loop_item' );

if ( ! function_exists( 'algori_shop_woocommerce_after_shop_loop_item' ) ) {
	/**
	 * After item Content.
	 *
	 * Match the theme markup.
	 *
	 * @return void
	 */
	function algori_shop_woocommerce_after_shop_loop_item() {
			?>

		<?php
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'algori_shop_woocommerce_after_shop_loop_item' );


/**
 * Remove default WooCommerce hooks in conten-single-product.php 
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

if ( ! function_exists( 'algori_shop_woocommerce_before_single_product_summary' ) ) {
	/**
	 * Before item Content.
	 *
	 * Match the theme markup.
	 *
	 * @return void
	 */
	function algori_shop_woocommerce_before_single_product_summary() {
		
		?>
		
		<?php
		/*
		* open div of row algori-shop-woocommerce-row opened that is closed in tabs.php
		*/
		?>
		<div class="row algori-shop-woocommerce-row algori-shop-woocommerce-single-product-grid">
			<div class="col-sm-6">
				<?php 
					woocommerce_show_product_sale_flash();
					woocommerce_show_product_images(); 
				?>
			</div>
			<div class="col-sm-6">
			  <div class="summary entry-summary">
					<?php
						do_action( 'woocommerce_single_product_summary' );
					?>
				</div>
			</div>
							 
			<?php
	}
}
add_action( 'woocommerce_before_single_product_summary', 'algori_shop_woocommerce_before_single_product_summary' );

if ( ! function_exists( 'algori_shop_woocommerce_after_single_product_summary' ) ) {
	/**
	 * After item Content.
	 *
	 * Match the theme markup.
	 *
	 * @return void
	 */
	function algori_shop_woocommerce_after_single_product_summary() {
			?>
			
			<div class="row algori-shop-woocommerce-row">
				<?php woocommerce_output_related_products(); ?>
			</div>
			
		<?php
	}
}
add_action( 'woocommerce_after_single_product_summary', 'algori_shop_woocommerce_after_single_product_summary' );


/**
 * Remove default WooCommerce title hook in conten-product.php 
 */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

if ( ! function_exists( 'algori_shop_woocommerce_template_loop_product_title' ) ) {

    /**
     * Show the product title in the product loop. By default this is an H2.
     */
    function algori_shop_woocommerce_template_loop_product_title() {
        echo get_the_title();
    }
}
add_action( 'woocommerce_shop_loop_item_title', 'algori_shop_woocommerce_template_loop_product_title' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'algori_shop_woocommerce_header_cart' ) ) {
			algori_shop_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'algori_shop_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function algori_shop_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		algori_shop_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'algori_shop_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'algori_shop_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function algori_shop_woocommerce_cart_link() {
		?>
		<a class="the-cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'algori-shop' ); ?>">
			<span class="count">
				<?php 
					printf( esc_html( '%d' ), WC()->cart->get_cart_contents_count() );
				?>
			</span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'algori_shop_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function algori_shop_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php algori_shop_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}
