<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Algori_Shop
 */

get_header(); ?>
	
	<div class="offset"></div>
	<section id="primary" class="content-area">
	
		<div class="gradient-wrapper page-title">
			<div class="container inner">
			  <?php if ( have_posts() ):?>
					<h1><?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'algori-shop' ), '<span>' . get_search_query() . '</span>' );
					?></h1>
			  <?php else : ?>
					<h1><?php esc_html_e( 'Nothing Found', 'algori-shop' ); ?></h1>
			  <?php endif;?>
			</div>
		  </div>
	
		<div class="light-wrapper">
			<div class="container inner">
			  <div class="row">
			  
				<?php get_sidebar( 'left' ); ?>
			  
				<main id="main" class="site-main col-sm-8 content">
					<div class="classic-blog">
							<?php
							if ( have_posts() ) : ?>

								<?php
								/* Start the Loop */
								while ( have_posts() ) : the_post();

									/**
									 * Run the loop for the search to output the results.
									 * If you want to overload this in a child theme then include a file
									 * called content-search.php and that will be used instead.
									 */
									get_template_part( 'template-parts/content', 'search' );

								endwhile;

								echo algori_shop_get_the_posts_navigation();

							else :

								get_template_part( 'template-parts/content', 'none' );
								
							endif; ?>
						</div><!-- .classic-blog -->
					</main><!-- #main -->
				
				
				<?php get_sidebar(); ?>
				
				
			  </div>
			  <!-- /.row --> 
			</div>
			<!-- /.container --> 
		  </div>
		  <!-- /.light-wrapper -->
		
	</section><!-- #primary -->

<?php
get_footer();
