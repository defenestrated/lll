<?php
/*
Template Name: bios
*/
/*


written by sam galison, void design. licensed under a Creative Commons
Attribution-NonCommercial-ShareAlike 3.0 Unported License, 2012.


*/

get_header(); ?>

<?php the_post(); ?>

<div id="content" role="main">

<table class="pagetable"><tbody><tr>
<td class="pagetitle"><div class="titlebox"><h1><?php echo get_post_meta(get_the_ID(), 'ft', true); ?></h1></div></td>
<td class="pagecontent">
	<?php
		the_content();
		$args= array(
			'post_type' => 'biography',
			'count' => -1,
			'order' => 'ASC'
		);
		$bioquery = new WP_Query($args);
		if( $bioquery -> have_posts() ) :
		while ( $bioquery -> have_posts() ) : $bioquery -> the_post();
	?>
	
	<div class="bio">
		<?php echo the_post_thumbnail("medium", array('class' => 'biopic')); ?>
		<h1><?php echo the_title(); ?></h1>
		<h2>
			<?php 
				$targs = array(
					'fields' => 'names'
				);
				
				$terms = wp_get_object_terms(get_the_ID(), 'roles', $targs);
				$count = 0;
				foreach ($terms as $term) {
					$count ++;
					echo $term;
					if ($count < count($terms)) echo ", ";
				}
			?>
		</h2>
		
		<?php echo the_content(); ?>
	</div>
		
	<?php
		endwhile;
		endif;
		wp_reset_postdata();
	?>

</td>
</tr></tbody></table>
<?php get_footer(); ?>


