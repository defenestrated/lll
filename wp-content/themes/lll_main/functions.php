<?php
/* -----------------  custom post types  ------------------- */


add_action( 'init', 'create_post_types' );

function create_post_types() {

	register_post_type( 'biography',
		array(
			'labels' => array(
				'name' => __( 'Biographies' ),
				'singular_name' => __( 'Biography' ),
				'add_new_item' => _x('Add New Biography', 'biography'),
				'edit_item' => _x('Edit Biography', 'biography'),
			),
			'public' => true,
			'hierarchical' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'biographies'),
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
		'biography',
		array(
			'label' => __( 'Title / Roles' ),
			'rewrite' => array( 'slug' => 'roles' )
		)
	);
}


/* --------------------------------------------------------- */


/* -----------------      copyright      ------------------- */


function get_copyright() {
	echo "<div class='copyright'>copyright goes here</div>";
}

/* --------------------------------------------------------- */
?>
