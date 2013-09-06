<?php
/*
Template Name: news
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
			
				the_content();
				
				$args= array(
					'post_type' => 'post',
					'count' => -1
				);
				$newsquery = new WP_Query($args);
				if( $newsquery -> have_posts() ) :
				while ( $newsquery -> have_posts() ) : $newsquery -> the_post();
			?>
				<div class="newspost">
					<?php echo the_post_thumbnail("medium", array('class' => 'newspic')); ?>
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
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>


