<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); 
the_post(); ?>

<div id="content" class="attachcontent" role="main">

	<table class="pagetable attachtable"><tbody><tr>
	<td class="pagetitle">
		<div class="attbox">
			<div class="attstuff">
				<h1><?php echo the_title(); ?></h1>
				<p><?php echo get_the_excerpt(); ?></p>
				<div class="attnav">
					<p class="prev aleft"><?php previous_image_link( false, '<span class="arrow aleft">&lsaquo;</span> previous photo' ); ?></p>
					<p class="next aright"><?php next_image_link( false, 'next photo <span class="arrow aright">&rsaquo;</span>' ); ?></p>
				</div> <!-- .attnav -->
			</div> <!-- .attstuff -->
		</div> <!-- .attbox -->
	</td>
	<?php $img = wp_get_attachment_image_src( $post->ID, 'full' ); ?>
	<td class="pagecontent attachcell"><img class="attimg" src="<?php echo $img[0] ?>"></img></td>
	</tr></tbody></table>	
		
</div><!-- #content -->
<?php get_footer(); ?>

