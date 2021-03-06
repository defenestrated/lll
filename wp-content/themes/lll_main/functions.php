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


/* --------------------- gallery rewrite ------------------- */


add_shortcode('gallery', 'my_gallery_shortcode');    
function my_gallery_shortcode($attr) {
    $post = get_post();

static $instance = 0;
$instance++;

if ( ! empty( $attr['ids'] ) ) {
    // 'ids' is explicitly ordered, unless you specify otherwise.
    if ( empty( $attr['orderby'] ) )
        $attr['orderby'] = 'post__in';
    $attr['include'] = $attr['ids'];
}

// Allow plugins/themes to override the default gallery template.
$output = apply_filters('post_gallery', '', $attr);
if ( $output != '' )
    return $output;

// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
if ( isset( $attr['orderby'] ) ) {
    $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
    if ( !$attr['orderby'] )
        unset( $attr['orderby'] );
}

extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => 'div',
    'icontag'    => 'div',
    'captiontag' => 'p',
    'columns'    => 3,
    'size'       => 'thumbnail',
    'include'    => '',
    'exclude'    => ''
), $attr));

$id = intval($id);
if ( 'RAND' == $order )
    $orderby = 'none';

if ( !empty($include) ) {
    $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
        $attachments[$val->ID] = $_attachments[$key];
    }
} elseif ( !empty($exclude) ) {
    $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
} else {
    $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
}

if ( empty($attachments) )
    return '';

if ( is_feed() ) {
    $output = "\n";
    foreach ( $attachments as $att_id => $attachment )
        $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
    return $output;
}

$itemtag = tag_escape($itemtag);
$captiontag = tag_escape($captiontag);
$icontag = tag_escape($icontag);
$valid_tags = wp_kses_allowed_html( 'post' );
if ( ! isset( $valid_tags[ $itemtag ] ) )
    $itemtag = 'div';
if ( ! isset( $valid_tags[ $captiontag ] ) )
    $captiontag = 'p';
if ( ! isset( $valid_tags[ $icontag ] ) )
    $icontag = 'div';

$columns = intval($columns);
$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
$float = is_rtl() ? 'right' : 'left';

$selector = "gallery-{$instance}";

$gallery_style = $gallery_div = '';
if ( apply_filters( 'use_default_gallery_style', true ) )
    $gallery_style = "
    <style type='text/css'>
        #{$selector} {
            margin: auto;
        }
        #{$selector} .gallery-item {
            float: {$float};
            margin-top: 10px;
            width: {$itemwidth}%;
        }
        #{$selector} img {
            border: 2px solid #cfcfcf;
        }
        #{$selector} .gallery-caption {
            margin-left: 0;
            margin-top: 5px;
        }
    </style>
    <!-- see gallery_shortcode() in wp-includes/media.php -->";
$size_class = sanitize_html_class( $size );
$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

$i = 0;
foreach ( $attachments as $id => $attachment ) {
    $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

    $output .= "<{$itemtag} class='gallery-item'>";
    $output .= "
        <{$icontag} class='gallery-icon'>
            $link
        </{$icontag}>";
    if ( $captiontag && trim($attachment->post_excerpt) ) {
        $output .= "
            <{$captiontag} class='wp-caption-text gallery-caption'>
            " . wptexturize($attachment->post_excerpt) . "
            </{$captiontag}>";
    }
    $output .= "</{$itemtag}>";
    if ( $columns > 0 && ++$i % $columns == 0 )
        $output .= '<br style="clear: both" />';
}

$output .= "
        <br style='clear: both;' />
    </div>\n";

return $output;
}

/* --------------------------------------------------------- */


/* -----------------      copyright      ------------------- */


function get_copyright() {
	echo "<div class='copyright'>all material &copy; Other Noises, design &copy; <a href='http://www.samgalison.com/' target='_blank'>Sam Galison</a>.</div>";
}

/* --------------------------------------------------------- */
?>
