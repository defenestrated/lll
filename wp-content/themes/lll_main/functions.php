<?php
/* -----------------  custom post types  ------------------- */


add_action( 'init', 'create_post_types' );

function create_post_types() {

	register_post_type( 'bio',
		array(
			'labels' => array(
				'name' => __( 'Bios' ),
				'singular_name' => __( 'Bio' ),
				'add_new_item' => _x('Add New Bio', 'bio'),
				'edit_item' => _x('Edit Bio', 'bio'),
			),
			'public' => true,
			'hierarchical' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'bios'),
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'menu_position' => 5
		)
	);
	
	register_post_type( 'ftd',
		array(
			'labels' => array(
				'name' => __( 'FTD Posts' ),
				'singular_name' => __( 'FTD Post' ),
				'add_new_item' => _x('Add New FTD Post', 'ftd'),
				'edit_item' => _x('Edit FTD Post', 'ftd'),
			),
			'public' => true,
			'hierarchical' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'ftdposts'),
			'supports' => array( 'title', 'editor', 'page-attributes' ),
			'menu_position' => 6
		)
	);
	
}

add_theme_support( 'post-thumbnails' );

/* --------------------------------------------------------- */


/* -----------------  custom taxonomies  ------------------- */


add_action( 'init', 'spawn_taxonomies' );

function spawn_taxonomies() {
	register_taxonomy(
		'roles',
		'bio',
		array(
			'label' => __( 'Title / Roles' ),
			'rewrite' => array( 'slug' => 'roles' )
		)
	);
}


/* --------------------------------------------------------- */

?>
