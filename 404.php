<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Algori_Shop
 */

get_header(); ?>

	<div class="offset"></div>
	<div id="primary" class="content-area">
	
		 <div class="gradient-wrapper page-title">
			<div class="container inner">
			  
			  <h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'algori-shop' ); ?></h1>
			  
			</div>
		  </div>
		  
		 <div class="light-wrapper">
			<div class="container inner">
			  <div class="row">
			  
				<?php get_sidebar( 'left' ); ?>
			  
				<main id="main" class="site-main col-sm-8 content">
				  <div class="classic-blog">

						<section class="error-404 not-found">

							<div class="page-content">
								<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'algori-shop' ); ?></p>

								<?php
									get_search_form();
									
									echo '<div class="divide50"></div>';

									the_widget( 'WP_Widget_Recent_Posts' );
								?>

								<div class="widget widget_categories">
									<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'algori-shop' ); ?></h2>
									<ul>
									<?php
										wp_list_categories( array(
											'orderby'    => 'count',
											'order'      => 'DESC',
											'show_count' => 1,
											'title_li'   => '',
											'number'     => 10,
										) );
									?>
									</ul>
								</div><!-- .widget -->

								<?php
									
									echo '<div class="divide50"></div>';
									/* translators: %1$s: smiley */
									$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'algori-shop' ), convert_smilies( ':)' ) ) . '</p>';
									the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
									
									echo '<div class="divide50"></div>';
									the_widget( 'WP_Widget_Tag_Cloud' );
								?>

							</div><!-- .page-content -->
						</section><!-- .error-404 -->

					</div><!-- .classic-blog -->
				</main><!-- #main -->
				
				
				<?php get_sidebar(); ?>
				
				
			  </div>
			  <!-- /row --> 
			</div>
			<!-- /container --> 
		  </div>
		  <!-- /light-wrapper -->
	
	</div><!-- #primary -->


<?php
get_footer();
