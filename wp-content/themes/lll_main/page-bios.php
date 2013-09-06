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

	<div id="pagetitle">
	<?php 
		the_title();
		echo " // ";
		echo get_post_meta(get_the_ID(), 'ft', true); 
	?>
	</div>
	
	<div id="primary">
		<div class="bodytext" id="content" role="main">
			<?php
				$args= array(
					'post_type' => 'biography',
					'count' => -1
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
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>


