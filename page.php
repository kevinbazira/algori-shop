<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Algori_Shop
 */

get_header(); ?>
	
	<?php if(!is_front_page()): // Only show this if not on settings > front page?>
		<div class="offset"></div>
	<?php endif; ?>
	
	<div id="primary" class="content-area">
		
		 <?php if(!is_front_page()): // Only show this if not on settings > front page?>
			 <div class="gradient-wrapper page-title">
				<div class="container inner">
				  
				  <?php the_title( '<h1>', '</h1>' ); ?>
				  
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
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
					
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
