<?php
/*
Template Name: ftd
*/
/*


written by sam galison, void design. licensed under a Creative Commons
Attribution-NonCommercial-ShareAlike 3.0 Unported License, 2012.


*/

get_header(); ?>

<?php the_post(); ?>

<div id="content" role="main">

<table class="pagetable"><tbody><tr>
<td class="pagetitle"><div class="titlebox"><p><?php echo get_post_meta(get_the_ID(), 'ft', true); ?></p></div></td>
<td class="pagecontent">
	<?php
		the_content();
		$args= array(
			'post_type' => 'ftd',
			'count' => -1
		);
		$ftdquery = new WP_Query($args);
		if( $ftdquery -> have_posts() ) :
		while ( $ftdquery -> have_posts() ) : $ftdquery -> the_post();
	?>
	
	<div class="ftdpost">
		<?php echo the_post_thumbnail("medium", array('class' => 'ftdpic')); ?>
		<h1><?php echo the_title(); ?></h1>
		
		<h2>
		<?php
			echo get_the_date('F jS, Y');
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

</div>
<?php get_footer(); ?>


