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

get_header(); ?>

<?php the_post(); ?>


<div id="content" role="main">

<table class="pagetable"><tbody><tr>
<td class="pagetitle"><div class="titlebox"><p><?php echo get_post_meta(get_the_ID(), 'ft', true); ?></p></div></td>
<td class="pagecontent"><?php the_content(); ?></td>
</tr></tbody></table>

</div>
	
<?php get_footer(); ?>


