<?php

/*
 * dependencies (ACF,...)
 */
if( !is_admin() && !class_exists('Acf') ) {
    //die( 'ACF plugin is required by the theme, please inform administrator.<br>Install it for free <a href="https://wordpress.org/plugins/advanced-custom-fields/">here</a>.' );
    die( 'ACF plugin is required by the theme, please inform administrator.' );
}
function healthystudies_admin_notice__error() {
	if( ! class_exists('Acf') ) {
		$class = 'notice notice-error';
		$message = 'Theme error! <a href="' . get_admin_url(null, 'plugin-install.php?tab=plugin-information&plugin=advanced-custom-fields&TB_iframe=true&width=600&height=550') . '">ACF plugin</a> is required in order to run the theme.';
		printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
	}
}
add_action( 'admin_notices', 'healthystudies_admin_notice__error' );


/*
 * hide ACF from ordinary users
 */
function healthystudies_acf_show_admin( $show ) {
    return current_user_can('manage_options');
}
add_filter('acf/settings/show_admin', 'healthystudies_acf_show_admin');


/*
 * ACF options page
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'General Settings',
		'menu_title'	=> 'Healthy Studies Settings',
		'menu_slug' 	=> 'general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'general-settings',
	));
	
}


include "template-blocks/__blocks__.php";


/*
 * theme setup
 */
function healthystudies_setup() {

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'main-menu' 	=> __( 'Main Menu' ),
			'top-menu' 		=> __( 'Top Menu' ),
			'mobile-menu' 	=> __( 'Mobile Menu' ),
			'footer-menu' 	=> __( 'Footer Menu' )
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		//'search-form',
		//'comment-form',
		//'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'healthystudies_setup' );


/**
 * enqueue scripts and styles.
 */
function healthystudies_theme_name_scripts() {
	
    wp_enqueue_style( 'font', '//cloud.typography.com/6357712/764768/css/fonts.css');
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css');
    wp_enqueue_style( 'favicon', get_template_directory_uri() . '/img/favicon.ico');
	
	wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery.scrollTo', get_template_directory_uri() . '/js/jquery.scrollTo.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'jquery.chosen', get_template_directory_uri() . '/js/chosen.jquery.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'iscroll', get_template_directory_uri() . '/js/iscroll.js', array('jquery'), '', true );
    wp_enqueue_script( 'tracking', get_template_directory_uri() . '/js/tracking.js', array('jquery'), '', true );
    wp_enqueue_script( 'wwctrials', get_template_directory_uri() . '/js/wwctrials.js', array('jquery'), '', true );
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
    //wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '', true );
}
add_action( 'wp_enqueue_scripts', 'healthystudies_theme_name_scripts' );




/*
 * menu fix - aligning to existing css
 
class Walker_healthystudies_Menu extends Walker_Nav_Menu  {

	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n\t{$indent}<span class=\"sub-nav\"><ul class=\"children level-{$depth}\">\n";
	}
	function end_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n\t{$indent}</ul></span>\n";
	}

}*/

/*
 * menu fix - aligning to existing css
 */
class Walker_healthystudies_Menu extends Walker_Nav_Menu  {
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'><span>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</span></a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}








// Register Custom Post Type
function in_the_news_post_type() {

	$labels = array(
		'name'                  => _x( 'Articles', 'Post Type General Name', 'healthystudies' ),
		'singular_name'         => _x( 'Article', 'Post Type Singular Name', 'healthystudies' ),
		'menu_name'             => __( 'In The News', 'healthystudies' ),
		'name_admin_bar'        => __( 'In The News', 'healthystudies' ),
		'archives'              => __( 'Item Archives', 'healthystudies' ),
		'parent_item_colon'     => __( 'Parent Item:', 'healthystudies' ),
		'all_items'             => __( 'All Articles', 'healthystudies' ),
		'add_new_item'          => __( 'Add New Article', 'healthystudies' ),
		'add_new'               => __( 'Add Article', 'healthystudies' ),
		'new_item'              => __( 'New Article', 'healthystudies' ),
		'edit_item'             => __( 'Edit Article', 'healthystudies' ),
		'update_item'           => __( 'Update Article', 'healthystudies' ),
		'view_item'             => __( 'View Article', 'healthystudies' ),
		'search_items'          => __( 'Search Article', 'healthystudies' ),
		'not_found'             => __( 'Not found', 'healthystudies' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'healthystudies' ),
		'featured_image'        => __( 'Featured Image', 'healthystudies' ),
		'set_featured_image'    => __( 'Set featured image', 'healthystudies' ),
		'remove_featured_image' => __( 'Remove featured image', 'healthystudies' ),
		'use_featured_image'    => __( 'Use as featured image', 'healthystudies' ),
		'insert_into_item'      => __( 'Insert into article', 'healthystudies' ),
		'uploaded_to_this_item' => __( 'Uploaded to this article', 'healthystudies' ),
		'items_list'            => __( 'Articles list', 'healthystudies' ),
		'items_list_navigation' => __( 'Items list navigation', 'healthystudies' ),
		'filter_items_list'     => __( 'Filter items list', 'healthystudies' ),
	);
	$rewrite = array(
		'slug'                  => 'about-us/in-the-news',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Article', 'healthystudies' ),
		'description'           => __( 'In The News', 'healthystudies' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-list-view',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => false,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'in_the_news', $args );

}
add_action( 'init', 'in_the_news_post_type', 0 );


// Register Custom Post Type
function studies_post_type() {

	$labels = array(
		'name'                  => _x( 'Studies', 'Post Type General Name', 'healthystudies' ),
		'singular_name'         => _x( 'Study', 'Post Type Singular Name', 'healthystudies' ),
		'menu_name'             => __( 'Studies', 'healthystudies' ),
		'name_admin_bar'        => __( 'Studies', 'healthystudies' ),
		'archives'              => __( 'Item Archives', 'healthystudies' ),
		'parent_item_colon'     => __( 'Parent Item:', 'healthystudies' ),
		'all_items'             => __( 'All Studies', 'healthystudies' ),
		'add_new_item'          => __( 'Add New Item', 'healthystudies' ),
		'add_new'               => __( 'Add New', 'healthystudies' ),
		'new_item'              => __( 'New Item', 'healthystudies' ),
		'edit_item'             => __( 'Edit Item', 'healthystudies' ),
		'update_item'           => __( 'Update Item', 'healthystudies' ),
		'view_item'             => __( 'View Item', 'healthystudies' ),
		'search_items'          => __( 'Search Item', 'healthystudies' ),
		'not_found'             => __( 'Not found', 'healthystudies' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'healthystudies' ),
		'featured_image'        => __( 'Featured Image', 'healthystudies' ),
		'set_featured_image'    => __( 'Set featured image', 'healthystudies' ),
		'remove_featured_image' => __( 'Remove featured image', 'healthystudies' ),
		'use_featured_image'    => __( 'Use as featured image', 'healthystudies' ),
		'insert_into_item'      => __( 'Insert into item', 'healthystudies' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'healthystudies' ),
		'items_list'            => __( 'Items list', 'healthystudies' ),
		'items_list_navigation' => __( 'Items list navigation', 'healthystudies' ),
		'filter_items_list'     => __( 'Filter items list', 'healthystudies' ),
	);
	$rewrite = array(
		'slug'                  => 'current-studies/study',
		'with_front'            => true,
		'pages'                 => false,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Study', 'healthystudies' ),
		'description'           => __( 'Studies', 'healthystudies' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'page-attributes', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-welcome-learn-more',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false, //'current-studies',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'studies', $args );

}
add_action( 'init', 'studies_post_type', 0 );



// Register Custom Post Type
function template_blocks_post_type() {

	$labels = array(
		'name'                  => _x( 'Template blocks', 'Post Type General Name', 'healthystudies' ),
		'singular_name'         => _x( 'Template blocks', 'Post Type Singular Name', 'healthystudies' ),
		'menu_name'             => __( 'Template blocks', 'healthystudies' ),
		'name_admin_bar'        => __( 'Template blocks', 'healthystudies' ),
		'archives'              => __( 'Item Archives', 'healthystudies' ),
		'parent_item_colon'     => __( 'Parent Item:', 'healthystudies' ),
		'all_items'             => __( 'All Template Blocks', 'healthystudies' ),
		'add_new_item'          => __( 'Add New Template Block', 'healthystudies' ),
		'add_new'               => __( 'Add New', 'healthystudies' ),
		'new_item'              => __( 'New Block', 'healthystudies' ),
		'edit_item'             => __( 'Edit Block', 'healthystudies' ),
		'update_item'           => __( 'Update Block', 'healthystudies' ),
		'view_item'             => __( 'View Block', 'healthystudies' ),
		'search_items'          => __( 'Search', 'healthystudies' ),
		'not_found'             => __( 'Not found', 'healthystudies' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'healthystudies' ),
		'featured_image'        => __( 'Featured Image', 'healthystudies' ),
		'set_featured_image'    => __( 'Set featured image', 'healthystudies' ),
		'remove_featured_image' => __( 'Remove featured image', 'healthystudies' ),
		'use_featured_image'    => __( 'Use as featured image', 'healthystudies' ),
		'insert_into_item'      => __( 'Insert into item', 'healthystudies' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'healthystudies' ),
		'items_list'            => __( 'Items list', 'healthystudies' ),
		'items_list_navigation' => __( 'Items list navigation', 'healthystudies' ),
		'filter_items_list'     => __( 'Filter items list', 'healthystudies' ),
	);
	$args = array(
		'label'                 => __( 'Template Blocks', 'healthystudies' ),
		'description'           => __( 'Predefined Template Blocks', 'healthystudies' ),
		'labels'                => $labels,
		'supports'              => array( 'title', ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-exerpt-view',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'rewrite'               => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'template_blocks', $args );

}
add_action( 'init', 'template_blocks_post_type', 0 );



// Register Custom Post Type
function faq_post_type() {

	$labels = array(
		'name'                  => _x( 'FAQs', 'Post Type General Name', 'healthystudies' ),
		'singular_name'         => _x( 'FAQ', 'Post Type Singular Name', 'healthystudies' ),
		'menu_name'             => __( 'FAQ', 'healthystudies' ),
		'name_admin_bar'        => __( 'FAQ', 'healthystudies' ),
		'archives'              => __( 'FAQ Archives', 'healthystudies' ),
		'parent_item_colon'     => __( 'Parent Item:', 'healthystudies' ),
		'all_items'             => __( 'All FAQs', 'healthystudies' ),
		'add_new_item'          => __( 'Add New FAQ', 'healthystudies' ),
		'add_new'               => __( 'Add New', 'healthystudies' ),
		'new_item'              => __( 'New FAQ', 'healthystudies' ),
		'edit_item'             => __( 'Edit FAQ', 'healthystudies' ),
		'update_item'           => __( 'Update FAQ', 'healthystudies' ),
		'view_item'             => __( 'View FAQ', 'healthystudies' ),
		'search_items'          => __( 'Search FAQ', 'healthystudies' ),
		'not_found'             => __( 'Not found', 'healthystudies' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'healthystudies' ),
		'featured_image'        => __( 'Featured Image', 'healthystudies' ),
		'set_featured_image'    => __( 'Set featured image', 'healthystudies' ),
		'remove_featured_image' => __( 'Remove featured image', 'healthystudies' ),
		'use_featured_image'    => __( 'Use as featured image', 'healthystudies' ),
		'insert_into_item'      => __( 'Insert into item', 'healthystudies' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'healthystudies' ),
		'items_list'            => __( 'Items list', 'healthystudies' ),
		'items_list_navigation' => __( 'Items list navigation', 'healthystudies' ),
		'filter_items_list'     => __( 'Filter items list', 'healthystudies' ),
	);
	$args = array(
		'label'                 => __( 'FAQ', 'healthystudies' ),
		'description'           => __( 'Frequently Asked Questions', 'healthystudies' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'page-attributes', ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-format-chat',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'faq', $args );

}
add_action( 'init', 'faq_post_type', 0 );