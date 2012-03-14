<?php
/* Create Custom Post Type */
add_action('init', 'gallery_init');
function gallery_init() 
{
  $labels = array(
  
	'name' => _x( 'Multimedia Gallery', 'snapwire' ),
	'singular_name' => _x( 'Multimedia', 'snapwire' ),
	'add_new' => _x( 'Add New', 'snapwire' ),
	'add_new_item' => _x( 'Add New', 'snapwire' ),
	'edit_item' => _x( 'Edit', 'snapwire' ),
	'new_item' => _x( 'New', 'snapwire' ),
	'view_item' => _x( 'View', 'snapwire' ),
	'search_items' => _x( 'Search', 'snapwire' ),
	'not_found' => _x( 'Nothing found', 'snapwire' ),
	'not_found_in_trash' => _x( 'Nothing found in Trash', 'snapwire' ),
	'parent_item_colon' => _x( 'Parent:', 'snapwire' ),
	'menu_name' => _x( 'Multimedia', 'snapwire' ), 
  );
    
  $args = array(
        'labels' => $labels,
        'hierarchical' => true,
		'menu_icon' => get_bloginfo('template_directory') . '/images/framework/gabfire-icon.png',
        'supports' => array( 'title', 'editor', 'comments', 'author', 'excerpt', 'thumbnail', 'custom-fields', 'revisions', 'post-formats' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
  ); 
  register_post_type('gab_gallery',$args);
}

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'gallery_taxonomies', 0 );

//create two taxonomies, genres and writers for the post type "book"
function gallery_taxonomies() 
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'gallery-cats', 'snapwire' ),
    'singular_name' => _x( 'gallery-cat', 'snapwire' ),
    'search_items' =>  _x( 'Search', 'snapwire' ),
    'all_items' => _x( 'All', 'snapwire' ),
    'parent_item' => _x( 'Parent', 'snapwire' ),
    'parent_item_colon' => _x( 'Parent:', 'snapwire' ),
    'edit_item' => _x( 'Edit', 'snapwire' ), 
    'update_item' => _x( 'Update', 'snapwire' ),
    'add_new_item' => _x( 'Add New', 'snapwire' ),
    'new_item_name' => _x( 'New Name', 'snapwire' ),
    'menu_name' => _x( 'Gallery Categories', 'snapwire' ),
  ); 	

  register_taxonomy('gallery-cat',array('gab_gallery'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'gallery-cats' ),
  ));

  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'gallery-tags', 'snapwire' ),
    'singular_name' => _x( 'gallery-tag', 'snapwire'),
    'search_items' =>  _x( 'Search', 'snapwire' ),
    'popular_items' => _x( 'Popular', 'snapwire' ),
    'all_items' => _x( 'All', 'snapwire' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => _x( 'Edit', 'snapwire' ), 
    'update_item' => _x( 'Update', 'snapwire' ),
    'add_new_item' => _x( 'Add New', 'snapwire' ),
    'new_item_name' => _x( 'New', 'snapwire' ),
    'separate_items_with_commas' => _x( 'Separate with commas', 'snapwire' ),
    'add_or_remove_items' => _x( 'Add or remove', 'snapwire' ),
    'choose_from_most_used' => _x( 'Choose from the most used', 'snapwire' ),
    'menu_name' => _x( 'Gallery Tags', 'snapwire' ),
  ); 

  register_taxonomy('gallery-tag','gab_gallery',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'gallery-tag' ),
  ));
}