<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 * @package Algori_Shop
 */

get_header(); ?>
	
	
	
	<?php 
		if ( !get_header_image() || !is_front_page() ){ echo '<div class="offset"></div>'; } // Display offset if header image doesn't exist
	?>
  
	<div id="primary" class="content-area">
		
		<?php if( !is_front_page() ): // Only show this if is not on settings > front page?>
				 
		 <div class="gradient-wrapper page-title">
			<div class="container inner">
			
			  
			  <span class="pull-left">
				<h1> <?php single_post_title(); ?> </h1>
			  </span>
			  
			  
			  <span class="pull-right">
			  <?php echo woocommerce_breadcrumb(); ?>
			  </span>
			  
			</div>
		  </div>
		  
		<?php endif; ?>
		
		<div class="light-wrapper">
			<div class="container inner">
				 <div class="row">
				 
					<?php get_sidebar( 'left' ); ?>
				 
					<main id="main" class="site-main col-sm-8 content">
						<div class="classic-blog">
							
							<?php
							
							if ( is_home() && is_front_page() && class_exists( 'WooCommerce' ) ):
								$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
							?>
								<ul class="products">
									<?php
										$args = array(
											'post_type' => 'product',
											'posts_per_page' => 12
											);
										$loop = new WP_Query( $args );
										if ( $loop->have_posts() ) {
											while ( $loop->have_posts() ) : $loop->the_post();
												wc_get_template_part( 'content', 'product' );
											endwhile;
										} else {
											/* translators: %s: No products found */
											echo __( 'No products found', 'algori-shop' );
										}
										wp_reset_postdata();
									?>
								</ul><!--/.products-->
								<a href="<?php esc_url( $shop_page_url ); ?>" class="button btn btn-block" aria-label="<?php esc_attr_e( 'View all products in shop', 'algori-shop' ); ?>"><?php esc_html_e( 'View all products in shop', 'algori-shop' ); ?></a>
							<?php
							else:
									if ( have_posts() ) :

										if ( is_home() && !is_front_page() ) : ?>
											<header>
												<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
											</header>

										<?php
										endif;

										/* Start the Loop */
										while ( have_posts() ) : the_post();

											/*
											 * Include the Post-Format-specific template for the content.
											 * If you want to override this in a child theme, then include a file
											 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
											 */
											get_template_part( 'template-parts/content', get_post_format() );

										endwhile;

										echo algori_shop_get_the_posts_navigation();

									else :

										get_template_part( 'template-parts/content', 'none' );

									endif;
							endif; ?>
							
						</div><!-- .classic-blog -->
					</main><!-- #main -->
			
					<?php get_sidebar(); ?>
					
					
				  </div><!-- .row --> 
				</div><!-- .container --> 
		  </div><!-- .light-wrapper -->
	</div><!-- #primary -->

<?php
get_footer();
