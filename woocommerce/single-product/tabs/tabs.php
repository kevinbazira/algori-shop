<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php
/*
* close div of row algori-shop-woocommerce-row opened in algori_shop_woocommerce_before_single_product_summary() of woocommerce.php
*/
?>
</div>

<?php
/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?> 

	<div class="row algori-shop-woocommerce-row">
		<ul class="nav nav-tabs algori-shop-woocommerce-nav-tabs">
			<?php 
				$first_tab_title = true;
				foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab <?php if( $first_tab_title ){ echo 'active'; $first_tab_title = false; } ?>" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
					<a href="#tab-<?php echo esc_attr( $key ); ?>" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $product_tab['title'] ), $key ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
		<div class="tab-content ">
			<?php 
				$first_tab_content = true;
				foreach ( $product_tabs as $key => $product_tab ) : ?>
				<div class="tab-pane algori-shop-woocommerce-nav-tab-pane <?php if( $first_tab_content ){ echo 'active'; $first_tab_content = false; } ?>" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
					
					<?php if ( isset( $product_tab['callback'] ) ) { call_user_func( $product_tab['callback'], $key, $product_tab ); } ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

<?php endif; ?>
