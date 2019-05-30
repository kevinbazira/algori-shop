<?php
/**
 * Algori Shop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Algori_Shop
 */

if ( ! function_exists( 'algori_shop_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function algori_shop_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Algori Shop, use a find and replace
		 * to change 'algori-shop' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'algori-shop', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		
		/*
		 * Enable theme support for Post Formats. 
		 *
		 * @link https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'algori-shop' ),
			'menu-2' => esc_html__( 'Footer', 'algori-shop' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		
		/**
		 * Enable gutenberg block styles on the front-end.
		 */
		add_theme_support( 'wp-block-styles' );
		
		/**
		 * Enable gutenberg wide alignment.
		 */
		add_theme_support( 'align-wide' );
		
		/**
		 * Enable gutenberg responsive embeds.
		 */
		add_theme_support( 'responsive-embeds' );
		
		/**
		 * Add custom link class navbar-brand to generated custom logo image link.
		 */
		 add_filter('get_custom_logo', 'algori_shop_change_logo_class');
		 
		 function algori_shop_change_logo_class ($html){
			 $html = str_replace('custom-logo-link', 'custom-logo-link navbar-brand', $html);
			 return $html;
		 }
		 
		 /**
		 * Display custom logo image if uploaded otherwise show text logo.
		 */
		 function algori_shop_display_logo(){
			 
			if( function_exists('the_custom_logo') ){ // check if the_custom_logo() is supported i.e WP 4.5 and above
			
				 if( has_custom_logo() ){ // check if logo image has been set
				 
					 the_custom_logo(); // display set logo image
					 
				 }else{ // display text logo
					 
					 // display H1 text logo if index page
					 if ( is_front_page() && is_home() ) { 
						echo '<h1 class="site-title"><a href="'; echo esc_url( home_url( '/' ) ); echo '" class="navbar-brand" rel="home">'; echo bloginfo( 'name' ); echo '</a></h1>';
					 } else { // display <p> text logo if not index page
						echo '<p class="site-title"><strong><a href="'; echo esc_url( home_url( '/' ) ); echo '" class="navbar-brand" rel="home">'; echo bloginfo( 'name' ); echo '</a></strong></p>';
					}
					
				 }
				 
			}
			
		 }
		 
		 /**
		 * Display algori shop custom comments format HTML Output.
		 */
		 function algori_shop_comments_format($comment, $args, $depth){
			  
			  echo '<li '; comment_class('x'); echo' id="li-comment-'; comment_ID(); echo '">';
				echo '<div class="user">';
					echo get_avatar( $comment ) . '
					  </div>';
				echo '<div class="message">
						  <div class="image-caption">
							<div class="info">
							  <h2>';
								/* Comment Author */
								comment_author_link();
						 echo'</h2>
							  <div class="meta">
									<div class="date">';/* Comment Date */
							 echo ' <a class="comment-permalink" href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">'; comment_date( 'j F Y' ); echo '</a>';
							 echo ' </div>
									&nbsp;&nbsp; | &nbsp;&nbsp;'; 
									 comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
						echo '</div>
							</div>';
							/* Comment Message */
							$comment_message = __( 'Your comment is awaiting moderation.', 'algori-shop' );
							echo esc_html(($comment->comment_approved == '0')? $comment_message : comment_text());
						echo '</div>
						</div>';
                
		 }
		 
		 /**
		 * Retrieves navigation to next/previous set of comments, when applicable.
		 */
		 function algori_shop_get_the_comments_navigation( $args = array() ) {
			$navigation = '';
		 
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 ) {
				$args = wp_parse_args( $args, array(
					'prev_text'          => __( 'Older comments', 'algori-shop' ),
					'next_text'          => __( 'Newer comments', 'algori-shop' ),
					'screen_reader_text' => __( 'Comments navigation', 'algori-shop' ),
				) );
		 
				$prev_link = get_previous_comments_link( $args['prev_text'] );
				$next_link = get_next_comments_link( $args['next_text'] );
		 
				if ( $prev_link ) {
					$navigation .= '<div class="nav-previous pull-right">' . $prev_link . '</div>';
				}
		 
				if ( $next_link ) {
					$navigation .= '<div class="nav-next pull-left">' . $next_link . '</div>';
				}
				
				$navigation .= '<div class="divide50"></div>';
				
				$navigation = _navigation_markup( $navigation, 'comment-navigation', $args['screen_reader_text'] );
			}
		 
			return $navigation;
		}
		
		
		/**
		 * Returns the navigation on single blog posts to next/previous set of posts, when applicable.
		 */
		function algori_shop_get_the_single_posts_navigation( ) {
			
			if($previous_link = get_previous_post()){ // Display previous post link if it exists
				echo '<div class="navigation pull-left">';
					$previous_btn_title =  __( 'Previous', 'algori-shop' );
					previous_post_link('%link', $previous_btn_title, 'no');
				echo '</div>';
			}
			
			if($next_link = get_next_post()){ // Display next post link if it exists
				echo '<div class="navigation pull-right">';
					$next_btn_title =  __( 'Next', 'algori-shop' );
					next_post_link('%link', $next_btn_title, 'no');
				echo '</div>';
			}
			
		}
		
		/**
		 * Returns the navigation to next/previous set of posts, when applicable.
		 */
		function algori_shop_get_the_posts_navigation( $args = array() ) {
			$navigation = '';
		 
			// Don't print empty markup if there's only one page.
			if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
				$args = wp_parse_args( $args, array(
					'prev_text'          => __( 'Older posts', 'algori-shop' ),
					'next_text'          => __( 'Newer posts', 'algori-shop' ),
					'screen_reader_text' => __( 'Posts navigation', 'algori-shop' ),
				) );
		 
				$next_link = get_previous_posts_link( $args['next_text'] );
				$prev_link = get_next_posts_link( $args['prev_text'] );
		 
				if ( $prev_link ) {
					$navigation .= '<div class="nav-previous pull-left">' . $prev_link . '</div>';
				}
		 
				if ( $next_link ) {
					$navigation .= '<div class="nav-next pull-right">' . $next_link . '</div>';
				}
		 
				$navigation = _navigation_markup( $navigation, 'posts-navigation', $args['screen_reader_text'] );
			}
		 
			return $navigation;
		}
		
		/**
		 * Implement editor styling, so as to make the TINYMCE editor content match the resulting post output in the theme, for a better user experience.
		 */
		add_editor_style(array('style/css/editor-style.css', 'http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,800,900'));
		add_theme_support( 'editor-styles' );
		
		
	}
endif;
add_action( 'after_setup_theme', 'algori_shop_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function algori_shop_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'algori_shop_content_width', 640 );
}
add_action( 'after_setup_theme', 'algori_shop_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function algori_shop_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'algori-shop' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'algori-shop' ),
		'before_widget' => '<section id="%1$s" class="sidebox widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'algori_shop_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function algori_shop_scripts() {

	// Add CSS
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/style/css/bootstrap.css', array(), '20180131', 'all' );

	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/style/css/owl.carousel.css', array(), '20180131', 'all' );

	wp_enqueue_style( 'prettify', get_template_directory_uri() . '/style/js/google-code-prettify/prettify.css', array(), '20180131', 'all' );

	wp_enqueue_style( 'algori-shop-style', get_stylesheet_uri() );
	
	wp_style_add_data( 'algori-shop-style', 'rtl', 'replace' );

	wp_enqueue_style( 'algori-shop-blue', get_template_directory_uri() . '/style/css/color/blue.css', array(), '20180131', 'all' );

	// Add Fonts
	wp_enqueue_style( 'algori-shop-google-fonts', 'http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,800,900' );
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/style/css/font-awesome.css', array(), '20180131', 'all' );
	
	//Add JavaScript
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/style/js/bootstrap.min.js', array( 'jquery' ), '20180131', true );

	wp_enqueue_script( 'bootstrap-hover-dropdown', get_template_directory_uri() . '/style/js/bootstrap-hover-dropdown.min.js', array( 'jquery' ), '20180131', true );
	
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/style/js/jquery.isotope.min.js', array( 'jquery' ), '20180131', true );
	
	wp_enqueue_script( 'jquery-easytabs', get_template_directory_uri() . '/style/js/jquery.easytabs.min.js', array( 'jquery' ), '20180131', true );
	
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/style/js/owl.carousel.min.js', array( 'jquery' ), '20180131', true );
	
	wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/style/js/jquery.fitvids.js', array( 'jquery' ), '20180131', true );
	
	wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/style/js/jquery.sticky.js', array( 'jquery' ), '20180131', true );
	
	wp_enqueue_script( 'prettify', get_template_directory_uri() . '/style/js/google-code-prettify/prettify.min.js', array(), '20180131', true );
	
	wp_enqueue_script( 'jquery-slickforms', get_template_directory_uri() . '/style/js/jquery.slickforms.js', array( 'jquery' ), '20180131', true );
	
	wp_enqueue_script( 'retina', get_template_directory_uri() . '/style/js/retina.js', array(), '20180131', true );
	
	wp_enqueue_script( 'algori-shop-scripts', get_template_directory_uri() . '/style/js/scripts.js', array( 'jquery' ), '20190318', true );

	wp_enqueue_script( 'algori-shop-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'algori-shop-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'algori_shop_scripts' );

/**
 * Enqueue fonts for gutenberg.
 */
function algori_shop_block_editor_fonts(){
	wp_enqueue_style( 'algori-shop-block-editor-fonts', 'http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,800,900' );
}
add_action( 'enqueue_block_editor_assets', 'algori_shop_block_editor_fonts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Load recommended plugins with TGMPA.
 */
require get_parent_theme_file_path( '/inc/recommended-plugins.php' );

/**
 * Customize Algori Shop elipsis at the end of excerpts from " [...]" to just "..." .
 */
 function algori_shop_excerpt_more( $more ) {
	 
	if ( is_admin() ) { // avoid affecting admin dashboard
		return $more;
	}
	return ' &hellip;';
	
 }
add_filter('excerpt_more', 'algori_shop_excerpt_more');

 /**
 * Customize Algori Shop Search form input and submit button .
 */
 function algori_shop_get_search_form($form) {
	 
	 $form = str_replace (
			'<label>',
			'<label style = "width: 100%">',
			$form
	 );
	 
	 $form = str_replace (
			'search-submit',
			'search-submit btn',
			$form
	 );
	 
	 return $form;
 }
 add_filter('get_search_form', 'algori_shop_get_search_form');
 
/**
 * Algori Shop walker nav class.
 */
class Algori_Shop_Walker_Nav_Primary extends Walker_Nav_menu {
	
	function start_lvl( &$output, $depth = 0, $args = array() ){ //ul
		$indent = str_repeat("\t",$depth);
		$submenu = ($depth > 0) ? ' sub-menu' : '';
		$output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
	}
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){ //li a span
		
		$indent = ( $depth ) ? str_repeat("\t",$depth) : '';
		
		$li_attributes = '';
		$class_names = $value = '';
		
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		$classes[] = ($args->walker->has_children) ? 'dropdown' : '';
		$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
		$classes[] = 'menu-item-' . $item->ID;
		if( $depth && $args->walker->has_children ){
			$classes[] = 'dropdown';
		}
		
		
		$active_menu = ($item->current || $item->current_item_ancestor) ? 'active' : '';
		$class_names = ($depth > 0) ? ' class="dropdown-submenu '.$active_menu.'"' : ' class="dropdown '.$active_menu.'"';
		
		$id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';
		
		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_url($item->url) . '"' : '';
		
		
		$attributes .= ( $args->walker->has_children ) ? ' class="dropdown-toggle js-activated" ' : '';
		
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ( $depth == 0 && $args->walker->has_children ) ? ' </a>' : '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		
	}
	
}

