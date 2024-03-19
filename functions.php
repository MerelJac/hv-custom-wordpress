<?php

function child_theme_enqueue_scripts() {
	wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css'  );
	wp_enqueue_style( 'childstyle' );
	wp_enqueue_style( 'boston', get_stylesheet_directory_uri() . '/fonts/boston/boston.css'  );
	wp_enqueue_style( 'scrollbar-css', get_stylesheet_directory_uri() . '/css/scrollbar.css'  );
	wp_enqueue_style( 'flexslider-css', get_stylesheet_directory_uri() . '/css/flexslider.css'  );

	wp_enqueue_script( 'jqueryui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js', array('jquery'), '', true);
	wp_enqueue_script( 'scrollbar-js', get_stylesheet_directory_uri() . '/js/scrollbar.js', array('jquery'), '', true);
	wp_enqueue_script( 'slicknav-js', get_stylesheet_directory_uri() . '/js/jquery.slicknav.min.js', array('jquery'), '', true);
	wp_enqueue_script( 'flexslider-js', get_stylesheet_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '', true);
	wp_enqueue_script( 'functions', get_stylesheet_directory_uri() . '/js/functions.js', array('jquery'), '', true);
	wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js', '', '', true);
}

add_action('wp_enqueue_scripts', 'child_theme_enqueue_scripts', 11);

add_action( 'widgets_init', 'custom_widgets_init', 1 );


function custom_widgets_init() {
  register_sidebar( array(
    'name' => __('Footer Contact'),
    'id' => 'footer-contact',
    'before_widget' => '<div class="widget">',
  	'after_widget'  => '</div>',
  	'before_title'  => '<h3>',
  	'after_title'   => '<h3>'
  ) );
	register_sidebar( array(
    'name' => __('Library Contact'),
    'id' => 'library-contact',
    'before_widget' => '<div class="widget">',
  	'after_widget'  => '</div>',
  	'before_title'  => '<h3>',
  	'after_title'   => '<h3>'
  ) );

	register_sidebar( array(
    'name' => __('Library Footer Left'),
    'id' => 'library-1',
    'before_widget' => '<div class="widget">',
  	'after_widget'  => '</div>',
  	'before_title'  => '<h3 class="title">',
  	'after_title'   => '<h3>'
  ) );
	register_sidebar( array(
    'name' => __('Library Footer Center'),
    'id' => 'library-2',
    'before_widget' => '<div class="widget">',
  	'after_widget'  => '</div>',
  	'before_title'  => '<h3 class="title">',
  	'after_title'   => '<h3>'
  ) );
	register_sidebar( array(
    'name' => __('Library Footer Right'),
    'id' => 'library-3',
    'before_widget' => '<div class="widget">',
  	'after_widget'  => '</div>',
  	'before_title'  => '<h3 class="title">',
  	'after_title'   => '<h3>'
  ) );
	register_sidebar( array(
    'name' => __('Parks and Rec Sidebar'),
    'id' => 'parks-rec',
    'before_widget' => '<div class="widget">',
  	'after_widget'  => '</div>',
  	'before_title'  => '<h3 class="title">',
  	'after_title'   => '<h3>'
  ) );
}


add_action( 'wp_enqueue_scripts', 'books_custom_style' );

function books_custom_style() {
    $url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    if ( false !== strpos( $url, 'all_books' ) ) {
        wp_enqueue_style( 'allbooks', get_stylesheet_directory_uri() . '/allbooks.css', array(), rand(111, 9999) );
    } else {
        wp_enqueue_style( 'books', get_stylesheet_directory_uri() . '/books.css', array(), rand(111, 9999) );
    }
}

add_filter( 'excerpt_more', 'child_theme_excerpt_more' );

function child_theme_excerpt_more( $more ) {
    return ' ... &nbsp;';
}

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

/**
 * Defines alternative titles for month view.
 *
 * @param  string $title
 * @return string
 */
function filter_events_title_month( $title ) {
	if ( tribe_is_month() ) {
		$title = 'Events Calendar | ';
	}

	return $title;
}
/**
 * Modifes the event <title> element for month view.
 *
 * Users of Yoast's SEO plugin may wish to try replacing the below line with:
 *
 *     add_filter('wpseo_title', 'filter_events_title_month' );
 */
add_filter( 'tribe_events_title_tag', 'filter_events_title_month' );

add_post_type_support( 'page', 'excerpt' );

/**
 * Enables the Excerpt meta box in Page edit screen.
 */
function wpcodex_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'wpcodex_add_excerpt_support_for_pages' );

// Register custom post types

function register_custom_post_type() {

	$labels = array(
		'name'                  => 'Library Posts',
		'singular_name'         => 'Library Post',
		'menu_name'             => 'Library Posts',
		'name_admin_bar'        => 'Library Posts',
		'archives'              => 'Library Posts',
		'attributes'            => 'Library Posts',
		'parent_item_colon'     => 'Parent Item:',
		'all_items'             => 'All Items',
		'add_new_item'          => 'Add New Item',
		'add_new'               => 'Add New',
		'new_item'              => 'New Item',
		'edit_item'             => 'Edit Item',
		'update_item'           => 'Update Item',
		'view_item'             => 'View Item',
		'view_items'            => 'View Items',
		'search_items'          => 'Search Item',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into item',
		'uploaded_to_this_item' => 'Uploaded to this item',
		'items_list'            => 'Items list',
		'items_list_navigation' => 'Items list navigation',
		'filter_items_list'     => 'Filter items list',
	);
	$rewrite = array(
		'slug'                  => 'happy-valley-library/blog'
	);
	$args = array(
		'label'                 => 'Library Posts',
		'description'           => '',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'comments', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post'
	);
	register_post_type( 'library_posts', $args );

}
add_action( 'init', 'register_custom_post_type', 0 );

// Register custom taxonomies

function register_custom_taxonomy_types() {

	$topic_labels = array(
		'name'              => __( 'Topics'),
		'singular_name'     => __( 'Topic'),
		'search_items'      => __( 'Search Topics' ),
		'all_items'         => __( 'All Topics' ),
		'parent_item'       => __( 'Parent Topics' ),
		'parent_item_colon' => __( 'Parent Topic:' ),
		'edit_item'         => __( 'Edit Topic' ),
		'update_item'       => __( 'Update Topic' ),
		'add_new_item'      => __( 'Add New Topic' ),
		'new_item_name'     => __( 'New Genre Topic' ),
		'menu_name'         => __( 'Topics' ),
	);
	register_taxonomy(
		'topic',
		'library_posts',
		array(
			'labels' => $topic_labels,
			'rewrite' => array( 'slug' => 'topic' ),
			'hierarchical' => true
		)
	);

	$tag_labels = array(
    'name' => _x( 'Tags', 'taxonomy general name' ),
    'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Tags' ),
    'popular_items' => __( 'Popular Tags' ),
    'all_items' => __( 'All Tags' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Tag' ),
    'update_item' => __( 'Update Tag' ),
    'add_new_item' => __( 'Add New Tag' ),
    'new_item_name' => __( 'New Tag Name' ),
    'separate_items_with_commas' => __( 'Separate tags with commas' ),
    'add_or_remove_items' => __( 'Add or remove tags' ),
    'choose_from_most_used' => __( 'Choose from the most used tags' ),
    'menu_name' => __( 'Tags' ),
  );

  register_taxonomy(
		'tags',
		'library_posts',
		array(
    'hierarchical' => false,
    'labels' => $tag_labels,
    'show_ui' => true,
    'rewrite' => array( 'slug' => 'tags' )
  ));
}

add_action( 'init', 'register_custom_taxonomy_types', 0 );

add_filter('default_content', 'my_editor_content', 10, 2);

function my_editor_content($content, $post) {
    switch ($post->post_type) {
        case 'all_books':
            $content = '<div class="book-container"><img class="book-image" style="width: 100%;" src="LINK-OF-IMAGE" alt="book-image" />
            <div class="book-middle">
            <div class="book-text title">BOOK TITLE</div>
            <div class="book-text author">BOOK AUTHOR</div>
            <div class="book-text illustrator">BOOK ILLUSTRATOR (optional)</div>
            <a href="PERMALINK UNDER TITLE (whole link)"><button class="book-button">Read More</button></a>
            </div>
            </div>
            
            <div class="book-details">
            <div>Title: <span>BOOK TITLE</span></div>
            <div>Author: <span>BOOK AUTHOR</span></div>
            <p>DETAILS OF BOOK</p>
            <a href="LINK TO LIBRARY"><button class="book-button-library">Check Availability</button></a>
            </div>';
            break;
        default:
            $content = '';
            break;
    }

    return $content;
}