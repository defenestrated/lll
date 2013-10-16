<!-- this is the post template -->
<?php
/**
 * The template for displaying all posts.
 */

get_header(); ?>

<?php the_post(); ?>


<div id="content" role="main">

<table class="pagetable"><tbody><tr>
<td class="pagetitle"><div class="titlebox"><h1><?php the_title(); ?></h1></div></td>
<td class="pagecontent">
	<?php the_content(); ?>
	<a href="news">go back to the news page</a>
</td>
</tr></tbody></table>

</div>
	
<?php get_footer(); ?>


