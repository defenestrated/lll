<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title>
	<?php bloginfo('name'); ?>
	<?php wp_title('&nbsp;&bull;&nbsp;', true, 'left'); ?>
	</title>

	<?php
	$bgstring = "background";
	$randval = rand(1, 7);
	$bgstring .= $randval;
	$bgstring .= ".jpg";
	?>
	
	<style type="text/css" media="screen">
		@import url( <?php echo get_stylesheet_uri(); ?> );
		
		
		<?php echo 
		'body { background: url(/bgimages/' . $bgstring . ') no-repeat fixed center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		}
		'; ?>
		
	</style>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_get_archives(array('type' => 'monthly', 'format' => 'link')); ?>
	<?php //comments_popup_script(); // off by default ?>
	<?php wp_head(); ?>
	
	
</head>

<body <?php body_class(); ?>>
<div id="navbar">
	<table class="nav">
		<tbody><tr>
	 	<?php 
			$parents = get_pages('parent=0&sort_column=menu_order');
			$parentcount = count($parents);
			$counter = 0;
	 	?>
		
		<?php
			$currtitle = get_the_title();
			
			foreach ( $parents as $page ) {
				$counter++;
				$link = get_page_link( $page->ID );
				$title = $page->post_title;	
				echo ($title === $currtitle) ? '<td class="current">' : '<td>';
				echo '<a href="' . $link . '">' . $title . '</a>';

/*
				$children = get_pages('child_of='.$page->ID.'&parent='.$page->ID);
				if( count( $children ) != 0 ) {
					echo '<ul>';
					foreach ($children as $page) {
						$link = get_page_link( $page->ID );
						$title = $page->post_title;	
						echo '<li>';
						echo '<a href="' . $link . '">' . $title . '</a>';
						echo '</li>';
						}
						echo '</ul>';
				}
*/
				echo '</td>';
				if ($counter != $parentcount) { //if it's not the last one
					// insert separator
/* 					echo '<li>&bull;</li>'; */
				}
			}
		?>
		</tr></tbody>
	</table>	
</div>

<div id="content">
<!-- end header -->
